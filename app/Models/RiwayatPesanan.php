<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPesanan extends Model
{
    use HasFactory;

    protected $table = 'tb_riwayatpesanan';

    protected $fillable = [
        'pesanan_id',
        'user_id',
        'total_harga',
        'status_akhir',
        'tanggal_selesai',
        'catatan',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
