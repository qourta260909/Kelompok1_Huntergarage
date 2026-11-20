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
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Hunter Garage" class="brand-logo">
                <div class="brand-text">
                    <span class="brand-title">Hunter garage</span>
                    <span class="brand-subtitle">Service dan sparepart</span>
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
                            <a href="{{ route('user.pesanan') }}" class="dropdown-item" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Booking Saya</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item dropdown-item-danger" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span>Logout</span>
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
                <!-- Stepper -->
                <div class="stepper" aria-label="Tahapan booking layanan">
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
                <section class="booking-card" aria-live="polite">
                    <!-- STEP 1: DATA KENDARAAN -->
                    <div class="booking-step-panel active" id="stepPanel1" data-step="1">
                        <div class="booking-card-header">
                            <p class="booking-step-indicator">Langkah 1 Dari 4</p>
                            <h1 class="booking-card-title">Data Kendaraan</h1>
                        </div>

                        <div class="booking-form">
                            <div class="booking-grid">
                                <div class="booking-field">
                                    <label for="merek" class="booking-label">Merek</label>
                                    <div class="booking-select-wrap">
                                        <select id="merek" name="merek" class="booking-input booking-select">
                                            <option value="" disabled selected>Pilih merek kendaraan</option>
                                            <option value="Honda">Honda</option>
                                            <option value="Yamaha">Yamaha</option>
                                            <option value="Suzuki">Suzuki</option>
                                            <option value="Kawasaki">Kawasaki</option>
                                            <option value="Vespa">Vespa</option>
                                        </select>
                                        <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>

                                <div class="booking-field">
                                    <label for="model" class="booking-label">Model</label>
                                    <div class="booking-select-wrap">
                                        <select id="model" name="model" class="booking-input booking-select">
                                            <option value="" disabled selected>Pilih model kendaraan</option>
                                            <option value="Vario 160">Vario 160</option>
                                            <option value="Beat">Beat</option>
                                            <option value="NMAX">NMAX</option>
                                            <option value="Aerox">Aerox</option>
                                            <option value="PCX 160">PCX 160</option>
                                            <option value="CBR 150R">CBR 150R</option>
                                        </select>
                                        <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>

                                <div class="booking-field">
                                    <label for="tahun" class="booking-label">Tahun</label>
                                    <div class="booking-select-wrap">
                                        <select id="tahun" name="tahun" class="booking-input booking-select">
                                            <option value="" disabled selected>Pilih tahun kendaraan</option>
                                            @for ($year = 2026; $year >= 2010; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                        <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>

                                <div class="booking-field">
                                    <label for="plat_nomor" class="booking-label">Plat Nomor</label>
                                    <input
                                        type="text"
                                        id="plat_nomor"
                                        name="plat_nomor"
                                        class="booking-input"
                                        placeholder="Masukkan plat nomor kendaraan.........."
                                    >
                                </div>
                            </div>

                            <p class="booking-note">Pastikan data sama dengan kendaraan yang akan di service.</p>

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
                        </div>

                        <div class="service-option-list" role="radiogroup" aria-label="Pilihan layanan">
                            <label class="service-option-card">
                                <input type="radio" name="jenis_layanan" value="Servis Rutin" checked>
                                <span class="service-radio-circle"></span>
                                <span class="service-option-icon" aria-hidden="true">
                                    <!-- Gear icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58a.49.49 0 0 0 .12-.61l-1.92-3.32a.49.49 0 0 0-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54a.484.484 0 0 0-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58a.49.49 0 0 0-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                                    </svg>
                                </span>
                                <span class="service-option-content">
                                    <strong class="service-option-title">Servis Rutin</strong>
                                    <span class="service-option-desc">Perawatan berkala untuk menjaga performa kendaraan tetap optimal.</span>
                                </span>
                            </label>

                            <label class="service-option-card">
                                <input type="radio" name="jenis_layanan" value="Tune Up">
                                <span class="service-radio-circle"></span>
                                <span class="service-option-icon" aria-hidden="true">
                                    <!-- Wrench icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
                                    </svg>
                                </span>
                                <span class="service-option-content">
                                    <strong class="service-option-title">Tune Up</strong>
                                    <span class="service-option-desc">Penyetelan mesin, busi, filter, dan komponen pendukung agar performa kembali stabil.</span>
                                </span>
                            </label>

                            <label class="service-option-card">
                                <input type="radio" name="jenis_layanan" value="Servis Ban">
                                <span class="service-radio-circle"></span>
                                <span class="service-option-icon" aria-hidden="true">
                                    <!-- Tire icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <ellipse cx="14" cy="12" rx="6" ry="9" stroke-width="2.2"/>
                                        <ellipse cx="14" cy="12" rx="2.5" ry="4.5" stroke-width="1.8"/>
                                        <path d="M14 3H9C5.69 3 3 7.03 3 12s2.69 9 6 9h5" stroke-width="2.2"/>
                                        <line x1="5" y1="7" x2="9" y2="7" stroke-width="1.8"/>
                                        <line x1="3.5" y1="12" x2="8" y2="12" stroke-width="1.8"/>
                                        <line x1="5" y1="17" x2="9" y2="17" stroke-width="1.8"/>
                                    </svg>
                                </span>
                                <span class="service-option-content">
                                    <strong class="service-option-title">Servis Ban</strong>
                                    <span class="service-option-desc">Periksa tekanan, kondisi tapak, dan keseimbangan ban untuk kenyamanan berkendara.</span>
                                </span>
                            </label>

                            <label class="service-option-card">
                                <input type="radio" name="jenis_layanan" value="Konsultasi Terlebih Dahulu">
                                <span class="service-radio-circle"></span>
                                <span class="service-option-icon" aria-hidden="true">
                                    <!-- Chat bubble icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 3C6.48 3 2 6.58 2 11c0 2.13 1.05 4.07 2.75 5.5-.18 1.24-.75 2.76-1.67 3.79-.21.24-.03.62.29.59 2.09-.2 3.92-1.08 5.14-1.88.96.26 1.97.4 3.04.4 5.52 0 10-3.58 10-8s-4.48-8-10-8zm-3.5 9.25a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5zm3.5 0a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5zm3.5 0a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5z"/>
                                    </svg>
                                </span>
                                <span class="service-option-content">
                                    <strong class="service-option-title">Konsultasi Terlebih Dahulu</strong>
                                    <span class="service-option-desc">Diskusi awal untuk menentukan layanan yang paling tepat sebelum booking.</span>
                                </span>
                            </label>
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
                                        class="booking-input"
                                        placeholder="Masukkan Nama lengkap"
                                        value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                    >
                                </div>

                                <div class="booking-field">
                                    <label for="no_telepon" class="booking-label">No.telepon</label>
                                    <input
                                        type="tel"
                                        id="no_telepon"
                                        name="no_telepon"
                                        class="booking-input"
                                        placeholder="Contoh:082318****"
                                    >
                                </div>

                                <div class="booking-field">
                                    <label for="jam_servis" class="booking-label">Jam servis</label>
                                    <div class="booking-input-icon-wrap">
                                        <input
                                            type="text"
                                            id="jam_servis"
                                            name="jam_servis"
                                            class="booking-input has-trailing-icon"
                                            placeholder="Masukkan Waktu"
                                            onfocus="(this.type='time')"
                                            onblur="if(!this.value)this.type='text'"
                                        >
                                        <svg class="input-trailing-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <polyline points="12 7 12 12 14.5 14.5"></polyline>
                                        </svg>
                                    </div>
                                </div>

                                <div class="booking-field">
                                    <label for="tanggal_servis" class="booking-label">Tanggal servis</label>
                                    <div class="booking-input-icon-wrap">
                                        <input
                                            type="text"
                                            id="tanggal_servis"
                                            name="tanggal_servis"
                                            class="booking-input has-trailing-icon"
                                            placeholder="Masukkan Tanggal"
                                            onfocus="(this.type='date')"
                                            onblur="if(!this.value)this.type='text'"
                                        >
                                        <svg class="input-trailing-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="9" x2="21" y2="9"></line>
                                            <circle cx="8" cy="13" r="0.8" fill="currentColor"></circle>
                                            <circle cx="12" cy="13" r="0.8" fill="currentColor"></circle>
                                            <circle cx="16" cy="13" r="0.8" fill="currentColor"></circle>
                                            <circle cx="8" cy="17" r="0.8" fill="currentColor"></circle>
                                            <circle cx="12" cy="17" r="0.8" fill="currentColor"></circle>
                                            <circle cx="16" cy="17" r="0.8" fill="currentColor"></circle>
                                        </svg>
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
                            <h2 class="booking-card-title">Konfirmasi Booking</h2>
                            <p class="booking-card-subtitle">Periksa kembali data Anda sebelum Mengirim booking</p>
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
                                            <strong class="confirm-val" id="summaryMotor">0852199128</strong>
                                        </div>
                                        <div class="confirm-row">
                                            <span class="confirm-key">Nomor polisi</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryPlat">DA 1234 AB</strong>
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
                                            <strong class="confirm-val" id="summaryLayanan">Servis rutin</strong>
                                        </div>
                                        <div class="confirm-row">
                                            <span class="confirm-key">Keluhan</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryKeluhan">Rem kurang responif</strong>
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
                                            <strong class="confirm-val" id="summaryTanggal">07 November 2026</strong>
                                        </div>
                                        <div class="confirm-row">
                                            <span class="confirm-key">Jam</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryJam">10.00 WITA</strong>
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
                                            <strong class="confirm-val" id="summaryNama">Justiceo</strong>
                                        </div>
                                        <div class="confirm-row">
                                            <span class="confirm-key">No.telepon</span>
                                            <span class="confirm-colon">:</span>
                                            <strong class="confirm-val" id="summaryTelepon">082929333</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="booking-divider step4-divider">

                        <div class="booking-actions">
                            <a href="{{ route('home') }}" class="booking-back-link">Kembali ke Beranda</a>
                            <div class="booking-btn-group">
                                <button type="button" class="booking-prev-btn" onclick="prevStep()">Sebelumnya</button>
                                <button type="button" class="booking-next-btn" id="btnConfirmBooking">Konfirmasi Booking</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-main">
            <div class="footer-brand-col">
                <a class="footer-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Hunter Garage" class="footer-logo">
                    <div class="footer-brand-text">
                        <span class="footer-brand-title">Hunter garage</span>
                        <span class="footer-brand-subtitle">SERVICE DAN SPAREPART</span>
                    </div>
                </a>

                <p class="footer-desc">
                    Bengkel otomotif profesional untuk servis transparan, sparepart terverifikasi, dan perjalanan yang lebih tenang.
                </p>

                <div class="footer-socials">
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Instagram Hunter Garage">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Facebook Hunter Garage">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="YouTube Hunter Garage">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/>
                            <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="footer-links-group">
                <div class="footer-col">
                    <h3 class="footer-col-title">JELAJAHI</h3>
                    <ul class="footer-list">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('user.layanan') }}">Layanan</a></li>
                        <li><a href="{{ route('user.produk') }}">Sparepart</a></li>
                        <li><a href="{{ route('home') }}#beranda">Tentang kami</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3 class="footer-col-title">LAYANAN</h3>
                    <ul class="footer-list">
                        <li><a href="{{ route('user.layanan') }}">Servis berkala</a></li>
                        <li><a href="{{ route('user.layanan') }}">Diagnostik</a></li>
                        <li><a href="{{ route('user.layanan') }}">Rem &amp; kaki</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3 class="footer-col-title">WORKSHOP</h3>
                    <div class="footer-workshop-info">
                        <p class="footer-address">
                            Jl. Taruna Praja Banjarbaru<br>
                            Kalimantan selatan, Indonesia
                        </p>
                        <p class="footer-hours">
                            Senin–Minggu. 08.00–22.00<br>
                            Konsultasi online 24/7
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 Hunter Garage. Semua hak dilindungi.</p>
        </div>
    </footer>
    <script>
        function updateConfirmationSummary() {
            const merek = document.getElementById('merek')?.value || '';
            const model = document.getElementById('model')?.value || '';
            const tahun = document.getElementById('tahun')?.value || '';
            const plat = document.getElementById('plat_nomor')?.value.trim() || '';
            const layananEl = document.querySelector('input[name="jenis_layanan"]:checked');
            const layanan = layananEl ? layananEl.value : '';
            const nama = document.getElementById('nama_lengkap')?.value.trim() || '';
            const telepon = document.getElementById('no_telepon')?.value.trim() || '';
            const jam = document.getElementById('jam_servis')?.value.trim() || '';
            const tanggal = document.getElementById('tanggal_servis')?.value.trim() || '';

            const motorText = [merek, model, tahun].filter(Boolean).join(' ');
            if (motorText) {
                document.getElementById('summaryMotor').textContent = motorText;
            }
            if (plat) {
                document.getElementById('summaryPlat').textContent = plat.toUpperCase();
            }
            if (layanan) {
                document.getElementById('summaryLayanan').textContent = layanan;
            }
            if (nama) {
                document.getElementById('summaryNama').textContent = nama;
            }
            if (telepon) {
                document.getElementById('summaryTelepon').textContent = telepon;
            }
            if (jam) {
                document.getElementById('summaryJam').textContent = jam.replace(':', '.') + ' WITA';
            }
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
            }
        }

        let currentStep = 1;
        const totalSteps = 4;

        function goToStep(stepNumber) {
            if (stepNumber < 1 || stepNumber > totalSteps) {
                return;
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
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>