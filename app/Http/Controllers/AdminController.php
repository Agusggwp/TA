<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KepalaKeluarga;
use App\Mail\ApprovalNotification;
use App\Mail\RejectionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Tampilkan admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $kaderUsers = User::where('role', 'kader')->count();
        $bidanUsers = User::where('role', 'bidan')->count();

        return view('Admin.admin.dashboard', [
            'totalUsers' => $totalUsers,
            'adminUsers' => $adminUsers,
            'kaderUsers' => $kaderUsers,
            'bidanUsers' => $bidanUsers,
        ]);
    }

    /**
     * Tampilkan daftar pengguna
     */
    public function users()
    {
        $users = User::all();
        return view('Admin.admin.users.index', ['users' => $users]);
    }

    /**
     * Tampilkan form tambah pengguna
     */
    public function createUser()
    {
        return view('Admin.admin.users.create');
    }

    /**
     * Simpan pengguna baru
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,kader,bidan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit pengguna
     */
    public function editUser(User $user)
    {
        return view('Admin.admin.users.edit', ['user' => $user]);
    }

    /**
     * Update pengguna
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,kader,bidan',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil diupdate');
    }

    /**
     * Hapus pengguna
     */
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus');
    }

    /**
     * Tampilkan daftar kepala keluarga untuk approval
     */
    public function kepalaKeluargaList(Request $request)
    {
        $status = $request->query('status', 'pending');
        $query = KepalaKeluarga::query();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $kepalaKeluargas = $query->latest()->paginate(10);

        $stats = [
            'pending' => KepalaKeluarga::where('status', 'pending')->count(),
            'approved' => KepalaKeluarga::where('status', 'approved')->count(),
            'rejected' => KepalaKeluarga::where('status', 'rejected')->count(),
            'total' => KepalaKeluarga::count(),
        ];

        return view('Admin.kepala-keluarga.index', [
            'kepalaKeluargas' => $kepalaKeluargas,
            'status' => $status,
            'stats' => $stats,
        ]);
    }

    /**
     * Tampilkan detail kepala keluarga
     */
    public function kepalaKeluargaShow(KepalaKeluarga $kepalaKeluarga)
    {
        return view('Admin.kepala-keluarga.show', [
            'kepalaKeluarga' => $kepalaKeluarga,
        ]);
    }

    /**
     * Update status kepala keluarga
     */
    public function kepalaKeluargaUpdateStatus(Request $request, KepalaKeluarga $kepalaKeluarga)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
            'reason' => 'nullable|string|max:500',
        ]);

        $oldStatus = $kepalaKeluarga->status;
        $newStatus = $request->status;

        $kepalaKeluarga->update([
            'status' => $newStatus,
        ]);

        // Log activity
        $message = "Status diubah dari '{$oldStatus}' menjadi '{$newStatus}'";
        if ($request->reason) {
            $message .= " - Alasan: {$request->reason}";
        }

        return back()->with('success', "Status kepala keluarga '{$kepalaKeluarga->nama_lengkap}' berhasil diubah menjadi '{$newStatus}'.");
    }

    /**
     * Approve kepala keluarga
     */
    public function kepalaKeluargaApprove(KepalaKeluarga $kepalaKeluarga)
    {
        try {
            $kepalaKeluarga->update(['status' => 'approved']);
            
            // Send approval email notification
            try {
                Mail::send(new ApprovalNotification($kepalaKeluarga));
            } catch (\Exception $emailError) {
                // Log email error but don't fail the approval
                \Log::warning('Email approval notification failed: ' . $emailError->getMessage());
            }
            
            // Return JSON if requested via AJAX
            if (request()->wantsJson() || request()->header('Content-Type') === 'application/json') {
                return response()->json([
                    'success' => true,
                    'message' => "Akun '{$kepalaKeluarga->nama_lengkap}' berhasil disetujui!"
                ]);
            }
            
            return back()->with('success', "Akun '{$kepalaKeluarga->nama_lengkap}' berhasil disetujui!");
        } catch (\Exception $e) {
            if (request()->wantsJson() || request()->header('Content-Type') === 'application/json') {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Terjadi kesalahan saat menyetujui akun');
        }
    }

    /**
     * Reject kepala keluarga
     */
    public function kepalaKeluargaReject(Request $request, KepalaKeluarga $kepalaKeluarga)
    {
        try {
            $request->validate([
                'reason' => 'nullable|string|max:500',
            ]);

            $reason = $request->reason;
            $kepalaKeluarga->update(['status' => 'rejected']);
            
            // Send rejection email notification
            try {
                Mail::send(new RejectionNotification($kepalaKeluarga, $reason));
            } catch (\Exception $emailError) {
                // Log email error but don't fail the rejection
                \Log::warning('Email rejection notification failed: ' . $emailError->getMessage());
            }
            
            // Return JSON if requested via AJAX
            if ($request->wantsJson() || $request->header('Content-Type') === 'application/json') {
                return response()->json([
                    'success' => true,
                    'message' => "Akun '{$kepalaKeluarga->nama_lengkap}' berhasil ditolak."
                ]);
            }
            
            return back()->with('success', "Akun '{$kepalaKeluarga->nama_lengkap}' berhasil ditolak.");
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->header('Content-Type') === 'application/json') {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Terjadi kesalahan saat menolak akun');
        }
    }
}
