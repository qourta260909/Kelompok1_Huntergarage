<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Send a 6-digit OTP code via Email to verify profile (username / password) changes.
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['ok' => false, 'message' => 'Sesi login tidak ditemukan.'], 401);
        }

        $otpCode = (string) random_int(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        if (Schema::hasColumns('users', ['otp_code', 'otp_expires_at'])) {
            $user->forceFill([
                'otp_code' => $otpCode,
                'otp_expires_at' => $expiresAt,
            ])->save();
        }

        session([
            'profile_otp_code' => $otpCode,
            'profile_otp_expires' => $expiresAt->timestamp,
        ]);

        try {
            Mail::raw(
                "Halo {$user->name},\n\nKode OTP untuk perubahan profil (Username / Kata Sandi) akun Hunter Garage Anda adalah: {$otpCode}\nKode ini berlaku selama 10 menit.\n\nSalam,\nHunter Garage",
                function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Kode OTP Perubahan Profil - Hunter Garage');
                }
            );
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim Email OTP: ' . $e->getMessage());
            return response()->json([
                'ok' => false,
                'message' => 'Gagal mengirim email OTP. Pastikan konfigurasi MAIL di file .env sudah benar.',
            ], 500);
        }

        return response()->json([
            'ok' => true,
            'channel' => 'email',
            'message' => "Kode OTP 6 digit telah dikirim ke email {$user->email}. Silakan cek kotak masuk atau folder spam email Anda.",
            'expires_in_minutes' => 10,
        ]);
    }

    /**
     * Verify OTP and update user's username (name), password, phone, or address.
     */
    public function updateWithOtp(Request $request): JsonResponse|RedirectResponse
    {
        $user = $request->user();
        if (!$user) {
            abort(401);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'otp_code' => ['required', 'digits:6'],
        ], [
            'name.required' => 'Username / Nama lengkap wajib diisi.',
            'password.min' => 'Kata sandi baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'otp_code.required' => 'Kode OTP wajib diisi.',
            'otp_code.digits' => 'Kode OTP harus terdiri dari 6 digit angka.',
        ]);

        $storedOtp = null;
        $isExpired = true;

        if (Schema::hasColumns('users', ['otp_code', 'otp_expires_at']) && !empty($user->otp_code)) {
            $storedOtp = (string) $user->otp_code;
            $isExpired = $user->otp_expires_at ? now()->greaterThan($user->otp_expires_at) : false;
        } elseif (session()->has('profile_otp_code')) {
            $storedOtp = (string) session('profile_otp_code');
            $expiresTs = (int) session('profile_otp_expires', 0);
            $isExpired = now()->timestamp > $expiresTs;
        }

        if (!$storedOtp || $storedOtp !== (string) $validated['otp_code']) {
            $errMsg = 'Kode OTP tidak valid. Silakan periksa kembali kode OTP Anda.';
            if ($request->expectsJson()) {
                return response()->json(['ok' => false, 'message' => $errMsg], 422);
            }
            return back()->withErrors(['otp_code' => $errMsg])->withInput();
        }

        if ($isExpired) {
            $errMsg = 'Kode OTP sudah kedaluwarsa. Silakan klik Kirim OTP kembali.';
            if ($request->expectsJson()) {
                return response()->json(['ok' => false, 'message' => $errMsg], 422);
            }
            return back()->withErrors(['otp_code' => $errMsg])->withInput();
        }

        $updateData = [
            'name' => trim($validated['name']),
        ];

        if ($request->has('no_telepon')) {
            $updateData['no_telepon'] = trim((string) ($validated['no_telepon'] ?? '')) ?: null;
        }

        if ($request->has('alamat')) {
            $updateData['alamat'] = trim((string) ($validated['alamat'] ?? '')) ?: null;
        }

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        if (Schema::hasColumns('users', ['otp_code', 'otp_expires_at'])) {
            $updateData['otp_code'] = null;
            $updateData['otp_expires_at'] = null;
        }

        $user->forceFill($updateData)->save();
        session()->forget(['profile_otp_code', 'profile_otp_expires']);

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'message' => 'Profil berhasil diperbarui melalui verifikasi OTP!',
                'user_name' => $user->name,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui melalui verifikasi OTP!');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
