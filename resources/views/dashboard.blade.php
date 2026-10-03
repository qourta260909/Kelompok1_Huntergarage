<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Hunter Garage</title>
    
    <style>
        /* ================= CSS RESET & GLOBAL ================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #111827;
            -webkit-font-smoothing: antialiased;
        }

        .layout-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 256px;
            background-color: #f59e0b;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar-header {
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-box {
            width: 40px;
            height: 40px;
            background-color: #000;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
        }

        .brand-title {
            font-weight: 800;
            font-size: 15px;
            line-height: 1.2;
            color: #000;
        }

        .brand-subtitle {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: rgba(0, 0, 0, 0.7);
            text-transform: uppercase;
        }

        .nav-menu {
            flex: 1;
            padding: 8px 16px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .nav-link.active {
            background-color: #000;
            color: #fff;
        }

        .nav-link.inactive {
            color: #000;
        }

        .nav-link.inactive:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .nav-icon {
            width: 16px;
            height: 16px;
            border-radius: 4px;
        }

        .nav-link.active .nav-icon { background-color: rgba(255, 255, 255, 0.2); }
        .nav-link.inactive .nav-icon { background-color: rgba(0, 0, 0, 0.2); }

        .mt-auto { margin-top: 16px; }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
            padding: 32px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #f59e0b;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-top: 4px;
        }

        .btn-logout {
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .btn-logout:hover { background-color: #f9fafb; }
        
        .btn-logout svg {
            width: 20px;
            height: 20px;
            color: #374151;
        }

        /* ================= STATS GRID ================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }
        
        @media (min-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        .card {
            background-color: #fff;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .card-title {
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
        }

        .card-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-gray { background-color: #f9fafb; }
        .icon-amber { background-color: #fffbeb; }
        .icon-teal { background-color: #f0fdfa; }

        .card-value {
            font-size: 32px;
            font-weight: 700;
            color: #f59e0b;
            line-height: 1;
            margin-bottom: 12px;
        }

        .card-trend {
            font-size: 12px;
            font-weight: 500;
        }

        .trend-up {
            color: #059669;
            background-color: #ecfdf5;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .trend-text { color: #9ca3af; margin-left: 4px; }

        /* ================= TABLE ================= */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .table-title {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
        }

        .table-subtitle {
            font-size: 14px;
            color: #6b7280;
        }

        .pill-entries {
            background-color: #f9fafb;
            border: 1px solid #f3f4f6;
            color: #4b5563;
            padding: 6px 16px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        th {
            color: #9ca3af;
            font-size: 12px;
            text-transform: uppercase;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
            font-weight: 600;
            width: 20%;
        }

        td {
            padding: 16px 0;
            border-bottom: 1px solid #f9fafb;
            font-size: 14px;
        }

        tr:last-child td { border-bottom: none; }

        .td-bold { font-weight: 700; color: #111827; }
        .td-muted { color: #4b5563; }

        /* ================= STATUS BADGES ================= */
        .badge {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .badge-success { background-color: #ecfdf5; color: #059669; }
        .badge-waiting { background-color: #f1f5f9; color: #475569; }
        .badge-process { background-color: #fef3c7; color: #b45309; }
    </style>
</head>
<body>

    <div class="layout-container">

        <!-- ================= SIDEBAR ================= -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-box">H</div>
                <div>
                    <div class="brand-title">Hunter Garage</div>
                    <div class="brand-subtitle">Platform Bisnis</div>
                </div>
            </div>

            <nav class="nav-menu">
                <a href="#" class="nav-link active">
                    <span class="nav-icon"></span> Dashboard
                </a>
                <a href="#" class="nav-link inactive">
                    <span class="nav-icon"></span> Pemesanan
                </a>
                <a href="#" class="nav-link inactive">
                    <span class="nav-icon"></span> Layanan
                </a>
                <a href="#" class="nav-link inactive">
                    <span class="nav-icon"></span> Produk
                </a>
                <a href="#" class="nav-link inactive">
                    <span class="nav-icon"></span> Profile
                </a>
                <a href="#" class="nav-link inactive mt-auto">
                    <span class="nav-icon"></span> Riwayat
                </a>
            </nav>
        </aside>

        <!-- ================= MAIN CONTENT ================= -->
        <main class="main-content">
            
            <!-- Top Header -->
            <header class="header-top">
                <div>
                    <h2 class="page-title">Dashboard</h2>
                    <p class="page-subtitle">Selamat datang kembali, {{ auth()->user()->name }}. Berikut adalah ringkasan performa bisnis Anda.</p>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </header>

            <!-- Cards Statistik -->
            <div class="stats-grid">
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pelanggan aktif</div>
                        <div class="card-icon icon-gray">👤</div>
                    </div>
                    <div class="card-value">-</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pesanan Baru</div>
                        <div class="card-icon icon-amber">📦</div>
                    </div>
                    <div class="card-value">-</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Total Penjualan</div>
                        <div class="card-icon icon-gray">$</div>
                    </div>
                    <div class="card-value">-</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pendapatan Baru</div>
                        <div class="card-icon icon-teal">📈</div>
                    </div>
                    <div class="card-value">-</div>
                </div>
            </div>

            <!-- Tabel Pesanan Terbaru -->
            <div class="card">
                <div class="table-header">
                    <div>
                        <div class="table-title">Pesanan Terbaru</div>
                        <div class="table-subtitle">Aktivitas pemesanan yang paling baru</div>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data tabel dikosongkan untuk diisi dengan loop data dari backend nanti -->
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</body>
</html>