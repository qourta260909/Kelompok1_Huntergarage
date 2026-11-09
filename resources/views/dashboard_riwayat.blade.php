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
</span> Dashboard
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
                <a href="{{ route('dashboard.profile') }}" class="nav-link {{ request()->routeIs('dashboard.profile') ? 'active' : 'inactive' }}">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
  <circle cx="12" cy="8" r="4"/>
  <path d="M4 20c0-4 4-6 8-6s8 2 8 6v1H4v-1z"/>
</svg>
</span> Profile
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
            </nav>
        </aside>

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
        const emptyFilterRow = document.getElementById('emptyFilterRow');
        const emptyServerRow = document.getElementById('emptyServerRow');
        let activeCategory = 'layanan';

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
                    const isActive = tabButton === button;
                    tabButton.classList.toggle('active', isActive);
                    tabButton.setAttribute('aria-pressed', String(isActive));
                });

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