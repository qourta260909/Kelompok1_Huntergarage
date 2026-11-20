<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hunter Garage - Service dan Sparepart</title>
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
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    <a class="nav-link" href="{{ route('user.layanan') }}">Layanan</a>
                    <a class="nav-link" href="{{ route('user.produk') }}">Produk</a>
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

    <main class="hero" id="beranda">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Servis Kendaraan Cepat, Akurat, dan Transparan</h1>
                <p class="description">
                    Pilih layanan, tentukan jadwal, dan datang saat montir kami siap. Sparepart asli juga bisa dipesan langsung.
                </p>
            </div>

            <div class="service-card">
                <div class="service-card-header">
                    <h2 class="service-card-title">Proses servis terstruktur</h2>
                    <p class="service-card-subtitle">
                        Mulai dari pemeriksaan awal hingga pengambilan kendaraan
                    </p>
                </div>

                <div class="service-card-body">
                    <div class="service-image-wrap">
                        <img src="{{ Vite::asset('resources/images/service-image.png') }}" alt="Teknisi memeriksa kendaraan" class="service-image">
                    </div>

                    <ol class="service-steps">
                        <li class="step-item">
                            <span class="step-number">1</span>
                            <div class="step-text">
                                <h3 class="step-title">Pemeriksaan awal</h3>
                                <p class="step-desc">Kami mengecek kondisi kendaraan, mencatat keluhan, dan menentukan prioritas pekerjaan.</p>
                            </div>
                        </li>

                        <li class="step-item">
                            <span class="step-number">2</span>
                            <div class="step-text">
                                <h3 class="step-title">Estimasi biaya</h3>
                                <p class="step-desc">Pelanggan mendapat rincian pekerjaan, spare part, dan biaya total sebelum pekerjaan dimulai.</p>
                            </div>
                        </li>

                        <li class="step-item">
                            <span class="step-number">3</span>
                            <div class="step-text">
                                <h3 class="step-title">Servis &amp; perbaikan</h3>
                                <p class="step-desc">Tim teknisi bekerja sesuai SOP, menggunakan peralatan modern, dan spare part yang sesuai.</p>
                            </div>
                        </li>

                        <li class="step-item">
                            <span class="step-number">4</span>
                            <div class="step-text">
                                <h3 class="step-title">Tes jalan &amp; serah terima</h3>
                                <p class="step-desc">Kendaraan dites jalan, hasil servis diverifikasi, dan pelanggan mendapat laporan kerja lengkap.</p>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </main>

    <section class="top-service" aria-label="Statistik layanan Hunter Garage">
        <div class="stat-item">
            <div class="stat-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
            </div>
            <div class="stat-info">
                <strong class="stat-value">4.9/5</strong>
                <p class="stat-label">Rating pelanggan</p>
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="6" r="2"/>
                    <path d="M5 6h5"/>
                    <path d="M14 6h5"/>
                    <path d="M9 8h6l1.5 4.5a4.5 4.5 0 0 1 .5 2V18h-2.5"/>
                    <path d="M9 8L7.5 12.5a4.5 4.5 0 0 0-.5 2V18h2.5"/>
                    <rect x="10.25" y="14" width="3.5" height="7" rx="1.75"/>
                </svg>
            </div>
            <div class="stat-info">
                <strong class="stat-value">1.2k+</strong>
                <p class="stat-label">Kendaraan / bulan</p>
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/>
                    <path d="m9 12 2 2 4-4"/>
                </svg>
            </div>
            <div class="stat-info">
                <strong class="stat-value">98%</strong>
                <p class="stat-label">Pelanggan puas</p>
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/>
                    <polyline points="12 7 12 12 15.5 12"/>
                </svg>
            </div>
            <div class="stat-info">
                <strong class="stat-value">24/7</strong>
                <p class="stat-label">Booking &amp; konsultasi</p>
            </div>
        </div>
    </section>
    <section class="layanan-utama" id="layanan">
        <div class="title-container">
            <h2 class="judul-layanan"><span>• </span> LAYANAN UTAMA</h2>
            <h2 class="sub-judul">Satu bengkel untuk semua kebutuhan kendaraan.</h2>
            <p>Dari perawatan rutin sampai diagnosis kompleks, setiap pekerjaan <br>ditangani teknisi berpengalaman dengan prosedur yang jelas.</p>
        </div>

        <div class="layanan-grid">
            <article class="layanan-card">
                <div class="layanan-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                    </svg>
                </div>
                <h3 class="layanan-card-title">Servis berkala</h3>
                <p class="layanan-card-desc">
                    Ganti oli, filter, busi, cek semua cairan, plus pengecekan 30 titik penting sesuai kilometer motor.
                </p>
            </article>

            <article class="layanan-card">
                <div class="layanan-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="8"/>
                        <circle cx="12" cy="12" r="2.5"/>
                        <path d="M7.5 9.5a5.5 5.5 0 0 0 0 5"/>
                        <path d="M16.5 9.5a5.5 5.5 0 0 1 0 5"/>
                    </svg>
                </div>
                <h3 class="layanan-card-title">Rem &amp; kaki-kaki</h3>
                <p class="layanan-card-desc">
                    Pemeriksaan kampas, cakram, shockbreaker, bushing, spooring, dan balancing.
                </p>
            </article>

            <article class="layanan-card">
                <div class="layanan-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 8V6a2 2 0 0 1 2-2h2"/>
                        <path d="M4 16v2a2 2 0 0 0 2 2h2"/>
                        <path d="M16 4h2a2 2 0 0 1 2 2v2"/>
                        <path d="M16 20h2a2 2 0 0 0 2-2v-2"/>
                        <line x1="8" y1="12" x2="16" y2="12"/>
                    </svg>
                </div>
                <h3 class="layanan-card-title">Diagnostik mesin</h3>
                <p class="layanan-card-desc">
                    Scanner komputer dan analisis teknisi untuk menemukan akar masalah secara akurat.
                </p>
            </article>

            <article class="layanan-card">
                <div class="layanan-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="6" y1="9" x2="18" y2="9"/>
                        <circle cx="9" cy="9" r="2" fill="#FFF3DB"/>
                        <line x1="6" y1="15" x2="18" y2="15"/>
                        <circle cx="15" cy="15" r="2" fill="#FFF3DB"/>
                    </svg>
                </div>
                <h3 class="layanan-card-title">Transmisi</h3>
                <p class="layanan-card-desc">
                    Pemeriksaan transmisi agar motor bisa melaju dengan halus tanpa tersendat.
                </p>
            </article>

            <article class="layanan-card">
                <div class="layanan-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                </div>
                <h3 class="layanan-card-title">Inspeksi kendaraan</h3>
                <p class="layanan-card-desc">
                    Pengecekan menyeluruh sebelum perjalanan jauh.
                </p>
            </article>
        </div>
    </section>

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
                        <li><a href="#beranda">Tentang kami</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3 class="footer-col-title">LAYANAN</h3>
                    <ul class="footer-list">
                        <li><a href="#layanan">Servis berkala</a></li>
                        <li><a href="#layanan">Diagnostik</a></li>
                        <li><a href="#layanan">Rem &amp; kaki</a></li>
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
