<?php

namespace Database\Seeders;

use App\Models\DataPesanan;
use App\Models\RiwayatPembayaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PendapatanBaruSeeder extends Seeder
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

        $pesanan = DataPesanan::updateOrCreate(
            [
                'user_id' => $pelanggan->id,
                'nama_layanan' => 'Servis',
            ],
            [
                'total_harga' => 350000,
                'status' => 'selesai',
                'created_at' => now()->startOfMonth(),
            ]
        );

        RiwayatPembayaran::updateOrCreate(
            ['data_pesanan_id' => $pesanan->id],
            [
                'jumlah' => 250000,
                'status' => 'lunas',
                'dibayar_pada' => now()->startOfMonth(),
            ]
        );
    }
}