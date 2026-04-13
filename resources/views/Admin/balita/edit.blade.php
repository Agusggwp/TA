@extends('Admin.layouts.app')

@section('content')
<div class="flex-1 overflow-y-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Balita</h1>

        <form action="{{ route('admin.balita.update', $balita) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- IDENTITAS BALITA -->
            <div class="mb-6 p-4 bg-blue-50 rounded">
                <h3 class="text-lg font-semibold text-blue-700 mb-4">IDENTITAS BALITA</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Kepala Keluarga *</label>
                        <select name="kepala_keluarga_id" class="w-full border rounded px-3 py-2 mt-1" required>
                            @foreach ($kepalaKeluarga as $kk)
                                <option value="{{ $kk->id }}" @if($balita->kepala_keluarga_id == $kk->id) selected @endif>{{ $kk->nama_lengkap }} ({{ $kk->no_kk }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Nama Bayi *</label>
                        <input type="text" name="nama_bayi" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->nama_bayi }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->nik }}">
                    </div>
                    <div><label class="text-sm font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->jenis_kelamin=='Laki-laki') selected @endif>Laki-laki</option>
                            <option @if($balita->jenis_kelamin=='Perempuan') selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->tanggal_lahir?->format('Y-m-d') }}" required>
                    </div>
                    <div><label class="text-sm font-semibold">Umur (bulan)</label>
                        <input type="number" name="umur" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->umur }}">
                    </div>
                </div>
            </div>

            <!-- DATA LAHIR -->
            <div class="mb-6 p-4 bg-teal-50 rounded">
                <h3 class="text-lg font-semibold text-teal-700 mb-4">DATA LAHIR</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Berat Badan Lahir (kg)</label>
                        <input type="number" step="0.01" name="berat_badan_lahir" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->berat_badan_lahir }}">
                    </div>
                    <div><label class="text-sm font-semibold">Panjang Badan Lahir (cm)</label>
                        <input type="number" step="0.01" name="panjang_badan_lahir" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->panjang_badan_lahir }}">
                    </div>
                </div>
            </div>

            <!-- DATA ORANG TUA / ALAMAT -->
            <div class="mb-6 p-4 bg-indigo-50 rounded">
                <h3 class="text-lg font-semibold text-indigo-700 mb-4">DATA ORANG TUA / ALAMAT</h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Nama Orang Tua</label>
                        <input type="text" name="nama_ortu" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->nama_ortu }}">
                    </div>
                    <div><label class="text-sm font-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->no_hp }}">
                    </div>
                    <div class="col-span-2"><label class="text-sm font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ $balita->alamat }}</textarea>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Dusun</label>
                        <input type="text" name="dusun" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->dusun }}">
                    </div>
                    <div><label class="text-sm font-semibold">Desa</label>
                        <input type="text" name="desa" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->desa }}">
                    </div>
                    <div><label class="text-sm font-semibold">Kecamatan</label>
                        <input type="text" name="kecamatan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->kecamatan }}">
                    </div>
                </div>
            </div>

            <!-- PENGUKURAN ANTROPOMETRI -->
            <div class="mb-6 p-4 bg-green-50 rounded">
                <h3 class="text-lg font-semibold text-green-700 mb-4">PENGUKURAN ANTROPOMETRI</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Waktu Kunjungan</label>
                        <input type="text" name="waktu_kunjungan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->waktu_kunjungan }}">
                    </div>
                    <div><label class="text-sm font-semibold">Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="berat_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->berat_badan }}">
                    </div>
                    <div><label class="text-sm font-semibold">Naik/Tidak Naik</label>
                        <select name="naik_tidak_naik" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->naik_tidak_naik=='Naik') selected @endif>Naik</option>
                            <option @if($balita->naik_tidak_naik=='Tidak Naik') selected @endif>Tidak Naik</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Panjang Badan (cm)</label>
                        <input type="number" step="0.01" name="panjang_badan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->panjang_badan }}">
                    </div>
                    <div><label class="text-sm font-semibold">Lingkar Kepala (cm)</label>
                        <input type="number" step="0.01" name="lingkar_kepala" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->lingkar_kepala }}">
                    </div>
                    <div><label class="text-sm font-semibold">Lingkar Lengan (cm)</label>
                        <input type="number" step="0.01" name="lingkar_lengan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->lingkar_lengan }}">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Status BB/U</label>
                        <select name="status_bb_u" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->status_bb_u=='Gizi Baik') selected @endif>Gizi Baik</option>
                            <option @if($balita->status_bb_u=='Gizi Kurang') selected @endif>Gizi Kurang</option>
                            <option @if($balita->status_bb_u=='Gizi Buruk') selected @endif>Gizi Buruk</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Status PB/U</label>
                        <select name="status_pb_u" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->status_pb_u=='Normal') selected @endif>Normal</option>
                            <option @if($balita->status_pb_u=='Pendek') selected @endif>Pendek</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Status BB/PB</label>
                        <select name="status_bb_pb" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->status_bb_pb=='Normal') selected @endif>Normal</option>
                            <option @if($balita->status_bb_pb=='Kurus') selected @endif>Kurus</option>
                            <option @if($balita->status_bb_pb=='Gemuk') selected @endif>Gemuk</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- STATUS GIZI / LILA -->
            <div class="mb-6 p-4 bg-yellow-50 rounded">
                <h3 class="text-lg font-semibold text-yellow-700 mb-4">STATUS GIZI / LILA</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="text-sm font-semibold">Status LILA</label>
                        <select name="status_lila" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->status_lila=='Normal') selected @endif>Normal</option>
                            <option @if($balita->status_lila=='Kurang') selected @endif>Kurang</option>
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
                            <option @if($balita->batuk=='Ya') selected @endif>Ya</option>
                            <option @if($balita->batuk=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Demam</label>
                        <select name="demam" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->demam=='Ya') selected @endif>Ya</option>
                            <option @if($balita->demam=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">BB Turun</label>
                        <select name="bb_turun" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->bb_turun=='Ya') selected @endif>Ya</option>
                            <option @if($balita->bb_turun=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Kontak TBC</label>
                        <select name="kontak_tbc" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->kontak_tbc=='Ya') selected @endif>Ya</option>
                            <option @if($balita->kontak_tbc=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- PERKEMBANGAN & VAKSINASI -->
            <div class="mb-6 p-4 bg-purple-50 rounded">
                <h3 class="text-lg font-semibold text-purple-700 mb-4">PERKEMBANGAN & VAKSINASI</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Perkembangan</label>
                        <select name="perkembangan" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->perkembangan=='Sesuai Umur') selected @endif>Sesuai Umur</option>
                            <option @if($balita->perkembangan=='Meragukan') selected @endif>Meragukan</option>
                            <option @if($balita->perkembangan=='Penyimpangan') selected @endif>Penyimpangan</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">ASI Eksklusif</label>
                        <select name="asi_eksklusif" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->asi_eksklusif=='Ya') selected @endif>Ya</option>
                            <option @if($balita->asi_eksklusif=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">MPASI</label>
                        <select name="mpasi" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->mpasi=='Ya') selected @endif>Ya</option>
                            <option @if($balita->mpasi=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="text-sm font-semibold">Imunisasi</label>
                        <textarea name="imunisasi" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ $balita->imunisasi }}</textarea>
                    </div>
                    <div><label class="text-sm font-semibold">Vitamin A</label>
                        <select name="vitamin_a" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->vitamin_a=='Ya') selected @endif>Ya</option>
                            <option @if($balita->vitamin_a=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Obat Cacing</label>
                        <select name="obat_cacing" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->obat_cacing=='Ya') selected @endif>Ya</option>
                            <option @if($balita->obat_cacing=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- MONITORING & EDUKASI -->
            <div class="mb-6 p-4 bg-cyan-50 rounded">
                <h3 class="text-lg font-semibold text-cyan-700 mb-4">MONITORING & EDUKASI</h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div><label class="text-sm font-semibold">Makanan Tambahan (Pangan)</label>
                        <select name="mt_pangan" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">Pilih</option>
                            <option @if($balita->mt_pangan=='Ya') selected @endif>Ya</option>
                            <option @if($balita->mt_pangan=='Tidak') selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div><label class="text-sm font-semibold">Catatan Kesehatan</label>
                        <textarea name="catatan_kesehatan" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ $balita->catatan_kesehatan }}</textarea>
                    </div>
                </div>
                <div><label class="text-sm font-semibold">Edukasi</label>
                    <textarea name="edukasi" class="w-full border rounded px-3 py-2 mt-1" rows="2">{{ $balita->edukasi }}</textarea>
                </div>
            </div>

            <!-- RUJUKAN -->
            <div class="mb-6 p-4 bg-orange-50 rounded">
                <h3 class="text-lg font-semibold text-orange-700 mb-4">RUJUKAN</h3>
                <div><label class="text-sm font-semibold">Rujukan</label>
                    <input type="text" name="rujukan" class="w-full border rounded px-3 py-2 mt-1" value="{{ $balita->rujukan }}">
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <a href="{{ route('admin.balita.index') }}" class="px-4 py-2 border rounded text-gray-700">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
