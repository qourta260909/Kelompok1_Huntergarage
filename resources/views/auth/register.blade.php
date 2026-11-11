<x-guest-layout>
    <div class="brand-wrap">
        <div class="brand-badge">
            <x-application-logo class="brand-logo" />
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf

        <div class="field-group">
            <label for="name" class="field-label">Nama Lengkap</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap Anda" required autofocus autocomplete="name">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="field-group">
            <label for="email" class="field-label">Email</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 6.75A2.75 2.75 0 0 1 5.75 4h12.5A2.75 2.75 0 0 1 21 6.75v10.5A2.75 2.75 0 0 1 18.25 20H5.75A2.75 2.75 0 0 1 3 17.25V6.75Zm2.2-.5 6.57 5.13a1.25 1.25 0 0 0 1.46 0L18.8 6.25H5.2Zm13.55 2.17-5.28 4.12a3.25 3.25 0 0 1-3.94 0L5.25 8.42v8.83c0 .41.34.75.75.75h12c.41 0 .75-.34.75-.75V8.42Z" fill="currentColor"/>
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" required autocomplete="username">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="field-group">
            <label for="password" class="field-label">Password</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 10V8.5A5 5 0 0 1 12 3.5a5 5 0 0 1 5 5V10h.75A2.25 2.25 0 0 1 20 12.25v7.5A2.25 2.25 0 0 1 17.75 22h-11.5A2.25 2.25 0 0 1 4 19.75v-7.5A2.25 2.25 0 0 1 6.25 10H7Zm2 0h6V8.5a3 3 0 1 0-6 0V10Zm2.5 4.75a1 1 0 1 0 2 0 .98.98 0 0 0-.27-.7.98.98 0 0 0-1.46 0 .98.98 0 0 0-.27.7Z" fill="currentColor"/>
                </svg>
                <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="field-group">
            <label for="password_confirmation" class="field-label">Konfirmasi Password</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 10V8.5A5 5 0 0 1 12 3.5a5 5 0 0 1 5 5V10h.75A2.25 2.25 0 0 1 20 12.25v7.5A2.25 2.25 0 0 1 17.75 22h-11.5A2.25 2.25 0 0 1 4 19.75v-7.5A2.25 2.25 0 0 1 6.25 10H7Zm2 0h6V8.5a3 3 0 1 0-6 0V10Zm2.5 4.75a1 1 0 1 0 2 0 .98.98 0 0 0-.27-.7.98.98 0 0 0-1.46 0 .98.98 0 0 0-.27.7Z" fill="currentColor"/>
                </svg>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi Sandi" required autocomplete="new-password">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="login-button">Daftar Akun</button>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:0.5rem; font-size:0.88rem; color:#6b7280;">
            <a href="{{ route('home') }}" style="color:#6b7280; text-decoration:none; font-weight:500;">&larr; Kembali ke Beranda</a>
            <a href="{{ route('login') }}" style="color:#101010; text-decoration:none; font-weight:700;">Sudah punya akun? Login</a>
        </div>
    </form>
</x-guest-layout>
