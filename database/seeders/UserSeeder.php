<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds for admin and user accounts.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@huntergarage.com'],
            [
                'name' => 'Admin Bengkel',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'no_telepon' => '081234567890',
                'alamat' => 'Jl. Taruna Praja Banjarbaru',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@huntergarage.com'],
            [
                'name' => 'Pelanggan Hunter Garage',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'no_telepon' => '081298765432',
                'alamat' => 'Jl. A. Yani Km. 34 Banjarbaru',
                'email_verified_at' => now(),
            ]
        );
    }
}
