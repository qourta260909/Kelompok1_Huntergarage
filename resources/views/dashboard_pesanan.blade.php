@extends('layouts.admin')

@section('title', 'Pesanan')

@section('content')
    <header class="page-heading">
        <div>
            <h1>Pesanan</h1>
            <p>Pantau pesanan layanan dan produk dari masuk hingga selesai.</p>
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
            <button type="button" class="button-primary" onclick="openCreateModal()">
                <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                Tambah pesanan
            </button>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Daftar pesanan</h2>
                <p class="panel-description">{{ number_format($daftarPesanan->count(), 0, ',', '.') }} pesanan tercatat</p>
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
                            $badgeClass = match($pesanan->status) {
                                'selesai' => 'status-success',
                                'proses' => 'status-process',
                                default => 'status-new',
                            };
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
                            <td><span class="status-badge {{ $badgeClass }}">{{ ucfirst($pesanan->status) }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button
                                        type="button"
                                        class="button-secondary"
                                        onclick="openEditModal({{ json_encode([
                                            'id' => $pesanan->id,
                                            'nomor_urut' => $nomorUrut,
                                            'nama_pelanggan' => $pesanan->nama_pelanggan_tampil ?? '',
                                            'kategori' => $kategoriRow,
                                            'nama_layanan' => $pesanan->nama_layanan ?? '',
                                            'jadwal_service' => $pesanan->jadwal_service ? \Carbon\Carbon::parse($pesanan->jadwal_service)->format('Y-m-d\TH:i') : ($pesanan->created_at ? \Carbon\Carbon::parse($pesanan->created_at)->format('Y-m-d\TH:i') : ''),
                                            'total_harga' => (float) $pesanan->total_harga,
                                            'status' => $pesanan->status ?? 'baru',
                                            'update_url' => route('dashboard.pesanan.update', $pesanan->id),
                                        ]) }})"
                                    >Edit</button>
                                    <form method="POST" action="{{ route('dashboard.pesanan.destroy', $pesanan->id) }}" onsubmit="return confirm('Yakin ingin menghapus pesanan #{{ $nomorUrut }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyServerRow">
                            <td colspan="7">
                                <div class="empty-state">
                                    <strong>Belum ada data pesanan.</strong>
                                    <p>Tambahkan pesanan baru atau tunggu pesanan pelanggan masuk.</p>
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

    <div id="crudOrderModal" class="crud-modal-overlay" aria-hidden="true">
        <button class="logout-modal-backdrop" type="button" aria-label="Tutup formulir pesanan" onclick="closeCrudModal()"></button>
        <div class="crud-modal-card" role="dialog" aria-modal="true" aria-labelledby="crudModalTitle">
            <h2 id="crudModalTitle" class="crud-modal-title">Tambah pesanan</h2>
            <form id="crudOrderForm" method="POST" action="{{ route('dashboard.pesanan.store') }}">
                @csrf
                <input type="hidden" name="_method" id="crudFormMethod" value="POST">

                <div class="form-group">
                    <label for="inputNamaPelanggan">Nama pelanggan</label>
                    <input type="text" id="inputNamaPelanggan" name="nama_pelanggan" class="form-control" placeholder="Masukkan nama pelanggan" required>
                </div>
                <div class="form-group">
                    <label for="inputKategori">Kategori</label>
                    <select id="inputKategori" name="kategori" class="form-control" required onchange="updateItemLabel()">
                        <option value="layanan">Layanan</option>
                        <option value="produk">Produk</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputNamaLayanan" id="labelNamaItem">Nama layanan</label>
                    <input type="text" id="inputNamaLayanan" name="nama_layanan" class="form-control" placeholder="Contoh: Servis berkala" required>
                </div>
                <div class="form-row-2">
                    <div class="form-group">
                        <label for="inputTanggalService">Tanggal servis</label>
                        <input type="date" id="inputTanggalService" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="inputJamService">Jam servis (08.00–22.00)</label>
                        <select id="inputJamService" class="form-control" required>
                            @for ($hour = 8; $hour <= 22; $hour++)
                                <option value="{{ sprintf('%02d:00', $hour) }}">{{ sprintf('%02d:00', $hour) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <input type="hidden" id="inputJadwalService" name="jadwal_service">
                <div class="form-group">
                    <label for="inputTotalHarga">Total harga (Rp)</label>
                    <input type="text" inputmode="numeric" id="inputTotalHarga" name="total_harga" class="form-control" placeholder="Contoh: 150,000" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="inputStatus">Status pesanan</label>
                    <select id="inputStatus" name="status" class="form-control" required>
                        <option value="baru">Baru</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div class="crud-modal-actions">
                    <button type="button" class="btn-cancel-crud" onclick="closeCrudModal()">Batal</button>
                    <button type="submit" class="btn-save-crud">Simpan pesanan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const orderTabButtons = document.querySelectorAll('[data-order-tab]');
        const orderCategoryHeading = document.getElementById('orderCategoryHeading');
        const orderTableBody = document.getElementById('orderTableBody');
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

        const crudModal = document.getElementById('crudOrderModal');
        const crudForm = document.getElementById('crudOrderForm');
        const crudModalTitle = document.getElementById('crudModalTitle');
        const crudFormMethod = document.getElementById('crudFormMethod');
        const inputNamaPelanggan = document.getElementById('inputNamaPelanggan');
        const inputKategori = document.getElementById('inputKategori');
        const inputNamaLayanan = document.getElementById('inputNamaLayanan');
        const inputTanggalService = document.getElementById('inputTanggalService');
        const inputJamService = document.getElementById('inputJamService');
        const inputJadwalService = document.getElementById('inputJadwalService');
        const inputTotalHarga = document.getElementById('inputTotalHarga');
        const inputStatus = document.getElementById('inputStatus');
        const labelNamaItem = document.getElementById('labelNamaItem');
        const defaultToday = "{{ now()->format('Y-m-d') }}";
        let previousFocus;

        function formatNumberWithCommas(value) {
            const digitsOnly = String(value ?? '').replace(/\D/g, '');
            return digitsOnly.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        function syncJadwalService() {
            const date = inputTanggalService.value || defaultToday;
            const time = inputJamService.value || '09:00';
            inputJadwalService.value = `${date}T${time}`;
        }

        function updateItemLabel() {
            const isProduct = inputKategori.value === 'produk';
            labelNamaItem.textContent = isProduct ? 'Nama produk' : 'Nama layanan';
            inputNamaLayanan.placeholder = isProduct ? 'Contoh: Oli mesin atau kampas rem' : 'Contoh: Servis berkala atau ganti oli';
        }

        function showCrudModal() {
            previousFocus = document.activeElement;
            crudModal.classList.add('active');
            crudModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            inputNamaPelanggan.focus();
        }

        function openCreateModal() {
            crudModalTitle.textContent = 'Tambah pesanan';
            crudForm.action = "{{ route('dashboard.pesanan.store') }}";
            crudFormMethod.value = 'POST';
            inputNamaPelanggan.value = '';
            inputKategori.value = activeCategory;
            inputNamaLayanan.value = '';
            inputTanggalService.value = defaultToday;
            inputJamService.value = '09:00';
            syncJadwalService();
            inputTotalHarga.value = '';
            inputStatus.value = 'baru';
            updateItemLabel();
            showCrudModal();
        }

        function openEditModal(data) {
            crudModalTitle.textContent = `Edit pesanan #${data.nomor_urut ?? data.id}`;
            crudForm.action = data.update_url;
            crudFormMethod.value = 'PUT';
            inputNamaPelanggan.value = data.nama_pelanggan;
            inputKategori.value = data.kategori || 'layanan';
            inputNamaLayanan.value = data.nama_layanan;

            const [date, time = '09:00'] = (data.jadwal_service || '').split('T');
            inputTanggalService.value = date || defaultToday;
            const hour = Number.parseInt(time.slice(0, 2), 10);
            inputJamService.value = `${String(Math.min(22, Math.max(8, Number.isNaN(hour) ? 9 : hour))).padStart(2, '0')}:00`;
            syncJadwalService();
            inputTotalHarga.value = formatNumberWithCommas(Math.round(Number(data.total_harga || 0)));
            inputStatus.value = data.status;
            updateItemLabel();
            showCrudModal();
        }

        function closeCrudModal() {
            crudModal.classList.remove('active');
            crudModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (previousFocus instanceof HTMLElement) previousFocus.focus();
        }

        inputTotalHarga.addEventListener('input', () => {
            inputTotalHarga.value = formatNumberWithCommas(inputTotalHarga.value);
        });
        inputTanggalService.addEventListener('change', syncJadwalService);
        inputJamService.addEventListener('change', syncJadwalService);
        crudForm.addEventListener('submit', () => {
            syncJadwalService();
            inputTotalHarga.value = inputTotalHarga.value.replace(/\D/g, '');
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && crudModal.classList.contains('active')) closeCrudModal();
        });
    </script>
@endpush
