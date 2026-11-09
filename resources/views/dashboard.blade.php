@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <header class="page-heading">
        <div>
            <h1>Dashboard</h1>
            <p>Ringkasan pesanan, stok, layanan, dan pendapatan Hunter Garage.</p>
        </div>
        <a class="button-primary" href="{{ route('dashboard.pesanan') }}">
            <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
            Kelola pesanan
        </a>
    </header>

    <section class="stats-grid" aria-label="Ringkasan operasional">
        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Pelanggan aktif</span>
                <span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3.5 20v-1a5.5 5.5 0 0 1 11 0v1M16 5.5a3 3 0 0 1 0 5.8M17 14a4.5 4.5 0 0 1 3.5 4.4v.6"/></svg></span>
            </div>
            <strong class="stat-value">{{ number_format($totalPelanggan, 0, ',', '.') }}</strong>
            <span class="stat-note">Akun pelanggan terdaftar</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Pesanan Baru</span>
                <span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M6 4h12a2 2 0 0 1 2 2v14H4V6a2 2 0 0 1 2-2zM8 9h8M8 13h8M8 17h4M9 4V2h6v2"/></svg></span>
            </div>
            <strong class="stat-value">{{ number_format($pesananBaru, 0, ',', '.') }}</strong>
            <span class="stat-note">Perlu ditinjau</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total stok barang</span>
                <span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="m12 3 9 5v8l-9 5-9-5V8zM3.5 7.8l8.5 5 8.5-5M12 13v8"/></svg></span>
            </div>
            <strong class="stat-value">{{ number_format($totalStok, 0, ',', '.') }}</strong>
            <span class="stat-note">{{ number_format($totalProduk, 0, ',', '.') }} jenis produk tercatat</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Jenis layanan</span>
                <span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.2-3.2a6 6 0 0 1-7.9 7.9l-6.8 6.8a2.1 2.1 0 0 1-3-3l6.8-6.8a6 6 0 0 1 7.9-7.9z"/></svg></span>
            </div>
            <strong class="stat-value">{{ number_format($totalLayanan, 0, ',', '.') }}</strong>
            <span class="stat-note">Layanan terdaftar</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total Pendapatan</span>
                <span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 2v20M17 6.5c0-1.4-1.7-2.5-4-2.5H10a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-3c-2.3 0-4-1.1-4-2.5"/></svg></span>
            </div>
            <strong class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
            <span class="stat-note">Pembayaran lunas</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Pendapatan Baru</span>
                <span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h3"/></svg></span>
            </div>
            <strong class="stat-value">Rp {{ number_format($pendapatanBaru, 0, ',', '.') }}</strong>
            <span class="stat-note">Pembayaran lunas bulan ini</span>
        </article>
    </section>

    <div class="dashboard-grid">
        <section class="panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Pesanan terbaru</h2>
                    <p class="panel-description">Pesanan baru yang perlu diperiksa.</p>
                </div>
                <a class="button-link" href="{{ route('dashboard.pesanan') }}">Semua pesanan</a>
            </div>
            <div class="table-scroll">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Layanan / produk</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesananTerbaru as $pesanan)
                            <tr>
                                <td class="numeric">#{{ $pesanan->id }}</td>
                                <td><span class="table-primary">{{ $pesanan->nama_pelanggan ?? 'Pelanggan dihapus' }}</span></td>
                                <td>{{ $pesanan->nama_layanan ?? '-' }}</td>
                                <td class="numeric">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                <td><span class="status-badge status-process">Menunggu</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <strong>Belum ada pesanan.</strong>
                                        <p>Pesanan baru akan muncul di sini saat pelanggan membuat pemesanan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <div>
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Perhatian stok</h2>
                        <p class="panel-description">{{ number_format($jumlahProdukMenipis, 0, ',', '.') }} produk pada atau di bawah stok minimum</p>
                    </div>
                </div>
                <div class="panel-body">
                    @forelse ($produkMenipis as $produk)
                        <div class="stock-row">
                            <div>
                                <span class="stock-name">{{ $produk->nama_produk }}</span>
                                <span class="stock-meta">Minimum {{ $produk->stok->stok_minimum }} {{ $produk->stok->satuan }}</span>
                            </div>
                            <span class="status-badge status-low">{{ number_format($produk->stok->jumlah_stok, 0, ',', '.') }} {{ $produk->stok->satuan }}</span>
                        </div>
                    @empty
                        <div class="empty-state">
                            <strong>Tidak ada stok menipis.</strong>
                            <p>Produk di bawah batas minimum akan muncul di sini.</p>
                        </div>
                    @endforelse
                    <a class="button-link" href="{{ route('dashboard.produk') }}">Buka inventaris</a>
                </div>
            </section>

            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Akses cepat</h2>
                        <p class="panel-description">Bagian operasional lainnya.</p>
                    </div>
                </div>
                <div class="panel-body quick-links">
                    <a class="quick-link" href="{{ route('dashboard.layanan') }}"><span>Daftar layanan</span><span>{{ number_format($totalLayanan, 0, ',', '.') }} jenis</span></a>
                    <a class="quick-link" href="{{ route('dashboard.produk') }}"><span>Produk & stok</span><span>{{ number_format($totalProduk, 0, ',', '.') }} jenis</span></a>
                    <a class="quick-link" href="{{ route('dashboard.riwayat') }}"><span>Riwayat selesai</span><span>Lihat catatan</span></a>
                </div>
            </section>
        </div>
    </div>
@endsection
