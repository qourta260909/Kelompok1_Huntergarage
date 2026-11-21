<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hunter Garage - Halaman Produk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/user.css')
    <style>
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }
        .produk-card {
            padding: 16px 18px;
            border-radius: 14px;
            gap: 6px;
        }
        .produk-card-name {
            font-size: 15.5px;
            margin-top: 2px;
        }
        .produk-card-desc {
            font-size: 12px;
        }
        .produk-card-footer {
            margin-top: 10px;
            padding-top: 10px;
            gap: 8px;
        }
        .produk-price-val {
            font-size: 14.5px;
        }
        .produk-order-btn {
            height: 36px;
            padding: 0 13px;
            font-size: 12px;
            border-radius: 9px;
        }
        @media (max-width: 1120px) {
            .produk-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        @media (max-width: 820px) {
            .produk-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 520px) {
            .produk-grid {
                grid-template-columns: 1fr;
            }
        }
        .produk-modal-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(9, 9, 11, 0.62);
            backdrop-filter: blur(6px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 999;
        }
        .produk-modal-overlay.active {
            display: flex;
        }
        .produk-modal-card {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            border-radius: 20px;
            padding: 26px 28px;
            box-shadow: 0 28px 60px -12px rgba(0, 0, 0, 0.32);
            border: 1px solid #e4e4e7;
            animation: modalPopIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes modalPopIn {
            from { opacity: 0; transform: translateY(10px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .produk-modal-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }
        .produk-modal-title {
            font-size: 19px;
            font-weight: 700;
            color: #111111;
            line-height: 1.25;
        }
        .produk-modal-subtitle {
            font-size: 12.5px;
            color: #71717a;
            margin-top: 2px;
        }
        .produk-modal-close {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: 1px solid #e4e4e7;
            background-color: #fafafa;
            color: #18181b;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }
        .produk-modal-close:hover {
            background-color: #f4f4f5;
            border-color: #d4d4d8;
        }
        .produk-modal-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 14px;
            background-color: #18181b;
            color: #ffffff;
            margin-bottom: 20px;
        }
        .produk-summary-left {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .produk-summary-tag {
            font-size: 10.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #a1a1aa;
        }
        .produk-summary-name {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
        }
        .produk-summary-price {
            font-size: 15px;
            font-weight: 700;
            color: #facc15;
            background: rgba(250, 204, 21, 0.12);
            border: 1px solid rgba(250, 204, 21, 0.3);
            padding: 6px 12px;
            border-radius: 10px;
            white-space: nowrap;
        }
        .pickup-block {
            margin-bottom: 18px;
        }
        .pickup-block-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .pickup-block-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #18181b;
        }
        .pickup-block-badge {
            font-size: 11px;
            font-weight: 600;
            color: #52525b;
            background-color: #f4f4f5;
            padding: 3px 10px;
            border-radius: 999px;
        }
        .pickup-date-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 10px;
        }
        .pickup-date-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            padding: 9px 8px;
            border-radius: 12px;
            border: 1.5px solid #e4e4e7;
            background-color: #ffffff;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.16s ease;
        }
        .pickup-date-card:hover {
            border-color: #a1a1aa;
            background-color: #fafafa;
        }
        .pickup-date-card .day-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #18181b;
        }
        .pickup-date-card .day-sub {
            font-size: 11px;
            font-weight: 500;
            color: #71717a;
        }
        .pickup-date-card.active {
            background-color: #111111;
            border-color: #111111;
            box-shadow: 0 6px 16px -4px rgba(0, 0, 0, 0.25);
        }
        .pickup-date-card.active .day-title {
            color: #ffffff;
        }
        .pickup-date-card.active .day-sub {
            color: #d4d4d8;
        }
        .pickup-date-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .pickup-date-input {
            width: 100%;
            height: 42px;
            padding: 0 14px;
            border-radius: 11px;
            border: 1.5px solid #e4e4e7;
            background-color: #fafafa;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            color: #18181b;
            outline: none;
            transition: border-color 0.15s ease, background-color 0.15s ease;
        }
        .pickup-date-input:focus {
            border-color: #111111;
            background-color: #ffffff;
        }
        .pickup-time-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }
        .pickup-time-btn {
            height: 40px;
            border-radius: 11px;
            border: 1.5px solid #e4e4e7;
            background-color: #ffffff;
            color: #18181b;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            transition: all 0.16s ease;
        }
        .pickup-time-btn:hover {
            border-color: #a1a1aa;
            background-color: #fafafa;
        }
        .pickup-time-btn.active {
            background-color: #111111;
            border-color: #111111;
            color: #ffffff;
            box-shadow: 0 6px 14px -4px rgba(0, 0, 0, 0.25);
        }
        .pickup-summary-banner {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            border-radius: 14px;
            background-color: #f4f4f5;
            border: 1px solid #e4e4e7;
            margin-top: 18px;
            margin-bottom: 20px;
        }
        .pickup-summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background-color: #111111;
            color: #facc15;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .pickup-summary-text {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }
        .pickup-summary-caption {
            font-size: 11px;
            font-weight: 600;
            color: #71717a;
        }
        .pickup-summary-value {
            font-size: 13.5px;
            font-weight: 700;
            color: #111111;
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Hunter Garage" class="brand-logo">
                <div class="brand-text">
                    <span class="brand-title">Hunter Garage</span>
                    <span class="brand-subtitle">Servis dan Suku Cadang</span>
                </div>
            </a>

            <nav class="nav" aria-label="Navigasi utama">
                <div class="nav-links">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    <a class="nav-link {{ request()->routeIs('user.layanan') ? 'active' : '' }}" href="{{ route('user.layanan') }}">Layanan</a>
                    <a class="nav-link {{ request()->routeIs('user.produk') ? 'active' : '' }}" href="{{ route('user.produk') }}">Produk</a>
                </div>
                @auth
                    <div class="user-dropdown" id="userDropdown">
                        <button type="button" class="user-dropdown-btn" id="userDropdownBtn" aria-expanded="false" aria-haspopup="true">
                            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span class="user-name">{{ explode(' ', trim(Auth::user()->name))[0] }}</span>
                            <svg class="dropdown-chevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <div class="user-dropdown-menu" id="userDropdownMenu" role="menu">
                            <div class="dropdown-user-info">
                                <strong class="dropdown-user-name">{{ Auth::user()->name }}</strong>
                                <span class="dropdown-user-email">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('user.pesanan') }}" class="dropdown-item" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <span>Pesanan Saya</span>
                            </a>
                            <a href="{{ route('user.pesanan', ['tab' => 'jadwal']) }}" class="dropdown-item" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Jadwal Servis Saya</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item dropdown-item-danger" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="btn-masuk" href="{{ route('login') }}">Masuk</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="produk-page">
        <div class="produk-container">
            @if (session('success'))
                <div class="user-alert user-alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="user-alert user-alert-error">{{ $errors->first() }}</div>
            @endif

            <div class="produk-header">
                <div>
                    <span class="judul-layanan"><span>• </span> KATALOG PRODUK</span>
                    <h1 class="produk-title">Produk &amp; Suku Cadang</h1>
                    <p class="produk-subtitle">Suku cadang dan pelumas resmi yang tersedia di bengkel Hunter Garage.</p>
                </div>

                @if (($produkAktif ?? collect())->isNotEmpty())
                    <div class="produk-search-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="produkSearchInput" class="produk-search-input" placeholder="Cari produk atau suku cadang...">
                    </div>
                @endif
            </div>

            @if (($produkAktif ?? collect())->isEmpty())
                <div class="empty-catalog-box">
                    <div class="empty-catalog-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                        </svg>
                    </div>
                    <h2 class="empty-catalog-title">Belum Ada Produk Tersedia</h2>
                    <p class="empty-catalog-desc">Saat ini belum ada produk atau suku cadang aktif yang ditambahkan oleh Admin di dasbor.</p>
                </div>
            @else
                <div class="produk-grid" id="produkGrid">
                    @foreach ($produkAktif as $produk)
                        @php
                            $stokProduk = (int) ($produk->stok ?? 0);
                            $stokHabis = $stokProduk <= 0;
                        @endphp
                        <article class="produk-card" data-search="{{ strtolower($produk->nama_produk . ' ' . ($produk->deskripsi ?? '')) }}">
                            @if ($produk->gambar_url)
                                <div style="width:100%; height:118px; border-radius:10px; background-color:#f4f4f5; display:flex; align-items:center; justify-content:center; overflow:hidden; margin-bottom:4px;">
                                    <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama_produk }}" style="width:100%; height:100%; object-fit:contain;">
                                </div>
                            @endif
                            <div class="produk-card-head" style="justify-content:flex-end;">
                                <span class="produk-stock-pill {{ $stokHabis ? 'stock-empty' : ($stokProduk < 5 ? 'stock-low' : 'stock-ok') }}">
                                    {{ $stokHabis ? 'Stok habis' : 'Stok: ' . $stokProduk . ' Pcs' }}
                                </span>
                            </div>

                            <h2 class="produk-card-name">{{ $produk->nama_produk }}</h2>
                            <p class="produk-card-desc">{{ $produk->deskripsi ?: 'Suku cadang resmi Hunter Garage' }}</p>

                            <div class="produk-card-footer">
                                <div class="produk-price-wrap">
                                    <span class="produk-price-label">Harga</span>
                                    <strong class="produk-price-val">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</strong>
                                </div>

                                @auth
                                    <button
                                        type="button"
                                        class="produk-order-btn"
                                        {{ $stokHabis ? 'disabled' : '' }}
                                        onclick="openProdukOrderModal({{ $produk->id }}, @js($produk->nama_produk), @js('Rp ' . number_format($produk->harga_jual, 0, ',', '.')))"
                                    >
                                        {{ $stokHabis ? 'Habis' : 'Pesan Produk' }}
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="produk-order-btn produk-order-link">Masuk untuk Memesan</a>
                                @endauth
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="empty-catalog-box" id="produkEmptySearch" style="display:none;">
                    <h2 class="empty-catalog-title">Produk Tidak Ditemukan</h2>
                    <p class="empty-catalog-desc">Tidak ada produk yang cocok dengan kata kunci pencarian Anda.</p>
                </div>
            @endif
        </div>
    </main>

    @auth
        <div class="produk-modal-overlay" id="produkOrderModal" aria-hidden="true">
            <div class="produk-modal-card" role="dialog" aria-modal="true" aria-labelledby="produkModalTitle">
                <div class="produk-modal-head">
                    <div>
                        <h2 id="produkModalTitle" class="produk-modal-title">Jadwal Pengambilan Produk</h2>
                        <p class="produk-modal-subtitle">Pilih tanggal dan jam kedatangan Anda di bengkel</p>
                    </div>
                    <button type="button" class="produk-modal-close" onclick="closeProdukOrderModal()" aria-label="Tutup">&times;</button>
                </div>

                <form method="POST" action="{{ route('user.pesanan.store') }}" id="produkOrderForm">
                    @csrf
                    <input type="hidden" name="kategori" value="produk">
                    <input type="hidden" name="produk_id" id="modalProdukId" value="">
                    <input type="hidden" name="jadwal_service" id="modalJadwalService" value="">
                    <input type="hidden" id="modalJamAmbil" value="10:00">

                    <div class="produk-modal-summary">
                        <div class="produk-summary-left">
                            <span class="produk-summary-tag">Produk Dipilih</span>
                            <strong class="produk-summary-name" id="modalProdukNama">-</strong>
                        </div>
                        <span class="produk-summary-price" id="modalProdukHarga">-</span>
                    </div>

                    <!-- Tanggal Pengambilan -->
                    <div class="pickup-block">
                        <div class="pickup-block-header">
                            <label for="modalTanggalAmbil" class="pickup-block-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Tanggal Pengambilan
                            </label>
                            <span class="pickup-block-badge">Buka Setiap Hari</span>
                        </div>

                        <div class="pickup-date-cards" role="group" aria-label="Pilihan cepat tanggal pengambilan">
                            <button type="button" class="pickup-date-card active" data-date-offset="0">
                                <span class="day-title">Hari Ini</span>
                                <span class="day-sub" id="quickDateSub0">-</span>
                            </button>
                            <button type="button" class="pickup-date-card" data-date-offset="1">
                                <span class="day-title">Besok</span>
                                <span class="day-sub" id="quickDateSub1">-</span>
                            </button>
                            <button type="button" class="pickup-date-card" data-date-offset="2">
                                <span class="day-title">Lusa</span>
                                <span class="day-sub" id="quickDateSub2">-</span>
                            </button>
                        </div>

                        <div class="pickup-date-input-wrap">
                            <input type="date" id="modalTanggalAmbil" class="pickup-date-input" required>
                        </div>
                    </div>

                    <!-- Jam Pengambilan -->
                    <div class="pickup-block">
                        <div class="pickup-block-header">
                            <span class="pickup-block-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                Jam Pengambilan
                            </span>
                            <span class="pickup-block-badge">08.00 – 22.00 WITA</span>
                        </div>

                        <div class="pickup-time-grid" role="group" aria-label="Pilihan jam pengambilan">
                            <button type="button" class="pickup-time-btn" data-time="08:00">08.00</button>
                            <button type="button" class="pickup-time-btn" data-time="09:00">09.00</button>
                            <button type="button" class="pickup-time-btn active" data-time="10:00">10.00</button>
                            <button type="button" class="pickup-time-btn" data-time="11:00">11.00</button>
                            <button type="button" class="pickup-time-btn" data-time="13:00">13.00</button>
                            <button type="button" class="pickup-time-btn" data-time="14:00">14.00</button>
                            <button type="button" class="pickup-time-btn" data-time="15:00">15.00</button>
                            <button type="button" class="pickup-time-btn" data-time="16:00">16.00</button>
                            <button type="button" class="pickup-time-btn" data-time="17:00">17.00</button>
                            <button type="button" class="pickup-time-btn" data-time="19:00">19.00</button>
                            <button type="button" class="pickup-time-btn" data-time="20:00">20.00</button>
                            <button type="button" class="pickup-time-btn" data-time="21:00">21.00</button>
                        </div>
                    </div>

                    <!-- Ringkasan Jadwal Pengambilan -->
                    <div class="pickup-summary-banner" aria-live="polite">
                        <div class="pickup-summary-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                        </div>
                        <div class="pickup-summary-text">
                            <span class="pickup-summary-caption">Jadwal Pengambilan di Bengkel</span>
                            <strong class="pickup-summary-value" id="pickupPreviewText">-</strong>
                        </div>
                    </div>

                    <div class="produk-modal-actions">
                        <button type="button" class="booking-prev-btn" onclick="closeProdukOrderModal()">Batal</button>
                        <button type="submit" class="produk-order-btn">Konfirmasi Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    @endauth

    <x-user-footer :layanan-aktif="$layananAktif ?? collect()" :produk-aktif="$produkAktif ?? collect()" />

    <script>
        function getOffsetDateString(offsetDays) {
            const d = new Date();
            d.setDate(d.getDate() + Number(offsetDays || 0));
            const yyyy = d.getFullYear();
            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const dd = String(d.getDate()).padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        }

        function populateQuickDateSubtitles() {
            [0, 1, 2].forEach(function (offset) {
                const el = document.getElementById('quickDateSub' + offset);
                if (!el) return;
                const d = new Date();
                d.setDate(d.getDate() + offset);
                el.textContent = d.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                });
            });
        }

        function updatePickupPreview() {
            const dateInput = document.getElementById('modalTanggalAmbil');
            const timeInput = document.getElementById('modalJamAmbil');
            const previewEl = document.getElementById('pickupPreviewText');
            if (!previewEl) return;

            const tglVal = dateInput ? dateInput.value : '';
            const jamVal = timeInput ? timeInput.value : '10:00';

            let tanggalFormatted = 'Pilih tanggal';
            if (tglVal) {
                const [y, m, d] = tglVal.split('-').map(Number);
                const dateObj = new Date(y, (m || 1) - 1, d || 1);
                if (!isNaN(dateObj.getTime())) {
                    tanggalFormatted = dateObj.toLocaleDateString('id-ID', {
                        weekday: 'long',
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                    });
                }
            }

            const jamFormatted = jamVal ? `Pukul ${jamVal.replace(':', '.')} WITA` : 'Pilih jam';
            previewEl.textContent = `${tanggalFormatted} • ${jamFormatted}`;

            // Sync quick date cards
            document.querySelectorAll('[data-date-offset]').forEach(function (btn) {
                const targetDate = getOffsetDateString(btn.dataset.dateOffset);
                btn.classList.toggle('active', tglVal === targetDate);
            });

            // Sync time slot buttons
            document.querySelectorAll('.pickup-time-btn').forEach(function (btn) {
                btn.classList.toggle('active', btn.dataset.time === jamVal);
            });
        }

        function openProdukOrderModal(id, nama, harga) {
            const modal = document.getElementById('produkOrderModal');
            if (!modal) return;
            document.getElementById('modalProdukId').value = id;
            document.getElementById('modalProdukNama').textContent = nama;
            document.getElementById('modalProdukHarga').textContent = harga;
            const dateInput = document.getElementById('modalTanggalAmbil');
            const todayStr = getOffsetDateString(0);
            if (dateInput) {
                dateInput.min = todayStr;
                if (!dateInput.value || dateInput.value < todayStr) {
                    dateInput.value = todayStr;
                }
            }
            const timeInput = document.getElementById('modalJamAmbil');
            if (timeInput && !timeInput.value) {
                timeInput.value = '10:00';
            }
            updatePickupPreview();
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
        }

        function closeProdukOrderModal() {
            const modal = document.getElementById('produkOrderModal');
            if (!modal) return;
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.getElementById('userDropdown');
            const dropdownBtn = document.getElementById('userDropdownBtn');

            if (dropdown && dropdownBtn) {
                dropdownBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isOpen = dropdown.classList.toggle('open');
                    dropdownBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });

                document.addEventListener('click', function (e) {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('open');
                        dropdownBtn.setAttribute('aria-expanded', 'false');
                    }
                });

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        dropdown.classList.remove('open');
                        dropdownBtn.setAttribute('aria-expanded', 'false');
                        closeProdukOrderModal();
                    }
                });
            }

            const searchInput = document.getElementById('produkSearchInput');
            const cards = Array.from(document.querySelectorAll('.produk-card'));
            const emptySearch = document.getElementById('produkEmptySearch');

            if (searchInput && cards.length > 0) {
                searchInput.addEventListener('input', function () {
                    const q = this.value.toLowerCase().trim();
                    let visible = 0;
                    cards.forEach(function (card) {
                        const match = (card.dataset.search || '').includes(q);
                        card.style.display = match ? '' : 'none';
                        if (match) visible++;
                    });
                    if (emptySearch) {
                        emptySearch.style.display = visible === 0 ? '' : 'none';
                    }
                });
            }

            populateQuickDateSubtitles();
            const dateInput = document.getElementById('modalTanggalAmbil');
            const timeInput = document.getElementById('modalJamAmbil');

            document.querySelectorAll('[data-date-offset]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (dateInput) {
                        dateInput.value = getOffsetDateString(this.dataset.dateOffset);
                        updatePickupPreview();
                    }
                });
            });

            document.querySelectorAll('.pickup-time-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (timeInput) {
                        timeInput.value = this.dataset.time;
                        updatePickupPreview();
                    }
                });
            });

            if (dateInput) {
                dateInput.addEventListener('change', updatePickupPreview);
            }

            const orderForm = document.getElementById('produkOrderForm');
            if (orderForm) {
                orderForm.addEventListener('submit', function (e) {
                    const tgl = dateInput?.value;
                    const jam = timeInput?.value;
                    if (!tgl || !jam || jam < '08:00' || jam > '22:00') {
                        e.preventDefault();
                        alert('Silakan pilih jam pengambilan antara pukul 08.00 hingga 22.00 WITA.');
                        return;
                    }
                    document.getElementById('modalJadwalService').value = `${tgl} ${jam}:00`;
                });
            }
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>
