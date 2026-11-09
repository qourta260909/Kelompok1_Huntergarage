<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $daftarPesanan = DB::table('tb_pesanan')
            ->leftJoin('users', 'users.id', '=', 'tb_pesanan.user_id')
            ->whereIn('tb_pesanan.status', ['menunggu', 'baru'])
            ->select(
                'tb_pesanan.*',
                DB::raw('COALESCE(tb_pesanan.nama_pelanggan, users.name) as nama_pelanggan_tampil')
            )
            ->orderBy('tb_pesanan.id', 'asc')
            ->get();

        return view('dashboard_pesanan', compact('daftarPesanan'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $validated = $request->validate([
            'status' => ['required', 'in:diterima,ditolak'],
        ]);

        $pesanan->update([
            'status' => $validated['status'],
        ]);

        $pesanStatus = $validated['status'] === 'diterima'
            ? 'Pesanan berhasil diterima dan masuk ke riwayat.'
            : 'Pesanan telah ditolak dan masuk ke riwayat.';

        return redirect()->route('dashboard.pesanan')->with('success', $pesanStatus);
    }
}

