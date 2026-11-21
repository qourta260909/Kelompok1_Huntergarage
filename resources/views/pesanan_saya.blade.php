<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hunter Garage - Detail Pemesanan &amp; Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/user.css')
    <style>
        body {
            background-color: #ffffff;
            color: #111111;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        /* ================= HERO BANNER ================= */
        .order-hero-banner {
            width: 100%;
            min-height: 235px;
            background-image: linear-gradient(90deg, rgba(212, 212, 216, 0.92) 0%, rgba(161, 161, 170, 0.72) 48%, rgba(24, 24, 27, 0.35) 100%), url('{{ Vite::asset("resources/images/layanan-hero.png") }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #d4d4d8;
        }
        .order-hero-inner {
            width: min(1320px, 100%);
            margin: 0 auto;
            padding: 34px 42px;
        }
        .order-hero-title {
            max-width: 18ch;
            font-size: clamp(26px, 3vw, 38px);
            font-weight: 800;
            line-height: 1.16;
            color: #09090b;
            letter-spacing: -0.02em;
            margin: 0 0 10px;
        }
        .order-hero-desc {
            max-width: 60ch;
            font-size: 13px;
            font-weight: 500;
            color: #27272a;
            line-height: 1.55;
            margin-bottom: 18px;
        }
        .order-hero-pills {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .hero-pill-amber {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 20px;
            border-radius: 999px;
            background-color: #f59e0b;
            border: 1.5px solid #18181b;
            color: #09090b;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
        }
        .hero-pill-white {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 22px;
            border-radius: 999px;
            background-color: #ffffff;
            border: 1.5px solid #18181b;
            color: #09090b;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.15s ease, transform 0.15s ease;
        }
        .hero-pill-white:hover {
            background-color: #f4f4f5;
            transform: translateY(-1px);
        }

        /* ================= MAIN CONTAINER ================= */
        .order-success-page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 36px 28px 84px;
        }

        /* ================= LAYOUT 1: BOOKING LAYANAN (BKG-xxxx) ================= */
        .bkg-top-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            background-color: #e4e4e7;
            border: 1px solid #71717a;
            border-radius: 16px;
            padding: 18px 28px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }
        .bkg-top-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .bkg-calendar-circle {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background-color: #3f3f46;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .bkg-top-divider {
            width: 2px;
            height: 62px;
            background-color: #27272a;
            flex-shrink: 0;
        }
        .bkg-top-text h2 {
            font-size: clamp(20px, 2.2vw, 25px);
            font-weight: 800;
            color: #09090b;
            line-height: 1.2;
            margin: 0 0 4px;
        }
        .bkg-top-text p {
            font-size: 13px;
            font-weight: 500;
            color: #27272a;
            line-height: 1.4;
            max-width: 42ch;
            margin: 0;
        }
        .bkg-code-box {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            background-color: #ffffff;
            border: 1.2px solid #27272a;
            border-radius: 12px;
            padding: 10px 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        }
        .bkg-code-text {
            font-size: 24px;
            font-weight: 800;
            color: #09090b;
            letter-spacing: -0.02em;
        }
        .bkg-copy-btn {
            background: transparent;
            border: none;
            color: #27272a;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            border-radius: 6px;
            transition: background-color 0.15s ease, color 0.15s ease;
        }
        .bkg-copy-btn:hover {
            background-color: #f4f4f5;
            color: #000000;
        }

        /* Unified 2-Column Booking Card */
        .bkg-main-card {
            display: grid;
            grid-template-columns: 1.55fr 1fr;
            border: 1px solid #a1a1aa;
            border-radius: 16px;
            background-color: #ffffff;
            overflow: hidden;
        }
        .bkg-detail-col {
            border-right: 1px solid #71717a;
            display: flex;
            flex-direction: column;
        }
        .bkg-detail-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 26px;
            border-bottom: 1px solid #71717a;
        }
        .bkg-detail-title {
            font-size: 20px;
            font-weight: 800;
            color: #09090b;
            margin: 0;
        }
        .bkg-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            border: 1.2px solid currentColor;
        }
        .bkg-status-pill.waiting {
            color: #d97706;
            background-color: #fffbeb;
        }
        .bkg-status-pill.done {
            color: #15803d;
            background-color: #f0fdf4;
        }
        .bkg-status-pill.rejected {
            color: #dc2626;
            background-color: #fef2f2;
        }
        .bkg-rows-list {
            display: flex;
            flex-direction: column;
        }
        .bkg-row {
            display: grid;
            grid-template-columns: 185px 1fr;
            align-items: center;
            gap: 16px;
            padding: 11px 26px;
            border-bottom: 1px solid #71717a;
            font-size: 13.5px;
        }
        .bkg-row-key {
            color: #52525b;
            font-weight: 600;
        }
        .bkg-row-val {
            color: #09090b;
            font-weight: 700;
        }
        .bkg-detail-bottom {
            padding: 16px 26px 22px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .bkg-total-bar {
            display: grid;
            grid-template-columns: 185px 1fr;
            align-items: center;
            gap: 16px;
            background-color: #e4e4e7;
            border-radius: 12px;
            padding: 12px 22px;
        }
        .bkg-total-label,
        .bkg-total-val {
            font-size: 20px;
            font-weight: 800;
            color: #09090b;
        }
        .bkg-actions-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }
        .btn-simpan-bukti {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px 26px;
            border-radius: 999px;
            background-color: #52525b;
            border: 1.5px solid #3f3f46;
            color: #ffffff;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.16s ease, transform 0.16s ease;
        }
        .btn-simpan-bukti:hover {
            background-color: #3f3f46;
            transform: translateY(-1px);
        }
        .btn-kembali-beranda {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 30px;
            border-radius: 999px;
            background-color: #ffffff;
            border: 1.5px solid #27272a;
            color: #09090b;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.16s ease, transform 0.16s ease;
        }
        .btn-kembali-beranda:hover {
            background-color: #f4f4f5;
            transform: translateY(-1px);
        }

        /* Right column of Booking Card */
        .bkg-steps-col {
            padding: 22px 28px 26px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 24px;
        }
        .bkg-steps-title {
            font-size: 22px;
            font-weight: 800;
            color: #09090b;
            line-height: 1.2;
            margin: 0;
        }
        .bkg-steps-sub {
            font-size: 12px;
            font-weight: 500;
            color: #3f3f46;
            margin-top: 4px;
            margin-bottom: 24px;
            line-height: 1.45;
        }
        .bkg-timeline {
            display: flex;
            flex-direction: column;
        }
        .bkg-timeline-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            position: relative;
            padding-bottom: 34px;
        }
        .bkg-timeline-item:last-child {
            padding-bottom: 0;
        }
        .bkg-timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 19px;
            top: 40px;
            bottom: 0;
            width: 3px;
            background-color: #18181b;
        }
        .bkg-timeline-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3f3f46;
            color: #ffffff;
            font-size: 17px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            z-index: 1;
        }
        .bkg-timeline-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .bkg-timeline-heading {
            font-size: 13px;
            font-weight: 800;
            color: #09090b;
            line-height: 1.35;
        }
        .bkg-timeline-desc {
            font-size: 11.5px;
            font-weight: 500;
            color: #3f3f46;
            line-height: 1.45;
        }
        .bkg-info-note {
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: #d4d4d8;
            border-radius: 12px;
            padding: 14px 16px;
            color: #52525b;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.4;
        }

        /* ================= LAYOUT 2: PEMESANAN PRODUK (PSN-xxxx) ================= */
        .success-top-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 42px;
        }
        .success-check-circle {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            background-color: #000000;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.18);
        }
        .success-main-heading {
            font-size: clamp(24px, 2.6vw, 30px);
            font-weight: 800;
            color: #09090b;
            line-height: 1.2;
            margin: 0;
        }
        .success-sub-heading {
            font-size: 14px;
            font-weight: 500;
            color: #3f3f46;
            margin-top: 4px;
        }
        .success-order-id {
            font-size: 15px;
            font-weight: 800;
            color: #09090b;
            margin-top: 16px;
            letter-spacing: -0.01em;
        }
        .order-content-grid {
            display: grid;
            grid-template-columns: 1.38fr 0.92fr;
            gap: 54px;
            align-items: flex-start;
        }
        .detail-card {
            background-color: #ffffff;
            border: 1.2px solid #d4d4d8;
            border-radius: 18px;
            padding: 26px 28px 24px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
        }
        .detail-card-title {
            font-size: 17px;
            font-weight: 800;
            color: #09090b;
            line-height: 1.25;
        }
        .detail-card-subtitle {
            font-size: 11.5px;
            font-weight: 500;
            color: #71717a;
            margin-top: 2px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e4e4e7;
        }
        .detail-items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            margin-bottom: 18px;
        }
        .detail-items-table thead th {
            font-size: 11.5px;
            font-weight: 700;
            color: #18181b;
            text-align: left;
            padding: 8px 6px;
            border-bottom: 1px solid #f4f4f5;
        }
        .detail-items-table thead th.col-center,
        .detail-items-table tbody td.col-center {
            text-align: center;
        }
        .detail-items-table tbody td {
            font-size: 12px;
            font-weight: 600;
            color: #27272a;
            padding: 11px 6px;
            border-bottom: 1px solid #f4f4f5;
        }
        .detail-info-list {
            display: flex;
            flex-direction: column;
            border-top: 1px solid #f4f4f5;
            margin-top: 6px;
        }
        .detail-info-row {
            display: grid;
            grid-template-columns: 165px 1fr;
            align-items: center;
            gap: 12px;
            padding: 11px 8px;
            border-bottom: 1px solid #f4f4f5;
            font-size: 12px;
        }
        .detail-info-key {
            color: #52525b;
            font-weight: 500;
        }
        .detail-info-val {
            color: #09090b;
            font-weight: 700;
        }
        .detail-total-row {
            display: flex;
            align-items: baseline;
            justify-content: flex-start;
            gap: 72px;
            padding: 18px 8px 16px;
            border-bottom: 1px solid #f4f4f5;
        }
        .detail-total-label,
        .detail-total-amount {
            font-size: 24px;
            font-weight: 800;
            color: #09090b;
            letter-spacing: -0.02em;
        }
        .detail-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding-top: 16px;
            flex-wrap: wrap;
        }
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
        }
        .status-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            display: inline-block;
        }
        .status-waiting { color: #f59e0b; }
        .status-waiting .status-dot { background-color: #f59e0b; }
        .status-done { color: #16a34a; }
        .status-done .status-dot { background-color: #16a34a; }
        .status-rejected { color: #dc2626; }
        .status-rejected .status-dot { background-color: #dc2626; }
        .btn-lihat-pesanan {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 32px;
            border-radius: 999px;
            background-color: #a1a1aa;
            border: 1.2px solid #3f3f46;
            color: #09090b;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.16s ease, transform 0.16s ease;
        }
        .btn-lihat-pesanan:hover {
            background-color: #d4d4d8;
            transform: translateY(-1px);
        }
        .next-steps-box {
            padding-top: 10px;
        }
        .next-steps-title {
            font-size: 24px;
            font-weight: 800;
            color: #09090b;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }
        .next-steps-sub {
            font-size: 12.5px;
            font-weight: 500;
            color: #71717a;
            margin-top: 4px;
            margin-bottom: 28px;
            max-width: 28ch;
            line-height: 1.45;
        }
        .timeline-list {
            display: flex;
            flex-direction: column;
        }
        .timeline-item {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            position: relative;
            padding-bottom: 36px;
        }
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 19px;
            top: 40px;
            bottom: 0;
            width: 1.5px;
            background-color: #71717a;
        }
        .timeline-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #a1a1aa;
            border: 1.2px solid #52525b;
            color: #ffffff;
            font-size: 17px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            z-index: 1;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.35);
        }
        .timeline-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
            padding-top: 2px;
        }
        .timeline-step-title {
            font-size: 13.5px;
            font-weight: 800;
            color: #09090b;
        }
        .timeline-step-desc {
            font-size: 12px;
            font-weight: 500;
            color: #52525b;
            line-height: 1.5;
            max-width: 32ch;
        }

        /* ================= DAFTAR PESANAN LAINNYA ================= */
        .all-orders-section {
            margin-top: 44px;
            padding-top: 28px;
            border-top: 1px solid #e4e4e7;
            display: none;
        }
        .all-orders-section.visible {
            display: block;
        }
        .all-orders-heading {
            font-size: 17px;
            font-weight: 800;
            color: #09090b;
            margin-bottom: 14px;
        }
        .all-orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 14px;
        }
        .mini-order-card {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 15px 18px;
            border-radius: 14px;
            border: 1.5px solid #e4e4e7;
            background-color: #ffffff;
            text-decoration: none;
            color: inherit;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .mini-order-card:hover,
        .mini-order-card.active {
            border-color: #111111;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
        .mini-order-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 800;
            color: #18181b;
        }
        .mini-order-name {
            font-size: 14px;
            font-weight: 700;
            color: #09090b;
        }
        .mini-order-meta {
            font-size: 12px;
            color: #71717a;
            display: flex;
            justify-content: space-between;
        }

        @media (max-width: 900px) {
            .bkg-main-card,
            .order-content-grid {
                grid-template-columns: 1fr;
            }
            .bkg-detail-col {
                border-right: none;
                border-bottom: 1px solid #71717a;
            }
            .order-hero-inner {
                padding: 28px 20px;
            }
            .bkg-row,
            .bkg-total-bar {
                grid-template-columns: 140px 1fr;
            }
            .detail-info-row {
                grid-template-columns: 135px 1fr;
            }
        }
    </style>
</head>
<body>
    @php
        $daftarPesananUser = $pesananUser ?? collect();
        $selectedId = request()->query('id');
        $activeTabParam = $activeTab ?? request()->query('tab', 'semua');

        if ($selectedId) {
            $pesananAktif = $daftarPesananUser->firstWhere('id', (int) $selectedId) ?? $daftarPesananUser->first();
        } elseif ($activeTabParam === 'jadwal') {
            $pesananAktif = $daftarPesananUser->firstWhere('kategori', 'layanan') ?? $daftarPesananUser->first();
        } elseif ($activeTabParam === 'produk') {
            $pesananAktif = $daftarPesananUser->firstWhere('kategori', 'produk') ?? $daftarPesananUser->first();
        } else {
            $pesananAktif = $daftarPesananUser->first();
        }

        $isLayananView = $pesananAktif && ($pesananAktif->kategori ?? 'layanan') === 'layanan';
    @endphp

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
                    <a class="nav-link {{ $isLayananView ? 'active' : '' }}" href="{{ route('user.layanan') }}">Layanan</a>
                    <a class="nav-link {{ ($pesananAktif && !$isLayananView) ? 'active' : '' }}" href="{{ route('user.produk') }}">Produk</a>
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
                            <a href="{{ route('user.pesanan', ['tab' => 'produk']) }}" class="dropdown-item" role="menuitem">
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

    <!-- Hero Banner Atas -->
    <section class="order-hero-banner" aria-label="Banner Layanan Hunter Garage">
        <div class="order-hero-inner">
            <h1 class="order-hero-title">Perawatan tepat.<br>Perjalanan lebih nyaman.</h1>
            <p class="order-hero-desc">
                Isi data kendaraan, pilih layanan yang tepat, tambahkan keluhan jika ada, dan lengkapi jadwal kunjungan sebelum dikirim ke tim bengkel.
            </p>
            <div class="order-hero-pills">
                <span class="hero-pill-amber">{{ ($layananAktif ?? collect())->count() }} layanan tersedia</span>
                <a href="{{ route('user.layanan') }}" class="hero-pill-white">Booking servis</a>
            </div>
        </div>
    </section>

    <main class="order-success-page">
        @if (!$pesananAktif)
            <div class="empty-catalog-box">
                <div class="empty-catalog-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </div>
                <h2 class="empty-catalog-title">Belum Ada Pesanan atau Booking</h2>
                <p class="empty-catalog-desc">Anda belum memiliki jadwal booking servis maupun pesanan produk.</p>
                <div style="display:flex; gap:12px; margin-top:16px; flex-wrap:wrap; justify-content:center;">
                    <a href="{{ route('user.layanan') }}" class="produk-order-btn">Booking Servis</a>
                    <a href="{{ route('user.produk') }}" class="booking-prev-btn" style="text-decoration:none; display:inline-flex; align-items:center;">Lihat Katalog Produk</a>
                </div>
            </div>
        @elseif ($isLayananView)
            {{-- ================= TAMPILAN BOOKING SERVIS (BKG-xxxx) ================= --}}
            @php
                $kodeBooking = 'BKG-' . str_pad((string) $pesananAktif->id, 4, '0', STR_PAD_LEFT);
                $jadwalRow = $pesananAktif->jadwalService;
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

                $waktuPesanan = $pesananAktif->jadwal_service ?? $pesananAktif->created_at;
                $carbonWaktu = $waktuPesanan ? \Carbon\Carbon::parse($waktuPesanan)->locale('id') : null;
                $tanggalBooking = $carbonWaktu ? $carbonWaktu->translatedFormat('j F Y') : '-';
                $jamBooking = $carbonWaktu ? ($carbonWaktu->format('H.i') . ' WITA') : '-';

                $statusPesanan = $pesananAktif->status ?? 'baru';
                if ($statusPesanan === 'selesai') {
                    $pillClass = 'done';
                    $pillText = 'Jadwal Dikonfirmasi';
                } elseif ($statusPesanan === 'dibatalkan') {
                    $pillClass = 'rejected';
                    $pillText = 'Booking Ditolak';
                } else {
                    $pillClass = 'waiting';
                    $pillText = 'Menunggu Konfirmasi';
                }
            @endphp

            <!-- Banner Abu-Abu Atas: Booking Berhasil dikirim + BKG-xxxx -->
            <div class="bkg-top-banner">
                <div class="bkg-top-left">
                    <div class="bkg-calendar-circle" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <path d="m11 16 2 2 4-4"></path>
                            <line x1="7" y1="14" x2="9" y2="14"></line>
                            <line x1="7" y1="17" x2="9" y2="17"></line>
                        </svg>
                    </div>
                    <div class="bkg-top-divider" aria-hidden="true"></div>
                    <div class="bkg-top-text">
                        <h2>Booking Berhasil dikirim</h2>
                        <p>Jadwal servis kamu sudah terdaftar. Silakan simpan kode berikut</p>
                    </div>
                </div>

                <div class="bkg-code-box">
                    <span class="bkg-code-text" id="bookingCodeValue">{{ $kodeBooking }}</span>
                    <button type="button" class="bkg-copy-btn" onclick="copyBookingCode()" title="Salin Kode Booking" aria-label="Salin Kode Booking">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Kartu Utama 2 Kolom: Detail Booking & Langkah Selanjutnya -->
            <div class="bkg-main-card">
                <section class="bkg-detail-col" aria-label="Detail Booking">
                    <div class="bkg-detail-header">
                        <h3 class="bkg-detail-title">Detail Booking</h3>
                        <span class="bkg-status-pill {{ $pillClass }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            {{ $pillText }}
                        </span>
                    </div>

                    <div class="bkg-rows-list">
                        <div class="bkg-row">
                            <span class="bkg-row-key">Id booking</span>
                            <strong class="bkg-row-val">{{ $kodeBooking }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Kendaraan</span>
                            <strong class="bkg-row-val">{{ $namaKendaraan }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Tahun</span>
                            <strong class="bkg-row-val">{{ $tahunKendaraan }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Plat Nomor</span>
                            <strong class="bkg-row-val">{{ $platNomor }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Layanan</span>
                            <strong class="bkg-row-val">{{ $pesananAktif->nama_layanan ?? '-' }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Tanggal</span>
                            <strong class="bkg-row-val">{{ $tanggalBooking }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Waktu</span>
                            <strong class="bkg-row-val">{{ $jamBooking }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Nama</span>
                            <strong class="bkg-row-val">{{ $pesananAktif->nama_pelanggan ?: Auth::user()->name }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Nomor WhatsApp</span>
                            <strong class="bkg-row-val">{{ $pesananAktif->no_telepon ?: '-' }}</strong>
                        </div>
                        <div class="bkg-row">
                            <span class="bkg-row-key">Metode Pembayaran</span>
                            <strong class="bkg-row-val">Qris</strong>
                        </div>
                    </div>

                    <div class="bkg-detail-bottom">
                        <div class="bkg-total-bar">
                            <span class="bkg-total-label">Total</span>
                            <span class="bkg-total-val">Rp{{ number_format($pesananAktif->total_harga, 0, ',', '.') }}</span>
                        </div>

                        <div class="bkg-actions-row">
                            <a href="{{ route('user.pesanan.pdf', $pesananAktif->id) }}" class="btn-simpan-bukti">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Simpan Bukti Booking
                            </a>

                            <a href="{{ route('home') }}" class="btn-kembali-beranda">Kembali Ke Beranda</a>
                        </div>
                    </div>
                </section>

                <aside class="bkg-steps-col" aria-label="Langkah Selanjutnya">
                    <div>
                        <h3 class="bkg-steps-title">Langkah Selanjutnya</h3>
                        <p class="bkg-steps-sub">Ikuti Langkah Berikut Untuk Proses<br>Service</p>

                        <div class="bkg-timeline">
                            <div class="bkg-timeline-item">
                                <span class="bkg-timeline-circle">1</span>
                                <div class="bkg-timeline-content">
                                    <strong class="bkg-timeline-heading">Admin akan mengkonfirmasikan<br>Jadwal</strong>
                                    <span class="bkg-timeline-desc">Kami akan Menghubungi anda lewat<br>whatsApp</span>
                                </div>
                            </div>

                            <div class="bkg-timeline-item">
                                <span class="bkg-timeline-circle">2</span>
                                <div class="bkg-timeline-content">
                                    <strong class="bkg-timeline-heading">Datang sesuai jadwal yang di<br>setujui</strong>
                                    <span class="bkg-timeline-desc">Pastikan datang tepat waktu</span>
                                </div>
                            </div>

                            <div class="bkg-timeline-item">
                                <span class="bkg-timeline-circle">3</span>
                                <div class="bkg-timeline-content">
                                    <strong class="bkg-timeline-heading">Tunjukan Kode booking</strong>
                                    <span class="bkg-timeline-desc">Tunjukan Kode booking yang kami kirim<br>ke pada anda</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bkg-info-note">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>Simpan bukti booking untuk memudahkan pengecekan</span>
                    </div>
                </aside>
            </div>
        @else
            {{-- ================= TAMPILAN PEMESANAN PRODUK (PSN-xxxx) ================= --}}
            @php
                $kodePesanan = 'PSN-' . str_pad((string) $pesananAktif->id, 4, '0', STR_PAD_LEFT);
                $detailDeskripsi = ($pesananAktif->produk)
                    ? ($pesananAktif->produk->deskripsi ?: ($pesananAktif->produk->kategori ?: 'Suku Cadang Resmi'))
                    : 'Suku Cadang Resmi';

                $waktuPesanan = $pesananAktif->jadwal_service ?? $pesananAktif->created_at;
                $carbonWaktu = $waktuPesanan ? \Carbon\Carbon::parse($waktuPesanan)->locale('id') : null;
                $tanggalWaktuTransaksi = $carbonWaktu
                    ? $carbonWaktu->translatedFormat('j F Y, H:i')
                    : '-';

                $statusPesanan = $pesananAktif->status ?? 'baru';
                if ($statusPesanan === 'selesai') {
                    $statusClass = 'status-done';
                    $statusText = 'Pesanan Dikonfirmasi';
                } elseif ($statusPesanan === 'dibatalkan') {
                    $statusClass = 'status-rejected';
                    $statusText = 'Pesanan Ditolak';
                } else {
                    $statusClass = 'status-waiting';
                    $statusText = 'Menunggu Konfirmasi';
                }
            @endphp

            <div class="success-top-center">
                <div class="success-check-circle" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <h2 class="success-main-heading">Pemesanan berhasil</h2>
                <p class="success-sub-heading">Pesananmu sudah masuk dan menunggu konfirmasi</p>
                <p class="success-order-id">ID pesanan:{{ $kodePesanan }}</p>
            </div>

            <div class="order-content-grid">
                <section class="detail-card" aria-label="Detail Pesanan">
                    <h3 class="detail-card-title">Detail Pesanan</h3>
                    <p class="detail-card-subtitle">Berikut informasi lengkap pesanan kamu</p>

                    <table class="detail-items-table">
                        <thead>
                            <tr>
                                <th style="width:36px;">No</th>
                                <th>Nama</th>
                                <th>detail</th>
                                <th>Harga</th>
                                <th class="col-center" style="width:64px;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>{{ $pesananAktif->nama_layanan ?? '-' }}</td>
                                <td>{{ $detailDeskripsi }}</td>
                                <td>Rp {{ number_format($pesananAktif->total_harga, 0, ',', '.') }}</td>
                                <td class="col-center">1</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="detail-info-list">
                        <div class="detail-info-row">
                            <span class="detail-info-key">Nama</span>
                            <strong class="detail-info-val">{{ $pesananAktif->nama_pelanggan ?: Auth::user()->name }}</strong>
                        </div>
                        <div class="detail-info-row">
                            <span class="detail-info-key">Id Pesanan</span>
                            <strong class="detail-info-val">{{ $kodePesanan }}</strong>
                        </div>
                        <div class="detail-info-row">
                            <span class="detail-info-key">Alamat</span>
                            <strong class="detail-info-val">Jl. Taruna Praja Banjarbaru</strong>
                        </div>
                        <div class="detail-info-row">
                            <span class="detail-info-key">Tanggal, Waktu Transaksi</span>
                            <strong class="detail-info-val">{{ $tanggalWaktuTransaksi }}</strong>
                        </div>
                        <div class="detail-info-row">
                            <span class="detail-info-key">Metode Pengambilan</span>
                            <strong class="detail-info-val">Ambil di Bengkel Hunter Garage</strong>
                        </div>
                        <div class="detail-info-row">
                            <span class="detail-info-key">Metode Pembayaran</span>
                            <strong class="detail-info-val">Qris / Tunai</strong>
                        </div>
                    </div>

                    <div class="detail-total-row">
                        <span class="detail-total-label">Total</span>
                        <span class="detail-total-amount">Rp {{ number_format($pesananAktif->total_harga, 0, ',', '.') }}</span>
                    </div>

                    <div class="detail-card-footer">
                        <span class="status-indicator {{ $statusClass }}">
                            <span class="status-dot"></span>
                            {{ $statusText }}
                        </span>

                        <button type="button" class="btn-lihat-pesanan" onclick="toggleAllOrdersSection()">
                            Lihat pesanan anda
                        </button>
                    </div>
                </section>

                <aside class="next-steps-box" aria-label="Langkah Selanjutnya">
                    <h3 class="next-steps-title">Langkah Selanjutnya</h3>
                    <p class="next-steps-sub">
                        Ikuti Langkah Berikut Untuk pemesanan produk
                    </p>

                    <div class="timeline-list">
                        <div class="timeline-item">
                            <span class="timeline-circle">1</span>
                            <div class="timeline-text">
                                <strong class="timeline-step-title">Pesanan Dikonfirmasi</strong>
                                <span class="timeline-step-desc">
                                    Admin mengkonfirmasi pesanan anda dan mengecek produk
                                </span>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <span class="timeline-circle">2</span>
                            <div class="timeline-text">
                                <strong class="timeline-step-title">Produk di pesan dan disiapkan</strong>
                                <span class="timeline-step-desc">
                                    Produk disiapkan oleh tim bengkel sesuai jadwal pengambilan anda
                                </span>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <span class="timeline-circle">3</span>
                            <div class="timeline-text">
                                <strong class="timeline-step-title">Terima dan periksa pesanan</strong>
                                <span class="timeline-step-desc">
                                    Terima produk dan mengkonfirmasi pesanan anda
                                </span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        @endif

        @if ($daftarPesananUser->count() > 1)
            <section class="all-orders-section {{ $isLayananView ? 'visible' : '' }}" id="allOrdersSection" aria-label="Riwayat Pesanan Anda">
                <h3 class="all-orders-heading">Riwayat Pesanan &amp; Booking Anda ({{ $daftarPesananUser->count() }})</h3>
                <div class="all-orders-grid">
                    @foreach ($daftarPesananUser as $itemPesanan)
                        @php
                            $prefixItem = ($itemPesanan->kategori ?? 'layanan') === 'layanan' ? 'BKG-' : 'PSN-';
                            $kodeItem = $prefixItem . str_pad((string) $itemPesanan->id, 4, '0', STR_PAD_LEFT);
                            $waktuItem = $itemPesanan->jadwal_service ?? $itemPesanan->created_at;
                            $tglItem = $waktuItem ? \Carbon\Carbon::parse($waktuItem)->locale('id')->translatedFormat('d M Y, H:i') : '-';
                            $labelStatusItem = $itemPesanan->status === 'selesai'
                                ? 'Dikonfirmasi'
                                : ($itemPesanan->status === 'dibatalkan' ? 'Ditolak' : 'Menunggu');
                        @endphp
                        <a href="{{ route('user.pesanan', ['id' => $itemPesanan->id]) }}" class="mini-order-card {{ $pesananAktif && $itemPesanan->id === $pesananAktif->id ? 'active' : '' }}">
                            <div class="mini-order-top">
                                <span>{{ $kodeItem }}</span>
                                <span>{{ $labelStatusItem }}</span>
                            </div>
                            <div class="mini-order-name">{{ $itemPesanan->nama_layanan }}</div>
                            <div class="mini-order-meta">
                                <span>{{ $tglItem }}</span>
                                <strong>Rp {{ number_format($itemPesanan->total_harga, 0, ',', '.') }}</strong>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    <x-user-footer :layanan-aktif="$layananAktif ?? collect()" :produk-aktif="$produkAktif ?? collect()" />

    <script>
        function copyBookingCode() {
            const codeEl = document.getElementById('bookingCodeValue');
            if (!codeEl) return;
            const text = codeEl.textContent.trim();
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(function () {
                    alert('Kode booking ' + text + ' berhasil disalin!');
                });
            }
        }

        function toggleAllOrdersSection() {
            const sec = document.getElementById('allOrdersSection');
            if (!sec) return;
            sec.classList.toggle('visible');
            if (sec.classList.contains('visible')) {
                sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
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
