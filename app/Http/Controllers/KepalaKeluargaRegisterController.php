<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class KepalaKeluargaRegisterController extends Controller
{
    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('Keluarga.register');
    }

    /**
     * Store new kepala keluarga registration
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:kepala_keluarga'],
            'no_nik' => ['required', 'string', 'digits:16', 'unique:kepala_keluarga'],
            'no_kk' => ['required', 'string', 'unique:kepala_keluarga'],
            'alamat' => ['required', 'string', 'max:500'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'no_nik.required' => 'Nomor NIK harus diisi',
            'no_nik.digits' => 'Nomor NIK harus 16 digit',
            'no_nik.unique' => 'Nomor NIK sudah terdaftar',
            'no_kk.required' => 'Nomor KK harus diisi',
            'no_kk.unique' => 'Nomor KK sudah terdaftar',
            'alamat.required' => 'Alamat harus diisi',
            'no_telepon.required' => 'Nomor telepon harus diisi',
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Create new kepala keluarga
        $kepalaKeluarga = KepalaKeluarga::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'no_nik' => $validated['no_nik'],
            'no_kk' => $validated['no_kk'],
            'alamat' => $validated['alamat'],
            'no_telepon' => $validated['no_telepon'],
            'password' => Hash::make($validated['password']),
            'status' => 'pending', // Default status
        ]);

        // Fire registered event to send verification email
        event(new Registered($kepalaKeluarga));

        return redirect()->route('keluarga.register-verification')
            ->with('success', 'Registrasi berhasil! Silakan verifikasi email Anda. Link verifikasi sudah dikirim ke email Anda.');
    }

    /**
     * Show verification pending page
     */
    public function showVerificationPending()
    {
        return view('Keluarga.register-verification');
    }

    /**
     * Handle email verification
     */
    public function verify(Request $request, $id, $hash)
    {
        $kepalaKeluarga = KepalaKeluarga::findOrFail($id);

        // Verify the hash
        if ($hash !== sha1($kepalaKeluarga->getEmailForVerification())) {
            return redirect()->route('keluarga.register')
                ->withErrors(['Invalid verification link']);
        }

        // Mark email as verified
        if (!$kepalaKeluarga->hasVerifiedEmail()) {
            $kepalaKeluarga->markEmailAsVerified();
        }

        return redirect()->route('keluarga.login')
            ->with('success', 'Email berhasil diverifikasi! Akun Anda sudah dikonfirmasi. Tunggu persetujuan admin sebelum dapat login.');
    }

    /**
     * Resend verification email
     */
    public function resendVerificationEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:kepala_keluarga'],
        ]);

        $kepalaKeluarga = KepalaKeluarga::where('email', $request->email)->first();

        if ($kepalaKeluarga->hasVerifiedEmail()) {
            return back()->with('info', 'Email sudah diverifikasi sebelumnya.');
        }

        event(new Registered($kepalaKeluarga));

        return back()->with('success', 'Link verifikasi sudah dikirim ulang ke email Anda.');
    }
}
