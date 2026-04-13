<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;
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
            'no_kk' => 'required|string',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'no_kk.required' => 'Nomor KK harus diisi',
        ]);

        $kepalaKeluarga = KepalaKeluarga::where('email', $request->email)
            ->where('no_kk', $request->no_kk)
            ->first();

        if (!$kepalaKeluarga) {
            return back()->withErrors([
                'email' => 'Email atau Nomor KK tidak sesuai dengan data kami.',
            ]);
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
