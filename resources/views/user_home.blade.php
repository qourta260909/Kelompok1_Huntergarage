<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @switch($activePage ?? 'beranda')
            @case('layanan') Layanan Servis — Hunter Garage @break
            @case('produk') Produk & Sparepart — Hunter Garage @break
            @case('pesanan') Pesanan Saya — Hunter Garage @break
            @default Hunter Garage — Servis & Sparepart Kendaraan
        @endswitch
    </title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            color-scheme: light;
            --bg-page: #f4f4f5;
            --bg-surface: #ffffff;
            --bg-subtle: #fafafa;
            --bg-dark: #09090b;
            --bg-dark-elevated: #18181b;
            --text-primary: #09090b;
            --text-secondary: #27272a;
            --text-muted: #71717a;
            --border-base: #e4e4e7;
            --border-strong: #d4d4d8;
            --accent: #f6a31d;
            --accent-hover: #e59412;
            --accent-soft: #fff8eb;
            --danger: #dc2626;
            --success: #15803d;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background-color: var(--bg-page);
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-variant-numeric: tabular-nums;
            overflow-x: hidden;
            padding-bottom: {{ auth()->check() ? '96px' : '0px' }};
        }

        /* ================= CAHAYA BULAT KURSOR (CURSOR GLOW) ================= */
        .cursor-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            background: radial-gradient(
                circle,
                rgba(246, 163, 29, 0.22) 0%,
                rgba(246, 163, 29, 0.10) 32%,
                rgba(246, 163, 29, 0.03) 58%,
                rgba(246, 163, 29, 0) 75%
            );
            transform: translate3d(-50%, -50%, 0);
            transition: width 0.28s ease, height 0.28s ease, opacity 0.28s ease;
            opacity: 0;
            will-change: transform;
        }

        .cursor-glow.active {
            opacity: 1;
        }

        .cursor-glow.hovering {
            width: 420px;
            height: 420px;
            background: radial-gradient(
                circle,
                rgba(246, 163, 29, 0.30) 0%,
                rgba(246, 163, 29, 0.14) 35%,
                rgba(246, 163, 29, 0.04) 60%,
                rgba(246, 163, 29, 0) 78%
            );
        }

        @media (hover: none), (pointer: coarse) {
            .cursor-glow {
                display: none;
            }
        }

        /* ================= ANIMASI SCROLL REVEAL HALUS ================= */
        .reveal {
            opacity: 0;
            transform: translateY(34px) scale(0.985);
            transition: opacity 0.72s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.72s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal.in-view {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .delay-1 { transition-delay: 0.08s; }
        .delay-2 { transition-delay: 0.16s; }
        .delay-3 { transition-delay: 0.24s; }
        .delay-4 { transition-delay: 0.32s; }

        /* ================= CONTAINER LEGA & PROPORSIONAL (1260px) ================= */
        .container {
            width: min(1260px, calc(100% - 48px));
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .container {
                width: calc(100% - 32px);
            }
        }

        /* ================= NAVBAR TRANSPARAN DI ATAS & HILANG SAAT SCROLL ================= */
        .navbar-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 200;
            background-color: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.32);
            transition: transform 0.38s cubic-bezier(0.16, 1, 0.3, 1),
                        opacity 0.32s ease,
                        background-color 0.28s ease,
                        border-color 0.28s ease;
        }

        .navbar-header.nav-hidden {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        .navbar-header.navbar-on-dark {
            background-color: rgba(9, 9, 11, 0.24);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .navbar-header.navbar-on-dark .brand-name {
            color: #ffffff;
        }

        .navbar-header.navbar-on-dark .brand-sub {
            color: #d4d4d8;
        }

        .navbar-header.navbar-on-dark .nav-link {
            color: #e4e4e7;
        }

        .navbar-header.navbar-on-dark .nav-link:hover,
        .navbar-header.navbar-on-dark .nav-link.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.12);
        }

        .navbar-header.navbar-on-dark .user-dropdown-trigger {
            background-color: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.22);
            color: #ffffff;
        }

        .navbar-header.navbar-on-dark .user-dropdown-trigger:hover,
        .navbar-header.navbar-on-dark .user-dropdown.open .user-dropdown-trigger {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.36);
        }

        .navbar-header.navbar-on-dark .user-dropdown-trigger .user-badge-icon {
            color: var(--accent);
        }

        .navbar-header.navbar-on-dark .user-dropdown-chevron {
            color: #d4d4d8;
        }

        .navbar-inner {
            width: min(1260px, calc(100% - 48px));
            margin: 0 auto;
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 13px;
            text-decoration: none;
            color: var(--text-primary);
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .brand-link:hover {
            transform: translateY(-1px);
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
            display: block;
        }

        .brand-meta {
            display: flex;
            flex-direction: column;
        }

        .brand-name {
            font-size: 16.5px;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: var(--text-primary);
            line-height: 1.15;
        }

        .brand-sub {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .nav-center {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            position: relative;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            padding: 9px 18px;
            border-radius: 9px;
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--text-primary);
            background-color: rgba(255, 255, 255, 0.65);
        }

        .nav-link.active {
            color: var(--text-primary);
            font-weight: 700;
            background-color: rgba(255, 255, 255, 0.78);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 18px;
            right: 18px;
            height: 2.5px;
            border-radius: 999px;
            background-color: var(--accent);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-dropdown-trigger {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            height: 40px;
            padding: 0 13px 0 11px;
            border-radius: 11px;
            background-color: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(9, 9, 11, 0.14);
            color: var(--text-primary);
            font-size: 13px;
            font-weight: 700;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .user-dropdown-trigger:hover,
        .user-dropdown.open .user-dropdown-trigger {
            background-color: #ffffff;
            border-color: rgba(9, 9, 11, 0.28);
            box-shadow: 0 6px 18px rgba(9, 9, 11, 0.08);
        }

        .user-badge-avatar {
            width: 26px;
            height: 26px;
            border-radius: 7px;
            background-color: var(--bg-dark);
            color: var(--accent);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-badge-avatar svg {
            width: 14px;
            height: 14px;
        }

        .user-trigger-label {
            max-width: 130px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-dropdown-chevron {
            width: 15px;
            height: 15px;
            color: var(--text-muted);
            transition: transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), color 0.2s ease;
            flex-shrink: 0;
        }

        .user-dropdown.open .user-dropdown-chevron {
            transform: rotate(180deg);
            color: var(--text-primary);
        }

        .user-dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 245px;
            background-color: #ffffff;
            border: 1px solid var(--border-base);
            border-radius: 15px;
            box-shadow: 0 18px 42px -8px rgba(9, 9, 11, 0.18), 0 4px 12px -2px rgba(9, 9, 11, 0.06);
            padding: 7px;
            z-index: 350;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(-8px) scale(0.97);
            transform-origin: top right;
            transition: opacity 0.2s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.2s cubic-bezier(0.16, 1, 0.3, 1),
                        visibility 0.2s ease;
        }

        .user-dropdown.open .user-dropdown-menu {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0) scale(1);
        }

        .user-dropdown-header {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 11px 9px;
        }

        .user-dropdown-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #09090b 0%, #27272a 100%);
            color: var(--accent);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13.5px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .user-dropdown-meta {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .user-dropdown-name {
            font-size: 13.5px;
            font-weight: 800;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-dropdown-email {
            font-size: 11.5px;
            font-weight: 500;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 1px;
        }

        .user-dropdown-divider {
            height: 1px;
            background-color: var(--border-base);
            margin: 5px 6px;
        }

        .user-dropdown-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 11px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-secondary);
            background: transparent;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.16s ease, color 0.16s ease;
            text-align: left;
        }

        .user-dropdown-item svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: var(--text-muted);
            transition: color 0.16s ease, transform 0.16s ease;
        }

        .user-dropdown-item:hover {
            background-color: #f4f4f5;
            color: var(--text-primary);
        }

        .user-dropdown-item:hover svg {
            color: var(--text-primary);
        }

        .user-dropdown-item.item-logout {
            color: var(--danger);
        }

        .user-dropdown-item.item-logout svg {
            color: var(--danger);
        }

        .user-dropdown-item.item-logout:hover {
            background-color: #fef2f2;
            color: #b91c1c;
        }

        .user-dropdown-item.item-logout:hover svg {
            color: #b91c1c;
            transform: translateX(2px);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 40px;
            padding: 0 20px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
            white-space: nowrap;
        }

        .btn-dark {
            background-color: var(--bg-dark);
            color: #ffffff;
            border-color: var(--bg-dark);
        }

        .btn-dark:hover {
            background-color: #27272a;
            border-color: #27272a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(9, 9, 11, 0.18);
        }

        .btn-gold {
            background-color: var(--accent);
            color: var(--bg-dark);
            border-color: var(--accent);
        }

        .btn-gold:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(246, 163, 29, 0.28);
        }

        .btn-outline {
            background-color: #ffffff;
            color: var(--text-primary);
            border-color: var(--border-strong);
        }

        .btn-outline:hover {
            background-color: #f4f4f5;
            border-color: var(--bg-dark);
            transform: translateY(-1px);
        }

        .btn-logout {
            height: 38px;
            padding: 0 15px;
            border-radius: 9px;
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--danger);
            border: 1px solid #fecaca;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: var(--danger);
            color: #ffffff;
            border-color: var(--danger);
            transform: translateY(-1px);
        }

        @media (max-width: 780px) {
            .nav-center {
                display: none;
            }
        }

        /* ================= NOTIFIKASI ================= */
        .notice-wrap {
            position: fixed;
            top: 86px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 250;
            pointer-events: auto;
        }

        .notice-box {
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            box-shadow: 0 12px 28px rgba(9, 9, 11, 0.12);
        }

        .notice-success {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .notice-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        /* ================= BERANDA: HERO FULL GAMBAR BENGKEL (SESUAI GAMBAR ATAS) ================= */
        .hero-section {
            position: relative;
            width: 100%;
            min-height: 720px;
            display: flex;
            align-items: center;
            padding: 128px 0 82px;
            background:
                linear-gradient(92deg, rgba(255, 255, 255, 0.96) 0%, rgba(250, 250, 250, 0.90) 44%, rgba(18, 18, 21, 0.55) 100%),
                url('https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=1920&q=85') center/cover no-repeat;
            border-bottom: 1px solid var(--border-base);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 0.95fr 1.15fr;
            gap: 52px;
            align-items: center;
        }

        .eyebrow-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 14px;
            border-radius: 999px;
            background-color: var(--bg-dark);
            color: #ffffff;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.04em;
            margin-bottom: 20px;
        }

        .eyebrow-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: var(--accent);
        }

        .hero-title {
            font-size: clamp(34px, 4vw, 52px);
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.12;
            letter-spacing: -0.03em;
        }

        .hero-desc {
            margin-top: 18px;
            margin-bottom: 32px;
            font-size: 16px;
            line-height: 1.68;
            color: #3f3f46;
            max-width: 500px;
            font-weight: 500;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            min-width: 200px;
            height: 50px;
            padding: 0 30px;
            border-radius: 12px;
            background-color: var(--bg-dark);
            color: #ffffff;
            font-size: 14.5px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 10px 26px rgba(9, 9, 11, 0.18);
            transition: all 0.24s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-hero-primary:hover {
            background-color: #27272a;
            transform: translateY(-3px);
            box-shadow: 0 16px 34px rgba(9, 9, 11, 0.26);
        }

        .btn-hero-secondary {
            height: 50px;
            padding: 0 24px;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.92);
            color: var(--text-primary);
            border: 1px solid var(--border-strong);
            font-size: 14.5px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.22s ease;
        }

        .btn-hero-secondary:hover {
            background-color: #ffffff;
            border-color: var(--bg-dark);
            transform: translateY(-2px);
        }

        /* Panel Proses Servis Terstruktur */
        .process-panel {
            background-color: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(228, 228, 231, 0.95);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 24px 56px -12px rgba(9, 9, 11, 0.22);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
        }

        .process-panel:hover {
            transform: translateY(-4px);
            box-shadow: 0 30px 64px -12px rgba(9, 9, 11, 0.28);
        }

        .process-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border-base);
            margin-bottom: 20px;
        }

        .process-title {
            font-size: 17.5px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.015em;
        }

        .process-sub {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .process-badge {
            padding: 6px 12px;
            border-radius: 999px;
            background-color: var(--accent-soft);
            border: 1px solid #fde68a;
            color: #b45309;
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 0.03em;
            white-space: nowrap;
        }

        .process-content {
            display: grid;
            grid-template-columns: 0.86fr 1.14fr;
            gap: 18px;
        }

        .process-image {
            border-radius: 14px;
            overflow: hidden;
            background-color: #18181b;
            min-height: 340px;
        }

        .process-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .process-panel:hover .process-image img {
            transform: scale(1.04);
        }

        .process-steps {
            display: flex;
            flex-direction: column;
            gap: 11px;
            justify-content: space-between;
        }

        .process-step-card {
            padding: 12px 15px;
            border-radius: 12px;
            border: 1px solid var(--border-base);
            background-color: #fafafa;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .process-step-card:hover {
            background-color: #ffffff;
            border-color: var(--accent);
            transform: translateX(4px);
            box-shadow: 0 6px 18px rgba(9, 9, 11, 0.06);
        }

        .step-index {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #ffffff;
            border: 1.5px solid var(--border-strong);
            color: var(--text-primary);
            font-size: 11.5px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
            transition: all 0.22s ease;
        }

        .process-step-card:hover .step-index {
            background-color: var(--bg-dark);
            border-color: var(--bg-dark);
            color: var(--accent);
        }

        .step-heading {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .step-text {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.48;
            margin-top: 2px;
        }

        @media (max-width: 1020px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .process-content {
                grid-template-columns: 1fr;
            }
            .process-image {
                min-height: 220px;
            }
        }

        /* ================= STATS BAR DISIPLIN 4 KOLOM ================= */
        .stats-bar {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-base);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .stat-item {
            padding: 34px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            border-right: 1px solid var(--border-base);
            transition: background-color 0.22s ease;
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-item:hover {
            background-color: #fafafa;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background-color: var(--accent-soft);
            border: 1px solid #fde68a;
            color: #b45309;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.24s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.24s ease;
        }

        .stat-item:hover .stat-icon {
            transform: scale(1.1);
            background-color: var(--accent);
            color: var(--bg-dark);
        }

        .stat-icon svg {
            width: 20px;
            height: 20px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .stat-label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-muted);
            margin-top: 3px;
        }

        @media (max-width: 820px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .stat-item:nth-child(2) {
                border-right: none;
            }
            .stat-item:nth-child(1),
            .stat-item:nth-child(2) {
                border-bottom: 1px solid var(--border-base);
            }
        }

        /* ================= SECTION LAYANAN UTAMA (BACKGROUND FULL GAMBAR BENGKEL) ================= */
        .services-section {
            position: relative;
            padding: 88px 0 96px;
            background:
                linear-gradient(180deg, rgba(9, 9, 11, 0.78) 0%, rgba(9, 9, 11, 0.72) 50%, rgba(18, 18, 21, 0.86) 100%),
                url('{{ asset('build/assets/login-hero-Bvts2ul7.png') }}') center/cover no-repeat fixed;
            color: #ffffff;
        }

        .section-tag-gold {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            background-color: #ffffff;
            color: #b45309;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .section-heading-light {
            font-size: clamp(28px, 3.4vw, 42px);
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.16;
            max-width: 580px;
        }

        .section-desc-light {
            margin-top: 14px;
            font-size: 15px;
            line-height: 1.65;
            color: #d4d4d8;
            max-width: 580px;
            margin-bottom: 48px;
        }

        .feature-grid-top {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 24px;
        }

        .feature-grid-bottom {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            max-width: 830px;
            margin: 0 auto;
        }

        .feature-card {
            background-color: #ffffff;
            color: var(--text-primary);
            border-radius: 16px;
            padding: 30px;
            border: 1.5px solid rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            gap: 13px;
            min-height: 205px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.24);
            transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1),
                        box-shadow 0.28s ease,
                        border-color 0.28s ease;
        }

        .feature-card:hover {
            transform: translateY(-7px);
            border-color: var(--accent);
            box-shadow: 0 26px 52px rgba(0, 0, 0, 0.34);
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            background-color: var(--accent-soft);
            border: 1px solid #fde68a;
            color: #b45309;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s ease;
        }

        .feature-card:hover .feature-icon {
            background-color: var(--bg-dark);
            border-color: var(--bg-dark);
            color: var(--accent);
            transform: scale(1.08);
        }

        .feature-icon svg {
            width: 20px;
            height: 20px;
        }

        .feature-name {
            font-size: 18.5px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.015em;
            margin-top: 2px;
        }

        .feature-text {
            font-size: 13.5px;
            line-height: 1.6;
            color: var(--text-muted);
        }

        @media (max-width: 920px) {
            .feature-grid-top,
            .feature-grid-bottom {
                grid-template-columns: 1fr;
                max-width: 100%;
            }
        }

        /* ================= SUBPAGE: BACKGROUND FULL GAMBAR + LIST 5 KOTAK PER HALAMAN ================= */
        .subpage-banner-bg {
            position: relative;
            padding: 124px 0 92px;
            background:
                linear-gradient(115deg, rgba(9, 9, 11, 0.90) 0%, rgba(24, 24, 27, 0.78) 100%),
                url('{{ asset('build/assets/login-hero-Bvts2ul7.png') }}') center/cover no-repeat;
            color: #ffffff;
        }

        .subpage-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }

        .subpage-title {
            font-size: clamp(26px, 3vw, 36px);
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.025em;
            margin-top: 8px;
        }

        .subpage-subtitle {
            font-size: 14.5px;
            color: #d4d4d8;
            margin-top: 6px;
            max-width: 520px;
            line-height: 1.55;
        }

        .subpage-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-field {
            position: relative;
            width: 280px;
        }

        .search-field svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: var(--text-muted);
            pointer-events: none;
        }

        .search-field input {
            width: 100%;
            height: 42px;
            padding: 0 14px 0 40px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background-color: #ffffff;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--text-primary);
            outline: none;
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .search-field input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(246, 163, 29, 0.25);
        }

        .subpage-body-section {
            margin-top: -48px;
            padding-bottom: 76px;
            position: relative;
            z-index: 10;
        }

        /* Kotak Container List yang Muat 5 Baris/Kotak Tetap */
        .list-card-container {
            background-color: #ffffff;
            border: 1px solid var(--border-base);
            border-radius: 18px;
            box-shadow: 0 18px 42px -10px rgba(9, 9, 11, 0.10);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 516px;
        }

        .list-rows-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .list-row-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 20px 30px;
            min-height: 90px;
            border-bottom: 1px solid #f1f5f9;
            background-color: #ffffff;
            transition: background-color 0.18s ease, padding-left 0.22s ease;
        }

        .list-row-box:hover {
            background-color: #fafafa;
            padding-left: 34px;
        }

        .list-row-left {
            display: flex;
            align-items: center;
            gap: 18px;
            min-width: 0;
        }

        .list-code-box {
            width: 60px;
            height: 44px;
            border-radius: 9px;
            background-color: #f4f4f5;
            border: 1px solid var(--border-base);
            color: var(--text-primary);
            font-size: 12px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .list-row-box:hover .list-code-box {
            background-color: var(--bg-dark);
            border-color: var(--bg-dark);
            color: var(--accent);
        }

        .list-info-main {
            min-width: 0;
        }

        .list-item-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.01em;
        }

        .list-item-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
            font-size: 13px;
            color: var(--text-muted);
            flex-wrap: wrap;
        }

        .meta-pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            background-color: #f4f4f5;
            color: var(--text-secondary);
        }

        .meta-pill.gold {
            background-color: var(--accent-soft);
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .meta-pill.danger {
            background-color: #fef2f2;
            color: var(--danger);
            border: 1px solid #fecaca;
        }

        .meta-pill.success {
            background-color: #dcfce7;
            color: var(--success);
            border: 1px solid #bbf7d0;
        }

        .list-row-right {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-shrink: 0;
        }

        .list-price-col {
            text-align: right;
        }

        .list-price-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .list-price-val {
            font-size: 16.5px;
            font-weight: 800;
            color: var(--text-primary);
        }

        /* Slot Baris Kosong (Agar Kotak Tetap 5 Slot & Tidak Mengecil) */
        .list-filler-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 30px;
            min-height: 90px;
            border-bottom: 1px solid #f1f5f9;
            background-color: #ffffff;
            pointer-events: none;
        }

        .filler-line {
            width: 44px;
            height: 4px;
            border-radius: 999px;
            background-color: #f1f5f9;
        }

        .list-empty-state {
            flex: 1;
            min-height: 450px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            text-align: center;
            gap: 10px;
        }

        .list-empty-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background-color: #f4f4f5;
            border: 1px solid var(--border-base);
            color: var(--text-secondary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .list-empty-title {
            font-size: 15.5px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .list-empty-sub {
            font-size: 13.5px;
            color: var(--text-muted);
            max-width: 360px;
            line-height: 1.5;
        }

        /* Footer Pagination (Persis Gaya Dashboard) */
        .list-pagination-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 15px 30px;
            border-top: 1px solid var(--border-base);
            background-color: #ffffff;
            flex-wrap: wrap;
        }

        .page-info-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .page-info-text strong {
            color: var(--text-primary);
            font-weight: 800;
        }

        .page-btn-group {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .pg-btn {
            min-width: 34px;
            height: 34px;
            padding: 0 11px;
            border-radius: 8px;
            border: 1px solid var(--border-base);
            background-color: #ffffff;
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.18s ease;
        }

        .pg-btn:hover:not(:disabled):not(.active) {
            background-color: #f4f4f5;
            color: var(--text-primary);
        }

        .pg-btn.active {
            background-color: var(--bg-dark);
            border-color: var(--bg-dark);
            color: var(--accent);
        }

        .pg-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        @media (max-width: 680px) {
            .list-row-box {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }
            .list-row-right {
                width: 100%;
                justify-content: space-between;
            }
            .list-price-col {
                text-align: left;
            }
        }

        /* ================= FOOTER MINIMALIS & DISIPLIN ================= */
        .footer {
            background-color: #ffffff;
            border-top: 1px solid var(--border-base);
            padding: 60px 0 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr 0.8fr 0.8fr 1.1fr;
            gap: 44px;
            padding-bottom: 48px;
        }

        .footer-desc {
            margin-top: 16px;
            font-size: 13.5px;
            line-height: 1.65;
            color: var(--text-muted);
            max-width: 340px;
        }

        .footer-socials {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .social-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--bg-dark);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.22s ease;
        }

        .social-btn:hover {
            background-color: var(--accent);
            color: var(--bg-dark);
            transform: translateY(-2px);
        }

        .footer-heading {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--text-primary);
            margin-bottom: 18px;
        }

        .footer-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .footer-list a,
        .footer-list li {
            text-decoration: none;
            font-size: 13.5px;
            color: var(--text-muted);
            line-height: 1.55;
            transition: color 0.18s ease;
        }

        .footer-list a:hover {
            color: var(--text-primary);
        }

        .footer-copy {
            border-top: 1px solid #f1f5f9;
            padding: 22px 0;
            text-align: center;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--text-secondary);
        }

        @media (max-width: 860px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 540px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ================= FLOATING BOTTOM DOCK & BOOKING SHEET ================= */
        .bottom-dock {
            position: fixed;
            bottom: 22px;
            left: 50%;
            transform: translate3d(-50%, 52px, 0) scale(0.95);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            z-index: 900;
            width: min(620px, calc(100% - 28px));
            background-color: rgba(9, 9, 11, 0.96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 16px;
            padding: 7px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            box-shadow: 0 20px 44px rgba(9, 9, 11, 0.38);
            transition: transform 0.42s cubic-bezier(0.16, 1, 0.3, 1),
                        opacity 0.32s ease,
                        visibility 0.32s ease;
        }

        .bottom-dock.visible {
            transform: translate3d(-50%, 0, 0) scale(1);
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .dock-nav {
            display: flex;
            align-items: center;
            gap: 4px;
            flex: 1;
        }

        .dock-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            height: 40px;
            padding: 0 15px;
            border-radius: 10px;
            color: #a1a1aa;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .dock-link svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .dock-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
        }

        .dock-link.active {
            background-color: #27272a;
            color: #ffffff;
            font-weight: 700;
        }

        .dock-cta-btn {
            height: 40px;
            padding: 0 18px;
            border-radius: 10px;
            border: none;
            background-color: var(--accent);
            color: var(--bg-dark);
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .dock-cta-btn:hover {
            background-color: var(--accent-hover);
            transform: translateY(-1px);
        }

        @media (max-width: 580px) {
            .dock-link span {
                display: none;
            }
            .dock-link.active span {
                display: inline;
            }
        }

        /* Slide-up Booking Sheet Minimalis & Tegas */
        .sheet-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1100;
            background-color: rgba(9, 9, 11, 0.62);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.24s ease, visibility 0.24s ease;
        }

        .sheet-backdrop.open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .sheet-panel {
            width: min(580px, 100%);
            max-height: 88vh;
            background-color: #ffffff;
            border-radius: 22px 22px 0 0;
            border: 1px solid var(--border-base);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transform: translateY(100%);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .sheet-backdrop.open .sheet-panel {
            transform: translateY(0);
        }

        .sheet-top {
            padding: 18px 26px;
            border-bottom: 1px solid var(--border-base);
        }

        .sheet-bar {
            width: 42px;
            height: 4px;
            border-radius: 999px;
            background-color: #d4d4d8;
            margin: 0 auto 14px;
        }

        .sheet-head-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .sheet-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.015em;
        }

        .sheet-close {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: 1px solid var(--border-base);
            background-color: #f4f4f5;
            color: var(--text-primary);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.18s ease;
        }

        .sheet-close:hover {
            background-color: #e4e4e7;
        }

        .sheet-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            background-color: #f4f4f5;
            padding: 4px;
            border-radius: 11px;
            margin-top: 14px;
        }

        .sheet-tab-btn {
            height: 38px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: all 0.18s ease;
        }

        .sheet-tab-btn svg {
            width: 15px;
            height: 15px;
        }

        .sheet-tab-btn.active {
            background-color: var(--bg-dark);
            color: #ffffff;
        }

        .sheet-body {
            padding: 22px 26px;
            overflow-y: auto;
            flex: 1;
            background-color: #fafafa;
        }

        .field-label {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .option-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 230px;
            overflow-y: auto;
            margin-bottom: 18px;
        }

        .option-item {
            background-color: #ffffff;
            border: 1.5px solid var(--border-base);
            border-radius: 11px;
            padding: 13px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            cursor: pointer;
            transition: all 0.18s ease;
        }

        .option-item:hover:not(.disabled) {
            border-color: #a1a1aa;
            transform: translateX(2px);
        }

        .option-item.selected {
            border-color: var(--bg-dark);
            background-color: #ffffff;
            box-shadow: 0 4px 14px rgba(9, 9, 11, 0.06);
        }

        .option-item.disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .option-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .option-radio {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #d4d4d8;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .option-item.selected .option-radio {
            border-color: var(--bg-dark);
            background-color: var(--bg-dark);
        }

        .option-item.selected .option-radio::after {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: var(--accent);
        }

        .option-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .option-sub {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .option-price {
            font-size: 14px;
            font-weight: 800;
            color: var(--text-primary);
            white-space: nowrap;
        }

        .schedule-input {
            width: 100%;
            height: 44px;
            padding: 0 14px;
            border-radius: 10px;
            border: 1.5px solid var(--border-base);
            background-color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            outline: none;
        }

        .schedule-input:focus {
            border-color: var(--bg-dark);
        }

        .sheet-footer {
            padding: 18px 26px 22px;
            background-color: #ffffff;
            border-top: 1px solid var(--border-base);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .total-label {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .total-amount {
            font-size: 21px;
            font-weight: 800;
            color: var(--text-primary);
            margin-top: 2px;
        }

        .btn-submit-sheet {
            height: 46px;
            padding: 0 26px;
            border-radius: 11px;
            border: none;
            background-color: var(--bg-dark);
            color: var(--accent);
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-submit-sheet:hover {
            background-color: #27272a;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- CAHAYA BULAT KURSOR -->
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    @php
        $currentPage = $activePage ?? 'beranda';
    @endphp

    <!-- ================= NAVBAR TRANSPARAN & HILANG SAAT SCROLL ================= -->
    <header class="navbar-header {{ $currentPage !== 'beranda' ? 'navbar-on-dark' : '' }}" id="mainNavbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('images/logo.png') }}" alt="Hunter Garage" class="brand-logo">
                <div class="brand-meta">
                    <span class="brand-name">Hunter Garage</span>
                    <span class="brand-sub">Service & Sparepart</span>
                </div>
            </a>

            <nav class="nav-center" aria-label="Navigasi Utama">
                <a href="{{ route('home') }}" class="nav-link {{ $currentPage === 'beranda' ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('user.layanan') }}" class="nav-link {{ $currentPage === 'layanan' ? 'active' : '' }}">Layanan</a>
                <a href="{{ route('user.produk') }}" class="nav-link {{ $currentPage === 'produk' ? 'active' : '' }}">Produk</a>
                @auth
                    <a href="{{ route('user.pesanan') }}" class="nav-link {{ $currentPage === 'pesanan' ? 'active' : '' }}">Pesanan Saya</a>
                @endauth
            </nav>

            <div class="nav-right">
                @auth
                    @php
                        $authUser = auth()->user();
                        $initials = collect(explode(' ', trim($authUser->name ?? 'P')))
                            ->filter()
                            ->take(2)
                            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                            ->implode('') ?: 'P';
                    @endphp
                    <div class="user-dropdown" id="userProfileDropdown">
                        <button
                            type="button"
                            class="user-dropdown-trigger"
                            id="userProfileTrigger"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleUserProfileDropdown(event)"
                        >
                            <span class="user-badge-avatar">
                                <svg class="user-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <span class="user-trigger-label">{{ $authUser->name ?: 'Pelanggan' }}</span>
                            <svg class="user-dropdown-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>

                        <div class="user-dropdown-menu" id="userProfileMenu" role="menu" aria-labelledby="userProfileTrigger">
                            <div class="user-dropdown-header">
                                <div class="user-dropdown-avatar">{{ $initials }}</div>
                                <div class="user-dropdown-meta">
                                    <span class="user-dropdown-name">{{ $authUser->name }}</span>
                                    <span class="user-dropdown-email">{{ $authUser->email }}</span>
                                </div>
                            </div>

                            <div class="user-dropdown-divider"></div>

                            @if ($authUser->role === 'admin')
                                <a href="{{ route('dashboard') }}" class="user-dropdown-item" role="menuitem">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                                    </svg>
                                    <span>Dashboard Admin</span>
                                </a>
                            @endif

                            <a href="{{ route('user.pesanan') }}" class="user-dropdown-item" role="menuitem">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="6" y="4" width="12" height="16" rx="2"/>
                                    <line x1="9" y1="9" x2="15" y2="9"/>
                                    <line x1="9" y1="13" x2="15" y2="13"/>
                                </svg>
                                <span>Pesanan Saya</span>
                            </a>

                            <div class="user-dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="user-dropdown-item item-logout" role="menuitem">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                        <polyline points="16 17 21 12 16 7"/>
                                        <line x1="21" y1="12" x2="9" y2="12"/>
                                    </svg>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-dark">Masuk</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- ================= NOTIFIKASI ================= -->
    @if (session('success') || $errors->any())
        <div class="container notice-wrap">
            @if (session('success'))
                <div class="notice-box notice-success">
                    <span>{{ session('success') }}</span>
                    @auth
                        @if ($currentPage !== 'pesanan')
                            <a href="{{ route('user.pesanan') }}" style="color:#065f46; text-decoration:underline; font-size:13px;">Lihat Pesanan</a>
                        @endif
                    @endauth
                </div>
            @endif

            @if ($errors->any())
                <div class="notice-box notice-error">{{ $errors->first() }}</div>
            @endif
        </div>
    @endif

    {{-- ============================================================================
         HALAMAN 1: BERANDA (BACKGROUND FULL GAMBAR BENGKEL SESUAI GAMBAR ATAS)
         ============================================================================ --}}
    @if ($currentPage === 'beranda')
        <section class="hero-section">
            <div class="container hero-grid">
                <div class="reveal">
                    <div class="eyebrow-tag">
                        <span class="eyebrow-dot"></span>
                        <span>Bengkel otomotif profesional</span>
                    </div>
                    <h1 class="hero-title">
                        Servis kendaraan cepat, akurat, dan transparan
                    </h1>
                    <p class="hero-desc">
                        Pilih layanan, tentukan jadwal, dan datang saat montir kami siap. Sparepart asli juga bisa dipesan langsung.
                    </p>
                    <div class="hero-actions">
                        @auth
                            <button type="button" class="btn-hero-primary" onclick="openBookingSheet('layanan')">
                                Booking Sekarang
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn-hero-primary">Masuk</a>
                        @endauth
                        <a href="{{ route('user.layanan') }}" class="btn-hero-secondary">Lihat Layanan</a>
                    </div>
                </div>

                <div class="process-panel reveal delay-1">
                    <div class="process-head">
                        <div>
                            <div class="process-title">Proses servis terstruktur</div>
                            <div class="process-sub">Mulai dari pemeriksaan awal hingga pengambilan kendaraan</div>
                        </div>
                        <span class="process-badge">4 Tahap</span>
                    </div>

                    <div class="process-content">
                        <div class="process-image">
                            <img src="https://images.unsplash.com/photo-1625047509248-ec889cbff17f?auto=format&fit=crop&w=900&q=80" alt="Teknisi Hunter Garage">
                        </div>

                        <div class="process-steps">
                            <div class="process-step-card">
                                <span class="step-index">1</span>
                                <div>
                                    <div class="step-heading">Pemeriksaan awal</div>
                                    <div class="step-text">Kami mengecek kondisi kendaraan, mencatat keluhan, dan menentukan prioritas pekerjaan.</div>
                                </div>
                            </div>

                            <div class="process-step-card">
                                <span class="step-index">2</span>
                                <div>
                                    <div class="step-heading">Rincian biaya</div>
                                    <div class="step-text">Pelanggan mendapat rincian pekerjaan, sparepart, dan total biaya sebelum pekerjaan dimulai.</div>
                                </div>
                            </div>

                            <div class="process-step-card">
                                <span class="step-index">3</span>
                                <div>
                                    <div class="step-heading">Servis & perbaikan</div>
                                    <div class="step-text">Tim teknisi bekerja sesuai SOP, menggunakan peralatan modern, dan sparepart yang sesuai.</div>
                                </div>
                            </div>

                            <div class="process-step-card">
                                <span class="step-index">4</span>
                                <div>
                                    <div class="step-heading">Tes jalan & serah terima</div>
                                    <div class="step-text">Kendaraan dites jalan, hasil servis diverifikasi, dan pelanggan mendapat laporan kerja lengkap.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BAR STATISTIK 4 KOLOM -->
        <section class="stats-bar">
            <div class="container stats-grid">
                <div class="stat-item reveal delay-1">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-value">4.9/5</div>
                        <div class="stat-label">Rating pelanggan</div>
                    </div>
                </div>

                <div class="stat-item reveal delay-2">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M5 20v-2a7 7 0 0 1 14 0v2"/>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-value">1.2k+</div>
                        <div class="stat-label">Kendaraan / bulan</div>
                    </div>
                </div>

                <div class="stat-item reveal delay-3">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-value">98%</div>
                        <div class="stat-label">Pelanggan puas</div>
                    </div>
                </div>

                <div class="stat-item reveal delay-4">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-value">24/7</div>
                        <div class="stat-label">Booking & konsultasi</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION LAYANAN UTAMA (BACKGROUND FULL GAMBAR WORKSHOP) -->
        <section class="services-section">
            <div class="container">
                <div class="reveal">
                    <div class="section-tag-gold">
                        <span class="eyebrow-dot"></span>
                        <span>Layanan Utama</span>
                    </div>
                    <h2 class="section-heading-light">
                        Satu bengkel untuk semua kebutuhan kendaraan.
                    </h2>
                    <p class="section-desc-light">
                        Dari perawatan rutin sampai diagnosis kompleks, setiap pekerjaan ditangani teknisi berpengalaman dengan prosedur yang jelas.
                    </p>
                </div>

                <div class="feature-grid-top">
                    <a href="{{ auth()->check() ? 'javascript:void(0)' : route('user.layanan') }}"
                       @auth onclick="openBookingSheet('layanan')" @endauth
                       class="feature-card reveal delay-1">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                            </svg>
                        </div>
                        <div class="feature-name">Servis berkala</div>
                        <p class="feature-text">
                            Ganti oli, filter, busi, cek semua cairan, plus pengecekan 30 titik penting sesuai kilometer motor.
                        </p>
                    </a>

                    <a href="{{ auth()->check() ? 'javascript:void(0)' : route('user.layanan') }}"
                       @auth onclick="openBookingSheet('layanan')" @endauth
                       class="feature-card reveal delay-2">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="12" r="9"/>
                                <circle cx="12" cy="12" r="3"/>
                                <line x1="12" y1="3" x2="12" y2="6"/>
                                <line x1="12" y1="18" x2="12" y2="21"/>
                            </svg>
                        </div>
                        <div class="feature-name">Rem & kaki-kaki</div>
                        <p class="feature-text">
                            Pemeriksaan kampas, cakram, shockbreaker, bushing, spooring, dan balancing.
                        </p>
                    </a>

                    <a href="{{ auth()->check() ? 'javascript:void(0)' : route('user.layanan') }}"
                       @auth onclick="openBookingSheet('layanan')" @endauth
                       class="feature-card reveal delay-3">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <line x1="7" y1="9" x2="17" y2="9"/>
                                <line x1="7" y1="14" x2="13" y2="14"/>
                            </svg>
                        </div>
                        <div class="feature-name">Diagnostik mesin</div>
                        <p class="feature-text">
                            Scanner komputer dan analisis teknisi untuk menemukan akar masalah secara akurat.
                        </p>
                    </a>
                </div>

                <div class="feature-grid-bottom">
                    <a href="{{ auth()->check() ? 'javascript:void(0)' : route('user.layanan') }}"
                       @auth onclick="openBookingSheet('layanan')" @endauth
                       class="feature-card reveal delay-2">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <line x1="4" y1="21" x2="4" y2="14"/>
                                <line x1="4" y1="10" x2="4" y2="3"/>
                                <line x1="12" y1="21" x2="12" y2="12"/>
                                <line x1="12" y1="8" x2="12" y2="3"/>
                                <line x1="20" y1="21" x2="20" y2="16"/>
                                <line x1="20" y1="12" x2="20" y2="3"/>
                                <line x1="1" y1="14" x2="7" y2="14"/>
                                <line x1="9" y1="8" x2="15" y2="8"/>
                                <line x1="17" y1="16" x2="23" y2="16"/>
                            </svg>
                        </div>
                        <div class="feature-name">Transmisi</div>
                        <p class="feature-text">
                            Penyetelan transmisi agar motor bisa melaju dengan mulus tanpa terkendala.
                        </p>
                    </a>

                    <a href="{{ auth()->check() ? 'javascript:void(0)' : route('user.layanan') }}"
                       @auth onclick="openBookingSheet('layanan')" @endauth
                       class="feature-card reveal delay-3">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <polyline points="9 12 11 14 15 10"/>
                            </svg>
                        </div>
                        <div class="feature-name">Inspeksi kendaraan</div>
                        <p class="feature-text">
                            Pengecekan menyeluruh sebelum perjalanan jauh.
                        </p>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================================================
         HALAMAN 2: LAYANAN (BACKGROUND GAMBAR + LIST 5 KOTAK PER HALAMAN)
         ============================================================================ --}}
    @if ($currentPage === 'layanan')
        <section class="subpage-banner-bg">
            <div class="container subpage-header reveal">
                <div>
                    <div class="section-tag-gold" style="margin-bottom:8px;">
                        <span class="eyebrow-dot"></span>
                        <span>Katalog Layanan</span>
                    </div>
                    <h1 class="subpage-title">Daftar Layanan Servis</h1>
                    <p class="subpage-subtitle">Pilih layanan perawatan kendaraan dan jadwalkan kedatangan Anda.</p>
                </div>

                <div class="subpage-controls">
                    <div class="search-field">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input type="text" id="listSearchInput" placeholder="Cari layanan..." oninput="filterPaginatedList(true)">
                    </div>
                    @auth
                        <button type="button" class="btn btn-gold" onclick="openBookingSheet('layanan')">Booking Layanan</button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-gold">Masuk untuk Booking</a>
                    @endauth
                </div>
            </div>
        </section>

        <section class="subpage-body-section">
            <div class="container">
                <div class="list-card-container reveal delay-1">
                    <div class="list-rows-wrapper" id="paginatedListBody">
                        @forelse ($layananAktif ?? [] as $layanan)
                            @php
                                $kode = 'HG-' . str_pad((string) $layanan->id, 2, '0', STR_PAD_LEFT);
                                $durasi = $layanan->estimasi_durasi ?: ($layanan->deskripsi ?? '30 - 45 Menit');
                            @endphp
                            <div class="list-row-box paginated-item">
                                <div class="list-row-left">
                                    <span class="list-code-box">{{ $kode }}</span>
                                    <div class="list-info-main">
                                        <div class="list-item-name">{{ $layanan->nama_layanan }}</div>
                                        <div class="list-item-meta">
                                            <span class="meta-pill gold">Durasi: {{ $durasi }}</span>
                                            <span>Standar SOP Hunter Garage</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-row-right">
                                    <div class="list-price-col">
                                        <span class="list-price-label">Biaya Layanan</span>
                                        <span class="list-price-val">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                                    </div>
                                    @auth
                                        <button type="button" class="btn btn-dark" onclick="openBookingSheet('layanan', '{{ $layanan->id }}')">
                                            Booking
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                                    @endauth
                                </div>
                            </div>
                        @empty
                            <div class="list-empty-state" id="serverEmptyBox">
                                <div class="list-empty-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                    </svg>
                                </div>
                                <div class="list-empty-title">Belum Ada Layanan Aktif</div>
                                <div class="list-empty-sub">Daftar layanan servis akan tampil di sini setelah ditambahkan oleh Admin.</div>
                            </div>
                        @endforelse

                        <div class="list-empty-state" id="filterEmptyBox" style="display:none;">
                            <div class="list-empty-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                </svg>
                            </div>
                            <div class="list-empty-title">Layanan Tidak Ditemukan</div>
                            <div class="list-empty-sub">Tidak ada layanan yang cocok dengan kata kunci pencarian Anda.</div>
                        </div>
                    </div>

                    <div class="list-pagination-footer">
                        <div class="page-info-text" id="listPageInfo">Menampilkan 0 data</div>
                        <div class="page-btn-group" id="listPageControls"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================================================
         HALAMAN 3: PRODUK (BACKGROUND GAMBAR + LIST 5 KOTAK PER HALAMAN)
         ============================================================================ --}}
    @if ($currentPage === 'produk')
        <section class="subpage-banner-bg">
            <div class="container subpage-header reveal">
                <div>
                    <div class="section-tag-gold" style="margin-bottom:8px;">
                        <span class="eyebrow-dot"></span>
                        <span>Katalog Sparepart</span>
                    </div>
                    <h1 class="subpage-title">Daftar Produk & Sparepart</h1>
                    <p class="subpage-subtitle">Suku cadang dan pelumas resmi yang tersedia di bengkel kami.</p>
                </div>

                <div class="subpage-controls">
                    <div class="search-field">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input type="text" id="listSearchInput" placeholder="Cari produk..." oninput="filterPaginatedList(true)">
                    </div>
                    @auth
                        <button type="button" class="btn btn-gold" onclick="openBookingSheet('produk')">Pesan Produk</button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-gold">Masuk untuk Membeli</a>
                    @endauth
                </div>
            </div>
        </section>

        <section class="subpage-body-section">
            <div class="container">
                <div class="list-card-container reveal delay-1">
                    <div class="list-rows-wrapper" id="paginatedListBody">
                        @forelse ($produkAktif ?? [] as $produk)
                            @php
                                $kode = 'HG-' . str_pad((string) $produk->id, 2, '0', STR_PAD_LEFT);
                                $stok = (int) ($produk->stok ?? 0);
                                $stokHabis = $stok <= 0;
                            @endphp
                            <div class="list-row-box paginated-item">
                                <div class="list-row-left">
                                    <span class="list-code-box">{{ $kode }}</span>
                                    <div class="list-info-main">
                                        <div class="list-item-name">{{ $produk->nama_produk }}</div>
                                        <div class="list-item-meta">
                                            <span class="meta-pill {{ $stok < 5 ? 'danger' : 'gold' }}">Stok: {{ $stok }}</span>
                                            <span>{{ $produk->deskripsi ?: 'Suku cadang original Hunter Garage' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-row-right">
                                    <div class="list-price-col">
                                        <span class="list-price-label">Harga Produk</span>
                                        <span class="list-price-val">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                                    </div>
                                    @auth
                                        <button type="button" class="btn btn-dark" onclick="openBookingSheet('produk', '{{ $produk->id }}')" {{ $stokHabis ? 'disabled' : '' }}>
                                            {{ $stokHabis ? 'Habis' : 'Pesan' }}
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                                    @endauth
                                </div>
                            </div>
                        @empty
                            <div class="list-empty-state" id="serverEmptyBox">
                                <div class="list-empty-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                    </svg>
                                </div>
                                <div class="list-empty-title">Belum Ada Produk Aktif</div>
                                <div class="list-empty-sub">Daftar produk dan sparepart akan tampil di sini setelah ditambahkan oleh Admin.</div>
                            </div>
                        @endforelse

                        <div class="list-empty-state" id="filterEmptyBox" style="display:none;">
                            <div class="list-empty-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                </svg>
                            </div>
                            <div class="list-empty-title">Produk Tidak Ditemukan</div>
                            <div class="list-empty-sub">Tidak ada produk yang cocok dengan kata kunci pencarian Anda.</div>
                        </div>
                    </div>

                    <div class="list-pagination-footer">
                        <div class="page-info-text" id="listPageInfo">Menampilkan 0 data</div>
                        <div class="page-btn-group" id="listPageControls"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================================================
         HALAMAN 4: PESANAN SAYA (BACKGROUND GAMBAR + LIST 5 KOTAK PER HALAMAN)
         ============================================================================ --}}
    @if ($currentPage === 'pesanan')
        <section class="subpage-banner-bg">
            <div class="container subpage-header reveal">
                <div>
                    <div class="section-tag-gold" style="margin-bottom:8px;">
                        <span class="eyebrow-dot"></span>
                        <span>Status Booking</span>
                    </div>
                    <h1 class="subpage-title">Pesanan Saya</h1>
                    <p class="subpage-subtitle">Pantau status konfirmasi jadwal servis dan pemesanan produk Anda.</p>
                </div>

                <div class="subpage-controls">
                    <div class="search-field">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input type="text" id="listSearchInput" placeholder="Cari pesanan..." oninput="filterPaginatedList(true)">
                    </div>
                    <button type="button" class="btn btn-gold" onclick="openBookingSheet('layanan')">Buat Booking</button>
                </div>
            </div>
        </section>

        <section class="subpage-body-section">
            <div class="container">
                <div class="list-card-container reveal delay-1">
                    <div class="list-rows-wrapper" id="paginatedListBody">
                        @forelse ($pesananUser ?? [] as $p)
                            @php
                                $kode = 'BKG-' . str_pad((string) $p->id, 4, '0', STR_PAD_LEFT);
                                $waktu = $p->jadwal_service ?? $p->created_at;
                                $carbon = $waktu ? \Carbon\Carbon::parse($waktu)->locale('id') : null;
                                $statusMeta = match($p->status) {
                                    'selesai' => ['class' => 'success', 'label' => 'Diterima'],
                                    'dibatalkan' => ['class' => 'danger', 'label' => 'Ditolak'],
                                    default => ['class' => 'gold', 'label' => 'Menunggu'],
                                };
                            @endphp
                            <div class="list-row-box paginated-item">
                                <div class="list-row-left">
                                    <span class="list-code-box">{{ $kode }}</span>
                                    <div class="list-info-main">
                                        <div class="list-item-name">{{ $p->nama_layanan ?? '-' }}</div>
                                        <div class="list-item-meta">
                                            <span class="meta-pill">{{ ucfirst($p->kategori ?? 'layanan') }}</span>
                                            <span>Jadwal: {{ $carbon ? $carbon->translatedFormat('d M Y, H:i') : '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-row-right">
                                    <div class="list-price-col">
                                        <span class="list-price-label">Total Biaya</span>
                                        <span class="list-price-val">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                                    </div>
                                    <span class="meta-pill {{ $statusMeta['class'] }}" style="padding:6px 14px; font-size:12px;">
                                        {{ $statusMeta['label'] }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="list-empty-state" id="serverEmptyBox">
                                <div class="list-empty-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <rect x="6" y="4" width="12" height="16" rx="2"/>
                                        <line x1="9" y1="9" x2="15" y2="9"/>
                                        <line x1="9" y1="13" x2="15" y2="13"/>
                                    </svg>
                                </div>
                                <div class="list-empty-title">Belum Ada Pesanan</div>
                                <div class="list-empty-sub">Anda belum memiliki riwayat booking layanan atau pemesanan produk.</div>
                            </div>
                        @endforelse

                        <div class="list-empty-state" id="filterEmptyBox" style="display:none;">
                            <div class="list-empty-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                </svg>
                            </div>
                            <div class="list-empty-title">Pesanan Tidak Ditemukan</div>
                            <div class="list-empty-sub">Tidak ada pesanan yang cocok dengan pencarian Anda.</div>
                        </div>
                    </div>

                    <div class="list-pagination-footer">
                        <div class="page-info-text" id="listPageInfo">Menampilkan 0 data</div>
                        <div class="page-btn-group" id="listPageControls"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ================= FOOTER MINIMALIS & PRESISI ================= -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid reveal">
                <div>
                    <a href="{{ route('home') }}" class="brand-link">
                        <img src="{{ asset('images/logo.png') }}" alt="Hunter Garage" class="brand-logo">
                        <div class="brand-meta">
                            <span class="brand-name">Hunter Garage</span>
                            <span class="brand-sub">Service & Sparepart</span>
                        </div>
                    </a>
                    <p class="footer-desc">
                        Bengkel otomotif profesional untuk servis transparan, sparepart terverifikasi, dan perjalanan yang lebih tenang.
                    </p>
                    <div class="footer-socials">
                        <a href="javascript:void(0)" class="social-btn" aria-label="Instagram">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="5"/>
                                <circle cx="12" cy="12" r="4"/>
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="social-btn" aria-label="Facebook">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="social-btn" aria-label="YouTube">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="5" width="20" height="14" rx="4"/>
                                <polygon points="10 9 15 12 10 15 10 9" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <div class="footer-heading">Jelajahi</div>
                    <ul class="footer-list">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('user.layanan') }}">Layanan</a></li>
                        <li><a href="{{ route('user.produk') }}">Sparepart</a></li>
                        <li><a href="{{ route('home') }}">Tentang kami</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-heading">Layanan</div>
                    <ul class="footer-list">
                        <li><a href="{{ route('user.layanan') }}">Servis berkala</a></li>
                        <li><a href="{{ route('user.layanan') }}">Diagnostik</a></li>
                        <li><a href="{{ route('user.layanan') }}">Rem & Kaki</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-heading">Workshop</div>
                    <ul class="footer-list">
                        <li>Jl. Taruna Praja Banjarbaru<br>Kalimantan Selatan, Indonesia</li>
                        <li style="margin-top:4px;">Senin–Minggu, 08.00–22.00<br>Konsultasi online 24/7</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-copy">
            &copy; 2026 Hunter Garage. Semua hak dilindungi.
        </div>
    </footer>

    {{-- ============================================================================
         FLOATING BOTTOM DOCK (MUNCUL SAAT NAVBAR ATAS TIDAK TERLIHAT / DI-SCROLL)
         ============================================================================ --}}
    <div class="bottom-dock" id="bottomDock" role="navigation" aria-label="Navigasi Cepat">
        <div class="dock-nav">
            <a href="{{ route('home') }}" class="dock-link {{ $currentPage === 'beranda' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                <span>Beranda</span>
            </a>
            <a href="{{ route('user.layanan') }}" class="dock-link {{ $currentPage === 'layanan' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                </svg>
                <span>Layanan</span>
            </a>
            <a href="{{ route('user.produk') }}" class="dock-link {{ $currentPage === 'produk' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                </svg>
                <span>Produk</span>
            </a>
            @auth
                <a href="{{ route('user.pesanan') }}" class="dock-link {{ $currentPage === 'pesanan' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="6" y="4" width="12" height="16" rx="2"/>
                        <line x1="9" y1="9" x2="15" y2="9"/>
                        <line x1="9" y1="13" x2="15" y2="13"/>
                    </svg>
                    <span>Pesanan</span>
                </a>
            @endauth
        </div>

        @auth
            <button type="button" class="dock-cta-btn" onclick="openBookingSheet('{{ $currentPage === 'produk' ? 'produk' : 'layanan' }}')">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                <span>Booking</span>
            </button>
        @else
            <a href="{{ route('login') }}" class="dock-cta-btn">
                <span>Masuk</span>
            </a>
        @endauth
    </div>

    @auth
        <!-- SLIDE-UP BOOKING FORM -->
        <div class="sheet-backdrop" id="bookingSheetBackdrop" onclick="handleBackdropClick(event)">
            <form method="POST" action="{{ route('user.pesanan.store') }}" class="sheet-panel">
                @csrf
                <input type="hidden" name="kategori" id="hiddenKategori" value="layanan">
                <input type="hidden" name="layanan_id" id="hiddenLayananId" value="{{ optional(($layananAktif ?? collect())->first())->id }}">
                <input type="hidden" name="produk_id" id="hiddenProdukId" value="{{ optional(($produkAktif ?? collect())->where('stok', '>', 0)->first())->id }}">

                <div class="sheet-top">
                    <div class="sheet-bar"></div>
                    <div class="sheet-head-row">
                        <div class="sheet-title">Form Pemesanan</div>
                        <button type="button" class="sheet-close" onclick="closeBookingSheet()" aria-label="Tutup">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>

                    <div class="sheet-tabs">
                        <button type="button" class="sheet-tab-btn active" id="tabBtnLayanan" onclick="switchCategory('layanan')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                            </svg>
                            <span>Layanan Servis</span>
                        </button>
                        <button type="button" class="sheet-tab-btn" id="tabBtnProduk" onclick="switchCategory('produk')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                            </svg>
                            <span>Produk & Sparepart</span>
                        </button>
                    </div>
                </div>

                <div class="sheet-body">
                    <div id="listLayananGroup">
                        <span class="field-label">Pilih Layanan</span>
                        <div class="option-list">
                            @forelse ($layananAktif ?? [] as $idx => $layanan)
                                <div class="option-item {{ $idx === 0 ? 'selected' : '' }}"
                                     data-type="layanan"
                                     data-id="{{ $layanan->id }}"
                                     data-harga="{{ $layanan->harga }}"
                                     onclick="selectOptionItem(this)">
                                    <div class="option-left">
                                        <span class="option-radio"></span>
                                        <div>
                                            <div class="option-name">{{ $layanan->nama_layanan }}</div>
                                            <div class="option-sub">Durasi: {{ $layanan->estimasi_durasi ?: ($layanan->deskripsi ?? '30 - 45 Menit') }}</div>
                                        </div>
                                    </div>
                                    <div class="option-price">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</div>
                                </div>
                            @empty
                                <div style="padding:16px; text-align:center; color:#71717a; font-size:13px;">Belum ada layanan tersedia.</div>
                            @endforelse
                        </div>
                    </div>

                    <div id="listProdukGroup" style="display:none;">
                        <span class="field-label">Pilih Produk</span>
                        <div class="option-list">
                            @forelse ($produkAktif ?? [] as $produk)
                                @php $habis = ($produk->stok ?? 0) <= 0; @endphp
                                <div class="option-item {{ $habis ? 'disabled' : '' }}"
                                     data-type="produk"
                                     data-id="{{ $produk->id }}"
                                     data-harga="{{ $produk->harga_jual }}"
                                     onclick="{{ $habis ? '' : 'selectOptionItem(this)' }}">
                                    <div class="option-left">
                                        <span class="option-radio"></span>
                                        <div>
                                            <div class="option-name">{{ $produk->nama_produk }}</div>
                                            <div class="option-sub">Stok: {{ $produk->stok ?? 0 }}</div>
                                        </div>
                                    </div>
                                    <div class="option-price">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</div>
                                </div>
                            @empty
                                <div style="padding:16px; text-align:center; color:#71717a; font-size:13px;">Belum ada produk tersedia.</div>
                            @endforelse
                        </div>
                    </div>

                    <span class="field-label">Jadwal Kedatangan (08.00 – 22.00)</span>
                    <input type="datetime-local" name="jadwal_service" class="schedule-input" value="{{ now()->format('Y-m-d\T09:00') }}" required>
                </div>

                <div class="sheet-footer">
                    <div>
                        <div class="total-label">Total Biaya</div>
                        <div class="total-amount" id="totalPriceDisplay">Rp 0</div>
                    </div>
                    <button type="submit" class="btn-submit-sheet">Pesan Sekarang</button>
                </div>
            </form>
        </div>
    @endauth

    <script>
        // 1. Efek Cahaya Bulat Kursor (Smooth Cursor Glow)
        const cursorGlow = document.getElementById('cursorGlow');
        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let glowX = mouseX;
        let glowY = mouseY;

        if (cursorGlow && window.matchMedia('(pointer: fine)').matches) {
            window.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                if (!cursorGlow.classList.contains('active')) {
                    cursorGlow.classList.add('active');
                }
            }, { passive: true });

            document.addEventListener('mouseleave', () => {
                cursorGlow.classList.remove('active');
            });

            const interactiveSelectors = 'a, button, input, .feature-card, .process-step-card, .list-row-box, .option-item, .stat-item';
            document.querySelectorAll(interactiveSelectors).forEach((el) => {
                el.addEventListener('mouseenter', () => cursorGlow.classList.add('hovering'));
                el.addEventListener('mouseleave', () => cursorGlow.classList.remove('hovering'));
            });

            function animateCursorGlow() {
                glowX += (mouseX - glowX) * 0.18;
                glowY += (mouseY - glowY) * 0.18;
                cursorGlow.style.transform = `translate3d(${glowX}px, ${glowY}px, 0) translate3d(-50%, -50%, 0)`;
                requestAnimationFrame(animateCursorGlow);
            }
            requestAnimationFrame(animateCursorGlow);
        }

        // 2. Transisi Navbar Transparan Atas -> Muncul Layout Navigasi Bawah saat Scroll
        const mainNavbar = document.getElementById('mainNavbar');
        const bottomDock = document.getElementById('bottomDock');

        function handleScrollNavTransition() {
            const isPastNavbar = window.scrollY > 75;
            if (mainNavbar) {
                mainNavbar.classList.toggle('nav-hidden', isPastNavbar);
            }
            if (bottomDock) {
                bottomDock.classList.toggle('visible', isPastNavbar);
            }
        }

        window.addEventListener('scroll', handleScrollNavTransition, { passive: true });
        handleScrollNavTransition();

        const revealEls = document.querySelectorAll('.reveal');
        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
            revealEls.forEach((el) => io.observe(el));
        } else {
            revealEls.forEach((el) => el.classList.add('in-view'));
        }

        // 3. Pagination 5 Kotak Per Halaman + Slot Tetap (Layanan, Produk, Pesanan)
        const paginatedListBody = document.getElementById('paginatedListBody');
        const listSearchInput = document.getElementById('listSearchInput');
        const allListItems = Array.from(document.querySelectorAll('.paginated-item'));
        const serverEmptyBox = document.getElementById('serverEmptyBox');
        const filterEmptyBox = document.getElementById('filterEmptyBox');
        const listPageInfo = document.getElementById('listPageInfo');
        const listPageControls = document.getElementById('listPageControls');
        const PER_PAGE = 5;
        let currentListPage = 1;

        function syncFillerBoxes(visibleCount) {
            if (!paginatedListBody) return;
            paginatedListBody.querySelectorAll('.list-filler-box').forEach((el) => el.remove());

            if (visibleCount > 0 && visibleCount < PER_PAGE) {
                const missing = PER_PAGE - visibleCount;
                for (let i = 0; i < missing; i++) {
                    const div = document.createElement('div');
                    div.className = 'list-filler-box';
                    div.innerHTML = '<span class="filler-line"></span><span class="filler-line"></span>';
                    paginatedListBody.appendChild(div);
                }
            }
        }

        function renderListPagination(totalItems, totalPages) {
            if (!listPageInfo || !listPageControls) return;

            if (totalItems === 0) {
                listPageInfo.innerHTML = 'Menampilkan <strong>0</strong> data';
                listPageControls.innerHTML = `
                    <button type="button" class="pg-btn" disabled>&lsaquo; Prev</button>
                    <button type="button" class="pg-btn active" disabled>1</button>
                    <button type="button" class="pg-btn" disabled>Next &rsaquo;</button>
                `;
                return;
            }

            const start = (currentListPage - 1) * PER_PAGE + 1;
            const end = Math.min(currentListPage * PER_PAGE, totalItems);
            listPageInfo.innerHTML = `Menampilkan <strong>${start}&ndash;${end}</strong> dari <strong>${totalItems}</strong> data`;

            let html = `<button type="button" class="pg-btn" ${currentListPage === 1 ? 'disabled' : ''} data-pg="${currentListPage - 1}">&lsaquo; Prev</button>`;
            for (let p = 1; p <= totalPages; p++) {
                html += `<button type="button" class="pg-btn ${p === currentListPage ? 'active' : ''}" data-pg="${p}">${p}</button>`;
            }
            html += `<button type="button" class="pg-btn" ${currentListPage === totalPages ? 'disabled' : ''} data-pg="${currentListPage + 1}">Next &rsaquo;</button>`;

            listPageControls.innerHTML = html;
            listPageControls.querySelectorAll('.pg-btn[data-pg]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const target = Number(btn.dataset.pg);
                    if (target >= 1 && target <= totalPages && target !== currentListPage) {
                        currentListPage = target;
                        filterPaginatedList(false);
                    }
                });
            });
        }

        function filterPaginatedList(resetPage = true) {
            if (!paginatedListBody) return;
            if (resetPage) currentListPage = 1;

            if (serverEmptyBox) {
                syncFillerBoxes(0);
                renderListPagination(0, 1);
                return;
            }

            const q = (listSearchInput ? listSearchInput.value : '').toLowerCase().trim();
            const matched = allListItems.filter((item) => item.textContent.toLowerCase().includes(q));
            const totalItems = matched.length;
            const totalPages = Math.max(1, Math.ceil(totalItems / PER_PAGE));
            if (currentListPage > totalPages) currentListPage = totalPages;

            allListItems.forEach((item) => { item.style.display = 'none'; });

            const startIdx = (currentListPage - 1) * PER_PAGE;
            const visibleSlice = matched.slice(startIdx, startIdx + PER_PAGE);
            visibleSlice.forEach((item) => { item.style.display = ''; });

            if (filterEmptyBox) {
                filterEmptyBox.style.display = totalItems === 0 ? '' : 'none';
            }

            syncFillerBoxes(visibleSlice.length);
            renderListPagination(totalItems, totalPages);
        }

        if (paginatedListBody) {
            filterPaginatedList(true);
        }

        // 4. Booking Sheet Logic
        const sheetBackdrop = document.getElementById('bookingSheetBackdrop');
        const hiddenKategori = document.getElementById('hiddenKategori');
        const hiddenLayananId = document.getElementById('hiddenLayananId');
        const hiddenProdukId = document.getElementById('hiddenProdukId');
        const tabBtnLayanan = document.getElementById('tabBtnLayanan');
        const tabBtnProduk = document.getElementById('tabBtnProduk');
        const listLayananGroup = document.getElementById('listLayananGroup');
        const listProdukGroup = document.getElementById('listProdukGroup');
        const totalPriceDisplay = document.getElementById('totalPriceDisplay');

        function switchCategory(kategori) {
            if (!hiddenKategori) return;
            hiddenKategori.value = kategori;
            const isProduk = kategori === 'produk';

            if (tabBtnLayanan) tabBtnLayanan.classList.toggle('active', !isProduk);
            if (tabBtnProduk) tabBtnProduk.classList.toggle('active', isProduk);
            if (listLayananGroup) listLayananGroup.style.display = isProduk ? 'none' : '';
            if (listProdukGroup) listProdukGroup.style.display = isProduk ? '' : 'none';

            const group = isProduk ? listProdukGroup : listLayananGroup;
            if (group) {
                let selected = group.querySelector('.option-item.selected:not(.disabled)');
                if (!selected) {
                    selected = group.querySelector('.option-item:not(.disabled)');
                    if (selected) selected.classList.add('selected');
                }
                if (selected) {
                    selectOptionItem(selected);
                } else if (totalPriceDisplay) {
                    totalPriceDisplay.textContent = 'Rp 0';
                }
            }
        }

        function selectOptionItem(item) {
            if (!item || item.classList.contains('disabled')) return;
            const type = item.dataset.type;
            const id = item.dataset.id;
            const harga = Number(item.dataset.harga || 0);

            const list = item.closest('.option-list');
            if (list) {
                list.querySelectorAll('.option-item').forEach((el) => el.classList.remove('selected'));
            }
            item.classList.add('selected');

            if (type === 'produk' && hiddenProdukId) {
                hiddenProdukId.value = id;
            } else if (hiddenLayananId) {
                hiddenLayananId.value = id;
            }

            if (totalPriceDisplay) {
                totalPriceDisplay.textContent = 'Rp ' + harga.toLocaleString('id-ID');
            }
        }

        function openBookingSheet(kategori = 'layanan', itemId = null) {
            if (!sheetBackdrop) return;
            switchCategory(kategori);

            if (itemId) {
                const group = kategori === 'produk' ? listProdukGroup : listLayananGroup;
                if (group) {
                    const target = group.querySelector(`.option-item[data-id="${itemId}"]`);
                    if (target && !target.classList.contains('disabled')) {
                        selectOptionItem(target);
                        target.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                    }
                }
            }

            sheetBackdrop.classList.add('open');
        }

        function closeBookingSheet() {
            if (!sheetBackdrop) return;
            sheetBackdrop.classList.remove('open');
        }

        function handleBackdropClick(e) {
            if (e.target === sheetBackdrop) {
                closeBookingSheet();
            }
        }

        if (hiddenKategori) {
            switchCategory('layanan');
        }
    </script>
</body>
</html>
