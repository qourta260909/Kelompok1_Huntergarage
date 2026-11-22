<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('tb_dataproduk');
        Schema::dropIfExists('tb_datalayanan');
        Schema::dropIfExists('tb_stok');
    }

    public function down(): void
    {
        // Tabel-tabel ini sudah tidak digunakan oleh aplikasi.
    }
};
