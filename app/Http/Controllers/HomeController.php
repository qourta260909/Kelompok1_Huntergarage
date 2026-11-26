<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Kendaraan;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $layananAktif = Layanan::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $produkAktif = Produk::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $pesananUser = Auth::check()
            ? Pesanan::where('user_id', Auth::id())->orderBy('id', 'desc')->get()
            : collect();

        $totalRating = Pesanan::whereNotNull('rating')->count();
        $rataRataRating = $totalRating > 0
            ? round((float) Pesanan::whereNotNull('rating')->avg('rating'), 1)
            : 0.0;
        $ratingPuas = Pesanan::whereNotNull('rating')->where('rating', '>=', 4)->count();
        $persenPelangganPuas = $totalRating > 0
            ? (int) round(($ratingPuas / $totalRating) * 100)
            : 0;
        $kendaraanBulanIni = Pesanan::where('kategori', 'layanan')
            ->where('status', 'selesai')
            ->whereYear('updated_at', now()->year)
            ->whereMonth('updated_at', now()->month)
            ->count();

        return view('welcome', compact(
            'layananAktif',
            'produkAktif',
            'pesananUser',
            'rataRataRating',
            'kendaraanBulanIni',
            'persenPelangganPuas'
        ));
    }

    public function layanan()
    {
        $layananAktif = Layanan::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $produkAktif = Produk::where('status', 'aktif')->orderBy('id', 'asc')->get();

        if (Schema::hasTable('tb_kendaraan')) {
            if (Kendaraan::count() < 80) {
                Kendaraan::syncFromBrandCatalog();
            }
            $daftarKendaraan = Kendaraan::orderBy('merek', 'asc')->orderBy('jenis_kendaraan', 'asc')->orderBy('model', 'asc')->get();
        } else {
            $daftarKendaraan = collect();
        }

        return view('layanan', compact('layananAktif', 'produkAktif', 'daftarKendaraan'));
    }

    public function produk()
    {
        $layananAktif = Layanan::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $produkAktif = Produk::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $daftarKategoriProduk = Schema::hasTable('tb_kategori_produk')
            ? KategoriProduk::orderBy('nama_kategori', 'asc')->get()
            : collect();

        return view('produk', compact('layananAktif', 'produkAktif', 'daftarKategoriProduk'));
    }
}
