<?php

namespace Database\Seeders;

use App\Models\IbuHamil;
use App\Models\KepalaKeluarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IbuHamilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kepalaKeluarga = KepalaKeluarga::all();

        // Data Ibu Hamil 1
        IbuHamil::create([
            'kepala_keluarga_id' => $kepalaKeluarga->first()->id,
            'nik' => '3501123456789012',
            'nama_ibu' => 'Ibu Dewi Lestari',
            'tanggal_lahir' => '1990-05-15',
            'umur' => '35',
            'nama_suami' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 123',
            'no_hp' => '081234567890',
            'l_ibu_hamil' => 'Normal',
            'kehamilan_ke' => 2,
            'jarak_anak_sebelumnya' => '3 tahun',
            'tinggi_badan' => 160.5,
            'berat_badan' => 68.5,
            'lingkar_lengan' => 28.5,
            'tekanan_darah' => '120/80',
            'denyut_jantung' => '78',
            'kondisi_ibu' => 'Sehat',
            'keluhan' => 'Pusing ringan',
            'tanggal_kunjungan' => '2026-04-10',
            'waktu_ke_posyandu' => 'Pagi',
            'petugas' => 'Bidan Sari',
            'catatan' => 'Pemeriksaan awal kehamilan, hasil baik',
        ]);

        // Data Ibu Hamil 2
        IbuHamil::create([
            'kepala_keluarga_id' => $kepalaKeluarga->skip(1)->first()->id,
            'nik' => '3501234567890123',
            'nama_ibu' => 'Ibu Nur Cahaya',
            'tanggal_lahir' => '1992-08-20',
            'umur' => '33',
            'nama_suami' => 'Ahmad Wijaya',
            'alamat' => 'Jl. Ahmad Yani No. 45',
            'no_hp' => '081234567891',
            'l_ibu_hamil' => 'Normal',
            'kehamilan_ke' => 3,
            'jarak_anak_sebelumnya' => '2 tahun',
            'tinggi_badan' => 156.0,
            'berat_badan' => 65.0,
            'lingkar_lengan' => 27.5,
            'tekanan_darah' => '115/75',
            'denyut_jantung' => '80',
            'kondisi_ibu' => 'Sehat',
            'keluhan' => 'Tidak ada',
            'tanggal_kunjungan' => '2026-04-08',
            'waktu_ke_posyandu' => 'Sore',
            'petugas' => 'Bidan Sari',
            'catatan' => 'Kehamilan berjalan normal, semua parameter dalam batas normal',
        ]);

        // Data Ibu Hamil 3
        IbuHamil::create([
            'kepala_keluarga_id' => $kepalaKeluarga->skip(2)->first()->id,
            'nik' => '3501345678901234',
            'nama_ibu' => 'Ibu Sinta Kusuma',
            'tanggal_lahir' => '1995-03-10',
            'umur' => '30',
            'nama_suami' => 'Raka Pratama',
            'alamat' => 'Jl. Diponegoro No. 78',
            'no_hp' => '081234567892',
            'l_ibu_hamil' => 'Normal',
            'kehamilan_ke' => 1,
            'jarak_anak_sebelumnya' => '-',
            'tinggi_badan' => 162.0,
            'berat_badan' => 70.0,
            'lingkar_lengan' => 29.0,
            'tekanan_darah' => '118/78',
            'denyut_jantung' => '76',
            'kondisi_ibu' => 'Sehat',
            'keluhan' => 'Mual ringan',
            'tanggal_kunjungan' => '2026-04-12',
            'waktu_ke_posyandu' => 'Pagi',
            'petugas' => 'Bidan Sari',
            'catatan' => 'Kehamilan pertama, edukasi tentang nutrisi dan istirahat',
        ]);

        // RIWAYAT PEMERIKSAAN - DUPLIKAT DATA (untuk tracking history)
        // Ibu Hamil 1 - Pemeriksaan ke-2 (minggu ke-3)
        IbuHamil::create([
            'kepala_keluarga_id' => $kepalaKeluarga->first()->id,
            'nik' => '3501123456789012',
            'nama_ibu' => 'Ibu Dewi Lestari',
            'tanggal_lahir' => '1990-05-15',
            'umur' => '35',
            'nama_suami' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 123',
            'no_hp' => '081234567890',
            'l_ibu_hamil' => 'Normal',
            'kehamilan_ke' => 2,
            'jarak_anak_sebelumnya' => '3 tahun',
            'tinggi_badan' => 160.5,
            'berat_badan' => 70.0,
            'lingkar_lengan' => 29.0,
            'tekanan_darah' => '122/82',
            'denyut_jantung' => '80',
            'kondisi_ibu' => 'Sehat',
            'keluhan' => 'Pusing berkurang',
            'tanggal_kunjungan' => '2026-04-24',
            'waktu_ke_posyandu' => 'Pagi',
            'petugas' => 'Bidan Sari',
            'catatan' => 'Pemeriksaan kedua kehamilan, berat naik 1.5 kg, hasil tetap baik',
        ]);

        // Ibu Hamil 2 - Pemeriksaan ke-2 (minggu ke-4)
        IbuHamil::create([
            'kepala_keluarga_id' => $kepalaKeluarga->skip(1)->first()->id,
            'nik' => '3501234567890123',
            'nama_ibu' => 'Ibu Nur Cahaya',
            'tanggal_lahir' => '1992-08-20',
            'umur' => '33',
            'nama_suami' => 'Ahmad Wijaya',
            'alamat' => 'Jl. Ahmad Yani No. 45',
            'no_hp' => '081234567891',
            'l_ibu_hamil' => 'Normal',
            'kehamilan_ke' => 3,
            'jarak_anak_sebelumnya' => '2 tahun',
            'tinggi_badan' => 156.0,
            'berat_badan' => 67.5,
            'lingkar_lengan' => 28.0,
            'tekanan_darah' => '116/76',
            'denyut_jantung' => '82',
            'kondisi_ibu' => 'Sehat',
            'keluhan' => 'Tidak ada',
            'tanggal_kunjungan' => '2026-04-22',
            'waktu_ke_posyandu' => 'Sore',
            'petugas' => 'Bidan Sari',
            'catatan' => 'Kehamilan progresif normal, berat naik 2.5 kg, parameter tetap baik',
        ]);

        // Ibu Hamil 1 - Pemeriksaan ke-3 (minggu ke-6)
        IbuHamil::create([
            'kepala_keluarga_id' => $kepalaKeluarga->first()->id,
            'nik' => '3501123456789012',
            'nama_ibu' => 'Ibu Dewi Lestari',
            'tanggal_lahir' => '1990-05-15',
            'umur' => '35',
            'nama_suami' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 123',
            'no_hp' => '081234567890',
            'l_ibu_hamil' => 'Normal',
            'kehamilan_ke' => 2,
            'jarak_anak_sebelumnya' => '3 tahun',
            'tinggi_badan' => 160.5,
            'berat_badan' => 72.5,
            'lingkar_lengan' => 29.5,
            'tekanan_darah' => '120/80',
            'denyut_jantung' => '78',
            'kondisi_ibu' => 'Sehat',
            'keluhan' => 'Tidak ada',
            'tanggal_kunjungan' => '2026-03-27',
            'waktu_ke_posyandu' => 'Pagi',
            'petugas' => 'Bidan Sari',
            'catatan' => 'Pemeriksaan ketiga, kehamilan berjalan normal, persiapan persalinan',
        ]);
    }
}
