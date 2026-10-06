<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_pesanans', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nama_layanan')->nullable();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->string('status')->default('baru');
        });

        Schema::table('riwayat_pembayarans', function (Blueprint $table) {
            $table->foreignId('data_pesanan_id')
                ->nullable()
                ->constrained('data_pesanans')
                ->nullOnDelete();
            $table->decimal('jumlah', 12, 2)->default(0);
            $table->string('status')->default('menunggu');
            $table->timestamp('dibayar_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_pembayarans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('data_pesanan_id');
            $table->dropColumn(['jumlah', 'status', 'dibayar_pada']);
        });

        Schema::table('data_pesanans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['nama_layanan', 'total_harga', 'status']);
        });
    }
};
