@extends('layouts.admin')

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
        const emptyFilterRow = document.getElementById('emptyFilterRow');
        const emptyServerRow = document.getElementById('emptyServerRow');
        let activeCategory = 'layanan';

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
                    const isActive = tabButton === button;
                    tabButton.classList.toggle('active', isActive);
                    tabButton.setAttribute('aria-pressed', String(isActive));
                });
                orderCategoryHeading.textContent = activeCategory === 'produk' ? 'Produk' : 'Layanan';
                filterHistory();
            });
        });

        searchInput.addEventListener('input', filterHistory);
        filterHistory();
    </script>
@endpush

