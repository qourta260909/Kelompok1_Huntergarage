<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_seeders_populate_each_statistic_idempotently(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(1, User::where('email', 'pelanggan.dashboard@hunter.com')->count());
        $this->assertSame(
            1,
            DB::table('data_pesanans')->whereDate('created_at', today())->count()
        );
        $this->assertSame(
            1100000.0,
            (float) DB::table('riwayat_pembayarans')->where('status', 'lunas')->sum('jumlah')
        );
        $this->assertSame(
            350000.0,
            (float) DB::table('riwayat_pembayarans')
                ->where('status', 'lunas')
                ->where('dibayar_pada', '>=', now()->startOfMonth())
                ->where('dibayar_pada', '<', now()->addMonth()->startOfMonth())
                ->sum('jumlah')
        );
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

        DB::table('data_pesanans')->insert([
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

        DB::table('riwayat_pembayarans')->insert([
            [
                'jumlah' => 100000,
                'status' => 'lunas',
                'dibayar_pada' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'jumlah' => 50000,
                'status' => 'lunas',
                'dibayar_pada' => $now->copy()->subMonth(),
                'created_at' => $now->copy()->subMonth(),
                'updated_at' => $now->copy()->subMonth(),
            ],
            [
                'jumlah' => 25000,
                'status' => 'menunggu',
                'dibayar_pada' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertOk()
            ->assertSee('Pelanggan Dashboard')
            ->assertSee('Servis berkala')
            ->assertSee('Rp 150.000')
            ->assertSee('Rp 100.000')
            ->assertDontSee('Belum ada pesanan.');

        $content = (string) $response->getContent();
        $this->assertSame(1, substr_count($content, '<div class="card-value">2</div>'));
        $this->assertSame(1, substr_count($content, '<div class="card-value">1</div>'));
    }
}
