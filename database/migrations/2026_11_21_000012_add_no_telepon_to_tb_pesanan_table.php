<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tb_pesanan') && !Schema::hasColumn('tb_pesanan', 'no_telepon')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                $table->string('no_telepon', 30)->nullable()->after('nama_pelanggan');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('tb_pesanan') && Schema::hasColumn('tb_pesanan', 'no_telepon')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                $table->dropColumn('no_telepon');
            });
        }
    }
};
