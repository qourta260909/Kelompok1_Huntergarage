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
        Schema::create('tb_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('tb_produk')->cascadeOnDelete();
            $table->integer('jumlah_stok')->default(0);
            $table->integer('stok_minimum')->default(5);
            $table->string('satuan')->default('pcs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_stok');
    }
};
