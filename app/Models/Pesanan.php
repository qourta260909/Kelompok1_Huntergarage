<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'tb_pesanan';

    protected $fillable = [
        'user_id',
        'jadwalservice_id',
        'nama_pelanggan',
        'kategori',
        'nama_layanan',
        'jadwal_service',
        'total_harga',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jadwalService(): BelongsTo
    {
        return $this->belongsTo(JadwalService::class, 'jadwalservice_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(DataPesanan::class, 'pesanan_id');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'pesanan_id');
    }

    public function riwayat(): HasOne
    {
        return $this->hasOne(RiwayatPesanan::class, 'pesanan_id');
    }
}
