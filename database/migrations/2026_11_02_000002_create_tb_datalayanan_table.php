<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel tb_layanan berfungsi murni sebagai master menu layanan (tanpa user_id & data_kendaraan)
        Schema::dropIfExists('tb_datalayanan');
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_datalayanan');
    }
};
