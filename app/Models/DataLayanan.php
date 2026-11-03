<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataLayanan extends Model
{
    use HasFactory;

    protected $table = 'tb_datalayanan';

    protected $fillable = [
        'user_id',
        'layanan_id',
        'no_plat',
        'nama_kendaraan',
        'tanggal_layanan',
        'biaya',
        'catatan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}
