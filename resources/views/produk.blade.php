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
            padding: 6px 26px;
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
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
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

        .catalog-grid:not(.is-expanded) .catalog-card.is-extra-card {
            display: none;
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
            margin-top: auto;
            padding-top: 10px;
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
        .catalog-card-actions {
            margin-top: 14px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        .catalog-add-outline-btn {
            width: 100%;
            height: 36px;
            border: 1.5px solid #111111;
            border-radius: 9px;
            background-color: #ffffff;
            color: #111111;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background-color 0.16s ease, transform 0.16s ease;
        }
        .catalog-add-outline-btn:hover {
            background-color: #f4f4f5;
            transform: translateY(-1px);
        }
        .catalog-buy-btn {
            width: 100%;
            height: 36px;
            border: none;
            border-radius: 9px;
            background-color: #111111;
            color: #ffffff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background-color 0.16s ease, transform 0.16s ease;
        }
        .catalog-buy-btn:hover {
            background-color: #27272a;
            transform: translateY(-1px);
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
            max-height: calc(100vh - 40px);
            max-height: calc(100dvh - 40px);
            overflow-y: auto;
            overscroll-behavior: contain;
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
            max-height: 260px;
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
        .cart-address-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }
        .cart-address-label {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .cart-fill-address-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background-color: #ffffff;
            color: #111827;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            padding: 5px 11px;
            font-size: 12px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: background-color 0.15s ease, border-color 0.15s ease;
        }
        .cart-fill-address-btn:hover {
            background-color: #f3f4f6;
            border-color: #111111;
        }
        .cart-address-feedback {
            font-size: 11.5px;
            color: #6b7280;
            display: none;
        }
        .cart-address-feedback.is-error {
            color: #b91c1c;
        }
        .cart-address-feedback.is-success {
            color: #15803d;
        }
        .cart-shipping-box {
            margin: 14px 28px 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .cart-shipping-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .cart-shipping-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1.5px solid #d1d5db;
            background-color: #f9fafb;
            cursor: pointer;
            transition: border-color 0.15s ease, background-color 0.15s ease;
        }
        .cart-shipping-option:has(input:checked) {
            border-color: #111111;
            background-color: #ffffff;
        }
        .cart-shipping-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cart-shipping-left input[type="radio"] {
            accent-color: #111111;
            margin: 0;
        }
        .cart-shipping-name {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            display: block;
        }
        .cart-shipping-eta {
            font-size: 11.5px;
            color: #6b7280;
            display: block;
        }
        .cart-shipping-price {
            font-size: 13px;
            font-weight: 800;
            color: #111827;
            white-space: nowrap;
        }
        .cart-summary-breakdown {
            display: flex;
            flex-direction: column;
            gap: 3px;
            margin-bottom: 4px;
            font-size: 12px;
            color: #4b5563;
        }
        .cart-summary-breakdown span {
            display: flex;
            justify-content: space-between;
            gap: 16px;
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
        .cart-proof-box {
            margin: 14px 28px 0;
            padding: 14px 16px;
            background-color: #fafafa;
            border: 1px dashed #d4d4d8;
            border-radius: 12px;
        }
        .cart-proof-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }
        .cart-proof-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .cart-proof-thumb {
            width: 56px;
            height: 56px;
            border-radius: 10px;
            background-color: #ffffff;
            border: 1px solid #e4e4e7;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            color: #71717a;
        }
        .cart-proof-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .cart-proof-input {
            width: 100%;
            font-family: inherit;
            font-size: 12.5px;
            color: #18181b;
        }
        .cart-proof-help {
            font-size: 11.5px;
            color: #71717a;
            margin-top: 4px;
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
        /* Pop-up Setelah Bayar Ala Gojek */
        .gojek-popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(9, 9, 11, 0.62);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 18px;
        }
        .gojek-popup-overlay.active {
            display: flex;
        }
        .gojek-popup-card {
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            background-color: #ffffff;
            border-radius: 22px;
            border: 1px solid #e4e4e7;
            box-shadow: 0 24px 54px rgba(0, 0, 0, 0.28);
            animation: gojekPopIn 0.24s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes gojekPopIn {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .gojek-pop-head {
            padding: 24px 26px 18px;
            text-align: center;
            border-bottom: 1px solid #f4f4f5;
        }
        .gojek-pop-check {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: #dcfce7;
            color: #16a34a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }
        .gojek-pop-title {
            font-size: 20px;
            font-weight: 800;
            color: #09090b;
            margin: 0 0 4px;
        }
        .gojek-pop-sub {
            font-size: 13px;
            color: #52525b;
            margin: 0 0 12px;
        }
        .gojek-pop-code {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #f4f4f5;
            border: 1px solid #e4e4e7;
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 800;
            color: #09090b;
        }
        .gojek-pop-tracker {
            padding: 16px 24px;
            background-color: #fafafa;
            border-bottom: 1px solid #f4f4f5;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
        }
        .gojek-pop-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
        }
        .gojek-pop-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 13px;
            left: calc(50% + 16px);
            right: calc(-50% + 16px);
            height: 2.5px;
            background-color: #e4e4e7;
        }
        .gojek-pop-step.done:not(:last-child)::after {
            background-color: #16a34a;
        }
        .gojek-pop-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #e4e4e7;
            color: #71717a;
            font-size: 12px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 6px;
            position: relative;
            z-index: 1;
        }
        .gojek-pop-step.done .gojek-pop-dot {
            background-color: #16a34a;
            color: #ffffff;
        }
        .gojek-pop-step.active .gojek-pop-dot {
            background-color: #111111;
            color: #ffffff;
        }
        .gojek-pop-step-lbl {
            font-size: 11.5px;
            font-weight: 700;
            color: #71717a;
        }
        .gojek-pop-step.done .gojek-pop-step-lbl,
        .gojek-pop-step.active .gojek-pop-step-lbl {
            color: #09090b;
        }
        .gojek-pop-body {
            padding: 18px 26px;
        }
        .gojek-pop-items {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-bottom: 14px;
            border-bottom: 1.5px dashed #d4d4d8;
            margin-bottom: 14px;
        }
        .gojek-pop-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            font-size: 13px;
        }
        .gojek-pop-item-left {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #09090b;
            font-weight: 700;
        }
        .gojek-pop-qty {
            background-color: #f4f4f5;
            border: 1px solid #e4e4e7;
            border-radius: 6px;
            padding: 2px 7px;
            font-size: 11.5px;
            font-weight: 800;
        }
        .gojek-pop-meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 12.5px;
        }
        .gojek-pop-meta-row {
            display: flex;
            justify-content: space-between;
            gap: 14px;
        }
        .gojek-pop-meta-row span { color: #71717a; }
        .gojek-pop-meta-row strong { color: #09090b; text-align: right; }
        .gojek-pop-total {
            margin: 0 26px 18px;
            padding: 14px 18px;
            border-radius: 12px;
            background-color: #f4f4f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .gojek-pop-total span { font-size: 13.5px; font-weight: 700; color: #18181b; }
        .gojek-pop-total strong { font-size: 19px; font-weight: 800; color: #09090b; }
        .gojek-pop-actions {
            padding: 0 26px 24px;
            display: flex;
            gap: 10px;
        }
        .gojek-pop-btn-primary {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            border-radius: 999px;
            background-color: #111111;
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
        }
        .gojek-pop-btn-primary:hover { background-color: #27272a; }
        .gojek-pop-btn-close {
            padding: 11px 20px;
            border-radius: 999px;
            border: 1.5px solid #d4d4d8;
            background-color: #ffffff;
            color: #09090b;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
        }
        .gojek-pop-btn-close:hover { background-color: #f4f4f5; }
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

        /* Modal Notifikasi Login Terlebih Dahulu (Untuk Guest) */
        .guest-login-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(9, 9, 11, 0.6);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 1200;
        }
        .guest-login-overlay.active {
            display: flex;
        }
        .guest-login-card {
            width: 100%;
            max-width: 420px;
            background-color: #ffffff;
            border-radius: 18px;
            border: 1px solid #e4e4e7;
            padding: 28px 26px 24px;
            text-align: center;
            box-shadow: 0 24px 50px -12px rgba(0, 0, 0, 0.3);
            animation: guestModalPop 0.2s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes guestModalPop {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(8px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        .guest-login-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background-color: #18181b;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }
        .guest-login-title {
            margin: 0 0 8px;
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }
        .guest-login-desc {
            margin: 0 0 22px;
            font-size: 13.5px;
            line-height: 1.55;
            color: #52525b;
        }
        .guest-login-actions {
            display: flex;
            gap: 10px;
        }
        .guest-login-cancel {
            flex: 1;
            height: 42px;
            border-radius: 10px;
            border: 1.5px solid #d4d4d8;
            background-color: #ffffff;
            color: #18181b;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.16s ease;
        }
        .guest-login-cancel:hover {
            background-color: #f4f4f5;
        }
        .guest-login-submit {
            flex: 1;
            height: 42px;
            border-radius: 10px;
            border: none;
            background-color: #111111;
            color: #ffffff;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.16s ease;
        }
        .guest-login-submit:hover {
            background-color: #27272a;
        }
        .guest-login-register {
            display: inline-block;
            margin-top: 14px;
            font-size: 12.5px;
            font-weight: 600;
            color: #52525b;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .guest-login-register:hover {
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
                <li class="topbar-perk-item">
                    <!-- Lock / Secure Payment Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>Pembayaran Aman &amp; Mudah</span>
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
                    <button type="button" class="topbar-cart-btn" onclick="openGuestLoginModal('keranjang')">Keranjang</button>
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
                        <h2 id="sectionKomponenTitle" class="catalog-section-title">Produk Tersedia</h2>
                        @if ($produkAktif->count() > 8)
                            <button type="button" class="catalog-see-all" id="toggleKomponenBtn" onclick="toggleSemuaKomponen()" aria-expanded="false">
                                Lihat Semua &rarr;
                            </button>
                        @endif
                    </div>

                    <div class="catalog-grid" id="komponenCatalogGrid">
                        @foreach ($produkAktif as $produk)
                            @php
                                $stokProduk = (int) ($produk->stok ?? 0);
                                $stokHabis = $stokProduk <= 0;
                                $deskripsiProduk = $produk->deskripsi ?: ($produk->kategori ?: 'Suku Cadang Resmi');
                            @endphp
                            <article class="catalog-card {{ $loop->index >= 8 ? 'is-extra-card' : '' }}" data-search="{{ strtolower($produk->nama_produk . ' ' . $deskripsiProduk) }}">
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
                                        <span>{{ $stokHabis ? 'Stok Habis' : 'Stok: ' . $stokProduk . ' Pcs' }}</span>
                                    </div>
                                    <strong class="catalog-price">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</strong>
                                    @auth
                                        @if ($stokHabis)
                                            <button type="button" class="catalog-add-btn" disabled>Stok Habis</button>
                                        @else
                                            <div class="catalog-card-actions">
                                                <button
                                                    type="button"
                                                    class="catalog-add-outline-btn"
                                                    onclick="addToCart({{ $produk->id }}, @js($produk->nama_produk), @js($deskripsiProduk), {{ (float) $produk->harga_jual }}, {{ $stokProduk }}, @js($produk->gambar_url))"
                                                >
                                                    + Keranjang
                                                </button>
                                                <button
                                                    type="button"
                                                    class="catalog-buy-btn"
                                                    onclick="buyNowProduk({{ $produk->id }}, @js($produk->nama_produk), @js($deskripsiProduk), {{ (float) $produk->harga_jual }}, {{ $stokProduk }}, @js($produk->gambar_url))"
                                                >
                                                    Beli Langsung
                                                </button>
                                            </div>
                                        @endif
                                    @else
                                        <div class="catalog-card-actions">
                                            <button type="button" class="catalog-add-outline-btn" onclick="openGuestLoginModal('keranjang')">+ Keranjang</button>
                                            <button type="button" class="catalog-buy-btn" onclick="openGuestLoginModal('beli')">Beli Langsung</button>
                                        </div>
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
                        @foreach ($produkAktif->take(4) as $produk)
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
                                        <span>{{ $stokHabis ? 'Stok Habis' : 'Stok: ' . $stokProduk . ' Pcs' }}</span>
                                    </div>
                                    <strong class="catalog-price">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</strong>
                                    @auth
                                        @if ($stokHabis)
                                            <button type="button" class="catalog-add-btn" disabled>Stok Habis</button>
                                        @else
                                            <div class="catalog-card-actions">
                                                <button
                                                    type="button"
                                                    class="catalog-add-outline-btn"
                                                    onclick="addToCart({{ $produk->id }}, @js($produk->nama_produk), @js($deskripsiProduk), {{ (float) $produk->harga_jual }}, {{ $stokProduk }}, @js($produk->gambar_url))"
                                                >
                                                    + Keranjang
                                                </button>
                                                <button
                                                    type="button"
                                                    class="catalog-buy-btn"
                                                    onclick="buyNowProduk({{ $produk->id }}, @js($produk->nama_produk), @js($deskripsiProduk), {{ (float) $produk->harga_jual }}, {{ $stokProduk }}, @js($produk->gambar_url))"
                                                >
                                                    Beli Langsung
                                                </button>
                                            </div>
                                        @endif
                                    @else
                                        <div class="catalog-card-actions">
                                            <button type="button" class="catalog-add-outline-btn" onclick="openGuestLoginModal('keranjang')">+ Keranjang</button>
                                            <button type="button" class="catalog-buy-btn" onclick="openGuestLoginModal('beli')">Beli Langsung</button>
                                        </div>
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

    @guest
        <div class="guest-login-overlay" id="guestLoginModal" aria-hidden="true" onclick="if (event.target === this) closeGuestLoginModal();">
            <div class="guest-login-card" role="dialog" aria-modal="true" aria-labelledby="guestLoginTitle">
                <div class="guest-login-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h2 id="guestLoginTitle" class="guest-login-title">Login Terlebih Dahulu</h2>
                <p id="guestLoginDesc" class="guest-login-desc">
                    Silakan masuk ke akun Hunter Garage Anda terlebih dahulu untuk menambahkan produk ke keranjang atau melakukan pembelian.
                </p>
                <div class="guest-login-actions">
                    <button type="button" class="guest-login-cancel" onclick="closeGuestLoginModal()">Nanti Saja</button>
                    <a href="{{ route('login') }}" class="guest-login-submit">Masuk Sekarang</a>
                </div>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="guest-login-register">Belum punya akun? Daftar sekarang</a>
                @endif
            </div>
        </div>
    @endguest

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

                <form method="POST" action="{{ route('user.pesanan.store') }}" id="produkOrderForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kategori" value="produk">
                    <input type="hidden" name="metode_pembayaran" value="Transfer Bank BCA">
                    <input type="hidden" name="cart_items" id="modalCartItemsInput" value="">
                    <input type="hidden" name="jadwal_service" id="modalJadwalService" value="">

                    <!-- Daftar Item di Keranjang -->
                    <div class="cart-items-list" id="cartItemsList"></div>

                    <!-- Input Alamat Pengiriman Pembeli -->
                    <div class="cart-address-box">
                        <div class="cart-address-header">
                            <label for="inputAlamatPembeli" class="cart-address-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                Alamat Pengiriman
                            </label>
                            @auth
                                <button
                                    type="button"
                                    id="btnIsiAlamatSaya"
                                    class="cart-fill-address-btn"
                                    data-user-alamat="{{ auth()->user()->alamat ?? '' }}"
                                    onclick="isiDenganAlamatSaya()"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    Isi dengan alamat saya
                                </button>
                            @endauth
                        </div>
                        <textarea
                            id="inputAlamatPembeli"
                            name="alamat"
                            class="cart-address-input"
                            placeholder="Masukkan alamat lengkap pengiriman (Nama jalan, No. rumah, Kecamatan, Kota)..."
                            required
                        >{{ old('alamat', auth()->user()->alamat ?? '') }}</textarea>
                        <div id="alamatSayaFeedback" class="cart-address-feedback"></div>
                    </div>

                    <!-- Layanan Pengiriman & Ongkir -->
                    <div class="cart-shipping-box">
                        <span class="cart-address-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                            Layanan Pengiriman
                        </span>
                        <div class="cart-shipping-grid">
                            <label class="cart-shipping-option">
                                <span class="cart-shipping-left">
                                    <input type="radio" name="layanan_pengiriman" value="reguler" data-ongkir="15000" checked onchange="tampilkanIsiModalKeranjang()">
                                    <span>
                                        <span class="cart-shipping-name">Reguler</span>
                                        <span class="cart-shipping-eta">Estimasi 2–3 hari</span>
                                    </span>
                                </span>
                                <span class="cart-shipping-price">Rp 15.000</span>
                            </label>
                            <label class="cart-shipping-option">
                                <span class="cart-shipping-left">
                                    <input type="radio" name="layanan_pengiriman" value="express" data-ongkir="30000" onchange="tampilkanIsiModalKeranjang()">
                                    <span>
                                        <span class="cart-shipping-name">Kilat</span>
                                        <span class="cart-shipping-eta">Estimasi 1 hari</span>
                                    </span>
                                </span>
                                <span class="cart-shipping-price">Rp 30.000</span>
                            </label>
                        </div>
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

                    <!-- Upload Bukti Pembayaran / Transfer -->
                    <div class="cart-proof-box">
                        <label for="inputBuktiPembayaran" class="cart-proof-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            Bukti Pembayaran / Transfer (Wajib)
                        </label>
                        <div class="cart-proof-row">
                            <div class="cart-proof-thumb">
                                <img id="buktiPreviewImg" src="" alt="Pratinjau Bukti Transfer" style="display:none;">
                                <svg id="buktiPreviewIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                            <div style="flex:1;">
                                <input type="file" id="inputBuktiPembayaran" name="bukti_pembayaran" class="cart-proof-input" accept="image/*" required>
                                <div class="cart-proof-help">Unggah foto/tangkapan layar bukti transfer BCA (JPG, PNG, WEBP, maks. 10MB). Dicek admin sebelum diproses.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Keranjang: Total Pembayaran & Tombol Batalkan / Bayar -->
                    <div class="cart-footer-bar">
                        <div class="cart-footer-total">
                            <div class="cart-summary-breakdown">
                                <span>Harga Produk: <strong id="cartSubtotalPriceText">Rp 0</strong></span>
                                <span>Ongkir (<span id="cartShippingLabelText">Reguler</span>): <strong id="cartOngkirPriceText">Rp 15.000</strong></span>
                            </div>
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

        <!-- Pop-up Setelah Bayar Ala Gojek -->
        <div class="gojek-popup-overlay" id="gojekPaymentSuccessModal" aria-hidden="true">
            <div class="gojek-popup-card" role="dialog" aria-modal="true" aria-labelledby="gojekPopTitle">
                <div class="gojek-pop-head">
                    <div class="gojek-pop-check" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <h2 id="gojekPopTitle" class="gojek-pop-title">Pembayaran Berhasil Dikirim!</h2>
                    <p class="gojek-pop-sub">Bukti pembayaran Anda sedang menunggu verifikasi admin bengkel.</p>
                    <span class="gojek-pop-code" id="gojekPopKode">PSN-0000</span>
                </div>

                <div class="gojek-pop-tracker">
                    <div class="gojek-pop-step done">
                        <div class="gojek-pop-dot">&#10003;</div>
                        <span class="gojek-pop-step-lbl">Pesanan Masuk</span>
                    </div>
                    <div class="gojek-pop-step active">
                        <div class="gojek-pop-dot">2</div>
                        <span class="gojek-pop-step-lbl">Verifikasi Admin</span>
                    </div>
                    <div class="gojek-pop-step">
                        <div class="gojek-pop-dot">3</div>
                        <span class="gojek-pop-step-lbl">Siap Diantar</span>
                    </div>
                </div>

                <div class="gojek-pop-body">
                    <div class="gojek-pop-items" id="gojekPopItems"></div>
                    <div class="gojek-pop-meta">
                        <div class="gojek-pop-meta-row"><span>Bengkel</span><strong>Hunter Garage • Diantar ke Alamat</strong></div>
                        <div class="gojek-pop-meta-row"><span>Alamat Pembeli</span><strong id="gojekPopAlamat">-</strong></div>
                        <div class="gojek-pop-meta-row"><span>Pengiriman</span><strong id="gojekPopPengiriman">-</strong></div>
                        <div class="gojek-pop-meta-row"><span>Ongkos Kirim</span><strong id="gojekPopOngkir">Rp 0</strong></div>
                        <div class="gojek-pop-meta-row"><span>Waktu Transaksi</span><strong id="gojekPopWaktu">-</strong></div>
                        <div class="gojek-pop-meta-row"><span>Metode Pembayaran</span><strong>Transfer Bank BCA</strong></div>
                    </div>
                </div>

                <div class="gojek-pop-total">
                    <span>Total Pembayaran</span>
                    <strong id="gojekPopTotal">Rp 0</strong>
                </div>

                <div class="gojek-pop-actions">
                    <a href="{{ route('user.pesanan') }}" class="gojek-pop-btn-primary" id="gojekPopLihatPesanan">Lihat Detail Pesanan</a>
                    <button type="button" class="gojek-pop-btn-close" onclick="closeGojekPaymentPopup()">Tutup</button>
                </div>
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
        let checkoutMode = 'cart';
        let directCheckoutItem = null;
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

        // Dipanggil saat tombol "Beli Langsung" pada kartu produk diklik
        function buyNowProduk(id, nama, deskripsi, harga, stokMaks, gambarUrl) {
            if (stokMaks <= 0) {
                alert('Stok produk ini sedang habis.');
                return;
            }
            checkoutMode = 'direct';
            directCheckoutItem = {
                id: Number(id),
                nama: nama,
                deskripsi: deskripsi || '',
                harga: Number(harga),
                stok: Number(stokMaks),
                gambar_url: gambarUrl || null,
                qty: 1
            };

            const modal = document.getElementById('produkOrderModal');
            if (!modal) return;
            const toast = document.getElementById('cartToast');
            if (toast) toast.classList.remove('show');

            tampilkanIsiModalKeranjang();
            modal.classList.add('active');
        }

        // Dipanggil saat tombol (+) atau (-) di dalam modal keranjang diklik
        function updateCartItemQty(id, perubahan) {
            const listAktif = checkoutMode === 'direct' && directCheckoutItem ? [directCheckoutItem] : keranjang;
            const item = listAktif.find(function (i) {
                return i.id === Number(id);
            });
            if (!item) return;

            const jumlahBaru = item.qty + perubahan;

            if (jumlahBaru <= 0) {
                if (checkoutMode === 'direct') {
                    closeProdukOrderModal();
                    return;
                }
                // Kalau dikurangi sampai 0, hapus produk dari keranjang
                removeCartItem(id);
                return;
            }

            if (jumlahBaru > item.stok) {
                alert('Stok maksimal untuk produk ini adalah ' + item.stok + ' Pcs.');
                return;
            }

            item.qty = jumlahBaru;
            if (checkoutMode === 'cart') {
                simpanKeranjang();
            }
            tampilkanIsiModalKeranjang();
        }

        // Hapus 1 produk dari modal keranjang (ikon tempat sampah)
        function removeCartItem(id) {
            if (checkoutMode === 'direct') {
                directCheckoutItem = null;
                closeProdukOrderModal();
                return;
            }
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

            checkoutMode = 'cart';

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
            if (checkoutMode === 'direct') {
                directCheckoutItem = null;
                checkoutMode = 'cart';
            }
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

        // Gambar daftar barang ke dalam HTML modal keranjang / checkout langsung
        function tampilkanIsiModalKeranjang() {
            const wadahList = document.getElementById('cartItemsList');
            const pesanKosong = document.getElementById('cartEmptyState');
            const formKeranjang = document.getElementById('produkOrderForm');
            const btnHapusSemua = document.getElementById('btnClearAllCart');
            const modalTitleEl = document.getElementById('produkModalTitle');
            const teksTotalHarga = document.getElementById('cartTotalPriceText');
            const inputHiddenItems = document.getElementById('modalCartItemsInput');

            if (!wadahList || !pesanKosong || !formKeranjang) return;

            const isDirect = checkoutMode === 'direct' && directCheckoutItem !== null;
            const itemsUntukCheckout = isDirect ? [directCheckoutItem] : keranjang;

            if (modalTitleEl) {
                modalTitleEl.textContent = isDirect ? 'Beli Langsung' : 'Keranjang';
            }

            // Jika kosong, tampilkan pesan kosong & sembunyikan form
            if (itemsUntukCheckout.length === 0) {
                pesanKosong.style.display = 'block';
                formKeranjang.style.display = 'none';
                if (btnHapusSemua) btnHapusSemua.style.display = 'none';
                wadahList.innerHTML = '';
                return;
            }

            // Jika ada isinya, tampilkan form & tombol Hapus Semua (hanya untuk mode keranjang)
            pesanKosong.style.display = 'none';
            formKeranjang.style.display = 'block';
            if (btnHapusSemua) btnHapusSemua.style.display = isDirect ? 'none' : '';

            let totalHarga = 0;
            let htmlDaftarBarang = '';

            itemsUntukCheckout.forEach(function (item) {
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
            const selectedShipping = document.querySelector('input[name="layanan_pengiriman"]:checked');
            const ongkir = selectedShipping ? Number(selectedShipping.dataset.ongkir || 15000) : 15000;
            const shippingLabel = selectedShipping && selectedShipping.value === 'express' ? 'Kilat' : 'Reguler';

            const teksSubtotalHarga = document.getElementById('cartSubtotalPriceText');
            const teksOngkirHarga = document.getElementById('cartOngkirPriceText');
            const teksShippingLabel = document.getElementById('cartShippingLabelText');
            if (teksSubtotalHarga) teksSubtotalHarga.textContent = formatRupiah(totalHarga);
            if (teksOngkirHarga) teksOngkirHarga.textContent = formatRupiah(ongkir);
            if (teksShippingLabel) teksShippingLabel.textContent = shippingLabel;
            if (teksTotalHarga) teksTotalHarga.textContent = formatRupiah(totalHarga + ongkir);

            // Isi input hidden dengan data JSON [{id, qty}] untuk dikirim ke Controller
            if (inputHiddenItems) {
                const dataUntukBackend = itemsUntukCheckout.map(function (item) {
                    return { id: item.id, qty: item.qty };
                });
                inputHiddenItems.value = JSON.stringify(dataUntukBackend);
            }
        }

        function showGojekPaymentPopup(data) {
            const modal = document.getElementById('gojekPaymentSuccessModal');
            if (!modal) return;

            const kodeEl = document.getElementById('gojekPopKode');
            const itemsEl = document.getElementById('gojekPopItems');
            const alamatEl = document.getElementById('gojekPopAlamat');
            const pengirimanEl = document.getElementById('gojekPopPengiriman');
            const ongkirEl = document.getElementById('gojekPopOngkir');
            const waktuEl = document.getElementById('gojekPopWaktu');
            const totalEl = document.getElementById('gojekPopTotal');
            const linkEl = document.getElementById('gojekPopLihatPesanan');

            if (kodeEl) kodeEl.textContent = data.kode_pesanan || '-';
            if (alamatEl) alamatEl.textContent = data.alamat || '-';
            if (pengirimanEl) {
                const kurir = data.layanan_pengiriman === 'express' ? 'Kilat (1 hari)' : 'Reguler (2–3 hari)';
                pengirimanEl.textContent = kurir;
            }
            if (ongkirEl) ongkirEl.textContent = formatRupiah(data.ongkir || 0);
            if (waktuEl) waktuEl.textContent = data.waktu_transaksi || '-';
            if (totalEl) totalEl.textContent = formatRupiah(data.total_harga || 0);
            if (linkEl && (data.redirect_detail_url || data.redirect_pesanan_url)) {
                linkEl.href = data.redirect_detail_url || data.redirect_pesanan_url;
            }

            if (itemsEl) {
                const rows = (data.items || []).map(function (item) {
                    return `
                        <div class="gojek-pop-item-row">
                            <div class="gojek-pop-item-left">
                                <span class="gojek-pop-qty">${item.qty}x</span>
                                <span>${item.nama_item}</span>
                            </div>
                            <span>${formatRupiah(item.subtotal)}</span>
                        </div>
                    `;
                });
                itemsEl.innerHTML = rows.join('');
            }

            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
        }

        function closeGojekPaymentPopup() {
            const modal = document.getElementById('gojekPaymentSuccessModal');
            if (!modal) return;
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
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

            // Preview foto bukti pembayaran di modal keranjang
            const inputBuktiPembayaran = document.getElementById('inputBuktiPembayaran');
            const buktiPreviewImg = document.getElementById('buktiPreviewImg');
            const buktiPreviewIcon = document.getElementById('buktiPreviewIcon');
            if (inputBuktiPembayaran) {
                inputBuktiPembayaran.addEventListener('change', function () {
                    const file = this.files && this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (ev) {
                            if (buktiPreviewImg) {
                                buktiPreviewImg.src = ev.target.result;
                                buktiPreviewImg.style.display = 'block';
                            }
                            if (buktiPreviewIcon) buktiPreviewIcon.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        if (buktiPreviewImg) {
                            buktiPreviewImg.src = '';
                            buktiPreviewImg.style.display = 'none';
                        }
                        if (buktiPreviewIcon) buktiPreviewIcon.style.display = 'block';
                    }
                });
            }

            // 3. Saat tombol "Bayar" di modal keranjang disubmit -> kirim via AJAX & tampilkan Pop-Up ala Gojek
            const orderForm = document.getElementById('produkOrderForm');
            const btnCheckoutSubmit = document.getElementById('btnCheckoutSubmit');
            if (orderForm) {
                orderForm.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    const isDirectCheckout = checkoutMode === 'direct' && directCheckoutItem !== null;
                    if (!isDirectCheckout && keranjang.length === 0) {
                        alert('Keranjang belanja masih kosong.');
                        return;
                    }

                    // Isi waktu pemesanan otomatis (jam operasional 08:00 - 21:30)
                    const sekarang = new Date();
                    const tanggal = sekarang.toISOString().slice(0, 10);
                    document.getElementById('modalJadwalService').value = tanggal + ' 10:00:00';

                    if (btnCheckoutSubmit) {
                        btnCheckoutSubmit.disabled = true;
                        btnCheckoutSubmit.textContent = 'Memproses...';
                    }

                    try {
                        const formData = new FormData(orderForm);
                        const response = await fetch(orderForm.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            body: formData,
                        });

                        const result = await response.json();
                        if (!response.ok || !result.ok) {
                            const msg = result.message || (result.errors ? Object.values(result.errors).flat().join('\n') : 'Gagal memproses pesanan.');
                            alert(msg);
                            return;
                        }

                        // Bersihkan keranjang/item langsung & reset input bukti transfer setelah berhasil
                        if (isDirectCheckout) {
                            directCheckoutItem = null;
                            checkoutMode = 'cart';
                        } else {
                            keranjang = [];
                            simpanKeranjang();
                        }
                        sessionStorage.setItem('hg_produk_completed', '1');
                        const buktiInput = document.getElementById('inputBuktiPembayaran');
                        const buktiPreview = document.getElementById('buktiPreviewImg');
                        const buktiIcon = document.getElementById('buktiPreviewIcon');
                        if (buktiInput) buktiInput.value = '';
                        if (buktiPreview) { buktiPreview.src = ''; buktiPreview.style.display = 'none'; }
                        if (buktiIcon) buktiIcon.style.display = 'block';
                        closeProdukOrderModal();
                        showGojekPaymentPopup(result);
                    } catch (err) {
                        alert('Terjadi kesalahan jaringan saat memproses pembayaran. Silakan coba lagi.');
                    } finally {
                        if (btnCheckoutSubmit) {
                            btnCheckoutSubmit.disabled = false;
                            btnCheckoutSubmit.textContent = 'Bayar';
                        }
                    }
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

                            if (kataKunci === '') {
                                card.style.display = '';
                            } else {
                                card.style.display = cocok ? 'flex' : 'none';
                            }

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

            const navEntriesProduk = window.performance && performance.getEntriesByType
                ? performance.getEntriesByType('navigation')
                : [];
            const isProdukBack = navEntriesProduk.length > 0 && navEntriesProduk[0].type === 'back_forward';
            if (sessionStorage.getItem('hg_produk_completed') === '1' && isProdukBack) {
                sessionStorage.removeItem('hg_produk_completed');
                closeProdukOrderModal();
                closeGojekPaymentPopup();
                keranjang = [];
                simpanKeranjang();
            }
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted && sessionStorage.getItem('hg_produk_completed') === '1') {
                sessionStorage.removeItem('hg_produk_completed');
                closeProdukOrderModal();
                closeGojekPaymentPopup();
                keranjang = [];
                simpanKeranjang();
            }
        });

        function openGuestLoginModal(aksi) {
            const modal = document.getElementById('guestLoginModal');
            const desc = document.getElementById('guestLoginDesc');
            if (!modal) return;

            if (desc) {
                desc.textContent = aksi === 'beli'
                    ? 'Silakan login terlebih dahulu ke akun Hunter Garage Anda untuk langsung membeli produk ini.'
                    : 'Silakan login terlebih dahulu ke akun Hunter Garage Anda untuk menambahkan atau melihat produk di keranjang.';
            }

            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
        }

        function closeGuestLoginModal() {
            const modal = document.getElementById('guestLoginModal');
            if (!modal) return;
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeGuestLoginModal();
            }
        });

        function toggleSemuaKomponen() {
            const grid = document.getElementById('komponenCatalogGrid');
            const btn = document.getElementById('toggleKomponenBtn');
            if (!grid || !btn) return;

            const isExpanded = grid.classList.toggle('is-expanded');
            btn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            btn.innerHTML = isExpanded ? 'Minimize &uarr;' : 'Lihat Semua &rarr;';
        }

        function isiDenganAlamatSaya() {
            const btn = document.getElementById('btnIsiAlamatSaya');
            const inputAlamat = document.getElementById('inputAlamatPembeli');
            const feedback = document.getElementById('alamatSayaFeedback');
            if (!btn || !inputAlamat) return;

            const alamatAkun = (btn.getAttribute('data-user-alamat') || '').trim();
            if (!alamatAkun) {
                if (feedback) {
                    feedback.textContent = 'Alamat di akun Anda belum tersimpan. Silakan isi manual.';
                    feedback.className = 'cart-address-feedback is-error';
                    feedback.style.display = 'block';
                }
                inputAlamat.focus();
                return;
            }

            inputAlamat.value = alamatAkun;
            inputAlamat.focus();
            if (feedback) {
                feedback.textContent = 'Alamat berhasil diisi dari data akun Anda.';
                feedback.className = 'cart-address-feedback is-success';
                feedback.style.display = 'block';
            }
        }
    </script>
    <x-login-success-toast />
    <x-rating-reminder-toast />
</body>
</html>
