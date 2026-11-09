@extends('layouts.admin')

@section('title', 'Pesanan')

@section('content')
    <header class="page-heading">
        <div>
            <h1>Pesanan</h1>
            <p>Pantau pesanan pelanggan yang berstatus menunggu untuk diterima atau ditolak.</p>
        </div>
    </header>

    @if (session('success'))
        <div class="alert-success" role="status">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert-error" role="alert">{{ $errors->first() }}</div>
    @endif

    <div class="page-toolbar">
        <div class="toolbar-tabs" role="group" aria-label="Filter kategori pesanan">
            <button type="button" class="toolbar-tab active" data-order-tab="layanan" aria-pressed="true">Layanan</button>
            <button type="button" class="toolbar-tab" data-order-tab="produk" aria-pressed="false">Produk</button>
        </div>
        <div class="toolbar-controls">
            <label class="sr-only" for="searchInput">Cari pesanan</label>
            <input type="search" id="searchInput" class="search-input" placeholder="Cari pelanggan atau pesanan">
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Daftar pesanan menunggu</h2>
                <p class="panel-description">{{ number_format($daftarPesanan->count(), 0, ',', '.') }} pesanan menunggu konfirmasi</p>
            </div>
        </div>
        <div class="table-scroll">
            <table class="admin-table order-table">
                <thead>
                    <tr>
                        <th>Pesanan</th>
                        <th>Pelanggan</th>
                        <th id="orderCategoryHeading">Layanan</th>
                        <th>Tanggal & waktu</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    @php
                        $noLayanan = 0;
                        $noProduk = 0;
                    @endphp
                    @forelse ($daftarPesanan as $pesanan)
                        @php
                            $kategoriRow = $pesanan->kategori ?? 'layanan';
                            $nomorUrut = $kategoriRow === 'produk' ? ++$noProduk : ++$noLayanan;
                            $waktuService = $pesanan->jadwal_service ?? $pesanan->created_at;
                            $carbonWaktu = $waktuService ? \Carbon\Carbon::parse($waktuService)->locale('id') : null;
                        @endphp
                        <tr class="order-row" data-kategori="{{ $kategoriRow }}">
                            <td class="numeric">#{{ $nomorUrut }}</td>
                            <td><span class="table-primary">{{ $pesanan->nama_pelanggan_tampil ?? 'Pelanggan dihapus' }}</span></td>
                            <td class="order-item">{{ $pesanan->nama_layanan ?? '—' }}</td>
                            <td>
                                @if ($carbonWaktu)
                                    {{ $carbonWaktu->translatedFormat('d M Y') }}
                                    <span class="schedule-time">Pukul {{ $carbonWaktu->format('H:i') }}</span>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="numeric">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td><span class="status-badge status-process">Menunggu</span></td>
                            <td>
                                <div class="action-buttons">
                                    <form method="POST" action="{{ route('dashboard.pesanan.update', $pesanan->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit" class="button-primary">Terima</button>
                                    </form>
                                    <form method="POST" action="{{ route('dashboard.pesanan.update', $pesanan->id) }}" onsubmit="return confirm('Yakin ingin menolak pesanan #{{ $nomorUrut }}?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="button-danger">Tolak</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyServerRow">
                            <td colspan="7">
                                <div class="empty-state">
                                    <strong>Belum ada pesanan menunggu.</strong>
                                    <p>Pesanan pelanggan yang baru masuk akan tampil di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    <tr id="emptyFilterRow" hidden>
                        <td colspan="7">
                            <div class="empty-state">
                                <strong>Tidak ada pesanan yang cocok.</strong>
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

        function filterOrders() {
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
                filterOrders();
            });
        });

        searchInput.addEventListener('input', filterOrders);
        filterOrders();
    </script>
@endpush

