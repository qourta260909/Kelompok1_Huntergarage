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
            ->assertSee('Total Pendapatan')
            ->assertSee('Total Pesanan')
            ->assertDontSee('Pelanggan aktif')
            ->assertDontSee('Pesanan Baru')
            ->assertDontSee('Pendapatan Baru')
            ->assertSee('Belum ada data pesanan.');

        $response->assertViewHas('totalPendapatan', 0)
            ->assertViewHas('totalPesanan', 0);
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

        DB::table('tb_pesanan')->insert([
            [
                'user_id' => $customer->id,
                'nama_layanan' => 'Servis berkala',
                'total_harga' => 100000,
                'status' => 'baru',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $customer->id,
                'nama_layanan' => 'Ganti oli',
                'total_harga' => 50000,
                'status' => 'selesai',
                'created_at' => $now->copy()->subDay(),
                'updated_at' => $now->copy()->subDay(),
            ],
        ]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertOk()
            ->assertSee('BKG-0001')
            ->assertSee('Pelanggan Dashboard')
            ->assertSee('Servis berkala')
            ->assertDontSee('Ganti oli')
            ->assertSee('Rp 50.000')
            ->assertSee('Rp 100.000')
            ->assertDontSee('Belum ada pesanan.');

        $response->assertViewHas('totalPendapatan', 50000)
            ->assertViewHas('totalPesanan', 2)
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
            ->assertSee('10:00');

        // Verify appears in Dashboard "Pesanan Terbaru" and totalPendapatan is 0
        $this->actingAs($admin)->get(route('dashboard'))
            ->assertOk()
            ->assertSee('BKG-0001')
            ->assertSee('Budi Santoso')
            ->assertSee('Tune Up Mesin')
            ->assertSee('Menunggu')
            ->assertSee('Rp 250.000')
            ->assertViewHas('totalPendapatan', 0)
            ->assertViewHas('totalPesanan', 1);

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

        // Should disappear from main dashboard list and Pesanan list, and money added to Total Pendapatan
        $this->actingAs($admin)->get(route('dashboard'))
            ->assertOk()
            ->assertDontSee('Budi Santoso')
            ->assertViewHas('totalPendapatan', 250000)
            ->assertViewHas('totalPesanan', 1);

        $this->actingAs($admin)->get(route('dashboard.pesanan'))
            ->assertOk()
            ->assertDontSee('Budi Santoso');

        // Should appear in Riwayat page with status Diterima
        $this->actingAs($admin)->get(route('dashboard.riwayat'))
            ->assertOk()
            ->assertSee('BKG-0001')
            ->assertSee('Budi Santoso')
            ->assertSee('Tune Up Mesin')
            ->assertSee('Diterima');

        // Delete pesanan
        $this->actingAs($admin)->delete(route('dashboard.pesanan.destroy', $pesananId))
            ->assertRedirect();

        $this->assertDatabaseMissing('tb_pesanan', ['id' => $pesananId]);
    }
}
