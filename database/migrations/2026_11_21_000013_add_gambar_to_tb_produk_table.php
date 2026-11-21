<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tb_produk') && !Schema::hasColumn('tb_produk', 'gambar')) {
            Schema::table('tb_produk', function (Blueprint $table) {
                $table->string('gambar')->nullable()->after('nama_produk');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('tb_produk') && Schema::hasColumn('tb_produk', 'gambar')) {
            Schema::table('tb_produk', function (Blueprint $table) {
                $table->dropColumn('gambar');
            });
        }
    }
};
