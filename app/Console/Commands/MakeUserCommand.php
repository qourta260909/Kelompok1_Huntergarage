<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MakeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user
                            {email? : Email pelanggan yang akan dibuatkan akun}
                            {--name= : Nama lengkap pelanggan}
                            {--password= : Kata sandi akun pelanggan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat akun Pelanggan (user) baru melalui terminal oleh Admin bengkel';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = trim((string) ($this->argument('email') ?: $this->ask('Masukkan email pelanggan:')));
        $email = strtolower($email);

        $validator = Validator::make(['email' => $email], [
            'email' => ['required', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            $this->error('Format email tidak valid.');
            return self::FAILURE;
        }

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            $this->error("Email [{$email}] sudah terdaftar atas nama [{$existingUser->name}] (peran: {$existingUser->role}).");
            return self::FAILURE;
        }

        $name = trim((string) ($this->option('name') ?: $this->ask('Masukkan Nama Pelanggan:')));

        if ($name === '') {
            $this->error('Nama pelanggan tidak boleh kosong.');
            return self::FAILURE;
        }

        $password = (string) ($this->option('password') ?: $this->secret('Masukkan Kata Sandi Pelanggan:'));

        if ($password === '') {
            $this->error('Kata sandi tidak boleh kosong.');
            return self::FAILURE;
        }

        $newUser = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'user',
        ]);

        $newUser->email_verified_at = now();
        $newUser->save();

        $this->info('==========================================');
        $this->info('Akun Pelanggan berhasil dibuat!');
        $this->line("Nama  : {$newUser->name}");
        $this->line("Email : {$newUser->email}");
        $this->line("Peran : {$newUser->role}");
        $this->info('==========================================');

        return self::SUCCESS;
    }
}
