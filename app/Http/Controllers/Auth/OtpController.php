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
use Illuminate\Support\Facades\Validator;

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
    
    /**
     * API endpoint to send OTP for registration or verification.
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Alamat email tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $email = $request->email;
        
        // Check if user already exists and is verified
        $existingUser = User::where('email', $email)->first();
        if ($existingUser && $existingUser->is_verified) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah terdaftar. Silakan login.'
            ], 422);
        }
        
        // Generate OTP
        $otpCode = sprintf('%06d', mt_rand(100000, 999999));
        $expiryTime = Carbon::now()->addMinutes(10);
        
        if ($existingUser) {
            // Update existing unverified user
            $existingUser->update([
                'otp_code' => $otpCode,
                'otp_expires_at' => $expiryTime
            ]);
            $user = $existingUser;
        } else {
            // Create a temporary user record
            $user = User::create([
                'name' => explode('@', $email)[0], // Use part of email as name temporarily
                'email' => $email,
                'password' => Hash::make(uniqid()), // Random temporary password
                'otp_code' => $otpCode,
                'otp_expires_at' => $expiryTime,
                'is_verified' => false,
            ]);
        }
        
        // Send OTP email
        try {
            Mail::to($user->email)->send(new SendOtpMail($otpCode, $user->name));
            return response()->json([
                'success' => true,
                'message' => 'Kode OTP telah dikirim ke email Anda.'
            ]);
        } catch (\Exception $e) {
            \Log::error('sendOtp SMTP failure: '.$e->getMessage(), [
                'email' => $user->email,
                'mailer' => config('mail.default')
            ]);
            // Allow continuing only when using non-delivery mailers (log/array)
            if (in_array(config('mail.default'), ['log', 'array'])) {
                \Log::warning('OTP email send failed in local env: '.$e->getMessage());
                return response()->json([
                    'success' => true,
                    'message' => 'OTP dibuat (mode lokal).',
                    'debug_otp' => $otpCode
                ]);
            }
            // If the user was newly created, delete it
            if (!$existingUser) {
                $user->delete();
            }
            $payload = [
                'success' => false,
                'message' => 'Gagal mengirim email. Silakan coba lagi.'
            ];
            if (config('app.debug')) {
                $payload['error'] = $e->getMessage();
            }
            return response()->json($payload, 500);
        }
    }
    
    /**
     * API endpoint to verify OTP
     */
    public function verifyApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'otp_code' => ['required', 'string', 'size:6'],
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan.'
            ], 404);
        }
        
        // Check if OTP is correct and not expired
        if ($user->otp_code !== $request->otp_code) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP tidak valid.'
            ], 422);
        }
        
        if (Carbon::now()->gt($user->otp_expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP telah kedaluwarsa.'
            ], 422);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Verifikasi OTP berhasil.'
        ]);
    }
    
    /**
     * API endpoint to resend OTP
     */
    public function resendApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan.'
            ], 404);
        }
        
        if ($user->is_verified) {
            return response()->json([
                'success' => false,
                'message' => 'Akun sudah terverifikasi. Silakan login.'
            ], 422);
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
            return response()->json([
                'success' => true,
                'message' => 'Kode OTP baru telah dikirim ke email Anda.'
            ]);
        } catch (\Exception $e) {
            \Log::error('resendApi SMTP failure: '.$e->getMessage(), [
                'email' => $user->email,
                'mailer' => config('mail.default')
            ]);
            if (in_array(config('mail.default'), ['log', 'array'])) {
                \Log::warning('Resend OTP email failed in local env: '.$e->getMessage());
                return response()->json([
                    'success' => true,
                    'message' => 'OTP baru dibuat (mode lokal).',
                    'debug_otp' => $otpCode
                ]);
            }
            $payload = [
                'success' => false,
                'message' => 'Gagal mengirim email. Silakan coba lagi.'
            ];
            if (config('app.debug')) {
                $payload['error'] = $e->getMessage();
            }
            return response()->json($payload, 500);
        }
    }
    
    /**
     * API endpoint to complete registration with password
     */
    public function completeRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan.'
            ], 404);
        }
        
        // Update user password and mark as verified
        $user->update([
            'password' => Hash::make($request->password),
            'is_verified' => true,
            'email_verified_at' => now(),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
        
        // Log the user in
        Auth::login($user);
        
        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil!'
        ]);
    }
    
    /**
     * API endpoint to login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if user is verified
            if (!$user->is_verified) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Akun belum diverifikasi.'
                ], 403);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'user' => $user->only(['id', 'name', 'email'])
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 401);
    }
}
