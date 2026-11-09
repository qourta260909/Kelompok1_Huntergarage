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
<<<<<<< HEAD
                    <h2 class="page-title">Dashboard</h2>
                    <p class="page-subtitle">Selamat datang kembali, {{ auth()->user()->name }}. Berikut adalah ringkasan performa bisnis Anda.</p>
                </div>
                
                <button type="button" class="btn-logout" onclick="openLogoutModal()" title="Keluar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </header>

            <!-- Cards Statistik -->
            <div class="stats-grid">
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pelanggan aktif</div>
                        <div class="card-icon icon-gray"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Kotak Latar Belakang -->
                            <rect width="40" height="40" rx="10" fill="#EFF6FF"/>
                            <!-- Ikon User/Group -->
                            <path d="M15 17C16.6569 17 18 15.6569 18 14C18 12.3431 16.6569 11 15 11C13.3431 11 12 12.3431 12 14C12 15.6569 13.3431 17 15 17Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                             <path d="M22 19C23.1046 19 24 18.1046 24 17C24 15.8954 23.1046 15 22 15" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M9 26V25C9 23.3431 10.3431 22 12 22H18C19.6569 22 21 23.3431 21 25V26" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                         <path d="M24 26V25C24 23.9515 23.284 23.072 22.308 22.825" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                </div>
                    </div>
                    <div class="card-value">{{ number_format($totalPelanggan, 0, ',', '.') }}</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pesanan Baru</div>
                        <div class="card-icon icon-amber"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Kotak Latar Belakang -->
  <rect width="40" height="40" rx="10" fill="#E0F2FE"/>
  <!-- Ikon Tas Belanja -->
  <path d="M13 14H27L28 27H12L13 14Z" stroke="#0284C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M16 14V11C16 9.89543 16.8954 9 18 9H22C23.1046 9 24 9.89543 24 11V14" stroke="#0284C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M17 19H23" stroke="#0284C7" stroke-width="2" stroke-linecap="round"/>
</svg>
</div>
                    </div>
                    <div class="card-value">{{ number_format($pesananBaru, 0    , ',', '.') }}</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Total Pendapatan</div>
                        <div class="card-icon icon-gray"><svg width="40" height="40" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Kotak Latar Belakang dengan Sudut Melengkung -->
  <rect width="64" height="64" rx="16" fill="#DBEAFE"/>
  
  <!-- Ikon Simbol Dollar -->
  <path d="M32 16V48" stroke="#1D4ED8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M40 24H26C23.7909 24 22 25.7909 22 28C22 30.2091 23.7909 32 26 32H38C40.2091 32 42 33.7909 42 36C42 38.2091 40.2091 40 38 40H24" stroke="#1D4ED8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                    </div>
                    <div class="card-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pendapatan Baru</div>
                        <div class="card-icon icon-teal"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Kotak Latar Belakang -->
  <rect width="40" height="40" rx="10" fill="#E0E7FF"/>
  <!-- Ikon Grafik Naik -->
  <path d="M12 25L17.5 19.5L21.5 23.5L28 15" stroke="#4338CA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M23 15H28V20" stroke="#4338CA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                    </div>
                    <div class="card-value">Rp {{ number_format($pendapatanBaru, 0, ',', '.') }}</div>
=======
                    <h2 class="panel-title">Pesanan terbaru</h2>
                    <p class="panel-description">Pesanan baru yang perlu diperiksa.</p>
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
                </div>
                <a class="button-link" href="{{ route('dashboard.pesanan') }}">Semua pesanan</a>
            </div>
<<<<<<< HEAD

            <!-- Tabel Pesanan Terbaru -->
            <div class="card">
                <div class="table-header">
                    <div>
                        <div class="table-title">Pesanan Terbaru</div>
                        <div class="table-subtitle">Daftar pesanan yang masuk beserta status terbarunya</div>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Pelanggan</th>
                                <th>Layanan/Produk</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesananTerbaru as $pesanan)
                                @php
                                    $badgeClass = match($pesanan->status) {
                                        'selesai' => 'badge-success',
                                        'proses' => 'badge-process',
                                        default => 'badge-waiting',
                                    };
                                    $kategoriLabel = ($pesanan->kategori ?? 'layanan') === 'produk' ? 'Produk' : 'Layanan';
                                @endphp
                                <tr>
                                    <td class="td-bold">#{{ $loop->iteration }}</td>
                                    <td>{{ $pesanan->nama_pelanggan ?? 'Pelanggan dihapus' }}</td>
                                    <td>
                                        <span class="td-bold">{{ $pesanan->nama_layanan ?? '-' }}</span>
                                        <span style="display:inline-block; margin-left:6px; padding:2px 8px; border-radius:9999px; font-size:11px; font-weight:600; background:#f3f4f6; color:#4b5563;">{{ $kategoriLabel }}</span>
                                    </td>
                                    <td><span class="badge {{ $badgeClass }}">{{ ucfirst($pesanan->status) }}</span></td>
                                    <td class="td-bold">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Belum ada pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
=======
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
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
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
