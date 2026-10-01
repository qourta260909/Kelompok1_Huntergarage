<x-guest-layout>
    <div class="brand-wrap">
        <div class="brand-badge">
            <x-application-logo class="brand-logo" />
        </div>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="field-group">
            <label for="email" class="field-label">Email</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 6.75A2.75 2.75 0 0 1 5.75 4h12.5A2.75 2.75 0 0 1 21 6.75v10.5A2.75 2.75 0 0 1 18.25 20H5.75A2.75 2.75 0 0 1 3 17.25V6.75Zm2.2-.5 6.57 5.13a1.25 1.25 0 0 0 1.46 0L18.8 6.25H5.2Zm13.55 2.17-5.28 4.12a3.25 3.25 0 0 1-3.94 0L5.25 8.42v8.83c0 .41.34.75.75.75h12c.41 0 .75-.34.75-.75V8.42Z" fill="currentColor"/>
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" required autofocus autocomplete="username">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="field-group">
            <label for="password" class="field-label">Password</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 10V8.5A5 5 0 0 1 12 3.5a5 5 0 0 1 5 5V10h.75A2.25 2.25 0 0 1 20 12.25v7.5A2.25 2.25 0 0 1 17.75 22h-11.5A2.25 2.25 0 0 1 4 19.75v-7.5A2.25 2.25 0 0 1 6.25 10H7Zm2 0h6V8.5a3 3 0 1 0-6 0V10Zm2.5 4.75a1 1 0 1 0 2 0 .98.98 0 0 0-.27-.7.98.98 0 0 0-1.46 0 .98.98 0 0 0-.27.7Z" fill="currentColor"/>
                </svg>
                <input id="password" type="password" name="password" placeholder="Masukan Sandi" required autocomplete="current-password">
                <span class="field-action" aria-hidden="true">◌</span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="form-footer">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Forgot your password?</a>
            @endif
        </div>

        <button type="submit" class="login-button">Login</button>
    </form>
</x-guest-layout>
