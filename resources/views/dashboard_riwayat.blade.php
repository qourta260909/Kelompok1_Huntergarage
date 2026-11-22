<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pesanan - Hunter Garage</title>
    @vite('resources/css/dashboard.css')

    <style>
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            margin-bottom: 18px;
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
            color: #27272a;
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
        .header-container input[type="text"].search-input {
            margin-top: 0;
            padding: 10px 16px 10px 38px;
            width: 240px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            font-size: 13.5px;
            color: #18181b;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        .header-container input[type="text"].search-input::placeholder {
            color: #94a3b8;
        }
        .order-card thead th:first-child,
        .order-card tbody td:first-child {
            padding-left: 32px;
        }
        .order-card thead th:last-child,
        .order-card tbody td:last-child {
            padding-right: 32px;
            text-align: center !important;
            white-space: nowrap;
            width: 1%;
        }
        .badge-cancelled {
            background-color: #fef2f2;
            color: #dc2626;
        }
        .badge-proses {
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        .history-actions {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: nowrap;
        }
        .history-actions form {
            display: inline-flex;
            margin: 0;
        }
        .btn-finish {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 32px;
            white-space: nowrap;
            gap: 5px;
            background-color: #16a34a;
            color: #ffffff;
            border: 1.5px solid #16a34a;
            padding: 0 13px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .btn-finish:hover {
            background-color: #15803d;
            border-color: #15803d;
        }
        .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 32px;
            white-space: nowrap;
            gap: 5px;
            background-color: #ffffff;
            color: #ef4444;
            border: 1.5px solid #ef4444;
            padding: 0 13px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .btn-delete:hover {
            background-color: #fef2f2;
        }
        .btn-detail-admin {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 32px;
            white-space: nowrap;
            background-color: #f4f4f5;
            color: #18181b;
            border: 1.5px solid #d4d4d8;
            padding: 0 13px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .btn-detail-admin:hover {
            background-color: #e4e4e7;
            border-color: #a1a1aa;
        }
        .admin-detail-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(9, 9, 11, 0.55);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 1000;
        }
        .admin-detail-overlay.active {
            display: flex;
        }
        .admin-detail-modal {
            width: 100%;
            max-width: 560px;
            background-color: #ffffff;
            border-radius: 18px;
            border: 1px solid #e4e4e7;
            box-shadow: 0 24px 48px -12px rgba(0, 0, 0, 0.28);
            overflow: hidden;
        }
        .admin-detail-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            border-bottom: 1px solid #e4e4e7;
            background-color: #fafafa;
        }
        .admin-detail-title {
            font-size: 17px;
            font-weight: 800;
            color: #09090b;
            margin: 0;
        }
        .admin-detail-close {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: 1px solid #d4d4d8;
            background-color: #ffffff;
            color: #18181b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            line-height: 1;
            cursor: pointer;
            transition: background-color 0.16s ease, border-color 0.16s ease;
        }
        .admin-detail-close:hover {
            background-color: #f4f4f5;
            border-color: #a1a1aa;
        }
        .admin-detail-footer {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #e4e4e7;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }
        .admin-detail-body {
            padding: 20px 24px 24px;
            max-height: 75vh;
            overflow-y: auto;
        }
        .admin-info-grid {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 18px;
        }
        .admin-info-row {
            display: grid;
            grid-template-columns: 145px 1fr;
            gap: 12px;
            font-size: 13.5px;
            padding-bottom: 8px;
            border-bottom: 1px dashed #e4e4e7;
        }
        .admin-info-key {
            color: #71717a;
            font-weight: 600;
        }
        .admin-info-val {
            color: #09090b;
            font-weight: 700;
            word-break: break-word;
        }
        .admin-items-box {
            border: 1px solid #e4e4e7;
            border-radius: 12px;
            overflow: hidden;
            margin-top: 8px;
        }
        .admin-items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-items-table th {
            background-color: #f4f4f5;
            font-size: 12px;
            font-weight: 700;
            color: #3f3f46;
            padding: 10px 14px;
            text-align: left;
        }
        .admin-items-table td {
            font-size: 13px;
            font-weight: 600;
            color: #18181b;
            padding: 10px 14px;
            border-top: 1px solid #f4f4f5;
        }
        .cell-sub-meta {
            display: block;
            font-size: 11.5px;
            color: #64748b;
            font-weight: 500;
            margin-top: 2px;
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
        @keyframes tabSwitchFade {
            0% {
                opacity: 0;
                transform: translateY(8px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .tab-animating {
            animation: tabSwitchFade 0.26s cubic-bezier(0.16, 1, 0.3, 1);
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
                    <h2 class="page-title">Riwayat Pesanan</h2>
                    <p class="page-subtitle">Daftar pesanan yang telah diterima (selesai) atau ditolak.</p>
                </div>
                
                <x-admin-dropdown />
            </header>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="header-container">
                <div class="toggle-container">
                    <button type="button" class="toggle-btn active" data-history-tab="layanan" aria-pressed="true">Layanan</button>
                    <button type="button" class="toggle-btn" data-history-tab="produk" aria-pressed="false">Produk</button>
                </div>
                <div class="search-box-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari Riwayat...">
                </div>
            </div>

            <div class="order-card">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th id="historyCategoryHeading">Layanan</th>
                                <th id="historyExtraInfoHeading">Kendaraan</th>
                                <th>Tanggal &amp; Jam</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="historyTableBody">
                            @forelse ($daftarRiwayat ?? [] as $riwayat)
                                @php
                                    $kategoriRow = $riwayat->kategori ?? 'layanan';
                                    $prefixKode = $kategoriRow === 'produk' ? 'PSN-' : 'BKG-';
                                    $kodeBooking = $prefixKode . str_pad((string) $riwayat->id, 4, '0', STR_PAD_LEFT);
                                    $waktuService = $riwayat->jadwal_service ?? $riwayat->created_at;
                                    $carbonWaktu = $waktuService ? \Carbon\Carbon::parse($waktuService)->locale('id') : null;
                                    $tanggalJamFormat = $carbonWaktu
                                        ? strtolower($carbonWaktu->translatedFormat('d M Y')) . ', ' . $carbonWaktu->format('H:i')
                                        : '-';
                                    if ($riwayat->status === 'dibatalkan') {
                                        $badgeClass = 'badge-cancelled';
                                        $statusLabel = 'Ditolak';
                                    } elseif ($riwayat->status === 'proses') {
                                        $badgeClass = 'badge-proses';
                                        $statusLabel = 'Proses';
                                    } else {
                                        $badgeClass = 'badge-success';
                                        $statusLabel = $kategoriRow === 'produk' ? 'Sudah Diantar' : 'Sudah Selesai';
                                    }

                                    $jadwalSvc = $riwayat->jadwalService;
                                    $infoKendaraan = $jadwalSvc
                                        ? trim(($jadwalSvc->tipe_kendaraan ?? '') . ($jadwalSvc->no_plat_kendaraan ? ' (' . $jadwalSvc->no_plat_kendaraan . ')' : ''))
                                        : '-';
                                    $alamatAtauKendaraan = $kategoriRow === 'produk'
                                        ? ($riwayat->alamat ?: '-')
                                        : ($infoKendaraan ?: '-');

                                    $itemsPayload = [];
                                    if ($kategoriRow === 'produk' && $riwayat->details && $riwayat->details->isNotEmpty()) {
                                        foreach ($riwayat->details as $dt) {
                                            $itemsPayload[] = [
                                                'nama' => $dt->nama_item,
                                                'qty' => (int) $dt->qty,
                                                'harga' => 'Rp ' . number_format((float) $dt->harga, 0, ',', '.'),
                                                'subtotal' => 'Rp ' . number_format((float) $dt->subtotal, 0, ',', '.'),
                                            ];
                                        }
                                    } else {
                                        $itemsPayload[] = [
                                            'nama' => $riwayat->nama_layanan ?? '-',
                                            'qty' => 1,
                                            'harga' => 'Rp ' . number_format((float) $riwayat->total_harga, 0, ',', '.'),
                                            'subtotal' => 'Rp ' . number_format((float) $riwayat->total_harga, 0, ',', '.'),
                                        ];
                                    }

                                    $detailData = [
                                        'kode' => $kodeBooking,
                                        'kategori' => ucfirst($kategoriRow),
                                        'pelanggan' => $riwayat->nama_pelanggan_tampil ?? 'Pelanggan',
                                        'telepon' => $riwayat->no_telepon ?: '-',
                                        'alamat' => $riwayat->alamat ?: '-',
                                        'pengiriman' => $kategoriRow === 'produk'
                                            ? (($riwayat->layanan_pengiriman ?? 'reguler') === 'express' ? 'Express (1 hari)' : 'Reguler (2–3 hari)')
                                            : '-',
                                        'ongkir' => $kategoriRow === 'produk'
                                            ? 'Rp ' . number_format((float) ($riwayat->ongkir ?? 0), 0, ',', '.')
                                            : '-',
                                        'kendaraan' => $infoKendaraan ?: '-',
                                        'jadwal' => $tanggalJamFormat,
                                        'metode' => $kategoriRow === 'produk' ? 'Transfer Bank BCA' : 'Bayar di Tempat / Transfer Bank BCA (Setelah Selesai)',
                                        'total' => 'Rp ' . number_format((float) $riwayat->total_harga, 0, ',', '.'),
                                        'status' => $statusLabel,
                                        'bukti_url' => $riwayat->bukti_pembayaran_url,
                                        'pdf_url' => route('dashboard.pesanan.pdf', $riwayat->id),
                                        'items' => $itemsPayload,
                                    ];
                                @endphp
                                <tr class="history-row" data-kategori="{{ $kategoriRow }}">
                                    <td class="td-bold">{{ $kodeBooking }}</td>
                                    <td>
                                        {{ $riwayat->nama_pelanggan_tampil ?? 'Pelanggan' }}
                                        @if ($riwayat->no_telepon)
                                            <span class="cell-sub-meta">{{ $riwayat->no_telepon }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $riwayat->nama_layanan ?? '-' }}</td>
                                    <td>{{ $alamatAtauKendaraan }}</td>
                                    <td>{{ $tanggalJamFormat }}</td>
                                    <td class="td-bold">Rp {{ number_format($riwayat->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span>
                                    </td>
                                    <td>
                                        <div class="history-actions">
                                            <button type="button" class="btn-detail-admin" onclick='openAdminOrderDetail(@json($detailData))'>
                                                Detail
                                            </button>

                                            @if ($riwayat->status === 'proses')
                                                <form method="POST" action="{{ route('dashboard.pesanan.status', $riwayat->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="aksi" value="selesai">
                                                    <button type="submit" class="btn-finish">
                                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                        {{ $kategoriRow === 'produk' ? 'Sudah Diantar' : 'Sudah Selesai' }}
                                                    </button>
                                                </form>
                                            @endif

                                            <button
                                                type="button"
                                                class="btn-delete"
                                                onclick="openDeleteConfirmModal({{ json_encode(route('dashboard.pesanan.destroy', $riwayat->id)) }}, 'Konfirmasi Hapus Riwayat', {{ json_encode('Apakah Anda yakin ingin menghapus riwayat pesanan "' . $kodeBooking . '"? Tindakan ini tidak dapat dibatalkan.') }})"
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
                                    <td colspan="8" class="empty-state-cell">
                                        <div class="empty-state-box">
                                            <div class="empty-state-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                    <line x1="8" y1="5" x2="20" y2="5"/>
                                                    <line x1="8" y1="9" x2="20" y2="9"/>
                                                    <line x1="16" y1="13" x2="20" y2="13"/>
                                                    <path d="M12 17a4 4 0 1 1-4-4h4"/>
                                                    <polyline points="8 9 5 13 8 17"/>
                                                </svg>
                                            </div>
                                            <div class="empty-state-title">Belum Ada Riwayat Pesanan</div>
                                            <div class="empty-state-sub">Pesanan yang telah diterima (selesai) atau ditolak akan tersimpan di halaman ini.</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="emptyFilterRow" style="display:none;">
                                <td colspan="8" class="empty-state-cell">
                                    <div class="empty-state-box">
                                        <div class="empty-state-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            </svg>
                                        </div>
                                        <div class="empty-state-title">Riwayat Tidak Ditemukan</div>
                                        <div class="empty-state-sub">Tidak ada riwayat pesanan pada kategori atau kata kunci pencarian ini.</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-pagination-footer">
                    <div class="pagination-controls" id="paginationControls"></div>
                </div>
            </div>

        </main>
    </div>

    <script>
        const historyTabButtons = document.querySelectorAll('[data-history-tab]');
        const historyCategoryHeading = document.getElementById('historyCategoryHeading');
        const historyExtraInfoHeading = document.getElementById('historyExtraInfoHeading');
        const historyTableBody = document.getElementById('historyTableBody');
        const searchInput = document.getElementById('searchInput');
        const historyRows = Array.from(document.querySelectorAll('.history-row'));
        const emptyFilterRow = document.getElementById('emptyFilterRow');
        const emptyServerRow = document.getElementById('emptyServerRow');
        const paginationControls = document.getElementById('paginationControls');
        const ITEMS_PER_PAGE = 5;
        const urlTabParam = new URLSearchParams(window.location.search).get('tab');
        const sessionCategory = @js(session('active_category', session('last_order_tab')));
        const hasLayananRows = historyRows.some((row) => (row.dataset.kategori || 'layanan') === 'layanan');
        const hasProdukRows = historyRows.some((row) => (row.dataset.kategori || 'layanan') === 'produk');

        let activeCategory = 'layanan';
        if (urlTabParam === 'produk' || urlTabParam === 'layanan') {
            activeCategory = urlTabParam;
        } else if (sessionCategory === 'produk' || sessionCategory === 'layanan') {
            activeCategory = sessionCategory;
        } else if (!hasLayananRows && hasProdukRows) {
            activeCategory = 'produk';
        }
        let currentPage = 1;

        function syncHistoryTabHeadingAndButtons() {
            historyTabButtons.forEach((tabButton) => {
                const isActive = tabButton.dataset.historyTab === activeCategory;
                tabButton.classList.toggle('active', isActive);
                tabButton.setAttribute('aria-pressed', String(isActive));
            });
            if (historyCategoryHeading) {
                historyCategoryHeading.textContent = activeCategory === 'produk' ? 'Produk' : 'Layanan';
            }
            if (historyExtraInfoHeading) {
                historyExtraInfoHeading.textContent = activeCategory === 'produk' ? 'Alamat' : 'Kendaraan';
            }
        }
        syncHistoryTabHeadingAndButtons();

        function triggerTabAnimation() {
            [historyTableBody, historyCategoryHeading, historyExtraInfoHeading].forEach((el) => {
                if (!el) return;
                el.classList.remove('tab-animating');
                void el.offsetWidth;
                el.classList.add('tab-animating');
            });
        }

        function renderPagination(totalItems, totalPages) {
            if (!paginationControls) return;

            if (totalItems === 0) {
                paginationControls.innerHTML = `
                    <button type="button" class="page-btn" disabled>&lsaquo; Sebelumnya</button>
                    <button type="button" class="page-btn active">1</button>
                    <button type="button" class="page-btn" disabled>Berikutnya &rsaquo;</button>
                `;
                return;
            }

            let buttonsHtml = `
                <button type="button" class="page-btn" ${currentPage === 1 ? 'disabled' : ''} data-page="${currentPage - 1}">&lsaquo; Sebelumnya</button>
            `;

            for (let i = 1; i <= totalPages; i++) {
                buttonsHtml += `
                    <button type="button" class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>
                `;
            }

            buttonsHtml += `
                <button type="button" class="page-btn" ${currentPage === totalPages ? 'disabled' : ''} data-page="${currentPage + 1}">Berikutnya &rsaquo;</button>
            `;

            paginationControls.innerHTML = buttonsHtml;

            paginationControls.querySelectorAll('.page-btn[data-page]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const targetPage = Number(btn.dataset.page);
                    if (targetPage >= 1 && targetPage <= totalPages && targetPage !== currentPage) {
                        currentPage = targetPage;
                        filterHistory(false);
                        triggerTabAnimation();
                    }
                });
            });
        }

        function syncFillerRows(visibleCount, colCount) {
            if (!historyTableBody) return;
            historyTableBody.querySelectorAll('.filler-row').forEach((r) => r.remove());

            if (visibleCount > 0 && visibleCount < ITEMS_PER_PAGE) {
                const missing = ITEMS_PER_PAGE - visibleCount;
                for (let i = 0; i < missing; i++) {
                    const tr = document.createElement('tr');
                    tr.className = 'filler-row';
                    let cells = '';
                    for (let c = 0; c < colCount; c++) {
                        cells += '<td><span class="slot-dash"></span></td>';
                    }
                    tr.innerHTML = cells;
                    historyTableBody.appendChild(tr);
                }
            }
        }

        function filterHistory(resetPage = true) {
            if (resetPage) currentPage = 1;

            if (emptyServerRow) {
                syncFillerRows(0, 8);
                renderPagination(0, 1);
                return;
            }

            const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
            const matchedRows = historyRows.filter((row) => {
                const rowCategory = row.dataset.kategori || 'layanan';
                return rowCategory === activeCategory && row.textContent.toLowerCase().includes(query);
            });

            const totalItems = matchedRows.length;
            const totalPages = Math.max(1, Math.ceil(totalItems / ITEMS_PER_PAGE));
            if (currentPage > totalPages) currentPage = totalPages;

            historyRows.forEach((row) => {
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

            syncFillerRows(pageRows.length, 8);
            renderPagination(totalItems, totalPages);
        }

        historyTabButtons.forEach((button) => {
            button.addEventListener('click', () => {
                if (activeCategory === button.dataset.historyTab) return;
                activeCategory = button.dataset.historyTab;

                syncHistoryTabHeadingAndButtons();
                const url = new URL(window.location.href);
                url.searchParams.set('tab', activeCategory);
                window.history.replaceState(null, '', url.toString());

                filterHistory(true);
                triggerTabAnimation();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', () => filterHistory(true));
        }

        filterHistory(true);
    </script>

    <!-- Modal Detail Riwayat Pesanan Admin -->
    <div class="admin-detail-overlay" id="adminOrderDetailModal" aria-hidden="true">
        <div class="admin-detail-modal" role="dialog" aria-modal="true" aria-labelledby="adminDetailModalTitle">
            <div class="admin-detail-head">
                <h3 class="admin-detail-title" id="adminDetailModalTitle">Detail Pesanan</h3>
                <button type="button" class="admin-detail-close" onclick="closeAdminOrderDetail()" aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="admin-detail-body">
                <div class="admin-info-grid">
                    <div class="admin-info-row"><span class="admin-info-key">ID Pesanan</span><span class="admin-info-val" id="admDetailKode">-</span></div>
                    <div class="admin-info-row"><span class="admin-info-key">Kategori</span><span class="admin-info-val" id="admDetailKategori">-</span></div>
                    <div class="admin-info-row"><span class="admin-info-key">Nama Pelanggan</span><span class="admin-info-val" id="admDetailPelanggan">-</span></div>
                    <div class="admin-info-row"><span class="admin-info-key">No. Telepon / WA</span><span class="admin-info-val" id="admDetailTelepon">-</span></div>
                    <div class="admin-info-row" id="admRowAlamat"><span class="admin-info-key">Alamat Pengiriman</span><span class="admin-info-val" id="admDetailAlamat">-</span></div>
                    <div class="admin-info-row" id="admRowPengiriman"><span class="admin-info-key">Pengiriman</span><span class="admin-info-val" id="admDetailPengiriman">-</span></div>
                    <div class="admin-info-row" id="admRowOngkir"><span class="admin-info-key">Ongkos Kirim</span><span class="admin-info-val" id="admDetailOngkir">-</span></div>
                    <div class="admin-info-row" id="admRowKendaraan"><span class="admin-info-key">Kendaraan</span><span class="admin-info-val" id="admDetailKendaraan">-</span></div>
                    <div class="admin-info-row"><span class="admin-info-key">Jadwal / Waktu</span><span class="admin-info-val" id="admDetailJadwal">-</span></div>
                    <div class="admin-info-row"><span class="admin-info-key">Metode Pembayaran</span><span class="admin-info-val" id="admDetailMetode">-</span></div>
                    <div class="admin-info-row"><span class="admin-info-key">Status</span><span class="admin-info-val" id="admDetailStatus">-</span></div>
                    <div class="admin-info-row"><span class="admin-info-key">Total Harga</span><span class="admin-info-val" id="admDetailTotal">-</span></div>
                </div>

                <div style="font-size:13px; font-weight:800; color:#09090b; margin-bottom:6px;">Rincian Item Pesanan</div>
                <div class="admin-items-box">
                    <table class="admin-items-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th style="width:65px; text-align:center;">Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="admDetailItemsBody"></tbody>
                    </table>
                </div>

                <div id="admBuktiSection" style="display:none; margin-top:16px;">
                    <div style="font-size:13px; font-weight:800; color:#09090b; margin-bottom:8px;">Bukti Pembayaran / Transfer</div>
                    <div id="admBuktiContent"></div>
                </div>

                <div class="admin-detail-footer">
                    <button type="button" class="btn-detail-admin" onclick="closeAdminOrderDetail()">Tutup</button>
                    <a href="#" id="admBtnDownloadPdf" class="btn-detail-admin" style="background:#000000; color:#ffffff; border-color:#000000; text-decoration:none; gap:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Unduh Bukti PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAdminOrderDetail(data) {
            const modal = document.getElementById('adminOrderDetailModal');
            if (!modal || !data) return;

            document.getElementById('admDetailKode').textContent = data.kode || '-';
            document.getElementById('admDetailKategori').textContent = data.kategori || '-';
            document.getElementById('admDetailPelanggan').textContent = data.pelanggan || '-';
            document.getElementById('admDetailTelepon').textContent = data.telepon || '-';
            document.getElementById('admDetailAlamat').textContent = data.alamat || '-';
            const elPengiriman = document.getElementById('admDetailPengiriman');
            const elOngkir = document.getElementById('admDetailOngkir');
            if (elPengiriman) elPengiriman.textContent = data.pengiriman || '-';
            if (elOngkir) elOngkir.textContent = data.ongkir || '-';
            document.getElementById('admDetailKendaraan').textContent = data.kendaraan || '-';
            document.getElementById('admDetailJadwal').textContent = data.jadwal || '-';
            document.getElementById('admDetailMetode').textContent = data.metode || '-';
            document.getElementById('admDetailStatus').textContent = data.status || '-';
            document.getElementById('admDetailTotal').textContent = data.total || '-';

            const isProduk = (data.kategori || '').toLowerCase() === 'produk';
            document.getElementById('admRowAlamat').style.display = isProduk ? '' : 'none';
            const rowPengiriman = document.getElementById('admRowPengiriman');
            const rowOngkir = document.getElementById('admRowOngkir');
            if (rowPengiriman) rowPengiriman.style.display = isProduk ? '' : 'none';
            if (rowOngkir) rowOngkir.style.display = isProduk ? '' : 'none';
            document.getElementById('admRowKendaraan').style.display = isProduk ? 'none' : '';

            const buktiSection = document.getElementById('admBuktiSection');
            const buktiContent = document.getElementById('admBuktiContent');
            if (buktiSection && buktiContent) {
                if (isProduk) {
                    buktiSection.style.display = '';
                    if (data.bukti_url) {
                        buktiContent.innerHTML = `
                            <a href="${data.bukti_url}" target="_blank" rel="noopener" style="display:inline-block; border:1px solid #e4e4e7; border-radius:12px; overflow:hidden; background:#fafafa;">
                                <img src="${data.bukti_url}" alt="Bukti Transfer" style="max-width:100%; max-height:260px; display:block; object-fit:contain;">
                            </a>
                            <div style="font-size:11.5px; color:#71717a; margin-top:6px;">Klik gambar untuk membuka ukuran penuh di tab baru.</div>
                        `;
                    } else {
                        buktiContent.innerHTML = `
                            <div style="padding:12px 14px; border-radius:10px; background:#fef2f2; border:1px solid #fecaca; color:#991b1b; font-size:12.5px; font-weight:600;">
                                Belum ada bukti transfer yang diunggah.
                            </div>
                        `;
                    }
                } else {
                    buktiSection.style.display = 'none';
                    buktiContent.innerHTML = '';
                }
            }

            const tbody = document.getElementById('admDetailItemsBody');
            tbody.innerHTML = (data.items || []).map(function (it) {
                return `
                    <tr>
                        <td>${it.nama}</td>
                        <td style="text-align:center;">${it.qty}</td>
                        <td>${it.harga}</td>
                        <td>${it.subtotal}</td>
                    </tr>
                `;
            }).join('');

            const pdfBtn = document.getElementById('admBtnDownloadPdf');
            if (pdfBtn) {
                pdfBtn.href = data.pdf_url || '#';
                pdfBtn.style.display = data.pdf_url ? 'inline-flex' : 'none';
            }

            modal.classList.add('active');
        }

        function closeAdminOrderDetail() {
            const modal = document.getElementById('adminOrderDetailModal');
            if (modal) modal.classList.remove('active');
        }
    </script>

    <x-delete-confirm-modal />
    <x-logout-modal />
</body>
</html>
