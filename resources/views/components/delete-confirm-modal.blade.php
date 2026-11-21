<div id="globalDeleteConfirmModal" class="logout-modal-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="deleteConfirmModalTitle" aria-describedby="deleteConfirmModalDesc">
    <div class="logout-modal-backdrop" onclick="closeDeleteConfirmModal()"></div>
    <div class="logout-modal-card">
        <div class="logout-modal-icon-wrapper">
            <div class="logout-modal-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14z" />
                </svg>
            </div>
        </div>

        <h3 id="deleteConfirmModalTitle" class="logout-modal-title">Konfirmasi Hapus</h3>
        <p id="deleteConfirmModalDesc" class="logout-modal-desc">
            Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
        </p>

        <div class="logout-modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeDeleteConfirmModal()">
                Batal
            </button>
            <form id="globalDeleteConfirmForm" method="POST" action="" style="margin: 0; flex: 1; display: flex;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-modal-confirm" style="width: 100%;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14z" />
                    </svg>
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteConfirmModal(actionUrl, titleText, descText) {
        const modal = document.getElementById('globalDeleteConfirmModal');
        const form = document.getElementById('globalDeleteConfirmForm');
        const titleEl = document.getElementById('deleteConfirmModalTitle');
        const descEl = document.getElementById('deleteConfirmModalDesc');
        if (!modal || !form) return;

        form.action = actionUrl;
        if (titleEl && titleText) titleEl.textContent = titleText;
        if (descEl && descText) descEl.textContent = descText;

        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteConfirmModal() {
        const modal = document.getElementById('globalDeleteConfirmModal');
        if (!modal) return;
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeDeleteConfirmModal();
        }
    });
</script>
