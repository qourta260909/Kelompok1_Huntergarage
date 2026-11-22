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
            min-height: calc(100vh - 79px);
            flex: 1;
        }

        .user-sidebar {
            background-color: #1c1c1e;
            color: #ffffff;
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .user-sidebar-profile {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0 6px;
        }

        .user-sidebar-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background-color: #d4d4d8;
            color: #18181b;
            font-size: 17px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-sidebar-name {
            font-size: 14.5px;
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
            font-size: 13.5px;
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
            background-color: rgba(255, 255, 255, 0.06);
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
            padding: 32px 42px 22px;
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
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            align-items: center;
            padding: 0 42px;
        }

        .status-tab-btn {
            position: relative;
            background: transparent;
            border: none;
            padding: 16px 12px;
            font-family: inherit;
            font-size: 14.5px;
            font-weight: 600;
            color: #52525b;
            cursor: pointer;
            white-space: nowrap;
            text-align: center;
            width: 100%;
            transition: color 0.16s ease;
        }

        .status-tab-btn:hover {
            color: #111111;
        }

        .status-tab-btn.active {
            color: #f59e0b;
            font-weight: 700;
        }

        .status-tab-btn.active::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            width: 96px;
            height: 3px;
            background-color: #f59e0b;
            border-radius: 999px 999px 0 0;
        }

        /* Panel Body & Empty State */
        .user-panel-body {
            flex: 1;
            padding: 28px 42px 48px;
            display: flex;
            flex-direction: column;
        }

        .orders-empty-state {
            flex: 1;
            min-height: 430px;
            background-color: #ffffff;
            border: 1px solid #e4e4e7;
            border-radius: 18px;
            padding: 72px 32px 48px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
        }

        .orders-empty-illustration {
            margin-top: 12px;
            margin-bottom: 4px;
        }

        .orders-empty-title {
            font-size: 21px;
            font-weight: 700;
            color: #09090b;
            margin: 0;
        }

        .orders-empty-desc {
            max-width: 44ch;
            font-size: 13.5px;
            font-weight: 500;
            color: #52525b;
            line-height: 1.6;
            margin: 0;
        }

        .orders-empty-cta {
            margin-top: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 24px;
            border-radius: 10px;
            background-color: #111111;
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.16s ease, transform 0.16s ease;
        }

        .orders-empty-cta:hover {
            background-color: #27272a;
            transform: translateY(-1px);
        }

        /* Order List Cards */
        .user-orders-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .user-order-item-card {
            background-color: #ffffff;
            border: 1px solid #e4e4e7;
            border-radius: 16px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.035);
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
        }

        .user-order-item-card:hover {
            border-color: #d4d4d8;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.055);
        }

        .user-order-item-left {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
            min-width: 240px;
        }

        .user-order-item-top {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .user-order-code {
            font-size: 12.5px;
            font-weight: 800;
            color: #09090b;
            background-color: #f4f4f5;
            border: 1px solid #e4e4e7;
            padding: 4px 10px;
            border-radius: 7px;
            letter-spacing: 0.02em;
        }

        .user-order-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 999px;
        }

        .user-order-status-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: currentColor;
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
            font-size: 16.5px;
            font-weight: 700;
            color: #09090b;
            margin: 2px 0 0;
            line-height: 1.35;
        }

        .user-order-item-meta-group {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 2px;
        }

        .user-order-item-meta {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            font-weight: 500;
            color: #52525b;
        }

        .user-order-item-meta svg {
            width: 14px;
            height: 14px;
            color: #71717a;
            flex-shrink: 0;
        }

        .user-order-item-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
        }

        .user-order-price-box {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 1px;
        }

        .user-order-price-label {
            font-size: 11px;
            font-weight: 600;
            color: #71717a;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .user-order-item-price {
            font-size: 18px;
            font-weight: 800;
            color: #09090b;
            font-variant-numeric: tabular-nums;
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

        /* ================= HALAMAN KONFIRMASI ALA GOJEK SETELAH BAYAR ================= */
        .confirm-page-wrap {
            background-image: linear-gradient(180deg, rgba(24, 24, 27, 0.52) 0%, rgba(24, 24, 27, 0.72) 100%), url('{{ Vite::asset("resources/images/layanan-hero.png") }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            flex: 1;
            padding: 34px 20px 64px;
        }
        .gojek-receipt-shell {
            max-width: 700px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .gojek-card {
            background-color: #ffffff;
            border-radius: 20px;
            border: 1px solid #e4e4e7;
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.16);
            overflow: hidden;
        }
        .gojek-status-head {
            padding: 24px 26px 20px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .gojek-status-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .gojek-status-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .gojek-status-circle.done { background-color: #dcfce7; color: #15803d; }
        .gojek-status-circle.waiting { background-color: #fef3c7; color: #b45309; }
        .gojek-status-circle.rejected { background-color: #fee2e2; color: #b91c1c; }
        .gojek-status-title {
            font-size: 19px;
            font-weight: 800;
            color: #09090b;
            margin: 0 0 3px;
            line-height: 1.25;
        }
        .gojek-status-sub {
            font-size: 13px;
            font-weight: 500;
            color: #52525b;
            margin: 0;
        }
        .gojek-code-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #f4f4f5;
            border: 1px solid #e4e4e7;
            border-radius: 999px;
            padding: 7px 14px;
            font-size: 13px;
            font-weight: 800;
            color: #09090b;
        }
        .gojek-copy-btn {
            background: transparent;
            border: none;
            color: #52525b;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            padding: 2px;
        }
        .gojek-copy-btn:hover { color: #09090b; }

        /* Horizontal Gojek Tracker */
        .gojek-tracker {
            padding: 18px 26px 24px;
            border-top: 1px solid #f4f4f5;
            background-color: #fafafa;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            position: relative;
        }
        .gojek-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .gojek-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px;
            left: calc(50% + 18px);
            right: calc(-50% + 18px);
            height: 3px;
            background-color: #e4e4e7;
            z-index: 0;
        }
        .gojek-step.done:not(:last-child)::after {
            background-color: #16a34a;
        }
        .gojek-step-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e4e4e7;
            color: #71717a;
            font-size: 13px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }
        .gojek-step.done .gojek-step-dot {
            background-color: #16a34a;
            color: #ffffff;
        }
        .gojek-step.active .gojek-step-dot {
            background-color: #111111;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(17, 17, 17, 0.12);
        }
        .gojek-step-label {
            font-size: 12px;
            font-weight: 700;
            color: #71717a;
            line-height: 1.3;
        }
        .gojek-step.done .gojek-step-label,
        .gojek-step.active .gojek-step-label {
            color: #09090b;
        }
        .gojek-rejected-bar {
            padding: 14px 26px;
            background-color: #fef2f2;
            border-top: 1px solid #fecaca;
            color: #991b1b;
            font-size: 13px;
            font-weight: 600;
        }

        /* Merchant & Receipt Body */
        .gojek-merchant-row {
            padding: 20px 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }
        .gojek-merchant-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .gojek-merchant-logo {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background-color: #f4f4f5;
            border: 1px solid #e4e4e7;
            padding: 5px;
            object-fit: contain;
        }
        .gojek-merchant-name {
            font-size: 15px;
            font-weight: 800;
            color: #09090b;
            margin: 0;
        }
        .gojek-merchant-addr {
            font-size: 12px;
            font-weight: 500;
            color: #71717a;
            margin: 2px 0 0;
        }
        .gojek-type-tag {
            font-size: 11.5px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 999px;
            background-color: #f4f4f5;
            color: #18181b;
        }
        .gojek-receipt-divider {
            position: relative;
            border-top: 1.5px dashed #d4d4d8;
            margin: 0 26px;
        }
        .gojek-section {
            padding: 20px 26px;
        }
        .gojek-section-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #71717a;
            margin: 0 0 14px;
        }
        .gojek-item-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .gojek-item-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
        }
        .gojek-item-left {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .gojek-qty-badge {
            min-width: 26px;
            height: 24px;
            padding: 0 6px;
            border-radius: 6px;
            background-color: #f4f4f5;
            border: 1px solid #e4e4e7;
            font-size: 12px;
            font-weight: 800;
            color: #09090b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .gojek-item-name {
            font-size: 13.5px;
            font-weight: 700;
            color: #09090b;
            line-height: 1.35;
        }
        .gojek-item-sub {
            font-size: 12px;
            color: #71717a;
            margin-top: 2px;
        }
        .gojek-item-price {
            font-size: 13.5px;
            font-weight: 700;
            color: #09090b;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }
        .gojek-kv-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .gojek-kv-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            font-size: 13px;
        }
        .gojek-kv-key { color: #71717a; font-weight: 500; }
        .gojek-kv-val { color: #09090b; font-weight: 700; text-align: right; }
        .gojek-total-box {
            margin: 0 26px 20px;
            padding: 16px 20px;
            border-radius: 14px;
            background-color: #f4f4f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .gojek-total-label {
            font-size: 14px;
            font-weight: 700;
            color: #18181b;
        }
        .gojek-total-amount {
            font-size: 21px;
            font-weight: 800;
            color: #09090b;
            font-variant-numeric: tabular-nums;
        }
        .gojek-actions-bar {
            padding: 0 26px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .gojek-btn-primary {
            flex: 1;
            min-width: 170px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 999px;
            background-color: #111111;
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.16s ease;
        }
        .gojek-btn-primary:hover { background-color: #27272a; }
        .gojek-btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 999px;
            background-color: #ffffff;
            border: 1.5px solid #d4d4d8;
            color: #09090b;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.16s ease, border-color 0.16s ease;
        }
        .gojek-btn-outline:hover {
            background-color: #f4f4f5;
            border-color: #a1a1aa;
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
            max-width: 560px;
            margin: 0 auto 36px;
            background-color: #ffffff;
            border: 1.2px solid #d4d4d8;
            border-radius: 18px;
            padding: 28px 24px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
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
            gap: 36px;
            align-items: flex-start;
        }
        .detail-card {
            background-color: #ffffff;
            border: 1.2px solid #d4d4d8;
            border-radius: 18px;
            padding: 26px 28px 24px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }
        .next-steps-box {
            background-color: #ffffff;
            border: 1.2px solid #d4d4d8;
            border-radius: 18px;
            padding: 26px 28px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
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
            .user-panel-header,
            .user-panel-body {
                padding-left: 20px;
                padding-right: 20px;
            }
            .status-tabs-bar {
                padding: 0 12px;
            }
            .user-order-item-card {
                flex-direction: column;
                align-items: flex-start;
            }
            .user-order-item-right,
            .user-order-price-box {
                align-items: flex-start;
                width: 100%;
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
        {{-- ================= TAMPILAN STRUK & TRACKING ALA GOJEK SETELAH BAYAR ================= --}}
        @php
            $pesananAktif = $pesananDetail;
            $isLayananView = ($pesananAktif->kategori ?? 'layanan') === 'layanan';
            $kodeTransaksi = $pesananAktif->kode_booking;
            $statusPesanan = $pesananAktif->status ?? 'baru';

            $waktuPesanan = $pesananAktif->jadwal_service ?? $pesananAktif->created_at;
            $carbonWaktu = $waktuPesanan ? \Carbon\Carbon::parse($waktuPesanan)->locale('id') : null;
            $tanggalWaktuTransaksi = $carbonWaktu ? $carbonWaktu->translatedFormat('j F Y, H:i') . ' WITA' : '-';

            if ($statusPesanan === 'selesai') {
                $statusCircleClass = 'done';
                $statusHeadline = $isLayananView ? 'Servis kendaraan selesai' : 'Pesanan sudah diantar';
                $statusSubtext = $isLayananView
                    ? 'Terima kasih telah mempercayakan servis di Hunter Garage.'
                    : 'Terima kasih telah berbelanja suku cadang di Hunter Garage.';
            } elseif ($statusPesanan === 'proses') {
                $statusCircleClass = 'waiting';
                $statusHeadline = $isLayananView ? 'Jadwal servis dikonfirmasi' : 'Pesanan sedang disiapkan';
                $statusSubtext = $isLayananView
                    ? 'Silakan datang ke bengkel sesuai jadwal kunjungan Anda.'
                    : 'Pesanan Anda sedang disiapkan untuk diantar ke alamat Anda.';
            } elseif ($statusPesanan === 'dibatalkan') {
                $statusCircleClass = 'rejected';
                $statusHeadline = $isLayananView ? 'Booking servis ditolak' : 'Pesanan ditolak';
                $statusSubtext = 'Mohon maaf, pesanan ini tidak dapat diproses oleh bengkel.';
            } else {
                $statusCircleClass = 'waiting';
                $statusHeadline = $isLayananView ? 'Booking berhasil dikirim' : 'Pembayaran berhasil dicatat';
                $statusSubtext = 'Pesanan sudah masuk dan menunggu konfirmasi admin bengkel.';
            }

            $step2State = in_array($statusPesanan, ['proses', 'selesai'], true) ? 'done' : 'active';
            $step3State = $statusPesanan === 'selesai' ? 'done' : ($statusPesanan === 'proses' ? 'active' : '');
        @endphp
        <div class="confirm-page-wrap">
            <main class="gojek-receipt-shell">
                {{-- Card 1: Status & Progress Tracker --}}
                <section class="gojek-card" aria-label="Status Pesanan">
                    <div class="gojek-status-head">
                        <div class="gojek-status-left">
                            <div class="gojek-status-circle {{ $statusCircleClass }}" aria-hidden="true">
                                @if ($statusPesanan === 'dibatalkan')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                @elseif ($statusPesanan === 'selesai')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <h1 class="gojek-status-title">{{ $statusHeadline }}</h1>
                                <p class="gojek-status-sub">{{ $statusSubtext }}</p>
                            </div>
                        </div>

                        <div class="gojek-code-pill">
                            <span id="bookingCodeValue">{{ $kodeTransaksi }}</span>
                            <button type="button" class="gojek-copy-btn" onclick="copyBookingCode()" title="Salin Kode">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    @if ($statusPesanan === 'dibatalkan')
                        <div class="gojek-rejected-bar">
                            Status: Ditolak — Silakan buat pesanan atau booking baru melalui katalog jika diperlukan.
                        </div>
                    @else
                        <div class="gojek-tracker" aria-label="Progres Pesanan">
                            <div class="gojek-step done">
                                <div class="gojek-step-dot">&#10003;</div>
                                <span class="gojek-step-label">{{ $isLayananView ? 'Booking Masuk' : 'Pesanan Masuk' }}</span>
                            </div>
                            <div class="gojek-step {{ $step2State }}">
                                <div class="gojek-step-dot">{{ $step2State === 'done' ? '✓' : '2' }}</div>
                                <span class="gojek-step-label">{{ $isLayananView ? 'Dikonfirmasi' : 'Disiapkan' }}</span>
                            </div>
                            <div class="gojek-step {{ $step3State }}">
                                <div class="gojek-step-dot">{{ $step3State === 'done' ? '✓' : '3' }}</div>
                                <span class="gojek-step-label">{{ $isLayananView ? 'Servis Selesai' : 'Sudah Diantar' }}</span>
                            </div>
                        </div>
                    @endif
                </section>

                {{-- Card 2: Struk & Rincian Pesanan --}}
                <section class="gojek-card" aria-label="Struk Detail Pesanan">
                    <div class="gojek-merchant-row">
                        <div class="gojek-merchant-left">
                            <img src="{{ asset('images/logo.png') }}" alt="Hunter Garage" class="gojek-merchant-logo">
                            <div>
                                <h2 class="gojek-merchant-name">Hunter Garage</h2>
                                <p class="gojek-merchant-addr">Jl. Taruna Praja Banjarbaru</p>
                            </div>
                        </div>
                        <span class="gojek-type-tag">{{ $isLayananView ? 'Booking Servis' : 'Diantar ke Alamat' }}</span>
                    </div>

                    <div class="gojek-receipt-divider"></div>

                    <div class="gojek-section">
                        <h3 class="gojek-section-title">{{ $isLayananView ? 'Rincian Servis & Kendaraan' : 'Rincian Produk' }}</h3>

                        @if ($isLayananView)
                            @php
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
                                $tanggalBooking = $carbonWaktu ? $carbonWaktu->translatedFormat('j F Y') : '-';
                                $jamBooking = $carbonWaktu ? ($carbonWaktu->format('H.i') . ' WITA') : '-';
                            @endphp
                            <div class="gojek-kv-list">
                                <div class="gojek-kv-row"><span class="gojek-kv-key">Layanan</span><span class="gojek-kv-val">{{ $pesananAktif->nama_layanan ?? '-' }}</span></div>
                                <div class="gojek-kv-row"><span class="gojek-kv-key">Kendaraan</span><span class="gojek-kv-val">{{ $namaKendaraan }} ({{ $tahunKendaraan }})</span></div>
                                <div class="gojek-kv-row"><span class="gojek-kv-key">Plat Nomor</span><span class="gojek-kv-val">{{ $platNomor }}</span></div>
                                <div class="gojek-kv-row"><span class="gojek-kv-key">Jadwal Kunjungan</span><span class="gojek-kv-val">{{ $tanggalBooking }}, {{ $jamBooking }}</span></div>
                            </div>
                        @else
                            @php
                                $detailDeskripsi = ($pesananAktif->produk)
                                    ? ($pesananAktif->produk->deskripsi ?: ($pesananAktif->produk->kategori ?: 'Suku Cadang Resmi'))
                                    : 'Suku Cadang Resmi';
                            @endphp
                            <div class="gojek-item-list">
                                @if ($pesananAktif->details && $pesananAktif->details->isNotEmpty())
                                    @foreach ($pesananAktif->details as $detailItem)
                                        @php
                                            $produkDetailRef = $detailItem->produk;
                                            $ketDetail = $produkDetailRef
                                                ? ($produkDetailRef->deskripsi ?: ($produkDetailRef->kategori ?: 'Suku Cadang Resmi'))
                                                : $detailDeskripsi;
                                        @endphp
                                        <div class="gojek-item-row">
                                            <div class="gojek-item-left">
                                                <span class="gojek-qty-badge">{{ $detailItem->qty }}x</span>
                                                <div>
                                                    <div class="gojek-item-name">{{ $detailItem->nama_item }}</div>
                                                    <div class="gojek-item-sub">{{ $ketDetail }}</div>
                                                </div>
                                            </div>
                                            <span class="gojek-item-price">Rp {{ number_format($detailItem->subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="gojek-item-row">
                                        <div class="gojek-item-left">
                                            <span class="gojek-qty-badge">1x</span>
                                            <div>
                                                <div class="gojek-item-name">{{ $pesananAktif->nama_layanan ?? '-' }}</div>
                                                <div class="gojek-item-sub">{{ $detailDeskripsi }}</div>
                                            </div>
                                        </div>
                                        <span class="gojek-item-price">Rp {{ number_format($pesananAktif->total_harga, 0, ',', '.') }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="gojek-receipt-divider"></div>

                    <div class="gojek-section">
                        <h3 class="gojek-section-title">Detail Transaksi</h3>
                        <div class="gojek-kv-list">
                            <div class="gojek-kv-row"><span class="gojek-kv-key">Nama Pelanggan</span><span class="gojek-kv-val">{{ $pesananAktif->nama_pelanggan ?: Auth::user()->name }}</span></div>
                            @if ($pesananAktif->no_telepon)
                                <div class="gojek-kv-row"><span class="gojek-kv-key">Nomor WhatsApp</span><span class="gojek-kv-val">{{ $pesananAktif->no_telepon }}</span></div>
                            @endif
                            @if (!$isLayananView && $pesananAktif->alamat)
                                <div class="gojek-kv-row"><span class="gojek-kv-key">Alamat</span><span class="gojek-kv-val">{{ $pesananAktif->alamat }}</span></div>
                            @endif
                            @if (!$isLayananView && ($pesananAktif->ongkir ?? 0) > 0)
                                <div class="gojek-kv-row"><span class="gojek-kv-key">Pengiriman</span><span class="gojek-kv-val">{{ ($pesananAktif->layanan_pengiriman ?? 'reguler') === 'express' ? 'Kilat (1 hari)' : 'Reguler (2–3 hari)' }}</span></div>
                                <div class="gojek-kv-row"><span class="gojek-kv-key">Ongkos Kirim</span><span class="gojek-kv-val">Rp {{ number_format((float) $pesananAktif->ongkir, 0, ',', '.') }}</span></div>
                            @endif
                            <div class="gojek-kv-row"><span class="gojek-kv-key">Waktu Transaksi</span><span class="gojek-kv-val">{{ $tanggalWaktuTransaksi }}</span></div>
                            <div class="gojek-kv-row"><span class="gojek-kv-key">Metode Pembayaran</span><span class="gojek-kv-val">{{ $isLayananView ? 'Bayar di Tempat / Transfer Bank BCA (Setelah Servis Selesai)' : 'Transfer Bank BCA' }}</span></div>
                        </div>
                    </div>

                    <div class="gojek-total-box">
                        <span class="gojek-total-label">Total Pembayaran</span>
                        <span class="gojek-total-amount">Rp {{ number_format($pesananAktif->total_harga, 0, ',', '.') }}</span>
                    </div>

                    <div class="gojek-actions-bar">
                        @if ($isLayananView)
                            <a href="{{ route('user.pesanan', ['tab' => 'jadwal']) }}" class="gojek-btn-primary">
                                Lihat Booking Saya
                            </a>
                        @else
                            <button type="button" class="gojek-btn-primary" style="border:none; cursor:pointer; font-family:inherit;" onclick="openUserBuktiModal()">
                                Lihat Bukti Pembayaran Saya
                            </button>
                            <a href="{{ route('user.pesanan') }}" class="gojek-btn-outline">Kembali</a>
                        @endif
                        <a href="{{ route('home') }}" class="gojek-btn-outline">Beranda</a>
                    </div>
                </section>
            </main>
        </div>

        @if (!$isLayananView)
            <!-- Modal Foto Bukti Pembayaran User -->
            <div id="userBuktiModal" style="position:fixed; inset:0; background:rgba(9,9,11,0.62); backdrop-filter:blur(4px); display:none; align-items:center; justify-content:center; padding:18px; z-index:9999;" onclick="if(event.target === this) closeUserBuktiModal();">
                <div role="dialog" aria-modal="true" aria-labelledby="userBuktiTitle" style="width:100%; max-width:500px; background:#ffffff; border-radius:20px; border:1px solid #e4e4e7; box-shadow:0 24px 54px rgba(0,0,0,0.28); overflow:hidden;">
                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 22px; border-bottom:1px solid #e4e4e7; background:#fafafa;">
                        <h3 id="userBuktiTitle" style="margin:0; font-size:16px; font-weight:800; color:#09090b;">Bukti Pembayaran Saya</h3>
                        <button type="button" onclick="closeUserBuktiModal()" aria-label="Tutup" style="width:32px; height:32px; border-radius:8px; border:1px solid #d4d4d8; background:#ffffff; color:#18181b; display:inline-flex; align-items:center; justify-content:center; cursor:pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div style="padding:20px 22px; text-align:center;">
                        @if ($pesananAktif->bukti_pembayaran_url)
                            <a href="{{ $pesananAktif->bukti_pembayaran_url }}" target="_blank" rel="noopener" style="display:inline-block; border:1px solid #e4e4e7; border-radius:12px; overflow:hidden; background:#fafafa;">
                                <img src="{{ $pesananAktif->bukti_pembayaran_url }}" alt="Bukti Pembayaran {{ $kodeTransaksi }}" style="max-width:100%; max-height:360px; display:block; object-fit:contain;">
                            </a>
                            <p style="margin:10px 0 0; font-size:12px; color:#71717a;">Klik gambar untuk membuka ukuran penuh di tab baru.</p>
                        @else
                            <div style="padding:18px; border-radius:12px; background:#fef2f2; border:1px solid #fecaca; color:#991b1b; font-size:13px; font-weight:600;">
                                Belum ada foto bukti pembayaran yang diunggah untuk pesanan ini.
                            </div>
                        @endif
                    </div>
                    <div style="padding:0 22px 20px; display:flex; justify-content:flex-end;">
                        <button type="button" onclick="closeUserBuktiModal()" class="gojek-btn-primary" style="flex:0 0 auto; min-width:120px; border:none; cursor:pointer; font-family:inherit;">Tutup</button>
                    </div>
                </div>
            </div>
        @endif
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
                                $kodeItem = $item->kode_booking;
                                $waktuItem = $item->jadwal_service ?? $item->created_at;
                                $tglFormat = $waktuItem ? \Carbon\Carbon::parse($waktuItem)->locale('id')->translatedFormat('d F Y, H:i') . ' WITA' : '-';

                                $st = $item->status ?? 'baru';
                                if ($st === 'selesai') {
                                    $filterGroup = 'selesai';
                                    $pillCls = 'done';
                                    $pillLbl = $katItem === 'produk' ? 'Sudah Diantar' : 'Sudah Selesai';
                                } elseif ($st === 'dibatalkan') {
                                    $filterGroup = 'ditolak';
                                    $pillCls = 'rejected';
                                    $pillLbl = 'Ditolak';
                                } elseif ($st === 'proses') {
                                    $filterGroup = 'konfirmasi';
                                    $pillCls = 'waiting';
                                    $pillLbl = 'Sedang Diproses';
                                } else {
                                    $filterGroup = 'konfirmasi';
                                    $pillCls = 'waiting';
                                    $pillLbl = 'Menunggu Konfirmasi';
                                }

                                $jadwalSvc = $item->jadwalService;
                                $infoKendaraanCard = ($jadwalSvc && ($jadwalSvc->tipe_kendaraan || $jadwalSvc->no_plat_kendaraan))
                                    ? trim(($jadwalSvc->tipe_kendaraan ?? '') . ($jadwalSvc->no_plat_kendaraan ? ' • ' . $jadwalSvc->no_plat_kendaraan : ''))
                                    : null;
                                $labelWaktu = $katItem === 'layanan' ? 'Jadwal Servis' : 'Waktu Transaksi';
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
                                    <div class="user-order-item-meta-group">
                                        <span class="user-order-item-meta">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            {{ $labelWaktu }}: {{ $tglFormat }}
                                        </span>
                                        @if ($katItem === 'layanan' && $infoKendaraanCard)
                                            <span class="user-order-item-meta">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                                </svg>
                                                {{ $infoKendaraanCard }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="user-order-item-right">
                                    <div class="user-order-price-box">
                                        <span class="user-order-price-label">Total Pembayaran</span>
                                        <strong class="user-order-item-price">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong>
                                    </div>
                                    <div class="user-order-item-actions">
                                        <a href="{{ route('user.pesanan', ['detail' => $item->id]) }}" class="btn-order-detail">Lihat Detail</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Empty State Sesuai Desain Figma -->
                    <div class="orders-empty-state" id="ordersEmptyState" style="display:none;">
                        <svg class="orders-empty-illustration" width="170" height="170" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
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
                        <p class="orders-empty-desc" id="ordersEmptyDesc">
                            {{ $activeSidebarTab === 'jadwal' ? 'Jadwal booking servis kendaraan kamu akan muncul di sini setelah dikirim.' : 'Pesanan suku cadang dan produk bengkel kamu akan muncul di sini.' }}
                        </p>
                        <a href="{{ $activeSidebarTab === 'jadwal' ? route('user.layanan') : route('user.produk') }}" class="orders-empty-cta" id="ordersEmptyCta">
                            {{ $activeSidebarTab === 'jadwal' ? 'Booking Servis Sekarang' : 'Belanja Produk Sekarang' }}
                        </a>
                    </div>
                </div>
            </main>
        </div>
    @endif

    <script>
        function openUserBuktiModal() {
            const modal = document.getElementById('userBuktiModal');
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeUserBuktiModal() {
            const modal = document.getElementById('userBuktiModal');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

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
            const emptyDesc = document.getElementById('ordersEmptyDesc');
            const emptyCta = document.getElementById('ordersEmptyCta');
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
                if (emptyDesc) {
                    if (currentMenu === 'jadwal') {
                        emptyDesc.textContent = currentStatus === 'ditolak'
                            ? 'Booking servis yang ditolak oleh admin akan tampil di sini.'
                            : (currentStatus === 'selesai'
                                ? 'Riwayat booking servis kendaraan yang telah selesai akan tampil di sini.'
                                : 'Jadwal booking servis kendaraan kamu akan muncul di sini setelah dikirim.');
                    } else {
                        emptyDesc.textContent = currentStatus === 'ditolak'
                            ? 'Pesanan produk yang ditolak atau dibatalkan akan tampil di sini.'
                            : (currentStatus === 'selesai'
                                ? 'Pesanan suku cadang yang sudah diantar akan tampil di sini.'
                                : 'Pesanan suku cadang dan produk bengkel kamu akan muncul di sini.');
                    }
                }
                if (emptyCta) {
                    if (currentMenu === 'jadwal') {
                        emptyCta.href = @js(route('user.layanan'));
                        emptyCta.textContent = 'Booking Servis Sekarang';
                    } else {
                        emptyCta.href = @js(route('user.produk'));
                        emptyCta.textContent = 'Belanja Produk Sekarang';
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
