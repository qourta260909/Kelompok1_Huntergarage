<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pesananAktifQuery = DB::table('tb_pesanan')
            ->whereIn('tb_pesanan.status', ['baru', 'proses']);

        $totalPendapatan = (int) DB::table('tb_pesanan')
            ->where('status', 'selesai')
            ->sum('total_harga');

        $totalPesanan = DB::table('tb_pesanan')->count();

        $pesananTerbaru = (clone $pesananAktifQuery)
            ->leftJoin('users', 'users.id', '=', 'tb_pesanan.user_id')
            ->select(
                'tb_pesanan.*',
                DB::raw('COALESCE(tb_pesanan.nama_pelanggan, users.name) as nama_pelanggan')
            )
            ->orderBy('tb_pesanan.id', 'asc')
            ->get();

        return view('dashboard', compact(
            'totalPendapatan',
            'totalPesanan',
            'pesananTerbaru'
        ));
    }
}
