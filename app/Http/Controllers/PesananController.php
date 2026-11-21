<?php

namespace App\Http\Controllers;

use App\Models\JadwalService;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Support\BookingPdfGenerator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PesananController extends Controller
{
    public function downloadBuktiBooking(Request $request, Pesanan $pesanan)
    {
        $user = $request->user();
        if (!$user || ($pesanan->user_id !== $user->id && $user->role !== 'admin')) {
            abort(403, 'Anda tidak memiliki akses ke bukti booking ini.');
        }

        $pesanan->loadMissing(['jadwalService', 'layanan', 'produk']);

        $isLayanan = ($pesanan->kategori ?? 'layanan') === 'layanan';
        $prefix = $isLayanan ? 'BKG-' : 'PSN-';
        $kodeBooking = $prefix . str_pad((string) $pesanan->id, 4, '0', STR_PAD_LEFT);

        $jadwalRow = $pesanan->jadwalService;
        $rawTipe = trim((string) ($jadwalRow->tipe_kendaraan ?? ''));
        $namaKendaraan = '-';
        $tahunKendaraan = '-';

        if ($rawTipe !== '') {
            if (preg_match('/^(.*?)\s*\b((?:19|20)\d{2})\b$/', $rawTipe, $matches)) {
                $namaKendaraan = trim($matches[1]) ?: $rawTipe;
                $tahunKendaraan = $matches[2];
            } else {
                $namaKendaraan = $rawTipe;
            }
        }

        $platNomor = ($jadwalRow && !empty($jadwalRow->no_plat_kendaraan))
            ? $jadwalRow->no_plat_kendaraan
            : '-';

        $waktuPesanan = $pesanan->jadwal_service ?? $pesanan->created_at;
        $carbonWaktu = $waktuPesanan ? Carbon::parse($waktuPesanan)->locale('id') : null;
        $tanggalBooking = $carbonWaktu ? $carbonWaktu->translatedFormat('j F Y') : '-';
        $jamBooking = $carbonWaktu ? ($carbonWaktu->format('H.i') . ' WITA') : '-';

        $statusText = match ($pesanan->status) {
            'selesai' => 'Jadwal Dikonfirmasi',
            'dibatalkan' => 'Booking Ditolak',
            default => 'Menunggu Konfirmasi',
        };

        $pdfBinary = BookingPdfGenerator::generate([
            'kode_booking' => $kodeBooking,
            'status_text' => $statusText,
            'kendaraan' => $namaKendaraan,
            'tahun' => $tahunKendaraan,
            'plat_nomor' => $platNomor,
            'layanan' => (string) ($pesanan->nama_layanan ?? '-'),
            'tanggal' => $tanggalBooking,
            'waktu' => $jamBooking,
            'nama' => (string) ($pesanan->nama_pelanggan ?: $user->name),
            'telepon' => (string) ($pesanan->no_telepon ?: '-'),
            'metode_pembayaran' => 'Qris',
            'total' => 'Rp' . number_format((float) $pesanan->total_harga, 0, ',', '.'),
            'dicetak_pada' => now()->locale('id')->translatedFormat('d M Y, H:i') . ' WITA',
        ]);

        $filename = "Bukti-Booking-{$kodeBooking}.pdf";

        return response($pdfBinary, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Length' => strlen($pdfBinary),
        ]);
    }
    public function userOrders(Request $request)
    {
        $userId = $request->user()->id;
        $layananAktif = Layanan::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $produkAktif = Produk::where('status', 'aktif')->orderBy('id', 'asc')->get();
        $pesananUser = Pesanan::with(['jadwalService', 'layanan', 'produk'])
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get();
        $jadwalServisUser = JadwalService::with(['layanan', 'pesanan'])
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get();

        $activePage = 'pesanan';
        $activeTab = in_array($request->query('tab'), ['semua', 'jadwal', 'produk'], true)
            ? $request->query('tab')
            : 'semua';

        $viewName = view()->exists('pesanan_saya') ? 'pesanan_saya' : 'welcome';

        return view($viewName, compact(
            'layananAktif',
            'produkAktif',
            'pesananUser',
            'jadwalServisUser',
            'activePage',
            'activeTab'
        ));
    }

    public function storeUserOrder(Request $request)
    {
        $user = $request->user();
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
                    $time = Carbon::parse($value)->format('H:i');
                    if ($time < '08:00' || $time > '22:00') {
                        $fail('Jam pemesanan hanya tersedia antara pukul 08:00 pagi hingga 22:00 malam.');
                    }
                },
            ],
            'nama_lengkap' => ['nullable', 'string', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'merek' => ['nullable', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:100'],
            'tahun' => ['nullable', 'integer', 'min:1990', 'max:2030'],
            'plat_nomor' => ['nullable', 'string', 'max:30'],
        ]);

        [$pesanan, $namaItem] = DB::transaction(function () use ($validated, $user) {
            $layananId = null;
            $produkId = null;
            $jadwalServiceId = null;
            $namaItem = '';
            $totalHarga = 0;

            if ($validated['kategori'] === 'layanan') {
                $layanan = Layanan::findOrFail($validated['layanan_id']);
                if ($layanan->status !== 'aktif') {
                    throw ValidationException::withMessages([
                        'layanan_id' => 'Layanan yang dipilih sedang tidak aktif.',
                    ]);
                }

                $layananId = $layanan->id;
                $namaItem = $layanan->nama_layanan;
                $totalHarga = $layanan->harga;

                $jadwalCarbon = Carbon::parse($validated['jadwal_service']);
                $tipeKendaraanParts = array_filter([
                    isset($validated['merek']) ? trim($validated['merek']) : null,
                    isset($validated['model']) ? trim($validated['model']) : null,
                    isset($validated['tahun']) ? (string) $validated['tahun'] : null,
                ]);
                $tipeKendaraan = count($tipeKendaraanParts) > 0 ? implode(' ', $tipeKendaraanParts) : null;
                $platNomor = strtoupper(trim((string) ($validated['plat_nomor'] ?? ''))) ?: '-';

                $jadwalService = JadwalService::create([
                    'user_id' => $user->id,
                    'layanan_id' => $layanan->id,
                    'no_plat_kendaraan' => $platNomor,
                    'tipe_kendaraan' => $tipeKendaraan,
                    'tanggal_service' => $jadwalCarbon->toDateString(),
                    'jam_service' => $jadwalCarbon->format('H:i:s'),
                    'status' => 'menunggu',
                ]);
                $jadwalServiceId = $jadwalService->id;
            } else {
                $produk = Produk::whereKey($validated['produk_id'])->lockForUpdate()->firstOrFail();
                if ($produk->status !== 'aktif') {
                    throw ValidationException::withMessages([
                        'produk_id' => 'Produk yang dipilih sedang tidak aktif.',
                    ]);
                }
                if ($produk->stok <= 0) {
                    throw ValidationException::withMessages([
                        'produk_id' => 'Stok produk yang dipilih sedang habis.',
                    ]);
                }

                $produkId = $produk->id;
                $namaItem = $produk->nama_produk;
                $totalHarga = $produk->harga_jual;
                $produk->decrement('stok');
            }

            $namaPelanggan = trim((string) ($validated['nama_lengkap'] ?? '')) ?: $user->name;
            $noTelepon = trim((string) ($validated['no_telepon'] ?? '')) ?: null;

            $pesanan = Pesanan::create([
                'user_id' => $user->id,
                'layanan_id' => $layananId,
                'produk_id' => $produkId,
                'jadwalservice_id' => $jadwalServiceId,
                'nama_pelanggan' => $namaPelanggan,
                'no_telepon' => $noTelepon,
                'kategori' => $validated['kategori'],
                'nama_layanan' => $namaItem,
                'jadwal_service' => $validated['jadwal_service'],
                'total_harga' => $totalHarga,
                'status' => 'baru',
            ]);

            return [$pesanan, $namaItem];
        });

        $kodeBooking = 'BKG-' . str_pad((string) $pesanan->id, 4, '0', STR_PAD_LEFT);

        return redirect()
            ->route('user.pesanan')
            ->with('success', "Pesanan {$kodeBooking} ({$namaItem}) berhasil dikirim dan sedang menunggu konfirmasi Admin.");
    }

    public function index()
    {
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
                    $time = Carbon::parse($value)->format('H:i');
                    if ($time < '08:00' || $time > '22:00') {
                        $fail('Jam servis hanya tersedia antara pukul 08:00 pagi hingga 22:00 malam.');
                    }
                },
            ],
            'total_harga' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:baru,proses,selesai,dibatalkan'],
        ]);

        DB::transaction(function () use ($validated) {
            $pesanan = Pesanan::create($validated);
            $this->syncPembayaran($pesanan);
            $this->syncRiwayat($pesanan);
        });

        return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function update(Request $request, Pesanan $pesanan)
    {
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
                    $time = Carbon::parse($value)->format('H:i');
                    if ($time < '08:00' || $time > '22:00') {
                        $fail('Jam servis hanya tersedia antara pukul 08:00 pagi hingga 22:00 malam.');
                    }
                },
            ],
            'total_harga' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:baru,proses,selesai,dibatalkan'],
        ]);

        DB::transaction(function () use ($pesanan, $validated) {
            $lockedPesanan = Pesanan::whereKey($pesanan->id)->lockForUpdate()->firstOrFail();
            $statusLama = $lockedPesanan->status;
            $statusBaru = $validated['status'];

            $this->syncProdukStockOnStatusChange($lockedPesanan, $statusLama, $statusBaru);

            $lockedPesanan->update($validated);
            $this->syncPembayaran($lockedPesanan);
            $this->syncRiwayat($lockedPesanan);
            $this->syncJadwalService($lockedPesanan);
        });

        return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'aksi' => ['required', 'in:terima,tolak'],
        ]);

        $statusBaru = $validated['aksi'] === 'terima' ? 'selesai' : 'dibatalkan';

        DB::transaction(function () use ($pesanan, $statusBaru) {
            $lockedPesanan = Pesanan::whereKey($pesanan->id)->lockForUpdate()->firstOrFail();
            $statusLama = $lockedPesanan->status;

            $this->syncProdukStockOnStatusChange($lockedPesanan, $statusLama, $statusBaru);

            $lockedPesanan->update([
                'status' => $statusBaru,
            ]);

            $this->syncPembayaran($lockedPesanan);
            $this->syncRiwayat($lockedPesanan);
            $this->syncJadwalService($lockedPesanan);
        });

        $kodePesanan = 'BKG-' . str_pad((string) $pesanan->id, 4, '0', STR_PAD_LEFT);
        $pesanNotifikasi = $validated['aksi'] === 'terima'
            ? "Pesanan {$kodePesanan} berhasil diterima dan dipindahkan ke Riwayat Pesanan."
            : "Pesanan {$kodePesanan} telah ditolak dan dipindahkan ke Riwayat Pesanan.";

        return redirect()->route('dashboard.riwayat')->with('success', $pesanNotifikasi);
    }

    public function destroy(Pesanan $pesanan)
    {
        DB::transaction(function () use ($pesanan) {
            $lockedPesanan = Pesanan::whereKey($pesanan->id)->lockForUpdate()->firstOrFail();

            if (
                $lockedPesanan->kategori === 'produk'
                && $lockedPesanan->produk_id
                && in_array($lockedPesanan->status, ['baru', 'proses'], true)
            ) {
                Produk::whereKey($lockedPesanan->produk_id)->lockForUpdate()->increment('stok');
            }

            $jadwalServiceId = $lockedPesanan->jadwalservice_id;

            DB::table('tb_pembayaran')->where('pesanan_id', $lockedPesanan->id)->delete();
            DB::table('tb_riwayatpesanan')->where('pesanan_id', $lockedPesanan->id)->delete();
            $lockedPesanan->delete();

            if ($jadwalServiceId) {
                DB::table('tb_jadwalservice')->where('id', $jadwalServiceId)->delete();
            }
        });

        return back()->with('success', 'Data pesanan berhasil dihapus.');
    }

    private function syncProdukStockOnStatusChange(Pesanan $pesanan, string $statusLama, string $statusBaru): void
    {
        if ($pesanan->kategori !== 'produk' || !$pesanan->produk_id) {
            return;
        }

        if ($statusLama !== 'dibatalkan' && $statusBaru === 'dibatalkan') {
            Produk::whereKey($pesanan->produk_id)->lockForUpdate()->increment('stok');
            return;
        }

        if ($statusLama === 'dibatalkan' && $statusBaru !== 'dibatalkan') {
            $produk = Produk::whereKey($pesanan->produk_id)->lockForUpdate()->first();
            if (!$produk || $produk->stok <= 0) {
                throw ValidationException::withMessages([
                    'status' => 'Stok produk tidak mencukupi untuk mengaktifkan kembali pesanan ini.',
                ]);
            }
            $produk->decrement('stok');
        }
    }

    private function syncJadwalService(Pesanan $pesanan): void
    {
        if (!$pesanan->jadwalservice_id) {
            return;
        }

        $statusJadwal = match ($pesanan->status) {
            'selesai' => 'selesai',
            'dibatalkan' => 'dibatalkan',
            'proses' => 'proses',
            default => 'menunggu',
        };

        DB::table('tb_jadwalservice')
            ->where('id', $pesanan->jadwalservice_id)
            ->update([
                'status' => $statusJadwal,
                'updated_at' => now(),
            ]);
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
