@extends('layouts.admin')

@section('title', 'Produk & stok')

@section('content')
    <header class="page-heading">
        <div>
            <h1>Produk & stok</h1>
            <p>Pantau jumlah barang dan temukan produk yang perlu diperiksa.</p>
        </div>
    </header>

    <section class="stats-grid" aria-label="Ringkasan inventaris">
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Jenis produk</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="m12 3 9 5v8l-9 5-9-5V8zM3.5 7.8l8.5 5 8.5-5M12 13v8"/></svg></span></div>
            <strong class="stat-value">{{ number_format($totalProduk, 0, ',', '.') }}</strong>
            <span class="stat-note">Produk terdaftar</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Total stok</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M5 4h14v16H5zM9 8h6M9 12h6M9 16h3"/></svg></span></div>
            <strong class="stat-value">{{ number_format($totalStok, 0, ',', '.') }}</strong>
            <span class="stat-note">Unit pada catatan stok</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Perlu diperiksa</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 3 2.8 20h18.4L12 3zM12 9v5M12 17h.01"/></svg></span></div>
            <strong class="stat-value">{{ number_format($produkMenipis, 0, ',', '.') }}</strong>
            <span class="stat-note">Produk pada atau di bawah stok minimum</span>
        </article>
    </section>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Daftar produk</h2>
                <p class="panel-description">Jumlah stok dibandingkan dengan batas minimum yang tercatat.</p>
            </div>
        </div>
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Kode</th>
                        <th>Jumlah stok</th>
                        <th>Harga jual</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $item)
                        @php
                            $stok = $item->stok;
                            $stokMenipis = $stok && $stok->jumlah_stok <= $stok->stok_minimum;
                        @endphp
                        <tr>
                            <td><span class="table-primary">{{ $item->nama_produk }}</span></td>
                            <td>{{ $item->kategori ?: '—' }}</td>
                            <td class="numeric">{{ $item->kode_produk ?: '—' }}</td>
                            <td class="numeric">
                                @if ($stok)
                                    {{ number_format($stok->jumlah_stok, 0, ',', '.') }} {{ $stok->satuan }}
                                    <span class="table-secondary">Minimum {{ number_format($stok->stok_minimum, 0, ',', '.') }} {{ $stok->satuan }}</span>
                                @else
                                    Belum dicatat
                                @endif
                            </td>
                            <td class="numeric">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td>
                                @if (!$stok)
                                    <span class="status-badge status-neutral">Belum diatur</span>
                                @elseif ($stokMenipis)
                                    <span class="status-badge status-low">Stok menipis</span>
                                @else
                                    <span class="status-badge status-success">Tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <strong>Belum ada produk terdaftar.</strong>
                                    <p>Produk akan tampil di sini setelah datanya tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
