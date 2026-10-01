<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Bikin akun Admin
        User::create([
            'name' => 'Admin Bengkel',
            'email' => 'admin@hunter.com',
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);

        // Bikin akun User biasa
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'user@hunter.com',
            'password' => Hash::make('123'),
            'role' => 'user'
        ]);
    }
}