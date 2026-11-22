<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_pesanan', function (Blueprint $table) {
            if (!Schema::hasColumn('tb_pesanan', 'bukti_pembayaran')) {
                $table->string('bukti_pembayaran')->nullable()->after('alamat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tb_pesanan', function (Blueprint $table) {
            if (Schema::hasColumn('tb_pesanan', 'bukti_pembayaran')) {
                $table->dropColumn('bukti_pembayaran');
            }
        });
    }
};
