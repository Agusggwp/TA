<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    public function index()
    {
        $ibuHamil = IbuHamil::with('kepalaKeluarga')->paginate(15);
        return view('Admin.ibu-hamil.index', compact('ibuHamil'));
    }

    public function create()
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        return view('Admin.ibu-hamil.create', compact('kepalaKeluarga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nik' => 'nullable|string|max:50',
            'nama_ibu' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'umur' => 'nullable|integer',
            'nama_suami' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'l_ibu_hamil' => 'nullable|string|max:50',
            'kehamilan_ke' => 'nullable|integer',
            'jarak_anak_sebelumnya' => 'nullable|string|max:50',
            'tinggi_badan' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'tekanan_darah' => 'nullable|string|max:20',
            'denyut_jantung' => 'nullable|string|max:20',
            'kondisi_ibu' => 'nullable|string',
            'keluhan' => 'nullable|string',
            'tanggal_kunjungan' => 'nullable|date',
            'waktu_ke_posyandu' => 'nullable|string|max:100',
            'petugas' => 'nullable|string|max:100',
            'catatan' => 'nullable|string',
        ]);

        IbuHamil::create($validated);

        return redirect()->route('admin.ibu-hamil.index')->with('success', 'Data Ibu Hamil berhasil ditambahkan');
    }

    public function show(IbuHamil $ibu_hamil)
    {
        $ibu_hamil->load('kepalaKeluarga');
        return view('Admin.ibu-hamil.show', compact('ibu_hamil'));
    }

    public function edit(IbuHamil $ibu_hamil)
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        $ibu_hamil->load('kepalaKeluarga');
        return view('Admin.ibu-hamil.edit', compact('ibu_hamil', 'kepalaKeluarga'));
    }

    public function update(Request $request, IbuHamil $ibu_hamil)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nik' => 'nullable|string|max:50',
            'nama_ibu' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'umur' => 'nullable|integer',
            'nama_suami' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'l_ibu_hamil' => 'nullable|string|max:50',
            'kehamilan_ke' => 'nullable|integer',
            'jarak_anak_sebelumnya' => 'nullable|string|max:50',
            'tinggi_badan' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'tekanan_darah' => 'nullable|string|max:20',
            'denyut_jantung' => 'nullable|string|max:20',
            'kondisi_ibu' => 'nullable|string',
            'keluhan' => 'nullable|string',
            'tanggal_kunjungan' => 'nullable|date',
            'waktu_ke_posyandu' => 'nullable|string|max:100',
            'petugas' => 'nullable|string|max:100',
            'catatan' => 'nullable|string',
        ]);

        $ibu_hamil->update($validated);

        return redirect()->route('admin.ibu-hamil.index')->with('success', 'Data Ibu Hamil berhasil diupdate');
    }

    public function destroy(IbuHamil $ibu_hamil)
    {
        $ibu_hamil->delete();
        return redirect()->route('admin.ibu-hamil.index')->with('success', 'Data Ibu Hamil berhasil dihapus');
    }
}
