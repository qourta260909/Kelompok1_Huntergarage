<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'tb_pesanan';

    protected $fillable = [
        'kode_booking',
        'user_id',
        'layanan_id',
        'produk_id',
        'jadwalservice_id',
        'nama_pelanggan',
        'no_telepon',
        'alamat',
        'layanan_pengiriman',
        'ongkir',
        'bukti_pembayaran',
        'kategori',
        'nama_layanan',
        'jadwal_service',
        'total_harga',
        'status',
    ];

    protected $appends = [
        'bukti_pembayaran_url',
    ];

    protected static function booted(): void
    {
        static::creating(function (Pesanan $pesanan) {
            if (empty($pesanan->attributes['kode_booking'])) {
                $kategori = ($pesanan->kategori ?? 'layanan') === 'produk' ? 'produk' : 'layanan';
                $pesanan->attributes['kode_booking'] = static::generateNextKodeBooking($kategori);
            }
        });
    }

    public static function generateNextKodeBooking(string $kategori): string
    {
        $isProduk = $kategori === 'produk';
        $prefix = $isProduk ? 'PSN-' : 'BKG-';

        $maxNumber = 0;
        $existingCodes = static::where('kategori', $isProduk ? 'produk' : 'layanan')
            ->whereNotNull('kode_booking')
            ->pluck('kode_booking');

        foreach ($existingCodes as $code) {
            if (preg_match('/(\d+)$/', (string) $code, $matches)) {
                $num = (int) $matches[1];
                if ($num > $maxNumber) {
                    $maxNumber = $num;
                }
            }
        }

        if ($maxNumber === 0) {
            $maxNumber = static::where('kategori', $isProduk ? 'produk' : 'layanan')->count();
        }

        return $prefix . str_pad((string) ($maxNumber + 1), 4, '0', STR_PAD_LEFT);
    }

    public function getKodeBookingAttribute(?string $value): string
    {
        if (!empty($value)) {
            return $value;
        }

        $kategori = $this->kategori ?? 'layanan';
        $prefix = $kategori === 'produk' ? 'PSN-' : 'BKG-';
        $nomor = static::where('kategori', $kategori)
            ->where('id', '<=', $this->id)
            ->count();

        return $prefix . str_pad((string) max(1, $nomor), 4, '0', STR_PAD_LEFT);
    }

    public function getBuktiPembayaranUrlAttribute(): ?string
    {
        $path = $this->bukti_pembayaran;
        if (!$path && $this->relationLoaded('pembayaran')) {
            $path = $this->pembayaran?->bukti_transfer;
        }

        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function jadwalService(): BelongsTo
    {
        return $this->belongsTo(JadwalService::class, 'jadwalservice_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(DataPesanan::class, 'pesanan_id');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'pesanan_id');
    }

    public function riwayat(): HasOne
    {
        return $this->hasOne(RiwayatPesanan::class, 'pesanan_id');
    }
}
