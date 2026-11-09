<<<<<<< HEAD
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Hunter Garage</title>
    @vite('resources/css/dashboard.css')

    <style>
        .card {
            margin-top: 20px;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 8px;
        }
        .header-container input[type="text"] {
            margin-top: 0;
        }
        th {
            width: auto;
            padding-right: 16px;
        }
        td {
            padding-right: 16px;
        }
        .schedule-date {
            font-weight: 600;
            color: #1f2937;
            font-size: 13px;
            line-height: 1.35;
        }
        .schedule-time {
            display: inline-block;
            margin-top: 3px;
            padding: 2px 8px;
            background-color: #eff6ff;
            color: #1d4ed8;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }
        .badge-cancelled {
            background-color: #fef2f2;
            color: #dc2626;
        }
        .btn-delete {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #fee2e2;
        }
        /* Animasi perpindahan tab Layanan <-> Produk */
        .toggle-btn {
            transition: background-color 0.25s ease, color 0.25s ease, transform 0.2s ease, box-shadow 0.25s ease;
        }
        .toggle-btn.active {
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
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
=======
@extends('layouts.admin')
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261

@section('title', 'Riwayat')

@section('content')
    <header class="page-heading">
        <div>
            <h1>Riwayat pesanan</h1>
            <p>Daftar pesanan layanan dan produk yang telah diterima atau ditolak.</p>
        </div>
    </header>

    <section class="stats-grid" aria-label="Ringkasan riwayat">
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Pesanan diterima</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M5 12.5 9.5 17 19 7.5"/></svg></span></div>
            <strong class="stat-value">{{ number_format($totalDiterima ?? $totalRiwayat, 0, ',', '.') }}</strong>
            <span class="stat-note">Total pesanan diterima</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Pesanan ditolak</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"/></svg></span></div>
            <strong class="stat-value">{{ number_format($totalDitolak ?? 0, 0, ',', '.') }}</strong>
            <span class="stat-note">Total pesanan ditolak</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Nilai pesanan diterima</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 2v20M17 6.5c0-1.4-1.7-2.5-4-2.5H10a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-3c-2.3 0-4-1.1-4-2.5"/></svg></span></div>
            <strong class="stat-value">Rp {{ number_format($nilaiPesananSelesai, 0, ',', '.') }}</strong>
            <span class="stat-note">Akumulasi nilai pesanan diterima</span>
        </article>
    </section>

<<<<<<< HEAD
        <!-- ================= MAIN CONTENT ================= -->
        <main class="main-content">
            
            <!-- Top Header -->
            <header class="header-top">
                <div>
                    <h2 class="page-title">Riwayat</h2>
                    <p class="page-subtitle">Daftar pesanan yang telah selesai atau dibatalkan.</p>
                </div>
                
                <button type="button" class="btn-logout" onclick="openLogoutModal()" title="Keluar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </header>

            <div class="header-container">
                <div class="toggle-container">
                    <button type="button" class="toggle-btn active" data-history-tab="layanan" aria-pressed="true">Layanan</button>
                    <button type="button" class="toggle-btn" data-history-tab="produk" aria-pressed="false">Produk</button>
                </div>
                <div class="header-actions">
                    <input type="text" id="searchInput" placeholder="Cari Riwayat...">
                </div>
            </div>

            <div class="card">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Pelanggan</th>
                                <th id="historyCategoryHeading">Layanan</th>
                                <th>Tanggal,jam</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="historyTableBody">
                            @php
                                $noLayanan = 0;
                                $noProduk = 0;
                            @endphp
                            @forelse ($daftarRiwayat ?? [] as $riwayat)
                                @php
                                    $kategoriRow = $riwayat->kategori ?? 'layanan';
                                    $nomorUrut = $kategoriRow === 'produk' ? ++$noProduk : ++$noLayanan;
                                    $waktuService = $riwayat->jadwal_service ?? $riwayat->created_at;
                                    $carbonWaktu = $waktuService ? \Carbon\Carbon::parse($waktuService)->locale('id') : null;
                                    $badgeClass = $riwayat->status === 'dibatalkan' ? 'badge-cancelled' : 'badge-success';
                                @endphp
                                <tr class="history-row" data-kategori="{{ $kategoriRow }}">
                                    <td class="td-bold">#{{ $nomorUrut }}</td>
                                    <td>{{ $riwayat->nama_pelanggan_tampil ?? 'Pelanggan' }}</td>
                                    <td>{{ $riwayat->nama_layanan ?? '-' }}</td>
                                    <td class="td-muted">
                                        @if ($carbonWaktu)
                                            <div class="schedule-date">{{ $carbonWaktu->translatedFormat('l, d M Y') }}</div>
                                            <div class="schedule-time">Pukul {{ $carbonWaktu->format('H:i') }}</div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="td-bold">Rp {{ number_format($riwayat->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($riwayat->status) }}</span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('dashboard.pesanan.destroy', $riwayat->id) }}" onsubmit="return confirm('Yakin ingin menghapus riwayat #{{ $nomorUrut }}?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyServerRow">
                                    <td colspan="7" style="text-align:center; color:#6b7280;">Belum ada riwayat pesanan selesai atau dibatalkan.</td>
                                </tr>
                            @endforelse
                            <tr id="emptyFilterRow" style="display:none;">
                                <td colspan="7" style="text-align:center; color:#6b7280;">Tidak ada riwayat pada kategori/pencarian ini.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>
        const historyTabButtons = document.querySelectorAll('[data-history-tab]');
        const historyCategoryHeading = document.getElementById('historyCategoryHeading');
        const historyTableBody = document.getElementById('historyTableBody');
        const searchInput = document.getElementById('searchInput');
        const historyRows = document.querySelectorAll('.history-row');
=======
    <div class="page-toolbar">
        <div class="toolbar-tabs" role="group" aria-label="Filter kategori riwayat pesanan">
            <button type="button" class="toolbar-tab active" data-order-tab="layanan" aria-pressed="true">Layanan</button>
            <button type="button" class="toolbar-tab" data-order-tab="produk" aria-pressed="false">Produk</button>
        </div>
        <div class="toolbar-controls">
            <label class="sr-only" for="searchInput">Cari riwayat pesanan</label>
            <input type="search" id="searchInput" class="search-input" placeholder="Cari pelanggan atau pesanan">
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Catatan riwayat pesanan</h2>
                <p class="panel-description">{{ number_format($totalRiwayat, 0, ',', '.') }} riwayat pesanan tercatat</p>
            </div>
        </div>
        <div class="table-scroll">
            <table class="admin-table order-table">
                <thead>
                    <tr>
                        <th>Pesanan</th>
                        <th>Pelanggan</th>
                        <th id="orderCategoryHeading">Layanan</th>
                        <th>Tanggal diperbarui</th>
                        <th>Nilai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    @php
                        $noLayanan = 0;
                        $noProduk = 0;
                    @endphp
                    @forelse ($pesananSelesai as $pesanan)
                        @php
                            $kategoriRow = $pesanan->kategori ?? 'layanan';
                            $nomorUrut = $kategoriRow === 'produk' ? ++$noProduk : ++$noLayanan;
                            $isDitolak = $pesanan->status === 'ditolak';
                            $badgeClass = $isDitolak ? 'status-low' : 'status-success';
                            $labelStatus = $isDitolak ? 'Ditolak' : 'Diterima';
                        @endphp
                        <tr class="order-row" data-kategori="{{ $kategoriRow }}">
                            <td class="numeric">#{{ $nomorUrut }}</td>
                            <td><span class="table-primary">{{ $pesanan->nama_pelanggan ?? 'Pelanggan dihapus' }}</span></td>
                            <td class="order-item">{{ $pesanan->nama_layanan ?? '—' }}</td>
                            <td class="numeric">
                                @if ($pesanan->updated_at)
                                    {{ \Carbon\Carbon::parse($pesanan->updated_at)->locale('id')->translatedFormat('d M Y, H:i') }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="numeric">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td><span class="status-badge {{ $badgeClass }}">{{ $labelStatus }}</span></td>
                        </tr>
                    @empty
                        <tr id="emptyServerRow">
                            <td colspan="6">
                                <div class="empty-state">
                                    <strong>Belum ada riwayat pesanan.</strong>
                                    <p>Pesanan yang sudah diterima atau ditolak akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    <tr id="emptyFilterRow" hidden>
                        <td colspan="6">
                            <div class="empty-state">
                                <strong>Tidak ada riwayat pesanan yang cocok.</strong>
                                <p>Coba kategori atau kata kunci pencarian lain.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const orderTabButtons = document.querySelectorAll('[data-order-tab]');
        const orderCategoryHeading = document.getElementById('orderCategoryHeading');
        const searchInput = document.getElementById('searchInput');
        const orderRows = document.querySelectorAll('.order-row');
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
        const emptyFilterRow = document.getElementById('emptyFilterRow');
        const emptyServerRow = document.getElementById('emptyServerRow');
        let activeCategory = 'layanan';

<<<<<<< HEAD
        function triggerTabAnimation() {
            [historyTableBody, historyCategoryHeading].forEach((el) => {
                if (!el) return;
                el.classList.remove('tab-animating');
                void el.offsetWidth;
                el.classList.add('tab-animating');
            });
        }

        function filterHistory() {
            if (emptyServerRow) return;
            const query = (searchInput.value || '').toLowerCase().trim();
            let visibleCount = 0;

            historyRows.forEach((row) => {
                const rowCategory = row.dataset.kategori || 'layanan';
                const matchesCategory = rowCategory === activeCategory;
                const matchesSearch = row.textContent.toLowerCase().includes(query);

                if (matchesCategory && matchesSearch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (emptyFilterRow) {
                emptyFilterRow.style.display = visibleCount === 0 ? '' : 'none';
            }
        }

        historyTabButtons.forEach((button) => {
            button.addEventListener('click', () => {
                if (activeCategory === button.dataset.historyTab) return;
                activeCategory = button.dataset.historyTab;

                historyTabButtons.forEach((tabButton) => {
=======
        function filterHistory() {
            if (emptyServerRow) return;

            const query = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            orderRows.forEach((row) => {
                const matchesCategory = (row.dataset.kategori || 'layanan') === activeCategory;
                const matchesSearch = row.textContent.toLowerCase().includes(query);
                row.hidden = !(matchesCategory && matchesSearch);
                if (!row.hidden) visibleCount++;
            });

            emptyFilterRow.hidden = visibleCount > 0;
        }

        orderTabButtons.forEach((button) => {
            button.addEventListener('click', () => {
                activeCategory = button.dataset.orderTab;
                orderTabButtons.forEach((tabButton) => {
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
                    const isActive = tabButton === button;
                    tabButton.classList.toggle('active', isActive);
                    tabButton.setAttribute('aria-pressed', String(isActive));
                });
<<<<<<< HEAD

                historyCategoryHeading.textContent = activeCategory === 'produk' ? 'Produk' : 'Layanan';
                filterHistory();
                triggerTabAnimation();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', filterHistory);
        }

        filterHistory();
    </script>

    <x-logout-modal />
</body>
</html>
=======
                orderCategoryHeading.textContent = activeCategory === 'produk' ? 'Produk' : 'Layanan';
                filterHistory();
            });
        });

        searchInput.addEventListener('input', filterHistory);
        filterHistory();
    </script>
@endpush

>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
