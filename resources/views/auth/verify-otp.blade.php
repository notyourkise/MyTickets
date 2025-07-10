<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Verifikasi OTP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #1e3c72 100%);
            min-height: 100vh;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        }
        .travel-bg {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23667eea;stop-opacity:0.9"/><stop offset="100%" style="stop-color:%231e3c72;stop-opacity:0.9"/></linearGradient></defs><rect width="1200" height="600" fill="url(%23bg)"/><circle cx="300" cy="150" r="2" fill="white" opacity="0.3"/><circle cx="600" cy="100" r="1.5" fill="white" opacity="0.4"/><circle cx="900" cy="200" r="1" fill="white" opacity="0.5"/><circle cx="200" cy="350" r="2" fill="white" opacity="0.3"/><circle cx="1000" cy="300" r="1.5" fill="white" opacity="0.4"/><circle cx="100" cy="450" r="1" fill="white" opacity="0.5"/></svg>');
            background-size: cover;
            background-position: center;
        }
        .otp-input {
            width: 3.5rem;
            height: 3.5rem;
            font-size: 1.5rem;
            text-align: center;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .otp-input:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #667eea;
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.4);
            transform: scale(1.05);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }
        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .text-shadow {
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="travel-bg">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <div class="glass-effect rounded-3xl p-10 shadow-2xl">
                <!-- Logo & Branding -->
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center mb-6">
                        <div class="floating-icon bg-white bg-opacity-20 rounded-full p-4 mr-3">
                            <i class="fas fa-plane text-3xl text-white"></i>
                        </div>
                        <h1 class="text-3xl font-bold text-white text-shadow">MyTickets</h1>
                    </div>
                    <div class="w-16 h-1 bg-white rounded-full mx-auto"></div>
                </div>

                <!-- Header -->
                <div class="text-center mb-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6 pulse-animation">
                        <i class="fas fa-envelope-open text-3xl text-white"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-3 text-shadow">Verifikasi Email</h2>
                    <p class="text-white text-opacity-90 text-lg leading-relaxed">
                        Masukkan kode 6 digit yang telah dikirim ke email Anda untuk melengkapi proses registrasi
                    </p>
                    <div class="mt-4 p-3 bg-blue-500 bg-opacity-20 rounded-xl border border-blue-400 border-opacity-30">
                        <p class="text-blue-100 text-sm">
                            <i class="fas fa-info-circle mr-2"></i>
                            Periksa folder inbox atau spam email Anda
                        </p>
                    </div>
                </div>
            
                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500 bg-opacity-20 border border-green-400 border-opacity-30 text-green-100 rounded-xl backdrop-filter backdrop-blur-sm">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500 bg-opacity-20 border border-red-400 border-opacity-30 text-red-100 rounded-xl backdrop-filter backdrop-blur-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('otp.verify') }}" class="space-y-8">
                    @csrf

                    <!-- Email Address (readonly) -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-white mb-3">
                            <i class="fas fa-envelope mr-2"></i>Email Address
                        </label>
                        <input id="email" 
                               class="w-full px-5 py-4 bg-white bg-opacity-20 border border-white border-opacity-30 rounded-xl text-white placeholder-white placeholder-opacity-60 focus:outline-none font-medium text-lg cursor-not-allowed" 
                               type="email" 
                               name="email" 
                               value="{{ old('email', request('email')) }}" 
                               readonly />
                    </div>

                    <!-- OTP Input -->
                    <div>
                        <label for="otp_code" class="block text-sm font-semibold text-white mb-4">
                            <i class="fas fa-key mr-2"></i>Kode OTP
                        </label>
                        <div class="flex justify-center">
                            <input id="otp_code" 
                                   class="otp-input text-gray-800 focus:outline-none font-bold" 
                                   type="text" 
                                   name="otp_code" 
                                   value="{{ old('otp_code') }}" 
                                   required 
                                   maxlength="6" 
                                   pattern="[0-9]{6}" 
                                   placeholder="123456" 
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                        </div>
                        @if($errors->has('otp_code'))
                            <div class="mt-3 text-red-300 text-sm text-center flex items-center justify-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('otp_code') }}
                            </div>
                        @endif
                        <p class="text-center text-white text-opacity-70 text-sm mt-3">
                            Masukkan 6 digit kode yang dikirim ke email Anda
                        </p>
                    </div>

                    <!-- Verify Button -->
                    <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-semibold text-lg transform transition-all duration-300 hover:scale-105">
                        <i class="fas fa-check-circle mr-2"></i>Verifikasi Sekarang
                    </button>
                </form>

                <!-- Resend OTP Section -->
                <div class="mt-8 text-center">
                    <p class="text-white text-opacity-80 text-sm mb-4">Tidak menerima kode OTP?</p>
                    <form method="POST" action="{{ route('otp.resend') }}" class="inline">
                        @csrf
                        <input type="hidden" name="email" value="{{ old('email', request('email')) }}">
                        <button type="submit" class="glass-effect py-3 px-6 rounded-xl text-white font-medium hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-redo mr-2"></i>Kirim Ulang Kode
                        </button>
                    </form>
                </div>

                <!-- Timer Countdown -->
                <div class="mt-6 text-center">
                    <p class="text-white text-opacity-60 text-sm" id="countdown-timer">
                        <i class="fas fa-clock mr-2"></i>
                        Kode akan expired dalam <span id="timer" class="font-semibold">05:00</span>
                    </p>
                </div>

                <!-- Back to Register -->
                <div class="mt-8 text-center">
                    <a href="{{ route('register') }}" class="text-white text-opacity-70 hover:text-white transition-colors text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Registrasi
                    </a>
                </div>

                <!-- Help Section -->
                <div class="mt-8 p-4 glass-effect rounded-xl">
                    <div class="text-center">
                        <h4 class="text-white font-semibold mb-2">Butuh Bantuan?</h4>
                        <p class="text-white text-opacity-80 text-sm mb-3">
                            Jika Anda mengalami masalah dengan verifikasi email
                        </p>
                        <a href="#" class="text-blue-300 hover:text-blue-200 text-sm font-medium">
                            <i class="fas fa-headset mr-2"></i>Hubungi Customer Service
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Timer countdown
        let timeLeft = 300; // 5 minutes in seconds
        const timerElement = document.getElementById('timer');
        
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                document.getElementById('countdown-timer').innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>Kode OTP telah expired';
                return;
            }
            
            timeLeft--;
        }
        
        // Update timer every second
        updateTimer();
        setInterval(updateTimer, 1000);

        // Auto-focus OTP input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('otp_code').focus();
        });

        // Add floating animation to elements
        window.addEventListener('scroll', () => {
            const elements = document.querySelectorAll('.floating-icon');
            elements.forEach(el => {
                const speed = 0.5;
                const yPos = -(window.pageYOffset * speed);
                el.style.transform = `translateY(${yPos}px)`;
            });
        });
    </script>
</body>
</html>
