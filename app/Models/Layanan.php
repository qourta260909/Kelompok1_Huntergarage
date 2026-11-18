<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'tb_layanan';

    protected $fillable = [
        'kode_layanan',
        'nama_layanan',
        'deskripsi',
        'harga',
        'estimasi_durasi',
        'status',
    ];

    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'layanan_id');
    }

    public function jadwalServices(): HasMany
    {
        return $this->hasMany(JadwalService::class, 'layanan_id');
    }
}
