<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the OTP-based password reset view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a 6-digit OTP code to the user's email for resetting password.
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
        ]);

        $email = strtolower(trim($validated['email']));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'Kami tidak dapat menemukan akun dengan alamat email tersebut.',
            ], 422);
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
            'forgot_pw_otp_email' => $user->email,
            'forgot_pw_otp_code' => $otpCode,
            'forgot_pw_otp_expires' => $expiresAt->timestamp,
        ]);

        try {
            $htmlBody = "
                <div style='font-family:Poppins,Arial,sans-serif;max-width:480px;margin:0 auto;padding:24px;border:1px solid #e4e4e7;border-radius:16px;background:#ffffff;color:#111111;'>
                    <h2 style='margin:0 0 8px;font-size:18px;font-weight:700;color:#09090b;'>Hunter Garage</h2>
                    <p style='margin:0 0 16px;font-size:13.5px;color:#52525b;line-height:1.5;'>Halo <strong>" . e($user->name) . "</strong>, gunakan kode verifikasi OTP 6 digit berikut untuk mengatur ulang (reset) kata sandi akun Anda:</p>
                    <div style='text-align:center;padding:16px;margin:16px 0;background:#f4f4f5;border-radius:12px;letter-spacing:6px;font-size:26px;font-weight:800;color:#09090b;'>
                        {$otpCode}
                    </div>
                    <p style='margin:0 0 12px;font-size:12.5px;color:#71717a;'>Kode ini berlaku selama <strong>10 menit</strong>. Jangan berikan kode ini kepada siapa pun.</p>
                    <hr style='border:none;border-top:1px solid #e4e4e7;margin:16px 0;'>
                    <p style='margin:0;font-size:11.5px;color:#a1a1aa;'>Email ini dikirim secara otomatis (No-Reply). Mohon tidak membalas email ini.</p>
                </div>
            ";

            Mail::html(
                $htmlBody,
                function ($message) use ($user) {
                    $message->from(
                        config('mail.from.address', 'noreply@huntergarage.com'),
                        config('mail.from.name', 'Hunter Garage (No-Reply)')
                    )
                        ->replyTo('noreply@huntergarage.com', 'No-Reply Hunter Garage')
                        ->to($user->email)
                        ->subject('Kode OTP Reset Kata Sandi - Hunter Garage');
                }
            );
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim Email OTP Reset Password: ' . $e->getMessage());
            return response()->json([
                'ok' => false,
                'message' => 'Gagal mengirim email kode OTP. Pastikan konfigurasi MAIL di file .env sudah benar.',
            ], 500);
        }

        return response()->json([
            'ok' => true,
            'message' => "Kode OTP 6 digit telah dikirim ke email {$user->email}. Silakan cek kotak masuk atau folder spam Anda.",
        ]);
    }

    /**
     * Verify the 6-digit OTP code and reset the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'otp_code' => ['required', 'digits:6'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'otp_code.required' => 'Kode OTP 6 digit wajib diisi.',
            'otp_code.digits' => 'Kode OTP harus terdiri dari 6 digit angka.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $email = strtolower(trim($validated['email']));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Kami tidak dapat menemukan akun dengan alamat email tersebut.']);
        }

        $storedOtp = null;
        $isExpired = true;

        if (Schema::hasColumns('users', ['otp_code', 'otp_expires_at']) && !empty($user->otp_code)) {
            $storedOtp = (string) $user->otp_code;
            $isExpired = $user->otp_expires_at ? now()->greaterThan($user->otp_expires_at) : false;
        } elseif (session('forgot_pw_otp_email') === $user->email && session()->has('forgot_pw_otp_code')) {
            $storedOtp = (string) session('forgot_pw_otp_code');
            $expiresTs = (int) session('forgot_pw_otp_expires', 0);
            $isExpired = now()->timestamp > $expiresTs;
        }

        if (!$storedOtp || $storedOtp !== (string) $validated['otp_code']) {
            return back()->withInput($request->only('email'))
                ->withErrors(['otp_code' => 'Kode OTP tidak valid. Silakan periksa kembali kode OTP di email Anda.']);
        }

        if ($isExpired) {
            return back()->withInput($request->only('email'))
                ->withErrors(['otp_code' => 'Kode OTP sudah kedaluwarsa. Silakan klik Kirim OTP kembali.']);
        }

        $fillData = [
            'password' => Hash::make($validated['password']),
            'remember_token' => Str::random(60),
        ];

        if (Schema::hasColumn('users', 'plain_password')) {
            $fillData['plain_password'] = $validated['password'];
        }

        if (Schema::hasColumns('users', ['otp_code', 'otp_expires_at'])) {
            $fillData['otp_code'] = null;
            $fillData['otp_expires_at'] = null;
        }

        $user->forceFill($fillData)->save();
        session()->forget(['forgot_pw_otp_email', 'forgot_pw_otp_code', 'forgot_pw_otp_expires']);

        return redirect()->route('login')->with('status', 'Kata sandi berhasil diatur ulang! Silakan masuk dengan kata sandi baru Anda.');
    }
}
