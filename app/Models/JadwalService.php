<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JadwalService extends Model
{
    use HasFactory;

    protected $table = 'tb_jadwalservice';

    protected $fillable = [
        'user_id',
        'layanan_id',
        'no_plat_kendaraan',
        'tipe_kendaraan',
        'tanggal_service',
        'jam_service',
        'keluhan',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function pesanan(): HasOne
    {
        return $this->hasOne(Pesanan::class, 'jadwalservice_id');
    }
}
