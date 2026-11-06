@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')
    @php
        $totalRiwayatLayanan = $layanan->sum('riwayat_layanan_count');
    @endphp

    <header class="page-heading">
        <div>
            <h1>Layanan</h1>
            <p>Daftar layanan dan harga yang tersedia di Hunter Garage.</p>
        </div>
    </header>

    <section class="stats-grid" aria-label="Ringkasan layanan">
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Jenis layanan</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.2-3.2a6 6 0 0 1-7.9 7.9l-6.8 6.8a2.1 2.1 0 0 1-3-3l6.8-6.8a6 6 0 0 1 7.9-7.9z"/></svg></span></div>
            <strong class="stat-value">{{ number_format($layanan->count(), 0, ',', '.') }}</strong>
            <span class="stat-note">Layanan terdaftar</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Riwayat pengerjaan</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 2.6-6.4L3 8"/><path d="M3 3v5h5m4-1v5l3 2"/></svg></span></div>
            <strong class="stat-value">{{ number_format($totalRiwayatLayanan, 0, ',', '.') }}</strong>
            <span class="stat-note">Pengerjaan tercatat</span>
        </article>
        <article class="stat-card">
            <div class="stat-card-top"><span class="stat-label">Rata-rata harga</span><span class="stat-icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 2v20M17 6.5c0-1.4-1.7-2.5-4-2.5H10a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-3c-2.3 0-4-1.1-4-2.5"/></svg></span></div>
            <strong class="stat-value">Rp {{ number_format($layanan->avg('harga') ?? 0, 0, ',', '.') }}</strong>
            <span class="stat-note">Dari layanan terdaftar</span>
        </article>
    </section>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Daftar layanan</h2>
                <p class="panel-description">Harga, estimasi durasi, dan riwayat pengerjaan.</p>
            </div>
        </div>
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th>Deskripsi</th>
                        <th>Estimasi durasi</th>
                        <th>Harga</th>
                        <th>Pengerjaan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($layanan as $item)
                        <tr>
                            <td><span class="table-primary">{{ $item->nama_layanan }}</span></td>
                            <td>{{ $item->deskripsi ?: 'Deskripsi belum tersedia' }}</td>
                            <td>{{ $item->estimasi_durasi ?: 'Belum ditentukan' }}</td>
                            <td class="numeric">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="numeric">{{ number_format($item->riwayat_layanan_count, 0, ',', '.') }} kali</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <strong>Belum ada layanan terdaftar.</strong>
                                    <p>Daftar layanan akan tampil setelah datanya tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
