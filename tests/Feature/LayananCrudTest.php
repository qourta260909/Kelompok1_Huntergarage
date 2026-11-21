<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayananCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_crud_layanan(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->post(route('dashboard.layanan.store'), [
            'nama_layanan' => 'Servis Rutin',
            'deskripsi' => '45 Menit',
            'status' => 'aktif',
            'harga' => '75.000',
        ])->assertRedirect(route('dashboard.layanan'));

        $layanan = Layanan::first();
        $this->assertNotNull($layanan);
        $this->assertSame('Servis Rutin', $layanan->nama_layanan);
        $this->assertSame('45 Menit', $layanan->estimasi_durasi);
        $this->assertSame('1', $layanan->kode_layanan);
        $this->assertEquals(75000, (int) $layanan->harga);

        $this->actingAs($admin)->get(route('dashboard.layanan'))
            ->assertOk()
            ->assertSee('Servis Rutin')
            ->assertSee('1');

        $this->actingAs($admin)->put(route('dashboard.layanan.update', $layanan), [
            'nama_layanan' => 'Servis Besar',
            'deskripsi' => '90 Menit',
            'status' => 'nonaktif',
            'harga' => '150.000',
        ])->assertRedirect(route('dashboard.layanan'));

        $layanan->refresh();
        $this->assertSame('Servis Besar', $layanan->nama_layanan);
        $this->assertSame('nonaktif', $layanan->status);
        $this->assertEquals(150000, (int) $layanan->harga);

        $this->actingAs($admin)->delete(route('dashboard.layanan.destroy', $layanan))
            ->assertRedirect(route('dashboard.layanan'));

        $this->assertDatabaseMissing('tb_layanan', ['id' => $layanan->id]);
    }

    public function test_regular_user_cannot_modify_layanan(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $layanan = Layanan::create([
            'kode_layanan' => 'HG-01',
            'nama_layanan' => 'Ganti Oli',
            'deskripsi' => '20 Menit',
            'estimasi_durasi' => '20 Menit',
            'harga' => 50000,
            'status' => 'aktif',
        ]);

        $this->actingAs($user)->post(route('dashboard.layanan.store'), [
            'nama_layanan' => 'Ilegal',
            'deskripsi' => '10 Menit',
            'status' => 'aktif',
            'harga' => 10000,
        ])->assertRedirect(route('home'));

        $this->actingAs($user)->put(route('dashboard.layanan.update', $layanan), [
            'nama_layanan' => 'Diubah',
            'deskripsi' => '10 Menit',
            'status' => 'aktif',
            'harga' => 10000,
        ])->assertRedirect(route('home'));

        $this->actingAs($user)->delete(route('dashboard.layanan.destroy', $layanan))
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('tb_layanan', ['id' => $layanan->id, 'nama_layanan' => 'Ganti Oli']);
    }
}
