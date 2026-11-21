<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hunter Garage - Pesanan Saya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/user.css')
    <style>
        body {
            background-color: #f2f2f2;
            color: #111111;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ================= LAYOUT SIDEBAR PESANAN SAYA ================= */
        .user-panel-layout {
            display: grid;
            grid-template-columns: 245px 1fr;
            min-height: calc(100vh - 83px);
            flex: 1;
        }

        .user-sidebar {
            background-color: #1c1c1e;
            color: #ffffff;
            padding: 26px 18px;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .user-sidebar-profile {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0 6px;
        }

        .user-sidebar-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #d4d4d8;
            color: #18181b;
            font-size: 18px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-sidebar-name {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .user-sidebar-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #a1a1aa;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
            transition: background-color 0.16s ease, color 0.16s ease;
        }

        .user-sidebar-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .user-sidebar-link.active {
            background-color: #27272a;
            color: #ffffff;
            font-weight: 700;
        }

        .user-sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 4px;
            border-radius: 0 4px 4px 0;
            background-color: #f97316;
        }

        .user-sidebar-link svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* Content Area Kanan */
        .user-panel-content {
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
        }

        .user-panel-header {
            padding: 30px 38px 22px;
        }

        .user-panel-title {
            font-size: 26px;
            font-weight: 700;
            color: #09090b;
            line-height: 1.2;
            margin: 0;
            letter-spacing: -0.01em;
        }

        .user-panel-subtitle {
            font-size: 14px;
            font-weight: 500;
            color: #3f3f46;
            margin-top: 4px;
        }

        /* Horizontal Status Filter Bar */
        .status-tabs-bar {
            background-color: #ffffff;
            border-top: 1px solid #d4d4d8;
            border-bottom: 1px solid #d4d4d8;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 28px;
            padding: 0 38px;
            overflow-x: auto;
        }

        .status-tab-btn {
            position: relative;
            background: transparent;
            border: none;
            padding: 16px 18px;
            font-family: inherit;
            font-size: 14.5px;
            font-weight: 600;
            color: #18181b;
            cursor: pointer;
            white-space: nowrap;
            transition: color 0.16s ease;
        }

        .status-tab-btn:hover {
            color: #f59e0b;
        }

        .status-tab-btn.active {
            color: #f59e0b;
            font-weight: 700;
        }

        .status-tab-btn.active::after {
            content: '';
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 10px;
            height: 2.5px;
            background-color: #f59e0b;
            border-radius: 999px;
        }

        /* Panel Body & Empty State */
        .user-panel-body {
            flex: 1;
            padding: 28px 38px 48px;
            display: flex;
            flex-direction: column;
        }

        .orders-empty-state {
            flex: 1;
            min-height: 360px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 18px;
        }

        .orders-empty-title {
            font-size: 22px;
            font-weight: 700;
            color: #09090b;
            margin: 0;
        }

        /* Order List Cards */
        .user-orders-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .user-order-item-card {
            background-color: #ffffff;
            border: 1px solid #d4d4d8;
            border-radius: 14px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
        }

        .user-order-item-left {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .user-order-item-top {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .user-order-code {
            font-size: 13px;
            font-weight: 800;
            color: #09090b;
            background-color: #f4f4f5;
            padding: 4px 10px;
            border-radius: 7px;
        }

        .user-order-status-pill {
            font-size: 11.5px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 999px;
        }

        .user-order-status-pill.waiting {
            background-color: #fef3c7;
            color: #b45309;
        }

        .user-order-status-pill.done {
            background-color: #dcfce7;
            color: #15803d;
        }

        .user-order-status-pill.rejected {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .user-order-item-title {
            font-size: 17px;
            font-weight: 700;
            color: #09090b;
            margin: 2px 0 0;
        }

        .user-order-item-meta {
            font-size: 12.5px;
            color: #52525b;
        }

        .user-order-item-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .user-order-item-price {
            font-size: 18px;
            font-weight: 800;
            color: #09090b;
        }

        .user-order-item-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-order-detail {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 18px;
            border-radius: 9px;
            background-color: #111111;
            color: #ffffff;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }

        .btn-order-detail:hover {
            background-color: #27272a;
        }

        .btn-order-pdf {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 9px;
            border: 1.2px solid #27272a;
            background-color: #ffffff;
            color: #111111;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }

        .btn-order-pdf:hover {
            background-color: #f4f4f5;
        }

        /* ================= HALAMAN KONFIRMASI (SETELAH CHECKOUT / KLIK DETAIL) ================= */
        .confirm-page-wrap {
            background-color: #ffffff;
            flex: 1;
        }
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
        }
        .order-success-page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 36px 28px 72px;
        }

        /* Booking BKG-xxxx Styles */
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
            margin: 0 0 4px;
        }
        .bkg-top-text p {
            font-size: 13px;
            font-weight: 500;
            color: #27272a;
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
        }
        .bkg-code-text {
            font-size: 24px;
            font-weight: 800;
            color: #09090b;
        }
        .bkg-copy-btn {
            background: transparent;
            border: none;
            color: #27272a;
            cursor: pointer;
            padding: 4px;
        }
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
        .bkg-status-pill.waiting { color: #d97706; background-color: #fffbeb; }
        .bkg-status-pill.done { color: #15803d; background-color: #f0fdf4; }
        .bkg-status-pill.rejected { color: #dc2626; background-color: #fef2f2; }
        .bkg-row {
            display: grid;
            grid-template-columns: 185px 1fr;
            align-items: center;
            gap: 16px;
            padding: 11px 26px;
            border-bottom: 1px solid #71717a;
            font-size: 13.5px;
        }
        .bkg-row-key { color: #52525b; font-weight: 600; }
        .bkg-row-val { color: #09090b; font-weight: 700; }
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
        .bkg-total-label, .bkg-total-val {
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
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
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
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
        }
        .bkg-steps-col {
            padding: 22px 28px 26px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 24px;
        }
        .bkg-steps-title { font-size: 22px; font-weight: 800; color: #09090b; margin: 0; }
        .bkg-steps-sub { font-size: 12px; color: #3f3f46; margin-top: 4px; margin-bottom: 24px; }
        .bkg-timeline { display: flex; flex-direction: column; }
        .bkg-timeline-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            position: relative;
            padding-bottom: 34px;
        }
        .bkg-timeline-item:last-child { padding-bottom: 0; }
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
        .bkg-timeline-heading { font-size: 13px; font-weight: 800; color: #09090b; display: block; }
        .bkg-timeline-desc { font-size: 11.5px; color: #3f3f46; }
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
        }

        /* Produk PSN-xxxx Styles */
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
        }
        .success-main-heading { font-size: 28px; font-weight: 800; color: #09090b; margin: 0; }
        .success-sub-heading { font-size: 14px; color: #3f3f46; margin-top: 4px; }
        .success-order-id { font-size: 15px; font-weight: 800; color: #09090b; margin-top: 16px; }
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
        }
        .detail-card-title { font-size: 17px; font-weight: 800; color: #09090b; }
        .detail-card-subtitle { font-size: 11.5px; color: #71717a; margin-top: 2px; padding-bottom: 10px; border-bottom: 1px solid #e4e4e7; }
        .detail-items-table { width: 100%; border-collapse: collapse; margin: 6px 0 18px; }
        .detail-items-table thead th { font-size: 11.5px; font-weight: 700; text-align: left; padding: 8px 6px; border-bottom: 1px solid #f4f4f5; }
        .detail-items-table tbody td { font-size: 12px; font-weight: 600; padding: 11px 6px; border-bottom: 1px solid #f4f4f5; }
        .detail-info-row {
            display: grid;
            grid-template-columns: 165px 1fr;
            align-items: center;
            gap: 12px;
            padding: 11px 8px;
            border-bottom: 1px solid #f4f4f5;
            font-size: 12px;
        }
        .detail-info-key { color: #52525b; }
        .detail-info-val { color: #09090b; font-weight: 700; }
        .detail-total-row {
            display: flex;
            align-items: baseline;
            gap: 72px;
            padding: 18px 8px 16px;
            border-bottom: 1px solid #f4f4f5;
        }
        .detail-total-label, .detail-total-amount { font-size: 24px; font-weight: 800; color: #09090b; }
        .detail-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 16px;
            flex-wrap: wrap;
        }
        .status-indicator { display: inline-flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; }
        .status-dot { width: 11px; height: 11px; border-radius: 50%; display: inline-block; }
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
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }
        .next-steps-title { font-size: 24px; font-weight: 800; color: #09090b; }
        .next-steps-sub { font-size: 12.5px; color: #71717a; margin: 4px 0 28px; }
        .timeline-item { display: flex; align-items: flex-start; gap: 18px; position: relative; padding-bottom: 36px; }
        .timeline-item:last-child { padding-bottom: 0; }
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
        }
        .timeline-step-title { font-size: 13.5px; font-weight: 800; color: #09090b; display: block; }
        .timeline-step-desc { font-size: 12px; color: #52525b; }

        @media (max-width: 900px) {
            .user-panel-layout {
                grid-template-columns: 1fr;
            }
            .bkg-main-card,
            .order-content-grid {
                grid-template-columns: 1fr;
            }
            .bkg-detail-col {
                border-right: none;
                border-bottom: 1px solid #71717a;
            }
        }
    </style>
</head>
<body>
    @php
        $daftarPesananUser = $pesananUser ?? collect();
        $detailId = request()->query('detail') ?: session('just_ordered_id');
        $pesananDetail = $detailId
            ? $daftarPesananUser->firstWhere('id', (int) $detailId)
            : null;
        $activeSidebarTab = ($activeTab ?? request()->query('tab', 'semua')) === 'jadwal' ? 'jadwal' : 'pesanan';
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
                    <a class="nav-link" href="{{ route('user.layanan') }}">Layanan</a>
                    <a class="nav-link" href="{{ route('user.produk') }}">Produk</a>
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

    @if ($pesananDetail)
        {{-- ================= TAMPILAN BUKTI KONFIRMASI SETELAH CHECKOUT / KLIK DETAIL ================= --}}
        @php
            $pesananAktif = $pesananDetail;
            $isLayananView = ($pesananAktif->kategori ?? 'layanan') === 'layanan';
        @endphp
        <div class="confirm-page-wrap">
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
                @if ($isLayananView)
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

                    <div class="bkg-top-banner">
                        <div class="bkg-top-left">
                            <div class="bkg-calendar-circle" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                    <path d="m11 16 2 2 4-4"></path>
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
                            <button type="button" class="bkg-copy-btn" onclick="copyBookingCode()" title="Salin Kode Booking">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

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
                                <div class="bkg-row"><span class="bkg-row-key">Id booking</span><strong class="bkg-row-val">{{ $kodeBooking }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Kendaraan</span><strong class="bkg-row-val">{{ $namaKendaraan }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Tahun</span><strong class="bkg-row-val">{{ $tahunKendaraan }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Plat Nomor</span><strong class="bkg-row-val">{{ $platNomor }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Layanan</span><strong class="bkg-row-val">{{ $pesananAktif->nama_layanan ?? '-' }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Tanggal</span><strong class="bkg-row-val">{{ $tanggalBooking }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Waktu</span><strong class="bkg-row-val">{{ $jamBooking }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Nama</span><strong class="bkg-row-val">{{ $pesananAktif->nama_pelanggan ?: Auth::user()->name }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Nomor WhatsApp</span><strong class="bkg-row-val">{{ $pesananAktif->no_telepon ?: '-' }}</strong></div>
                                <div class="bkg-row"><span class="bkg-row-key">Metode Pembayaran</span><strong class="bkg-row-val">Qris</strong></div>
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
                                        <div>
                                            <strong class="bkg-timeline-heading">Admin akan mengkonfirmasikan<br>Jadwal</strong>
                                            <span class="bkg-timeline-desc">Kami akan Menghubungi anda lewat<br>whatsApp</span>
                                        </div>
                                    </div>
                                    <div class="bkg-timeline-item">
                                        <span class="bkg-timeline-circle">2</span>
                                        <div>
                                            <strong class="bkg-timeline-heading">Datang sesuai jadwal yang di<br>setujui</strong>
                                            <span class="bkg-timeline-desc">Pastikan datang tepat waktu</span>
                                        </div>
                                    </div>
                                    <div class="bkg-timeline-item">
                                        <span class="bkg-timeline-circle">3</span>
                                        <div>
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
                                        <th style="width:64px; text-align:center;">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pesananAktif->details && $pesananAktif->details->isNotEmpty())
                                        @foreach ($pesananAktif->details as $idx => $detailItem)
                                            @php
                                                $produkDetailRef = $detailItem->produk;
                                                $ketDetail = $produkDetailRef
                                                    ? ($produkDetailRef->deskripsi ?: ($produkDetailRef->kategori ?: 'Suku Cadang Resmi'))
                                                    : $detailDeskripsi;
                                            @endphp
                                            <tr>
                                                <td>{{ $idx + 1 }}.</td>
                                                <td>{{ $detailItem->nama_item }}</td>
                                                <td>{{ $ketDetail }}</td>
                                                <td>Rp {{ number_format($detailItem->harga, 0, ',', '.') }}</td>
                                                <td style="text-align:center;">{{ $detailItem->qty }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>1.</td>
                                            <td>{{ $pesananAktif->nama_layanan ?? '-' }}</td>
                                            <td>{{ $detailDeskripsi }}</td>
                                            <td>Rp {{ number_format($pesananAktif->total_harga, 0, ',', '.') }}</td>
                                            <td style="text-align:center;">1</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <div class="detail-info-list">
                                <div class="detail-info-row"><span class="detail-info-key">Nama</span><strong class="detail-info-val">{{ $pesananAktif->nama_pelanggan ?: Auth::user()->name }}</strong></div>
                                <div class="detail-info-row"><span class="detail-info-key">Id Pesanan</span><strong class="detail-info-val">{{ $kodePesanan }}</strong></div>
                                <div class="detail-info-row"><span class="detail-info-key">Alamat</span><strong class="detail-info-val">Jl. Taruna Praja Banjarbaru</strong></div>
                                <div class="detail-info-row"><span class="detail-info-key">Tanggal, Waktu Transaksi</span><strong class="detail-info-val">{{ $tanggalWaktuTransaksi }}</strong></div>
                                <div class="detail-info-row"><span class="detail-info-key">Metode Pembayaran</span><strong class="detail-info-val">Qris / Tunai</strong></div>
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

                                <a href="{{ route('user.pesanan') }}" class="btn-lihat-pesanan">
                                    Lihat pesanan anda
                                </a>
                            </div>
                        </section>

                        <aside class="next-steps-box" aria-label="Langkah Selanjutnya">
                            <h3 class="next-steps-title">Langkah Selanjutnya</h3>
                            <p class="next-steps-sub">Ikuti Langkah Berikut Untuk pemesanan produk</p>

                            <div class="timeline-list">
                                <div class="timeline-item">
                                    <span class="timeline-circle">1</span>
                                    <div>
                                        <strong class="timeline-step-title">Pesanan Dikonfirmasi</strong>
                                        <span class="timeline-step-desc">Admin mengkonfirmasi pesanan anda dan mengecek produk</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-circle">2</span>
                                    <div>
                                        <strong class="timeline-step-title">Produk di pesan dan disiapkan</strong>
                                        <span class="timeline-step-desc">Produk disiapkan oleh tim bengkel sesuai jadwal pengambilan anda</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-circle">3</span>
                                    <div>
                                        <strong class="timeline-step-title">Terima dan periksa pesanan</strong>
                                        <span class="timeline-step-desc">Terima produk dan mengkonfirmasi pesanan anda</span>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                @endif
            </main>
        </div>
    @else
        {{-- ================= TAMPILAN SIDEBAR PESANAN SAYA / BOOKING SERVIS ================= --}}
        <div class="user-panel-layout">
            <!-- Sidebar Kiri -->
            <aside class="user-sidebar" aria-label="Menu Akun Pelanggan">
                <div class="user-sidebar-profile">
                    <span class="user-sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    <span class="user-sidebar-name">{{ explode(' ', trim(Auth::user()->name))[0] }}</span>
                </div>

                <nav class="user-sidebar-nav">
                    <button
                        type="button"
                        class="user-sidebar-link {{ $activeSidebarTab === 'pesanan' ? 'active' : '' }}"
                        data-sidebar-menu="pesanan"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            <line x1="9" y1="12" x2="15" y2="12"></line>
                            <line x1="9" y1="16" x2="13" y2="16"></line>
                        </svg>
                        <span>Pesanan Saya</span>
                    </button>

                    <button
                        type="button"
                        class="user-sidebar-link {{ $activeSidebarTab === 'jadwal' ? 'active' : '' }}"
                        data-sidebar-menu="jadwal"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                        </svg>
                        <span>Booking Servis</span>
                    </button>
                </nav>
            </aside>

            <!-- Konten Kanan -->
            <main class="user-panel-content">
                <div class="user-panel-header">
                    <h1 class="user-panel-title" id="panelMainTitle">
                        {{ $activeSidebarTab === 'jadwal' ? 'Booking Servis' : 'Pesanan Saya' }}
                    </h1>
                    <p class="user-panel-subtitle" id="panelMainSubtitle">
                        {{ $activeSidebarTab === 'jadwal' ? 'Lihat jadwal dan status booking servis kendaraan mu' : 'Lihat Status pesanan dan pembelian mu' }}
                    </p>
                </div>

                <!-- Bar Tab Filter Status -->
                <div class="status-tabs-bar" role="tablist" aria-label="Filter status pesanan">
                    <button type="button" class="status-tab-btn active" data-status-filter="konfirmasi">Konfirmasi</button>
                    <button type="button" class="status-tab-btn" data-status-filter="selesai">Selesai</button>
                    <button type="button" class="status-tab-btn" data-status-filter="ditolak">Ditolak</button>
                </div>

                <div class="user-panel-body">
                    <div class="user-orders-list" id="userOrdersList">
                        @foreach ($daftarPesananUser as $item)
                            @php
                                $katItem = $item->kategori ?? 'layanan';
                                $prefixItem = $katItem === 'layanan' ? 'BKG-' : 'PSN-';
                                $kodeItem = $prefixItem . str_pad((string) $item->id, 4, '0', STR_PAD_LEFT);
                                $waktuItem = $item->jadwal_service ?? $item->created_at;
                                $tglFormat = $waktuItem ? \Carbon\Carbon::parse($waktuItem)->locale('id')->translatedFormat('d F Y, H:i') . ' WITA' : '-';

                                $st = $item->status ?? 'baru';
                                if ($st === 'selesai') {
                                    $filterGroup = 'selesai';
                                    $pillCls = 'done';
                                    $pillLbl = $katItem === 'produk' ? 'Sudah Diambil' : 'Sudah Selesai';
                                } elseif ($st === 'dibatalkan') {
                                    $filterGroup = 'ditolak';
                                    $pillCls = 'rejected';
                                    $pillLbl = 'Ditolak';
                                } elseif ($st === 'proses') {
                                    $filterGroup = 'konfirmasi';
                                    $pillCls = 'waiting';
                                    $pillLbl = 'Proses';
                                } else {
                                    $filterGroup = 'konfirmasi';
                                    $pillCls = 'waiting';
                                    $pillLbl = 'Menunggu Konfirmasi';
                                }
                            @endphp
                            <article
                                class="user-order-item-card"
                                data-item-kategori="{{ $katItem === 'layanan' ? 'jadwal' : 'pesanan' }}"
                                data-item-status="{{ $filterGroup }}"
                            >
                                <div class="user-order-item-left">
                                    <div class="user-order-item-top">
                                        <span class="user-order-code">{{ $kodeItem }}</span>
                                        <span class="user-order-status-pill {{ $pillCls }}">{{ $pillLbl }}</span>
                                    </div>
                                    <h3 class="user-order-item-title">{{ $item->nama_layanan }}</h3>
                                    <span class="user-order-item-meta">Jadwal: {{ $tglFormat }}</span>
                                </div>

                                <div class="user-order-item-right">
                                    <strong class="user-order-item-price">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong>
                                    <div class="user-order-item-actions">
                                        @if ($katItem === 'layanan')
                                            <a href="{{ route('user.pesanan.pdf', $item->id) }}" class="btn-order-pdf">Unduh Bukti PDF</a>
                                        @endif
                                        <a href="{{ route('user.pesanan', ['detail' => $item->id]) }}" class="btn-order-detail">Lihat Detail</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Empty State Sesuai Desain Figma -->
                    <div class="orders-empty-state" id="ordersEmptyState" style="display:none;">
                        <svg width="160" height="160" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <!-- Lingkaran Latar Abu Muda -->
                            <circle cx="95" cy="95" r="52" fill="#E5E7EB"/>
                            <!-- Titik Dekorasi -->
                            <circle cx="48" cy="48" r="7" fill="#F97316"/>
                            <circle cx="62" cy="34" r="9" fill="#BAE6FD"/>
                            <circle cx="52" cy="64" r="4" fill="#CBD5E1"/>
                            <circle cx="136" cy="58" r="4.5" fill="#FDBA74"/>
                            <!-- Papan Clipboard Coklat/Oranye -->
                            <rect x="65" y="42" width="60" height="82" rx="5" fill="#C26D2D" stroke="#9A521E" stroke-width="2"/>
                            <!-- Kertas Putih -->
                            <rect x="71" y="50" width="48" height="68" rx="2" fill="#FFFFFF"/>
                            <!-- Penjepit Clipboard Atas -->
                            <path d="M85 42V38C85 34.6863 87.6863 32 91 32H99C102.314 32 105 34.6863 105 38V42" fill="#6B7280"/>
                            <rect x="81" y="40" width="28" height="8" rx="3" fill="#6B7280"/>
                            <circle cx="95" cy="37" r="3" fill="#E5E7EB"/>
                            <!-- Baris Checklist di Kertas -->
                            <rect x="76" y="60" width="9" height="9" rx="1.5" fill="#D1D5DB"/>
                            <rect x="90" y="61" width="22" height="3" rx="1.5" fill="#E5E7EB"/>
                            <rect x="90" y="66" width="16" height="3" rx="1.5" fill="#E5E7EB"/>

                            <rect x="76" y="76" width="9" height="9" rx="1.5" fill="#D1D5DB"/>
                            <rect x="90" y="77" width="22" height="3" rx="1.5" fill="#E5E7EB"/>
                            <rect x="90" y="82" width="16" height="3" rx="1.5" fill="#E5E7EB"/>

                            <rect x="76" y="92" width="9" height="9" rx="1.5" fill="#D1D5DB"/>
                            <rect x="90" y="93" width="22" height="3" rx="1.5" fill="#E5E7EB"/>
                            <rect x="90" y="98" width="16" height="3" rx="1.5" fill="#E5E7EB"/>

                            <!-- Pensil Menyilang -->
                            <g transform="rotate(-38 118 112)">
                                <rect x="112" y="86" width="10" height="44" rx="1" fill="#D97706"/>
                                <polygon points="112,86 122,86 117,76" fill="#FDE68A"/>
                                <polygon points="115,80 119,80 117,76" fill="#374151"/>
                                <rect x="112" y="126" width="10" height="6" rx="1" fill="#F3F4F6"/>
                            </g>
                        </svg>
                        <h2 class="orders-empty-title" id="ordersEmptyTitle">
                            {{ $activeSidebarTab === 'jadwal' ? 'Belum ada Booking Servis yang menunggu konfirmasi' : 'Belum ada Pesanan yang menunggu konfirmasi' }}
                        </h2>
                    </div>
                </div>
            </main>
        </div>
    @endif

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

            // Sidebar & Status Tabs Filtering
            const sidebarButtons = document.querySelectorAll('[data-sidebar-menu]');
            const statusTabButtons = document.querySelectorAll('[data-status-filter]');
            const orderCards = Array.from(document.querySelectorAll('.user-order-item-card'));
            const emptyState = document.getElementById('ordersEmptyState');
            const emptyTitle = document.getElementById('ordersEmptyTitle');
            const panelTitle = document.getElementById('panelMainTitle');
            const panelSubtitle = document.getElementById('panelMainSubtitle');

            let currentMenu = @js($activeSidebarTab);
            let currentStatus = 'konfirmasi';

            function getActiveStatus() {
                const activeBtn = document.querySelector('.status-tab-btn.active');
                return activeBtn && activeBtn.dataset.statusFilter
                    ? activeBtn.dataset.statusFilter
                    : currentStatus;
            }

            function getActiveMenu() {
                const activeBtn = document.querySelector('.user-sidebar-link.active');
                return activeBtn && activeBtn.dataset.sidebarMenu
                    ? activeBtn.dataset.sidebarMenu
                    : currentMenu;
            }

            function renderFilteredOrders() {
                if (!emptyState) return;
                currentMenu = getActiveMenu();
                currentStatus = getActiveStatus();
                let visibleCount = 0;

                orderCards.forEach(function (card) {
                    const matchMenu = card.dataset.itemKategori === currentMenu;
                    const matchStatus = currentStatus === 'semua' || card.dataset.itemStatus === currentStatus;
                    const show = matchMenu && matchStatus;
                    card.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                });

                emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
                if (emptyTitle) {
                    const labelJenis = currentMenu === 'jadwal' ? 'Booking Servis' : 'Pesanan';
                    if (currentStatus === 'ditolak') {
                        emptyTitle.textContent = 'Belum ada ' + labelJenis + ' yang ditolak';
                    } else if (currentStatus === 'selesai') {
                        emptyTitle.textContent = 'Belum ada ' + labelJenis + ' yang sudah selesai';
                    } else {
                        emptyTitle.textContent = 'Belum ada ' + labelJenis + ' yang menunggu konfirmasi';
                    }
                }
            }

            sidebarButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    currentMenu = this.dataset.sidebarMenu;
                    sidebarButtons.forEach((b) => b.classList.toggle('active', b === this));
                    if (panelTitle && panelSubtitle) {
                        if (currentMenu === 'jadwal') {
                            panelTitle.textContent = 'Booking Servis';
                            panelSubtitle.textContent = 'Lihat jadwal dan status booking servis kendaraan mu';
                        } else {
                            panelTitle.textContent = 'Pesanan Saya';
                            panelSubtitle.textContent = 'Lihat Status pesanan dan pembelian mu';
                        }
                    }
                    renderFilteredOrders();
                });
            });

            statusTabButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    currentStatus = this.dataset.statusFilter;
                    statusTabButtons.forEach((b) => b.classList.toggle('active', b === this));
                    renderFilteredOrders();
                });
            });

            renderFilteredOrders();
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>
