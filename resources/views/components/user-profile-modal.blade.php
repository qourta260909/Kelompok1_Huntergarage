@auth
<style>
    .user-profile-otp-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(9, 9, 11, 0.62);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 18px;
        z-index: 9999;
    }
    .user-profile-otp-overlay.active {
        display: flex;
    }
    .user-profile-otp-card {
        width: 100%;
        max-width: 480px;
        max-height: 92vh;
        overflow-y: auto;
        background-color: #ffffff;
        border-radius: 20px;
        border: 1px solid #e4e4e7;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.28);
        padding: 24px 26px;
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        color: #111111;
    }
    .user-profile-otp-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 6px;
    }
    .user-profile-otp-title {
        font-size: 19px;
        font-weight: 700;
        color: #09090b;
        margin: 0;
    }
    .user-profile-otp-close {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        border: 1px solid #d4d4d8;
        background-color: #ffffff;
        color: #18181b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .user-profile-otp-close:hover {
        background-color: #f4f4f5;
    }
    .user-profile-otp-sub {
        font-size: 12.5px;
        color: #52525b;
        margin: 0 0 18px;
        line-height: 1.5;
    }
    .user-profile-field {
        margin-bottom: 14px;
    }
    .user-profile-label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #27272a;
        margin-bottom: 5px;
    }
    .user-profile-input {
        width: 100%;
        padding: 10px 13px;
        border-radius: 10px;
        border: 1.2px solid #d4d4d8;
        background-color: #ffffff;
        font-family: inherit;
        font-size: 13.5px;
        color: #111111;
        outline: none;
    }
    .user-profile-input:focus {
        border-color: #111111;
    }
    .user-profile-pw-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .user-profile-pw-wrap .user-profile-input {
        padding-right: 42px;
    }
    .user-profile-pw-toggle {
        position: absolute;
        right: 10px;
        width: 28px;
        height: 28px;
        border: none;
        background: transparent;
        color: #71717a;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 6px;
        padding: 0;
        transition: color 0.15s ease;
    }
    .user-profile-pw-toggle:hover {
        color: #111111;
    }
    .user-profile-otp-row {
        display: flex;
        align-items: stretch;
        gap: 10px;
    }
    .otp-channel-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 10px;
    }
    .otp-channel-option {
        position: relative;
    }
    .otp-channel-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .otp-channel-pill {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 12px;
        border-radius: 10px;
        border: 1.5px solid #d4d4d8;
        background-color: #ffffff;
        color: #27272a;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.16s ease;
        user-select: none;
    }
    .otp-channel-option input[type="radio"]:checked + .otp-channel-pill {
        border-color: #111111;
        background-color: #111111;
        color: #ffffff;
    }
    .otp-channel-option input[type="radio"]:checked + .otp-channel-pill.is-wa {
        border-color: #16a34a;
        background-color: #16a34a;
        color: #ffffff;
    }
    .btn-send-otp {
        padding: 0 16px;
        border-radius: 10px;
        border: 1.5px solid #111111;
        background-color: #ffffff;
        color: #111111;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.16s ease;
    }
    .btn-send-otp:hover:not(:disabled) {
        background-color: #111111;
        color: #ffffff;
    }
    .btn-send-otp:disabled {
        opacity: 0.55;
        cursor: not-allowed;
    }
    .user-profile-otp-alert {
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 12.5px;
        font-weight: 600;
        margin-bottom: 14px;
        display: none;
        line-height: 1.45;
    }
    .user-profile-otp-alert.is-success {
        display: block;
        background-color: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }
    .user-profile-otp-alert.is-error {
        display: block;
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }
    .user-profile-otp-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 18px;
        padding-top: 14px;
        border-top: 1px solid #e4e4e7;
    }
    .btn-profile-cancel {
        padding: 10px 18px;
        border-radius: 10px;
        border: 1px solid #d4d4d8;
        background-color: #f4f4f5;
        color: #27272a;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-profile-save {
        padding: 10px 22px;
        border-radius: 10px;
        border: none;
        background-color: #111111;
        color: #ffffff;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-profile-save:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

<div class="user-profile-otp-overlay" id="userProfileOtpModal" aria-hidden="true" onclick="if(event.target === this) closeUserProfileModal();">
    <div class="user-profile-otp-card" role="dialog" aria-modal="true" aria-labelledby="userProfileOtpTitle">
        <div class="user-profile-otp-head">
            <h3 class="user-profile-otp-title" id="userProfileOtpTitle">Edit Profil &amp; Kata Sandi</h3>
            <button type="button" class="user-profile-otp-close" onclick="closeUserProfileModal()" aria-label="Tutup">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <p class="user-profile-otp-sub">
            Ubah username atau kata sandi akun Anda menggunakan verifikasi kode OTP 6 digit yang dikirim ke email <strong>{{ Auth::user()->email }}</strong>.
        </p>

        <div id="userProfileOtpFeedback" class="user-profile-otp-alert"></div>

        <form id="userProfileOtpForm" onsubmit="submitUserProfileOtp(event)">
            @csrf
            <div class="user-profile-field">
                <label for="profileOtpName" class="user-profile-label">Username / Nama Lengkap</label>
                <input type="text" id="profileOtpName" name="name" class="user-profile-input" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="user-profile-field">
                <label for="profileOtpTelepon" class="user-profile-label">No. Telepon / WhatsApp</label>
                <input type="number" inputmode="numeric" id="profileOtpTelepon" name="no_telepon" class="user-profile-input" value="{{ preg_replace('/\D+/', '', (string) (Auth::user()->no_telepon ?? '')) }}" placeholder="Contoh: 081234567890">
            </div>

            <div class="user-profile-field">
                <label for="profileOtpAlamat" class="user-profile-label">Alamat Pengiriman</label>
                <input type="text" id="profileOtpAlamat" name="alamat" class="user-profile-input" value="{{ Auth::user()->alamat ?? '' }}" placeholder="Alamat lengkap pengiriman...">
            </div>

            <div class="user-profile-field">
                <label for="profileOtpPassword" class="user-profile-label">Kata Sandi Baru <span style="font-weight:400; color:#71717a;">(Kosongkan jika tidak diubah)</span></label>
                <div class="user-profile-pw-wrap">
                    <input type="password" id="profileOtpPassword" name="password" class="user-profile-input" placeholder="Minimal 8 karakter" minlength="8" autocomplete="new-password">
                    <button type="button" class="user-profile-pw-toggle" onclick="toggleProfilePassword('profileOtpPassword', this)" aria-label="Tampilkan atau sembunyikan kata sandi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12C5.5 8.5 8.5 7 12 7C15.5 7 18.5 8.5 21 12"/>
                            <path d="M3 12C5.5 15.5 8.5 17 12 17C15.5 17 18.5 15.5 21 12"/>
                            <path d="M5 5L19 19"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="user-profile-field">
                <label for="profileOtpPasswordConfirm" class="user-profile-label">Konfirmasi Kata Sandi Baru</label>
                <div class="user-profile-pw-wrap">
                    <input type="password" id="profileOtpPasswordConfirm" name="password_confirmation" class="user-profile-input" placeholder="Ulangi kata sandi baru" minlength="8" autocomplete="new-password">
                    <button type="button" class="user-profile-pw-toggle" onclick="toggleProfilePassword('profileOtpPasswordConfirm', this)" aria-label="Tampilkan atau sembunyikan konfirmasi kata sandi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12C5.5 8.5 8.5 7 12 7C15.5 7 18.5 8.5 21 12"/>
                            <path d="M3 12C5.5 15.5 8.5 17 12 17C15.5 17 18.5 15.5 21 12"/>
                            <path d="M5 5L19 19"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="user-profile-field">
                <label for="profileOtpCode" class="user-profile-label">Kode Verifikasi OTP (6 Digit)</label>
                <div class="user-profile-otp-row">
                    <input type="number" inputmode="numeric" id="profileOtpCode" name="otp_code" class="user-profile-input" placeholder="Masukkan 6 digit OTP" required>
                    <button type="button" class="btn-send-otp" id="btnSendProfileOtp" onclick="requestUserProfileOtp()">
                        Kirim OTP ke Email
                    </button>
                </div>
            </div>

            <div class="user-profile-otp-actions">
                <button type="button" class="btn-profile-cancel" onclick="closeUserProfileModal()">Batal</button>
                <button type="submit" class="btn-profile-save" id="btnSaveProfileOtp">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openUserProfileModal() {
        const modal = document.getElementById('userProfileOtpModal');
        const dropdown = document.getElementById('userDropdown');
        if (dropdown) dropdown.classList.remove('open');
        if (modal) {
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
        }
    }

    function closeUserProfileModal() {
        const modal = document.getElementById('userProfileOtpModal');
        if (modal) {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
        }
    }

    function toggleProfilePassword(inputId, btnEl) {
        const input = document.getElementById(inputId);
        if (!input || !btnEl) return;

        if (input.type === 'password') {
            input.type = 'text';
            btnEl.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            `;
        } else {
            input.type = 'password';
            btnEl.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12C5.5 8.5 8.5 7 12 7C15.5 7 18.5 8.5 21 12"/>
                    <path d="M3 12C5.5 15.5 8.5 17 12 17C15.5 17 18.5 15.5 21 12"/>
                    <path d="M5 5L19 19"/>
                </svg>
            `;
        }
    }

    async function requestUserProfileOtp() {
        const btn = document.getElementById('btnSendProfileOtp');
        const feedback = document.getElementById('userProfileOtpFeedback');
        const otpInput = document.getElementById('profileOtpCode');
        if (!btn) return;

        btn.disabled = true;
        btn.textContent = 'Mengirim...';
        if (feedback) {
            feedback.className = 'user-profile-otp-alert';
            feedback.style.display = 'none';
        }

        try {
            const response = await fetch(@json(route('profile.otp.send')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': @json(csrf_token()),
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({}),
            });

            const result = await response.json();
            if (!response.ok || !result.ok) {
                throw new Error(result.message || 'Gagal mengirim kode OTP.');
            }

            if (feedback) {
                feedback.textContent = result.message || 'Kode OTP berhasil dikirim ke email Anda.';
                feedback.className = 'user-profile-otp-alert is-success';
                feedback.style.display = 'block';
            }
            if (otpInput) {
                otpInput.focus();
            }
        } catch (err) {
            if (feedback) {
                feedback.textContent = err.message || 'Terjadi kesalahan saat mengirim OTP.';
                feedback.className = 'user-profile-otp-alert is-error';
                feedback.style.display = 'block';
            }
        } finally {
            btn.disabled = false;
            btn.textContent = 'Kirim Ulang OTP';
        }
    }

    async function submitUserProfileOtp(event) {
        event.preventDefault();
        const form = document.getElementById('userProfileOtpForm');
        const btnSave = document.getElementById('btnSaveProfileOtp');
        const feedback = document.getElementById('userProfileOtpFeedback');
        if (!form || !btnSave) return;

        btnSave.disabled = true;
        btnSave.textContent = 'Menyimpan...';

        try {
            const formData = new FormData(form);
            const response = await fetch(@json(route('profile.otp.update')), {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': @json(csrf_token()),
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            });

            const result = await response.json();
            if (!response.ok || !result.ok) {
                const errorMsg = result.message
                    || (result.errors ? Object.values(result.errors).flat().join(' ') : 'Gagal memperbarui profil.');
                throw new Error(errorMsg);
            }

            if (feedback) {
                feedback.textContent = result.message || 'Profil berhasil diperbarui!';
                feedback.className = 'user-profile-otp-alert is-success';
                feedback.style.display = 'block';
            }

            setTimeout(function () {
                window.location.reload();
            }, 900);
        } catch (err) {
            if (feedback) {
                feedback.textContent = err.message || 'Terjadi kesalahan saat menyimpan profil.';
                feedback.className = 'user-profile-otp-alert is-error';
                feedback.style.display = 'block';
            }
            btnSave.disabled = false;
            btnSave.textContent = 'Simpan Perubahan';
        }
    }
</script>
@endauth
