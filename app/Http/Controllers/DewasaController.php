<?php

namespace App\Http\Controllers;

use App\Models\Dewasa;
use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;

class DewasaController extends Controller
{
    public function index()
    {
        $dewasa = Dewasa::with('kepalaKeluarga')->paginate(15);
        return view('Admin.dewasa.index', compact('dewasa'));
    }

    public function create()
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        return view('Admin.dewasa.create', compact('kepalaKeluarga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nama' => 'required|string|max:100',
            'nik' => 'nullable|string|max:50',
            'tanggal_lahir' => 'required|date',
            'umur' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'dusun' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'riwayat_keluarga' => 'nullable|string',
            'riwayat_diri' => 'nullable|string',
            'merokok' => 'nullable|string|max:5',
            'konsumsi_gula' => 'nullable|string|max:5',
            'konsumsi_garam' => 'nullable|string|max:5',
            'konsumsi_lemak' => 'nullable|string|max:5',
            'waktu_kunjungan' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'imt' => 'nullable|string|max:20',
            'lingkar_perut' => 'nullable|numeric',
            'sistole' => 'nullable|integer',
            'diastole' => 'nullable|integer',
            'tekanan_darah_status' => 'nullable|string|max:20',
            'gula_darah' => 'nullable|string|max:20',
            'mata_kanan' => 'nullable|string|max:20',
            'mata_kiri' => 'nullable|string|max:20',
            'telinga_kanan' => 'nullable|string|max:20',
            'telinga_kiri' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|string|max:20',
            'usia_kategori' => 'nullable|string|max:20',
            'skor_merokok' => 'nullable|integer',
            'napas_berat' => 'nullable|string|max:5',
            'dahak' => 'nullable|string|max:5',
            'batuk' => 'nullable|string|max:5',
            'aktivitas_terganggu' => 'nullable|string|max:5',
            'pemeriksaan_sebelumnya' => 'nullable|string|max:5',
            'skor_puma' => 'nullable|integer',
            'batuk_tbc' => 'nullable|string|max:5',
            'demam' => 'nullable|string|max:5',
            'bb_turun' => 'nullable|string|max:5',
            'kontak_tbc' => 'nullable|string|max:5',
            'edukasi' => 'nullable|string',
            'rujukan' => 'nullable|string|max:100',
        ]);

        Dewasa::create($validated);


        return redirect()->route('admin.dewasa.index')->with('success', 'Data Dewasa berhasil ditambahkan');
    }

    public function show(Dewasa $dewasa)
    {
        $dewasa->load('kepalaKeluarga');
        return view('Admin.dewasa.show', compact('dewasa'));
    }

    public function edit(Dewasa $dewasa)
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        $dewasa->load('kepalaKeluarga');
        return view('Admin.dewasa.edit', compact('dewasa', 'kepalaKeluarga'));
    }

    public function update(Request $request, Dewasa $dewasa)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nama' => 'required|string|max:100',
            'nik' => 'nullable|string|max:50',
            'tanggal_lahir' => 'required|date',
            'umur' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'dusun' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'riwayat_keluarga' => 'nullable|string',
            'riwayat_diri' => 'nullable|string',
            'merokok' => 'nullable|string|max:5',
            'konsumsi_gula' => 'nullable|string|max:5',
            'konsumsi_garam' => 'nullable|string|max:5',
            'konsumsi_lemak' => 'nullable|string|max:5',
            'waktu_kunjungan' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'imt' => 'nullable|string|max:20',
            'lingkar_perut' => 'nullable|numeric',
            'sistole' => 'nullable|integer',
            'diastole' => 'nullable|integer',
            'tekanan_darah_status' => 'nullable|string|max:20',
            'gula_darah' => 'nullable|string|max:20',
            'mata_kanan' => 'nullable|string|max:20',
            'mata_kiri' => 'nullable|string|max:20',
            'telinga_kanan' => 'nullable|string|max:20',
            'telinga_kiri' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|string|max:20',
            'usia_kategori' => 'nullable|string|max:20',
            'skor_merokok' => 'nullable|integer',
            'napas_berat' => 'nullable|string|max:5',
            'dahak' => 'nullable|string|max:5',
            'batuk' => 'nullable|string|max:5',
            'aktivitas_terganggu' => 'nullable|string|max:5',
            'pemeriksaan_sebelumnya' => 'nullable|string|max:5',
            'skor_puma' => 'nullable|integer',
            'batuk_tbc' => 'nullable|string|max:5',
            'demam' => 'nullable|string|max:5',
            'bb_turun' => 'nullable|string|max:5',
            'kontak_tbc' => 'nullable|string|max:5',
            'edukasi' => 'nullable|string',
            'rujukan' => 'nullable|string|max:100',
        ]);

        $dewasa->update($validated);

        return redirect()->route('admin.dewasa.index')->with('success', 'Data Dewasa berhasil diupdate');
    }

    public function destroy(Dewasa $dewasa)
    {
        $dewasa->delete();
        return redirect()->route('admin.dewasa.index')->with('success', 'Data Dewasa berhasil dihapus');
    }
}
