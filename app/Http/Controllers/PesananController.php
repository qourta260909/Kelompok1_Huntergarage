<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $daftarPesanan = DB::table('tb_pesanan')
            ->leftJoin('users', 'users.id', '=', 'tb_pesanan.user_id')
            ->select(
                'tb_pesanan.*',
                DB::raw('COALESCE(tb_pesanan.nama_pelanggan, users.name) as nama_pelanggan_tampil')
            )
            ->orderBy('tb_pesanan.id', 'asc')
            ->get();

        return view('dashboard_pesanan', compact('daftarPesanan'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        if ($request->has('total_harga')) {
            $request->merge([
                'total_harga' => preg_replace('/[^\d]/', '', (string) $request->input('total_harga')),
            ]);
        }

        $validated = $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'in:layanan,produk'],
            'nama_layanan' => ['required', 'string', 'max:255'],
            'jadwal_service' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $time = \Carbon\Carbon::parse($value)->format('H:i');
                    if ($time < '08:00' || $time > '22:00') {
                        $fail('Jam service hanya tersedia antara pukul 08:00 pagi hingga 22:00 malam.');
                    }
                },
            ],
            'total_harga' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:baru,proses,selesai'],
        ]);

        Pesanan::create($validated);

        return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        if ($request->has('total_harga')) {
            $request->merge([
                'total_harga' => preg_replace('/[^\d]/', '', (string) $request->input('total_harga')),
            ]);
        }

        $validated = $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'in:layanan,produk'],
            'nama_layanan' => ['required', 'string', 'max:255'],
            'jadwal_service' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $time = \Carbon\Carbon::parse($value)->format('H:i');
                    if ($time < '08:00' || $time > '22:00') {
                        $fail('Jam service hanya tersedia antara pukul 08:00 pagi hingga 22:00 malam.');
                    }
                },
            ],
            'total_harga' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:baru,proses,selesai'],
        ]);

        $pesanan->update($validated);

        return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Pesanan $pesanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $pesanan->delete();

        return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil dihapus.');
    }
}
