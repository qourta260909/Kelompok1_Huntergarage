<?php

namespace Tests\Feature;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProdukCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_crud_produk_with_prd_code_deskripsi_image_and_stock_status(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->post(route('dashboard.produk.store'), [
            'nama_produk' => 'Aki GS Astra',
            'deskripsi' => 'Aki',
            'jumlah_stok' => 12,
            'status' => 'aktif',
            'harga_jual' => '295.000',
            'gambar' => UploadedFile::fake()->image('aki-gs.jpg'),
        ])->assertRedirect(route('dashboard.produk'));

        $produk = Produk::first();
        $this->assertNotNull($produk);
        $this->assertSame('Aki GS Astra', $produk->nama_produk);
        $this->assertSame('Aki', $produk->deskripsi);
        $this->assertSame('Aki', $produk->kategori);
        $this->assertSame(12, $produk->stok);
        $this->assertSame('12 Pcs', $produk->stok_label);
        $this->assertSame('Aman', $produk->status_stok);
        $this->assertEquals(295000, (int) $produk->harga_jual);
        $this->assertNotNull($produk->gambar);
        Storage::disk('public')->assertExists($produk->gambar);

        $oldImage = $produk->gambar;

        // Update product to low stock ("Menipis") + new image
        $this->actingAs($admin)->put(route('dashboard.produk.update', $produk), [
            'nama_produk' => 'Aki Xtra Super',
            'deskripsi' => 'Aki',
            'stok' => 3,
            'status' => 'aktif',
            'harga_jual' => '541.000',
            'gambar' => UploadedFile::fake()->image('aki-xtra.png'),
        ])->assertRedirect(route('dashboard.produk'));

        $produk->refresh();
        $this->assertSame('Aki Xtra Super', $produk->nama_produk);
        $this->assertSame(3, $produk->stok);
        $this->assertSame('3 Pcs', $produk->stok_label);
        $this->assertSame('Menipis', $produk->status_stok);
        $this->assertEquals(541000, (int) $produk->harga_jual);
        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists($produk->gambar);

        // Update stock to 0 -> "Habis"
        $this->actingAs($admin)->put(route('dashboard.produk.update', $produk), [
            'nama_produk' => 'Rem kapas Honda',
            'deskripsi' => 'Pengereman',
            'stok' => 0,
            'harga_jual' => '212.000',
        ])->assertRedirect(route('dashboard.produk'));

        $produk->refresh();
        $this->assertSame('0 Pcs', $produk->stok_label);
        $this->assertSame('Habis', $produk->status_stok);

        $currentImage = $produk->gambar;

        $this->actingAs($admin)->delete(route('dashboard.produk.destroy', $produk))
            ->assertRedirect(route('dashboard.produk'));

        $this->assertDatabaseMissing('tb_produk', ['id' => $produk->id]);
        Storage::disk('public')->assertMissing($currentImage);
    }

    public function test_regular_user_cannot_modify_produk(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $produk = Produk::create([
            'kode_produk' => 'PRD-001',
            'nama_produk' => 'Kampas Rem',
            'stok' => 10,
            'harga_jual' => 45000,
            'status' => 'aktif',
        ]);

        $this->actingAs($user)->post(route('dashboard.produk.store'), [
            'nama_produk' => 'Produk Ilegal',
            'stok' => 5,
            'harga_jual' => 10000,
        ])->assertRedirect(route('home'));

        $this->actingAs($user)->delete(route('dashboard.produk.destroy', $produk))
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('tb_produk', ['id' => $produk->id, 'nama_produk' => 'Kampas Rem']);
    }
}
