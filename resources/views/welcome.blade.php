<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hunter Garage - Servis Kendaraan Lebih Mudah</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        :root {
            color-scheme: light;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Roboto, Arial, sans-serif;
            color: #18181b;
            background: #f4f4f5;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 100vh;
            background: #f4f4f5;
            color: #18181b;
        }
        .page {
            width: min(1140px, calc(100% - 40px));
            margin: 0 auto;
            padding-bottom: 64px;
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 24px 0;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: #09090b;
            font-size: 20px;
            font-weight: 800;
            text-decoration: none;
        }
        .brand img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }
        .nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            border: 1.5px solid #d4d4d8;
            border-radius: 10px;
            color: #18181b;
            background: #ffffff;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .button:hover {
            background: #f4f4f5;
        }
        .button-primary {
            border-color: #09090b;
            color: #f6a31d;
            background: #09090b;
        }
        .button-primary:hover {
            background: #27272a;
        }
        .hero {
            display: grid;
            min-height: 380px;
            align-content: center;
            justify-items: start;
            padding: 56px;
            border-radius: 24px;
            background: linear-gradient(135deg, #09090b 0%, #1f1f23 100%);
            color: #ffffff;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }
        .eyebrow {
            margin-bottom: 14px;
            color: #f6a31d;
            font-size: 12.5px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        h1 {
            max-width: 680px;
            font-size: clamp(32px, 5vw, 52px);
            line-height: 1.1;
            font-weight: 800;
        }
        .description {
            max-width: 560px;
            margin: 18px 0 28px;
            color: #d4d4d8;
            font-size: 16px;
            line-height: 1.65;
        }
        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .section {
            margin-top: 44px;
        }
        .section-title {
            font-size: 22px;
            font-weight: 800;
            color: #09090b;
        }
        .section-subtitle {
            font-size: 14px;
            color: #71717a;
            margin-top: 4px;
            margin-bottom: 20px;
        }
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 18px;
        }
        .item-card {
            background: #ffffff;
            border: 1px solid #e4e4e7;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }
        .item-badge {
            display: inline-block;
            width: fit-content;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            background: #f4f4f5;
            color: #3f3f46;
        }
        .item-name {
            font-size: 17px;
            font-weight: 800;
            color: #09090b;
            margin-top: 6px;
        }
        .item-desc {
            font-size: 13px;
            color: #71717a;
            margin-top: 4px;
        }
        .item-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f4f4f5;
            padding-top: 12px;
        }
        .item-price {
            font-size: 16px;
            font-weight: 800;
            color: #09090b;
        }
        .empty-note {
            background: #ffffff;
            border: 1px dashed #d4d4d8;
            border-radius: 14px;
            padding: 24px;
            color: #71717a;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Hunter Garage">
                <span>Hunter Garage</span>
            </a>
            <nav class="nav" aria-label="Navigasi utama">
                <a class="button" href="{{ route('login') }}">Masuk</a>
                @if (Route::has('register'))
                    <a class="button button-primary" href="{{ route('register') }}">Daftar Akun</a>
                @endif
            </nav>
        </header>

        <main class="hero">
            <p class="eyebrow">Homepage Sebelum Login • Hunter Garage</p>
            <h1>Perawatan & Suku Cadang Motor Lebih Mudah.</h1>
            <p class="description">
                Daftar akun secara mandiri atau masuk ke akun Anda untuk memesan layanan servis maupun produk suku cadang resmi di Hunter Garage.
            </p>
            <div class="hero-actions">
                <a class="button button-primary" href="{{ route('login') }}">Masuk Sekarang</a>
                @if (Route::has('register'))
                    <a class="button" href="{{ route('register') }}">Daftar Akun User</a>
                @endif
            </div>
        </main>

        <section class="section">
            <h2 class="section-title">Layanan Tersedia</h2>
            <p class="section-subtitle">Pilih layanan perawatan motor terbaik (silakan login untuk melakukan pemesanan).</p>
            <div class="catalog-grid">
                @forelse ($layananAktif ?? [] as $layanan)
                    <div class="item-card">
                        <div>
                            <span class="item-badge">Kode: {{ 'HG-' . str_pad((string) $layanan->id, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="item-name">{{ $layanan->nama_layanan }}</div>
                            <div class="item-desc">Estimasi Pengerjaan: {{ $layanan->estimasi_durasi ?: ($layanan->deskripsi ?? '30 - 45 Menit') }}</div>
                        </div>
                        <div class="item-footer">
                            <span class="item-price">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                            <a href="{{ route('login') }}" class="button button-primary" style="padding:7px 14px; font-size:12.5px;">Login untuk Pesan</a>
                        </div>
                    </div>
                @empty
                    <div class="empty-note" style="grid-column: 1 / -1;">Belum ada layanan aktif yang ditambahkan oleh Admin.</div>
                @endforelse
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">Produk & Suku Cadang</h2>
            <p class="section-subtitle">Daftar suku cadang asli yang tersedia di bengkel kami.</p>
            <div class="catalog-grid">
                @forelse ($produkAktif ?? [] as $produk)
                    <div class="item-card">
                        <div>
                            <span class="item-badge">Stok: {{ $produk->stok ?? 0 }}</span>
                            <div class="item-name">{{ $produk->nama_produk }}</div>
                            <div class="item-desc">{{ ($produk->stok ?? 0) < 5 ? 'Stok menipis' : 'Stok tersedia' }}</div>
                        </div>
                        <div class="item-footer">
                            <span class="item-price">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                            <a href="{{ route('login') }}" class="button button-primary" style="padding:7px 14px; font-size:12.5px;">Login untuk Beli</a>
                        </div>
                    </div>
                @empty
                    <div class="empty-note" style="grid-column: 1 / -1;">Belum ada produk aktif yang ditambahkan oleh Admin.</div>
                @endforelse
            </div>
        </section>
    </div>
</body>
</html>
