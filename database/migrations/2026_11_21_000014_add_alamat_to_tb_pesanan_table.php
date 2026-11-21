<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tb_pesanan') && !Schema::hasColumn('tb_pesanan', 'alamat')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                $table->text('alamat')->nullable()->after('no_telepon');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('tb_pesanan') && Schema::hasColumn('tb_pesanan', 'alamat')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                $table->dropColumn('alamat');
            });
        }
    }
};
