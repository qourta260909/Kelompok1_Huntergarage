<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'tb_produk';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'deskripsi',
        'kategori',
        'stok',
        'harga_jual',
        'status',
    ];

    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'produk_id');
    }

    public function riwayatPemakaian(): HasMany
    {
        return $this->hasMany(DataProduk::class, 'produk_id');
    }
}
