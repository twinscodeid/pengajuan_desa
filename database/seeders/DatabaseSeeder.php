<?php

namespace Database\Seeders;

use App\Models\PegawaiDesa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        PegawaiDesa::create([
            'name' => "Admin desa 1",
            'email' => "admindesa@gmail.com",
            'jabatan' => "Staff Desa",
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);
    }
}
