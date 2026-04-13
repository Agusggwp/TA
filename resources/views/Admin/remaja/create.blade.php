@extends('Admin.layouts.app')

@section('content')
<div class="flex-1 overflow-y-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($remaja) ? 'Edit' : 'Tambah' }} Data Remaja</h1>

        <form action="{{ isset($remaja) ? route('admin.remaja.update', $remaja) : route('admin.remaja.store') }}" method="POST">
            @csrf
            @if(isset($remaja)) @method('PUT') @endif

            <!-- IDENTITAS -->
            <div class="mb-6 p-4 bg-blue-50 rounded">
                <h3 class="text-lg font-semibold text-blue-700 mb-4">IDENTITAS</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Kepala Keluarga *</label>
                        <select name="kepala_keluarga_id" class="w-full border rounded px-3 py-2 mt-1" required>
                            @foreach ($kepalaKeluarga as $kk)
                                <option value="{{ $kk->id }}" @if(isset($remaja) && $remaja->kepala_keluarga_id == $kk->id) selected @endif>{{ $kk->nama_lengkap }} ({{ $kk->no_kk }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->nik : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Nama Anak *</label>
                        <input type="text" name="nama_anak" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->nama_anak : '' }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->tanggal_lahir?->format('Y-m-d') : '' }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" @if(isset($remaja) && $remaja->jenis_kelamin=='Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if(isset($remaja) && $remaja->jenis_kelamin=='Perempuan') selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Nama Orang Tua</label>
                        <input type="text" name="nama_ortu" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->nama_ortu : '' }}">
                    </div>
                    <div class="col-span-2"><label class="text-sm font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($remaja) ? $remaja->alamat : '' }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->no_hp : '' }}">
                    </div>
                </div>
            </div>

            <!-- LOKASI GEOGRAFIS -->
            <div class="mb-6 p-4 bg-teal-50 rounded">
                <h3 class="text-lg font-semibold text-teal-700 mb-4">LOKASI GEOGRAFIS</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Dusun</label>
                        <input type="text" name="dusun" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->dusun : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Desa</label>
                        <input type="text" name="desa" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->desa : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Kecamatan</label>
                        <input type="text" name="kecamatan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->kecamatan : '' }}">
                    </div>
                </div>
            </div>

            <!-- RIWAYAT -->
            <div class="mb-6 p-4 bg-indigo-50 rounded">
                <h3 class="text-lg font-semibold text-indigo-700 mb-4">RIWAYAT</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Riwayat Keluarga</label>
                        <textarea name="riwayat_keluarga" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($remaja) ? $remaja->riwayat_keluarga : '' }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">Riwayat Diri</label>
                        <textarea name="riwayat_diri" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($remaja) ? $remaja->riwayat_diri : '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- KUNJUNGAN & ANTROPOMETRI -->
            <div class="mb-6 p-4 bg-green-50 rounded">
                <h3 class="text-lg font-semibold text-green-700 mb-4">PENGUKURAN ANTROPOMETRI</h3>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Waktu Kunjungan</label>
                        <input type="text" name="waktu_kunjungan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->waktu_kunjungan : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="berat_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->berat_badan : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Tinggi Badan (cm)</label>
                        <input type="number" step="0.01" name="tinggi_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->tinggi_badan : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Lingkar Perut (cm)</label>
                        <input type="number" step="0.01" name="lingkar_perut" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->lingkar_perut : '' }}">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">IMT Status</label>
                        <select name="imt_status" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Kurus" @if(isset($remaja) && $remaja->imt_status=='Kurus') selected @endif>Kurus</option>
                            <option value="Normal" @if(isset($remaja) && $remaja->imt_status=='Normal') selected @endif>Normal</option>
                            <option value="Gemuk" @if(isset($remaja) && $remaja->imt_status=='Gemuk') selected @endif>Gemuk</option>
                            <option value="Obesitas" @if(isset($remaja) && $remaja->imt_status=='Obesitas') selected @endif>Obesitas</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- TEKANAN DARAH & LABORATORIUM -->
            <div class="mb-6 p-4 bg-yellow-50 rounded">
                <h3 class="text-lg font-semibold text-yellow-700 mb-4">PEMERIKSAAN TEKANAN DARAH & LABORATORIUM</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Sistole (mmHg)</label>
                        <input type="number" name="sistole" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->sistole : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Diastole (mmHg)</label>
                        <input type="number" name="diastole" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->diastole : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Status TD</label>
                        <select name="tekanan_darah_status" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Rendah" @if(isset($remaja) && $remaja->tekanan_darah_status=='Rendah') selected @endif>Rendah</option>
                            <option value="Normal" @if(isset($remaja) && $remaja->tekanan_darah_status=='Normal') selected @endif>Normal</option>
                            <option value="Tinggi" @if(isset($remaja) && $remaja->tekanan_darah_status=='Tinggi') selected @endif>Tinggi</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Gula Darah (mg/dL)</label>
                        <input type="text" name="gula_darah" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->gula_darah : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Hemoglobin (gr%)</label>
                        <input type="text" name="hemoglobin" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->hemoglobin : '' }}">
                    </div>
                    <div><label class="text-sm font-semibold">Anemia</label>
                        <select name="anemia" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->anemia=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->anemia=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SKRINING TBC -->
            <div class="mb-6 p-4 bg-red-50 rounded">
                <h3 class="text-lg font-semibold text-red-700 mb-4">SKRINING TBC</h3>
                <div class="grid grid-cols-4 gap-4">
                    <div><label class="text-sm font-semibold">Batuk</label>
                        <select name="batuk" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->batuk=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->batuk=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Demam</label>
                        <select name="demam" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->demam=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->demam=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">BB Turun</label>
                        <select name="bb_turun" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->bb_turun=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->bb_turun=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Kontak TBC</label>
                        <select name="kontak_tbc" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->kontak_tbc=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->kontak_tbc=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- HEADSS ASSESSMENT -->
            <div class="mb-6 p-4 bg-purple-50 rounded">
                <h3 class="text-lg font-semibold text-purple-700 mb-4">HEADSS ASSESSMENT (PSIKOSOSIAL)</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Masalah Rumah (Home)</label>
                        <select name="masalah_rumah" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->masalah_rumah=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->masalah_rumah=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Masalah Pendidikan (Education)</label>
                        <select name="masalah_pendidikan" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->masalah_pendidikan=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->masalah_pendidikan=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Masalah Makan (Eating)</label>
                        <select name="masalah_makan" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->masalah_makan=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->masalah_makan=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Masalah Aktivitas (Activities)</label>
                        <select name="masalah_aktivitas" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->masalah_aktivitas=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->masalah_aktivitas=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Masalah Obat (Drugs)</label>
                        <select name="masalah_obat" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->masalah_obat=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->masalah_obat=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Masalah Seksual (Sexual)</label>
                        <select name="masalah_seksual" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->masalah_seksual=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->masalah_seksual=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Masalah Emosi (Emotional)</label>
                        <select name="masalah_emosi" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->masalah_emosi=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->masalah_emosi=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Masalah Keamanan (Safety)</label>
                        <select name="masalah_keamanan" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option value="Ya" @if(isset($remaja) && $remaja->masalah_keamanan=='Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(isset($remaja) && $remaja->masalah_keamanan=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- EDUKASI & RUJUKAN -->
            <div class="mb-6 p-4 bg-orange-50 rounded">
                <h3 class="text-lg font-semibold text-orange-700 mb-4">EDUKASI & RUJUKAN</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2"><label class="text-sm font-semibold">Edukasi</label>
                        <textarea name="edukasi" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ isset($remaja) ? $remaja->edukasi : '' }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">Rujukan</label>
                        <input type="text" name="rujukan" class="w-full border rounded px-3 py-2 mt-1" value="{{ isset($remaja) ? $remaja->rujukan : '' }}">
                    </div>
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <a href="{{ route('admin.remaja.index') }}" class="px-4 py-2 border rounded text-gray-700">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ isset($remaja) ? 'Update' : 'Simpan' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
