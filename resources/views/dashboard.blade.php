<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Hunter Garage</title>
    @vite('resources/css/dashboard.css')
</head>
<body>

    <div class="layout-container">

        <!-- ================= SIDEBAR ================= -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="logo-link">
                    <div class="logo-box">H</div>
                </a>
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <div class="brand-title">Hunter Garage</div>
                    <div class="brand-subtitle">Platform Bisnis</div>
            </div>
             </a>

            <nav class="nav-menu">
                <a href="#" class="nav-link active">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
  <rect x="4" y="4" width="7" height="7" rx="1.5"/>
  <rect x="13" y="4" width="7" height="7" rx="1.5"/>
  <rect x="4" y="13" width="7" height="7" rx="1.5"/>
  <rect x="13" y="13" width="7" height="7" rx="1.5"/>
</svg>
</span> Dashboard
                </a>
                <a href="#" class="nav-link inactive">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <rect x="7" y="5" width="10" height="16" rx="2"/>
  <path d="M9 5V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
  <line x1="10" y1="10" x2="14" y2="10"/>
  <line x1="10" y1="14" x2="14" y2="14"/>
</svg>
</span> Pemesanan
                </a>
                <a href="#" class="nav-link inactive">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.9 6.9a2.12 2.12 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
</svg>
</span> Layanan
                </a>
                <a href="#" class="nav-link inactive">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
  <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
  <line x1="12" y1="22.08" x2="12" y2="12"/>
</svg>
</span> Produk
                </a>
                <a href="#" class="nav-link inactive">
                    <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
  <circle cx="12" cy="8" r="4"/>
  <path d="M4 20c0-4 4-6 8-6s8 2 8 6v1H4v-1z"/>
</svg>
</span> Profile
                </a>
                <a href="#" class="nav-link inactive">
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
                
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin keluar?');">
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
                        <div class="card-icon icon-gray"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Kotak Latar Belakang -->
                            <rect width="40" height="40" rx="10" fill="#EDE9FE"/>
                            <!-- Ikon User/Group -->
                            <path d="M15 17C16.6569 17 18 15.6569 18 14C18 12.3431 16.6569 11 15 11C13.3431 11 12 12.3431 12 14C12 15.6569 13.3431 17 15 17Z" stroke="#7C3AED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                             <path d="M22 19C23.1046 19 24 18.1046 24 17C24 15.8954 23.1046 15 22 15" stroke="#7C3AED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M9 26V25C9 23.3431 10.3431 22 12 22H18C19.6569 22 21 23.3431 21 25V26" stroke="#7C3AED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                         <path d="M24 26V25C24 23.9515 23.284 23.072 22.308 22.825" stroke="#7C3AED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                </div>
                    </div>
                    <div class="card-value">-</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pesanan Baru</div>
                        <div class="card-icon icon-amber"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Kotak Latar Belakang -->
  <rect width="40" height="40" rx="10" fill="#FEF3C7"/>
  <!-- Ikon Tas Belanja -->
  <path d="M13 14H27L28 27H12L13 14Z" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M16 14V11C16 9.89543 16.8954 9 18 9H22C23.1046 9 24 9.89543 24 11V14" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M17 19H23" stroke="#F59E0B" stroke-width="2" stroke-linecap="round"/>
</svg>
</div>
                    </div>
                    <div class="card-value">-</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Total Penjualan</div>
                        <div class="card-icon icon-gray"><svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Kotak Latar Belakang dengan Sudut Melengkung -->
  <rect width="64" height="64" rx="16" fill="#E2F2ED"/>
  
  <!-- Ikon Simbol Dollar -->
  <path d="M32 16V48" stroke="#0D9488" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M40 24H26C23.7909 24 22 25.7909 22 28C22 30.2091 23.7909 32 26 32H38C40.2091 32 42 33.7909 42 36C42 38.2091 40.2091 40 38 40H24" stroke="#0D9488" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                    </div>
                    <div class="card-value">-</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pendapatan Baru</div>
                        <div class="card-icon icon-teal"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Kotak Latar Belakang -->
  <rect width="40" height="40" rx="10" fill="#FEE2E2"/>
  <!-- Ikon Grafik Naik -->
  <path d="M12 25L17.5 19.5L21.5 23.5L28 15" stroke="#DC2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M23 15H28V20" stroke="#DC2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
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