<?php

namespace Database\Seeders;

use App\Models\KepalaKeluarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepalaKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat data kepala keluarga
        KepalaKeluarga::create([
            'nama_lengkap' => 'Bapak Suryanto',
            'email' => 'suryanto@posyandu.local',
            'no_kk' => '3501111234567890',
            'alamat' => 'Jl. Merdeka No. 123, Kelurahan Sukodono',
            'no_telepon' => '081234567890',
        ]);

        KepalaKeluarga::create([
            'nama_lengkap' => 'Ibu Siti Nurhaliza',
            'email' => 'siti.nurhaliza@posyandu.local',
            'no_kk' => '3501111234567891',
            'alamat' => 'Jl. Ahmad Yani No. 45, Kelurahan Sukodono',
            'no_telepon' => '081234567891',
        ]);

        KepalaKeluarga::create([
            'nama_lengkap' => 'Pak Haryanto',
            'email' => 'haryanto@posyandu.local',
            'no_kk' => '3501111234567892',
            'alamat' => 'Jl. Diponegoro No. 78, Kelurahan Sukodono',
            'no_telepon' => '081234567892',
        ]);
    }
}
