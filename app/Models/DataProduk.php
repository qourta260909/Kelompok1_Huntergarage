<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataProduk extends Model
{
    use HasFactory;

    protected $table = 'tb_dataproduk';

    protected $fillable = [
        'produk_id',
        'jumlah',
        'harga_satuan',
        'total_biaya',
        'keterangan',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
