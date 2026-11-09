<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Menampilkan daftar layanan bengkel.
     */
    public function index()
    {
        $layanans = Layanan::all();
        return view('dashboard_layanan', compact('layanans'));
    }
}
