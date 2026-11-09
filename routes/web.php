<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\Layanan;
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
        return view('dashboard_layanan');
    })->name('dashboard.layanan');

    Route::get('/dashboard-produk', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        return view('dashboard_produk');
    })->name('dashboard.produk');

    Route::get('/dashboard-profile', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        return view('dashboard_profile');
    })->name('dashboard.profile');

    Route::get('/dashboard-riwayat', [PesananController::class, 'riwayat'])->name('dashboard.riwayat');
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
        
        $pesananAktifQuery = DB::table('tb_pesanan')
            ->whereIn('tb_pesanan.status', ['baru', 'proses']);
        $pesananBaru = (clone $pesananAktifQuery)->count();

        $pesananSelesaiTanpaPembayaran = DB::table('tb_pesanan')
            ->where('status', 'selesai')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('tb_pembayaran')
                    ->whereColumn('tb_pembayaran.pesanan_id', 'tb_pesanan.id');
            })
            ->sum('total_harga');

        $totalPendapatan = DB::table('tb_pembayaran')
            ->where('status', 'lunas')
            ->sum('jumlah') + $pesananSelesaiTanpaPembayaran;

        $awalBulan = now()->startOfMonth();
        $awalBulanBerikutnya = $awalBulan->copy()->addMonth();
        $pendapatanBaru = DB::table('tb_pembayaran')
            ->where('status', 'lunas')
            ->where('dibayar_pada', '>=', $awalBulan)
            ->where('dibayar_pada', '<', $awalBulanBerikutnya)
            ->sum('jumlah') + $pesananSelesaiTanpaPembayaran;

        $pesananTerbaru = (clone $pesananAktifQuery)
            ->leftJoin('users', 'users.id', '=', 'tb_pesanan.user_id')
            ->select(
                'tb_pesanan.*',
                DB::raw('COALESCE(tb_pesanan.nama_pelanggan, users.name) as nama_pelanggan')
            )
            ->orderBy('tb_pesanan.id', 'asc')
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
    
    return redirect('/'); 
})->middleware(['auth', 'verified', \App\Http\Middleware\PreventBackHistory::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

Route::get('/layanan', [LayananController::class, 'index']); 

require __DIR__.'/auth.php';
