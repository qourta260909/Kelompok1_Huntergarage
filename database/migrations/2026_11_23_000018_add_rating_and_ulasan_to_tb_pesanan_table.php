<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_pesanan', function (Blueprint $table) {
            if (!Schema::hasColumn('tb_pesanan', 'rating')) {
                $table->unsignedTinyInteger('rating')->nullable()->after('status');
            }
            if (!Schema::hasColumn('tb_pesanan', 'ulasan')) {
                $table->text('ulasan')->nullable()->after('rating');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tb_pesanan', function (Blueprint $table) {
            if (Schema::hasColumn('tb_pesanan', 'ulasan')) {
                $table->dropColumn('ulasan');
            }
            if (Schema::hasColumn('tb_pesanan', 'rating')) {
                $table->dropColumn('rating');
            }
        });
    }
};
