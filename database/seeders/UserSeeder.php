<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds for admin and user accounts.
     */
    public function run(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'plain_password')) {
                    $table->string('plain_password')->nullable()->after('password');
                }
                if (!Schema::hasColumn('users', 'no_telepon')) {
                    $table->string('no_telepon', 30)->nullable()->after('role');
                }
                if (!Schema::hasColumn('users', 'alamat')) {
                    $table->text('alamat')->nullable()->after('no_telepon');
                }
                if (!Schema::hasColumn('users', 'otp_code')) {
                    $table->string('otp_code', 10)->nullable()->after('remember_token');
                }
                if (!Schema::hasColumn('users', 'otp_expires_at')) {
                    $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
                }
            });
        }
        User::updateOrCreate(
            ['email' => 'admin@huntergarage.com'],
            [
                'name' => 'Admin Bengkel',
                'password' => Hash::make('admin123'),
                'plain_password' => 'admin123',
                'role' => 'admin',
                'no_telepon' => '081234567890',
                'alamat' => 'Jl. Taruna Praja Banjarbaru',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@huntergarage.com'],
            [
                'name' => 'Pelanggan Hunter Garage',
                'password' => Hash::make('user123'),
                'plain_password' => 'user123',
                'role' => 'user',
                'no_telepon' => '081298765432',
                'alamat' => 'Jl. A. Yani Km. 34 Banjarbaru',
                'email_verified_at' => now(),
            ]
        );
    }
}
