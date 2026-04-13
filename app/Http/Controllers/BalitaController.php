<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\KepalaKeluarga;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function index()
    {
        $balita = Balita::with('kepalaKeluarga')->paginate(15);
        return view('Admin.balita.index', compact('balita'));
    }

    public function create()
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        return view('Admin.balita.create', compact('kepalaKeluarga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nama_bayi' => 'required|string|max:100',
            'nik' => 'nullable|string|max:50',
            'jenis_kelamin' => 'nullable|string|max:20',
            'tanggal_lahir' => 'required|date',
            'berat_badan_lahir' => 'nullable|numeric',
            'panjang_badan_lahir' => 'nullable|numeric',
            'nama_ortu' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'dusun' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'umur' => 'nullable|integer',
            'waktu_kunjungan' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric',
            'naik_tidak_naik' => 'nullable|string|max:10',
            'status_bb_u' => 'nullable|string|max:20',
            'panjang_badan' => 'nullable|numeric',
            'status_pb_u' => 'nullable|string|max:20',
            'status_bb_pb' => 'nullable|string|max:20',
            'lingkar_lengan' => 'nullable|numeric',
            'status_lila' => 'nullable|string|max:10',
            'lingkar_kepala' => 'nullable|numeric',
            'batuk' => 'nullable|string|max:5',
            'demam' => 'nullable|string|max:5',
            'bb_turun' => 'nullable|string|max:5',
            'kontak_tbc' => 'nullable|string|max:5',
            'perkembangan' => 'nullable|string|max:20',
            'asi_eksklusif' => 'nullable|string|max:5',
            'mpasi' => 'nullable|string|max:5',
            'imunisasi' => 'nullable|string',
            'vitamin_a' => 'nullable|string|max:5',
            'obat_cacing' => 'nullable|string|max:5',
            'mt_pangan' => 'nullable|string|max:5',
            'edukasi' => 'nullable|string',
            'catatan_kesehatan' => 'nullable|string',
            'rujukan' => 'nullable|string|max:100',
        ]);

        Balita::create($validated);

        return redirect()->route('admin.balita.index')->with('success', 'Data Balita berhasil ditambahkan');
    }

    public function show(Balita $balita)
    {
        $balita->load('kepalaKeluarga');
        return view('Admin.balita.show', compact('balita'));
    }

    public function edit(Balita $balita)
    {
        $kepalaKeluarga = KepalaKeluarga::where('status', 'approved')->get();
        $balita->load('kepalaKeluarga');
        return view('Admin.balita.edit', compact('balita', 'kepalaKeluarga'));
    }

    public function update(Request $request, Balita $balita)
    {
        $validated = $request->validate([
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nama_bayi' => 'required|string|max:100',
            'nik' => 'nullable|string|max:50',
            'jenis_kelamin' => 'nullable|string|max:20',
            'tanggal_lahir' => 'required|date',
            'berat_badan_lahir' => 'nullable|numeric',
            'panjang_badan_lahir' => 'nullable|numeric',
            'nama_ortu' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'dusun' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'umur' => 'nullable|integer',
            'waktu_kunjungan' => 'nullable|string|max:50',
            'berat_badan' => 'nullable|numeric',
            'naik_tidak_naik' => 'nullable|string|max:10',
            'status_bb_u' => 'nullable|string|max:20',
            'panjang_badan' => 'nullable|numeric',
            'status_pb_u' => 'nullable|string|max:20',
            'status_bb_pb' => 'nullable|string|max:20',
            'lingkar_lengan' => 'nullable|numeric',
            'status_lila' => 'nullable|string|max:10',
            'lingkar_kepala' => 'nullable|numeric',
            'batuk' => 'nullable|string|max:5',
            'demam' => 'nullable|string|max:5',
            'bb_turun' => 'nullable|string|max:5',
            'kontak_tbc' => 'nullable|string|max:5',
            'perkembangan' => 'nullable|string|max:20',
            'asi_eksklusif' => 'nullable|string|max:5',
            'mpasi' => 'nullable|string|max:5',
            'imunisasi' => 'nullable|string',
            'vitamin_a' => 'nullable|string|max:5',
            'obat_cacing' => 'nullable|string|max:5',
            'mt_pangan' => 'nullable|string|max:5',
            'edukasi' => 'nullable|string',
            'catatan_kesehatan' => 'nullable|string',
            'rujukan' => 'nullable|string|max:100',
        ]);

        $balita->update($validated);

        return redirect()->route('admin.balita.index')->with('success', 'Data Balita berhasil diupdate');
    }

    public function destroy(Balita $balita)
    {
        $balita->delete();
        return redirect()->route('admin.balita.index')->with('success', 'Data Balita berhasil dihapus');
    }
}
