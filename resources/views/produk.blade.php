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

        .catalog-add-btn:hover:not(:disabled) {
            background-color: #1e293b;
            transform: translateY(-1px);
        }

        .catalog-add-btn:disabled {
            background-color: #a1a1aa;
            cursor: not-allowed;
        }

        /* Modal Keranjang Produk (Sesuai Desain) */
        .produk-modal-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(9, 9, 11, 0.58);
            backdrop-filter: blur(4px);
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
            max-width: 780px;
            background-color: #ffffff;
            border-radius: 14px;
            padding: 24px 0 22px;
            box-shadow: 0 28px 60px -12px rgba(0, 0, 0, 0.32);
            border: 1px solid #d4d4d8;
        }
        .cart-header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px 14px;
        }
        .cart-header-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }
        .cart-clear-all-btn {
            background: transparent;
            border: none;
            color: #6b7280;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 500;
            cursor: pointer;
            padding: 4px 6px;
            border-radius: 6px;
            transition: color 0.15s ease, background-color 0.15s ease;
        }
        .cart-clear-all-btn:hover {
            color: #111827;
            background-color: #f3f4f6;
        }
        .cart-badge-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            margin-left: 7px;
            border-radius: 999px;
            background-color: #111111;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
        }
        .cart-items-list {
            display: flex;
            flex-direction: column;
            max-height: 370px;
            overflow-y: auto;
            border-top: 1px solid #d1d5db;
        }
        .cart-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 18px 28px;
            border-bottom: 1px solid #9ca3af;
            background-color: #ffffff;
        }
        .cart-item-left {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
            flex: 1;
        }
        .cart-item-thumb {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            background: radial-gradient(circle at 50% 45%, #e4e4e7 0%, #d4d4d8 75%, #c7c7cc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            flex-shrink: 0;
            overflow: hidden;
        }
        .cart-item-thumb img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.14));
        }
        .cart-item-info {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .cart-item-name {
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            line-height: 1.35;
        }
        .cart-item-desc {
            font-size: 13.5px;
            font-weight: 500;
            color: #111827;
            line-height: 1.35;
        }
        .cart-item-price {
            font-size: 14.5px;
            font-weight: 800;
            color: #111827;
            margin-top: 8px;
        }
        .cart-item-controls {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
        }
        .cart-stepper-group {
            display: inline-flex;
            align-items: center;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        .cart-qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            background-color: #f3f4f6;
            color: #374151;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.15s ease;
        }
        .cart-qty-btn:hover {
            background-color: #e5e7eb;
        }
        .cart-qty-val {
            width: 34px;
            height: 32px;
            background-color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12.5px;
            font-weight: 600;
            color: #111827;
        }
        .cart-trash-btn {
            background: transparent;
            border: none;
            color: #374151;
            cursor: pointer;
            padding: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s ease, transform 0.15s ease;
        }
        .cart-trash-btn:hover {
            color: #111111;
            transform: scale(1.06);
        }
        .cart-footer-bar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            padding: 20px 28px 2px;
            flex-wrap: wrap;
        }
        .cart-footer-total {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .cart-footer-label {
            font-size: 11px;
            font-weight: 500;
            color: #6b7280;
        }
        .cart-footer-amount {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
            line-height: 1.15;
            letter-spacing: -0.02em;
        }
        .cart-footer-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }
        .btn-cart-cancel {
            height: 38px;
            min-width: 165px;
            padding: 0 24px;
            border-radius: 8px;
            border: none;
            background-color: #6b7280;
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }
        .btn-cart-cancel:hover {
            background-color: #4b5563;
        }
        .btn-cart-pay {
            height: 38px;
            min-width: 210px;
            padding: 0 28px;
            border-radius: 8px;
            border: none;
            background-color: #111111;
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.15s ease, transform 0.15s ease;
        }
        .btn-cart-pay:hover {
            background-color: #27272a;
            transform: translateY(-1px);
        }
        .cart-empty-box {
            text-align: center;
            padding: 42px 24px 24px;
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            border-top: 1px solid #e5e7eb;
        }
        .cart-toast {
            position: fixed;
            right: 24px;
            bottom: 24px;
            background-color: #111111;
            color: #ffffff;
            padding: 13px 18px;
            border-radius: 12px;
            box-shadow: 0 18px 38px rgba(0, 0, 0, 0.28);
            display: none;
            align-items: center;
            gap: 14px;
            z-index: 998;
            font-size: 13px;
            font-weight: 600;
        }
        .cart-toast.show {
            display: inline-flex;
        }
        .cart-toast-btn {
            background-color: #ffffff;
            color: #111111;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
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
                                <span>Booking Saya</span>
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
                @auth
                    <button type="button" class="topbar-cart-btn" id="openCartBtn" onclick="openCartModal()">
                        <span>Keranjang</span>
                        <span class="cart-badge-count" id="cartBadgeCount" style="display:none;">0</span>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="topbar-cart-btn" style="text-decoration:none;">Keranjang</a>
                @endauth
            </div>
        </div>
    </div>
    <main class="catalog-main">
        <div class="catalog-container">
            @if (session('success'))
                <div class="user-alert user-alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="user-alert user-alert-error">{{ $errors->first() }}</div>
            @endif

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
                    <p class="empty-catalog-desc">Produk akan muncul otomatis disini jika tersedia.</p>
                </div>
            @else
                <!-- Section 1: Ban, Aki & Komponen Kendaraan -->
                <section class="catalog-section" id="semua-komponen" aria-labelledby="sectionKomponenTitle">
                    <div class="catalog-section-header">
                        <h2 id="sectionKomponenTitle" class="catalog-section-title">Ban, Aki &amp; Komponen Kendaraan</h2>
                        <a href="#semua-komponen" class="catalog-see-all">Lihat Semua &rarr;</a>
                    </div>

                    <div class="catalog-grid">
                        @foreach ($produkAktif as $produk)
                            @php
                                $stokProduk = (int) ($produk->stok ?? 0);
                                $stokHabis = $stokProduk <= 0;
                                $deskripsiProduk = $produk->deskripsi ?: ($produk->kategori ?: 'Suku Cadang Resmi');
                            @endphp
                            <article class="catalog-card" data-search="{{ strtolower($produk->nama_produk . ' ' . $deskripsiProduk) }}">
                                <div class="catalog-card-thumb">
                                    @if ($produk->gambar_url)
                                        <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama_produk }}">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#52525b" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" style="width:72px; height:72px;">
                                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="catalog-card-body">
                                    <h3 class="catalog-card-title">{{ $produk->nama_produk }}</h3>
                                    <p class="catalog-card-sub">{{ $deskripsiProduk }}</p>
                                    <div class="catalog-rating">
                                        <svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        <span>4.9 &bull; {{ $stokHabis ? 'Stok Habis' : 'Stok: ' . $stokProduk . ' Pcs' }}</span>
                                    </div>
                                    <strong class="catalog-price">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</strong>
                                    @auth
                                        <button
                                            type="button"
                                            class="catalog-add-btn"
                                            {{ $stokHabis ? 'disabled' : '' }}
                                            onclick="addToCart({{ $produk->id }}, @js($produk->nama_produk), @js($deskripsiProduk), {{ (float) $produk->harga_jual }}, {{ $stokProduk }}, @js($produk->gambar_url))"
                                        >
                                            {{ $stokHabis ? 'Stok Habis' : '+ Keranjang' }}
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="catalog-add-btn" style="text-decoration:none;">+ Keranjang</a>
                                    @endauth
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <!-- Section 2: Rekomendasi Produk -->
                <section class="catalog-section" id="semua-rekomendasi" aria-labelledby="sectionRekomendasiTitle">
                    <div class="catalog-section-header">
                        <h2 id="sectionRekomendasiTitle" class="catalog-section-title">Rekomendasi Produk</h2>
                        <a href="#semua-rekomendasi" class="catalog-see-all">Lihat Semua &rarr;</a>
                    </div>

                    <div class="catalog-grid">
                        @foreach ($produkAktif as $produk)
                            @php
                                $stokProduk = (int) ($produk->stok ?? 0);
                                $stokHabis = $stokProduk <= 0;
                                $deskripsiProduk = $produk->deskripsi ?: ($produk->kategori ?: 'Suku Cadang Resmi');
                            @endphp
                            <article class="catalog-card" data-search="{{ strtolower($produk->nama_produk . ' ' . $deskripsiProduk) }}">
                                <div class="catalog-card-thumb">
                                    @if ($produk->gambar_url)
                                        <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama_produk }}">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#52525b" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" style="width:72px; height:72px;">
                                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="catalog-card-body">
                                    <h3 class="catalog-card-title">{{ $produk->nama_produk }}</h3>
                                    <p class="catalog-card-sub">{{ $deskripsiProduk }}</p>
                                    <div class="catalog-rating">
                                        <svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        <span>4.9 &bull; {{ $stokHabis ? 'Stok Habis' : 'Stok: ' . $stokProduk . ' Pcs' }}</span>
                                    </div>
                                    <strong class="catalog-price">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</strong>
                                    @auth
                                        <button
                                            type="button"
                                            class="catalog-add-btn"
                                            {{ $stokHabis ? 'disabled' : '' }}
                                            onclick="addToCart({{ $produk->id }}, @js($produk->nama_produk), @js($deskripsiProduk), {{ (float) $produk->harga_jual }}, {{ $stokProduk }}, @js($produk->gambar_url))"
                                        >
                                            {{ $stokHabis ? 'Stok Habis' : '+ Keranjang' }}
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="catalog-add-btn" style="text-decoration:none;">+ Keranjang</a>
                                    @endauth
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <div class="empty-catalog-box" id="produkEmptySearch" style="display:none;">
                    <h2 class="empty-catalog-title">Produk Tidak Ditemukan</h2>
                    <p class="empty-catalog-desc">Tidak ada produk yang cocok dengan kata kunci pencarian Anda.</p>
                </div>
            @endif
        </div>
    </main>

    @auth
        <!-- Floating Toast Notifikasi Keranjang -->
        <div class="cart-toast" id="cartToast" role="status" aria-live="polite">
            <span id="cartToastText">Produk ditambahkan ke keranjang</span>
            <button type="button" class="cart-toast-btn" onclick="openCartModal()">Lihat Keranjang</button>
        </div>

        <!-- Modal Keranjang Belanja (Sesuai Desain) -->
        <div class="produk-modal-overlay" id="produkOrderModal" aria-hidden="true">
            <div class="produk-modal-card" role="dialog" aria-modal="true" aria-labelledby="produkModalTitle">
                <div class="cart-header-bar">
                    <h2 id="produkModalTitle" class="cart-header-title">Keranjang</h2>
                    <button type="button" class="cart-clear-all-btn" id="btnClearAllCart" onclick="clearAllCart()">Hapus Semua</button>
                </div>

                <div id="cartEmptyState" class="cart-empty-box" style="display:none;">
                    Keranjang belanja Anda masih kosong.<br>Silakan klik tombol <strong>+ Keranjang</strong> pada produk yang ingin dipesan.
                    <div style="margin-top: 18px;">
                        <button type="button" class="btn-cart-cancel" onclick="closeProdukOrderModal()">Tutup</button>
                    </div>
                </div>

                <form method="POST" action="{{ route('user.pesanan.store') }}" id="produkOrderForm">
                    @csrf
                    <input type="hidden" name="kategori" value="produk">
                    <input type="hidden" name="cart_items" id="modalCartItemsInput" value="">
                    <input type="hidden" name="jadwal_service" id="modalJadwalService" value="">

                    <!-- Daftar Item di Keranjang -->
                    <div class="cart-items-list" id="cartItemsList"></div>

                    <!-- Footer Keranjang: Total Pembayaran & Tombol Batalkan / Bayar -->
                    <div class="cart-footer-bar">
                        <div class="cart-footer-total">
                            <span class="cart-footer-label">Total Pembayaran</span>
                            <strong class="cart-footer-amount" id="cartTotalPriceText">Rp 0</strong>
                        </div>

                        <div class="cart-footer-actions">
                            <button type="button" class="btn-cart-cancel" onclick="closeProdukOrderModal()">Batalkan</button>
                            <button type="submit" class="btn-cart-pay" id="btnCheckoutSubmit">Bayar</button>
                        </div>
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
                el.textContent = d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
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
            previewEl.textContent = `${tanggalFormatted} • Pukul ${jamVal.replace(':', '.')} WITA`;

            document.querySelectorAll('[data-date-offset]').forEach(function (btn) {
                btn.classList.toggle('active', tglVal === getOffsetDateString(btn.dataset.dateOffset));
            });
            document.querySelectorAll('.pickup-time-btn').forEach(function (btn) {
                btn.classList.toggle('active', btn.dataset.time === jamVal);
            });
        }

        const CART_STORAGE_KEY = 'hg_produk_cart_{{ auth()->id() ?? "guest" }}';
        const PRODUK_GAMBAR_MAP = @js(($produkAktif ?? collect())->pluck('gambar_url', 'id'));
        let cartItems = [];
        let toastTimer = null;

        function loadCartFromStorage() {
            try {
                const raw = localStorage.getItem(CART_STORAGE_KEY);
                const parsed = raw ? JSON.parse(raw) : [];
                cartItems = Array.isArray(parsed) ? parsed.map(function (item) {
                    if (PRODUK_GAMBAR_MAP && PRODUK_GAMBAR_MAP[item.id]) {
                        item.gambar_url = PRODUK_GAMBAR_MAP[item.id];
                    }
                    return item;
                }) : [];
            } catch (err) {
                cartItems = [];
            }
            syncCartBadge();
        }

        function saveCartToStorage() {
            try {
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cartItems));
            } catch (err) {}
            syncCartBadge();
        }

        function formatRupiah(amount) {
            return 'Rp ' + Math.round(Number(amount || 0)).toLocaleString('id-ID');
        }

        function syncCartBadge() {
            const badge = document.getElementById('cartBadgeCount');
            if (!badge) return;
            const totalQty = cartItems.reduce((sum, item) => sum + Number(item.qty || 1), 0);
            if (totalQty > 0) {
                badge.textContent = totalQty;
                badge.style.display = 'inline-flex';
            } else {
                badge.textContent = '0';
                badge.style.display = 'none';
            }
        }

        function showCartToast(message) {
            const toast = document.getElementById('cartToast');
            const textEl = document.getElementById('cartToastText');
            if (!toast || !textEl) return;
            textEl.textContent = message;
            toast.classList.add('show');
            if (toastTimer) clearTimeout(toastTimer);
            toastTimer = setTimeout(() => {
                toast.classList.remove('show');
            }, 3500);
        }

        function addToCart(id, nama, deskripsi, harga, stokMaks, gambarUrl) {
            const existing = cartItems.find((item) => Number(item.id) === Number(id));
            if (existing) {
                if (existing.qty >= stokMaks) {
                    alert('Jumlah di keranjang sudah mencapai batas stok tersedia (' + stokMaks + ' Pcs).');
                    return;
                }
                existing.qty += 1;
                if (gambarUrl) existing.gambar_url = gambarUrl;
            } else {
                cartItems.push({
                    id: Number(id),
                    nama: nama,
                    deskripsi: deskripsi || '',
                    harga: Number(harga),
                    stok: Number(stokMaks),
                    gambar_url: gambarUrl || null,
                    qty: 1,
                });
            }
            saveCartToStorage();
            renderCartModalItems();
            showCartToast(nama + ' ditambahkan ke Keranjang');
        }

        function clearAllCart() {
            cartItems = [];
            saveCartToStorage();
            renderCartModalItems();
        }

        function updateCartItemQty(id, delta) {
            const idx = cartItems.findIndex((item) => Number(item.id) === Number(id));
            if (idx === -1) return;
            const item = cartItems[idx];
            const nextQty = item.qty + delta;
            if (nextQty <= 0) {
                cartItems.splice(idx, 1);
            } else if (nextQty <= item.stok) {
                item.qty = nextQty;
            } else {
                alert('Stok maksimal untuk produk ini adalah ' + item.stok + ' Pcs.');
            }
            saveCartToStorage();
            renderCartModalItems();
        }

        function removeCartItem(id) {
            cartItems = cartItems.filter((item) => Number(item.id) !== Number(id));
            saveCartToStorage();
            renderCartModalItems();
        }

        function renderCartModalItems() {
            const listEl = document.getElementById('cartItemsList');
            const emptyEl = document.getElementById('cartEmptyState');
            const formEl = document.getElementById('produkOrderForm');
            const clearAllBtn = document.getElementById('btnClearAllCart');
            const totalPriceEl = document.getElementById('cartTotalPriceText');
            const hiddenInput = document.getElementById('modalCartItemsInput');

            if (!listEl || !emptyEl || !formEl) return;

            if (cartItems.length === 0) {
                emptyEl.style.display = 'block';
                formEl.style.display = 'none';
                if (clearAllBtn) clearAllBtn.style.display = 'none';
                listEl.innerHTML = '';
                if (hiddenInput) hiddenInput.value = '';
                return;
            }

            emptyEl.style.display = 'none';
            formEl.style.display = 'block';
            if (clearAllBtn) clearAllBtn.style.display = '';

            let totalPrice = 0;
            listEl.innerHTML = cartItems.map(function (item) {
                const sub = item.harga * item.qty;
                totalPrice += sub;
                const resolvedImg = (PRODUK_GAMBAR_MAP && PRODUK_GAMBAR_MAP[item.id]) || item.gambar_url || null;
                const thumbHtml = resolvedImg
                    ? `<img src="${resolvedImg}" alt="${item.nama}">`
                    : `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#52525b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="width:36px; height:36px;">
                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                       </svg>`;
                const descLine = item.deskripsi
                    ? `<span class="cart-item-desc">(${item.deskripsi})</span>`
                    : '';

                return `
                    <div class="cart-item-row">
                        <div class="cart-item-left">
                            <div class="cart-item-thumb">${thumbHtml}</div>
                            <div class="cart-item-info">
                                <span class="cart-item-name">${item.nama}</span>
                                ${descLine}
                                <strong class="cart-item-price">${formatRupiah(item.harga)}</strong>
                            </div>
                        </div>
                        <div class="cart-item-controls">
                            <div class="cart-stepper-group">
                                <button type="button" class="cart-qty-btn" onclick="updateCartItemQty(${item.id}, -1)" aria-label="Kurangi">&minus;</button>
                                <span class="cart-qty-val">${item.qty}</span>
                                <button type="button" class="cart-qty-btn" onclick="updateCartItemQty(${item.id}, 1)" aria-label="Tambah">+</button>
                            </div>
                            <button type="button" class="cart-trash-btn" onclick="removeCartItem(${item.id})" title="Hapus" aria-label="Hapus item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"></path>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');

            if (totalPriceEl) totalPriceEl.textContent = formatRupiah(totalPrice);
            if (hiddenInput) {
                hiddenInput.value = JSON.stringify(cartItems.map((i) => ({ id: i.id, qty: i.qty })));
            }
        }

        function getAutoPickupDateTime() {
            const now = new Date();
            const yyyy = now.getFullYear();
            const mm = String(now.getMonth() + 1).padStart(2, '0');
            const dd = String(now.getDate()).padStart(2, '0');
            let hh = now.getHours();
            let min = now.getMinutes();
            if (hh < 8) {
                hh = 8;
                min = 0;
            } else if (hh >= 22) {
                hh = 21;
                min = 30;
            }
            return `${yyyy}-${mm}-${dd} ${String(hh).padStart(2, '0')}:${String(min).padStart(2, '0')}:00`;
        }

        function openCartModal() {
            const modal = document.getElementById('produkOrderModal');
            if (!modal) return;
            const toast = document.getElementById('cartToast');
            if (toast) toast.classList.remove('show');

            renderCartModalItems();
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
            loadCartFromStorage();
            populateQuickDateSubtitles();
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
                    if (cartItems.length === 0) {
                        e.preventDefault();
                        alert('Keranjang belanja masih kosong.');
                        return;
                    }
                    document.getElementById('modalJadwalService').value = getAutoPickupDateTime();
                    document.getElementById('modalCartItemsInput').value = JSON.stringify(
                        cartItems.map((i) => ({ id: i.id, qty: i.qty }))
                    );
                    try {
                        localStorage.removeItem(CART_STORAGE_KEY);
                    } catch (err) {}
                });
            }

            const searchInput = document.getElementById('topbarProdukSearch');
            const cards = Array.from(document.querySelectorAll('.catalog-card'));
            const sections = Array.from(document.querySelectorAll('.catalog-section'));
            const emptySearch = document.getElementById('produkEmptySearch');

            if (searchInput && cards.length > 0) {
                searchInput.addEventListener('input', function () {
                    const q = this.value.toLowerCase().trim();
                    let totalVisible = 0;
                    sections.forEach(function (sec) {
                        let secVisible = 0;
                        sec.querySelectorAll('.catalog-card').forEach(function (card) {
                            const match = (card.dataset.search || '').includes(q);
                            card.style.display = match ? '' : 'none';
                            if (match) {
                                secVisible++;
                                totalVisible++;
                            }
                        });
                        sec.style.display = secVisible === 0 ? 'none' : '';
                    });
                    if (emptySearch) {
                        emptySearch.style.display = totalVisible === 0 ? '' : 'none';
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
