<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MakeAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin 
                            {email? : Email pengguna yang akan dijadikan admin}
                            {--name= : Nama admin (jika membuat akun baru)}
                            {--password= : Password admin (jika membuat akun baru)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat akun Admin baru atau mengubah role user yang sudah ada menjadi Admin';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->argument('email') ?: $this->ask('Masukkan email user:');

        $validator = Validator::make(['email' => $email], [
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            $this->error('Format email tidak valid.');
            return self::FAILURE;
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->role === 'admin') {
                $this->warn("User [{$user->name}] ({$user->email}) sudah berstatus sebagai Admin.");
                return self::SUCCESS;
            }

            if ($this->confirm("User [{$user->name}] ditemukan dengan role '{$user->role}'. Ubah role menjadi Admin?", true)) {
                $user->role = 'admin';
                $user->save();

                $this->info("Berhasil! User [{$user->name}] kini telah menjadi Admin.");
                return self::SUCCESS;
            }

            $this->comment('Proses dibatalkan.');
            return self::SUCCESS;
        }

        // Akun belum ada, buat akun Admin baru
        $this->info("Email [{$email}] belum terdaftar. Menyiapkan akun Admin baru...");

        $name = $this->option('name') ?: $this->ask('Masukkan Nama Admin:', 'Admin Bengkel');
        $password = $this->option('password') ?: $this->secret('Masukkan Password Admin:');

        if (empty($password)) {
            $this->error('Password tidak boleh kosong.');
            return self::FAILURE;
        }

        $newAdmin = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info("==========================================");
        $this->info("Akun Admin berhasil dibuat!");
        $this->line("Nama  : {$newAdmin->name}");
        $this->line("Email : {$newAdmin->email}");
        $this->line("Role  : {$newAdmin->role}");
        $this->info("==========================================");

        return self::SUCCESS;
    }
}
