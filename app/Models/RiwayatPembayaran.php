<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPembayaran extends Model
{
    protected $fillable = [
        'data_pesanan_id',
        'jumlah',
        'status',
        'dibayar_pada',
    ];
}
