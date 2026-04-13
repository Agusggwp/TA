<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class KepalaKeluargaAuthController extends Controller
{
    /**
     * Tampilkan login page untuk kepala keluarga
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->has('kepala_keluarga_id')) {
            return redirect()->route('keluarga.dashboard');
        }

        return view('Keluarga.login');
    }

    /**
     * Handle authentication untuk kepala keluarga
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $kepalaKeluarga = KepalaKeluarga::where('email', $request->email)->first();

        if (!$kepalaKeluarga || !Hash::check($request->password, $kepalaKeluarga->password)) {
            return back()->withErrors([
                'email' => 'Email atau password tidak sesuai.',
            ])->onlyInput('email');
        }

        // Check if email is verified
        if (!$kepalaKeluarga->hasVerifiedEmail()) {
            return back()->with('error_not_verified', [
                'message' => 'Email belum diverifikasi. Silakan cek email Anda untuk link verifikasi.',
                'email' => $kepalaKeluarga->email,
            ])->onlyInput('email');
        }

        // Check if account is approved by admin
        if (!$kepalaKeluarga->isApproved()) {
            return back()->with('error_not_approved', 'Akun Anda masih menunggu persetujuan dari admin. Silakan cek email untuk notifikasi persetujuan.')
                ->onlyInput('email');
        }

        // Simpan ke session
        session([
            'kepala_keluarga_id' => $kepalaKeluarga->id,
            'kepala_keluarga_nama' => $kepalaKeluarga->nama_lengkap,
            'kepala_keluarga_email' => $kepalaKeluarga->email,
            'kepala_keluarga_kk' => $kepalaKeluarga->no_kk,
        ]);

        return redirect()->route('keluarga.dashboard');
    }

    /**
     * Handle logout untuk kepala keluarga
     */
    public function logout()
    {
        Session::forget([
            'kepala_keluarga_id',
            'kepala_keluarga_nama',
            'kepala_keluarga_email',
            'kepala_keluarga_kk',
        ]);

        return redirect()->route('keluarga.login');
    }
}
