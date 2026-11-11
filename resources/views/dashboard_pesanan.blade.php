<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan - Hunter Garage</title>
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
            background-color: #09090b;
            color: #f5f5f5;
            border-radius: 9999px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
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
            text-align: right;
            white-space: nowrap;
        }
        .badge-menunggu {
            display: inline-block;
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
            font-size: 12px;
            font-weight: 800;
            padding: 6px 16px;
            border-radius: 9999px;
        }
        .action-btns {
            display: inline-flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }
        .btn-tolak {
            background-color: #ffffff;
            color: #71717a;
            border: 1.5px solid #cbd5e1;
            padding: 8px 22px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-tolak:hover {
            background-color: #fef2f2;
            color: #dc2626;
            border-color: #fca5a5;
        }
        .btn-terima {
            background-color: #16a34a;
            color: #ffffff;
            border: 1.5px solid #16a34a;
            padding: 8px 22px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-terima:hover {
            background-color: #15803d;
            border-color: #15803d;
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
                    <h2 class="page-title">Pesanan</h2>
                    <p class="page-subtitle">Pantau pesanan dari masuk sampai selesai.</p>
                </div>
                
                <x-admin-dropdown />
            </header>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <div id="header-layanan" class="header-container">
                <div class="toggle-container">
                    <button type="button" class="toggle-btn active" data-order-tab="layanan" aria-pressed="true">Layanan</button>
                    <button type="button" class="toggle-btn" data-order-tab="produk" aria-pressed="false">Produk</button>
                </div>
                <div class="search-box-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari Data...">
                </div>
            </div>

            <div class="order-card">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th id="orderCategoryHeading">Layanan</th>
                                <th>Tanggal, jam</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            @forelse ($daftarPesanan ?? [] as $pesanan)
                                @php
                                    $kategoriRow = $pesanan->kategori ?? 'layanan';
                                    $kodeBooking = 'BKG-' . str_pad((string) $pesanan->id, 4, '0', STR_PAD_LEFT);
                                    $waktuService = $pesanan->jadwal_service ?? $pesanan->created_at;
                                    $carbonWaktu = $waktuService ? \Carbon\Carbon::parse($waktuService)->locale('id') : null;
                                    $tanggalJamFormat = $carbonWaktu
                                        ? strtolower($carbonWaktu->translatedFormat('d M Y')) . ', ' . $carbonWaktu->format('H:i')
                                        : '-';
                                @endphp
                                <tr class="order-row" data-kategori="{{ $kategoriRow }}">
                                    <td>{{ $kodeBooking }}</td>
                                    <td>{{ $pesanan->nama_pelanggan_tampil ?? 'Pelanggan' }}</td>
                                    <td>{{ $pesanan->nama_layanan ?? '-' }}</td>
                                    <td>{{ $tanggalJamFormat }}</td>
                                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge-menunggu">Menunggu</span>
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <form method="POST" action="{{ route('dashboard.pesanan.status', $pesanan->id) }}" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="tolak">
                                                <button type="submit" class="btn-tolak">Tolak</button>
                                            </form>

                                            <form method="POST" action="{{ route('dashboard.pesanan.status', $pesanan->id) }}" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="terima">
                                                <button type="submit" class="btn-terima">Terima</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyServerRow">
                                    <td colspan="7" class="empty-state-cell">
                                        <div class="empty-state-box">
                                            <div class="empty-state-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                    <rect x="7" y="4" width="10" height="16" rx="2"/>
                                                    <line x1="10" y1="9" x2="14" y2="9"/>
                                                    <line x1="10" y1="13" x2="14" y2="13"/>
                                                </svg>
                                            </div>
                                            <div class="empty-state-title">Belum Ada Data Pesanan</div>
                                            <div class="empty-state-sub">Saat ini belum ada pesanan masuk yang menunggu konfirmasi.</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="emptyFilterRow" style="display:none;">
                                <td colspan="7" class="empty-state-cell">
                                    <div class="empty-state-box">
                                        <div class="empty-state-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            </svg>
                                        </div>
                                        <div class="empty-state-title">Pesanan Tidak Ditemukan</div>
                                        <div class="empty-state-sub">Tidak ada pesanan aktif pada kategori atau pencarian ini.</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-pagination-footer">
                    <div class="pagination-info" id="paginationInfo">Menampilkan 0 data</div>
                    <div class="pagination-controls" id="paginationControls"></div>
                </div>
            </div>

        </main>
    </div>

    <script>
        const orderTabButtons = document.querySelectorAll('[data-order-tab]');
        const orderCategoryHeading = document.getElementById('orderCategoryHeading');
        const orderTableBody = document.getElementById('orderTableBody');
        const searchInput = document.getElementById('searchInput');
        const orderRows = Array.from(document.querySelectorAll('.order-row'));
        const emptyFilterRow = document.getElementById('emptyFilterRow');
        const emptyServerRow = document.getElementById('emptyServerRow');
        const paginationInfo = document.getElementById('paginationInfo');
        const paginationControls = document.getElementById('paginationControls');
        const ITEMS_PER_PAGE = 5;
        let activeCategory = 'layanan';
        let currentPage = 1;

        function triggerTabAnimation() {
            [orderTableBody, orderCategoryHeading].forEach((el) => {
                if (!el) return;
                el.classList.remove('tab-animating');
                void el.offsetWidth;
                el.classList.add('tab-animating');
            });
        }

        function renderPagination(totalItems, totalPages) {
            if (!paginationInfo || !paginationControls) return;

            if (totalItems === 0) {
                paginationInfo.innerHTML = 'Menampilkan <strong>0</strong> data';
                paginationControls.innerHTML = `
                    <button type="button" class="page-btn" disabled>&lsaquo; Prev</button>
                    <button type="button" class="page-btn active" disabled>1</button>
                    <button type="button" class="page-btn" disabled>Next &rsaquo;</button>
                `;
                return;
            }

            const startItem = (currentPage - 1) * ITEMS_PER_PAGE + 1;
            const endItem = Math.min(currentPage * ITEMS_PER_PAGE, totalItems);
            paginationInfo.innerHTML = `Menampilkan <strong>${startItem}&ndash;${endItem}</strong> dari <strong>${totalItems}</strong> data`;

            let buttonsHtml = `
                <button type="button" class="page-btn" ${currentPage === 1 ? 'disabled' : ''} data-page="${currentPage - 1}">&lsaquo; Prev</button>
            `;

            for (let i = 1; i <= totalPages; i++) {
                buttonsHtml += `
                    <button type="button" class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>
                `;
            }

            buttonsHtml += `
                <button type="button" class="page-btn" ${currentPage === totalPages ? 'disabled' : ''} data-page="${currentPage + 1}">Next &rsaquo;</button>
            `;

            paginationControls.innerHTML = buttonsHtml;

            paginationControls.querySelectorAll('.page-btn[data-page]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const targetPage = Number(btn.dataset.page);
                    if (targetPage >= 1 && targetPage <= totalPages && targetPage !== currentPage) {
                        currentPage = targetPage;
                        filterOrders(false);
                        triggerTabAnimation();
                    }
                });
            });
        }

        function syncFillerRows(visibleCount, colCount) {
            if (!orderTableBody) return;
            orderTableBody.querySelectorAll('.filler-row').forEach((r) => r.remove());

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
                    orderTableBody.appendChild(tr);
                }
            }
        }

        function filterOrders(resetPage = true) {
            if (resetPage) currentPage = 1;

            if (emptyServerRow) {
                syncFillerRows(0, 7);
                renderPagination(0, 1);
                return;
            }

            const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
            const matchedRows = orderRows.filter((row) => {
                const rowCategory = row.dataset.kategori || 'layanan';
                return rowCategory === activeCategory && row.textContent.toLowerCase().includes(query);
            });

            const totalItems = matchedRows.length;
            const totalPages = Math.max(1, Math.ceil(totalItems / ITEMS_PER_PAGE));
            if (currentPage > totalPages) currentPage = totalPages;

            orderRows.forEach((row) => {
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

            syncFillerRows(pageRows.length, 7);
            renderPagination(totalItems, totalPages);
        }

        orderTabButtons.forEach((button) => {
            button.addEventListener('click', () => {
                if (activeCategory === button.dataset.orderTab) return;
                activeCategory = button.dataset.orderTab;

                orderTabButtons.forEach((tabButton) => {
                    const isActive = tabButton === button;
                    tabButton.classList.toggle('active', isActive);
                    tabButton.setAttribute('aria-pressed', String(isActive));
                });

                orderCategoryHeading.textContent = activeCategory === 'produk' ? 'Produk' : 'Layanan';
                filterOrders(true);
                triggerTabAnimation();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', () => filterOrders(true));
        }

        filterOrders(true);
    </script>

    <x-logout-modal />
</body>
</html>
