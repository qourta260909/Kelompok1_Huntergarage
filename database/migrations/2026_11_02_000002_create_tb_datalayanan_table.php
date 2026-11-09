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
        Schema::create('tb_datalayanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('layanan_id')->nullable()->constrained('tb_layanan')->nullOnDelete();
            $table->string('no_plat')->nullable();
            $table->string('nama_kendaraan')->nullable();
            $table->date('tanggal_layanan')->nullable();
            $table->decimal('biaya', 12, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_datalayanan');
    }
};
