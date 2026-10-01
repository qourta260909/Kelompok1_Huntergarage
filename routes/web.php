<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

// Jalur Halaman Depan (Untuk User)
Route::get('/', [HomeController::class, 'index']);

// (Route bawaan view('welcome') SUDAH DIHAPUS supaya ga bentrok)

// Dashboard (Untuk Admin) dengan Logika Percabangan
Route::get('/dashboard', function () {
    // Cek apakah pengguna yang sedang login memiliki role 'admin'
    if (auth()->user()->role === 'admin') {
        // Jika Admin, silakan masuk ke halaman dashboard
        return view('dashboard'); 
    }
    
    // Jika BUKAN admin (berarti user biasa), langsung tendang kembali ke halaman depan
    return redirect('/'); 
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Jalur Profile (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

// 4. Jalur Layanan
Route::get('/layanan', [LayananController::class, 'index']); 

// 5. Jalur Keamanan bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';