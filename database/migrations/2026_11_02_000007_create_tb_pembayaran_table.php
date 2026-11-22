<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('tb_pesanan')->cascadeOnDelete();
            $table->string('nomor_invoice')->nullable()->unique();
            $table->decimal('jumlah', 12, 2)->default(0);
            $table->string('metode_pembayaran')->default('tunai');
            $table->string('bukti_transfer')->nullable();
            $table->string('status')->default('menunggu');
            $table->timestamp('dibayar_pada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pembayaran');
    }
};
