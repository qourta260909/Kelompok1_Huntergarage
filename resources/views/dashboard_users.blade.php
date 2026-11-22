<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengguna - Hunter Garage</title>
    @vite('resources/css/dashboard.css')
    <style>
        .controls-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-top: 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .controls-left {
            display: flex;
            align-items: center;
            gap: 14px;
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
            width: 240px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            font-size: 13.5px;
            color: #18181b;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        .search-box-wrapper input[type="text"].search-input::placeholder {
            color: #94a3b8;
        }
        .role-filter-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding: 10px 38px 10px 14px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2352525b' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: #18181b;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            cursor: pointer;
        }
        .btn-add-primary {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 11px 22px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }
        .btn-add-primary:hover {
            background-color: #27272a;
            transform: translateY(-1px);
        }
        .catalog-card {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.035);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .catalog-card-header {
            padding: 24px 32px 18px;
            border-bottom: 1px solid #f1f5f9;
        }
        .catalog-card-title {
            font-size: 19px;
            font-weight: 800;
            color: #09090b;
            margin-bottom: 4px;
        }
        .catalog-card-subtitle {
            font-size: 13.5px;
            color: #64748b;
            font-weight: 500;
        }
        .catalog-card thead th {
            text-align: left;
            padding: 16px 20px;
            font-size: 13px;
            font-weight: 700;
            color: #52525b;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }
        .catalog-card tbody td {
            padding: 15px 20px;
            font-size: 13.5px;
            font-weight: 600;
            color: #18181b;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .catalog-card thead th:first-child,
        .catalog-card tbody td:first-child {
            padding-left: 32px;
        }
        .catalog-card thead th:last-child,
        .catalog-card tbody td:last-child {
            padding-right: 32px;
            text-align: center !important;
        }
        .password-hash-text {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 12px;
            color: #71717a;
            font-weight: 500;
        }
        .alamat-cell-text {
            max-width: 240px;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #3f3f46;
            font-weight: 500;
        }
        .badge-role-admin {
            display: inline-block;
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
            font-size: 12px;
            font-weight: 800;
            padding: 4px 14px;
            border-radius: 9999px;
            text-transform: lowercase;
        }
        .badge-role-user {
            display: inline-block;
            background-color: #f4f4f5;
            color: #27272a;
            border: 1px solid #d4d4d8;
            font-size: 12px;
            font-weight: 800;
            padding: 4px 14px;
            border-radius: 9999px;
            text-transform: lowercase;
        }
        .action-btns {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: nowrap;
        }
        .btn-pill-edit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 32px;
            white-space: nowrap;
            gap: 5px;
            background-color: #ffffff;
            color: #000000;
            border: 1.5px solid #000000;
            padding: 0 13px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .btn-pill-edit:hover {
            background-color: #f4f4f5;
        }
        .btn-pill-delete {
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
        .btn-pill-delete:hover {
            background-color: #fef2f2;
        }
        .table-pagination-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .pagination-summary {
            font-size: 13.5px;
            font-weight: 700;
            color: #52525b;
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
        /* Modal Form */
        .crud-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(9, 9, 11, 0.6);
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
            background: #ffffff;
            width: 100%;
            max-width: 500px;
            border-radius: 18px;
            padding: 26px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.22);
            max-height: 92vh;
            overflow-y: auto;
        }
        .crud-modal-title {
            font-size: 18px;
            font-weight: 800;
            color: #09090b;
            margin-bottom: 18px;
        }
        .form-group {
            margin-bottom: 14px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #27272a;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d4d4d8;
            border-radius: 10px;
            font-size: 14px;
            color: #09090b;
            font-family: inherit;
        }
        .form-control:focus {
            outline: 2px solid #000000;
            border-color: #000000;
        }
        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-right: 38px;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2352525b' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px 16px;
            cursor: pointer;
        }
        textarea.form-control {
            min-height: 78px;
            resize: vertical;
        }
        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .form-help-text {
            font-size: 11.5px;
            color: #71717a;
            margin-top: 4px;
        }
        .crud-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 22px;
        }
        .btn-cancel-crud {
            background: #f1f5f9;
            color: #1e293b;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-save-crud {
            background: #000000;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
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

            <header class="header-top">
                <div>
                    <h2 class="page-title">Pengguna</h2>
                    <p class="page-subtitle">Kelola akun pelanggan &amp; admin beserta alamat tetap pengiriman</p>
                </div>

                <x-admin-dropdown />
            </header>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <div class="controls-bar">
                <div class="controls-left">
                    <div class="search-box-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="searchInput" class="search-input" placeholder="Cari nama atau email...">
                    </div>
                    <select id="roleFilterSelect" class="role-filter-select" aria-label="Filter Peran">
                        <option value="all" {{ ($roleFilter ?? 'all') === 'all' ? 'selected' : '' }}>Peran: Semua</option>
                        <option value="admin" {{ ($roleFilter ?? 'all') === 'admin' ? 'selected' : '' }}>Peran: Admin</option>
                        <option value="user" {{ ($roleFilter ?? 'all') === 'user' ? 'selected' : '' }}>Peran: Pelanggan</option>
                    </select>
                </div>
                <button type="button" class="btn-add-primary" onclick="openCreateModal()">+ Tambah Pengguna</button>
            </div>

            <div class="catalog-card">
                <div class="catalog-card-header">
                    <div class="catalog-card-title">Daftar Pengguna</div>
                    <div class="catalog-card-subtitle">Akun yang terdaftar beserta nomor telepon dan alamat tetap untuk pemesanan produk</div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Kata Sandi</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody">
                            @forelse ($daftarUsers ?? [] as $usr)
                                <tr class="user-row" data-role="{{ $usr->role ?? 'user' }}">
                                    <td>{{ $usr->name }}</td>
                                    <td>{{ $usr->email }}</td>
                                    <td>
                                        <span class="password-hash-text" title="Terenkripsi">{{ \Illuminate\Support\Str::limit($usr->password, 22, '...') }}</span>
                                    </td>
                                    <td>{{ $usr->no_telepon ?: '-' }}</td>
                                    <td>
                                        <span class="alamat-cell-text" title="{{ $usr->alamat ?: '-' }}">{{ $usr->alamat ?: '-' }}</span>
                                    </td>
                                    <td>
                                        @if (($usr->role ?? 'user') === 'admin')
                                            <span class="badge-role-admin">admin</span>
                                        @else
                                            <span class="badge-role-user">pelanggan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <button
                                                type="button"
                                                class="btn-pill-edit"
                                                onclick="openEditModal({{ json_encode([
                                                    'id' => $usr->id,
                                                    'name' => $usr->name,
                                                    'email' => $usr->email,
                                                    'no_telepon' => $usr->no_telepon ?? '',
                                                    'alamat' => $usr->alamat ?? '',
                                                    'role' => $usr->role ?? 'user',
                                                    'update_url' => route('dashboard.users.update', $usr->id),
                                                ]) }})"
                                            >
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 20h9"/>
                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                </svg>
                                                Edit
                                            </button>

                                            <button
                                                type="button"
                                                class="btn-pill-delete"
                                                onclick="openDeleteUserModal({{ json_encode([
                                                    'name' => $usr->name,
                                                    'destroy_url' => route('dashboard.users.destroy', $usr->id),
                                                ]) }})"
                                            >
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyServerRow">
                                    <td colspan="7" class="empty-state-cell">
                                        <div class="empty-state-box">
                                            <div class="empty-state-title">Belum Ada Data Pengguna</div>
                                            <div class="empty-state-sub">Klik tombol "+ Tambah Pengguna" untuk membuat akun baru.</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="emptyFilterRow" style="display:none;">
                                <td colspan="7" class="empty-state-cell">
                                    <div class="empty-state-box">
                                        <div class="empty-state-title">Pengguna Tidak Ditemukan</div>
                                        <div class="empty-state-sub">Tidak ada akun yang cocok dengan filter atau kata kunci pencarian ini.</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-pagination-footer">
                    <div class="pagination-summary" id="paginationSummary">Menampilkan 0 dari 0 Pengguna</div>
                    <div class="pagination-controls" id="paginationControls"></div>
                </div>
            </div>

        </main>
    </div>

    <!-- Modal Tambah / Edit Pengguna -->
    <div id="crudUserModal" class="crud-modal-overlay" aria-hidden="true">
        <div class="crud-modal-card">
            <h3 id="crudModalTitle" class="crud-modal-title">Tambah Pengguna</h3>
            <form id="crudUserForm" method="POST" action="{{ route('dashboard.users.store') }}">
                @csrf
                <input type="hidden" name="_method" id="crudFormMethod" value="POST">

                <div class="form-group">
                    <label for="inputName">Nama Lengkap</label>
                    <input type="text" id="inputName" name="name" class="form-control" placeholder="Contoh: Budi Santoso" required>
                </div>

                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Contoh: budi@gmail.com" required>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="inputPassword">Kata Sandi</label>
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Min. 6 karakter">
                        <div class="form-help-text" id="passwordHelpText">Wajib diisi untuk akun baru.</div>
                    </div>

                    <div class="form-group">
                        <label for="inputRole">Peran</label>
                        <select id="inputRole" name="role" class="form-control" required>
                            <option value="user">Pelanggan</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputNoTelepon">No. Telepon / WhatsApp</label>
                    <input type="text" id="inputNoTelepon" name="no_telepon" class="form-control" placeholder="Contoh: 081234567890">
                </div>

                <div class="form-group">
                    <label for="inputAlamat">Alamat Tetap</label>
                    <textarea id="inputAlamat" name="alamat" class="form-control" placeholder="Masukkan alamat lengkap (otomatis terisi saat akun memesan produk)..."></textarea>
                </div>

                <div class="crud-modal-actions">
                    <button type="submit" class="btn-save-crud">Simpan</button>
                    <button type="button" class="btn-cancel-crud" onclick="closeCrudModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Pengguna (Sama seperti Modal Keluar) -->
    <div id="deleteUserConfirmModal" class="logout-modal-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="deleteUserModalTitle" aria-describedby="deleteUserModalDesc">
        <div class="logout-modal-backdrop" onclick="closeDeleteUserModal()"></div>
        <div class="logout-modal-card">
            <div class="logout-modal-icon-wrapper">
                <div class="logout-modal-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14z" />
                    </svg>
                </div>
            </div>

            <h3 id="deleteUserModalTitle" class="logout-modal-title">Konfirmasi Hapus Pengguna</h3>
            <p id="deleteUserModalDesc" class="logout-modal-desc">
                Apakah Anda yakin ingin menghapus akun pengguna ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="logout-modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeDeleteUserModal()">
                    Batal
                </button>
                <form id="deleteUserModalForm" method="POST" action="" style="margin: 0; flex: 1; display: flex;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-modal-confirm" style="width: 100%;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14z" />
                        </svg>
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const roleFilterSelect = document.getElementById('roleFilterSelect');
        const usersTableBody = document.getElementById('usersTableBody');
        const userRows = Array.from(document.querySelectorAll('.user-row'));
        const emptyFilterRow = document.getElementById('emptyFilterRow');
        const emptyServerRow = document.getElementById('emptyServerRow');
        const paginationControls = document.getElementById('paginationControls');
        const paginationSummary = document.getElementById('paginationSummary');
        const ITEMS_PER_PAGE = 8;
        let currentPage = 1;

        function renderPagination(totalItems, totalPages, startItem, endItem) {
            if (paginationSummary) {
                paginationSummary.textContent = totalItems === 0
                    ? 'Menampilkan 0 dari 0 Pengguna'
                    : `Menampilkan ${startItem}-${endItem} dari ${totalItems} Pengguna`;
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
                        filterUsers(false);
                    }
                });
            });
        }

        function filterUsers(resetPage = true) {
            if (resetPage) currentPage = 1;

            if (emptyServerRow) {
                renderPagination(0, 1, 0, 0);
                return;
            }

            const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
            const roleFilter = roleFilterSelect ? roleFilterSelect.value : 'all';

            const matchedRows = userRows.filter((row) => {
                const rowRole = row.dataset.role || 'user';
                const matchRole = roleFilter === 'all' || rowRole === roleFilter;
                const matchText = row.textContent.toLowerCase().includes(query);
                return matchRole && matchText;
            });

            const totalItems = matchedRows.length;
            const totalPages = Math.max(1, Math.ceil(totalItems / ITEMS_PER_PAGE));
            if (currentPage > totalPages) currentPage = totalPages;

            userRows.forEach((row) => {
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

        if (searchInput) searchInput.addEventListener('input', () => filterUsers(true));
        if (roleFilterSelect) {
            roleFilterSelect.addEventListener('change', function () {
                const selectedRole = this.value;
                const url = new URL(@json(route('dashboard.users')), window.location.origin);
                if (selectedRole && selectedRole !== 'all') {
                    url.searchParams.set('role', selectedRole);
                }
                window.location.href = url.toString();
            });
        }
        filterUsers(true);

        // Modal Logic
        const crudModal = document.getElementById('crudUserModal');
        const crudForm = document.getElementById('crudUserForm');
        const crudModalTitle = document.getElementById('crudModalTitle');
        const crudFormMethod = document.getElementById('crudFormMethod');
        const inputName = document.getElementById('inputName');
        const inputEmail = document.getElementById('inputEmail');
        const inputPassword = document.getElementById('inputPassword');
        const passwordHelpText = document.getElementById('passwordHelpText');
        const inputRole = document.getElementById('inputRole');
        const inputNoTelepon = document.getElementById('inputNoTelepon');
        const inputAlamat = document.getElementById('inputAlamat');

        function openCreateModal() {
            crudModalTitle.textContent = 'Tambah Pengguna';
            crudForm.action = "{{ route('dashboard.users.store') }}";
            crudFormMethod.value = 'POST';
            inputName.value = '';
            inputEmail.value = '';
            inputPassword.value = '';
            inputPassword.required = true;
            if (passwordHelpText) passwordHelpText.textContent = 'Wajib diisi (min. 6 karakter).';
            inputRole.value = 'user';
            inputNoTelepon.value = '';
            inputAlamat.value = '';
            crudModal.classList.add('active');
        }

        function openEditModal(data) {
            crudModalTitle.textContent = 'Edit Pengguna';
            crudForm.action = data.update_url;
            crudFormMethod.value = 'PUT';
            inputName.value = data.name || '';
            inputEmail.value = data.email || '';
            inputPassword.value = '';
            inputPassword.required = false;
            if (passwordHelpText) passwordHelpText.textContent = 'Kosongkan jika tidak ingin mengubah password.';
            inputRole.value = data.role || 'user';
            inputNoTelepon.value = data.no_telepon || '';
            inputAlamat.value = data.alamat || '';
            crudModal.classList.add('active');
        }

        function closeCrudModal() {
            crudModal.classList.remove('active');
        }

        const deleteUserModal = document.getElementById('deleteUserConfirmModal');
        const deleteUserForm = document.getElementById('deleteUserModalForm');
        const deleteUserDesc = document.getElementById('deleteUserModalDesc');

        function openDeleteUserModal(data) {
            if (!deleteUserModal || !deleteUserForm) return;
            deleteUserForm.action = data.destroy_url;
            if (deleteUserDesc) {
                deleteUserDesc.textContent = `Apakah Anda yakin ingin menghapus akun "${data.name}"? Tindakan ini tidak dapat dibatalkan.`;
            }
            deleteUserModal.classList.add('active');
            deleteUserModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteUserModal() {
            if (!deleteUserModal) return;
            deleteUserModal.classList.remove('active');
            deleteUserModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeDeleteUserModal();
            }
        });
    </script>

    <x-logout-modal />
</body>
</html>
