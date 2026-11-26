<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tb_kendaraan')) {
            Schema::create('tb_kendaraan', function (Blueprint $table) {
                $table->id();
                $table->string('merek', 100);
                $table->string('jenis_kendaraan', 100)->default('Matic');
                $table->string('model', 120);
                $table->timestamps();

                $table->unique(['merek', 'model'], 'tb_kendaraan_merek_model_unique');
            });

            $now = now();
            $defaultVehicles = [
                'Honda' => [
                    ['model' => 'Vario 125', 'jenis' => 'Matic'],
                    ['model' => 'Vario 160', 'jenis' => 'Matic'],
                    ['model' => 'BeAT', 'jenis' => 'Matic'],
                    ['model' => 'Scoopy', 'jenis' => 'Matic'],
                    ['model' => 'PCX 160', 'jenis' => 'Matic'],
                    ['model' => 'ADV 160', 'jenis' => 'Matic'],
                    ['model' => 'Genio', 'jenis' => 'Matic'],
                    ['model' => 'Stylo 160', 'jenis' => 'Matic'],
                    ['model' => 'Supra X 125', 'jenis' => 'Bebek'],
                    ['model' => 'Revo', 'jenis' => 'Bebek'],
                    ['model' => 'CBR 150R', 'jenis' => 'Sport'],
                    ['model' => 'CBR 250RR', 'jenis' => 'Sport'],
                    ['model' => 'CB150R StreetFire', 'jenis' => 'Sport'],
                    ['model' => 'CRF 150L', 'jenis' => 'Trail'],
                ],
                'Yamaha' => [
                    ['model' => 'NMAX', 'jenis' => 'Matic'],
                    ['model' => 'Aerox 155', 'jenis' => 'Matic'],
                    ['model' => 'Lexi', 'jenis' => 'Matic'],
                    ['model' => 'Mio M3', 'jenis' => 'Matic'],
                    ['model' => 'Fazzio', 'jenis' => 'Matic'],
                    ['model' => 'Grand Filano', 'jenis' => 'Matic'],
                    ['model' => 'XMAX', 'jenis' => 'Matic'],
                    ['model' => 'Jupiter Z1', 'jenis' => 'Bebek'],
                    ['model' => 'MX King 150', 'jenis' => 'Bebek'],
                    ['model' => 'F1ZR', 'jenis' => 'Bebek'],
                    ['model' => 'R15', 'jenis' => 'Sport'],
                    ['model' => 'R25', 'jenis' => 'Sport'],
                    ['model' => 'Vixion', 'jenis' => 'Sport'],
                    ['model' => 'MT-15', 'jenis' => 'Sport'],
                    ['model' => 'WR 155R', 'jenis' => 'Trail'],
                ],
                'Suzuki' => [
                    ['model' => 'Nex II', 'jenis' => 'Matic'],
                    ['model' => 'Address', 'jenis' => 'Matic'],
                    ['model' => 'Burgman Street 125', 'jenis' => 'Matic'],
                    ['model' => 'Satria F150', 'jenis' => 'Bebek'],
                    ['model' => 'GSX-R150', 'jenis' => 'Sport'],
                    ['model' => 'GSX-S150', 'jenis' => 'Sport'],
                    ['model' => 'V-Strom 250 SX', 'jenis' => 'Sport'],
                ],
                'Kawasaki' => [
                    ['model' => 'Ninja 250', 'jenis' => 'Sport'],
                    ['model' => 'Ninja ZX-25R', 'jenis' => 'Sport'],
                    ['model' => 'Z250', 'jenis' => 'Sport'],
                    ['model' => 'W175', 'jenis' => 'Sport'],
                    ['model' => 'Versys-X 250', 'jenis' => 'Sport'],
                    ['model' => 'KLX 150', 'jenis' => 'Trail'],
                    ['model' => 'D-Tracker 150', 'jenis' => 'Trail'],
                ],
                'Vespa' => [
                    ['model' => 'Sprint 150', 'jenis' => 'Matic'],
                    ['model' => 'Primavera 150', 'jenis' => 'Matic'],
                    ['model' => 'LX 125', 'jenis' => 'Matic'],
                    ['model' => 'GTS 150', 'jenis' => 'Matic'],
                    ['model' => 'GTS 300', 'jenis' => 'Matic'],
                ],
            ];

            $rows = [];
            foreach ($defaultVehicles as $merek => $items) {
                foreach ($items as $item) {
                    $rows[] = [
                        'merek' => $merek,
                        'jenis_kendaraan' => $item['jenis'],
                        'model' => $item['model'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
            DB::table('tb_kendaraan')->insert($rows);
        }

        if (!Schema::hasTable('tb_kategori_produk')) {
            Schema::create('tb_kategori_produk', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kategori', 120)->unique();
                $table->string('slug', 140)->unique();
                $table->timestamps();
            });

            $now = now();
            $defaultCategories = [
                'Oli & Pelumas',
                'Aki & Kelistrikan',
                'Pengereman',
                'Ban & Kaki-Kaki',
                'Filter & Pembakaran',
                'Transmisi & CVT',
                'Suku Cadang Mesin',
                'Aksesoris',
            ];

            $catRows = [];
            foreach ($defaultCategories as $catName) {
                $catRows[] = [
                    'nama_kategori' => $catName,
                    'slug' => Str::slug($catName),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('tb_kategori_produk')->insert($catRows);

            if (Schema::hasTable('tb_produk')) {
                $existingProductCats = DB::table('tb_produk')
                    ->whereNotNull('kategori')
                    ->where('kategori', '!=', '')
                    ->pluck('kategori')
                    ->unique();

                foreach ($existingProductCats as $existingCat) {
                    $trimmed = trim((string) $existingCat);
                    if ($trimmed !== '' && !DB::table('tb_kategori_produk')->where('nama_kategori', $trimmed)->exists()) {
                        DB::table('tb_kategori_produk')->insert([
                            'nama_kategori' => $trimmed,
                            'slug' => Str::slug($trimmed) ?: ('kategori-' . Str::lower(Str::random(6))),
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    }
                }
            }
        }

        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'no_telepon')) {
                    $table->string('no_telepon', 30)->nullable()->after('role');
                }
                if (!Schema::hasColumn('users', 'alamat')) {
                    $table->text('alamat')->nullable()->after('no_telepon');
                }
                if (!Schema::hasColumn('users', 'otp_code')) {
                    $table->string('otp_code', 10)->nullable()->after('remember_token');
                }
                if (!Schema::hasColumn('users', 'otp_expires_at')) {
                    $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
                }
            });
        }

        if (Schema::hasTable('tb_layanan')) {
            Schema::table('tb_layanan', function (Blueprint $table) {
                if (!Schema::hasColumn('tb_layanan', 'kode_layanan')) {
                    $table->string('kode_layanan')->nullable()->after('id');
                }
                if (!Schema::hasColumn('tb_layanan', 'deskripsi')) {
                    $table->text('deskripsi')->nullable()->after('nama_layanan');
                }
                if (!Schema::hasColumn('tb_layanan', 'estimasi_durasi')) {
                    $table->string('estimasi_durasi')->nullable()->after('harga');
                }
                if (!Schema::hasColumn('tb_layanan', 'status')) {
                    $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
                }
            });
        }

        if (Schema::hasTable('tb_produk')) {
            Schema::table('tb_produk', function (Blueprint $table) {
                if (!Schema::hasColumn('tb_produk', 'kode_produk')) {
                    $table->string('kode_produk')->nullable()->after('id');
                }
                if (!Schema::hasColumn('tb_produk', 'gambar')) {
                    $table->string('gambar')->nullable()->after('nama_produk');
                }
                if (!Schema::hasColumn('tb_produk', 'deskripsi')) {
                    $table->text('deskripsi')->nullable();
                }
                if (!Schema::hasColumn('tb_produk', 'kategori')) {
                    $table->string('kategori')->nullable();
                }
                if (!Schema::hasColumn('tb_produk', 'stok')) {
                    $table->integer('stok')->default(0);
                }
                if (!Schema::hasColumn('tb_produk', 'harga_jual')) {
                    $table->decimal('harga_jual', 12, 2)->default(0);
                }
                if (!Schema::hasColumn('tb_produk', 'status')) {
                    $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
                }
            });
        }

        if (Schema::hasTable('tb_jadwalservice')) {
            Schema::table('tb_jadwalservice', function (Blueprint $table) {
                if (!Schema::hasColumn('tb_jadwalservice', 'no_plat_kendaraan')) {
                    $table->string('no_plat_kendaraan')->nullable();
                }
                if (!Schema::hasColumn('tb_jadwalservice', 'tipe_kendaraan')) {
                    $table->string('tipe_kendaraan')->nullable();
                }
                if (!Schema::hasColumn('tb_jadwalservice', 'tanggal_service')) {
                    $table->date('tanggal_service')->nullable();
                }
                if (!Schema::hasColumn('tb_jadwalservice', 'jam_service')) {
                    $table->time('jam_service')->nullable();
                }
                if (!Schema::hasColumn('tb_jadwalservice', 'keluhan')) {
                    $table->text('keluhan')->nullable();
                }
                if (!Schema::hasColumn('tb_jadwalservice', 'status')) {
                    $table->string('status')->default('menunggu');
                }
            });
        }

        if (Schema::hasTable('tb_pesanan')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                if (!Schema::hasColumn('tb_pesanan', 'kode_booking')) {
                    $table->string('kode_booking', 30)->nullable()->after('id');
                }
                if (!Schema::hasColumn('tb_pesanan', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'layanan_id')) {
                    $table->unsignedBigInteger('layanan_id')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'produk_id')) {
                    $table->unsignedBigInteger('produk_id')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'jadwalservice_id')) {
                    $table->unsignedBigInteger('jadwalservice_id')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'nama_pelanggan')) {
                    $table->string('nama_pelanggan')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'no_telepon')) {
                    $table->string('no_telepon', 30)->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'alamat')) {
                    $table->text('alamat')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'layanan_pengiriman')) {
                    $table->string('layanan_pengiriman', 50)->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'ongkir')) {
                    $table->decimal('ongkir', 12, 2)->default(0);
                }
                if (!Schema::hasColumn('tb_pesanan', 'bukti_pembayaran')) {
                    $table->string('bukti_pembayaran')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'kategori')) {
                    $table->string('kategori')->default('layanan');
                }
                if (!Schema::hasColumn('tb_pesanan', 'nama_layanan')) {
                    $table->string('nama_layanan')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'jadwal_service')) {
                    $table->dateTime('jadwal_service')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'total_harga')) {
                    $table->decimal('total_harga', 12, 2)->default(0);
                }
                if (!Schema::hasColumn('tb_pesanan', 'status')) {
                    $table->string('status')->default('baru');
                }
                if (!Schema::hasColumn('tb_pesanan', 'rating')) {
                    $table->unsignedTinyInteger('rating')->nullable();
                }
                if (!Schema::hasColumn('tb_pesanan', 'ulasan')) {
                    $table->text('ulasan')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'otp_expires_at')) {
                    $table->dropColumn('otp_expires_at');
                }
                if (Schema::hasColumn('users', 'otp_code')) {
                    $table->dropColumn('otp_code');
                }
            });
        }

        Schema::dropIfExists('tb_kategori_produk');
        Schema::dropIfExists('tb_kendaraan');
    }
};
