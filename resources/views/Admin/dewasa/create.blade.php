@extends('Admin.layouts.app')

@section('content')
<div class="flex-1 overflow-y-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($dewasa) ? 'Edit' : 'Tambah' }} Data Dewasa</h1>

        <form action="{{ isset($dewasa) ? route('admin.dewasa.update', $dewasa) : route('admin.dewasa.store') }}" method="POST">
            @csrf
            @if(isset($dewasa)) @method('PUT') @endif

            <!-- IDENTITAS -->
            <div class="mb-6 p-4 bg-blue-50 rounded">
                <h3 class="text-lg font-semibold text-blue-700 mb-4">IDENTITAS</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Kepala Keluarga *</label>
                        <select name="kepala_keluarga_id" class="w-full border rounded px-3 py-2 mt-1" required>
                            @foreach ($kepalaKeluarga as $kk)
                                <option value="{{ $kk->id }}" @if(isset($dewasa) && $dewasa->kepala_keluarga_id == $kk->id) selected @endif>{{ $kk->nama_lengkap }} ({{ $kk->no_kk }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->nik : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Nama *</label>
                        <input type="text" name="nama" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->nama : '' }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->tanggal_lahir?->format('Y-m-d') : '' }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">Umur</label>
                        <input type="text" name="umur" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->umur : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" @if(isset($dewasa) && $dewasa->jenis_kelamin=='Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if(isset($dewasa) && $dewasa->jenis_kelamin=='Perempuan') selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Status Perkawinan</label>
                        <select name="status_perkawinan" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Belum Kawin" @if(isset($dewasa) && $dewasa->status_perkawinan=='Belum Kawin') selected @endif>Belum Kawin</option>
                            <option value="Kawin" @if(isset($dewasa) && $dewasa->status_perkawinan=='Kawin') selected @endif>Kawin</option>
                            <option value="Cerai" @if(isset($dewasa) && $dewasa->status_perkawinan=='Cerai') selected @endif>Cerai</option>
                            <option value="Cerai Mati" @if(isset($dewasa) && $dewasa->status_perkawinan=='Cerai Mati') selected @endif>Cerai Mati</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->pekerjaan : '' }}">
                    </div>
                    <div class="col-span-2"><label class="text-sm font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($dewasa) ? $dewasa->alamat : '' }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->no_hp : '' }}">
                    </div>
                </div>
            </div>

            <!-- LOKASI GEOGRAFIS -->
            <div class="mb-6 p-4 bg-teal-50 rounded">
                <h3 class="text-lg font-semibold text-teal-700 mb-4">LOKASI GEOGRAFIS</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Dusun</label>
                        <input type="text" name="dusun" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->dusun : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Desa</label>
                        <input type="text" name="desa" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->desa : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Kecamatan</label>
                        <input type="text" name="kecamatan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->kecamatan : '' }}">
                    </div>
                </div>
            </div>

            <!-- RIWAYAT & PERILAKU -->
            <div class="mb-6 p-4 bg-indigo-50 rounded">
                <h3 class="text-lg font-semibold text-indigo-700 mb-4">RIWAYAT & PERILAKU</h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Riwayat Keluarga</label>
                        <textarea name="riwayat_keluarga" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($dewasa) ? $dewasa->riwayat_keluarga : '' }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">Riwayat Diri</label>
                        <textarea name="riwayat_diri" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($dewasa) ? $dewasa->riwayat_diri : '' }}</textarea>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div><label class="text-sm font-semibold">Merokok</label>
                        <select name="merokok" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->merokok=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->merokok=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Konsumsi Gula</label>
                        <select name="konsumsi_gula" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->konsumsi_gula=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->konsumsi_gula=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Konsumsi Garam</label>
                        <select name="konsumsi_garam" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->konsumsi_garam=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->konsumsi_garam=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Konsumsi Lemak</label>
                        <select name="konsumsi_lemak" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->konsumsi_lemak=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->konsumsi_lemak=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- KUNJUNGAN & ANTROPOMETRI -->
            <div class="mb-6 p-4 bg-green-50 rounded">
                <h3 class="text-lg font-semibold text-green-700 mb-4">PENGUKURAN ANTROPOMETRI</h3>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Waktu Kunjungan</label>
                        <input type="text" name="waktu_kunjungan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->waktu_kunjungan : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="berat_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->berat_badan : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Tinggi Badan (cm)</label>
                        <input type="number" step="0.01" name="tinggi_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->tinggi_badan : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Lingkar Perut (cm)</label>
                        <input type="number" step="0.01" name="lingkar_perut" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->lingkar_perut : '' }}">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">IMT Status</label>
                        <select name="imt" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Kurus" @if(isset($dewasa) && $dewasa->imt=='Kurus') selected @endif>Kurus</option>
                            <option value="Normal" @if(isset($dewasa) && $dewasa->imt=='Normal') selected @endif>Normal</option>
                            <option value="Gemuk" @if(isset($dewasa) && $dewasa->imt=='Gemuk') selected @endif>Gemuk</option>
                            <option value="Obesitas" @if(isset($dewasa) && $dewasa->imt=='Obesitas') selected @endif>Obesitas</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- TEKANAN DARAH & GULA DARAH -->
            <div class="mb-6 p-4 bg-yellow-50 rounded">
                <h3 class="text-lg font-semibold text-yellow-700 mb-4">PEMERIKSAAN TEKANAN DARAH & GULA DARAH</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Sistole (mmHg)</label>
                        <input type="number" name="sistole" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->sistole : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Diastole (mmHg)</label>
                        <input type="number" name="diastole" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->diastole : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Status TD</label>
                        <select name="tekanan_darah_status" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Rendah" @if(isset($dewasa) && $dewasa->tekanan_darah_status=='Rendah') selected @endif>Rendah</option>
                            <option value="Normal" @if(isset($dewasa) && $dewasa->tekanan_darah_status=='Normal') selected @endif>Normal</option>
                            <option value="Tinggi" @if(isset($dewasa) && $dewasa->tekanan_darah_status=='Tinggi') selected @endif>Tinggi</option>
                        </select>
                    </div>
                </div>
                <div><label class="text-sm font-semibold">Gula Darah (mg/dL)</label>
                    <input type="text" name="gula_darah" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->gula_darah : '' }}">
                </div>
            </div>

            <!-- FUNGSI SENSORIK -->
            <div class="mb-6 p-4 bg-rose-50 rounded">
                <h3 class="text-lg font-semibold text-rose-700 mb-4">FUNGSI SENSORIK</h3>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Mata Kanan</label>
                        <select name="mata_kanan" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Normal" @if(isset($dewasa) && $dewasa->mata_kanan=='Normal') selected @endif>Normal</option>
                            <option value="Cacat" @if(isset($dewasa) && $dewasa->mata_kanan=='Cacat') selected @endif>Cacat</option>
                            <option value="Kebutaan" @if(isset($dewasa) && $dewasa->mata_kanan=='Kebutaan') selected @endif>Kebutaan</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Mata Kiri</label>
                        <select name="mata_kiri" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Normal" @if(isset($dewasa) && $dewasa->mata_kiri=='Normal') selected @endif>Normal</option>
                            <option value="Cacat" @if(isset($dewasa) && $dewasa->mata_kiri=='Cacat') selected @endif>Cacat</option>
                            <option value="Kebutaan" @if(isset($dewasa) && $dewasa->mata_kiri=='Kebutaan') selected @endif>Kebutaan</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Telinga Kanan</label>
                        <select name="telinga_kanan" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Normal" @if(isset($dewasa) && $dewasa->telinga_kanan=='Normal') selected @endif>Normal</option>
                            <option value="Cacat" @if(isset($dewasa) && $dewasa->telinga_kanan=='Cacat') selected @endif>Cacat</option>
                            <option value="Ketulian" @if(isset($dewasa) && $dewasa->telinga_kanan=='Ketulian') selected @endif>Ketulian</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Telinga Kiri</label>
                        <select name="telinga_kiri" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Normal" @if(isset($dewasa) && $dewasa->telinga_kiri=='Normal') selected @endif>Normal</option>
                            <option value="Cacat" @if(isset($dewasa) && $dewasa->telinga_kiri=='Cacat') selected @endif>Cacat</option>
                            <option value="Ketulian" @if(isset($dewasa) && $dewasa->telinga_kiri=='Ketulian') selected @endif>Ketulian</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- PUMA SCORING -->
            <div class="mb-6 p-4 bg-cyan-50 rounded">
                <h3 class="text-lg font-semibold text-cyan-700 mb-4">PUMA SCORING (PENYAKIT PARU)</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Usia Kategori</label>
                        <select name="usia_kategori" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="<40" @if(isset($dewasa) && $dewasa->usia_kategori=='<40') selected @endif>&lt;40</option>
                            <option value="40-49" @if(isset($dewasa) && $dewasa->usia_kategori=='40-49') selected @endif>40-49</option>
                            <option value="50-59" @if(isset($dewasa) && $dewasa->usia_kategori=='50-59') selected @endif>50-59</option>
                            <option value="60+" @if(isset($dewasa) && $dewasa->usia_kategori=='60+') selected @endif>60+</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Skor Merokok</label>
                        <input type="number" name="skor_merokok" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->skor_merokok : '' }}">
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Napas Berat</label>
                        <select name="napas_berat" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->napas_berat=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->napas_berat=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Dahak</label>
                        <select name="dahak" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->dahak=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->dahak=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Batuk</label>
                        <select name="batuk" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->batuk=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->batuk=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Aktivitas Terganggu</label>
                        <select name="aktivitas_terganggu" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->aktivitas_terganggu=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->aktivitas_terganggu=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Pemeriksaan Sebelumnya</label>
                        <select name="pemeriksaan_sebelumnya" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->pemeriksaan_sebelumnya=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->pemeriksaan_sebelumnya=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Skor PUMA</label>
                        <input type="number" name="skor_puma" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->skor_puma : '' }}">
                    </div>
                </div>
            </div>

            <!-- SKRINING TBC -->
            <div class="mb-6 p-4 bg-red-50 rounded">
                <h3 class="text-lg font-semibold text-red-700 mb-4">SKRINING TBC</h3>
                <div class="grid grid-cols-4 gap-4">
                    <div><label class="text-sm font-semibold">Batuk TBC</label>
                        <select name="batuk_tbc" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->batuk_tbc=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->batuk_tbc=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Demam</label>
                        <select name="demam" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->demam=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->demam=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">BB Turun</label>
                        <select name="bb_turun" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->bb_turun=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->bb_turun=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Kontak TBC</label>
                        <select name="kontak_tbc" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($dewasa) && $dewasa->kontak_tbc=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($dewasa) && $dewasa->kontak_tbc=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- EDUKASI & RUJUKAN -->
            <div class="mb-6 p-4 bg-orange-50 rounded">
                <h3 class="text-lg font-semibold text-orange-700 mb-4">EDUKASI & RUJUKAN</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2"><label class="text-sm font-semibold">Edukasi</label>
                        <textarea name="edukasi" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($dewasa) ? $dewasa->edukasi : '' }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">Rujukan</label>
                        <input type="text" name="rujukan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($dewasa) ? $dewasa->rujukan : '' }}">
                    </div>
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <a href="{{ route('admin.dewasa.index') }}" class="px-4 py-2 border rounded text-gray-700">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ isset($dewasa) ? 'Update' : 'Simpan' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
