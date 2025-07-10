<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class OtpController extends Controller
{
    /**
     * Display the OTP verification view.
     */
    public function show(Request $request)
    {
        $email = $request->query('email');
        
        if (!$email) {
            return redirect()->route('register')->withErrors([
                'email' => 'Email tidak ditemukan. Silakan registrasi ulang.',
            ]);
        }

        return view('auth.verify-otp', compact('email'));
    }

    /**
     * Handle OTP verification.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp_code' => ['required', 'string', 'size:6'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ])->onlyInput('email');
        }

        // Check if OTP is correct and not expired
        if ($user->otp_code !== $request->otp_code) {
            return back()->withErrors([
                'otp_code' => 'Kode OTP tidak valid.',
            ])->onlyInput('email');
        }

        if (Carbon::now()->gt($user->otp_expires_at)) {
            return back()->withErrors([
                'otp_code' => 'Kode OTP telah kedaluwarsa.',
            ])->onlyInput('email');
        }

        // Verify the user
        $user->update([
            'is_verified' => true,
            'email_verified_at' => now(),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        // Log the user in
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun Anda berhasil diverifikasi!');
    }

    /**
     * Resend OTP to user email.
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ])->onlyInput('email');
        }

        if ($user->is_verified) {
            return redirect()->route('login')->with('success', 'Akun Anda sudah terverifikasi. Silakan login.');
        }

        // Generate new OTP
        $otpCode = sprintf('%06d', mt_rand(100000, 999999));
        
        $user->update([
            'otp_code' => $otpCode,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
        ]);

        // Send OTP email
        try {
            Mail::to($user->email)->send(new SendOtpMail($otpCode, $user->name));
            
            return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Gagal mengirim email. Silakan coba lagi.',
            ])->onlyInput('email');
        }
    }
}
