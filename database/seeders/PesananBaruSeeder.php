<?php

namespace Database\Seeders;

use App\Models\DataPesanan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PesananBaruSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggan = User::firstOrCreate(
            ['email' => 'pelanggan.dashboard@hunter.com'],
            [
                'name' => 'Pelanggan Dashboard',
                'password' => Hash::make('123'),
                'role' => 'user',
            ]
        );

        DataPesanan::updateOrCreate(
            [
                'user_id' => $pelanggan->id,
                'nama_layanan' => 'Pesanan Baru - Servis Berkala',
            ],
            [
                'total_harga' => 250000,
                'status' => 'baru',
                'created_at' => now(),
            ]
        );
    }
}
