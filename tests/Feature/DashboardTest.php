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

    public function test_admin_can_crud_pesanan_and_see_new_orders_on_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Create pesanan via CRUD
        $this->actingAs($admin)->post(route('dashboard.pesanan.store'), [
            'nama_pelanggan' => 'Budi Santoso',
            'kategori' => 'layanan',
            'nama_layanan' => 'Tune Up Mesin',
            'jadwal_service' => '2026-11-05T10:00',
            'total_harga' => '250,000',
            'status' => 'baru',
        ])->assertRedirect(route('dashboard.pesanan'));

        // Verify appears in Pesanan page
        $this->actingAs($admin)->get(route('dashboard.pesanan'))
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('Tune Up Mesin')
            ->assertSee('Pukul 10:00');

        // Verify appears in Dashboard "Pesanan Terbaru" (read-only) with #1 and Baru, and pendapatanBaru is 0
        $this->actingAs($admin)->get(route('dashboard'))
            ->assertOk()
            ->assertSee('#1')
            ->assertSee('Budi Santoso')
            ->assertSee('Tune Up Mesin')
            ->assertSee('Baru')
            ->assertSee('Rp 250.000')
            ->assertViewHas('pendapatanBaru', 0);

        $pesananId = DB::table('tb_pesanan')->where('nama_pelanggan', 'Budi Santoso')->value('id');

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

        $this->assertDatabaseMissing('tb_pesanan', ['id' => $pesananId]);
    }
}
