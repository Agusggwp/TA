@extends('Admin.layouts.app')

@section('content')
<div class="flex-1 overflow-y-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Nifas</h1>

        <form action="{{ route('admin.nifas.update', $nifa) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- IDENTITAS IBU -->
            <div class="mb-6 p-4 bg-blue-50 rounded">
                <h3 class="text-lg font-semibold text-blue-700 mb-4">IDENTITAS IBU</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Kepala Keluarga *</label>
                        <select name="kepala_keluarga_id" class="w-full border rounded px-3 py-2 mt-1" required>
                            @foreach ($kepalaKeluarga as $kk)
                                <option value="{{ $kk->id }}" @if($nifa->kepala_keluarga_id == $kk->id) selected @endif>{{ $kk->nama_lengkap }} ({{ $kk->no_kk }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Nama Ibu *</label>
                        <input type="text" name="nama_ibu" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->nama_ibu }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->nik }}">
                    </div>
                    <div><label class="text-sm font-semibold">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->tanggal_lahir?->format('Y-m-d') }}">
                    </div>
                    <div><label class="text-sm font-semibold">Umur</label>
                        <input type="text" name="umur" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->umur }}">
                    </div>
                    <div><label class="text-sm font-semibold">Nama Suami</label>
                        <input type="text" name="nama_suami" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->nama_suami }}">
                    </div>
                    <div class="col-span-2"><label class="text-sm font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ $nifa->alamat }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->no_hp }}">
                    </div>
                </div>
            </div>

            <!-- LOKASI GEOGRAFIS -->
            <div class="mb-6 p-4 bg-teal-50 rounded">
                <h3 class="text-lg font-semibold text-teal-700 mb-4">LOKASI GEOGRAFIS</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Dusun</label>
                        <input type="text" name="dusun" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->dusun }}">
                    </div>
                    <div><label class="text-sm font-semibold">Desa</label>
                        <input type="text" name="desa" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->desa }}">
                    </div>
                    <div><label class="text-sm font-semibold">Kecamatan</label>
                        <input type="text" name="kecamatan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->kecamatan }}">
                    </div>
                </div>
            </div>

            <!-- DATA PERSALINAN -->
            <div class="mb-6 p-4 bg-indigo-50 rounded">
                <h3 class="text-lg font-semibold text-indigo-700 mb-4">DATA PERSALINAN</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Tanggal Bersalin</label>
                        <input type="date" name="tanggal_bersalin" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->tanggal_bersalin?->format('Y-m-d') }}">
                    </div>
                    <div><label class="text-sm font-semibold">Tempat Bersalin</label>
                        <input type="text" name="tempat_bersalin" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->tempat_bersalin }}">
                    </div>
                    <div><label class="text-sm font-semibold">Anak Ke</label>
                        <input type="number" name="anak_ke" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->anak_ke }}">
                    </div>
                </div>
            </div>

            <!-- PENGUKURAN FISIK IBU NIFAS -->
            <div class="mb-6 p-4 bg-green-50 rounded">
                <h3 class="text-lg font-semibold text-green-700 mb-4">PENGUKURAN FISIK IBU NIFAS</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Tinggi Badan Ibu (cm)</label>
                        <input type="number" step="0.01" name="tinggi_badan_ibu" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->tinggi_badan_ibu }}">
                    </div>
                    <div><label class="text-sm font-semibold">Waktu Kunjungan</label>
                        <input type="text" name="waktu_kunjungan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->waktu_kunjungan }}">
                    </div>
                    <div><label class="text-sm font-semibold">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="berat_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->berat_badan }}">
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div><label class="text-sm font-semibold">Naik/Turun</label>
                        <select name="naik_turun" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($nifa->naik_turun=='Naik') selected @endif>Naik</option>
                            <option @if($nifa->naik_turun=='Turun') selected @endif>Turun</option>
                            <option @if($nifa->naik_turun=='Tetap') selected @endif>Tetap</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Tinggi Badan (cm)</label>
                        <input type="number" step="0.01" name="tinggi_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->tinggi_badan }}">
                    </div>
                    <div><label class="text-sm font-semibold">LILA (cm)</label>
                        <input type="number" step="0.01" name="lila" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->lila }}">
                    </div>
                    <div><label class="text-sm font-semibold">Status Gizi</label>
                        <select name="status_gizi" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($nifa->status_gizi=='H') selected @endif>H</option>
                            <option @if($nifa->status_gizi=='K') selected @endif>K</option>
                            <option @if($nifa->status_gizi=='M') selected @endif>M</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- TEKANAN DARAH -->
            <div class="mb-6 p-4 bg-yellow-50 rounded">
                <h3 class="text-lg font-semibold text-yellow-700 mb-4">PEMERIKSAAN TEKANAN DARAH</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Sistole (mmHg)</label>
                        <input type="number" name="sistole" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->sistole }}">
                    </div>
                    <div><label class="text-sm font-semibold">Diastole (mmHg)</label>
                        <input type="number" name="diastole" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->diastole }}">
                    </div>
                    <div><label class="text-sm font-semibold">Status TD</label>
                        <select name="tekanan_darah_status" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($nifa->tekanan_darah_status=='Rendah') selected @endif>Rendah</option>
                            <option @if($nifa->tekanan_darah_status=='Normal') selected @endif>Normal</option>
                            <option @if($nifa->tekanan_darah_status=='Tinggi') selected @endif>Tinggi</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SKRINING TBC & IMUNISASI -->
            <div class="mb-6 p-4 bg-red-50 rounded">
                <h3 class="text-lg font-semibold text-red-700 mb-4">SKRINING TBC & IMUNISASI</h3>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Batuk</label>
                        <select name="batuk" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($nifa->batuk=='Ya') selected @endif>Ya</option>
                            <option @if($nifa->batuk=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Demam</label>
                        <select name="demam" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($nifa->demam=='Ya') selected @endif>Ya</option>
                            <option @if($nifa->demam=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">BB Turun</label>
                        <select name="bb_turun" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($nifa->bb_turun=='Ya') selected @endif>Ya</option>
                            <option @if($nifa->bb_turun=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Kontak TBC</label>
                        <select name="kontak_tbc" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($nifa->kontak_tbc=='Ya') selected @endif>Ya</option>
                            <option @if($nifa->kontak_tbc=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
                <div><label class="text-sm font-semibold">Vitamin A</label>
                    <select name="vitamin_a" class="w-full border rounded px-3 py-2 mt-1">
                        <option value="">Pilih</option>
                        <option @if($nifa->vitamin_a=='Ya') selected @endif>Ya</option>
                        <option @if($nifa->vitamin_a=='Tidak') selected @endif>Tidak</option>
                    </select>
                </div>
            </div>

            <!-- MENYUSUI & KELUARGA BERENCANA -->
            <div class="mb-6 p-4 bg-purple-50 rounded">
                <h3 class="text-lg font-semibold text-purple-700 mb-4">MENYUSUI & KELUARGA BERENCANA</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Menyusui</label>
                        <select name="menyusui" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($nifa->menyusui=='Ya') selected @endif>Ya</option>
                            <option @if($nifa->menyusui=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Keluarga Berencana</label>
                        <input type="text" name="kb" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->kb }}">
                    </div>
                </div>
            </div>

            <!-- EDUKASI & RUJUKAN -->
            <div class="mb-6 p-4 bg-orange-50 rounded">
                <h3 class="text-lg font-semibold text-orange-700 mb-4">EDUKASI & RUJUKAN</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2"><label class="text-sm font-semibold">Edukasi</label>
                        <textarea name="edukasi" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ $nifa->edukasi }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">Rujukan</label>
                        <input type="text" name="rujukan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $nifa->rujukan }}">
                    </div>
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <a href="{{ route('admin.nifas.index') }}" class="px-4 py-2 border rounded text-gray-700">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
