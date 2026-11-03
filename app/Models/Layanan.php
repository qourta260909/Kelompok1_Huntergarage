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
        'nama_layanan',
        'deskripsi',
        'harga',
        'estimasi_durasi',
    ];

    public function riwayatLayanan(): HasMany
    {
        return $this->hasMany(DataLayanan::class, 'layanan_id');
    }

    public function jadwalServices(): HasMany
    {
        return $this->hasMany(JadwalService::class, 'layanan_id');
    }
}
