<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #764ba2 0%, #667eea 50%, #1e3c72 100%);
            min-height: 100vh;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        }
        .travel-bg {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23764ba2;stop-opacity:0.9"/><stop offset="100%" style="stop-color:%231e3c72;stop-opacity:0.9"/></linearGradient></defs><rect width="1200" height="600" fill="url(%23bg)"/><circle cx="200" cy="150" r="2" fill="white" opacity="0.3"/><circle cx="400" cy="100" r="1.5" fill="white" opacity="0.4"/><circle cx="600" cy="200" r="1" fill="white" opacity="0.5"/><circle cx="800" cy="350" r="2" fill="white" opacity="0.3"/><circle cx="1000" cy="180" r="1.5" fill="white" opacity="0.4"/><circle cx="150" cy="450" r="1" fill="white" opacity="0.5"/></svg>');
            background-size: cover;
            background-position: center;
        }
        .input-field {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .input-field:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #764ba2;
            box-shadow: 0 0 20px rgba(118, 75, 162, 0.3);
            transform: translateY(-2px);
        }
        .btn-primary {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(118, 75, 162, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(118, 75, 162, 0.4);
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
    </style>
</head>
<body class="travel-bg">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-8 items-center">
            
            <!-- Left Side - Registration Form -->
            <div class="flex justify-center lg:justify-start order-2 lg:order-1">
                <div class="glass-effect rounded-3xl p-10 w-full max-w-lg shadow-2xl">
                    <!-- Logo for mobile -->
                    <div class="lg:hidden text-center mb-8">
                        <div class="flex items-center justify-center mb-4">
                            <div class="bg-white bg-opacity-20 rounded-full p-3 mr-3">
                                <i class="fas fa-plane text-2xl text-white"></i>
                            </div>
                            <h1 class="text-3xl font-bold text-white">MyTickets</h1>
                        </div>
                        <div class="w-16 h-1 bg-white rounded-full mx-auto"></div>
                    </div>

                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold text-white mb-3 text-shadow">Bergabung dengan Kami</h2>
                        <p class="text-white text-opacity-90 text-lg">Buat akun dan mulai petualangan Anda</p>
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

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-white mb-3">
                                <i class="fas fa-user mr-2"></i>Nama Lengkap
                            </label>
                            <input id="name" 
                                   class="input-field w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none font-medium text-lg" 
                                   type="text" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="masukkan nama lengkap Anda"
                                   required autofocus />
                            @if($errors->has('name'))
                                <div class="mt-3 text-red-300 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-white mb-3">
                                <i class="fas fa-envelope mr-2"></i>Email Address
                            </label>
                            <input id="email" 
                                   class="input-field w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none font-medium text-lg" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="masukkan email Anda"
                                   required />
                            @if($errors->has('email'))
                                <div class="mt-3 text-red-300 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-white mb-3">
                                <i class="fas fa-lock mr-2"></i>Password
                            </label>
                            <div class="relative">
                                <input id="password" 
                                       class="input-field w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none font-medium text-lg pr-12" 
                                       type="password" 
                                       name="password" 
                                       placeholder="buat password yang kuat"
                                       required />
                                <button type="button" onclick="togglePassword('password', 'toggleIcon1')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800 transition-colors">
                                    <i id="toggleIcon1" class="fas fa-eye"></i>
                                </button>
                            </div>
                            @if($errors->has('password'))
                                <div class="mt-3 text-red-300 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-white mb-3">
                                <i class="fas fa-lock mr-2"></i>Konfirmasi Password
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" 
                                       class="input-field w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none font-medium text-lg pr-12" 
                                       type="password" 
                                       name="password_confirmation" 
                                       placeholder="konfirmasi password Anda"
                                       required />
                                <button type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800 transition-colors">
                                    <i id="toggleIcon2" class="fas fa-eye"></i>
                                </button>
                            </div>
                            @if($errors->has('password_confirmation'))
                                <div class="mt-3 text-red-300 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>

                        <!-- Terms & Privacy -->
                        <div class="flex items-start">
                            <input id="terms" type="checkbox" 
                                   class="mt-1 rounded border-white border-opacity-30 text-purple-600 shadow-sm focus:ring-purple-500 focus:ring-opacity-50 bg-white bg-opacity-20" 
                                   name="terms" required>
                            <label for="terms" class="ml-3 text-sm text-white text-opacity-90 cursor-pointer">
                                Saya setuju dengan <a href="#" class="text-white font-semibold hover:text-purple-200 transition-colors underline">Syarat & Ketentuan</a> 
                                dan <a href="#" class="text-white font-semibold hover:text-purple-200 transition-colors underline">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-semibold text-lg transform transition-all duration-300 hover:scale-105">
                            <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                        </button>

                        <!-- Login Link -->
                        <div class="text-center mt-8">
                            <p class="text-white text-opacity-90">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-white font-semibold hover:text-purple-200 transition-colors duration-300 underline decoration-2 underline-offset-4">
                                    Masuk sekarang
                                </a>
                            </p>
                        </div>

                        <!-- Social Login Divider -->
                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white border-opacity-30"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-6 bg-transparent text-white text-opacity-70 font-medium">atau daftar dengan</span>
                            </div>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" class="glass-effect py-3 px-4 rounded-xl text-white font-medium hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105">
                                <i class="fab fa-google mr-2"></i>Google
                            </button>
                            <button type="button" class="glass-effect py-3 px-4 rounded-xl text-white font-medium hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105">
                                <i class="fab fa-facebook-f mr-2"></i>Facebook
                            </button>
                        </div>
                    </form>
                </div>
            </div>
                        <label for="name" class="block text-sm font-medium text-white mb-2">Nama Lengkap</label>
                        <input id="name" 
                               class="w-full px-4 py-3 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-lg text-white placeholder-white placeholder-opacity-60 focus:outline-none input-focus transition-all duration-300" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Masukkan nama lengkap"
                               required autofocus autocomplete="name" />
                        @if($errors->has('name'))
                            <div class="mt-2 text-red-300 text-sm">
                                @foreach ($errors->get('name') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white mb-2">Email Address</label>
                        <input id="email" 
                               class="w-full px-4 py-3 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-lg text-white placeholder-white placeholder-opacity-60 focus:outline-none input-focus transition-all duration-300" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="nama@email.com"
                               required autocomplete="username" />
                        @if($errors->has('email'))
                            <div class="mt-2 text-red-300 text-sm">
                                @foreach ($errors->get('email') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
                        <input id="password" 
                               class="w-full px-4 py-3 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-lg text-white placeholder-white placeholder-opacity-60 focus:outline-none input-focus transition-all duration-300" 
                               type="password" 
                               name="password" 
                               placeholder="••••••••"
                               required autocomplete="new-password" />
                        @if($errors->has('password'))
                            <div class="mt-2 text-red-300 text-sm">
                                @foreach ($errors->get('password') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" 
                               class="w-full px-4 py-3 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-lg text-white placeholder-white placeholder-opacity-60 focus:outline-none input-focus transition-all duration-300" 
                               type="password" 
                               name="password_confirmation" 
                               placeholder="••••••••"
                               required autocomplete="new-password" />
                        @if($errors->has('password_confirmation'))
                            <div class="mt-2 text-red-300 text-sm">
                                @foreach ($errors->get('password_confirmation') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start">
                        <input id="terms" type="checkbox" class="w-4 h-4 mt-1 text-indigo-600 bg-white bg-opacity-10 border-white border-opacity-20 rounded focus:ring-indigo-500 focus:ring-2" required>
                        <label for="terms" class="ml-3 text-sm text-white text-opacity-80">
                            Saya setuju dengan 
                            <a href="#" class="text-white font-medium hover:text-opacity-80 transition-colors">Syarat & Ketentuan</a> 
                            dan 
                            <a href="#" class="text-white font-medium hover:text-opacity-80 transition-colors">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 border border-white border-opacity-30 hover:border-opacity-50">
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-8 text-center">
                    <p class="text-white text-opacity-80 text-sm">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-white font-semibold hover:text-opacity-80 transition-colors">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                <!-- Social Register (Optional) -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white border-opacity-20"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-transparent text-white text-opacity-60">Atau daftar dengan</span>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <button class="w-full bg-white bg-opacity-10 hover:bg-opacity-20 text-white py-2 px-4 rounded-lg transition-all duration-300 border border-white border-opacity-20 hover:border-opacity-40 text-sm">
                            Google
                        </button>
                        <button class="w-full bg-white bg-opacity-10 hover:bg-opacity-20 text-white py-2 px-4 rounded-lg transition-all duration-300 border border-white border-opacity-20 hover:border-opacity-40 text-sm">
                            Facebook
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Welcome Section -->
        <div class="hidden lg:flex lg:w-1/2 xl:w-2/5 items-center justify-center p-12">
            <div class="max-w-md text-white">
                <div class="mb-8">
                    <h1 class="text-4xl font-bold mb-2">MyTickets</h1>
                    <div class="w-16 h-1 bg-white rounded-full"></div>
                </div>
                <h2 class="text-3xl font-light mb-6">Mulai Petualangan Anda</h2>
                <p class="text-lg opacity-90 mb-8 leading-relaxed">
                    Bergabunglah dengan ribuan traveler yang sudah mempercayai platform kami. 
                    Dapatkan pengalaman booking yang mudah, cepat, dan terpercaya.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-sm opacity-90">Gratis pendaftaran</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-sm opacity-90">Verifikasi email OTP</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-sm opacity-90">Akses ke semua layanan</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-sm opacity-90">Promo ekslusif member</span>
                    </div>
            
            <!-- Right Side - Benefits & Features -->
            <div class="hidden lg:block space-y-8 order-1 lg:order-2">
                <div class="text-center lg:text-left">
                    <div class="flex items-center justify-center lg:justify-start mb-6">
                        <div class="floating-icon bg-white bg-opacity-20 rounded-full p-4 mr-4">
                            <i class="fas fa-globe text-3xl text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-5xl font-bold text-white text-shadow">MyTickets</h1>
                            <p class="text-white text-opacity-80 text-lg">Your Journey Starts Here</p>
                        </div>
                    </div>
                    
                    <h2 class="text-4xl font-light text-white mb-6 text-shadow">
                        Mulai Petualangan Anda
                    </h2>
                    <p class="text-xl text-white text-opacity-90 mb-12 leading-relaxed">
                        Bergabunglah dengan jutaan traveler yang telah mempercayai MyTickets 
                        untuk perjalanan terbaik mereka.
                    </p>
                </div>

                <!-- Benefits List -->
                <div class="space-y-6">
                    <div class="glass-effect rounded-2xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-start">
                            <div class="bg-green-500 rounded-full p-3 mr-4 mt-1">
                                <i class="fas fa-gift text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg mb-2">Bonus Member Baru</h3>
                                <p class="text-white text-opacity-80">Dapatkan voucher diskon hingga Rp 500.000 untuk pemesanan pertama Anda</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="glass-effect rounded-2xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-start">
                            <div class="bg-blue-500 rounded-full p-3 mr-4 mt-1">
                                <i class="fas fa-star text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg mb-2">Member Priority</h3>
                                <p class="text-white text-opacity-80">Akses eksklusif ke penawaran khusus dan customer service prioritas</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="glass-effect rounded-2xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-start">
                            <div class="bg-purple-500 rounded-full p-3 mr-4 mt-1">
                                <i class="fas fa-coins text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg mb-2">Points Reward</h3>
                                <p class="text-white text-opacity-80">Kumpulkan poin setiap transaksi dan tukar dengan diskon menarik</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="glass-effect rounded-2xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-start">
                            <div class="bg-orange-500 rounded-full p-3 mr-4 mt-1">
                                <i class="fas fa-shield-alt text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg mb-2">Jaminan Keamanan</h3>
                                <p class="text-white text-opacity-80">Data dan transaksi Anda 100% aman dengan enkripsi tingkat bank</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-3 gap-6 mt-12">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">2M+</div>
                        <div class="text-white text-opacity-80 text-sm">Happy Members</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">100K+</div>
                        <div class="text-white text-opacity-80 text-sm">Destinations</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">4.9★</div>
                        <div class="text-white text-opacity-80 text-sm">App Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add floating animation to elements on scroll
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
