<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\SendOtpMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Generate OTP code
        $otpCode = sprintf('%06d', mt_rand(100000, 999999));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp_code' => $otpCode,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
            'is_verified' => false,
        ]);

        event(new Registered($user));

        // Send OTP email
        try {
            Mail::to($user->email)->send(new SendOtpMail($otpCode, $user->name));
            
            return redirect()->route('otp.show', ['email' => $user->email])
                ->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk kode verifikasi OTP.');
        } catch (\Exception $e) {
            // If email sending fails, delete the user and show error
            $user->delete();
            
            return back()->withErrors([
                'email' => 'Gagal mengirim email verifikasi. Silakan coba lagi.',
            ])->onlyInput('name', 'email');
        }
    }
}
