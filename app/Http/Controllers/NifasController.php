<?php

namespace App\Http\Controllers;

use App\Models\Nifas;
use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;

class NifasController extends Controller
{
    public function index()
    {
        $nifas = Nifas::with('kepalaKeluarga')->paginate(15);
        return view('Admin.nifas.index', compact('nifas'));
    }

    public function create()
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        return view('Admin.nifas.create', compact('kepalaKeluarga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nama_ibu' => 'required|string|max:100',
            'nik' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'umur' => 'nullable|string|max:50',
            'nama_suami' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'dusun' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'tanggal_bersalin' => 'nullable|date',
            'tempat_bersalin' => 'nullable|string|max:100',
            'anak_ke' => 'nullable|integer',
            'tinggi_badan_ibu' => 'nullable|numeric',
            'waktu_kunjungan' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric',
            'naik_turun' => 'nullable|string|max:10',
            'tinggi_badan' => 'nullable|numeric',
            'lila' => 'nullable|numeric',
            'status_gizi' => 'nullable|string|max:10',
            'sistole' => 'nullable|integer',
            'diastole' => 'nullable|integer',
            'tekanan_darah_status' => 'nullable|string|max:20',
            'batuk' => 'nullable|string|max:5',
            'demam' => 'nullable|string|max:5',
            'bb_turun' => 'nullable|string|max:5',
            'kontak_tbc' => 'nullable|string|max:5',
            'vitamin_a' => 'nullable|string|max:5',
            'menyusui' => 'nullable|string|max:5',
            'kb' => 'nullable|string|max:50',
            'rujukan' => 'nullable|string|max:100',
            'edukasi' => 'nullable|string',
        ]);

        Nifas::create($validated);

        return redirect()->route('admin.nifas.index')->with('success', 'Data Nifas berhasil ditambahkan');
    }

    public function show(Nifas $nifa)
    {
        $nifa->load('kepalaKeluarga');
        return view('Admin.nifas.show', compact('nifa'));
    }

    public function edit(Nifas $nifa)
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        $nifa->load('kepalaKeluarga');
        return view('Admin.nifas.edit', compact('nifa', 'kepalaKeluarga'));
    }

    public function update(Request $request, Nifas $nifa)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nama_ibu' => 'required|string|max:100',
            'nik' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'umur' => 'nullable|string|max:50',
            'nama_suami' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'dusun' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'tanggal_bersalin' => 'nullable|date',
            'tempat_bersalin' => 'nullable|string|max:100',
            'anak_ke' => 'nullable|integer',
            'tinggi_badan_ibu' => 'nullable|numeric',
            'waktu_kunjungan' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric',
            'naik_turun' => 'nullable|string|max:10',
            'tinggi_badan' => 'nullable|numeric',
            'lila' => 'nullable|numeric',
            'status_gizi' => 'nullable|string|max:10',
            'sistole' => 'nullable|integer',
            'diastole' => 'nullable|integer',
            'tekanan_darah_status' => 'nullable|string|max:20',
            'batuk' => 'nullable|string|max:5',
            'demam' => 'nullable|string|max:5',
            'bb_turun' => 'nullable|string|max:5',
            'kontak_tbc' => 'nullable|string|max:5',
            'vitamin_a' => 'nullable|string|max:5',
            'menyusui' => 'nullable|string|max:5',
            'kb' => 'nullable|string|max:50',
            'rujukan' => 'nullable|string|max:100',
            'edukasi' => 'nullable|string',
        ]);

        $nifa->update($validated);

        return redirect()->route('admin.nifas.index')->with('success', 'Data Nifas berhasil diupdate');
    }

    public function destroy(Nifas $nifa)
    {
        $nifa->delete();
        return redirect()->route('admin.nifas.index')->with('success', 'Data Nifas berhasil dihapus');
    }
}
