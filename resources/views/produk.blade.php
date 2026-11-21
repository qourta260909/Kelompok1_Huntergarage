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
        .topbar-spacer {
            width: 100%;
            background-color: #000000;
            color: #ffffff;
        }

        .topbar-spacer-inner {
            max-width: 1360px;
            margin: 0 auto;
            padding: 16px 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .topbar-perks {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            flex: 1;
        }

        .topbar-perk-item {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            font-weight: 700;
            color: #ffffff;
            padding: 6px 34px;
            border-right: 1px solid rgba(255, 255, 255, 0.28);
            white-space: nowrap;
        }

        .topbar-perk-item:first-child {
            padding-left: 0;
        }

        .topbar-perk-item svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            color: #ffffff;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .topbar-search-box {
            position: relative;
            display: flex;
            align-items: center;
            width: 270px;
        }

        .topbar-search-box svg {
            position: absolute;
            left: 14px;
            width: 15px;
            height: 15px;
            color: #9ca3af;
            pointer-events: none;
        }

        .topbar-search-box input {
            width: 100%;
            height: 38px;
            padding: 0 14px 0 38px;
            border-radius: 9px;
            border: none;
            background-color: #ffffff;
            color: #111111;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 500;
            outline: none;
        }

        .topbar-search-box input::placeholder {
            color: #9ca3af;
        }

        .topbar-cart-btn {
            height: 38px;
            padding: 0 24px;
            border-radius: 9px;
            border: none;
            background-color: #ffffff;
            color: #111111;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            transition: background-color 0.16s ease, transform 0.16s ease;
        }

        .topbar-cart-btn:hover {
            background-color: #e4e4e7;
            transform: translateY(-1px);
        }

        @media (max-width: 1120px) {
            .topbar-spacer-inner {
                flex-direction: column;
                align-items: stretch;
                padding: 14px 20px;
                gap: 14px;
            }
            .topbar-perks {
                flex-wrap: wrap;
                gap: 10px 18px;
            }
            .topbar-perk-item {
                padding: 4px 16px 4px 0;
                border-right: none;
            }
            .topbar-actions {
                width: 100%;
            }
            .topbar-search-box {
                flex: 1;
                width: auto;
            }
        }

        /* ================= KATALOG PRODUK FRONTEND ================= */
        .catalog-main {
            width: 100%;
            background-color: #ffffff;
            padding: 34px 36px 72px;
        }

        .catalog-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 48px;
        }

        .catalog-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .catalog-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .catalog-section-title {
            font-size: 20px;
            font-weight: 700;
            color: #111111;
            letter-spacing: -0.01em;
        }

        .catalog-see-all {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 18px;
            border-radius: 999px;
            border: 1px solid #d4d4d8;
            background-color: #ffffff;
            color: #18181b;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.16s ease, border-color 0.16s ease;
        }

        .catalog-see-all:hover {
            background-color: #f4f4f5;
            border-color: #a1a1aa;
        }

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .catalog-card {
            background-color: #ffffff;
            border: 1.3px solid #71717a;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .catalog-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px -10px rgba(0, 0, 0, 0.14);
        }

        .catalog-card-thumb {
            width: 100%;
            height: 200px;
            background: radial-gradient(circle at 50% 45%, #e4e4e7 0%, #d4d4d8 70%, #c7c7cc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            overflow: hidden;
            position: relative;
        }

        .catalog-card-thumb::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 34px;
            height: 1px;
            background-color: rgba(0, 0, 0, 0.08);
        }

        .catalog-card-thumb svg,
        .catalog-card-thumb img {
            width: 100%;
            height: 100%;
            max-width: 190px;
            max-height: 155px;
            object-fit: contain;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.18));
        }

        .catalog-card-body {
            padding: 18px 20px 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .catalog-card-title {
            font-size: 18px;
            font-weight: 700;
            color: #18181b;
            line-height: 1.25;
            letter-spacing: -0.01em;
        }

        .catalog-card-sub {
            font-size: 12px;
            font-weight: 600;
            color: #27272a;
            margin-top: 2px;
            min-height: 18px;
        }

        .catalog-card-sub.sub-lg {
            font-size: 14px;
            font-weight: 700;
        }

        .catalog-rating {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #27272a;
        }

        .catalog-rating svg {
            width: 16px;
            height: 16px;
            color: #d97706;
            flex-shrink: 0;
        }

        .catalog-price {
            margin-top: 10px;
            font-size: 15px;
            font-weight: 700;
            color: #111111;
        }

        .catalog-add-btn {
            margin-top: 14px;
            width: 100%;
            height: 38px;
            border: none;
            border-radius: 10px;
            background-color: #0f172a;
            color: #ffffff;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            transition: background-color 0.16s ease, transform 0.16s ease;
        }

        .catalog-add-btn:hover {
            background-color: #1e293b;
            transform: translateY(-1px);
        }

        @media (max-width: 1100px) {
            .catalog-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 820px) {
            .catalog-main {
                padding: 28px 20px 56px;
            }
            .catalog-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 520px) {
            .catalog-grid {
                grid-template-columns: 1fr;
            }
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
    <div class="topbar-spacer">
        <div class="topbar-spacer-inner">
            <ul class="topbar-perks">
                <li class="topbar-perk-item">
                    <!-- Truck Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="1" y="3" width="15" height="13" rx="1"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                    <span>Gratis Ongkir min. Rp150.000</span>
                </li>
                <li class="topbar-perk-item">
                    <!-- Shield Check Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>Garansi Barang Original</span>
                </li>
                <li class="topbar-perk-item">
                    <!-- Refresh / Return Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                        <path d="M3 3v5h5"></path>
                        <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path>
                        <path d="M16 16h5v5"></path>
                    </svg>
                    <span>Retur 7 Hari Mudah</span>
                </li>
            </ul>

            <div class="topbar-actions">
                <div class="topbar-search-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="topbarProdukSearch" placeholder="Cari Produk...">
                </div>
                <button type="button" class="topbar-cart-btn">Keranjang</button>
            </div>
        </div>
    </div>
    <main class="catalog-main">
        <div class="catalog-container">
            <!-- ini section yang atas (nyesuain figma doang) -->
            <section class="catalog-section" aria-labelledby="sectionKomponenTitle">
                <div class="catalog-section-header">
                    <h2 id="sectionKomponenTitle" class="catalog-section-title">Ban, Aki &amp; Komponen Kendaraan</h2>
                    <a href="#semua-komponen" class="catalog-see-all">Lihat Semua &rarr;</a>
                </div>

                <div class="catalog-grid">
                    @for ($i = 1; $i <= 1; $i++) <! -- Ini Atur Aja ananti biar sesuain isi database nya ada berapa -- >
                        <article class="catalog-card">
                            <div class="catalog-card-thumb"></div>
                            <div class="catalog-card-body">
                                <h3 class="catalog-card-title"></h3>
                                <p class="catalog-card-sub"></p>
                                <div class="catalog-rating">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    <span></span>
                                </div>
                                <strong class="catalog-price"></strong>
                                <button type="button" class="catalog-add-btn">+ Keranjang</button>
                            </div>
                        </article>
                    @endfor
                </div>
            </section>

            <!-- ini section yg rekomen -->
            <section class="catalog-section" aria-labelledby="sectionRekomendasiTitle">
                <div class="catalog-section-header">
                    <h2 id="sectionRekomendasiTitle" class="catalog-section-title">Rekomendasi Produk</h2>
                    <a href="#semua-rekomendasi" class="catalog-see-all">Lihat Semua &rarr;</a>
                </div>

                <div class="catalog-grid">
                    @for ($i = 1; $i <= 1; $i++) <! -- Ini Atur Aja ananti biar sesuain isi database nya ada berapa -- >
                        <article class="catalog-card">
                            <div class="catalog-card-thumb"></div>
                            <div class="catalog-card-body">
                                <h3 class="catalog-card-title"></h3>
                                <p class="catalog-card-sub"></p>
                                <div class="catalog-rating">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    <span></span>
                                </div>
                                <strong class="catalog-price"></strong>
                                <button type="button" class="catalog-add-btn">+ Keranjang</button>
                            </div>
                        </article>
                    @endfor
                </div>
            </section>
        </div>
    </main>
    <x-user-footer :layanan-aktif="$layananAktif ?? collect()" :produk-aktif="$produkAktif ?? collect()" />

    <script>
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
                    }
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
