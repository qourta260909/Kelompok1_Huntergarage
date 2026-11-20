@props([
    'layananAktif' => collect(),
    'produkAktif' => collect(),
])

<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-brand-col">
            <a class="footer-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Hunter Garage" class="footer-logo">
                <div class="footer-brand-text">
                    <span class="footer-brand-title">Hunter Garage</span>
                    <span class="footer-brand-subtitle">SERVIS DAN SUKU CADANG</span>
                </div>
            </a>

            <p class="footer-desc">
                Bengkel otomotif profesional untuk servis transparan, suku cadang terverifikasi, dan perjalanan yang lebih tenang.
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
                <h3 class="footer-col-title">NAVIGASI</h3>
                <ul class="footer-list">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'footer-link-active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('user.layanan') }}" class="{{ request()->routeIs('user.layanan') ? 'footer-link-active' : '' }}">Layanan</a></li>
                    <li><a href="{{ route('user.produk') }}" class="{{ request()->routeIs('user.produk') ? 'footer-link-active' : '' }}">Produk</a></li>
                    @auth
                        <li><a href="{{ route('user.pesanan') }}" class="{{ request()->routeIs('user.pesanan') ? 'footer-link-active' : '' }}">Pesanan Saya</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Masuk</a></li>
                    @endauth
                </ul>
            </div>

            @if ($layananAktif->isNotEmpty())
                <div class="footer-col">
                    <h3 class="footer-col-title">LAYANAN</h3>
                    <ul class="footer-list">
                        @foreach ($layananAktif->take(5) as $itemLayanan)
                            <li><a href="{{ route('user.layanan') }}">{{ $itemLayanan->nama_layanan }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($produkAktif->isNotEmpty())
                <div class="footer-col">
                    <h3 class="footer-col-title">PRODUK</h3>
                    <ul class="footer-list">
                        @foreach ($produkAktif->take(5) as $itemProduk)
                            <li><a href="{{ route('user.produk') }}">{{ $itemProduk->nama_produk }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="footer-col">
                <h3 class="footer-col-title">BENGKEL</h3>
                <div class="footer-workshop-info">
                    <p class="footer-address">
                        Jl. Taruna Praja Banjarbaru<br>
                        Kalimantan Selatan, Indonesia
                    </p>
                    <p class="footer-hours">
                        Senin–Minggu, 08.00–22.00<br>
                        Konsultasi daring 24/7
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 Hunter Garage. Semua hak dilindungi.</p>
    </div>
</footer>
