<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user admin (skip jika sudah ada)
        User::updateOrCreate(
            ['email' => 'admin@posyandu.local'],
            [
                'name' => 'Admin Posyandu',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ]
        );

        // Buat user kader (skip jika sudah ada)
        User::updateOrCreate(
            ['email' => 'kader@posyandu.local'],
            [
                'name' => 'Kader Posyandu',
                'password' => bcrypt('password123'),
                'role' => 'kader',
            ]
        );

        // Buat user bidan (skip jika sudah ada)
        User::updateOrCreate(
            ['email' => 'bidan@posyandu.local'],
            [
                'name' => 'Bidan Posyandu',
                'password' => bcrypt('password123'),
                'role' => 'bidan',
            ]
        );

        // Buat kepala keluarga
        $this->call(KepalaKeluargaSeeder::class);

        // Seed data kesehatan - WORKING SEEDERS
        $this->call(IbuHamilSeeder::class);
        $this->call(NifasSeeder::class);
        $this->call(BalitaSeeder::class);

        // Seed remaining health data - ALL FIXED
        $this->call(RemajaSeeder::class);
        $this->call(DewasaSeeder::class);
    }
}
