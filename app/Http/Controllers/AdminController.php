<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        return view('admin.dashboard', [
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
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Tampilkan form tambah pengguna
     */
    public function createUser()
    {
        return view('admin.users.create');
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
        return view('admin.users.edit', ['user' => $user]);
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
}
