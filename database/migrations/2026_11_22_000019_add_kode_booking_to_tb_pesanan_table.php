<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tb_pesanan') && !Schema::hasColumn('tb_pesanan', 'kode_booking')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                $table->string('kode_booking', 30)->nullable()->after('id');
            });

            // Isi kode_booking permanen untuk data yang sudah ada (terpisah per kategori)
            $counters = [
                'layanan' => 0,
                'produk' => 0,
            ];

            $rows = DB::table('tb_pesanan')->orderBy('id', 'asc')->get(['id', 'kategori']);
            foreach ($rows as $row) {
                $kategori = ($row->kategori ?? 'layanan') === 'produk' ? 'produk' : 'layanan';
                $counters[$kategori]++;
                $prefix = $kategori === 'produk' ? 'PSN-' : 'BKG-';
                $kode = $prefix . str_pad((string) $counters[$kategori], 4, '0', STR_PAD_LEFT);

                DB::table('tb_pesanan')
                    ->where('id', $row->id)
                    ->update(['kode_booking' => $kode]);
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('tb_pesanan') && Schema::hasColumn('tb_pesanan', 'kode_booking')) {
            Schema::table('tb_pesanan', function (Blueprint $table) {
                $table->dropColumn('kode_booking');
            });
        }
    }
};
