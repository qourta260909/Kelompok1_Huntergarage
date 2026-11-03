<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MakeAdminCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_new_admin_via_command(): void
    {
        $this->artisan('make:admin admin@test.com --name="Super Admin" --password="secretpassword"')
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'email' => 'admin@test.com',
            'name' => 'Super Admin',
            'role' => 'admin',
        ]);
    }

    public function test_can_promote_existing_user_to_admin(): void
    {
        $user = User::factory()->create([
            'email' => 'user@test.com',
            'role' => 'user',
        ]);

        $this->artisan('make:admin user@test.com')
            ->expectsConfirmation("User [{$user->name}] ditemukan dengan role 'user'. Ubah role menjadi Admin?", 'yes')
            ->assertSuccessful();

        $this->assertSame('admin', $user->fresh()->role);
    }
}
