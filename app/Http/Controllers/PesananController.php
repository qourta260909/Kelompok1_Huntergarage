<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function storeUserOrder(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'kategori' => ['required', 'in:layanan,produk'],
            'layanan_id' => ['nullable', 'required_if:kategori,layanan', 'exists:tb_layanan,id'],
            'produk_id' => ['nullable', 'required_if:kategori,produk', 'exists:tb_produk,id'],
            'jadwal_service' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $time = \Carbon\Carbon::parse($value)->format('H:i');
                    if ($time < '08:00' || $time > '22:00') {
                        $fail('Jam booking hanya tersedia antara pukul 08:00 pagi hingga 22:00 malam.');
                    }
                },
            ],
        ]);

        $layananId = null;
        $produkId = null;
        $namaItem = '';
        $totalHarga = 0;

        if ($validated['kategori'] === 'layanan') {
            $layanan = Layanan::findOrFail($validated['layanan_id']);
            $layananId = $layanan->id;
            $namaItem = $layanan->nama_layanan;
            $totalHarga = $layanan->harga;
        } else {
            $produk = Produk::findOrFail($validated['produk_id']);
            if ($produk->stok <= 0) {
                return back()->withErrors(['produk_id' => 'Stok produk yang dipilih sedang habis.']);
            }
            $produkId = $produk->id;
            $namaItem = $produk->nama_produk;
            $totalHarga = $produk->harga_jual;
            $produk->decrement('stok');
        }

        $pesanan = Pesanan::create([
            'user_id' => $user->id,
            'layanan_id' => $layananId,
            'produk_id' => $produkId,
            'nama_pelanggan' => $user->name,
            'kategori' => $validated['kategori'],
            'nama_layanan' => $namaItem,
            'jadwal_service' => $validated['jadwal_service'],
            'total_harga' => $totalHarga,
            'status' => 'baru',
        ]);

        $kodeBooking = 'BKG-' . str_pad((string) $pesanan->id, 4, '0', STR_PAD_LEFT);

        return redirect()->route('user.pesanan')->with('success', "Booking {$kodeBooking} ({$namaItem}) berhasil dikirim dan sedang menunggu konfirmasi Admin.");
    }
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
        $this->syncRiwayat($pesanan);

        return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $validated = $request->validate([
            'aksi' => ['required', 'in:terima,tolak'],
        ]);

        $statusBaru = $validated['aksi'] === 'terima' ? 'selesai' : 'dibatalkan';
        $pesanan->update([
            'status' => $statusBaru,
        ]);

        $this->syncPembayaran($pesanan);
        $this->syncRiwayat($pesanan);

        $kodePesanan = 'BKG-' . str_pad((string) $pesanan->id, 4, '0', STR_PAD_LEFT);
        $pesanNotifikasi = $validated['aksi'] === 'terima'
            ? "Pesanan {$kodePesanan} berhasil diterima dan dipindahkan ke Riwayat Pesanan."
            : "Pesanan {$kodePesanan} telah ditolak dan dipindahkan ke Riwayat Pesanan.";

        return redirect()->route('dashboard.riwayat')->with('success', $pesanNotifikasi);
    }

    public function destroy(Pesanan $pesanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        DB::table('tb_pembayaran')->where('pesanan_id', $pesanan->id)->delete();
        DB::table('tb_riwayatpesanan')->where('pesanan_id', $pesanan->id)->delete();
        $pesanan->delete();

        return back()->with('success', 'Data pesanan berhasil dihapus.');
    }

    private function syncRiwayat(Pesanan $pesanan): void
    {
        if (in_array($pesanan->status, ['selesai', 'dibatalkan'], true)) {
            $now = now();
            $existing = DB::table('tb_riwayatpesanan')->where('pesanan_id', $pesanan->id)->first();
            $catatan = $pesanan->status === 'selesai' ? 'Pesanan diterima' : 'Pesanan ditolak';

            if ($existing) {
                DB::table('tb_riwayatpesanan')
                    ->where('pesanan_id', $pesanan->id)
                    ->update([
                        'user_id' => $pesanan->user_id,
                        'total_harga' => $pesanan->total_harga,
                        'status_akhir' => $pesanan->status,
                        'tanggal_selesai' => $existing->tanggal_selesai ?? $now,
                        'catatan' => $catatan,
                        'updated_at' => $now,
                    ]);
            } else {
                DB::table('tb_riwayatpesanan')->insert([
                    'pesanan_id' => $pesanan->id,
                    'user_id' => $pesanan->user_id,
                    'total_harga' => $pesanan->total_harga,
                    'status_akhir' => $pesanan->status,
                    'tanggal_selesai' => $now,
                    'catatan' => $catatan,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        } else {
            DB::table('tb_riwayatpesanan')->where('pesanan_id', $pesanan->id)->delete();
        }
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
