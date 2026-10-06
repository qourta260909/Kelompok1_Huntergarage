<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@hunter.com'],
            [
                'name' => 'Admin Bengkel',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ]
        );

        $this->call([
            PelangganAktifSeeder::class,
            PesananBaruSeeder::class,
            TotalPendapatanSeeder::class,
            PendapatanBaruSeeder::class,
        ]);
    }
}