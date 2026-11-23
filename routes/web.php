<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Route;

// Halaman publik / pelanggan
Route::middleware(PreventBackHistory::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/layanan', [HomeController::class, 'layanan'])->name('user.layanan');
    Route::get('/produk', [HomeController::class, 'produk'])->name('user.produk');
});

// Halaman pelanggan terautentikasi
Route::middleware(['auth', 'verified', PreventBackHistory::class])->group(function () {
    Route::post('/user-pesanan', [PesananController::class, 'storeUserOrder'])->name('user.pesanan.store');
    Route::patch('/user-pesanan/{pesanan}/cancel', [PesananController::class, 'cancelUserBooking'])->name('user.pesanan.cancel');
    Route::post('/user-pesanan/{pesanan}/rating', [PesananController::class, 'storeRating'])->name('user.pesanan.rating');
    Route::get('/pesanan-saya', [PesananController::class, 'userOrders'])->name('user.pesanan');
});

// Halaman khusus Admin (dilindungi middleware role admin)
Route::middleware(['auth', 'verified', 'admin', PreventBackHistory::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::redirect('/dashboard-pemesanan', '/dashboard-pesanan');
    Route::redirect('/dashboard-profile', '/dashboard')->name('dashboard.profile');

    Route::get('/dashboard-pesanan', [PesananController::class, 'index'])->name('dashboard.pesanan');
    Route::get('/dashboard-pesanan/{pesanan}/bukti-pdf', [PesananController::class, 'downloadBuktiBooking'])->name('dashboard.pesanan.pdf');
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

    Route::get('/dashboard-riwayat', [PesananController::class, 'riwayat'])->name('dashboard.riwayat');
    Route::get('/dashboard-ulasan', [PesananController::class, 'ulasan'])->name('dashboard.ulasan');

    Route::get('/dashboard-users', [UserController::class, 'index'])->name('dashboard.users');
    Route::post('/dashboard-users', [UserController::class, 'store'])->name('dashboard.users.store');
    Route::put('/dashboard-users/{user}', [UserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/dashboard-users/{user}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');
});

// Profil akun
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
