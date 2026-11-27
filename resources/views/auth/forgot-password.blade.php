<x-guest-layout>
    <div class="brand-wrap">
        <div class="brand-badge">
            <x-application-logo class="brand-logo" />
        </div>
    </div>

    <div style="margin-bottom: 0.85rem;">
        <h1 style="margin: 0 0 0.3rem; font-size: 1.35rem; font-weight: 800; color: #111827;">Lupa Kata Sandi?</h1>
        <p style="margin: 0; font-size: 0.84rem; line-height: 1.48; color: #4b5563;">
            Masukkan email akun Anda, klik <strong>Kirim OTP</strong>, lalu masukkan 6 digit kode OTP dari email beserta kata sandi baru Anda.
        </p>
    </div>

    <div id="forgotOtpAlert" style="display:none; margin-bottom: 0.85rem; padding: 0.7rem 0.9rem; border-radius: 12px; font-size: 0.83rem; font-weight: 600; line-height: 1.45;"></div>

    @if (session('status'))
        <div style="margin-bottom: 0.85rem; padding: 0.7rem 0.9rem; border-radius: 12px; background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; font-size: 0.83rem; font-weight: 600;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="login-form">
        @csrf

        <div class="field-group">
            <label for="email" class="field-label">Email</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 6.75A2.75 2.75 0 0 1 5.75 4h12.5A2.75 2.75 0 0 1 21 6.75v10.5A2.75 2.75 0 0 1 18.25 20H5.75A2.75 2.75 0 0 1 3 17.25V6.75Zm2.2-.5 6.57 5.13a1.25 1.25 0 0 0 1.46 0L18.8 6.25H5.2Zm13.55 2.17-5.28 4.12a3.25 3.25 0 0 1-3.94 0L5.25 8.42v8.83c0 .41.34.75.75.75h12c.41 0 .75-.34.75-.75V8.42Z" fill="currentColor"/>
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="contoh@gmail.com" required autofocus autocomplete="username">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="field-group">
            <label for="otp_code" class="field-label">Kode Verifikasi OTP (6 Digit)</label>
            <div style="display:flex; align-items:stretch; gap:8px;">
                <div class="field-shell" style="flex:1;">
                    <input id="otp_code" type="number" inputmode="numeric" name="otp_code" value="{{ old('otp_code') }}" placeholder="Masukkan 6 digit OTP" required style="padding-left:0.2rem;">
                </div>
                <button
                    type="button"
                    id="btnSendForgotOtp"
                    onclick="sendForgotPasswordOtp()"
                    style="padding:0 14px; border-radius:12px; border:1.5px solid #111827; background:#ffffff; color:#111827; font-family:inherit; font-size:0.82rem; font-weight:700; white-space:nowrap; cursor:pointer; transition:all 0.16s ease;"
                >
                    Kirim OTP
                </button>
            </div>
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <div class="field-group">
            <label for="password" class="field-label">Kata Sandi Baru</label>
            <div class="field-shell">
                <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 10V8.5A5 5 0 0 1 12 3.5a5 5 0 0 1 5 5V10h.75A2.25 2.25 0 0 1 20 12.25v7.5A2.25 2.25 0 0 1 17.75 22h-11.5A2.25 2.25 0 0 1 4 19.75v-7.5A2.25 2.25 0 0 1 6.25 10H7Zm2 0h6V8.5a3 3 0 1 0-6 0V10Zm2.5 4.75a1 1 0 1 0 2 0 .98.98 0 0 0-.27-.7.98.98 0 0 0-1.46 0 .98.98 0 0 0-.27.7Z" fill="currentColor"/>
                </svg>
                <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" minlength="8" required autocomplete="new-password">
                <svg class="password-icon" onclick="toggleForgotPw('password', this)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <svg class="password-icon" onclick="toggleForgotPw('password_confirmation', this)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12C5.5 8.5 8.5 7 12 7C15.5 7 18.5 8.5 21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M3 12C5.5 15.5 8.5 17 12 17C15.5 17 18.5 15.5 21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 5L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="login-button">Reset Kata Sandi</button>

        <div style="display:flex; align-items:center; justify-content:space-between; margin-top:0.35rem; font-size:0.86rem; color:#6b7280;">
            <a href="{{ route('login') }}" style="color:#111827; text-decoration:none; font-weight:600;">&larr; Kembali ke Halaman Masuk</a>
        </div>
    </form>

    <script>
        function toggleForgotPw(inputId, iconEl) {
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

        async function sendForgotPasswordOtp() {
            const emailInput = document.getElementById('email');
            const otpInput = document.getElementById('otp_code');
            const btn = document.getElementById('btnSendForgotOtp');
            const alertBox = document.getElementById('forgotOtpAlert');

            if (!emailInput || !emailInput.value.trim()) {
                if (alertBox) {
                    alertBox.textContent = 'Masukkan alamat email Anda terlebih dahulu.';
                    alertBox.style.cssText = 'display:block; margin-bottom:0.85rem; padding:0.7rem 0.9rem; border-radius:12px; font-size:0.83rem; font-weight:600; background:#fef2f2; border:1px solid #fecaca; color:#991b1b;';
                }
                if (emailInput) emailInput.focus();
                return;
            }

            if (btn) {
                btn.disabled = true;
                btn.textContent = 'Mengirim...';
            }
            if (alertBox) {
                alertBox.style.display = 'none';
            }

            try {
                const response = await fetch(@json(route('password.otp.send')), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': @json(csrf_token()),
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        email: emailInput.value.trim(),
                    }),
                });

                const result = await response.json();
                if (!response.ok || !result.ok) {
                    const errMsg = result.message
                        || (result.errors ? Object.values(result.errors).flat().join(' ') : 'Gagal mengirim kode OTP.');
                    throw new Error(errMsg);
                }

                if (alertBox) {
                    alertBox.textContent = result.message || 'Kode OTP 6 digit telah dikirim ke email Anda.';
                    alertBox.style.cssText = 'display:block; margin-bottom:0.85rem; padding:0.7rem 0.9rem; border-radius:12px; font-size:0.83rem; font-weight:600; background:#ecfdf5; border:1px solid #a7f3d0; color:#065f46;';
                }
                if (otpInput) otpInput.focus();
            } catch (err) {
                if (alertBox) {
                    alertBox.textContent = err.message || 'Terjadi kesalahan saat mengirim kode OTP.';
                    alertBox.style.cssText = 'display:block; margin-bottom:0.85rem; padding:0.7rem 0.9rem; border-radius:12px; font-size:0.83rem; font-weight:600; background:#fef2f2; border:1px solid #fecaca; color:#991b1b;';
                }
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.textContent = 'Kirim Ulang OTP';
                }
            }
        }
    </script>
</x-guest-layout>
