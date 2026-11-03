<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'tb_produk';

    protected $fillable = [
        'nama_produk',
        'kode_produk',
        'kategori',
        'harga_jual',
    ];

    public function stok(): HasOne
    {
        return $this->hasOne(Stok::class, 'produk_id');
    }

    public function riwayatPemakaian(): HasMany
    {
        return $this->hasMany(DataProduk::class, 'produk_id');
    }
}
