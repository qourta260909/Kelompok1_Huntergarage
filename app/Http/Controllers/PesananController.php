<?php

namespace App\Http\Controllers;

use App\Models\DataPesanan;
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
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Hanya Admin yang dapat mengunduh bukti PDF.');
        }

        $pesanan->loadMissing(['jadwalService', 'layanan', 'produk']);

        $kodeBooking = $pesanan->kode_booking;

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
            'metode_pembayaran' => ($pesanan->kategori ?? 'layanan') === 'produk'
                ? 'Transfer Bank BCA'
                : 'Bayar di Tempat / Transfer Bank BCA (Setelah Selesai)',
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
        $pesananUser = Pesanan::with(['jadwalService', 'layanan', 'produk', 'details.produk', 'pembayaran'])
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

    public function storeRating(Request $request, Pesanan $pesanan)
    {
        $user = $request->user();
        if (!$user || $pesanan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk menilai pesanan ini.');
        }

        if ($pesanan->status !== 'selesai') {
            return back()->withErrors([
                'rating' => 'Penilaian hanya dapat diberikan setelah pesanan selesai.',
            ]);
        }

        if (!is_null($pesanan->rating)) {
            return back()->withErrors([
                'rating' => 'Pesanan ini sudah pernah Anda beri penilaian.',
            ]);
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'ulasan' => ['nullable', 'string', 'max:500'],
        ]);

        $pesanan->update([
            'rating' => (int) $validated['rating'],
            'ulasan' => trim((string) ($validated['ulasan'] ?? '')) ?: null,
        ]);

        return back()->with('success', 'Terima kasih! Penilaian bintang ' . $validated['rating'] . '/5 berhasil dikirim.');
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
            'produk_id' => ['nullable', 'exists:tb_produk,id'],
            'cart_items' => ['nullable', 'string'],
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
            'alamat' => ['nullable', 'required_if:kategori,produk', 'string', 'max:500'],
            'layanan_pengiriman' => ['nullable', 'required_if:kategori,produk', 'in:reguler,express'],
            'bukti_pembayaran' => ['nullable', 'required_if:kategori,produk', 'file', 'mimes:jpg,jpeg,png,webp,jfif,avif', 'max:10240'],
            'merek' => ['nullable', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:100'],
            'tahun' => ['nullable', 'integer', 'min:1990', 'max:2030'],
            'plat_nomor' => ['nullable', 'string', 'max:30'],
        ]);

        $buktiPembayaranPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');
        }

        [$pesanan, $namaItem] = DB::transaction(function () use ($validated, $user, $buktiPembayaranPath) {
            $layananId = null;
            $produkId = null;
            $jadwalServiceId = null;
            $namaItem = '';
            $totalHarga = 0;
            $layananPengiriman = null;
            $ongkir = 0;
            $orderDetailsToCreate = [];

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
                $cartList = [];
                if (!empty($validated['cart_items'])) {
                    $decoded = json_decode($validated['cart_items'], true);
                    if (is_array($decoded)) {
                        foreach ($decoded as $entry) {
                            $pid = (int) ($entry['id'] ?? $entry['produk_id'] ?? 0);
                            $qty = max(1, (int) ($entry['qty'] ?? 1));
                            if ($pid > 0) {
                                $cartList[$pid] = ($cartList[$pid] ?? 0) + $qty;
                            }
                        }
                    }
                } elseif (!empty($validated['produk_id'])) {
                    $cartList[(int) $validated['produk_id']] = 1;
                }

                if (empty($cartList)) {
                    throw ValidationException::withMessages([
                        'produk_id' => 'Keranjang belanja masih kosong. Silakan pilih produk terlebih dahulu.',
                    ]);
                }

                $namaItemsSummary = [];
                foreach ($cartList as $pid => $qty) {
                    $produk = Produk::whereKey($pid)->lockForUpdate()->first();
                    if (!$produk) {
                        throw ValidationException::withMessages([
                            'produk_id' => 'Produk yang dipilih tidak ditemukan.',
                        ]);
                    }
                    if ($produk->status !== 'aktif') {
                        throw ValidationException::withMessages([
                            'produk_id' => "Produk {$produk->nama_produk} sedang tidak aktif.",
                        ]);
                    }
                    if ($produk->stok < $qty) {
                        throw ValidationException::withMessages([
                            'produk_id' => $produk->stok <= 0
                                ? 'Stok produk yang dipilih sedang habis.'
                                : "Stok {$produk->nama_produk} hanya tersisa {$produk->stok} Pcs.",
                        ]);
                    }

                    if ($produkId === null) {
                        $produkId = $produk->id;
                    }

                    $subtotal = (float) $produk->harga_jual * $qty;
                    $totalHarga += $subtotal;
                    $namaItemsSummary[] = $qty > 1 ? "{$produk->nama_produk} (x{$qty})" : $produk->nama_produk;

                    $produk->decrement('stok', $qty);

                    $orderDetailsToCreate[] = [
                        'produk_id' => $produk->id,
                        'nama_item' => $produk->nama_produk,
                        'harga' => $produk->harga_jual,
                        'qty' => $qty,
                        'subtotal' => $subtotal,
                    ];
                }

                $namaItem = implode(', ', $namaItemsSummary);
                $layananPengiriman = $validated['layanan_pengiriman'] ?? 'reguler';
                $ongkir = $layananPengiriman === 'express' ? 30000 : 15000;
                $totalHarga += $ongkir;
            }

            $namaPelanggan = trim((string) ($validated['nama_lengkap'] ?? '')) ?: $user->name;
            $noTelepon = trim((string) ($validated['no_telepon'] ?? '')) ?: ($user->no_telepon ?: null);
            $alamat = trim((string) ($validated['alamat'] ?? '')) ?: ($user->alamat ?: null);

            $pesanan = Pesanan::create([
                'user_id' => $user->id,
                'layanan_id' => $layananId,
                'produk_id' => $produkId,
                'jadwalservice_id' => $jadwalServiceId,
                'nama_pelanggan' => $namaPelanggan,
                'no_telepon' => $noTelepon,
                'alamat' => $alamat,
                'layanan_pengiriman' => $layananPengiriman,
                'ongkir' => $ongkir,
                'bukti_pembayaran' => $buktiPembayaranPath,
                'kategori' => $validated['kategori'],
                'nama_layanan' => $namaItem,
                'jadwal_service' => $validated['jadwal_service'],
                'total_harga' => $totalHarga,
                'status' => 'baru',
            ]);

            foreach ($orderDetailsToCreate as $detailRow) {
                DataPesanan::create(array_merge($detailRow, [
                    'pesanan_id' => $pesanan->id,
                ]));
            }

            return [$pesanan, $namaItem];
        });

        $kodeBooking = $pesanan->kode_booking;

        if ($request->expectsJson()) {
            $pesanan->load('details');

            return response()->json([
                'ok' => true,
                'pesanan_id' => $pesanan->id,
                'kode_pesanan' => $kodeBooking,
                'nama_pelanggan' => $pesanan->nama_pelanggan,
                'alamat' => $pesanan->alamat,
                'layanan_pengiriman' => $pesanan->layanan_pengiriman,
                'ongkir' => (float) ($pesanan->ongkir ?? 0),
                'subtotal_produk' => max(0, (float) $pesanan->total_harga - (float) ($pesanan->ongkir ?? 0)),
                'total_harga' => (float) $pesanan->total_harga,
                'waktu_transaksi' => Carbon::parse($pesanan->created_at)->locale('id')->translatedFormat('j F Y, H:i') . ' WITA',
                'items' => $pesanan->details->map(fn ($d) => [
                    'nama_item' => $d->nama_item,
                    'qty' => (int) $d->qty,
                    'harga' => (float) $d->harga,
                    'subtotal' => (float) $d->subtotal,
                ])->values(),
                'redirect_pesanan_url' => route('user.pesanan'),
                'redirect_detail_url' => route('user.pesanan', ['detail' => $pesanan->id]),
            ]);
        }

        return redirect()
            ->route('user.pesanan')
            ->with('just_ordered_id', $pesanan->id)
            ->with('success', "Pesanan {$kodeBooking} ({$namaItem}) berhasil dikirim dan sedang menunggu konfirmasi Admin.");
    }

    public function cancelUserBooking(Request $request, Pesanan $pesanan)
    {
        if ((int) $pesanan->user_id !== (int) $request->user()->id) {
            abort(403);
        }

        $errorMessage = null;

        DB::transaction(function () use ($pesanan, &$errorMessage) {
            $lockedPesanan = Pesanan::where('id', $pesanan->id)->lockForUpdate()->firstOrFail();

            if (($lockedPesanan->kategori ?? 'layanan') !== 'layanan') {
                $errorMessage = 'Hanya booking layanan yang dapat dibatalkan.';
                return;
            }

            if ($lockedPesanan->status !== 'baru') {
                $errorMessage = 'Booking sudah dikonfirmasi oleh admin, sehingga tidak dapat dibatalkan langsung. Silakan hubungi CS kami di +62 831-9251-3564.';
                return;
            }

            $lockedPesanan->update([
                'status' => 'dibatalkan',
            ]);

            $this->syncJadwalService($lockedPesanan);
            $this->syncRiwayat($lockedPesanan);
        });

        if ($errorMessage) {
            return redirect()->back()->withErrors(['cancel' => $errorMessage]);
        }

        return redirect()->route('user.pesanan', ['tab' => 'jadwal'])
            ->with('success', "Booking {$pesanan->kode_booking} berhasil dibatalkan.");
    }

    public function index()
    {
        $daftarPesanan = Pesanan::with(['user', 'jadwalService', 'layanan', 'produk', 'details.produk', 'pembayaran'])
            ->where('status', 'baru')
            ->orderBy('id', 'asc')
            ->get()
            ->map(function (Pesanan $pesanan) {
                $pesanan->nama_pelanggan_tampil = $pesanan->nama_pelanggan ?: ($pesanan->user->name ?? 'Pelanggan');
                return $pesanan;
            });

        return view('dashboard_pesanan', compact('daftarPesanan'));
    }

    public function riwayat()
    {
        $daftarRiwayat = Pesanan::with(['user', 'jadwalService', 'layanan', 'produk', 'details.produk', 'pembayaran'])
            ->whereIn('status', ['proses', 'selesai', 'dibatalkan'])
            ->orderBy('id', 'asc')
            ->get()
            ->map(function (Pesanan $pesanan) {
                $pesanan->nama_pelanggan_tampil = $pesanan->nama_pelanggan ?: ($pesanan->user->name ?? 'Pelanggan');
                return $pesanan;
            });

        return view('dashboard_riwayat', compact('daftarRiwayat'));
    }

    public function ulasan()
    {
        $daftarUlasan = Pesanan::with(['user', 'layanan', 'produk', 'details.produk'])
            ->whereNotNull('rating')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function (Pesanan $pesanan) {
                $pesanan->nama_pelanggan_tampil = $pesanan->nama_pelanggan ?: ($pesanan->user->name ?? 'Pelanggan');
                return $pesanan;
            });

        $totalUlasan = $daftarUlasan->count();
        $rataRating = $totalUlasan > 0 ? round((float) $daftarUlasan->avg('rating'), 1) : 0;
        $bintangLima = $daftarUlasan->where('rating', 5)->count();

        return view('dashboard_ulasan', compact('daftarUlasan', 'totalUlasan', 'rataRating', 'bintangLima'));
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

        $kategoriTab = $validated['kategori'] ?? 'layanan';

        return redirect()
            ->route('dashboard.pesanan', ['tab' => $kategoriTab])
            ->with('active_category', $kategoriTab)
            ->with('success', 'Pesanan berhasil ditambahkan.');
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

        $kategoriTab = $validated['kategori'] ?? 'layanan';

        return redirect()
            ->route('dashboard.pesanan', ['tab' => $kategoriTab])
            ->with('active_category', $kategoriTab)
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'aksi' => ['required', 'in:terima,tolak,selesai'],
        ]);

        $statusBaru = match ($validated['aksi']) {
            'terima' => 'proses',
            'selesai' => 'selesai',
            default => 'dibatalkan',
        };
        $kategoriTab = $pesanan->kategori ?: 'layanan';

        DB::transaction(function () use ($pesanan, $statusBaru, &$kategoriTab) {
            $lockedPesanan = Pesanan::whereKey($pesanan->id)->lockForUpdate()->firstOrFail();
            $statusLama = $lockedPesanan->status;
            $kategoriTab = $lockedPesanan->kategori ?: 'layanan';

            $this->syncProdukStockOnStatusChange($lockedPesanan, $statusLama, $statusBaru);

            $lockedPesanan->update([
                'status' => $statusBaru,
            ]);

            $this->syncPembayaran($lockedPesanan);
            $this->syncRiwayat($lockedPesanan);
            $this->syncJadwalService($lockedPesanan);
        });

        $kodePesanan = $pesanan->kode_booking;
        session(['last_order_tab' => $kategoriTab]);

        if ($validated['aksi'] === 'selesai') {
            $labelSelesai = $kategoriTab === 'produk' ? 'Sudah Diantar' : 'Sudah Selesai';

            return redirect()
                ->route('dashboard.riwayat', ['tab' => $kategoriTab])
                ->with('active_category', $kategoriTab)
                ->with('success', "Pesanan {$kodePesanan} telah diperbarui menjadi {$labelSelesai}.");
        }

        $pesanNotifikasi = $validated['aksi'] === 'terima'
            ? "Pesanan {$kodePesanan} berhasil diterima (status: Proses) dan dipindahkan ke Riwayat Pesanan."
            : "Pesanan {$kodePesanan} telah ditolak dan dipindahkan ke Riwayat Pesanan.";

        return redirect()
            ->route('dashboard.pesanan', ['tab' => $kategoriTab])
            ->with('active_category', $kategoriTab)
            ->with('success', $pesanNotifikasi);
    }

    public function destroy(Pesanan $pesanan)
    {
        $kategoriTab = $pesanan->kategori ?: 'layanan';

        DB::transaction(function () use ($pesanan, &$kategoriTab) {
            $lockedPesanan = Pesanan::whereKey($pesanan->id)->lockForUpdate()->firstOrFail();
            $kategoriTab = $lockedPesanan->kategori ?: 'layanan';

            if (
                $lockedPesanan->kategori === 'produk'
                && in_array($lockedPesanan->status, ['baru', 'proses'], true)
            ) {
                $details = DataPesanan::where('pesanan_id', $lockedPesanan->id)->get();
                if ($details->isNotEmpty()) {
                    foreach ($details as $detail) {
                        if ($detail->produk_id) {
                            Produk::whereKey($detail->produk_id)->lockForUpdate()->increment('stok', max(1, (int) $detail->qty));
                        }
                    }
                } elseif ($lockedPesanan->produk_id) {
                    Produk::whereKey($lockedPesanan->produk_id)->lockForUpdate()->increment('stok');
                }
            }

            $jadwalServiceId = $lockedPesanan->jadwalservice_id;

            DB::table('tb_datapesanan')->where('pesanan_id', $lockedPesanan->id)->delete();
            DB::table('tb_pembayaran')->where('pesanan_id', $lockedPesanan->id)->delete();
            DB::table('tb_riwayatpesanan')->where('pesanan_id', $lockedPesanan->id)->delete();
            $lockedPesanan->delete();

            if ($jadwalServiceId) {
                DB::table('tb_jadwalservice')->where('id', $jadwalServiceId)->delete();
            }
        });

        session(['last_order_tab' => $kategoriTab]);

        return redirect()
            ->route('dashboard.riwayat', ['tab' => $kategoriTab])
            ->with('active_category', $kategoriTab)
            ->with('success', 'Data pesanan berhasil dihapus.');
    }

    private function syncProdukStockOnStatusChange(Pesanan $pesanan, string $statusLama, string $statusBaru): void
    {
        if ($pesanan->kategori !== 'produk') {
            return;
        }

        $details = DataPesanan::where('pesanan_id', $pesanan->id)->get();

        if ($statusLama !== 'dibatalkan' && $statusBaru === 'dibatalkan') {
            if ($details->isNotEmpty()) {
                foreach ($details as $detail) {
                    if ($detail->produk_id) {
                        Produk::whereKey($detail->produk_id)->lockForUpdate()->increment('stok', max(1, (int) $detail->qty));
                    }
                }
            } elseif ($pesanan->produk_id) {
                Produk::whereKey($pesanan->produk_id)->lockForUpdate()->increment('stok');
            }
            return;
        }

        if ($statusLama === 'dibatalkan' && $statusBaru !== 'dibatalkan') {
            if ($details->isNotEmpty()) {
                foreach ($details as $detail) {
                    if (!$detail->produk_id) {
                        continue;
                    }
                    $qty = max(1, (int) $detail->qty);
                    $produk = Produk::whereKey($detail->produk_id)->lockForUpdate()->first();
                    if (!$produk || $produk->stok < $qty) {
                        throw ValidationException::withMessages([
                            'status' => 'Stok produk tidak mencukupi untuk mengaktifkan kembali pesanan ini.',
                        ]);
                    }
                    $produk->decrement('stok', $qty);
                }
            } elseif ($pesanan->produk_id) {
                $produk = Produk::whereKey($pesanan->produk_id)->lockForUpdate()->first();
                if (!$produk || $produk->stok <= 0) {
                    throw ValidationException::withMessages([
                        'status' => 'Stok produk tidak mencukupi untuk mengaktifkan kembali pesanan ini.',
                    ]);
                }
                $produk->decrement('stok');
            }
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
        if (in_array($pesanan->status, ['proses', 'selesai', 'dibatalkan'], true)) {
            $now = now();
            $existing = DB::table('tb_riwayatpesanan')->where('pesanan_id', $pesanan->id)->first();
            $catatan = match ($pesanan->status) {
                'selesai' => $pesanan->kategori === 'produk' ? 'Produk sudah diantar' : 'Layanan sudah selesai',
                'proses' => 'Pesanan sedang diproses',
                default => 'Pesanan ditolak',
            };

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
                        'bukti_transfer' => $pesanan->bukti_pembayaran ?? $existing->bukti_transfer,
                        'status' => 'lunas',
                        'dibayar_pada' => $existing->dibayar_pada ?? $now,
                        'updated_at' => $now,
                    ]);
            } else {
                DB::table('tb_pembayaran')->insert([
                    'pesanan_id' => $pesanan->id,
                    'nomor_invoice' => 'INV-PESANAN-' . $pesanan->id,
                    'jumlah' => $pesanan->total_harga,
                    'metode_pembayaran' => 'transfer_bca',
                    'bukti_transfer' => $pesanan->bukti_pembayaran,
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
