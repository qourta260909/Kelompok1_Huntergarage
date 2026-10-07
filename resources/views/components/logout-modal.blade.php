<div id="logoutConfirmModal" class="logout-modal-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle" aria-describedby="logoutModalDesc">
    <div class="logout-modal-backdrop" onclick="closeLogoutModal()"></div>
    <div class="logout-modal-card">
        <div class="logout-modal-icon-wrapper">
            <div class="logout-modal-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
        </div>
        
        <h3 id="logoutModalTitle" class="logout-modal-title">Konfirmasi Keluar</h3>
        <p id="logoutModalDesc" class="logout-modal-desc">
            Apakah Anda yakin ingin keluar dari akun Hunter Garage? Anda perlu login kembali untuk mengakses panel dashboard.
        </p>

        <div class="logout-modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeLogoutModal()">
                Batal
            </button>
            <button type="button" class="btn-modal-confirm" onclick="executeLogout()">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Ya, Keluar
            </button>
        </div>

        <form id="logoutModalHiddenForm" method="POST" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
    </div>
</div>

<script>
    function openLogoutModal() {
        const modal = document.getElementById('logoutConfirmModal');
        if (modal) {
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutConfirmModal');
        if (modal) {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }

    function executeLogout() {
        const form = document.getElementById('logoutModalHiddenForm');
        if (form) {
            form.submit();
        }
    }

    // Tutup modal jika tombol ESC ditekan
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLogoutModal();
        }
    });
</script>
