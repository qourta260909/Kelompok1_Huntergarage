@if (session('login_success'))
<div id="loginSuccessToast" class="login-toast" role="status" aria-live="polite">
    <div class="login-toast-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="m8.5 12.5 2.5 2.5 4.5-5"></path>
        </svg>
    </div>
    <div class="login-toast-content">
        <div class="login-toast-title">Berhasil Masuk</div>
        <div class="login-toast-subtitle">Selamat datang kembali{{ auth()->check() ? ', ' . explode(' ', trim(auth()->user()->name))[0] : '' }}!</div>
    </div>
    <button type="button" class="login-toast-close" onclick="closeLoginToast()" aria-label="Tutup notifikasi">
        &times;
    </button>
</div>

<script>
    function closeLoginToast() {
        const toast = document.getElementById('loginSuccessToast');
        if (toast) {
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 300);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('loginSuccessToast');
        if (toast) {
            setTimeout(() => {
                closeLoginToast();
            }, 3500);
        }
    });
</script>
@endif
