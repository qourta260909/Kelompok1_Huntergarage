<?php

namespace Database\Seeders;

use App\Models\DataPesanan;
use App\Models\RiwayatPembayaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TotalPendapatanSeeder extends Seeder
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
                'nama_layanan' => 'Seeder - Pendapatan Sebelumnya',
            ],
            [
                'total_harga' => 750000,
                'status' => 'selesai',
                'created_at' => now()->subMonth()->startOfMonth(),
            ]
        );

        RiwayatPembayaran::updateOrCreate(
            ['data_pesanan_id' => $pesanan->id],
            [
                'jumlah' => 750000,
                'status' => 'lunas',
                'dibayar_pada' => now()->subMonth()->startOfMonth(),
            ]
        );
    }
}
