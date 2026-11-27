<x-guest-layout>
    <div class="brand-wrap">
        <div class="brand-badge">
            <x-application-logo class="brand-logo" />
        </div>
    </div>

    <div style="margin-bottom: 0.9rem;">
        <h1 style="margin: 0 0 0.3rem; font-size: 1.35rem; font-weight: 800; color: #111827;">Atur Ulang Kata Sandi</h1>
        <p style="margin: 0; font-size: 0.85rem; line-height: 1.5; color: #4b5563;">
            Masukkan kata sandi baru minimal 8 karakter untuk akun Anda.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="login-form">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="field-group">
            <label for="email" class="field-label">Email</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 6.75A2.75 2.75 0 0 1 5.75 4h12.5A2.75 2.75 0 0 1 21 6.75v10.5A2.75 2.75 0 0 1 18.25 20H5.75A2.75 2.75 0 0 1 3 17.25V6.75Zm2.2-.5 6.57 5.13a1.25 1.25 0 0 0 1.46 0L18.8 6.25H5.2Zm13.55 2.17-5.28 4.12a3.25 3.25 0 0 1-3.94 0L5.25 8.42v8.83c0 .41.34.75.75.75h12c.41 0 .75-.34.75-.75V8.42Z" fill="currentColor"/>
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" placeholder="contoh@gmail.com" required autofocus autocomplete="username">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="field-group">
            <label for="password" class="field-label">Kata Sandi Baru</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 10V8.5A5 5 0 0 1 12 3.5a5 5 0 0 1 5 5V10h.75A2.25 2.25 0 0 1 20 12.25v7.5A2.25 2.25 0 0 1 17.75 22h-11.5A2.25 2.25 0 0 1 4 19.75v-7.5A2.25 2.25 0 0 1 6.25 10H7Zm2 0h6V8.5a3 3 0 1 0-6 0V10Zm2.5 4.75a1 1 0 1 0 2 0 .98.98 0 0 0-.27-.7.98.98 0 0 0-1.46 0 .98.98 0 0 0-.27.7Z" fill="currentColor"/>
                </svg>
                <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" minlength="8" required autocomplete="new-password">
                <svg class="password-icon" onclick="toggleResetPw('password', this)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12C5.5 8.5 8.5 7 12 7C15.5 7 18.5 8.5 21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M3 12C5.5 15.5 8.5 17 12 17C15.5 17 18.5 15.5 21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 5L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="field-group">
            <label for="password_confirmation" class="field-label">Konfirmasi Kata Sandi Baru</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 10V8.5A5 5 0 0 1 12 3.5a5 5 0 0 1 5 5V10h.75A2.25 2.25 0 0 1 20 12.25v7.5A2.25 2.25 0 0 1 17.75 22h-11.5A2.25 2.25 0 0 1 4 19.75v-7.5A2.25 2.25 0 0 1 6.25 10H7Zm2 0h6V8.5a3 3 0 1 0-6 0V10Zm2.5 4.75a1 1 0 1 0 2 0 .98.98 0 0 0-.27-.7.98.98 0 0 0-1.46 0 .98.98 0 0 0-.27.7Z" fill="currentColor"/>
                </svg>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru" minlength="8" required autocomplete="new-password">
                <svg class="password-icon" onclick="toggleResetPw('password_confirmation', this)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12C5.5 8.5 8.5 7 12 7C15.5 7 18.5 8.5 21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M3 12C5.5 15.5 8.5 17 12 17C15.5 17 18.5 15.5 21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 5L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="login-button">Simpan Kata Sandi Baru</button>
    </form>

    <script>
        function toggleResetPw(inputId, iconEl) {
            const input = document.getElementById(inputId);
            if (!input || !iconEl) return;
            if (input.type === 'password') {
                input.type = 'text';
                iconEl.innerHTML = `
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                `;
            } else {
                input.type = 'password';
                iconEl.innerHTML = `
                    <path d="M3 12C5.5 8.5 8.5 7 12 7C15.5 7 18.5 8.5 21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M3 12C5.5 15.5 8.5 17 12 17C15.5 17 18.5 15.5 21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 5L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                `;
            }
        }
    </script>
</x-guest-layout>
