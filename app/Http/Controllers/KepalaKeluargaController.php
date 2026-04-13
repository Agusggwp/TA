<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;

class KepalaKeluargaController extends Controller
{
    /**
     * Show dashboard untuk kepala keluarga
     */
    public function dashboard()
    {
        if (!session('kepala_keluarga_id')) {
            return redirect()->route('keluarga.login');
        }

        $kepalaKeluarga = KepalaKeluarga::find(session('kepala_keluarga_id'));

        if (!$kepalaKeluarga) {
            session()->flush();
            return redirect()->route('keluarga.login');
        }

        return view('Keluarga.dashboard', [
            'title' => 'Dashboard Keluarga',
            'totalAnggota' => 0, // TODO: Count from anggota_keluarga table
            'kunjunganTerakhir' => '-', // TODO: Get from riwayat_kesehatan table
        ]);
    }

    /**
     * Show anggota keluarga page
     */
    public function anggota()
    {
        if (!session('kepala_keluarga_id')) {
            return redirect()->route('keluarga.login');
        }

        return view('Keluarga.anggota', [
            'title' => 'Anggota Keluarga',
        ]);
    }

    /**
     * Show riwayat kesehatan page
     */
    public function riwayat()
    {
        if (!session('kepala_keluarga_id')) {
            return redirect()->route('keluarga.login');
        }

        return view('Keluarga.riwayat', [
            'title' => 'Riwayat Kesehatan',
        ]);
    }
}
