<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rating &amp; Ulasan - Hunter Garage</title>
    @vite('resources/css/dashboard.css')
    <style>
        .ulasan-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 22px;
            margin-bottom: 22px;
        }
        .ulasan-stat-card {
            background: #ffffff;
            border: 1px solid #e4e4e7;
            border-radius: 16px;
            padding: 18px 22px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }
        .ulasan-stat-label {
            font-size: 12.5px;
            font-weight: 700;
            color: #71717a;
            margin-bottom: 4px;
        }
        .ulasan-stat-value {
            font-size: 26px;
            font-weight: 800;
            color: #09090b;
            line-height: 1.15;
        }
        .ulasan-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #fef3c7;
            color: #d97706;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .ulasan-stat-icon.dark {
            background: #f4f4f5;
            color: #18181b;
        }
        .controls-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .controls-left {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
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
        .search-box-wrapper input[type="text"].search-input {
            margin-top: 0;
            padding: 10px 16px 10px 38px;
            width: 270px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            font-size: 13.5px;
            color: #18181b;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        .filter-select {
            padding: 10px 38px 10px 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px 16px;
            appearance: none;
            -webkit-appearance: none;
            font-size: 13.5px;
            font-weight: 600;
            color: #18181b;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            cursor: pointer;
        }
        .catalog-card-header {
            padding: 22px 28px 16px;
            border-bottom: 1px solid #f1f5f9;
        }
        .catalog-card-title {
            font-size: 18px;
            font-weight: 800;
            color: #09090b;
            margin-bottom: 4px;
        }
        .catalog-card-subtitle {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }
        .star-row {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            white-space: nowrap;
        }
        .star-filled {
            color: #f59e0b;
        }
        .star-empty {
            color: #e4e4e7;
        }
        .rating-score-badge {
            margin-left: 6px;
            font-size: 12px;
            font-weight: 800;
            color: #18181b;
        }
        .badge-kat-layanan {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            white-space: nowrap;
        }
        .badge-kat-produk {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            background: #f4f4f5;
            color: #18181b;
            border: 1px solid #d4d4d8;
            white-space: nowrap;
        }
        .ulasan-text-cell {
            max-width: 320px;
            font-size: 13px;
            font-weight: 500;
            color: #3f3f46;
            line-height: 1.45;
        }
        .cell-sub-meta {
            display: block;
            font-size: 11.5px;
            font-weight: 500;
            color: #71717a;
            margin-top: 2px;
        }
        @media (max-width: 900px) {
            .ulasan-stats-grid {
                grid-template-columns: 1fr;
            }
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
                <a href="{{ route('dashboard.ulasan') }}" class="nav-link {{ request()->routeIs('dashboard.ulasan') ? 'active' : 'inactive' }}">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
</svg>
</span> Ulasan
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
            <header class="header-top">
                <div>
                    <h2 class="page-title">Rating &amp; Ulasan</h2>
                    <p class="page-subtitle">Pantau penilaian bintang dan ulasan pelanggan untuk layanan servis maupun produk</p>
                </div>

                <x-admin-dropdown />
            </header>

            <section class="ulasan-stats-grid" aria-label="Ringkasan Rating dan Ulasan">
                <div class="ulasan-stat-card">
                    <div>
                        <div class="ulasan-stat-label">Rata-rata Rating</div>
                        <div class="ulasan-stat-value">{{ number_format($rataRating, 1) }} / 5.0</div>
                    </div>
                    <div class="ulasan-stat-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                </div>

                <div class="ulasan-stat-card">
                    <div>
                        <div class="ulasan-stat-label">Total Ulasan Masuk</div>
                        <div class="ulasan-stat-value">{{ $totalUlasan }}</div>
                    </div>
                    <div class="ulasan-stat-icon dark" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                </div>

                <div class="ulasan-stat-card">
                    <div>
                        <div class="ulasan-stat-label">Rating Bintang 5</div>
                        <div class="ulasan-stat-value">{{ $bintangLima }}</div>
                    </div>
                    <div class="ulasan-stat-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>
                    </div>
                </div>
            </section>

            <div class="controls-bar">
                <div class="controls-left">
                    <div class="search-box-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="searchInput" class="search-input" placeholder="Cari kode, pelanggan, atau ulasan...">
                    </div>
                    <select id="ratingFilterSelect" class="filter-select" aria-label="Filter Rating">
                        <option value="all">Rating: Semua</option>
                        <option value="5">5 Bintang</option>
                        <option value="4">4 Bintang</option>
                        <option value="3">3 Bintang</option>
                        <option value="2">2 Bintang</option>
                        <option value="1">1 Bintang</option>
                    </select>
                    <select id="kategoriFilterSelect" class="filter-select" aria-label="Filter Kategori">
                        <option value="all">Kategori: Semua</option>
                        <option value="layanan">Layanan Servis</option>
                        <option value="produk">Produk</option>
                    </select>
                </div>
            </div>

            <div class="catalog-card">
                <div class="catalog-card-header">
                    <div class="catalog-card-title">Daftar Rating &amp; Ulasan Pelanggan</div>
                    <div class="catalog-card-subtitle">Ulasan yang dikirim pelanggan setelah pesanan atau servis selesai</div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Kategori</th>
                                <th>Layanan / Produk</th>
                                <th>Rating</th>
                                <th>Ulasan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="ulasanTableBody">
                            @forelse ($daftarUlasan as $item)
                                @php
                                    $kat = ($item->kategori ?? 'layanan') === 'produk' ? 'produk' : 'layanan';
                                    $ratingVal = (int) ($item->rating ?? 0);
                                    $tanggalUlasan = $item->updated_at
                                        ? \Carbon\Carbon::parse($item->updated_at)->locale('id')->translatedFormat('d M Y, H:i')
                                        : '-';
                                @endphp
                                <tr class="ulasan-row" data-rating="{{ $ratingVal }}" data-kategori="{{ $kat }}">
                                    <td style="white-space: nowrap; font-weight: 700;">{{ $item->kode_booking }}</td>
                                    <td>
                                        {{ $item->nama_pelanggan_tampil }}
                                        @if ($item->no_telepon)
                                            <span class="cell-sub-meta">{{ $item->no_telepon }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kat === 'produk')
                                            <span class="badge-kat-produk">Produk</span>
                                        @else
                                            <span class="badge-kat-layanan">Layanan Servis</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->nama_layanan ?? '-' }}</td>
                                    <td>
                                        <div class="star-row" aria-label="Rating {{ $ratingVal }} dari 5">
                                            @for ($s = 1; $s <= 5; $s++)
                                                <svg class="{{ $s <= $ratingVal ? 'star-filled' : 'star-empty' }}" width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                                </svg>
                                            @endfor
                                            <span class="rating-score-badge">{{ $ratingVal }}/5</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ulasan-text-cell">{{ $item->ulasan ?: '-' }}</div>
                                    </td>
                                    <td style="white-space: nowrap;">{{ $tanggalUlasan }}</td>
                                </tr>
                            @empty
                                <tr id="emptyServerRow">
                                    <td colspan="7" class="empty-state-cell">
                                        <div class="empty-state-box">
                                            <div class="empty-state-title">Belum Ada Rating &amp; Ulasan</div>
                                            <div class="empty-state-sub">Penilaian dan ulasan dari pelanggan akan muncul otomatis di sini setelah mereka memberi rating.</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="emptyFilterRow" style="display:none;">
                                <td colspan="7" class="empty-state-cell">
                                    <div class="empty-state-box">
                                        <div class="empty-state-title">Ulasan Tidak Ditemukan</div>
                                        <div class="empty-state-sub">Tidak ada ulasan yang cocok dengan filter atau kata kunci pencarian ini.</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-pagination-footer">
                    <div class="pagination-info" id="paginationSummary">Menampilkan 0 dari 0 Ulasan</div>
                    <div class="pagination-controls" id="paginationControls"></div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const ratingFilterSelect = document.getElementById('ratingFilterSelect');
        const kategoriFilterSelect = document.getElementById('kategoriFilterSelect');
        const ulasanRows = Array.from(document.querySelectorAll('.ulasan-row'));
        const emptyFilterRow = document.getElementById('emptyFilterRow');
        const emptyServerRow = document.getElementById('emptyServerRow');
        const paginationControls = document.getElementById('paginationControls');
        const paginationSummary = document.getElementById('paginationSummary');
        const ITEMS_PER_PAGE = 8;
        let currentPage = 1;

        function renderPagination(totalItems, totalPages, startItem, endItem) {
            if (paginationSummary) {
                paginationSummary.textContent = totalItems === 0
                    ? 'Menampilkan 0 dari 0 Ulasan'
                    : `Menampilkan ${startItem}-${endItem} dari ${totalItems} Ulasan`;
            }

            if (!paginationControls) return;

            if (totalItems === 0) {
                paginationControls.innerHTML = `
                    <button type="button" class="page-btn" disabled>&lsaquo; Sebelumnya</button>
                    <button type="button" class="page-btn active">1</button>
                    <button type="button" class="page-btn" disabled>Berikutnya &rsaquo;</button>
                `;
                return;
            }

            let buttonsHtml = `<button type="button" class="page-btn" ${currentPage === 1 ? 'disabled' : ''} data-page="${currentPage - 1}">&lsaquo; Sebelumnya</button>`;
            for (let i = 1; i <= totalPages; i++) {
                buttonsHtml += `<button type="button" class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
            }
            buttonsHtml += `<button type="button" class="page-btn" ${currentPage === totalPages ? 'disabled' : ''} data-page="${currentPage + 1}">Berikutnya &rsaquo;</button>`;

            paginationControls.innerHTML = buttonsHtml;
            paginationControls.querySelectorAll('.page-btn[data-page]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const targetPage = Number(btn.dataset.page);
                    if (targetPage >= 1 && targetPage <= totalPages && targetPage !== currentPage) {
                        currentPage = targetPage;
                        filterUlasan(false);
                    }
                });
            });
        }

        function filterUlasan(resetPage = true) {
            if (resetPage) currentPage = 1;

            if (emptyServerRow) {
                renderPagination(0, 1, 0, 0);
                return;
            }

            const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
            const ratingFilter = ratingFilterSelect ? ratingFilterSelect.value : 'all';
            const kategoriFilter = kategoriFilterSelect ? kategoriFilterSelect.value : 'all';

            const matchedRows = ulasanRows.filter((row) => {
                const matchRating = ratingFilter === 'all' || row.dataset.rating === ratingFilter;
                const matchKategori = kategoriFilter === 'all' || row.dataset.kategori === kategoriFilter;
                const matchText = row.textContent.toLowerCase().includes(query);
                return matchRating && matchKategori && matchText;
            });

            const totalItems = matchedRows.length;
            const totalPages = Math.max(1, Math.ceil(totalItems / ITEMS_PER_PAGE));
            if (currentPage > totalPages) currentPage = totalPages;

            ulasanRows.forEach((row) => {
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
            renderPagination(totalItems, totalPages, startItem, endItem);
        }

        if (searchInput) searchInput.addEventListener('input', () => filterUlasan(true));
        if (ratingFilterSelect) ratingFilterSelect.addEventListener('change', () => filterUlasan(true));
        if (kategoriFilterSelect) kategoriFilterSelect.addEventListener('change', () => filterUlasan(true));
        filterUlasan(true);
    </script>

    <x-logout-modal />
</body>
</html>
