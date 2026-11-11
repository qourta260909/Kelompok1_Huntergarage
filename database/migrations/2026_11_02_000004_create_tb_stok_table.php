<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom stok digabung langsung ke dalam tb_produk
        Schema::dropIfExists('tb_stok');
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_stok');
    }
};
