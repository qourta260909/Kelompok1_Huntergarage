<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPesanan extends Model
{
    protected $fillable = [
        'user_id',
        'nama_layanan',
        'total_harga',
        'status',
    ];
}
