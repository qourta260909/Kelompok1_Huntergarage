<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_seeder_creates_admin_and_user_accounts(): void
    {
        $this->seed(UserSeeder::class);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@huntergarage.com',
            'name' => 'Admin Bengkel',
            'role' => 'admin',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'user@huntergarage.com',
            'name' => 'Pelanggan Hunter Garage',
            'role' => 'user',
        ]);

        $this->assertNotNull(User::where('email', 'admin@huntergarage.com')->first()?->email_verified_at);
        $this->assertNotNull(User::where('email', 'user@huntergarage.com')->first()?->email_verified_at);
    }
}
