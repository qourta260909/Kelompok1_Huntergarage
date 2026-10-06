<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PelangganAktifSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'pelanggana.dashboard@hunter.com'],
            [
                'name' => 'Pelanggana Dashboard',
                'password' => Hash::make('123'),
                'role' => 'user',
            ]

        );
    }
}
