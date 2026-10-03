<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Models\User;         // <-- Tambahkan ini agar bisa memanggil tabel users
use App\Models\DataLayanan;  // <-- Tambahkan ini agar bisa memanggil tabel layanan

// Jalur Halaman Depan (Untuk User)
Route::get('/', [HomeController::class, 'index']);

// Dashboard (Untuk Admin) dengan Logika Percabangan & Pengambilan Data
Route::get('/dashboard', function () {
    // Cek apakah pengguna yang sedang login memiliki role 'admin'
    if (auth()->user()->role === 'admin') {
        
        // 1. KOKI MENGAMBIL DATA
        // Hitung total user biasa
        $totalPelanggan = User::where('role', 'user')->count();
        // Ambil 4 layanan pertama
        $dataLayanan = DataLayanan::take(4)->get();
        
        // 2. KOKI MEMBAWA DATA KE PIRING SAJI (Dashboard)
        return view('dashboard', compact('totalPelanggan', 'dataLayanan')); 
    }
    
    // Jika BUKAN admin, tendang ke home
    return redirect('/'); 
})->middleware(['auth', 'verified'])->name('dashboard');

// Jalur Profile (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

// Jalur Layanan
Route::get('/layanan', [LayananController::class, 'index']); 

// Jalur Keamanan bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';