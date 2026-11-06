<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\Layanan;
use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;

Route::middleware(['auth', 'verified', \App\Http\Middleware\PreventBackHistory::class])->group(function () {
    Route::redirect('/dashboard-pemesanan', '/dashboard-pesanan');

    Route::get('/dashboard-pesanan', [PesananController::class, 'index'])->name('dashboard.pesanan');
    Route::post('/dashboard-pesanan', [PesananController::class, 'store'])->name('dashboard.pesanan.store');
    Route::put('/dashboard-pesanan/{pesanan}', [PesananController::class, 'update'])->name('dashboard.pesanan.update');
    Route::delete('/dashboard-pesanan/{pesanan}', [PesananController::class, 'destroy'])->name('dashboard.pesanan.destroy');

    Route::get('/dashboard-layanan', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $layanan = Layanan::query()
            ->withCount('riwayatLayanan')
            ->orderBy('nama_layanan')
            ->get();

        return view('dashboard_layanan', compact('layanan'));
    })->name('dashboard.layanan');

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

    Route::get('/dashboard-profile', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        return view('dashboard_profile');
    })->name('dashboard.profile');

    Route::get('/dashboard-riwayat', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $pesananSelesaiQuery = DB::table('tb_pesanan')
            ->leftJoin('users', 'users.id', '=', 'tb_pesanan.user_id')
            ->where('tb_pesanan.status', 'selesai');
        $totalRiwayat = (clone $pesananSelesaiQuery)->count();
        $nilaiPesananSelesai = (clone $pesananSelesaiQuery)->sum('tb_pesanan.total_harga');
        $pesananSelesai = $pesananSelesaiQuery
            ->select(
                'tb_pesanan.*',
                DB::raw('COALESCE(tb_pesanan.nama_pelanggan, users.name) as nama_pelanggan')
            )
            ->orderByDesc('tb_pesanan.updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('dashboard_riwayat', compact('pesananSelesai', 'totalRiwayat', 'nilaiPesananSelesai'));
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
            ->where('status', 'baru');
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

Route::get('/layanan', [LayananController::class, 'index']); 

require __DIR__.'/auth.php';
