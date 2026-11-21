<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendapatan = (int) DB::table('tb_pesanan')
            ->where('status', 'selesai')
            ->sum('total_harga');

        $totalPesanan = DB::table('tb_pesanan')->count();

        $pesananTerbaru = Pesanan::with(['user', 'jadwalService', 'layanan', 'produk', 'details.produk'])
            ->whereIn('status', ['baru', 'proses'])
            ->orderBy('id', 'asc')
            ->get()
            ->map(function (Pesanan $pesanan) {
                $pesanan->nama_pelanggan = $pesanan->nama_pelanggan ?: ($pesanan->user->name ?? 'Pelanggan');
                return $pesanan;
            });

        return view('dashboard', compact(
            'totalPendapatan',
            'totalPesanan',
            'pesananTerbaru'
        ));
    }
}
