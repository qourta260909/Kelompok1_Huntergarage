<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'tb_kendaraan';

    protected $fillable = [
        'merek',
        'jenis_kendaraan',
        'model',
    ];

    /**
     * Katalog lengkap merek, jenis, dan model motor resmi dari brand yang beredar di Indonesia.
     *
     * @return array<string, array<int, array{model: string, jenis: string}>>
     */
    public static function katalogBrandDefault(): array
    {
        return [
            'Honda' => [
                // Matic
                ['model' => 'BeAT CBS / Deluxe', 'jenis' => 'Matic'],
                ['model' => 'BeAT Street', 'jenis' => 'Matic'],
                ['model' => 'Genio', 'jenis' => 'Matic'],
                ['model' => 'Scoopy', 'jenis' => 'Matic'],
                ['model' => 'Stylo 160', 'jenis' => 'Matic'],
                ['model' => 'Vario 110', 'jenis' => 'Matic'],
                ['model' => 'Vario 125', 'jenis' => 'Matic'],
                ['model' => 'Vario 150', 'jenis' => 'Matic'],
                ['model' => 'Vario 160', 'jenis' => 'Matic'],
                ['model' => 'PCX 150', 'jenis' => 'Matic'],
                ['model' => 'PCX 160', 'jenis' => 'Matic'],
                ['model' => 'ADV 150', 'jenis' => 'Matic'],
                ['model' => 'ADV 160', 'jenis' => 'Matic'],
                ['model' => 'Forza 250', 'jenis' => 'Matic'],
                ['model' => 'Spacy', 'jenis' => 'Matic'],
                ['model' => 'EM1 e:', 'jenis' => 'Listrik'],
                // Bebek
                ['model' => 'Revo Fit / X', 'jenis' => 'Bebek'],
                ['model' => 'Supra X 125 FI', 'jenis' => 'Bebek'],
                ['model' => 'Supra GTR 150', 'jenis' => 'Bebek'],
                ['model' => 'Blade 125', 'jenis' => 'Bebek'],
                ['model' => 'Karisma 125', 'jenis' => 'Bebek'],
                ['model' => 'Astrea Grand / Prima', 'jenis' => 'Bebek'],
                ['model' => 'Super Cub C125', 'jenis' => 'Bebek'],
                ['model' => 'CT125', 'jenis' => 'Bebek'],
                // Sport
                ['model' => 'Sonic 150R', 'jenis' => 'Sport'],
                ['model' => 'CB150 Verza', 'jenis' => 'Sport'],
                ['model' => 'CB150R StreetFire', 'jenis' => 'Sport'],
                ['model' => 'CB150X', 'jenis' => 'Sport'],
                ['model' => 'CBR150R', 'jenis' => 'Sport'],
                ['model' => 'CBR250RR', 'jenis' => 'Sport'],
                ['model' => 'Tiger 2000 / Revo', 'jenis' => 'Sport'],
                ['model' => 'MegaPro', 'jenis' => 'Sport'],
                // Trail
                ['model' => 'CRF150L', 'jenis' => 'Trail'],
                ['model' => 'CRF250L / Rally', 'jenis' => 'Trail'],
            ],
            'Yamaha' => [
                // Matic
                ['model' => 'Mio Sporty / Smile', 'jenis' => 'Matic'],
                ['model' => 'Mio J / GT', 'jenis' => 'Matic'],
                ['model' => 'Mio M3 125', 'jenis' => 'Matic'],
                ['model' => 'Gear 125', 'jenis' => 'Matic'],
                ['model' => 'Fazzio Hybrid', 'jenis' => 'Matic'],
                ['model' => 'Grand Filano Hybrid', 'jenis' => 'Matic'],
                ['model' => 'FreeGo 125', 'jenis' => 'Matic'],
                ['model' => 'X-Ride 125', 'jenis' => 'Matic'],
                ['model' => 'Xeon / GT 125', 'jenis' => 'Matic'],
                ['model' => 'Fino 125', 'jenis' => 'Matic'],
                ['model' => 'Soul GT', 'jenis' => 'Matic'],
                ['model' => 'Nouvo Z / Elegance', 'jenis' => 'Matic'],
                ['model' => 'Lexi 125 / LX 155', 'jenis' => 'Matic'],
                ['model' => 'Aerox 155', 'jenis' => 'Matic'],
                ['model' => 'NMAX 155', 'jenis' => 'Matic'],
                ['model' => 'NMAX Turbo / Neo', 'jenis' => 'Matic'],
                ['model' => 'XMAX 250', 'jenis' => 'Matic'],
                ['model' => 'TMAX DX', 'jenis' => 'Matic'],
                // Bebek
                ['model' => 'Vega Force / ZR', 'jenis' => 'Bebek'],
                ['model' => 'Jupiter Z / Z1', 'jenis' => 'Bebek'],
                ['model' => 'Jupiter MX 135', 'jenis' => 'Bebek'],
                ['model' => 'MX King 150', 'jenis' => 'Bebek'],
                ['model' => 'F1ZR', 'jenis' => 'Bebek'],
                // Sport
                ['model' => 'Vixion / Vixion R', 'jenis' => 'Sport'],
                ['model' => 'Byson', 'jenis' => 'Sport'],
                ['model' => 'Scorpio Z', 'jenis' => 'Sport'],
                ['model' => 'RX-King', 'jenis' => 'Sport'],
                ['model' => 'XSR 155', 'jenis' => 'Sport'],
                ['model' => 'MT-15', 'jenis' => 'Sport'],
                ['model' => 'MT-25', 'jenis' => 'Sport'],
                ['model' => 'R15 / R15M', 'jenis' => 'Sport'],
                ['model' => 'R25', 'jenis' => 'Sport'],
                // Trail
                ['model' => 'WR 155 R', 'jenis' => 'Trail'],
            ],
            'Suzuki' => [
                // Matic
                ['model' => 'Nex II / Crossover', 'jenis' => 'Matic'],
                ['model' => 'Address FI / Playful', 'jenis' => 'Matic'],
                ['model' => 'Avenis 125', 'jenis' => 'Matic'],
                ['model' => 'Burgman Street 125EX', 'jenis' => 'Matic'],
                ['model' => 'Skywave 125', 'jenis' => 'Matic'],
                ['model' => 'Skydrive 125', 'jenis' => 'Matic'],
                ['model' => 'Spin 125', 'jenis' => 'Matic'],
                // Bebek
                ['model' => 'Satria F150', 'jenis' => 'Bebek'],
                ['model' => 'Smash FI', 'jenis' => 'Bebek'],
                ['model' => 'Shogun 125', 'jenis' => 'Bebek'],
                // Sport
                ['model' => 'GSX-R150', 'jenis' => 'Sport'],
                ['model' => 'GSX-S150', 'jenis' => 'Sport'],
                ['model' => 'GSX150 Bandit', 'jenis' => 'Sport'],
                ['model' => 'Gixxer SF 250', 'jenis' => 'Sport'],
                ['model' => 'V-Strom 250 SX', 'jenis' => 'Sport'],
                ['model' => 'Thunder 125', 'jenis' => 'Sport'],
            ],
            'Kawasaki' => [
                // Sport
                ['model' => 'Ninja 150 R / RR', 'jenis' => 'Sport'],
                ['model' => 'Ninja 250 SL / Mono', 'jenis' => 'Sport'],
                ['model' => 'Ninja 250 FI', 'jenis' => 'Sport'],
                ['model' => 'Ninja ZX-25R / ZX-25RR', 'jenis' => 'Sport'],
                ['model' => 'Ninja ZX-4RR', 'jenis' => 'Sport'],
                ['model' => 'Z250', 'jenis' => 'Sport'],
                ['model' => 'W175 / W175TR', 'jenis' => 'Sport'],
                ['model' => 'Versys-X 250', 'jenis' => 'Sport'],
                // Trail
                ['model' => 'KLX 150 / S / SE / SM', 'jenis' => 'Trail'],
                ['model' => 'KLX 230 / SM', 'jenis' => 'Trail'],
                ['model' => 'KLX 250', 'jenis' => 'Trail'],
                ['model' => 'D-Tracker 150', 'jenis' => 'Trail'],
                // Bebek
                ['model' => 'Athlete 125', 'jenis' => 'Bebek'],
                ['model' => 'Kaze R', 'jenis' => 'Bebek'],
            ],
            'Vespa' => [
                ['model' => 'LX 125 i-get', 'jenis' => 'Matic'],
                ['model' => 'S 125 i-get', 'jenis' => 'Matic'],
                ['model' => 'Primavera 150', 'jenis' => 'Matic'],
                ['model' => 'Sprint 150 / Sprint S', 'jenis' => 'Matic'],
                ['model' => 'GTS Super 150', 'jenis' => 'Matic'],
                ['model' => 'GTS Super Tech 300', 'jenis' => 'Matic'],
                ['model' => 'GTV 300', 'jenis' => 'Matic'],
            ],
            'TVS' => [
                ['model' => 'Callisto 110 / 125', 'jenis' => 'Matic'],
                ['model' => 'Ntorq 125', 'jenis' => 'Matic'],
                ['model' => 'Dazz 110', 'jenis' => 'Matic'],
                ['model' => 'Ronin 225', 'jenis' => 'Sport'],
                ['model' => 'Apache RTR 200', 'jenis' => 'Sport'],
                ['model' => 'iQube S', 'jenis' => 'Listrik'],
            ],
            'alva / Gesits / Polytron' => [
                ['model' => 'Alva One / Cervo', 'jenis' => 'Listrik'],
                ['model' => 'Gesits G1 / Raya', 'jenis' => 'Listrik'],
                ['model' => 'Polytron Fox-R / Fox-S', 'jenis' => 'Listrik'],
                ['model' => 'United T1800 / TX3000', 'jenis' => 'Listrik'],
            ],
        ];
    }

    /**
     * Sinkronkan katalog lengkap merek & jenis kendaraan otomatis ke tabel tb_kendaraan.
     */
    public static function syncFromBrandCatalog(): void
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('tb_kendaraan')) {
            return;
        }

        foreach (self::katalogBrandDefault() as $merek => $items) {
            $merekNormalized = trim($merek) === 'alva / Gesits / Polytron' ? 'Motor Listrik' : trim($merek);
            foreach ($items as $item) {
                self::firstOrCreate(
                    [
                        'merek' => $merekNormalized,
                        'model' => $item['model'],
                    ],
                    [
                        'jenis_kendaraan' => $item['jenis'],
                    ]
                );
            }
        }
    }
}
