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
            ->whereIn('tb_pesanan.status', ['baru', 'proses'])
            ->orderBy('tb_pesanan.id', 'asc')
            ->get();

        return view('dashboard_pesanan', compact('daftarPesanan'));
    }

    public function riwayat()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $daftarRiwayat = DB::table('tb_pesanan')
            ->leftJoin('users', 'users.id', '=', 'tb_pesanan.user_id')
            ->select(
                'tb_pesanan.*',
                DB::raw('COALESCE(tb_pesanan.nama_pelanggan, users.name) as nama_pelanggan_tampil')
            )
            ->whereIn('tb_pesanan.status', ['selesai', 'dibatalkan'])
            ->orderBy('tb_pesanan.id', 'asc')
            ->get();

        return view('dashboard_riwayat', compact('daftarRiwayat'));
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
            'status' => ['required', 'in:baru,proses,selesai,dibatalkan'],
        ]);

        $pesanan = Pesanan::create($validated);
        $this->syncPembayaran($pesanan);

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
            'status' => ['required', 'in:baru,proses,selesai,dibatalkan'],
        ]);

        $pesanan->update($validated);
        $this->syncPembayaran($pesanan);

        return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Pesanan $pesanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        DB::table('tb_pembayaran')->where('pesanan_id', $pesanan->id)->delete();
        $pesanan->delete();

        return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil dihapus.');
    }

    private function syncPembayaran(Pesanan $pesanan): void
    {
        if ($pesanan->status === 'selesai') {
            $now = now();
            $existing = DB::table('tb_pembayaran')->where('pesanan_id', $pesanan->id)->first();

            if ($existing) {
                DB::table('tb_pembayaran')
                    ->where('pesanan_id', $pesanan->id)
                    ->update([
                        'jumlah' => $pesanan->total_harga,
                        'status' => 'lunas',
                        'dibayar_pada' => $existing->dibayar_pada ?? $now,
                        'updated_at' => $now,
                    ]);
            } else {
                DB::table('tb_pembayaran')->insert([
                    'pesanan_id' => $pesanan->id,
                    'nomor_invoice' => 'INV-PESANAN-' . $pesanan->id,
                    'jumlah' => $pesanan->total_harga,
                    'metode_pembayaran' => 'tunai',
                    'status' => 'lunas',
                    'dibayar_pada' => $now,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        } else {
            DB::table('tb_pembayaran')->where('pesanan_id', $pesanan->id)->delete();
        }
    }
}
