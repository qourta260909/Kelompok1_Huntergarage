<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MakeUserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_new_customer_user_via_command_options(): void
    {
        $this->artisan('make:user pelanggan@test.com --name="Budi Santoso" --password="secretpassword"')
            ->assertSuccessful();

        $user = User::where('email', 'pelanggan@test.com')->first();

        $this->assertNotNull($user);
        $this->assertSame('Budi Santoso', $user->name);
        $this->assertSame('user', $user->role);
        $this->assertNotNull($user->email_verified_at);
        $this->assertTrue(Hash::check('secretpassword', $user->password));
    }

    public function test_can_create_new_customer_user_interactively(): void
    {
        $this->artisan('make:user')
            ->expectsQuestion('Masukkan email pelanggan:', 'ani@test.com')
            ->expectsQuestion('Masukkan Nama Pelanggan:', 'Ani Wijaya')
            ->expectsQuestion('Masukkan Kata Sandi Pelanggan:', 'rahasia123')
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'email' => 'ani@test.com',
            'name' => 'Ani Wijaya',
            'role' => 'user',
        ]);
    }

    public function test_cannot_create_duplicate_user_email(): void
    {
        User::factory()->create([
            'email' => 'existing@test.com',
            'name' => 'Existing User',
            'role' => 'user',
        ]);

        $this->artisan('make:user existing@test.com --name="Orang Lain" --password="secretpassword"')
            ->assertFailed();

        $this->assertSame(1, User::where('email', 'existing@test.com')->count());
        $this->assertSame('Existing User', User::where('email', 'existing@test.com')->first()->name);
    }

    public function test_rejects_invalid_email_format(): void
    {
        $this->artisan('make:user bukan-email --name="Budi" --password="secretpassword"')
            ->assertFailed();

        $this->assertDatabaseMissing('users', [
            'email' => 'bukan-email',
        ]);
    }
}
