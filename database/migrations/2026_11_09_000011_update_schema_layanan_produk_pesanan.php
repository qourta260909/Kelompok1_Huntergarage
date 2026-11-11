<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('tb_datalayanan');
        Schema::dropIfExists('tb_stok');

        if (Schema::hasTable('tb_layanan')) {
            Schema::table('tb_layanan', function (Blueprint $table) {
                if (!Schema::hasColumn('tb_layanan', 'kode_layanan')) {
                    $table->string('kode_layanan')->nullable()->after('id');
                }
                if (!Schema::hasColumn('tb_layanan', 'status')) {
                    $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('estimasi_durasi');
                }
            });
        }

        if (Schema::hasTable('tb_produk')) {
            Schema::table('tb_produk', function (Blueprint $table) {
                if (!Schema::hasColumn('tb_produk', 'deskripsi')) {
                    $table->text('deskripsi')->nullable()->after('nama_produk');
                }
                if (!Schema::hasColumn('tb_produk', 'stok')) {
                    $table->integer('stok')->default(0)->after('kategori');
                }
                if (!Schema::hasColumn('tb_produk', 'status')) {
                    $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('harga_jual');
                }
            });
        }

        if (Schema::hasTable('tb_pesanan')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                if (!Schema::hasColumn('tb_pesanan', 'layanan_id')) {
                    $table->foreignId('layanan_id')->nullable()->after('user_id')->constrained('tb_layanan')->nullOnDelete();
                }
                if (!Schema::hasColumn('tb_pesanan', 'produk_id')) {
                    $table->foreignId('produk_id')->nullable()->after('layanan_id')->constrained('tb_produk')->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        //
    }
};
