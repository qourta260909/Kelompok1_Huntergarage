<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tb_pesanan')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                if (!Schema::hasColumn('tb_pesanan', 'layanan_pengiriman')) {
                    $table->string('layanan_pengiriman', 50)->nullable()->after('alamat');
                }
                if (!Schema::hasColumn('tb_pesanan', 'ongkir')) {
                    $table->decimal('ongkir', 12, 2)->default(0)->after('layanan_pengiriman');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('tb_pesanan')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                if (Schema::hasColumn('tb_pesanan', 'ongkir')) {
                    $table->dropColumn('ongkir');
                }
                if (Schema::hasColumn('tb_pesanan', 'layanan_pengiriman')) {
                    $table->dropColumn('layanan_pengiriman');
                }
            });
        }
    }
};
