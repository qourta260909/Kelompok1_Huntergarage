@php
    $unratedDoneOrder = auth()->check() && (auth()->user()->role ?? 'user') !== 'admin'
        ? \App\Models\Pesanan::where('user_id', auth()->id())
            ->where('status', 'selesai')
            ->whereNull('rating')
            ->orderBy('updated_at', 'desc')
            ->first()
        : null;
@endphp

@if ($unratedDoneOrder)
@php
    $isProdukDone = ($unratedDoneOrder->kategori ?? 'layanan') === 'produk';
    $kodeDone = $unratedDoneOrder->kode_booking;
    $judulNotif = $isProdukDone ? 'Pesanan Anda Sudah Diantar!' : 'Servis Kendaraan Sudah Selesai!';
    $pesanNotif = 'Pesanan ' . $kodeDone . ' (' . ($unratedDoneOrder->nama_layanan ?? 'Pesanan') . ') telah selesai. Yuk beri penilaian & ulasan Anda!';
@endphp

<style>
    .rating-reminder-toast {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 1100;
        width: calc(100% - 32px);
        max-width: 390px;
        background: #ffffff;
        border: 1.5px solid #fde047;
        border-radius: 16px;
        padding: 16px 18px;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.16);
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        transition: opacity 0.25s ease, transform 0.25s ease;
    }
    .rating-reminder-toast.hide {
        opacity: 0;
        transform: translateY(12px);
        pointer-events: none;
    }
    .rating-reminder-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #fef9c3;
        color: #ca8a04;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .rating-reminder-body {
        flex: 1;
        min-width: 0;
    }
    .rating-reminder-title {
        font-size: 13.5px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 3px;
    }
    .rating-reminder-desc {
        font-size: 12.5px;
        line-height: 1.45;
        color: #52525b;
        margin-bottom: 10px;
    }
    .rating-reminder-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .rating-reminder-cta {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 14px;
        border-radius: 9px;
        background: #111111;
        color: #ffffff;
        border: none;
        font-size: 12px;
        font-weight: 700;
        font-family: inherit;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.15s ease;
    }
    .rating-reminder-cta:hover {
        background: #27272a;
    }
    .rating-reminder-later {
        background: none;
        border: none;
        color: #71717a;
        font-size: 12px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        padding: 6px 8px;
    }
    .rating-reminder-later:hover {
        color: #18181b;
    }
    .rating-reminder-close {
        background: none;
        border: none;
        color: #a1a1aa;
        font-size: 20px;
        line-height: 1;
        cursor: pointer;
        padding: 0 2px;
    }
    .rating-reminder-close:hover {
        color: #18181b;
    }
</style>

<div id="ratingReminderToast" class="rating-reminder-toast" role="status" aria-live="polite" style="display:none;">
    <div class="rating-reminder-icon" aria-hidden="true">&#9733;</div>
    <div class="rating-reminder-body">
        <div class="rating-reminder-title">{{ $judulNotif }}</div>
        <div class="rating-reminder-desc">{{ $pesanNotif }}</div>
        <div class="rating-reminder-actions">
            @if (request()->routeIs('user.pesanan'))
                <button
                    type="button"
                    class="rating-reminder-cta"
                    onclick="dismissRatingReminder({{ $unratedDoneOrder->id }}); openRatingModal('{{ route('user.pesanan.rating', $unratedDoneOrder->id) }}', '{{ $kodeDone }}', {{ json_encode($unratedDoneOrder->nama_layanan ?? 'Pesanan') }})"
                >
                    &#9733; Beri Penilaian
                </button>
            @else
                <a
                    href="{{ route('user.pesanan', ['detail' => $unratedDoneOrder->id]) }}"
                    class="rating-reminder-cta"
                    onclick="dismissRatingReminder({{ $unratedDoneOrder->id }})"
                >
                    &#9733; Beri Penilaian
                </a>
            @endif
            <button type="button" class="rating-reminder-later" onclick="dismissRatingReminder({{ $unratedDoneOrder->id }})">Nanti Saja</button>
        </div>
    </div>
    <button type="button" class="rating-reminder-close" onclick="dismissRatingReminder({{ $unratedDoneOrder->id }})" aria-label="Tutup notifikasi">&times;</button>
</div>

<script>
    function dismissRatingReminder(orderId) {
        try {
            sessionStorage.setItem('hg_dismiss_rating_' + orderId, '1');
        } catch (e) {}
        const el = document.getElementById('ratingReminderToast');
        if (el) {
            el.classList.add('hide');
            setTimeout(function () {
                el.style.display = 'none';
            }, 260);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const orderId = {{ $unratedDoneOrder->id }};
        const el = document.getElementById('ratingReminderToast');
        if (!el) return;
        let dismissed = false;
        try {
            dismissed = sessionStorage.getItem('hg_dismiss_rating_' + orderId) === '1';
        } catch (e) {}
        if (!dismissed) {
            el.style.display = 'flex';
        }
    });
</script>
@endif
