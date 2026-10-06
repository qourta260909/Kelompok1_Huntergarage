<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\DataLayanan;
use Illuminate\Support\Facades\DB;




Route::get('/dashboard-pemesanan', function () {
    return view('dashboard_pemesanan');
})->name('dashboard.pemesanan');

Route::get('/dashboard-layanan', function () {
    return view('dashboard_layanan');
})->name('dashboard.layanan');

Route::get('/dashboard-produk', function () {
    return view('dashboard_produk');
})->name('dashboard.produk');

Route::get('/dashboard-profile', function () {
    return view('dashboard_profile');
})->name('dashboard.profile');

Route::get('/dashboard-riwayat', function () {
    return view('dashboard_riwayat');
})->name('dashboard.riwayat');



// Jalur Halaman Depan (Untuk User)
Route::view('/', 'welcome');

// Dashboard (Untuk Admin) dengan Logika Percabangan & Pengambilan Data
Route::get('/dashboard', function () {
    // Cek apakah pengguna yang sedang login memiliki role 'admin'
    if (auth()->user()->role === 'admin') {
        $totalPelanggan = User::where('role', 'user')->count();
        $dataLayanan = DataLayanan::take(4)->get();
        $pesananBaru = DB::table('data_pesanans')
            ->whereDate('created_at', today())
            ->count();

        $totalPendapatan = DB::table('riwayat_pembayarans')
            ->where('status', 'lunas')
            ->sum('jumlah');

        $awalBulan = now()->startOfMonth();
        $awalBulanBerikutnya = $awalBulan->copy()->addMonth();
        $pendapatanBaru = DB::table('riwayat_pembayarans')
            ->where('status', 'lunas')
            ->where('dibayar_pada', '>=', $awalBulan)
            ->where('dibayar_pada', '<', $awalBulanBerikutnya)
            ->sum('jumlah');

        $pesananTerbaru = DB::table('data_pesanans')
            ->leftJoin('users', 'users.id', '=', 'data_pesanans.user_id')
            ->select('data_pesanans.*', 'users.name as nama_pelanggan')
            ->orderByDesc('data_pesanans.created_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalPelanggan',
            'dataLayanan',
            'pesananBaru',
            'totalPendapatan',
            'pendapatanBaru',
            'pesananTerbaru'
        ));
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