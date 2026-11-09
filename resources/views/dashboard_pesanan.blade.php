@extends('layouts.admin')

<<<<<<< HEAD
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
        .btn-add-order {
            background-color: #2563eb;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        }
        .btn-add-order:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }
        .action-btns {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-edit {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-edit:hover {
            background-color: #dbeafe;
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
        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
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
        /* Modal CRUD Pesanan */
        .crud-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
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
            background: #fff;
            width: 100%;
            max-width: 460px;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);
        }
        .crud-modal-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 16px;
        }
        .form-group {
            margin-bottom: 14px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            color: #0f172a;
        }
        .form-control:focus {
            outline: 2px solid #2563eb;
            border-color: #2563eb;
        }
        .crud-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-cancel-crud {
            background: #f1f5f9;
            color: #475569;
            border: none;
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-save-crud {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-save-crud:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>
=======
@section('title', 'Pesanan')
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261

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

<<<<<<< HEAD
        <!-- ================= MAIN CONTENT ================= -->
        <main class="main-content">
            
            <!-- Top Header -->
            <header class="header-top">
                <div>
                    <h2 class="page-title">Pesanan</h2>
                    <p class="page-subtitle">Pantau pesanan anda dari masuk sampai selesai.</p>
                </div>
                
                <button type="button" class="btn-logout" onclick="openLogoutModal()" title="Keluar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
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
                <div class="header-actions">
                    <input type="text" id="searchInput" placeholder="Cari Data...">
                    <button type="button" class="btn-add-order" onclick="openCreateModal()">+ Tambah Data</button>
                </div>
            </div>

            <div class="card">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Pelanggan</th>
                                <th id="orderCategoryHeading">Layanan</th>
                                <th>Tanggal,jam</th>
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
                            @forelse ($daftarPesanan ?? [] as $pesanan)
                                @php
                                    $kategoriRow = $pesanan->kategori ?? 'layanan';
                                    $nomorUrut = $kategoriRow === 'produk' ? ++$noProduk : ++$noLayanan;
                                    $waktuService = $pesanan->jadwal_service ?? $pesanan->created_at;
                                    $carbonWaktu = $waktuService ? \Carbon\Carbon::parse($waktuService)->locale('id') : null;
                                @endphp
                                <tr class="order-row" data-kategori="{{ $kategoriRow }}">
                                    <td class="td-bold">#{{ $nomorUrut }}</td>
                                    <td>{{ $pesanan->nama_pelanggan_tampil ?? 'Pelanggan' }}</td>
                                    <td>{{ $pesanan->nama_layanan ?? '-' }}</td>
                                    <td class="td-muted">
                                        @if ($carbonWaktu)
                                            <div class="schedule-date">{{ $carbonWaktu->translatedFormat('l, d M Y') }}</div>
                                            <div class="schedule-time">Pukul {{ $carbonWaktu->format('H:i') }}</div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="td-bold">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match($pesanan->status) {
                                                'selesai' => 'badge-success',
                                                'proses' => 'badge-process',
                                                default => 'badge-waiting',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($pesanan->status) }}</span>
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <button
                                                type="button"
                                                class="btn-edit"
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

                                            <form method="POST" action="{{ route('dashboard.pesanan.destroy', $pesanan->id) }}" onsubmit="return confirm('Yakin ingin menghapus pesanan #{{ $nomorUrut }}?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyServerRow">
                                    <td colspan="7" style="text-align:center; color:#6b7280;">Belum ada data pesanan.</td>
                                </tr>
                            @endforelse
                            <tr id="emptyFilterRow" style="display:none;">
                                <td colspan="7" style="text-align:center; color:#6b7280;">Tidak ada pesanan pada kategori/pencarian ini.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Modal Tambah / Edit Pesanan -->
    <div id="crudOrderModal" class="crud-modal-overlay" aria-hidden="true">
        <div class="crud-modal-card">
            <h3 id="crudModalTitle" class="crud-modal-title">Tambah Data</h3>
            <form id="crudOrderForm" method="POST" action="{{ route('dashboard.pesanan.store') }}">
                @csrf
                <input type="hidden" name="_method" id="crudFormMethod" value="POST">

                <div class="form-group">
                    <label for="inputNamaPelanggan">Nama Pelanggan</label>
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
                    <label for="inputNamaLayanan" id="labelNamaItem">Nama Layanan</label>
                    <select id="inputNamaLayanan" name="nama_layanan" class="form-control" required></select>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="inputTanggalService">Tanggal Service</label>
                        <input type="date" id="inputTanggalService" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="inputJamService">Jam Service (08:00 - 22:00)</label>
                        <select id="inputJamService" class="form-control" required>
                            @for ($hour = 8; $hour <= 22; $hour++)
                                @php
                                    $timeVal = sprintf('%02d:00', $hour);
                                    $keteranganWaktu = match(true) {
                                        $hour < 11 => 'Pagi',
                                        $hour < 15 => 'Siang',
                                        $hour < 18 => 'Sore',
                                        default => 'Malam',
                                    };
                                @endphp
                                <option value="{{ $timeVal }}">{{ $timeVal }} ({{ $keteranganWaktu }})</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <input type="hidden" id="inputJadwalService" name="jadwal_service">

                <div class="form-group">
                    <label for="inputTotalHarga">Total Harga (Rp)</label>
                    <input type="text" inputmode="numeric" id="inputTotalHarga" name="total_harga" class="form-control" placeholder="Contoh: 150,000" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select id="inputStatus" name="status" class="form-control" required>
                        <option value="baru">Baru</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai (Pindah ke Riwayat)</option>
                        <option value="dibatalkan">Dibatalkan (Pindah ke Riwayat)</option>
                    </select>
                </div>

                <div class="crud-modal-actions">
                    <button type="button" class="btn-cancel-crud" onclick="closeCrudModal()">Batal</button>
                    <button type="submit" class="btn-save-crud">Simpan</button>
                </div>
            </form>
=======
    <div class="page-toolbar">
        <div class="toolbar-tabs" role="group" aria-label="Filter kategori pesanan">
            <button type="button" class="toolbar-tab active" data-order-tab="layanan" aria-pressed="true">Layanan</button>
            <button type="button" class="toolbar-tab" data-order-tab="produk" aria-pressed="false">Produk</button>
        </div>
        <div class="toolbar-controls">
            <label class="sr-only" for="searchInput">Cari pesanan</label>
            <input type="search" id="searchInput" class="search-input" placeholder="Cari pelanggan atau pesanan">
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
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
<<<<<<< HEAD

        // Modal CRUD Logic
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

        function formatNumberWithCommas(value) {
            const digitsOnly = String(value ?? '').replace(/\D/g, '');
            if (!digitsOnly) return '';
            return digitsOnly.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        if (inputTotalHarga) {
            inputTotalHarga.addEventListener('input', function () {
                this.value = formatNumberWithCommas(this.value);
            });
        }

        function syncJadwalService() {
            if (inputTanggalService && inputJamService && inputJadwalService) {
                const tgl = inputTanggalService.value || defaultToday;
                const jam = inputJamService.value || '09:00';
                inputJadwalService.value = tgl + 'T' + jam;
            }
        }

        if (inputTanggalService) inputTanggalService.addEventListener('change', syncJadwalService);
        if (inputJamService) inputJamService.addEventListener('change', syncJadwalService);

        if (crudForm) {
            crudForm.addEventListener('submit', function () {
                syncJadwalService();
                if (inputTotalHarga) {
                    inputTotalHarga.value = inputTotalHarga.value.replace(/\D/g, '');
                }
            });
        }

        const opsiLayanan = [
            'Servis Berkala',
            'Ganti Oli',
            'Tune Up Mesin',
            'Servis Rem',
            'Servis CVT / Transmisi',
            'Ganti Ban / Tambal Ban',
            'Cek Kelistrikan & Aki',
            'Turun Mesin / Overhaul',
        ];

        const opsiProduk = [
            'Oli Mesin',
            'Oli Gardan / Transmisi',
            'Kampas Rem',
            'Filter Oli / Filter Udara',
            'Busi',
            'Aki (Accu)',
            'Ban Luar / Ban Dalam',
            'V-Belt / Rantai',
            'Lampu LED / Bohlam',
            'Cairan Pendingin (Coolant)',
        ];

        function updateItemLabel(selectedValue = '') {
            const isProduk = inputKategori.value === 'produk';
            labelNamaItem.textContent = isProduk ? 'Nama Produk' : 'Nama Layanan';
            const daftarOpsi = isProduk ? opsiProduk : opsiLayanan;

            inputNamaLayanan.innerHTML = '';
            daftarOpsi.forEach((item) => {
                const opt = document.createElement('option');
                opt.value = item;
                opt.textContent = item;
                inputNamaLayanan.appendChild(opt);
            });

            if (selectedValue) {
                if (!daftarOpsi.includes(selectedValue)) {
                    const customOpt = document.createElement('option');
                    customOpt.value = selectedValue;
                    customOpt.textContent = selectedValue;
                    inputNamaLayanan.appendChild(customOpt);
                }
                inputNamaLayanan.value = selectedValue;
            } else {
                inputNamaLayanan.value = daftarOpsi[0];
            }
        }

        function openCreateModal() {
            crudModalTitle.textContent = 'Tambah Data';
            crudForm.action = "{{ route('dashboard.pesanan.store') }}";
            crudFormMethod.value = 'POST';
            inputNamaPelanggan.value = '';
            inputKategori.value = activeCategory;
            updateItemLabel();
            inputTanggalService.value = defaultToday;
            inputJamService.value = '09:00';
            syncJadwalService();
            inputTotalHarga.value = '';
            inputStatus.value = 'baru';
            crudModal.classList.add('active');
        }

        function openEditModal(data) {
            crudModalTitle.textContent = 'Edit Data #' + (data.nomor_urut ?? data.id);
            crudForm.action = data.update_url;
            crudFormMethod.value = 'PUT';
            inputNamaPelanggan.value = data.nama_pelanggan;
            inputKategori.value = data.kategori || 'layanan';
            updateItemLabel(data.nama_layanan);

            const rawJadwal = data.jadwal_service || '';
            const parts = rawJadwal.split('T');
            inputTanggalService.value = parts[0] || defaultToday;
            let rawHour = parts[1] ? parseInt(parts[1].substring(0, 2), 10) : 9;
            if (isNaN(rawHour)) rawHour = 9;
            const clampedHour = Math.min(22, Math.max(8, rawHour));
            inputJamService.value = String(clampedHour).padStart(2, '0') + ':00';
            syncJadwalService();

            inputTotalHarga.value = formatNumberWithCommas(Math.round(Number(data.total_harga || 0)));
            inputStatus.value = data.status;
            crudModal.classList.add('active');
        }

        function closeCrudModal() {
            crudModal.classList.remove('active');
        }
=======
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
    </script>
@endpush

<<<<<<< HEAD
    <x-logout-modal />
</body>
</html>
=======
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
