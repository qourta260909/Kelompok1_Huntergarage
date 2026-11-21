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
        .cart-address-box {
            margin: 16px 28px 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .cart-address-label {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .cart-address-input {
            width: 100%;
            min-height: 68px;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1.5px solid #d1d5db;
            background-color: #f9fafb;
            font-family: inherit;
            font-size: 13px;
            color: #111827;
            resize: vertical;
            outline: none;
            transition: border-color 0.15s ease, background-color 0.15s ease;
        }
        .cart-address-input:focus {
            border-color: #111111;
            background-color: #ffffff;
        }
        .cart-payment-box {
            margin: 16px 28px 4px;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid #1d4ed8;
            background-color: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }
        .cart-payment-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .bca-badge {
            background-color: #005baa;
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            font-style: italic;
            letter-spacing: 0.04em;
            padding: 6px 12px;
            border-radius: 8px;
            flex-shrink: 0;
        }
        .cart-payment-info {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }
        .cart-payment-title {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
        }
        .cart-payment-rek {
            font-size: 12.5px;
            font-weight: 600;
            color: #1e40af;
        }
        .cart-copy-rek-btn {
            background-color: #ffffff;
            border: 1px solid #93c5fd;
            color: #1d4ed8;
            font-family: inherit;
            font-size: 11.5px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }
        .cart-copy-rek-btn:hover {
            background-color: #dbeafe;
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
                    <input type="hidden" name="metode_pembayaran" value="Transfer Bank BCA">
                    <input type="hidden" name="cart_items" id="modalCartItemsInput" value="">
                    <input type="hidden" name="jadwal_service" id="modalJadwalService" value="">

                    <!-- Daftar Item di Keranjang -->
                    <div class="cart-items-list" id="cartItemsList"></div>

                    <!-- Input Alamat Pengiriman Pembeli -->
                    <div class="cart-address-box">
                        <label for="inputAlamatPembeli" class="cart-address-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Alamat Pengiriman
                        </label>
                        <textarea
                            id="inputAlamatPembeli"
                            name="alamat"
                            class="cart-address-input"
                            placeholder="Masukkan alamat lengkap pengiriman (Nama jalan, No. rumah, Kecamatan, Kota)..."
                            required
                        >{{ old('alamat') }}</textarea>
                    </div>

                    <!-- Metode Pembayaran: Transfer Bank BCA -->
                    <div class="cart-payment-box">
                        <div class="cart-payment-left">
                            <span class="bca-badge">BCA</span>
                            <div class="cart-payment-info">
                                <span class="cart-payment-title">Metode Pembayaran: Transfer Bank BCA</span>
                                <span class="cart-payment-rek">No. Rek: <strong id="noRekBca">7896207902</strong> a/n Ahmad Qourta Zaidan</span>
                            </div>
                        </div>
                        <button type="button" class="cart-copy-rek-btn" onclick="navigator.clipboard.writeText('7896207902'); alert('Nomor Rekening BCA berhasil disalin!');">
                            Salin No. Rek
                        </button>
                    </div>

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
        // =====================================================================
        // 1. DATA KERANJANG (Disimpan di Browser / localStorage)
        // =====================================================================
        const KEY_KERANJANG = 'hg_produk_cart_{{ auth()->id() ?? "guest" }}';
        let keranjang = [];
        let timerToast = null;

        // Ubah angka jadi format Rupiah (Contoh: 50000 -> "Rp 50.000")
        function formatRupiah(angka) {
            return 'Rp ' + Math.round(Number(angka || 0)).toLocaleString('id-ID');
        }

        // Ambil isi keranjang dari localStorage saat halaman pertama kali dibuka
        function muatKeranjang() {
            const dataTersimpan = localStorage.getItem(KEY_KERANJANG);
            keranjang = dataTersimpan ? JSON.parse(dataTersimpan) : [];
            updateBadgeKeranjang();
        }

        // Simpan isi keranjang ke localStorage setiap ada perubahan
        function simpanKeranjang() {
            localStorage.setItem(KEY_KERANJANG, JSON.stringify(keranjang));
            updateBadgeKeranjang();
        }

        // Update angka jumlah barang di tombol "Keranjang" (pojok kanan atas)
        function updateBadgeKeranjang() {
            const badge = document.getElementById('cartBadgeCount');
            if (!badge) return;

            let totalBarang = 0;
            keranjang.forEach(function (item) {
                totalBarang += item.qty;
            });

            if (totalBarang > 0) {
                badge.textContent = totalBarang;
                badge.style.display = 'inline-flex';
            } else {
                badge.style.display = 'none';
            }
        }

        // =====================================================================
        // 2. AKSI KERANJANG (Tambah, Kurang, Hapus, Kosongkan)
        // =====================================================================

        // Dipanggil saat tombol "+ Keranjang" pada kartu produk diklik
        function addToCart(id, nama, deskripsi, harga, stokMaks, gambarUrl) {
            // Cek apakah produk sudah ada di dalam keranjang
            const itemSudahAda = keranjang.find(function (item) {
                return item.id === Number(id);
            });

            if (itemSudahAda) {
                // Kalau sudah ada, tambah jumlahnya (+1) selama belum lewat stok
                if (itemSudahAda.qty >= stokMaks) {
                    alert('Jumlah di keranjang sudah mencapai batas stok (' + stokMaks + ' Pcs).');
                    return;
                }
                itemSudahAda.qty += 1;
            } else {
                // Kalau belum ada, masukkan produk baru ke keranjang
                keranjang.push({
                    id: Number(id),
                    nama: nama,
                    deskripsi: deskripsi || '',
                    harga: Number(harga),
                    stok: Number(stokMaks),
                    gambar_url: gambarUrl || null,
                    qty: 1
                });
            }

            simpanKeranjang();
            tampilkanIsiModalKeranjang();
            tampilkanNotifikasiToast(nama + ' ditambahkan ke Keranjang');
        }

        // Dipanggil saat tombol (+) atau (-) di dalam modal keranjang diklik
        function updateCartItemQty(id, perubahan) {
            const item = keranjang.find(function (i) {
                return i.id === Number(id);
            });
            if (!item) return;

            const jumlahBaru = item.qty + perubahan;

            if (jumlahBaru <= 0) {
                // Kalau dikurangi sampai 0, hapus produk dari keranjang
                removeCartItem(id);
                return;
            }

            if (jumlahBaru > item.stok) {
                alert('Stok maksimal untuk produk ini adalah ' + item.stok + ' Pcs.');
                return;
            }

            item.qty = jumlahBaru;
            simpanKeranjang();
            tampilkanIsiModalKeranjang();
        }

        // Hapus 1 produk dari modal keranjang (ikon tempat sampah)
        function removeCartItem(id) {
            keranjang = keranjang.filter(function (item) {
                return item.id !== Number(id);
            });
            simpanKeranjang();
            tampilkanIsiModalKeranjang();
        }

        // Kosongkan seluruh isi keranjang (tombol "Hapus Semua")
        function clearAllCart() {
            keranjang = [];
            simpanKeranjang();
            tampilkanIsiModalKeranjang();
        }

        // =====================================================================
        // 3. PENGATUR MODAL KERANJANG (Buka, Tutup, dan Render Daftar Produk)
        // =====================================================================

        // Buka modal keranjang
        function openCartModal() {
            const modal = document.getElementById('produkOrderModal');
            if (!modal) return;

            // Sembunyikan toast jika sedang muncul
            const toast = document.getElementById('cartToast');
            if (toast) toast.classList.remove('show');

            tampilkanIsiModalKeranjang();
            modal.classList.add('active');
        }

        // Tutup modal keranjang
        function closeProdukOrderModal() {
            const modal = document.getElementById('produkOrderModal');
            if (!modal) return;
            modal.classList.remove('active');
        }

        // Munculkan notifikasi kecil di bawah layar selama 3.5 detik
        function tampilkanNotifikasiToast(pesan) {
            const toast = document.getElementById('cartToast');
            const textEl = document.getElementById('cartToastText');
            if (!toast || !textEl) return;

            textEl.textContent = pesan;
            toast.classList.add('show');

            if (timerToast) clearTimeout(timerToast);
            timerToast = setTimeout(function () {
                toast.classList.remove('show');
            }, 3500);
        }

        // Gambar daftar barang ke dalam HTML modal keranjang
        function tampilkanIsiModalKeranjang() {
            const wadahList = document.getElementById('cartItemsList');
            const pesanKosong = document.getElementById('cartEmptyState');
            const formKeranjang = document.getElementById('produkOrderForm');
            const btnHapusSemua = document.getElementById('btnClearAllCart');
            const teksTotalHarga = document.getElementById('cartTotalPriceText');
            const inputHiddenItems = document.getElementById('modalCartItemsInput');

            if (!wadahList || !pesanKosong || !formKeranjang) return;

            // Jika keranjang kosong, tampilkan pesan kosong & sembunyikan form
            if (keranjang.length === 0) {
                pesanKosong.style.display = 'block';
                formKeranjang.style.display = 'none';
                if (btnHapusSemua) btnHapusSemua.style.display = 'none';
                wadahList.innerHTML = '';
                return;
            }

            // Jika ada isinya, tampilkan form & tombol Hapus Semua
            pesanKosong.style.display = 'none';
            formKeranjang.style.display = 'block';
            if (btnHapusSemua) btnHapusSemua.style.display = '';

            let totalHarga = 0;
            let htmlDaftarBarang = '';

            keranjang.forEach(function (item) {
                totalHarga += item.harga * item.qty;

                // Gambar produk (atau ikon kotak jika produk tidak punya gambar)
                const gambarHtml = item.gambar_url
                    ? `<img src="${item.gambar_url}" alt="${item.nama}">`
                    : `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#52525b" stroke-width="1.5" style="width:36px; height:36px;">
                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                       </svg>`;

                const deskripsiHtml = item.deskripsi
                    ? `<span class="cart-item-desc">(${item.deskripsi})</span>`
                    : '';

                htmlDaftarBarang += `
                    <div class="cart-item-row">
                        <div class="cart-item-left">
                            <div class="cart-item-thumb">${gambarHtml}</div>
                            <div class="cart-item-info">
                                <span class="cart-item-name">${item.nama}</span>
                                ${deskripsiHtml}
                                <strong class="cart-item-price">${formatRupiah(item.harga)}</strong>
                            </div>
                        </div>
                        <div class="cart-item-controls">
                            <div class="cart-stepper-group">
                                <button type="button" class="cart-qty-btn" onclick="updateCartItemQty(${item.id}, -1)">&minus;</button>
                                <span class="cart-qty-val">${item.qty}</span>
                                <button type="button" class="cart-qty-btn" onclick="updateCartItemQty(${item.id}, 1)">+</button>
                            </div>
                            <button type="button" class="cart-trash-btn" onclick="removeCartItem(${item.id})" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M3 6h18"></path>
                                    <path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"></path>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            });

            wadahList.innerHTML = htmlDaftarBarang;
            if (teksTotalHarga) teksTotalHarga.textContent = formatRupiah(totalHarga);

            // Isi input hidden dengan data JSON [{id, qty}] untuk dikirim ke Controller
            if (inputHiddenItems) {
                const dataUntukBackend = keranjang.map(function (item) {
                    return { id: item.id, qty: item.qty };
                });
                inputHiddenItems.value = JSON.stringify(dataUntukBackend);
            }
        }

        // =====================================================================
        // 4. INISIALISASI SAAT HALAMAN SELESAI DIMUAT
        // =====================================================================
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Muat data keranjang dari localStorage
            muatKeranjang();

            // 2. Dropdown Profil User di Navbar
            const dropdown = document.getElementById('userDropdown');
            const dropdownBtn = document.getElementById('userDropdownBtn');

            if (dropdown && dropdownBtn) {
                dropdownBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('open');
                });

                document.addEventListener('click', function (e) {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('open');
                    }
                });
            }

            // 3. Saat tombol "Bayar" di modal keranjang disubmit
            const orderForm = document.getElementById('produkOrderForm');
            if (orderForm) {
                orderForm.addEventListener('submit', function (e) {
                    if (keranjang.length === 0) {
                        e.preventDefault();
                        alert('Keranjang belanja masih kosong.');
                        return;
                    }

                    // Isi waktu pemesanan otomatis (jam operasional 08:00 - 21:30)
                    const sekarang = new Date();
                    const tanggal = sekarang.toISOString().slice(0, 10);
                    document.getElementById('modalJadwalService').value = tanggal + ' 10:00:00';

                    // Bersihkan keranjang setelah berhasil disubmit
                    localStorage.removeItem(KEY_KERANJANG);
                });
            }

            // 4. Pencarian Produk (Search Bar di Bar Hitam)
            const searchInput = document.getElementById('topbarProdukSearch');
            const sections = document.querySelectorAll('.catalog-section');
            const emptySearch = document.getElementById('produkEmptySearch');

            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const kataKunci = this.value.toLowerCase().trim();
                    let totalKetemu = 0;

                    sections.forEach(function (section) {
                        let ketemuDiSection = 0;

                        section.querySelectorAll('.catalog-card').forEach(function (card) {
                            const teksProduk = card.dataset.search || '';
                            const cocok = teksProduk.includes(kataKunci);

                            card.style.display = cocok ? '' : 'none';
                            if (cocok) {
                                ketemuDiSection++;
                                totalKetemu++;
                            }
                        });

                        section.style.display = ketemuDiSection === 0 ? 'none' : '';
                    });

                    if (emptySearch) {
                        emptySearch.style.display = totalKetemu === 0 ? '' : 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
