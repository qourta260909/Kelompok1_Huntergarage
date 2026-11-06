@extends('layouts.admin')

@section('title', 'Riwayat')

@section('content')
    <header class="page-heading">
        <div>
            <h1>Riwayat pesanan</h1>
            <p>Pesanan berstatus selesai, disusun dari pembaruan terbaru.</p>
        </div>
    </header>

    <section class="stats-grid stats-grid-two" aria-label="Ringkasan riwayat">
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Pesanan selesai</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M5 12.5 9.5 17 19 7.5"/></svg></span></div>
            <strong class="stat-value">{{ number_format($totalRiwayat, 0, ',', '.') }}</strong>
            <span class="stat-note">Total pesanan selesai</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Nilai pesanan selesai</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 2v20M17 6.5c0-1.4-1.7-2.5-4-2.5H10a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-3c-2.3 0-4-1.1-4-2.5"/></svg></span></div>
            <strong class="stat-value">Rp {{ number_format($nilaiPesananSelesai, 0, ',', '.') }}</strong>
            <span class="stat-note">Akumulasi nilai pesanan</span>
        </article>
    </section>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Catatan pesanan selesai</h2>
                <p class="panel-description">Riwayat diambil dari pesanan dengan status selesai.</p>
            </div>
        </div>
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Layanan / produk</th>
                        <th>Tanggal diperbarui</th>
                        <th>Nilai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesananSelesai as $pesanan)
                        <tr>
                            <td class="numeric">#{{ $pesanan->id }}</td>
                            <td><span class="table-primary">{{ $pesanan->nama_pelanggan ?? 'Pelanggan dihapus' }}</span></td>
                            <td>{{ $pesanan->nama_layanan ?? '—' }}</td>
                            <td class="numeric">
                                @if ($pesanan->updated_at)
                                    {{ \Carbon\Carbon::parse($pesanan->updated_at)->locale('id')->translatedFormat('d M Y, H:i') }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="numeric">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td><span class="status-badge status-success">Selesai</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <strong>Belum ada riwayat pesanan.</strong>
                                    <p>Pesanan yang sudah selesai akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pesananSelesai->hasPages())
            <div class="pagination-wrap">{{ $pesananSelesai->links() }}</div>
        @endif
    </section>
@endsection
