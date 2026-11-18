<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\Layanan;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

Route::middleware(['auth', 'verified', \App\Http\Middleware\PreventBackHistory::class])->group(function () {
    Route::redirect('/dashboard-pemesanan', '/dashboard-pesanan');

    Route::get('/dashboard-pesanan', [PesananController::class, 'index'])->name('dashboard.pesanan');
    Route::post('/dashboard-pesanan', [PesananController::class, 'store'])->name('dashboard.pesanan.store');
    Route::patch('/dashboard-pesanan/{pesanan}/status', [PesananController::class, 'updateStatus'])->name('dashboard.pesanan.status');
    Route::put('/dashboard-pesanan/{pesanan}', [PesananController::class, 'update'])->name('dashboard.pesanan.update');
    Route::delete('/dashboard-pesanan/{pesanan}', [PesananController::class, 'destroy'])->name('dashboard.pesanan.destroy');

    Route::get('/dashboard-layanan', [LayananController::class, 'index'])->name('dashboard.layanan');
    Route::post('/dashboard-layanan', [LayananController::class, 'store'])->name('dashboard.layanan.store');
    Route::put('/dashboard-layanan/{layanan}', [LayananController::class, 'update'])->name('dashboard.layanan.update');
    Route::delete('/dashboard-layanan/{layanan}', [LayananController::class, 'destroy'])->name('dashboard.layanan.destroy');

    Route::get('/dashboard-produk', [ProdukController::class, 'index'])->name('dashboard.produk');
    Route::post('/dashboard-produk', [ProdukController::class, 'store'])->name('dashboard.produk.store');
    Route::put('/dashboard-produk/{produk}', [ProdukController::class, 'update'])->name('dashboard.produk.update');
    Route::delete('/dashboard-produk/{produk}', [ProdukController::class, 'destroy'])->name('dashboard.produk.destroy');

    Route::redirect('/dashboard-profile', '/dashboard')->name('dashboard.profile');

    Route::get('/dashboard-riwayat', [PesananController::class, 'riwayat'])->name('dashboard.riwayat');

    Route::post('/user-pesanan', [PesananController::class, 'storeUserOrder'])->name('user.pesanan.store');
    Route::get('/pesanan-saya', function () {
        $layananAktif = Layanan::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $produkAktif = Produk::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $pesananUser = Pesanan::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        $activePage = 'pesanan';

        return view('user_home', compact('layananAktif', 'produkAktif', 'pesananUser', 'activePage'));
    })->name('user.pesanan');
});

$renderPublicUserPage = function (string $activePage) {
    $layananAktif = Layanan::where('status', 'aktif')->orderBy('id', 'asc')->get();
    $produkAktif = Produk::where('status', 'aktif')->orderBy('id', 'asc')->get();
    $pesananUser = auth()->check()
        ? Pesanan::where('user_id', auth()->id())->orderBy('id', 'desc')->get()
        : collect();

    return view('user_home', compact('layananAktif', 'produkAktif', 'pesananUser', 'activePage'));
};

Route::get('/', fn () => $renderPublicUserPage('beranda'))
    ->middleware(\App\Http\Middleware\PreventBackHistory::class)
    ->name('home');

Route::get('/layanan', fn () => $renderPublicUserPage('layanan'))
    ->middleware(\App\Http\Middleware\PreventBackHistory::class)
    ->name('user.layanan');

Route::get('/produk', fn () => $renderPublicUserPage('produk'))
    ->middleware(\App\Http\Middleware\PreventBackHistory::class)
    ->name('user.produk');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
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
    
    return redirect()->route('home')->withErrors(['akses' => 'Halaman Dashboard hanya dapat diakses menggunakan akun Admin.']);
})->middleware(['auth', 'verified', \App\Http\Middleware\PreventBackHistory::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
