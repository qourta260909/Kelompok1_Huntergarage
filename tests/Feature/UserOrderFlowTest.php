<?php

namespace Tests\Feature;

use App\Models\JadwalService;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserOrderFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_book_active_layanan_with_vehicle_and_contact_details(): void
    {
        $user = User::factory()->create(['role' => 'user', 'name' => 'Raka Pratama']);
        $layanan = Layanan::create([
            'kode_layanan' => 'HG-01',
            'nama_layanan' => 'Tune Up Mesin',
            'deskripsi' => '60 Menit',
            'estimasi_durasi' => '60 Menit',
            'harga' => 120000,
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($user)->post(route('user.pesanan.store'), [
            'kategori' => 'layanan',
            'layanan_id' => $layanan->id,
            'jadwal_service' => '2026-11-25 10:30:00',
            'nama_lengkap' => 'Raka Pratama',
            'no_telepon' => '081234567890',
            'merek' => 'Honda',
            'model' => 'Vario 160',
            'tahun' => 2024,
            'plat_nomor' => 'da 1234 ab',
        ]);

        $response->assertRedirect(route('user.pesanan'))
            ->assertSessionHas('success');

        $pesanan = Pesanan::first();
        $this->assertNotNull($pesanan);
        $this->assertSame('Raka Pratama', $pesanan->nama_pelanggan);
        $this->assertSame('081234567890', $pesanan->no_telepon);
        $this->assertNotNull($pesanan->jadwalservice_id);

        $jadwal = JadwalService::find($pesanan->jadwalservice_id);
        $this->assertNotNull($jadwal);
        $this->assertSame('DA 1234 AB', $jadwal->no_plat_kendaraan);
        $this->assertSame('Honda Vario 160 2024', $jadwal->tipe_kendaraan);
        $this->assertSame('2026-11-25', $jadwal->tanggal_service);
        $this->assertSame('10:30:00', $jadwal->jam_service);
        $this->assertSame('menunggu', $jadwal->status);

        $this->actingAs($user)->get(route('user.pesanan'))
            ->assertOk()
            ->assertViewHas('pesananUser', fn ($orders) => $orders->count() === 1)
            ->assertViewHas('jadwalServisUser', fn ($schedules) => $schedules->count() === 1);

        // Verify PDF receipt download
        $pdfResponse = $this->actingAs($user)->get(route('user.pesanan.pdf', $pesanan));
        $pdfResponse->assertOk()
            ->assertHeader('Content-Type', 'application/pdf')
            ->assertHeader('Content-Disposition', 'attachment; filename="Bukti-Booking-BKG-0001.pdf"');
        $this->assertStringStartsWith('%PDF-1.4', $pdfResponse->getContent());
        $this->assertStringContainsString('BKG-0001', $pdfResponse->getContent());

        // Another user cannot download this user's booking PDF
        $otherUser = User::factory()->create(['role' => 'user']);
        $this->actingAs($otherUser)->get(route('user.pesanan.pdf', $pesanan))
            ->assertForbidden();
    }

    public function test_user_cannot_book_inactive_layanan_or_outside_operating_hours(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $inactiveLayanan = Layanan::create([
            'kode_layanan' => 'HG-01',
            'nama_layanan' => 'Layanan Nonaktif',
            'deskripsi' => '30 Menit',
            'estimasi_durasi' => '30 Menit',
            'harga' => 50000,
            'status' => 'nonaktif',
        ]);

        $this->actingAs($user)->post(route('user.pesanan.store'), [
            'kategori' => 'layanan',
            'layanan_id' => $inactiveLayanan->id,
            'jadwal_service' => '2026-11-25 10:00:00',
        ])->assertSessionHasErrors('layanan_id');

        $activeLayanan = Layanan::create([
            'kode_layanan' => 'HG-02',
            'nama_layanan' => 'Layanan Aktif',
            'deskripsi' => '30 Menit',
            'estimasi_durasi' => '30 Menit',
            'harga' => 50000,
            'status' => 'aktif',
        ]);

        $this->actingAs($user)->post(route('user.pesanan.store'), [
            'kategori' => 'layanan',
            'layanan_id' => $activeLayanan->id,
            'jadwal_service' => '2026-11-25 06:30:00',
        ])->assertSessionHasErrors('jadwal_service');

        $this->assertDatabaseCount('tb_pesanan', 0);
    }

    public function test_product_order_decrements_stock_and_rejection_restores_stock(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $produk = Produk::create([
            'kode_produk' => 'HG-01',
            'nama_produk' => 'Oli MPX2',
            'stok' => 5,
            'harga_jual' => 55000,
            'status' => 'aktif',
        ]);

        // User orders product -> stock becomes 4
        $this->actingAs($user)->post(route('user.pesanan.store'), [
            'kategori' => 'produk',
            'produk_id' => $produk->id,
            'jadwal_service' => '2026-11-25 11:00:00',
        ])->assertRedirect(route('user.pesanan'));

        $this->assertSame(4, $produk->fresh()->stok);
        $pesanan = Pesanan::first();

        // Admin rejects order -> stock restored to 5 and stays on produk tab
        $this->actingAs($admin)->patch(route('dashboard.pesanan.status', $pesanan), [
            'aksi' => 'tolak',
        ])->assertRedirect(route('dashboard.pesanan', ['tab' => 'produk']));

        $this->assertSame(5, $produk->fresh()->stok);
        $this->assertSame('dibatalkan', $pesanan->fresh()->status);
        $this->assertDatabaseHas('tb_riwayatpesanan', [
            'pesanan_id' => $pesanan->id,
            'status_akhir' => 'dibatalkan',
        ]);
        $this->assertDatabaseMissing('tb_pembayaran', [
            'pesanan_id' => $pesanan->id,
        ]);

        // Deleting already-cancelled order must NOT double-restore stock
        $this->actingAs($admin)->delete(route('dashboard.pesanan.destroy', $pesanan))
            ->assertRedirect();

        $this->assertSame(5, $produk->fresh()->stok);
    }

    public function test_deleting_pending_product_order_restores_stock(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $produk = Produk::create([
            'kode_produk' => 'HG-01',
            'nama_produk' => 'Busi NGK',
            'stok' => 2,
            'harga_jual' => 30000,
            'status' => 'aktif',
        ]);

        $this->actingAs($user)->post(route('user.pesanan.store'), [
            'kategori' => 'produk',
            'produk_id' => $produk->id,
            'jadwal_service' => '2026-11-25 14:00:00',
        ])->assertRedirect(route('user.pesanan'));

        $this->assertSame(1, $produk->fresh()->stok);
        $pesanan = Pesanan::first();

        $this->actingAs($admin)->delete(route('dashboard.pesanan.destroy', $pesanan))
            ->assertRedirect();

        $this->assertSame(2, $produk->fresh()->stok);
    }

    public function test_admin_accepting_service_order_syncs_jadwal_pembayaran_and_riwayat(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $layanan = Layanan::create([
            'kode_layanan' => 'HG-01',
            'nama_layanan' => 'Servis CVT',
            'deskripsi' => '45 Menit',
            'estimasi_durasi' => '45 Menit',
            'harga' => 85000,
            'status' => 'aktif',
        ]);

        $this->actingAs($user)->post(route('user.pesanan.store'), [
            'kategori' => 'layanan',
            'layanan_id' => $layanan->id,
            'jadwal_service' => '2026-11-26 09:00:00',
            'plat_nomor' => 'DA 9999 XX',
        ])->assertRedirect(route('user.pesanan'));

        $pesanan = Pesanan::first();

        // 1. Admin accepts order ('terima') -> status becomes 'proses' in Riwayat
        $this->actingAs($admin)->patch(route('dashboard.pesanan.status', $pesanan), [
            'aksi' => 'terima',
        ])->assertRedirect(route('dashboard.pesanan', ['tab' => 'layanan']));

        $this->assertSame('proses', $pesanan->fresh()->status);
        $this->assertDatabaseHas('tb_jadwalservice', [
            'id' => $pesanan->jadwalservice_id,
            'status' => 'proses',
        ]);

        // 2. Admin marks order as finished ('selesai') from Riwayat -> status becomes 'selesai' ("Sudah Selesai")
        $this->actingAs($admin)->patch(route('dashboard.pesanan.status', $pesanan), [
            'aksi' => 'selesai',
        ])->assertRedirect(route('dashboard.riwayat', ['tab' => 'layanan']));

        $this->assertSame('selesai', $pesanan->fresh()->status);
        $this->assertDatabaseHas('tb_jadwalservice', [
            'id' => $pesanan->jadwalservice_id,
            'status' => 'selesai',
        ]);
        $this->assertDatabaseHas('tb_pembayaran', [
            'pesanan_id' => $pesanan->id,
            'status' => 'lunas',
            'jumlah' => 85000,
        ]);
        $this->assertDatabaseHas('tb_riwayatpesanan', [
            'pesanan_id' => $pesanan->id,
            'status_akhir' => 'selesai',
        ]);
    }

    public function test_user_cannot_order_out_of_stock_or_inactive_product(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $emptyProduk = Produk::create([
            'kode_produk' => 'HG-01',
            'nama_produk' => 'Ban Tubeless',
            'stok' => 0,
            'harga_jual' => 250000,
            'status' => 'aktif',
        ]);
        $inactiveProduk = Produk::create([
            'kode_produk' => 'HG-02',
            'nama_produk' => 'Spion Lama',
            'stok' => 10,
            'harga_jual' => 40000,
            'status' => 'nonaktif',
        ]);

        $this->actingAs($user)->post(route('user.pesanan.store'), [
            'kategori' => 'produk',
            'produk_id' => $emptyProduk->id,
            'jadwal_service' => '2026-11-25 13:00:00',
        ])->assertSessionHasErrors('produk_id');

        $this->actingAs($user)->post(route('user.pesanan.store'), [
            'kategori' => 'produk',
            'produk_id' => $inactiveProduk->id,
            'jadwal_service' => '2026-11-25 13:00:00',
        ])->assertSessionHasErrors('produk_id');

        $this->assertDatabaseCount('tb_pesanan', 0);
    }
}
