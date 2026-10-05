<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat akun Admin
        User::create([
            'name' => 'Admin Bengkel',
            'email' => 'admin@hunter.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        // 2. Membuat akun Pelanggan/User biasa
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'user@hunter.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);
    }
}