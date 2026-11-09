<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Models\User;
use App\Models\Layanan;
use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;

Route::middleware(['auth', 'verified', \App\Http\Middleware\PreventBackHistory::class])->group(function () {
    Route::redirect('/dashboard-pemesanan', '/dashboard-pesanan');

    Route::get('/dashboard-pesanan', [PesananController::class, 'index'])->name('dashboard.pesanan');
    Route::put('/dashboard-pesanan/{pesanan}', [PesananController::class, 'update'])->name('dashboard.pesanan.update');

    Route::get('/dashboard-layanan', [LayananController::class, 'index'])->name('dashboard.layanan');
    Route::post('/dashboard-layanan', [LayananController::class, 'store'])->name('dashboard.layanan.store');
    Route::put('/dashboard-layanan/{layanan}', [LayananController::class, 'update'])->name('dashboard.layanan.update');
    Route::delete('/dashboard-layanan/{layanan}', [LayananController::class, 'destroy'])->name('dashboard.layanan.destroy');

    Route::get('/dashboard-produk', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $produk = Produk::query()
            ->with('stok')
            ->orderBy('nama_produk')
            ->get();
        $totalProduk = $produk->count();
        $totalStok = (int) Stok::sum('jumlah_stok');
        $produkMenipis = Stok::query()
            ->whereColumn('jumlah_stok', '<=', 'stok_minimum')
            ->count();

        return view('dashboard_produk', compact('produk', 'totalProduk', 'totalStok', 'produkMenipis'));
    })->name('dashboard.produk');

    Route::get('/dashboard-riwayat', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $pesananRiwayatQuery = DB::table('tb_pesanan')
            ->leftJoin('users', 'users.id', '=', 'tb_pesanan.user_id')
            ->whereIn('tb_pesanan.status', ['diterima', 'ditolak', 'selesai']);

        $totalRiwayat = (clone $pesananRiwayatQuery)->count();
        $totalDiterima = (clone $pesananRiwayatQuery)->whereIn('tb_pesanan.status', ['diterima', 'selesai'])->count();
        $totalDitolak = (clone $pesananRiwayatQuery)->where('tb_pesanan.status', 'ditolak')->count();
        $nilaiPesananSelesai = (clone $pesananRiwayatQuery)
            ->whereIn('tb_pesanan.status', ['diterima', 'selesai'])
            ->sum('tb_pesanan.total_harga');

        $pesananSelesai = $pesananRiwayatQuery
            ->select(
                'tb_pesanan.*',
                DB::raw('COALESCE(tb_pesanan.nama_pelanggan, users.name) as nama_pelanggan')
            )
            ->orderByDesc('tb_pesanan.updated_at')
            ->orderByDesc('tb_pesanan.id')
            ->get();

        return view('dashboard_riwayat', compact(
            'pesananSelesai',
            'totalRiwayat',
            'totalDiterima',
            'totalDitolak',
            'nilaiPesananSelesai'
        ));
    })->name('dashboard.riwayat');
});

Route::get('/', function (\Illuminate\Http\Request $request) {
    if (auth()->check() && auth()->user()->role === 'admin') {
        \Illuminate\Support\Facades\Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    return view('welcome');
})->middleware(\App\Http\Middleware\PreventBackHistory::class);

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        $totalPelanggan = User::where('role', 'user')->count();
        $dataLayanan = Layanan::take(4)->get();
        $totalLayanan = Layanan::count();
        $totalProduk = Produk::count();
        $totalStok = (int) Stok::sum('jumlah_stok');
        $jumlahProdukMenipis = Stok::query()
            ->whereColumn('jumlah_stok', '<=', 'stok_minimum')
            ->count();
        $produkMenipis = Produk::query()
            ->with('stok')
            ->whereHas('stok', function ($query) {
                $query->whereColumn('jumlah_stok', '<=', 'stok_minimum');
            })
            ->orderBy('nama_produk')
            ->limit(4)
            ->get();
        
        $pesananBaruQuery = DB::table('tb_pesanan')
            ->whereIn('status', ['menunggu', 'baru']);
        $pesananBaru = (clone $pesananBaruQuery)->count();

        $totalPendapatan = DB::table('tb_pembayaran')
            ->where('status', 'lunas')
            ->sum('jumlah');

        $awalBulan = now()->startOfMonth();
        $awalBulanBerikutnya = $awalBulan->copy()->addMonth();
        $pendapatanBaru = DB::table('tb_pembayaran')
            ->where('status', 'lunas')
            ->where('dibayar_pada', '>=', $awalBulan)
            ->where('dibayar_pada', '<', $awalBulanBerikutnya)
            ->sum('jumlah');

        $pesananTerbaru = (clone $pesananBaruQuery)
            ->leftJoin('users', 'users.id', '=', 'tb_pesanan.user_id')
            ->select(
                'tb_pesanan.*',
                DB::raw('COALESCE(tb_pesanan.nama_pelanggan, users.name) as nama_pelanggan')
            )
            ->orderByDesc('tb_pesanan.created_at')
            ->orderByDesc('tb_pesanan.id')
            ->get();

        return view('dashboard', compact(
            'totalPelanggan',
            'dataLayanan',
            'totalLayanan',
            'totalProduk',
            'totalStok',
            'jumlahProdukMenipis',
            'produkMenipis',
            'pesananBaru',
            'totalPendapatan',
            'pendapatanBaru',
            'pesananTerbaru'
        ));
    }
    
    return redirect('/'); 
})->middleware(['auth', 'verified', \App\Http\Middleware\PreventBackHistory::class])->name('dashboard');

Route::get('/layanan', [LayananController::class, 'index']); 

require __DIR__.'/auth.php';
