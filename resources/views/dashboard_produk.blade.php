<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Produk - Hunter Garage</title>
    @vite('resources/css/dashboard.css')

    <style>

        .controls-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 28px;
            margin-bottom: 18px;
            gap: 16px;
            flex-wrap: wrap;
        }
        .controls-left {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }
        .toggle-container {
            display: inline-flex;
            align-items: center;
            background-color: #ffffff;
            border-radius: 9999px;
            padding: 0;
            gap: 0;
            margin-top: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }
        .toggle-btn {
            background-color: transparent;
            border: none;
            color: #52525b;
            padding: 10px 24px;
            border-radius: 9999px;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            transition: background-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease;
        }
        .toggle-btn.active {
            background-color: #000000;
            color: #ffffff;
            border-radius: 9999px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }
        .search-box-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
        }
        .search-box-wrapper svg {
            position: absolute;
            left: 14px;
            width: 16px;
            height: 16px;
            color: #64748b;
            pointer-events: none;
        }
        .search-input {
            padding: 10px 16px 10px 38px;
            width: 240px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            font-size: 13.5px;
            color: #18181b;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        .search-input:focus {
            outline: none;
            border-color: #000000;
        }
        .btn-add-primary {
            background-color: #000000;
            color: #ffffff;
            border: 1.5px solid #000000;
            padding: 11px 22px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 700;
            letter-spacing: -0.01em;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.22);
        }
        .btn-add-primary:hover {
            transform: translateY(-1px);
        }
        .catalog-card-header {
            padding: 20px 28px 16px;
            border-bottom: 1.5px solid #e4e4e7;
            background-color: #ffffff;
        }
        .catalog-card-title {
            font-size: 18px;
            font-weight: 800;
            color: #09090b;
        }
        .catalog-card-subtitle {
            font-size: 13px;
            color: #71717a;
            margin-top: 3px;
        }
        .catalog-card thead th:first-child,
        .catalog-card tbody td:first-child {
            padding-left: 28px;
        }
        .catalog-card thead th:last-child,
        .catalog-card tbody td:last-child {
            padding-right: 28px;
            text-align: center;
        }
        .catalog-card thead th.th-status,
        .catalog-card tbody td.td-status {
            text-align: center;
        }
        .badge-status-aktif {
            display: inline-block;
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            font-size: 11.5px;
            font-weight: 800;
            padding: 5px 18px;
            border-radius: 9999px;
        }
        .badge-status-menipis {
            display: inline-block;
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
            font-size: 11.5px;
            font-weight: 800;
            padding: 5px 18px;
            border-radius: 9999px;
        }
        .badge-status-nonaktif {
            display: inline-block;
            background-color: #f4f4f5;
            color: #52525b;
            border: 1px solid #e4e4e7;
            font-size: 11.5px;
            font-weight: 800;
            padding: 5px 18px;
            border-radius: 9999px;
        }
        .produk-cell-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .produk-thumb-box {
            width: 64px;
            height: 46px;
            border-radius: 6px;
            background-color: #d4d4d8;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            border: 1px solid #e4e4e7;
        }
        .produk-thumb-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }
        .produk-thumb-placeholder {
            color: #71717a;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .produk-meta {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .produk-name-text {
            font-size: 14px;
            font-weight: 800;
            color: #09090b;
            line-height: 1.25;
        }
        .produk-code-text {
            font-size: 13px;
            font-weight: 700;
            color: #71717a;
            line-height: 1.2;
        }
        .deskripsi-text {
            font-size: 15px;
            font-weight: 700;
            color: #09090b;
        }
        .stok-cell-wrap {
            display: flex;
            flex-direction: column;
            gap: 2px;
            line-height: 1.25;
        }
        .stok-qty-text {
            font-size: 14px;
            font-weight: 800;
            color: #09090b;
        }
        .stok-status-aman {
            font-size: 13px;
            font-weight: 800;
            color: #16a34a;
        }
        .stok-status-menipis {
            font-size: 13px;
            font-weight: 800;
            color: #f59e0b;
        }
        .stok-status-habis {
            font-size: 13px;
            font-weight: 800;
            color: #881337;
        }
        .harga-text {
            font-size: 14.5px;
            font-weight: 800;
            color: #09090b;
        }
        .table-pagination-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .pagination-summary {
            font-size: 13.5px;
            font-weight: 700;
            color: #52525b;
        }
        .foto-upload-box {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .foto-preview-box {
            width: 72px;
            height: 54px;
            border-radius: 10px;
            background-color: #f4f4f5;
            border: 1px dashed #a1a1aa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }
        .foto-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .foto-input-help {
            font-size: 11.5px;
            color: #71717a;
            margin-top: 4px;
        }
        .action-btns {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-pill-edit {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: #ffffff;
            color: #000000;
            border: 1.5px solid #000000;
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .btn-pill-edit:hover {
            background-color: #f4f4f5;
        }
        .btn-pill-delete {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background-color: #ffffff;
            color: #ef4444;
            border: 1.5px solid #ef4444;
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .btn-pill-delete:hover {
            background-color: #fef2f2;
        }
        .catalog-card-footer {
            height: 28px;
        }
        .alert-success {
            margin-top: 16px;
            padding: 12px 16px;
            border-radius: 10px;
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            font-size: 14px;
            font-weight: 600;
        }
        .alert-error {
            margin-top: 16px;
            padding: 12px 16px;
            border-radius: 10px;
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            font-size: 14px;
            font-weight: 600;
        }
        /* Modal Form */
        .crud-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(9, 9, 11, 0.6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9998;
            padding: 16px;
        }
        .crud-modal-overlay.active {
            display: flex;
        }
        .crud-modal-card {
            background: #ffffff;
            width: 100%;
            max-width: 460px;
            border-radius: 18px;
            padding: 26px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.22);
        }
        .crud-modal-title {
            font-size: 18px;
            font-weight: 800;
            color: #09090b;
            margin-bottom: 18px;
        }
        .form-group {
            margin-bottom: 14px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #27272a;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d4d4d8;
            border-radius: 10px;
            font-size: 14px;
            color: #09090b;
        }
        .form-control:focus {
            outline: 2px solid #000000;
            border-color: #000000;
        }
        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .crud-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 22px;
        }
        .btn-cancel-crud {
            background: #f1f5f9;
            color: #1e293b;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-save-crud {
            background: #000000;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="layout-container">

        <!-- ================= SIDEBAR ================= -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="logo-link">
                    <div class="logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Hunter Garage" class="logo-img">
                    </div>
                </a>
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <div class="brand-title">Hunter Garage</div>
                    <div class="brand-subtitle">Platform Bisnis</div>
                </a>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'inactive' }}">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
  <rect x="4" y="4" width="7" height="7" rx="1.5"/>
  <rect x="13" y="4" width="7" height="7" rx="1.5"/>
  <rect x="4" y="13" width="7" height="7" rx="1.5"/>
  <rect x="13" y="13" width="7" height="7" rx="1.5"/>
</svg>
</span> Dasbor
                </a>
                <a href="{{ route('dashboard.pesanan') }}" class="nav-link {{ request()->routeIs('dashboard.pesanan') ? 'active' : 'inactive' }}">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <rect x="7" y="5" width="10" height="16" rx="2"/>
  <path d="M9 5V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
  <line x1="10" y1="10" x2="14" y2="10"/>
  <line x1="10" y1="14" x2="14" y2="14"/>
</svg>
</span> Pesanan
                </a>
                <a href="{{ route('dashboard.layanan') }}" class="nav-link {{ request()->routeIs('dashboard.layanan') ? 'active' : 'inactive' }}">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
</svg>
</span> Layanan
                </a>
                <a href="{{ route('dashboard.produk') }}" class="nav-link {{ request()->routeIs('dashboard.produk') ? 'active' : 'inactive' }}">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
  <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
  <line x1="12" y1="22.08" x2="12" y2="12"/>
</svg>
</span> Produk
                </a>
                <a href="{{ route('dashboard.riwayat') }}" class="nav-link {{ request()->routeIs('dashboard.riwayat') ? 'active' : 'inactive' }}">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <line x1="8" y1="5" x2="20" y2="5"/>
  <line x1="8" y1="9" x2="20" y2="9"/>
  <line x1="16" y1="13" x2="20" y2="13"/>
  <line x1="16" y1="17" x2="20" y2="17"/>
  <line x1="16" y1="21" x2="20" y2="21"/>
  <path d="M12 17a4 4 0 1 1-4-4h4"/>
  <polyline points="8 9 5 13 8 17"/>
</svg>
</span> Riwayat
                </a>
                <a href="{{ route('dashboard.users') }}" class="nav-link {{ request()->routeIs('dashboard.users') ? 'active' : 'inactive' }}">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
  <circle cx="9" cy="7" r="4"/>
  <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
</svg>
</span> Pengguna
                </a>
            </nav>
        </aside>

        <!-- ================= MAIN CONTENT ================= -->
        <main class="main-content">
            
            <!-- Top Header -->
            <header class="header-top">
                <div>
                    <h2 class="page-title">Data Produk</h2>
                    <p class="page-subtitle">Pantau data produk dan stok suku cadang motor</p>
                </div>
                
                <x-admin-dropdown />
            </header>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <div class="controls-bar">
                <div class="controls-left">
                    <div class="toggle-container">
                        <button type="button" class="toggle-btn active" data-status-tab="aktif" aria-pressed="true">Aktif</button>
                        <button type="button" class="toggle-btn" data-status-tab="nonaktif" aria-pressed="false">Nonaktif</button>
                    </div>
                    <div class="search-box-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="searchInput" class="search-input" placeholder="Cari Produk...">
                    </div>
                </div>
                <button type="button" class="btn-add-primary" onclick="openCreateModal()">Tambah Produk</button>
            </div>

            <div class="catalog-card">
                <div class="catalog-card-header">
                    <div class="catalog-card-title">Daftar Produk</div>
                    <div class="catalog-card-subtitle">Daftar suku cadang & produk bengkel beserta stok tersedia</div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Deskripsi</th>
                                <th>Jumlah stok</th>
                                <th>Harga jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="produkTableBody">
                            @forelse ($daftarProduk ?? [] as $produk)
                                @php
                                    $statusRow = $produk->status ?? 'aktif';
                                    $deskripsiTampil = $produk->deskripsi ?: ($produk->kategori ?: '-');
                                    $stokProduk = (int) ($produk->stok ?? 0);
                                    $gambarUrl = $produk->gambar_url;
                                @endphp
                                <tr class="produk-row" data-status="{{ $statusRow }}">
                                    <td>
                                        <div class="produk-cell-wrap">
                                            <div class="produk-thumb-box">
                                                @if ($gambarUrl)
                                                    <img src="{{ $gambarUrl }}" alt="{{ $produk->nama_produk }}">
                                                @else
                                                    <span class="produk-thumb-placeholder" aria-hidden="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                                            <polyline points="21 15 16 10 5 21"/>
                                                        </svg>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="produk-meta">
                                                <span class="produk-name-text">{{ $produk->nama_produk }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="deskripsi-text">{{ $deskripsiTampil }}</span>
                                    </td>
                                    <td>
                                        <div class="stok-cell-wrap">
                                            <span class="stok-qty-text">{{ $stokProduk }} Pcs</span>
                                            @if ($stokProduk <= 0)
                                                <span class="stok-status-habis">Habis</span>
                                            @elseif ($stokProduk < 5)
                                                <span class="stok-status-menipis">Menipis</span>
                                            @else
                                                <span class="stok-status-aman">Aman</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="harga-text">{{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <button
                                                type="button"
                                                class="btn-pill-edit"
                                                onclick="openEditModal({{ json_encode([
                                                    'id' => $produk->id,
                                                    'nama_produk' => $produk->nama_produk,
                                                    'deskripsi' => $deskripsiTampil === '-' ? '' : $deskripsiTampil,
                                                    'gambar_url' => $gambarUrl,
                                                    'stok' => $stokProduk,
                                                    'status' => $statusRow,
                                                    'harga_jual' => (float) $produk->harga_jual,
                                                    'update_url' => route('dashboard.produk.update', $produk->id),
                                                ]) }})"
                                            >
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 20h9"/>
                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                </svg>
                                                Edit
                                            </button>

                                            <button
                                                type="button"
                                                class="btn-pill-delete"
                                                onclick="openDeleteConfirmModal({{ json_encode(route('dashboard.produk.destroy', $produk->id)) }}, 'Konfirmasi Hapus Produk', {{ json_encode('Apakah Anda yakin ingin menghapus produk "' . $produk->nama_produk . '"? Tindakan ini tidak dapat dibatalkan.') }})"
                                            >
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyServerRow">
                                    <td colspan="5" class="empty-state-cell">
                                        <div class="empty-state-box">
                                            <div class="empty-state-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                    <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                                                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                                                </svg>
                                            </div>
                                            <div class="empty-state-title">Belum Ada Data Produk</div>
                                            <div class="empty-state-sub">Klik tombol "Tambah Produk" di kanan atas untuk menambahkan suku cadang baru.</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="emptyFilterRow" style="display:none;">
                                <td colspan="5" class="empty-state-cell">
                                    <div class="empty-state-box">
                                        <div class="empty-state-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            </svg>
                                        </div>
                                        <div class="empty-state-title">Produk Tidak Ditemukan</div>
                                        <div class="empty-state-sub">Tidak ada data produk pada status atau kata kunci pencarian ini.</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-pagination-footer">
                    <div class="pagination-summary" id="paginationSummary">Menampilkan 0 dari 0 Produk</div>
                    <div class="pagination-controls" id="paginationControls"></div>
                </div>
            </div>

        </main>
    </div>

    <!-- Modal Tambah / Edit Produk -->
    <div id="crudProdukModal" class="crud-modal-overlay" aria-hidden="true">
        <div class="crud-modal-card">
            <h3 id="crudModalTitle" class="crud-modal-title">Tambah Produk</h3>
            <form id="crudProdukForm" method="POST" action="{{ route('dashboard.produk.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="crudFormMethod" value="POST">

                <div class="form-group">
                    <label for="inputGambar">Foto Produk</label>
                    <div class="foto-upload-box">
                        <div class="foto-preview-box" id="fotoPreviewBox">
                            <img id="fotoPreviewImg" src="" alt="Preview Foto" style="display:none;">
                            <svg id="fotoPreviewIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#71717a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                        <div style="flex:1;">
                            <input type="file" id="inputGambar" name="gambar" class="form-control" accept="image/*">
                            <div class="foto-input-help">Format JPG, PNG, WEBP, JFIF, AVIF (maks. 20MB)</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputNamaProduk">Nama Produk</label>
                    <input type="text" id="inputNamaProduk" name="nama_produk" class="form-control" placeholder="Contoh: Aki GS Astra" required>
                </div>

                <div class="form-group">
                    <label for="inputDeskripsi">Deskripsi / Kategori</label>
                    <input type="text" id="inputDeskripsi" name="deskripsi" class="form-control" placeholder="Contoh: Aki, Pengereman, Pembakaran" required>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="inputStok">Jumlah Stok (Pcs)</label>
                        <input type="number" id="inputStok" name="stok" class="form-control" min="0" value="10" required>
                    </div>

                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="inputStatus" name="status" class="form-control" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputHargaJual">Harga Jual (Rp)</label>
                    <input type="text" inputmode="numeric" id="inputHargaJual" name="harga_jual" class="form-control" placeholder="Contoh: 295.000" autocomplete="off" required>
                </div>

                <div class="crud-modal-actions">
                    <button type="submit" class="btn-save-crud">Simpan</button>
                    <button type="button" class="btn-cancel-crud" onclick="closeCrudModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const statusTabButtons = document.querySelectorAll('[data-status-tab]');
        const searchInput = document.getElementById('searchInput');
        const produkTableBody = document.getElementById('produkTableBody');
        const produkRows = Array.from(document.querySelectorAll('.produk-row'));
        const emptyFilterRow = document.getElementById('emptyFilterRow');
        const emptyServerRow = document.getElementById('emptyServerRow');
        const paginationControls = document.getElementById('paginationControls');
        const paginationSummary = document.getElementById('paginationSummary');
        const ITEMS_PER_PAGE = 6;
        let activeStatus = 'aktif';
        let currentPage = 1;

        function syncFillerRows(visibleCount, colCount) {
            if (!produkTableBody) return;
            produkTableBody.querySelectorAll('.filler-row').forEach((r) => r.remove());

            if (visibleCount > 0 && visibleCount < ITEMS_PER_PAGE) {
                const missing = ITEMS_PER_PAGE - visibleCount;
                for (let i = 0; i < missing; i++) {
                    const tr = document.createElement('tr');
                    tr.className = 'filler-row';
                    let cells = '';
                    for (let c = 0; c < colCount; c++) {
                        cells += `<td><span class="slot-dash"></span></td>`;
                    }
                    tr.innerHTML = cells;
                    produkTableBody.appendChild(tr);
                }
            }
        }

        function renderPagination(totalItems, totalPages, startItem, endItem) {
            if (paginationSummary) {
                if (totalItems === 0) {
                    paginationSummary.textContent = 'Menampilkan 0 dari 0 Produk';
                } else {
                    paginationSummary.textContent = `Menampilkan ${startItem}-${endItem} dari ${totalItems} Produk`;
                }
            }

            if (!paginationControls) return;

            if (totalItems === 0) {
                paginationControls.innerHTML = `
                    <button type="button" class="page-btn" disabled>&lt; Sebelumnya</button>
                    <button type="button" class="page-btn active">1</button>
                    <button type="button" class="page-btn" disabled>Selanjutnya &gt;</button>
                `;
                return;
            }

            let buttonsHtml = `
                <button type="button" class="page-btn" ${currentPage === 1 ? 'disabled' : ''} data-page="${currentPage - 1}">&lt; Sebelumnya</button>
            `;

            for (let i = 1; i <= totalPages; i++) {
                buttonsHtml += `
                    <button type="button" class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>
                `;
            }

            buttonsHtml += `
                <button type="button" class="page-btn" ${currentPage === totalPages ? 'disabled' : ''} data-page="${currentPage + 1}">Selanjutnya &gt;</button>
            `;

            paginationControls.innerHTML = buttonsHtml;

            paginationControls.querySelectorAll('.page-btn[data-page]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const targetPage = Number(btn.dataset.page);
                    if (targetPage >= 1 && targetPage <= totalPages && targetPage !== currentPage) {
                        currentPage = targetPage;
                        filterProduk(false);
                    }
                });
            });
        }

        function filterProduk(resetPage = true) {
            if (resetPage) currentPage = 1;

            if (emptyServerRow) {
                syncFillerRows(0, 5);
                renderPagination(0, 1, 0, 0);
                return;
            }

            const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
            const matchedRows = produkRows.filter((row) => {
                const rowStatus = row.dataset.status || 'aktif';
                return rowStatus === activeStatus && row.textContent.toLowerCase().includes(query);
            });

            const totalItems = matchedRows.length;
            const totalPages = Math.max(1, Math.ceil(totalItems / ITEMS_PER_PAGE));
            if (currentPage > totalPages) currentPage = totalPages;

            produkRows.forEach((row) => {
                row.style.display = 'none';
            });

            const startIdx = (currentPage - 1) * ITEMS_PER_PAGE;
            const pageRows = matchedRows.slice(startIdx, startIdx + ITEMS_PER_PAGE);
            pageRows.forEach((row) => {
                row.style.display = '';
            });

            if (emptyFilterRow) {
                emptyFilterRow.style.display = totalItems === 0 ? '' : 'none';
            }

            const startItem = totalItems === 0 ? 0 : startIdx + 1;
            const endItem = totalItems === 0 ? 0 : startIdx + pageRows.length;

            syncFillerRows(pageRows.length, 5);
            renderPagination(totalItems, totalPages, startItem, endItem);
        }

        statusTabButtons.forEach((button) => {
            button.addEventListener('click', () => {
                if (activeStatus === button.dataset.statusTab) return;
                activeStatus = button.dataset.statusTab;

                statusTabButtons.forEach((tabButton) => {
                    const isActive = tabButton === button;
                    tabButton.classList.toggle('active', isActive);
                    tabButton.setAttribute('aria-pressed', String(isActive));
                });

                filterProduk(true);
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', () => filterProduk(true));
        }

        filterProduk(true);

        // Modal Logic
        const crudModal = document.getElementById('crudProdukModal');
        const crudForm = document.getElementById('crudProdukForm');
        const crudModalTitle = document.getElementById('crudModalTitle');
        const crudFormMethod = document.getElementById('crudFormMethod');
        const inputNamaProduk = document.getElementById('inputNamaProduk');
        const inputDeskripsi = document.getElementById('inputDeskripsi');
        const inputGambar = document.getElementById('inputGambar');
        const fotoPreviewImg = document.getElementById('fotoPreviewImg');
        const fotoPreviewIcon = document.getElementById('fotoPreviewIcon');
        const inputStok = document.getElementById('inputStok');
        const inputStatus = document.getElementById('inputStatus');
        const inputHargaJual = document.getElementById('inputHargaJual');

        function setFotoPreview(url) {
            if (url) {
                fotoPreviewImg.src = url;
                fotoPreviewImg.style.display = 'block';
                fotoPreviewIcon.style.display = 'none';
            } else {
                fotoPreviewImg.src = '';
                fotoPreviewImg.style.display = 'none';
                fotoPreviewIcon.style.display = 'block';
            }
        }

        if (inputGambar) {
            inputGambar.addEventListener('change', function () {
                const file = this.files && this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        setFotoPreview(e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    setFotoPreview(null);
                }
            });
        }

        function formatThousandDots(value) {
            const digits = String(value ?? '').replace(/\D/g, '');
            if (!digits) return '';
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        if (inputHargaJual) {
            inputHargaJual.addEventListener('input', function () {
                this.value = formatThousandDots(this.value);
            });
        }

        if (crudForm) {
            crudForm.addEventListener('submit', function () {
                if (inputHargaJual) {
                    inputHargaJual.value = inputHargaJual.value.replace(/\D/g, '');
                }
            });
        }

        function openCreateModal() {
            crudModalTitle.textContent = 'Tambah Produk';
            crudForm.action = "{{ route('dashboard.produk.store') }}";
            crudFormMethod.value = 'POST';
            inputNamaProduk.value = '';
            inputDeskripsi.value = '';
            if (inputGambar) inputGambar.value = '';
            setFotoPreview(null);
            inputStok.value = 10;
            inputStatus.value = activeStatus;
            inputHargaJual.value = '';
            crudModal.classList.add('active');
        }

        function openEditModal(data) {
            crudModalTitle.textContent = 'Edit Produk';
            crudForm.action = data.update_url;
            crudFormMethod.value = 'PUT';
            inputNamaProduk.value = data.nama_produk || '';
            inputDeskripsi.value = data.deskripsi || '';
            if (inputGambar) inputGambar.value = '';
            setFotoPreview(data.gambar_url || null);
            inputStok.value = data.stok ?? 0;
            inputStatus.value = data.status || 'aktif';
            inputHargaJual.value = formatThousandDots(Math.round(Number(data.harga_jual || 0)));
            crudModal.classList.add('active');
        }

        function closeCrudModal() {
            crudModal.classList.remove('active');
        }
    </script>

    <x-delete-confirm-modal />
    <x-logout-modal />
</body>
</html>
