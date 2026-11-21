<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('welcome', compact('layananAktif', 'produkAktif', 'pesananUser'));
    }

    public function layanan()
    {
        $layananAktif = Layanan::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $produkAktif = Produk::where('status', 'aktif')->orderBy('id', 'asc')->get();

        return view('layanan', compact('layananAktif', 'produkAktif'));
    }

    public function produk()
    {
        $layananAktif = Layanan::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $produkAktif = Produk::where('status', 'aktif')->orderBy('id', 'asc')->get();

        return view('produk', compact('layananAktif', 'produkAktif'));
    }
}
