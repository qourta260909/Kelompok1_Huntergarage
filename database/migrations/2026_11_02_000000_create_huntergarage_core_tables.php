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
        // 1. Bersihkan tabel-tabel lama yang kosong & tidak berelasi
        Schema::dropIfExists('riwayat_pembayarans');
        Schema::dropIfExists('data_pesanans');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('data_transfers');
        Schema::dropIfExists('riwayat_invoices');
        Schema::dropIfExists('stoks');
        Schema::dropIfExists('data_layanans');
        Schema::dropIfExists('jadwal_services');

        // 2. Buat tb_layanan (Master Daftar Layanan)
        Schema::create('tb_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2)->default(0);
            $table->string('estimasi_durasi')->nullable();
            $table->timestamps();
        });

        // 3. Buat tb_datalayanan (Riwayat Pengerjaan Layanan)
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

        // 4. Buat tb_produk (Master Daftar Produk / Sparepart)
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('kode_produk')->nullable()->unique();
            $table->string('kategori')->nullable();
            $table->decimal('harga_jual', 12, 2)->default(0);
            $table->timestamps();
        });

        // 5. Buat tb_stok (Manajemen Stok Barang)
        Schema::create('tb_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('tb_produk')->cascadeOnDelete();
            $table->integer('jumlah_stok')->default(0);
            $table->integer('stok_minimum')->default(5);
            $table->string('satuan')->default('pcs');
            $table->timestamps();
        });

        // 6. Buat tb_dataproduk (Riwayat Pemakaian Produk)
        Schema::create('tb_dataproduk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('tb_produk')->cascadeOnDelete();
            $table->integer('jumlah')->default(1);
            $table->decimal('harga_satuan', 12, 2)->default(0);
            $table->decimal('total_biaya', 12, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        // 7. Buat tb_jadwalservice (Jadwal Booking Servis Pelanggan)
        Schema::create('tb_jadwalservice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('layanan_id')->nullable()->constrained('tb_layanan')->nullOnDelete();
            $table->string('no_plat_kendaraan');
            $table->string('tipe_kendaraan')->nullable();
            $table->date('tanggal_service');
            $table->time('jam_service');
            $table->text('keluhan')->nullable();
            $table->string('status')->default('menunggu');
            $table->timestamps();
        });

        // 8. Buat tb_pesanan (Pesanan Aktif)
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

        // 9. Buat tb_datapesanan (Detail Rincian Item Pesanan)
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

        // 10. Buat tb_riwayatpesanan (Riwayat Pesanan yang Selesai)
        Schema::create('tb_riwayatpesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->nullable()->constrained('tb_pesanan')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->string('status_akhir')->default('selesai');
            $table->timestamp('tanggal_selesai')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // 11. Buat tb_pembayaran (Transaksi Keuangan & Invoice)
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
        Schema::dropIfExists('tb_riwayatpesanan');
        Schema::dropIfExists('tb_datapesanan');
        Schema::dropIfExists('tb_pesanan');
        Schema::dropIfExists('tb_jadwalservice');
        Schema::dropIfExists('tb_dataproduk');
        Schema::dropIfExists('tb_stok');
        Schema::dropIfExists('tb_produk');
        Schema::dropIfExists('tb_datalayanan');
        Schema::dropIfExists('tb_layanan');
    }
};
