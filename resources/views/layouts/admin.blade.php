<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') · Hunter Garage</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite('resources/css/dashboard.css')
    @stack('styles')
</head>
<body class="admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar" id="adminSidebar">
            <a class="admin-brand" href="{{ route('dashboard') }}">
                <span class="admin-brand-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="">
                </span>
                <span class="admin-brand-copy">
                    <strong>Hunter Garage</strong>
                    <small>Admin workspace</small>
                </span>
            </a>

            <p class="sidebar-label">Menu utama</p>
            <nav class="admin-nav" aria-label="Navigasi admin">
                <a href="{{ route('dashboard') }}" class="admin-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" @if (request()->routeIs('dashboard')) aria-current="page" @endif>
                    <svg aria-hidden="true" viewBox="0 0 24 24"><rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('dashboard.pesanan') }}" class="admin-nav-link {{ request()->routeIs('dashboard.pesanan') ? 'active' : '' }}" @if (request()->routeIs('dashboard.pesanan')) aria-current="page" @endif>
                    <svg aria-hidden="true" viewBox="0 0 24 24"><rect x="5" y="4" width="14" height="17" rx="2"/><path d="M9 4V3h6v1M9 9h6M9 13h6M9 17h3"/></svg>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('dashboard.layanan') }}" class="admin-nav-link {{ request()->routeIs('dashboard.layanan') ? 'active' : '' }}" @if (request()->routeIs('dashboard.layanan')) aria-current="page" @endif>
                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.2-3.2a6 6 0 0 1-7.9 7.9l-6.8 6.8a2.1 2.1 0 0 1-3-3l6.8-6.8a6 6 0 0 1 7.9-7.9z"/></svg>
                    <span>Layanan</span>
                </a>
                <a href="{{ route('dashboard.produk') }}" class="admin-nav-link {{ request()->routeIs('dashboard.produk') ? 'active' : '' }}" @if (request()->routeIs('dashboard.produk')) aria-current="page" @endif>
                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="m12 3 9 5v8l-9 5-9-5V8z"/><path d="m3.5 7.8 8.5 5 8.5-5M12 13v8"/></svg>
                    <span>Produk & stok</span>
                </a>
                <a href="{{ route('dashboard.riwayat') }}" class="admin-nav-link {{ request()->routeIs('dashboard.riwayat') ? 'active' : '' }}" @if (request()->routeIs('dashboard.riwayat')) aria-current="page" @endif>
                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 2.6-6.4L3 8"/><path d="M3 3v5h5m4-1v5l3 2"/></svg>
                    <span>Riwayat</span>
                </a>
            </nav>

            <p class="sidebar-label sidebar-label-account">Akun</p>
            <nav class="admin-nav" aria-label="Akun">
                <a href="{{ route('dashboard.profile') }}" class="admin-nav-link {{ request()->routeIs('dashboard.profile') ? 'active' : '' }}" @if (request()->routeIs('dashboard.profile')) aria-current="page" @endif>
                    <svg aria-hidden="true" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.5"/><path d="M5 20v-1a7 7 0 0 1 14 0v1z"/></svg>
                    <span>Profil</span>
                </a>
            </nav>

            <div class="sidebar-account">
                <span class="user-avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                <span class="sidebar-account-copy">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>Administrator</small>
                </span>
            </div>
        </aside>

        <button class="sidebar-backdrop" id="sidebarBackdrop" type="button" aria-label="Tutup menu"></button>

        <div class="admin-main">
            <header class="admin-topbar">
                <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Buka menu" aria-controls="adminSidebar" aria-expanded="false">
                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="topbar-context">
                    <span>Hunter Garage</span>
                    <span class="topbar-separator">/</span>
                    <span>Workspace admin</span>
                </div>
                <div class="topbar-actions">
                    <div class="topbar-user">
                        <span class="user-avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <button class="logout-trigger" type="button" onclick="openLogoutModal()" aria-label="Keluar dari akun" title="Keluar">
                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M10 17l5-5-5-5M15 12H3m9-7h6a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-6"/></svg>
                    </button>
                </div>
            </header>

            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>

    <x-logout-modal />

    <script>
        const adminSidebar = document.getElementById('adminSidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');

        function setSidebarOpen(open) {
            adminSidebar.classList.toggle('is-open', open);
            sidebarBackdrop.classList.toggle('is-visible', open);
            sidebarToggle.setAttribute('aria-expanded', String(open));
            document.body.classList.toggle('sidebar-open', open);
        }

        sidebarToggle.addEventListener('click', () => {
            setSidebarOpen(!adminSidebar.classList.contains('is-open'));
        });
        sidebarBackdrop.addEventListener('click', () => setSidebarOpen(false));
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') setSidebarOpen(false);
        });
    </script>
    @stack('scripts')
</body>
</html>
