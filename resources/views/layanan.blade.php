<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hunter Garage - Halaman Layanan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/user.css')
    <style>
        .booking-field.is-dependent-faded {
            opacity: 0.45;
            transition: opacity 0.2s ease;
        }
        .booking-field.is-dependent-faded .booking-input,
        .booking-field.is-dependent-faded .booking-select {
            background-color: #f4f4f5;
            border-color: #d4d4d8;
            color: #a1a1aa;
            cursor: not-allowed;
        }
        .booking-input.is-readonly-locked {
            background-color: #f4f4f5;
            border-color: #d4d4d8;
            color: #52525b;
            cursor: not-allowed;
        }
        .booking-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }
        .btn-toggle-edit-telepon {
            background: transparent;
            border: none;
            padding: 0;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            color: #111111;
            text-decoration: underline;
            cursor: pointer;
        }
        .btn-toggle-edit-telepon:hover {
            color: #52525b;
        }
        .stepper-item.is-step-faded {
            opacity: 0.42;
            cursor: not-allowed;
        }
        .booking-next-btn.is-btn-faded {
            opacity: 0.45;
            background-color: #71717a;
            cursor: not-allowed;
            box-shadow: none !important;
            transform: none !important;
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Hunter Garage" class="brand-logo">
                <div class="brand-text">
                    <span class="brand-title">Hunter Garage</span>
                    <span class="brand-subtitle">Servis dan Suku Cadang</span>
                </div>
            </a>

            <nav class="nav" aria-label="Navigasi utama">
                <div class="nav-links">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    <a class="nav-link {{ request()->routeIs('user.layanan') ? 'active' : '' }}" href="{{ route('user.layanan') }}">Layanan</a>
                    <a class="nav-link {{ request()->routeIs('user.produk') ? 'active' : '' }}" href="{{ route('user.produk') }}">Produk</a>
                </div>
                @auth
                    <div class="user-dropdown" id="userDropdown">
                        <button type="button" class="user-dropdown-btn" id="userDropdownBtn" aria-expanded="false" aria-haspopup="true">
                            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span class="user-name">{{ explode(' ', trim(Auth::user()->name))[0] }}</span>
                            <svg class="dropdown-chevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <div class="user-dropdown-menu" id="userDropdownMenu" role="menu">
                            <div class="dropdown-user-info">
                                <strong class="dropdown-user-name">{{ Auth::user()->name }}</strong>
                                <span class="dropdown-user-email">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('user.pesanan') }}" class="dropdown-item" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <span>Pesanan Saya</span>
                            </a>
                            <a href="{{ route('user.pesanan', ['tab' => 'jadwal']) }}" class="dropdown-item" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Booking Saya</span>
                            </a>
                            <button type="button" class="dropdown-item" role="menuitem" onclick="openUserProfileModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Edit Profil</span>
                            </button>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item dropdown-item-danger" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="btn-masuk" href="{{ route('login') }}">Masuk</a>
                @endauth
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="booking-wrapper">
                @if (session('success'))
                    <div class="user-alert user-alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="user-alert user-alert-error">{{ $errors->first() }}</div>
                @endif

                @if (($layananAktif ?? collect())->isEmpty())
                    <section class="booking-card" aria-live="polite">
                        <div class="empty-catalog-box">
                            <div class="empty-catalog-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                </svg>
                            </div>
                            <h1 class="empty-catalog-title">Belum Ada Layanan Tersedia</h1>
                            <p class="empty-catalog-desc">Layanan akan muncul otomatis disini jika tersedia.</p>
                            <a href="{{ route('home') }}" class="booking-next-btn" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center; margin-top:18px;">Kembali ke Beranda</a>
                        </div>
                    </section>
                @else
                <!-- Stepper -->
                <div class="stepper @guest is-locked @endguest" aria-label="Tahapan pemesanan layanan">
                    <button type="button" class="stepper-item active" data-step-target="1" onclick="goToStep(1)">
                        <span class="stepper-circle">1</span>
                        <span class="stepper-label">Kendaraan</span>
                    </button>
                    <div class="stepper-line"></div>
                    <button type="button" class="stepper-item" data-step-target="2" onclick="goToStep(2)">
                        <span class="stepper-circle">2</span>
                        <span class="stepper-label">Layanan</span>
                    </button>
                    <div class="stepper-line"></div>
                    <button type="button" class="stepper-item" data-step-target="3" onclick="goToStep(3)">
                        <span class="stepper-circle">3</span>
                        <span class="stepper-label">Jadwal &amp; Kontak</span>
                    </button>
                    <div class="stepper-line"></div>
                    <button type="button" class="stepper-item" data-step-target="4" onclick="goToStep(4)">
                        <span class="stepper-circle">4</span>
                        <span class="stepper-label">Konfirmasi</span>
                    </button>
                </div>

                <!-- Card Form -->
                <section class="booking-card @guest is-guest-locked @endguest" aria-live="polite">
                    @guest
                        <div class="booking-auth-overlay" role="dialog" aria-label="Masuk diperlukan">
                            <div class="booking-auth-box">
                                <div class="booking-auth-icon" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </div>
                                <h2 class="booking-auth-title">Masuk Terlebih Dahulu</h2>
                                <p class="booking-auth-desc">Silakan login ke akun Hunter Garage Anda untuk mengisi formulir dan melakukan pemesanan layanan servis.</p>
                                <div class="booking-auth-actions">
                                    <a href="{{ route('login') }}" class="booking-next-btn" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center; width:100%;">Masuk untuk Booking</a>
                                </div>
                            </div>
                        </div>
                    @endguest
                    <!-- STEP 1: DATA KENDARAAN -->
                    <div class="booking-step-panel active" id="stepPanel1" data-step="1">
                        <div class="booking-card-header">
                            <p class="booking-step-indicator">Langkah 1 Dari 4</p>
                            <h1 class="booking-card-title">Data Kendaraan</h1>
                        </div>

                        <div class="booking-form">
                            @php
                                $kendaraanDbList = ($daftarKendaraan ?? collect())->map(fn ($k) => [
                                    'merek' => $k->merek,
                                    'jenis' => $k->jenis_kendaraan ?: 'Matic',
                                    'model' => $k->model,
                                ])->values();
                                $merekUnikList = $kendaraanDbList->pluck('merek')->unique()->values();
                                $jenisUnikList = $kendaraanDbList->pluck('jenis')->unique()->values();
                                if ($jenisUnikList->isEmpty()) {
                                    $jenisUnikList = collect(['Matic', 'Bebek', 'Sport', 'Trail']);
                                }
                            @endphp
                            <div class="booking-grid">
                                <div class="booking-field">
                                    <label for="merek" class="booking-label">Merek Kendaraan</label>
                                    <div class="booking-select-wrap">
                                        <select id="merek" name="merek" class="booking-input booking-select" required>
                                            <option value="" disabled selected>Pilih merek kendaraan</option>
                                            @foreach ($merekUnikList as $merekItem)
                                                <option value="{{ $merekItem }}">{{ $merekItem }}</option>
                                            @endforeach
                                            <option value="__LAINNYA__">+ Tambah Merek Baru...</option>
                                        </select>
                                        <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        id="merek_baru"
                                        class="booking-input"
                                        placeholder="Ketik nama merek kendaraan baru..."
                                        style="display:none; margin-top:8px;"
                                    >
                                </div>

                                <div class="booking-field is-dependent-faded" id="fieldJenisKendaraan">
                                    <label for="jenis_kendaraan" class="booking-label">Jenis Kendaraan</label>
                                    <div class="booking-select-wrap">
                                        <select id="jenis_kendaraan" name="jenis_kendaraan" class="booking-input booking-select" required disabled>
                                            <option value="" disabled selected>Pilih jenis kendaraan</option>
                                            @foreach ($jenisUnikList as $jenisItem)
                                                <option value="{{ $jenisItem }}">{{ $jenisItem }}</option>
                                            @endforeach
                                            <option value="__LAINNYA__">+ Tambah Jenis Baru...</option>
                                        </select>
                                        <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        id="jenis_kendaraan_baru"
                                        class="booking-input"
                                        placeholder="Ketik jenis kendaraan baru (cth: Skuter Listrik)..."
                                        style="display:none; margin-top:8px;"
                                    >
                                </div>

                                <div class="booking-field is-dependent-faded" id="fieldModelKendaraan">
                                    <label for="model" class="booking-label">Model / Tipe</label>
                                    <div class="booking-select-wrap">
                                        <select id="model" name="model" class="booking-input booking-select" required disabled>
                                            <option value="" disabled selected>Pilih merek terlebih dahulu</option>
                                        </select>
                                        <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        id="model_baru"
                                        class="booking-input"
                                        placeholder="Ketik nama model / tipe kendaraan baru..."
                                        style="display:none; margin-top:8px;"
                                    >
                                </div>

                                <div class="booking-field is-dependent-faded" id="fieldTahunKendaraan">
                                    <label for="tahun" class="booking-label">Tahun</label>
                                    <div class="booking-select-wrap">
                                        <select id="tahun" name="tahun" class="booking-input booking-select" required disabled>
                                            <option value="" disabled selected>Pilih tahun kendaraan</option>
                                            @for ($year = 2026; $year >= 1950; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                        <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>

                                <div class="booking-field is-dependent-faded" id="fieldPlatKendaraan" style="grid-column: 1 / -1;">
                                    <label for="plat_nomor" class="booking-label">Plat Nomor</label>
                                    <input
                                        type="text"
                                        id="plat_nomor"
                                        name="plat_nomor"
                                        class="booking-input"
                                        placeholder="Masukkan plat nomor kendaraan (Contoh: DA 1234 AB)"
                                        required
                                        disabled
                                    >
                                </div>
                            </div>

                            <p class="booking-note">Jika merek, jenis, atau model kendaraan Anda belum ada di daftar, pilih <strong>+ Tambah Baru</strong> dan sistem akan otomatis menyimpannya ke database.</p>

                            <hr class="booking-divider">

                            <div class="booking-actions">
                                <a href="{{ route('home') }}" class="booking-back-link">Kembali ke beranda</a>
                                <button type="button" class="booking-next-btn" onclick="nextStep()">Lanjut ke layanan</button>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 2: PILIH LAYANAN -->
                    <div class="booking-step-panel" id="stepPanel2" data-step="2">
                        <div class="booking-card-header">
                            <p class="booking-step-indicator">Langkah 2 Dari 4</p>
                            <h2 class="booking-card-title">Pilih Layanan</h2>
                            <p class="booking-card-subtitle">Harga yang tertera merupakan estimasi jasa awal — biaya akhir menyesuaikan jenis motor &amp; pengecekan di bengkel</p>
                        </div>

                        <div class="service-option-list" role="radiogroup" aria-label="Pilihan layanan">
                            @foreach ($layananAktif as $index => $layanan)
                                @php
                                    $estimasiLayanan = $layanan->estimasi_durasi ?: ($layanan->deskripsi ?: 'Standar pengerjaan bengkel');
                                @endphp
                                <label class="service-option-card">
                                    <input
                                        type="radio"
                                        name="jenis_layanan"
                                        value="{{ $layanan->id }}"
                                        data-nama="{{ $layanan->nama_layanan }}"
                                        data-harga="{{ number_format($layanan->harga, 0, ',', '.') }}"
                                        {{ $index === 0 ? 'checked' : '' }}
                                    >
                                    <span class="service-radio-circle"></span>
                                    <span class="service-option-icon" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                        </svg>
                                    </span>
                                    <span class="service-option-content" style="flex:1;">
                                        <strong class="service-option-title">{{ $layanan->nama_layanan }}</strong>
                                        <span class="service-option-desc">Estimasi pengerjaan: {{ $estimasiLayanan }}</span>
                                    </span>
                                    <span class="service-option-price" style="text-align:right;">
                                        <span style="display:block; font-size:11px; font-weight:600; color:#71717a;">Estimasi mulai</span>
                                        ~Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        <hr class="booking-divider step2-divider">

                        <div class="booking-actions">
                            <a href="{{ route('home') }}" class="booking-back-link">Kembali ke Beranda</a>
                            <div class="booking-btn-group">
                                <button type="button" class="booking-prev-btn" onclick="prevStep()">Sebelumnya</button>
                                <button type="button" class="booking-next-btn" onclick="nextStep()">Lanjut ke jadwal</button>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 3: JADWAL DAN KONTAK -->
                    <div class="booking-step-panel" id="stepPanel3" data-step="3">
                        <div class="booking-card-header">
                            <p class="booking-step-indicator">Langkah 3 Dari 4</p>
                            <h2 class="booking-card-title">Jadwal Dan Kontak</h2>
                            <p class="booking-card-subtitle">Isi data kontak dan kunjungan anda</p>
                        </div>

                        <div class="schedule-inner-box">
                            <div class="booking-grid">
                                <div class="booking-field">
                                    <label for="nama_lengkap" class="booking-label">Nama lengkap</label>
                                    <input
                                        type="text"
                                        id="nama_lengkap"
                                        name="nama_lengkap"
                                        class="booking-input is-readonly-locked"
                                        placeholder="Masukkan Nama lengkap"
                                        value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                        readonly
                                        required
                                    >
                                </div>

                                @php
                                    $defaultUserPhone = auth()->check() ? preg_replace('/\D+/', '', (string) (auth()->user()->no_telepon ?? '')) : '';
                                    $isPhoneLocked = $defaultUserPhone !== '';
                                @endphp
                                <div class="booking-field">
                                    <div class="booking-label-row">
                                        <label for="no_telepon" class="booking-label">No.telepon</label>
                                        <button type="button" id="btnToggleEditTelepon" class="btn-toggle-edit-telepon" onclick="toggleEditNoTelepon()">
                                            {{ $isPhoneLocked ? 'Ubah No. Telepon' : 'Kunci No. Telepon' }}
                                        </button>
                                    </div>
                                    <input
                                        type="number"
                                        inputmode="numeric"
                                        id="no_telepon"
                                        name="no_telepon"
                                        class="booking-input {{ $isPhoneLocked ? 'is-readonly-locked' : '' }}"
                                        placeholder="Contoh: 082318123456"
                                        value="{{ $defaultUserPhone }}"
                                        {{ $isPhoneLocked ? 'readonly' : '' }}
                                        required
                                    >
                                </div>

                                <div class="booking-field">
                                    <label for="jam_servis" class="booking-label">Jam servis <span style="font-weight:500; color:#71717a; font-size:11.5px;">(08.00 – 22.00 WITA)</span></label>
                                    <div class="booking-select-wrap">
                                        <select id="jam_servis" name="jam_servis" class="booking-input booking-select" required>
                                            <option value="" disabled selected>Pilih jam kedatangan</option>
                                            <optgroup label="Pagi">
                                                <option value="08:00">08.00 WITA (Pagi)</option>
                                                <option value="09:00">09.00 WITA (Pagi)</option>
                                                <option value="10:00">10.00 WITA (Pagi)</option>
                                                <option value="11:00">11.00 WITA (Menjelang Siang)</option>
                                            </optgroup>
                                            <optgroup label="Siang &amp; Sore">
                                                <option value="12:00">12.00 WITA (Siang)</option>
                                                <option value="13:00">13.00 WITA (Siang)</option>
                                                <option value="14:00">14.00 WITA (Siang)</option>
                                                <option value="15:00">15.00 WITA (Sore)</option>
                                                <option value="16:00">16.00 WITA (Sore)</option>
                                                <option value="17:00">17.00 WITA (Sore)</option>
                                            </optgroup>
                                            <optgroup label="Malam">
                                                <option value="18:00">18.00 WITA (Malam)</option>
                                                <option value="19:00">19.00 WITA (Malam)</option>
                                                <option value="20:00">20.00 WITA (Malam)</option>
                                                <option value="21:00">21.00 WITA (Malam)</option>
                                                <option value="22:00">22.00 WITA (Batas Akhir)</option>
                                            </optgroup>
                                        </select>
                                        <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>

                                <div class="booking-field is-dependent-faded" id="fieldTanggalServis">
                                    <label for="tanggal_servis" class="booking-label">Tanggal servis</label>
                                    <div class="booking-input-icon-wrap">
                                        <input
                                            type="date"
                                            id="tanggal_servis"
                                            name="tanggal_servis"
                                            class="booking-input"
                                            min="{{ now()->toDateString() }}"
                                            value="{{ now()->toDateString() }}"
                                            required
                                            disabled
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="booking-divider step3-divider">

                        <div class="booking-actions">
                            <a href="{{ route('home') }}" class="booking-back-link">Kembali ke Beranda</a>
                            <div class="booking-btn-group">
                                <button type="button" class="booking-prev-btn" onclick="prevStep()">Sebelumnya</button>
                                <button type="button" class="booking-next-btn" onclick="nextStep()">Lanjut ke Konfirmasi</button>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 4: KONFIRMASI BOOKING -->
                    <div class="booking-step-panel" id="stepPanel4" data-step="4">
                        <div class="booking-card-header">
                            <p class="booking-step-indicator">Langkah 4 Dari 4</p>
                            <h2 class="booking-card-title">Konfirmasi Pemesanan</h2>
                            <p class="booking-card-subtitle">Periksa kembali data Anda sebelum mengirim pesanan</p>
                        </div>

                        <div class="confirm-summary-box">
                            <div class="confirm-grid">
                                <!-- Kendaraan -->
                                <div class="confirm-section">
                                    <div class="confirm-section-head">
                                        <h3 class="confirm-section-title">Kendaraan</h3>
                                        <button type="button" class="confirm-edit-btn" onclick="goToStep(1)">Ubah</button>
                                    </div>
                                    <div class="confirm-rows">
                                        <div class="confirm-row">
                                            <span class="confirm-key">Motor</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryMotor">-</strong>
                                        </div>
                                        <div class="confirm-row">
                                            <span class="confirm-key">Nomor polisi</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryPlat">-</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Layanan -->
                                <div class="confirm-section">
                                    <div class="confirm-section-head">
                                        <h3 class="confirm-section-title">Layanan</h3>
                                        <button type="button" class="confirm-edit-btn" onclick="goToStep(2)">Ubah</button>
                                    </div>
                                    <div class="confirm-rows">
                                        <div class="confirm-row">
                                            <span class="confirm-key">Jenis layanan</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryLayanan">-</strong>
                                        </div>
                                        <div class="confirm-row">
                                            <span class="confirm-key">Estimasi biaya</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryHarga">-</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="confirm-inner-divider">

                            <div class="confirm-grid">
                                <!-- Jadwal servis -->
                                <div class="confirm-section">
                                    <div class="confirm-section-head">
                                        <h3 class="confirm-section-title">Jadwal servis</h3>
                                        <button type="button" class="confirm-edit-btn" onclick="goToStep(3)">Ubah</button>
                                    </div>
                                    <div class="confirm-rows">
                                        <div class="confirm-row">
                                            <span class="confirm-key">Tanggal</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryTanggal">-</strong>
                                        </div>
                                        <div class="confirm-row">
                                            <span class="confirm-key">Jam</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryJam">-</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi kontak -->
                                <div class="confirm-section">
                                    <div class="confirm-section-head">
                                        <h3 class="confirm-section-title">Informasi kontak</h3>
                                        <button type="button" class="confirm-edit-btn" onclick="goToStep(3)">Ubah</button>
                                    </div>
                                    <div class="confirm-rows">
                                        <div class="confirm-row">
                                            <span class="confirm-key">Nama</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryNama">{{ auth()->check() ? auth()->user()->name : '-' }}</strong>
                                        </div>
                                        <div class="confirm-row">
                                            <span class="confirm-key">No.telepon</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryTelepon">-</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="confirm-inner-divider">

                            <div class="confirm-section">
                                <div class="confirm-section-head">
                                    <h3 class="confirm-section-title">Metode Pembayaran</h3>
                                </div>
                                <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; background:#eff6ff; border:1px solid #bfdbfe; border-radius:12px; padding:12px 16px;">
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        <span style="display:inline-flex; align-items:center; justify-content:center; padding:5px 11px; border-radius:7px; background:#00529c; color:#ffffff; font-size:12px; font-weight:800; letter-spacing:0.04em;">BCA</span>
                                        <div style="display:flex; flex-direction:column; gap:2px;">
                                            <strong style="font-size:13.5px; color:#111827;">Bayar di Tempat / Transfer Bank BCA (Setelah Servis Selesai)</strong>
                                            <span style="font-size:12.5px; font-weight:600; color:#1e40af;">Pembayaran dilakukan setelah servis selesai via tunai di bengkel atau transfer No. Rek: <strong>7896207902</strong> a/n Ahmad Qourta Zaidan</span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="navigator.clipboard.writeText('7896207902'); alert('Nomor Rekening BCA berhasil disalin!');" style="background:#ffffff; border:1px solid #93c5fd; color:#1d4ed8; font-family:inherit; font-size:12px; font-weight:700; padding:6px 12px; border-radius:8px; cursor:pointer;">
                                        Salin No. Rek
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr class="booking-divider step4-divider">

                        <div class="booking-actions">
                            <a href="{{ route('home') }}" class="booking-back-link">Kembali ke Beranda</a>
                            <div class="booking-btn-group">
                                <button type="button" class="booking-prev-btn" onclick="prevStep()">Sebelumnya</button>
                                @auth
                                    <form method="POST" action="{{ route('user.pesanan.store') }}" id="submitLayananOrderForm" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="kategori" value="layanan">
                                        <input type="hidden" name="layanan_id" id="submitLayananId" value="">
                                        <input type="hidden" name="jadwal_service" id="submitJadwalService" value="">
                                        <input type="hidden" name="merek" id="submitMerek" value="">
                                        <input type="hidden" name="jenis_kendaraan" id="submitJenisKendaraan" value="">
                                        <input type="hidden" name="model" id="submitModel" value="">
                                        <input type="hidden" name="tahun" id="submitTahun" value="">
                                        <input type="hidden" name="plat_nomor" id="submitPlatNomor" value="">
                                        <input type="hidden" name="nama_lengkap" id="submitNamaLengkap" value="">
                                        <input type="hidden" name="no_telepon" id="submitNoTelepon" value="">
                                        <button type="submit" class="booking-next-btn" id="btnConfirmBooking">Konfirmasi Pemesanan</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="booking-next-btn" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">Masuk untuk Memesan</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </section>
                @endif
            </div>
        </div>
    </main>

    <x-user-footer :layanan-aktif="$layananAktif ?? collect()" :produk-aktif="$produkAktif ?? collect()" />

    <script>
        const KENDARAAN_DB = @json($kendaraanDbList ?? []);

        function getEffectiveMerek() {
            const merekEl = document.getElementById('merek');
            const merekBaruEl = document.getElementById('merek_baru');
            if (!merekEl) return '';
            if (merekEl.value === '__LAINNYA__') {
                return (merekBaruEl ? merekBaruEl.value : '').trim();
            }
            return merekEl.value.trim();
        }

        function getEffectiveJenis() {
            const jenisEl = document.getElementById('jenis_kendaraan');
            const jenisBaruEl = document.getElementById('jenis_kendaraan_baru');
            if (!jenisEl) return '';
            if (jenisEl.value === '__LAINNYA__') {
                return (jenisBaruEl ? jenisBaruEl.value : '').trim();
            }
            return jenisEl.value.trim();
        }

        function getEffectiveModel() {
            const modelEl = document.getElementById('model');
            const modelBaruEl = document.getElementById('model_baru');
            if (!modelEl) return '';
            if (modelEl.value === '__LAINNYA__') {
                return (modelBaruEl ? modelBaruEl.value : '').trim();
            }
            return modelEl.value.trim();
        }

        function syncProgressiveStepFields() {
            const hasMerek = Boolean(getEffectiveMerek());
            const hasJenis = hasMerek && Boolean(getEffectiveJenis());
            const hasModel = hasJenis && Boolean(getEffectiveModel());
            const tahunEl = document.getElementById('tahun');
            const platEl = document.getElementById('plat_nomor');
            const hasTahun = hasModel && Boolean(tahunEl && tahunEl.value.trim());
            const hasPlat = hasTahun && Boolean(platEl && platEl.value.trim());

            const fieldJenis = document.getElementById('fieldJenisKendaraan');
            const fieldModel = document.getElementById('fieldModelKendaraan');
            const fieldTahun = document.getElementById('fieldTahunKendaraan');
            const fieldPlat = document.getElementById('fieldPlatKendaraan');

            const jenisEl = document.getElementById('jenis_kendaraan');
            const modelEl = document.getElementById('model');

            if (fieldJenis) fieldJenis.classList.toggle('is-dependent-faded', !hasMerek);
            if (jenisEl) jenisEl.disabled = !hasMerek;

            if (fieldModel) fieldModel.classList.toggle('is-dependent-faded', !hasJenis);
            if (modelEl) modelEl.disabled = !hasJenis;

            if (fieldTahun) fieldTahun.classList.toggle('is-dependent-faded', !hasModel);
            if (tahunEl) {
                tahunEl.disabled = !hasModel;
                if (!hasModel) tahunEl.value = '';
            }

            if (fieldPlat) fieldPlat.classList.toggle('is-dependent-faded', !hasTahun);
            if (platEl) {
                platEl.disabled = !hasTahun;
                if (!hasTahun) platEl.value = '';
            }

            // Step 3 progressive fade: Tanggal Servis menyala setelah Nama, No. Telepon & Jam Servis terisi
            const namaEl = document.getElementById('nama_lengkap');
            const telEl = document.getElementById('no_telepon');
            const jamEl = document.getElementById('jam_servis');
            const tglEl = document.getElementById('tanggal_servis');
            const fieldTgl = document.getElementById('fieldTanggalServis');

            const hasNamaTel = Boolean(namaEl && namaEl.value.trim()) && Boolean(telEl && telEl.value.trim());
            const hasJam = hasNamaTel && Boolean(jamEl && jamEl.value.trim());

            if (fieldTgl) fieldTgl.classList.toggle('is-dependent-faded', !hasJam);
            if (tglEl) tglEl.disabled = !hasJam;

            const hasTanggal = hasJam && Boolean(tglEl && tglEl.value.trim());

            // Status kelengkapan tiap step untuk tombol Lanjut & Stepper
            const step1Complete = hasPlat;
            const step2Complete = step1Complete && Boolean(document.querySelector('input[name="jenis_layanan"]:checked'));
            const step3Complete = step2Complete && hasTanggal;

            const btnNextStep1 = document.querySelector('#stepPanel1 .booking-next-btn');
            const btnNextStep2 = document.querySelector('#stepPanel2 .booking-next-btn');
            const btnNextStep3 = document.querySelector('#stepPanel3 .booking-next-btn');

            if (btnNextStep1) btnNextStep1.classList.toggle('is-btn-faded', !step1Complete);
            if (btnNextStep2) btnNextStep2.classList.toggle('is-btn-faded', !step2Complete);
            if (btnNextStep3) btnNextStep3.classList.toggle('is-btn-faded', !step3Complete);

            document.querySelectorAll('.stepper-item').forEach(function (item) {
                const target = Number(item.dataset.stepTarget);
                let unlocked = true;
                if (target === 2) unlocked = step1Complete;
                if (target === 3) unlocked = step2Complete;
                if (target === 4) unlocked = step3Complete;
                item.classList.toggle('is-step-faded', !unlocked && target !== currentStep);
            });
        }

        function toggleEditNoTelepon() {
            const telInput = document.getElementById('no_telepon');
            const btn = document.getElementById('btnToggleEditTelepon');
            if (!telInput || !btn) return;

            if (telInput.hasAttribute('readonly')) {
                telInput.removeAttribute('readonly');
                telInput.classList.remove('is-readonly-locked');
                telInput.focus();
                btn.textContent = 'Kunci No. Telepon';
            } else {
                telInput.setAttribute('readonly', 'readonly');
                telInput.classList.add('is-readonly-locked');
                btn.textContent = 'Ubah No. Telepon';
            }
        }

        function syncModelByMerek() {
            const merekEl = document.getElementById('merek');
            const merekBaruEl = document.getElementById('merek_baru');
            const jenisEl = document.getElementById('jenis_kendaraan');
            const jenisBaruEl = document.getElementById('jenis_kendaraan_baru');
            const modelEl = document.getElementById('model');
            const modelBaruEl = document.getElementById('model_baru');
            if (!merekEl || !modelEl) return;

            const merekDipilih = merekEl.value;
            const prevModelVal = modelEl.value;

            const isNewMerek = merekDipilih === '__LAINNYA__';
            if (merekBaruEl) {
                merekBaruEl.style.display = isNewMerek ? 'block' : 'none';
                merekBaruEl.required = isNewMerek;
            }

            const isNewJenis = Boolean(merekDipilih) && jenisEl && jenisEl.value === '__LAINNYA__';
            if (jenisBaruEl) {
                jenisBaruEl.style.display = isNewJenis ? 'block' : 'none';
                jenisBaruEl.required = Boolean(isNewJenis);
            }

            if (jenisEl && !isNewMerek && merekDipilih) {
                const prevJenis = jenisEl.value;
                const availableJenis = Array.from(new Set(
                    KENDARAAN_DB
                        .filter(function (item) { return item.merek === merekDipilih; })
                        .map(function (item) { return item.jenis; })
                ));

                Array.from(jenisEl.options).forEach(function (opt) {
                    if (!opt.value || opt.value === '__LAINNYA__') return;
                    const existsForBrand = availableJenis.includes(opt.value);
                    opt.hidden = !existsForBrand;
                    opt.disabled = !existsForBrand;
                });

                if (prevJenis && prevJenis !== '__LAINNYA__' && !availableJenis.includes(prevJenis)) {
                    jenisEl.value = availableJenis.length === 1 ? availableJenis[0] : '';
                } else if (!prevJenis && availableJenis.length === 1) {
                    jenisEl.value = availableJenis[0];
                }
            } else if (jenisEl) {
                Array.from(jenisEl.options).forEach(function (opt) {
                    opt.hidden = false;
                    opt.disabled = false;
                });
            }

            const jenisDipilih = jenisEl ? jenisEl.value : '';

            modelEl.innerHTML = '';

            if (!merekDipilih || !jenisDipilih) {
                const placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.disabled = true;
                placeholder.selected = true;
                placeholder.textContent = !merekDipilih ? 'Pilih merek terlebih dahulu' : 'Pilih jenis kendaraan terlebih dahulu';
                modelEl.appendChild(placeholder);
                modelEl.disabled = true;
                if (modelBaruEl) {
                    modelBaruEl.style.display = 'none';
                    modelBaruEl.required = false;
                }
                syncProgressiveStepFields();
                return;
            }

            if (isNewMerek) {
                const optNew = document.createElement('option');
                optNew.value = '__LAINNYA__';
                optNew.selected = true;
                optNew.textContent = '+ Ketik Model / Tipe Baru';
                modelEl.appendChild(optNew);
                modelEl.disabled = false;
                if (modelBaruEl) {
                    modelBaruEl.style.display = 'block';
                    modelBaruEl.required = true;
                }
                syncProgressiveStepFields();
                return;
            }

            let filteredModels = KENDARAAN_DB.filter(function (item) {
                if (item.merek !== merekDipilih) return false;
                if (jenisDipilih && jenisDipilih !== '__LAINNYA__' && item.jenis !== jenisDipilih) {
                    return false;
                }
                return true;
            });

            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.disabled = true;
            placeholder.selected = true;
            placeholder.textContent = filteredModels.length > 0
                ? 'Pilih model kendaraan'
                : 'Belum ada model di kategori ini — pilih + Tambah Model Baru';
            modelEl.appendChild(placeholder);

            filteredModels.forEach(function (item) {
                const opt = document.createElement('option');
                opt.value = item.model;
                opt.dataset.jenis = item.jenis;
                opt.textContent = item.model.toUpperCase() + ' (' + item.jenis + ')';
                if (item.model === prevModelVal) {
                    opt.selected = true;
                    placeholder.selected = false;
                }
                modelEl.appendChild(opt);
            });

            const optCustom = document.createElement('option');
            optCustom.value = '__LAINNYA__';
            optCustom.textContent = '+ Tambah Model Baru...';
            if (prevModelVal === '__LAINNYA__') {
                optCustom.selected = true;
                placeholder.selected = false;
            }
            modelEl.appendChild(optCustom);

            modelEl.disabled = false;
            if (modelBaruEl && modelEl.value !== '__LAINNYA__') {
                modelBaruEl.style.display = 'none';
                modelBaruEl.required = false;
            }
            syncProgressiveStepFields();
        }

        function onModelSelectChange() {
            const modelEl = document.getElementById('model');
            const modelBaruEl = document.getElementById('model_baru');
            const jenisEl = document.getElementById('jenis_kendaraan');
            if (!modelEl) return;

            const isNewModel = modelEl.value === '__LAINNYA__';
            if (modelBaruEl) {
                modelBaruEl.style.display = isNewModel ? 'block' : 'none';
                modelBaruEl.required = isNewModel;
            }

            if (!isNewModel && jenisEl && !jenisEl.value) {
                const selectedOption = modelEl.options[modelEl.selectedIndex];
                if (selectedOption && selectedOption.dataset.jenis) {
                    jenisEl.value = selectedOption.dataset.jenis;
                }
            }
            syncProgressiveStepFields();
        }

        function validateStepFields(step) {
            if (step === 1) {
                const merekEl = document.getElementById('merek');
                const merekBaruEl = document.getElementById('merek_baru');
                const jenisEl = document.getElementById('jenis_kendaraan');
                const jenisBaruEl = document.getElementById('jenis_kendaraan_baru');
                const modelEl = document.getElementById('model');
                const modelBaruEl = document.getElementById('model_baru');
                const tahunEl = document.getElementById('tahun');
                const platEl = document.getElementById('plat_nomor');

                const step1Fields = [
                    merekEl,
                    (merekEl && merekEl.value === '__LAINNYA__') ? merekBaruEl : null,
                    jenisEl,
                    (jenisEl && jenisEl.value === '__LAINNYA__') ? jenisBaruEl : null,
                    modelEl,
                    (modelEl && modelEl.value === '__LAINNYA__') ? modelBaruEl : null,
                    tahunEl,
                    platEl,
                ].filter(Boolean);

                for (const field of step1Fields) {
                    if (!field.value || !field.value.trim()) {
                        field.reportValidity();
                        field.focus();
                        return false;
                    }
                }
            } else if (step === 2) {
                const layananChecked = document.querySelector('input[name="jenis_layanan"]:checked');
                if (!layananChecked) {
                    alert('Silakan pilih jenis layanan terlebih dahulu.');
                    return false;
                }
            } else if (step === 3) {
                const step3Fields = [
                    document.getElementById('nama_lengkap'),
                    document.getElementById('no_telepon'),
                    document.getElementById('jam_servis'),
                    document.getElementById('tanggal_servis'),
                ];
                for (const field of step3Fields) {
                    if (!field) continue;
                    if (!field.value || !field.value.trim()) {
                        field.reportValidity();
                        field.focus();
                        return false;
                    }
                }
            }
            return true;
        }

        function updateConfirmationSummary() {
            const merek = getEffectiveMerek();
            const jenis = getEffectiveJenis();
            const model = getEffectiveModel();
            const tahun = document.getElementById('tahun')?.value || '';
            const plat = document.getElementById('plat_nomor')?.value.trim() || '';
            const layananEl = document.querySelector('input[name="jenis_layanan"]:checked');
            const layananId = layananEl ? layananEl.value : '';
            const layananNama = layananEl ? (layananEl.dataset.nama || '-') : '-';
            const layananHarga = layananEl && layananEl.dataset.harga ? ('Sekitar Rp ' + layananEl.dataset.harga + ' (Menyesuaikan jenis motor)') : '-';
            const nama = document.getElementById('nama_lengkap')?.value.trim() || '';
            const telepon = document.getElementById('no_telepon')?.value.trim() || '';
            const jam = document.getElementById('jam_servis')?.value.trim() || '';
            const tanggal = document.getElementById('tanggal_servis')?.value.trim() || '';

            const motorText = [merek, model, jenis ? `(${jenis})` : '', tahun].filter(Boolean).join(' ');
            document.getElementById('summaryMotor').textContent = motorText || '-';
            document.getElementById('summaryPlat').textContent = plat ? plat.toUpperCase() : '-';
            document.getElementById('summaryLayanan').textContent = layananNama;
            document.getElementById('summaryHarga').textContent = layananHarga;
            document.getElementById('summaryNama').textContent = nama || '-';
            document.getElementById('summaryTelepon').textContent = telepon || '-';
            document.getElementById('summaryJam').textContent = jam ? (jam.replace(':', '.') + ' WITA') : '-';

            if (tanggal) {
                const parsed = new Date(tanggal);
                if (!isNaN(parsed.getTime())) {
                    const formatted = parsed.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                    document.getElementById('summaryTanggal').textContent = formatted;
                } else {
                    document.getElementById('summaryTanggal').textContent = tanggal;
                }
            } else {
                document.getElementById('summaryTanggal').textContent = '-';
            }

            const submitLayananId = document.getElementById('submitLayananId');
            const submitJadwalService = document.getElementById('submitJadwalService');
            const submitMerek = document.getElementById('submitMerek');
            const submitJenisKendaraan = document.getElementById('submitJenisKendaraan');
            const submitModel = document.getElementById('submitModel');
            const submitTahun = document.getElementById('submitTahun');
            const submitPlatNomor = document.getElementById('submitPlatNomor');
            const submitNamaLengkap = document.getElementById('submitNamaLengkap');
            const submitNoTelepon = document.getElementById('submitNoTelepon');
            if (submitLayananId) submitLayananId.value = layananId;
            if (submitJadwalService) {
                submitJadwalService.value = (tanggal && jam) ? `${tanggal} ${jam}:00` : '';
            }
            if (submitMerek) submitMerek.value = merek;
            if (submitJenisKendaraan) submitJenisKendaraan.value = jenis;
            if (submitModel) submitModel.value = model;
            if (submitTahun) submitTahun.value = tahun;
            if (submitPlatNomor) submitPlatNomor.value = plat;
            if (submitNamaLengkap) submitNamaLengkap.value = nama;
            if (submitNoTelepon) submitNoTelepon.value = telepon;
        }

        const submitLayananOrderForm = document.getElementById('submitLayananOrderForm');
        if (submitLayananOrderForm) {
            submitLayananOrderForm.addEventListener('submit', function (e) {
                updateConfirmationSummary();
                const layananId = document.getElementById('submitLayananId')?.value;
                const jadwal = document.getElementById('submitJadwalService')?.value;
                if (!layananId) {
                    e.preventDefault();
                    alert('Silakan pilih layanan terlebih dahulu.');
                    goToStep(2);
                    return;
                }
                if (!jadwal) {
                    e.preventDefault();
                    alert('Silakan lengkapi tanggal dan jam servis terlebih dahulu (pukul 08:00 - 22:00).');
                    goToStep(3);
                }
            });
        }

        let currentStep = 1;
        const totalSteps = 4;

        function goToStep(stepNumber) {
            if (stepNumber < 1 || stepNumber > totalSteps) {
                return;
            }

            if (stepNumber > currentStep) {
                for (let s = currentStep; s < stepNumber; s++) {
                    if (!validateStepFields(s)) {
                        return;
                    }
                }
            }

            currentStep = stepNumber;

            if (stepNumber === 4) {
                updateConfirmationSummary();
            }

            // Update panel visibility
            document.querySelectorAll('.booking-step-panel').forEach(function (panel) {
                const isTarget = Number(panel.dataset.step) === stepNumber;
                panel.classList.toggle('active', isTarget);
            });

            // Update stepper header circles
            document.querySelectorAll('.stepper-item').forEach(function (item) {
                const isTarget = Number(item.dataset.stepTarget) === stepNumber;
                item.classList.toggle('active', isTarget);
            });
            syncProgressiveStepFields();
        }

        function nextStep() {
            if (currentStep < totalSteps) {
                goToStep(currentStep + 1);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                goToStep(currentStep - 1);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.getElementById('userDropdown');
            const dropdownBtn = document.getElementById('userDropdownBtn');

            if (dropdown && dropdownBtn) {
                dropdownBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isOpen = dropdown.classList.toggle('open');
                    dropdownBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });

                document.addEventListener('click', function (e) {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('open');
                        dropdownBtn.setAttribute('aria-expanded', 'false');
                    }
                });

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        dropdown.classList.remove('open');
                        dropdownBtn.setAttribute('aria-expanded', 'false');
                    }
                });
            }
            const merekSelect = document.getElementById('merek');
            const jenisSelect = document.getElementById('jenis_kendaraan');
            const modelSelect = document.getElementById('model');
            if (merekSelect) {
                merekSelect.addEventListener('change', syncModelByMerek);
            }
            if (jenisSelect) {
                jenisSelect.addEventListener('change', syncModelByMerek);
            }
            if (modelSelect) {
                modelSelect.addEventListener('change', onModelSelectChange);
            }
            ['merek_baru', 'jenis_kendaraan_baru', 'model_baru', 'tahun', 'plat_nomor', 'no_telepon', 'jam_servis', 'tanggal_servis'].forEach(function (id) {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', syncProgressiveStepFields);
                    el.addEventListener('change', syncProgressiveStepFields);
                }
            });
            document.querySelectorAll('input[name="jenis_layanan"]').forEach(function (radio) {
                radio.addEventListener('change', syncProgressiveStepFields);
            });
            syncModelByMerek();

            function resetBookingFromStart() {
                ['merek', 'merek_baru', 'jenis_kendaraan', 'jenis_kendaraan_baru', 'model', 'model_baru', 'tahun', 'plat_nomor'].forEach(function (id) {
                    const el = document.getElementById(id);
                    if (el) el.value = '';
                });
                syncModelByMerek();
                const jamEl = document.getElementById('jam_servis');
                if (jamEl) jamEl.selectedIndex = 0;
                const tglEl = document.getElementById('tanggal_servis');
                if (tglEl && tglEl.min) tglEl.value = tglEl.min;
                document.querySelectorAll('input[name="layanan_id"]').forEach(function (r) {
                    r.checked = false;
                });
                goToStep(1);
            }

            const submitLayananForm = document.getElementById('submitLayananOrderForm');
            if (submitLayananForm) {
                submitLayananForm.addEventListener('submit', function () {
                    sessionStorage.setItem('hg_booking_completed', '1');
                });
            }

            const navEntries = window.performance && performance.getEntriesByType
                ? performance.getEntriesByType('navigation')
                : [];
            const isBackForward = navEntries.length > 0 && navEntries[0].type === 'back_forward';
            if (sessionStorage.getItem('hg_booking_completed') === '1' || isBackForward) {
                sessionStorage.removeItem('hg_booking_completed');
                resetBookingFromStart();
            }
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted || sessionStorage.getItem('hg_booking_completed') === '1') {
                sessionStorage.removeItem('hg_booking_completed');
                window.location.reload();
            }
        });
    </script>
    <x-user-profile-modal />
    <x-login-success-toast />
    <x-rating-reminder-toast />
</body>
</html>