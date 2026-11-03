<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPembayaran extends Model
{
    use HasFactory;

    protected $table = 'tb_pembayaran';

    protected $fillable = [
        'pesanan_id',
        'nomor_invoice',
        'jumlah',
        'metode_pembayaran',
        'bukti_transfer',
        'status',
        'dibayar_pada',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}
