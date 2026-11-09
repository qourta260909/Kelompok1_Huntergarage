<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_renders_successfully_with_zero_data(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertOk()
            ->assertSee('Pelanggan aktif')
            ->assertSee('Pesanan Baru')
            ->assertSee('Total Pendapatan')
            ->assertSee('Pendapatan Baru')
            ->assertSee('Belum ada pesanan.');

        $response->assertViewHas('totalPelanggan', 0)
            ->assertViewHas('pesananBaru', 0)
            ->assertViewHas('totalPendapatan', 0)
            ->assertViewHas('pendapatanBaru', 0);
    }

    public function test_admin_dashboard_shows_statistics_from_database(): void
    {
        $now = now();
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create([
            'name' => 'Pelanggan Dashboard',
            'role' => 'user',
        ]);
        User::factory()->create(['role' => 'user']);

        $pesanan1Id = DB::table('tb_pesanan')->insertGetId([
            'user_id' => $customer->id,
            'nama_layanan' => 'Servis berkala',
            'total_harga' => 100000,
            'status' => 'baru',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $pesanan2Id = DB::table('tb_pesanan')->insertGetId([
            'user_id' => $customer->id,
            'nama_layanan' => 'Ganti oli',
            'total_harga' => 50000,
            'status' => 'selesai',
            'created_at' => $now->copy()->subDay(),
            'updated_at' => $now->copy()->subDay(),
        ]);

        DB::table('tb_pembayaran')->insert([
            [
                'pesanan_id' => $pesanan1Id,
                'nomor_invoice' => 'INV-001',
                'jumlah' => 100000,
                'status' => 'lunas',
                'metode_pembayaran' => 'tunai',
                'dibayar_pada' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pesanan_id' => $pesanan2Id,
                'nomor_invoice' => 'INV-002',
                'jumlah' => 50000,
                'status' => 'lunas',
                'metode_pembayaran' => 'transfer',
                'dibayar_pada' => $now->copy()->subMonth(),
                'created_at' => $now->copy()->subMonth(),
                'updated_at' => $now->copy()->subMonth(),
            ],
            [
                'pesanan_id' => $pesanan1Id,
                'nomor_invoice' => 'INV-003',
                'jumlah' => 25000,
                'status' => 'menunggu',
                'metode_pembayaran' => 'transfer',
                'dibayar_pada' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertOk()
            ->assertSee('#1')
            ->assertSee('Pelanggan Dashboard')
            ->assertSee('Servis berkala')
            ->assertDontSee('Ganti oli')
            ->assertSee('Rp 150.000')
            ->assertSee('Rp 100.000')
            ->assertDontSee('Belum ada pesanan.');

        $response->assertViewHas('pesananBaru', 1)
            ->assertViewHas('pesananTerbaru', function ($pesananTerbaru) {
                return $pesananTerbaru->count() === 1
                    && $pesananTerbaru->first()->status === 'baru';
            });
    }

    public function test_admin_operational_pages_render_with_empty_data(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $pages = [
            ['dashboard.layanan', 'Daftar layanan'],
            ['dashboard.produk', 'Daftar produk'],
            ['dashboard.riwayat', 'Riwayat pesanan'],
        ];

        foreach ($pages as [$route, $heading]) {
            $this->actingAs($admin)
                ->get(route($route))
                ->assertOk()
                ->assertSee($heading);
        }
    }

    public function test_admin_can_review_service_and_product_inventory_data(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $now = now();
        $layananId = DB::table('tb_layanan')->insertGetId([
            'nama_layanan' => 'Ganti Oli',
            'deskripsi' => 'Penggantian oli mesin',
            'harga' => 75000,
            'estimasi_durasi' => '30 menit',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('tb_datalayanan')->insert([
            'user_id' => $admin->id,
            'layanan_id' => $layananId,
            'tanggal_layanan' => $now->toDateString(),
            'biaya' => 75000,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $produkId = DB::table('tb_produk')->insertGetId([
            'nama_produk' => 'Oli Mesin',
            'kode_produk' => 'OLI-001',
            'kategori' => 'Pelumas',
            'harga_jual' => 85000,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('tb_stok')->insert([
            'produk_id' => $produkId,
            'jumlah_stok' => 4,
            'stok_minimum' => 5,
            'satuan' => 'pcs',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->actingAs($admin)
            ->get(route('dashboard.layanan'))
            ->assertOk()
            ->assertSee('Ganti Oli')
            ->assertSee('Rp 75.000')
            ->assertSee('30 menit');

        $this->actingAs($admin)
            ->get(route('dashboard.produk'))
            ->assertOk()
            ->assertSee('Oli Mesin')
            ->assertSee('4 pcs')
            ->assertSee('Stok menipis');

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Total stok barang')
            ->assertViewHas('totalStok', 4)
            ->assertViewHas('totalLayanan', 1)
            ->assertViewHas('totalProduk', 1)
            ->assertViewHas('jumlahProdukMenipis', 1);
    }

    public function test_admin_history_shows_only_completed_orders(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['name' => 'Pelanggan Riwayat', 'role' => 'user']);
        $now = now();

        DB::table('tb_pesanan')->insert([
            [
                'user_id' => $customer->id,
                'nama_pelanggan' => null,
                'nama_layanan' => 'Servis selesai',
                'total_harga' => 125000,
                'status' => 'selesai',
                'created_at' => $now->copy()->subDay(),
                'updated_at' => $now,
            ],
            [
                'user_id' => $customer->id,
                'nama_pelanggan' => null,
                'nama_layanan' => 'Servis berjalan',
                'total_harga' => 90000,
                'status' => 'proses',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $this->actingAs($admin)
            ->get(route('dashboard.riwayat'))
            ->assertOk()
            ->assertSee('Servis selesai')
            ->assertSee('Pelanggan Riwayat')
            ->assertSee('Rp 125.000')
            ->assertDontSee('Servis berjalan')
            ->assertViewHas('totalRiwayat', 1)
            ->assertViewHas('nilaiPesananSelesai', 125000);
    }

    public function test_admin_can_accept_or_reject_pesanan_and_move_to_riwayat(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $now = now();

        $pesananLayananId = DB::table('tb_pesanan')->insertGetId([
            'nama_pelanggan' => 'Budi Santoso',
            'kategori' => 'layanan',
            'nama_layanan' => 'Tune Up Mesin',
<<<<<<< HEAD
            'jadwal_service' => '2026-11-05T10:00',
            'total_harga' => '250,000',
            'status' => 'baru',
        ])->assertRedirect(route('dashboard.pesanan'));
=======
            'jadwal_service' => '2026-11-05 10:30:00',
            'total_harga' => 250000,
            'status' => 'menunggu',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261

        $pesananProdukId = DB::table('tb_pesanan')->insertGetId([
            'nama_pelanggan' => 'Siti Aminah',
            'kategori' => 'produk',
            'nama_layanan' => 'Kampas Rem Depan',
            'jadwal_service' => '2026-11-05 11:00:00',
            'total_harga' => 120000,
            'status' => 'menunggu',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Verify both waiting orders appear in Pesanan page
        $this->actingAs($admin)->get(route('dashboard.pesanan'))
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('Tune Up Mesin')
<<<<<<< HEAD
            ->assertSee('Pukul 10:00');

        // Verify appears in Dashboard "Pesanan Terbaru" (read-only) with #1 and Baru, and pendapatanBaru is 0
        $this->actingAs($admin)->get(route('dashboard'))
=======
            ->assertSee('Siti Aminah')
            ->assertSee('Kampas Rem Depan')
            ->assertSee('Menunggu')
            ->assertSee('Terima')
            ->assertSee('Tolak');

        // Accept pesanan layanan
        $this->actingAs($admin)->put(route('dashboard.pesanan.update', $pesananLayananId), [
            'status' => 'diterima',
        ])->assertRedirect(route('dashboard.pesanan'));

        // Reject pesanan produk
        $this->actingAs($admin)->put(route('dashboard.pesanan.update', $pesananProdukId), [
            'status' => 'ditolak',
        ])->assertRedirect(route('dashboard.pesanan'));

        // Both should no longer appear in waiting orders on Pesanan page
        $this->actingAs($admin)->get(route('dashboard.pesanan'))
            ->assertOk()
            ->assertDontSee('Budi Santoso')
            ->assertDontSee('Siti Aminah');

        // Both should appear in Riwayat page
        $this->actingAs($admin)->get(route('dashboard.riwayat'))
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261
            ->assertOk()
            ->assertSee('#1')
            ->assertSee('Budi Santoso')
            ->assertSee('Tune Up Mesin')
<<<<<<< HEAD
            ->assertSee('Baru')
            ->assertSee('Rp 250.000')
            ->assertViewHas('pendapatanBaru', 0);
=======
            ->assertSee('Siti Aminah')
            ->assertSee('Kampas Rem Depan')
            ->assertSee('Diterima')
            ->assertSee('Ditolak')
            ->assertViewHas('totalRiwayat', 2)
            ->assertViewHas('totalDiterima', 1)
            ->assertViewHas('totalDitolak', 1)
            ->assertViewHas('nilaiPesananSelesai', 250000);
    }
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261

    public function test_admin_can_crud_layanan_for_customer_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

<<<<<<< HEAD
        // Update pesanan status to selesai
        $this->actingAs($admin)->put(route('dashboard.pesanan.update', $pesananId), [
            'nama_pelanggan' => 'Budi Santoso',
            'kategori' => 'layanan',
            'nama_layanan' => 'Tune Up Mesin',
            'jadwal_service' => '2026-11-05T10:00',
            'total_harga' => '250,000',
            'status' => 'selesai',
        ])->assertRedirect(route('dashboard.pesanan'));

        // Should disappear from main dashboard list and Pesanan list, and money added to Pendapatan Baru
        $this->actingAs($admin)->get(route('dashboard'))
            ->assertOk()
            ->assertDontSee('Budi Santoso')
            ->assertViewHas('pendapatanBaru', 250000)
            ->assertViewHas('totalPendapatan', 250000);

        $this->actingAs($admin)->get(route('dashboard.pesanan'))
            ->assertOk()
            ->assertDontSee('Budi Santoso');

        // Should appear in Riwayat page with status Selesai
        $this->actingAs($admin)->get(route('dashboard.riwayat'))
            ->assertOk()
            ->assertSee('#1')
            ->assertSee('Budi Santoso')
            ->assertSee('Tune Up Mesin')
            ->assertSee('Selesai');

        // Delete pesanan
        $this->actingAs($admin)->delete(route('dashboard.pesanan.destroy', $pesananId))
            ->assertRedirect(route('dashboard.pesanan'));
=======
        $this->actingAs($admin)->post(route('dashboard.layanan.store'), [
            'nama_layanan' => 'Servis CVT',
            'deskripsi' => 'Pembersihan dan pengecekan komponen CVT',
            'estimasi_durasi' => '45 menit',
            'harga' => '95,000',
        ])->assertRedirect(route('dashboard.layanan'));

        $layananId = DB::table('tb_layanan')->where('nama_layanan', 'Servis CVT')->value('id');
        $this->assertNotNull($layananId);

        $this->actingAs($admin)->put(route('dashboard.layanan.update', $layananId), [
            'nama_layanan' => 'Servis CVT Lengkap',
            'deskripsi' => 'Pembersihan CVT dan ganti grease',
            'estimasi_durasi' => '60 menit',
            'harga' => '110,000',
        ])->assertRedirect(route('dashboard.layanan'));

        $this->actingAs($admin)->get(route('dashboard.layanan'))
            ->assertOk()
            ->assertSee('Servis CVT Lengkap')
            ->assertSee('Rp 110.000');

        $this->actingAs($admin)->delete(route('dashboard.layanan.destroy', $layananId))
            ->assertRedirect(route('dashboard.layanan'));
>>>>>>> 9f30e90dee6e40e25744fde700cb275b3939c261

        $this->assertDatabaseMissing('tb_layanan', ['id' => $layananId]);
    }
}
