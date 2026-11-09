@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')
    @php
        $totalRiwayatLayanan = $layanan->sum('riwayat_layanan_count');
    @endphp

    <header class="page-heading">
        <div>
            <h1>Layanan</h1>
            <p>Kelola daftar layanan, durasi, dan harga yang akan tampil pada form pemesanan pelanggan.</p>
        </div>
    </header>

    @if (session('success'))
        <div class="alert-success" role="status">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert-error" role="alert">{{ $errors->first() }}</div>
    @endif

    <section class="stats-grid" aria-label="Ringkasan layanan">
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Jenis layanan</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.2-3.2a6 6 0 0 1-7.9 7.9l-6.8 6.8a2.1 2.1 0 0 1-3-3l6.8-6.8a6 6 0 0 1 7.9-7.9z"/></svg></span></div>
            <strong class="stat-value">{{ number_format($layanan->count(), 0, ',', '.') }}</strong>
            <span class="stat-note">Layanan terdaftar</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Riwayat pengerjaan</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 2.6-6.4L3 8"/><path d="M3 3v5h5m4-1v5l3 2"/></svg></span></div>
            <strong class="stat-value">{{ number_format($totalRiwayatLayanan, 0, ',', '.') }}</strong>
            <span class="stat-note">Pengerjaan tercatat</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Rata-rata harga</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 2v20M17 6.5c0-1.4-1.7-2.5-4-2.5H10a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-3c-2.3 0-4-1.1-4-2.5"/></svg></span></div>
            <strong class="stat-value">Rp {{ number_format($layanan->avg('harga') ?? 0, 0, ',', '.') }}</strong>
            <span class="stat-note">Dari layanan terdaftar</span>
        </article>
    </section>

    <div class="page-toolbar">
        <div></div>
        <div class="toolbar-controls">
            <label class="sr-only" for="searchLayananInput">Cari layanan</label>
            <input type="search" id="searchLayananInput" class="search-input" placeholder="Cari nama atau deskripsi layanan">
            <button type="button" class="button-primary" onclick="openCreateLayananModal()">
                <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                Tambah layanan
            </button>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Daftar layanan</h2>
                <p class="panel-description">Pilihan layanan yang tersedia untuk form pelanggan (user).</p>
            </div>
        </div>
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th>Deskripsi</th>
                        <th>Estimasi durasi</th>
                        <th>Harga</th>
                        <th>Pengerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="layananTableBody">
                    @forelse ($layanan as $item)
                        <tr class="layanan-row">
                            <td><span class="table-primary">{{ $item->nama_layanan }}</span></td>
                            <td>{{ $item->deskripsi ?: 'Deskripsi belum tersedia' }}</td>
                            <td>{{ $item->estimasi_durasi ?: 'Belum ditentukan' }}</td>
                            <td class="numeric">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="numeric">{{ number_format($item->riwayat_layanan_count, 0, ',', '.') }} kali</td>
                            <td>
                                <div class="action-buttons">
                                    <button
                                        type="button"
                                        class="button-secondary"
                                        onclick="openEditLayananModal({{ json_encode([
                                            'id' => $item->id,
                                            'nama_layanan' => $item->nama_layanan,
                                            'deskripsi' => $item->deskripsi ?? '',
                                            'estimasi_durasi' => $item->estimasi_durasi ?? '',
                                            'harga' => (float) $item->harga,
                                            'update_url' => route('dashboard.layanan.update', $item->id),
                                        ]) }})"
                                    >Edit</button>
                                    <form method="POST" action="{{ route('dashboard.layanan.destroy', $item->id) }}" onsubmit="return confirm('Yakin ingin menghapus layanan {{ addslashes($item->nama_layanan) }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyLayananServerRow">
                            <td colspan="6">
                                <div class="empty-state">
                                    <strong>Belum ada layanan terdaftar.</strong>
                                    <p>Tambahkan layanan baru untuk ditampilkan pada form pemesanan pelanggan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    <tr id="emptyLayananFilterRow" hidden>
                        <td colspan="6">
                            <div class="empty-state">
                                <strong>Tidak ada layanan yang cocok.</strong>
                                <p>Coba kata kunci pencarian lain.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div id="crudLayananModal" class="crud-modal-overlay" aria-hidden="true">
        <button class="logout-modal-backdrop" type="button" aria-label="Tutup formulir layanan" onclick="closeLayananModal()"></button>
        <div class="crud-modal-card" role="dialog" aria-modal="true" aria-labelledby="crudLayananModalTitle">
            <h2 id="crudLayananModalTitle" class="crud-modal-title">Tambah layanan</h2>
            <form id="crudLayananForm" method="POST" action="{{ route('dashboard.layanan.store') }}">
                @csrf
                <input type="hidden" name="_method" id="crudLayananFormMethod" value="POST">

                <div class="form-group">
                    <label for="inputNamaLayanan">Nama layanan</label>
                    <input type="text" id="inputNamaLayanan" name="nama_layanan" class="form-control" placeholder="Contoh: Servis Berkala / Ganti Oli" required>
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiLayanan">Deskripsi layanan</label>
                    <textarea id="inputDeskripsiLayanan" name="deskripsi" class="form-control" rows="3" placeholder="Penjelasan singkat layanan untuk pelanggan"></textarea>
                </div>
                <div class="form-row-2">
                    <div class="form-group">
                        <label for="inputDurasiLayanan">Estimasi durasi</label>
                        <input type="text" id="inputDurasiLayanan" name="estimasi_durasi" class="form-control" placeholder="Contoh: 30 menit / 1 jam">
                    </div>
                    <div class="form-group">
                        <label for="inputHargaLayanan">Harga (Rp)</label>
                        <input type="text" inputmode="numeric" id="inputHargaLayanan" name="harga" class="form-control" placeholder="Contoh: 75,000" autocomplete="off" required>
                    </div>
                </div>
                <div class="crud-modal-actions">
                    <button type="button" class="btn-cancel-crud" onclick="closeLayananModal()">Batal</button>
                    <button type="submit" class="btn-save-crud">Simpan layanan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const searchLayananInput = document.getElementById('searchLayananInput');
        const layananRows = document.querySelectorAll('.layanan-row');
        const emptyLayananFilterRow = document.getElementById('emptyLayananFilterRow');
        const emptyLayananServerRow = document.getElementById('emptyLayananServerRow');

        if (searchLayananInput) {
            searchLayananInput.addEventListener('input', () => {
                if (emptyLayananServerRow) return;
                const query = searchLayananInput.value.toLowerCase().trim();
                let visibleCount = 0;

                layananRows.forEach((row) => {
                    const matches = row.textContent.toLowerCase().includes(query);
                    row.hidden = !matches;
                    if (matches) visibleCount++;
                });

                emptyLayananFilterRow.hidden = visibleCount > 0;
            });
        }

        const crudLayananModal = document.getElementById('crudLayananModal');
        const crudLayananForm = document.getElementById('crudLayananForm');
        const crudLayananModalTitle = document.getElementById('crudLayananModalTitle');
        const crudLayananFormMethod = document.getElementById('crudLayananFormMethod');
        const inputNamaLayanan = document.getElementById('inputNamaLayanan');
        const inputDeskripsiLayanan = document.getElementById('inputDeskripsiLayanan');
        const inputDurasiLayanan = document.getElementById('inputDurasiLayanan');
        const inputHargaLayanan = document.getElementById('inputHargaLayanan');
        let previousLayananFocus;

        function formatHargaWithCommas(value) {
            const digitsOnly = String(value ?? '').replace(/\D/g, '');
            return digitsOnly.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        function showLayananModal() {
            previousLayananFocus = document.activeElement;
            crudLayananModal.classList.add('active');
            crudLayananModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            inputNamaLayanan.focus();
        }

        function openCreateLayananModal() {
            crudLayananModalTitle.textContent = 'Tambah layanan';
            crudLayananForm.action = "{{ route('dashboard.layanan.store') }}";
            crudLayananFormMethod.value = 'POST';
            inputNamaLayanan.value = '';
            inputDeskripsiLayanan.value = '';
            inputDurasiLayanan.value = '';
            inputHargaLayanan.value = '';
            showLayananModal();
        }

        function openEditLayananModal(data) {
            crudLayananModalTitle.textContent = `Edit layanan: ${data.nama_layanan}`;
            crudLayananForm.action = data.update_url;
            crudLayananFormMethod.value = 'PUT';
            inputNamaLayanan.value = data.nama_layanan || '';
            inputDeskripsiLayanan.value = data.deskripsi || '';
            inputDurasiLayanan.value = data.estimasi_durasi || '';
            inputHargaLayanan.value = formatHargaWithCommas(Math.round(Number(data.harga || 0)));
            showLayananModal();
        }

        function closeLayananModal() {
            crudLayananModal.classList.remove('active');
            crudLayananModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (previousLayananFocus instanceof HTMLElement) previousLayananFocus.focus();
        }

        inputHargaLayanan.addEventListener('input', () => {
            inputHargaLayanan.value = formatHargaWithCommas(inputHargaLayanan.value);
        });

        crudLayananForm.addEventListener('submit', () => {
            inputHargaLayanan.value = inputHargaLayanan.value.replace(/\D/g, '');
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && crudLayananModal.classList.contains('active')) {
                closeLayananModal();
            }
        });
    </script>
@endpush

