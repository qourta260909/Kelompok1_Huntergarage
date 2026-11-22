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
        Schema::create('tb_datapesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('tb_pesanan')->cascadeOnDelete();
            $table->foreignId('layanan_id')->nullable()->constrained('tb_layanan')->nullOnDelete();
            $table->foreignId('produk_id')->nullable()->constrained('tb_produk')->nullOnDelete();
            $table->string('nama_item');
            $table->decimal('harga', 12, 2)->default(0);
            $table->integer('qty')->default(1);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_datapesanan');
    }
};
