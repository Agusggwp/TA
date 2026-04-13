@extends('Admin.layouts.app')

@section('content')
<div class="flex-1 overflow-y-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($ibu_hamil) ? 'Edit' : 'Tambah' }} Data Ibu Hamil</h1>

        <form action="{{ isset($ibu_hamil) ? route('admin.ibu-hamil.update', $ibu_hamil) : route('admin.ibu-hamil.store') }}" method="POST">
            @csrf
            @if(isset($ibu_hamil)) @method('PUT') @endif

            <!-- IDENTITAS -->
            <div class="mb-6 p-4 bg-blue-50 rounded">
                <h3 class="text-lg font-semibold text-blue-700 mb-4">IDENTITAS</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Kepala Keluarga *</label>
                        <select name="kepala_keluarga_id" class="w-full border rounded px-3 py-2 mt-1" required>
                            @foreach ($kepalaKeluarga as $kk)
                                <option value="{{ $kk->id }}" @if(isset($ibu_hamil) && $ibu_hamil->kepala_keluarga_id == $kk->id) selected @endif>{{ $kk->nama_lengkap }} ({{ $kk->no_kk }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->nik : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Nama Ibu *</label>
                        <input type="text" name="nama_ibu" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->nama_ibu : '' }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->tanggal_lahir?->format('Y-m-d') : '' }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">Umur</label>
                        <input type="text" name="umur" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->umur : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Nama Suami</label>
                        <input type="text" name="nama_suami" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->nama_suami : '' }}">
                    </div>
                    <div class="col-span-2"><label class="text-sm font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($ibu_hamil) ? $ibu_hamil->alamat : '' }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->no_hp : '' }}">
                    </div>
                </div>
            </div>

            <!-- DATA KEHAMILAN -->
            <div class="mb-6 p-4 bg-green-50 rounded">
                <h3 class="text-lg font-semibold text-green-700 mb-4">DATA KEHAMILAN</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">L. Ibu Hamil</label>
                        <input type="text" name="l_ibu_hamil" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->l_ibu_hamil : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Kehamilan Ke</label>
                        <input type="number" name="kehamilan_ke" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->kehamilan_ke : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Jarak Anak Sebelumnya</label>
                        <input type="text" name="jarak_anak_sebelumnya" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->jarak_anak_sebelumnya : '' }}">
                    </div>
                </div>
            </div>

            <!-- DATA FISIK -->
            <div class="mb-6 p-4 bg-yellow-50 rounded">
                <h3 class="text-lg font-semibold text-yellow-700 mb-4">DATA FISIK</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Tinggi Badan (cm)</label>
                        <input type="number" step="0.01" name="tinggi_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->tinggi_badan : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="berat_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->berat_badan : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Lingkar Lengan (cm)</label>
                        <input type="number" step="0.01" name="lingkar_lengan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->lingkar_lengan : '' }}">
                    </div>
                </div>
            </div>

            <!-- PEMERIKSAAN -->
            <div class="mb-6 p-4 bg-red-50 rounded">
                <h3 class="text-lg font-semibold text-red-700 mb-4">PEMERIKSAAN</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Tekanan Darah</label>
                        <input type="text" name="tekanan_darah" class="w-full border rounded px-3 py-2 mt-1" placeholder="120/80" value="{{ isset($ibu_hamil) ? $ibu_hamil->tekanan_darah : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Denyut Jantung (bpm)</label>
                        <input type="text" name="denyut_jantung" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->denyut_jantung : '' }}">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Kondisi Ibu</label>
                        <textarea name="kondisi_ibu" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($ibu_hamil) ? $ibu_hamil->kondisi_ibu : '' }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">Keluhan</label>
                        <textarea name="keluhan" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($ibu_hamil) ? $ibu_hamil->keluhan : '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- KUNJUNGAN POSYANDU -->
            <div class="mb-6 p-4 bg-purple-50 rounded">
                <h3 class="text-lg font-semibold text-purple-700 mb-4">KUNJUNGAN POSYANDU</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->tanggal_kunjungan?->format('Y-m-d') : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Waktu Ke Posyandu</label>
                        <input type="text" name="waktu_ke_posyandu" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->waktu_ke_posyandu : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Petugas</label>
                        <input type="text" name="petugas" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($ibu_hamil) ? $ibu_hamil->petugas : '' }}">
                    </div>
                </div>
            </div>

            <!-- CATATAN -->
            <div class="mb-6 p-4 bg-gray-50 rounded">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">CATATAN</h3>
                <textarea name="catatan" class="w-full border rounded px-3 py-2" rows="3">{{ isset($ibu_hamil) ? $ibu_hamil->catatan : '' }}</textarea>
            </div>

            <div class="flex gap-3 justify-end">
                <a href="{{ route('admin.ibu-hamil.index') }}" class="px-4 py-2 border rounded text-gray-700">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ isset($ibu_hamil) ? 'Update' : 'Simpan' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
