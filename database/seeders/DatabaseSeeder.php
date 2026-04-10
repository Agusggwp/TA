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
        // Buat user admin
        User::create([
            'name' => 'Admin Posyandu',
            'email' => 'admin@posyandu.local',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Buat user kader
        User::create([
            'name' => 'Kader Posyandu',
            'email' => 'kader@posyandu.local',
            'password' => bcrypt('password123'),
            'role' => 'kader',
        ]);

        // Buat user bidan
        User::create([
            'name' => 'Bidan Posyandu',
            'email' => 'bidan@posyandu.local',
            'password' => bcrypt('password123'),
            'role' => 'bidan',
        ]);
    }
}
