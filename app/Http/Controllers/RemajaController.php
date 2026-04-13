<?php

namespace App\Http\Controllers;

use App\Models\Remaja;
use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;

class RemajaController extends Controller
{
    public function index()
    {
        $remaja = Remaja::with('kepalaKeluarga')->paginate(15);
        return view('Admin.remaja.index', compact('remaja'));
    }

    public function create()
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        return view('Admin.remaja.create', compact('kepalaKeluarga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nama_anak' => 'required|string|max:100',
            'nik' => 'nullable|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'nullable|string|max:20',
            'nama_ortu' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'dusun' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'riwayat_keluarga' => 'nullable|string',
            'riwayat_diri' => 'nullable|string',
            'waktu_kunjungan' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'imt_status' => 'nullable|string|max:20',
            'lingkar_perut' => 'nullable|numeric',
            'sistole' => 'nullable|integer',
            'diastole' => 'nullable|integer',
            'tekanan_darah_status' => 'nullable|string|max:20',
            'gula_darah' => 'nullable|string|max:20',
            'hemoglobin' => 'nullable|string|max:20',
            'anemia' => 'nullable|string|max:5',
            'batuk' => 'nullable|string|max:5',
            'demam' => 'nullable|string|max:5',
            'bb_turun' => 'nullable|string|max:5',
            'kontak_tbc' => 'nullable|string|max:5',
            'masalah_rumah' => 'nullable|string|max:5',
            'masalah_pendidikan' => 'nullable|string|max:5',
            'masalah_makan' => 'nullable|string|max:5',
            'masalah_aktivitas' => 'nullable|string|max:5',
            'masalah_obat' => 'nullable|string|max:5',
            'masalah_seksual' => 'nullable|string|max:5',
            'masalah_emosi' => 'nullable|string|max:5',
            'masalah_keamanan' => 'nullable|string|max:5',
            'edukasi' => 'nullable|string',
            'rujukan' => 'nullable|string|max:100',
        ]);

        Remaja::create($validated);

        return redirect()->route('admin.remaja.index')->with('success', 'Data Remaja berhasil ditambahkan');
    }

    public function show(Remaja $remaja)
    {
        $remaja->load('kepalaKeluarga');
        return view('Admin.remaja.show', compact('remaja'));
    }

    public function edit(Remaja $remaja)
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        $remaja->load('kepalaKeluarga');
        return view('Admin.remaja.edit', compact('remaja', 'kepalaKeluarga'));
    }

    public function update(Request $request, Remaja $remaja)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nama_anak' => 'required|string|max:100',
            'nik' => 'nullable|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'nullable|string|max:20',
            'nama_ortu' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'dusun' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'riwayat_keluarga' => 'nullable|string',
            'riwayat_diri' => 'nullable|string',
            'waktu_kunjungan' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'imt_status' => 'nullable|string|max:20',
            'lingkar_perut' => 'nullable|numeric',
            'sistole' => 'nullable|integer',
            'diastole' => 'nullable|integer',
            'tekanan_darah_status' => 'nullable|string|max:20',
            'gula_darah' => 'nullable|string|max:20',
            'hemoglobin' => 'nullable|string|max:20',
            'anemia' => 'nullable|string|max:5',
            'batuk' => 'nullable|string|max:5',
            'demam' => 'nullable|string|max:5',
            'bb_turun' => 'nullable|string|max:5',
            'kontak_tbc' => 'nullable|string|max:5',
            'masalah_rumah' => 'nullable|string|max:5',
            'masalah_pendidikan' => 'nullable|string|max:5',
            'masalah_makan' => 'nullable|string|max:5',
            'masalah_aktivitas' => 'nullable|string|max:5',
            'masalah_obat' => 'nullable|string|max:5',
            'masalah_seksual' => 'nullable|string|max:5',
            'masalah_emosi' => 'nullable|string|max:5',
            'masalah_keamanan' => 'nullable|string|max:5',
            'edukasi' => 'nullable|string',
            'rujukan' => 'nullable|string|max:100',
        ]);

        $remaja->update($validated);

        return redirect()->route('admin.remaja.index')->with('success', 'Data Remaja berhasil diupdate');
    }

    public function destroy(Remaja $remaja)
    {
        $remaja->delete();
        return redirect()->route('admin.remaja.index')->with('success', 'Data Remaja berhasil dihapus');
    }
}
