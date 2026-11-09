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
        Schema::create('tb_pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('jadwalservice_id')->nullable()->constrained('tb_jadwalservice')->nullOnDelete();
            $table->string('nama_pelanggan')->nullable();
            $table->string('kategori')->default('layanan');
            $table->string('nama_layanan')->nullable();
            $table->dateTime('jadwal_service')->nullable();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->string('status')->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pesanan');
    }
};
