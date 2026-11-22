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
        'gambar',
        'deskripsi',
        'kategori',
        'stok',
        'harga_jual',
        'status',
    ];

    protected $appends = [
        'gambar_url',
        'status_stok',
        'stok_label',
    ];

    public function getGambarUrlAttribute(): ?string
    {
        if (!$this->gambar) {
            return null;
        }

        if (str_starts_with($this->gambar, 'http://') || str_starts_with($this->gambar, 'https://')) {
            return $this->gambar;
        }

        if (str_starts_with($this->gambar, 'images/')) {
            return asset($this->gambar);
        }

        return asset('storage/' . ltrim($this->gambar, '/'));
    }

    public function getStatusStokAttribute(): string
    {
        $stok = (int) ($this->stok ?? 0);

        if ($stok <= 0) {
            return 'Habis';
        }

        if ($stok < 5) {
            return 'Menipis';
        }

        return 'Aman';
    }

    public function getStokLabelAttribute(): string
    {
        return ((int) ($this->stok ?? 0)) . ' Pcs';
    }

    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'produk_id');
    }
}
