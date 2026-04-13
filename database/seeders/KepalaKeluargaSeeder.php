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
        // Buat data kepala keluarga (skip jika sudah ada)
        KepalaKeluarga::updateOrCreate(
            ['email' => 'suryanto@posyandu.local'],
            [
                'nama_lengkap' => 'Bapak Suryanto',
                'no_kk' => '3501111234567890',
                'alamat' => 'Jl. Merdeka No. 123, Kelurahan Sukodono',
                'no_telepon' => '081234567890',
            ]
        );

        KepalaKeluarga::updateOrCreate(
            ['email' => 'siti.nurhaliza@posyandu.local'],
            [
                'nama_lengkap' => 'Ibu Siti Nurhaliza',
                'no_kk' => '3501111234567891',
                'alamat' => 'Jl. Ahmad Yani No. 45, Kelurahan Sukodono',
                'no_telepon' => '081234567891',
            ]
        );

        KepalaKeluarga::updateOrCreate(
            ['email' => 'haryanto@posyandu.local'],
            [
                'nama_lengkap' => 'Pak Haryanto',
                'no_kk' => '3501111234567892',
                'alamat' => 'Jl. Diponegoro No. 78, Kelurahan Sukodono',
                'no_telepon' => '081234567892',
            ]
        );
    }
}
