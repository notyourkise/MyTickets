<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #667eea 100%);
            min-height: 100vh;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        }
        .travel-bg {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23667eea;stop-opacity:0.9"/><stop offset="100%" style="stop-color:%231e3c72;stop-opacity:0.9"/></linearGradient></defs><rect width="1200" height="600" fill="url(%23bg)"/><circle cx="100" cy="100" r="2" fill="white" opacity="0.3"/><circle cx="300" cy="200" r="1.5" fill="white" opacity="0.4"/><circle cx="500" cy="150" r="1" fill="white" opacity="0.5"/><circle cx="700" cy="300" r="2" fill="white" opacity="0.3"/><circle cx="900" cy="250" r="1.5" fill="white" opacity="0.4"/><circle cx="1100" cy="400" r="1" fill="white" opacity="0.5"/></svg>');
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
            border-color: #667eea;
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
            transform: translateY(-2px);
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
    </style>
</head>
<body class="travel-bg">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-8 items-center">
            
            <!-- Left Side - Branding & Features -->
            <div class="hidden lg:block space-y-8">
                <div class="text-center lg:text-left">
                    <div class="flex items-center justify-center lg:justify-start mb-6">
                        <div class="floating-icon bg-white bg-opacity-20 rounded-full p-4 mr-4">
                            <i class="fas fa-plane text-3xl text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-5xl font-bold text-white text-shadow">MyTickets</h1>
                            <p class="text-white text-opacity-80 text-lg">Premium Travel Experience</p>
                        </div>
                    </div>
                    
                    <h2 class="text-4xl font-light text-white mb-6 text-shadow">
                        Selamat Datang Kembali
                    </h2>
                    <p class="text-xl text-white text-opacity-90 mb-12 leading-relaxed">
                        Platform eksklusif untuk semua kebutuhan perjalanan Anda. 
                        Nikmati pengalaman booking yang tak terlupakan.
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="glass-effect rounded-2xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-500 rounded-full p-3 mr-4">
                                <i class="fas fa-plane text-white text-lg"></i>
                            </div>
                            <h3 class="text-white font-semibold">Pesawat</h3>
                        </div>
                        <p class="text-white text-opacity-80 text-sm">Tiket pesawat domestik & internasional</p>
                    </div>
                    
                    <div class="glass-effect rounded-2xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-500 rounded-full p-3 mr-4">
                                <i class="fas fa-train text-white text-lg"></i>
                            </div>
                            <h3 class="text-white font-semibold">Kereta</h3>
                        </div>
                        <p class="text-white text-opacity-80 text-sm">Perjalanan kereta yang nyaman</p>
                    </div>
                    
                    <div class="glass-effect rounded-2xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="bg-orange-500 rounded-full p-3 mr-4">
                                <i class="fas fa-bus text-white text-lg"></i>
                            </div>
                            <h3 class="text-white font-semibold">Bus</h3>
                        </div>
                        <p class="text-white text-opacity-80 text-sm">Bus premium antar kota</p>
                    </div>
                    
                    <div class="glass-effect rounded-2xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-500 rounded-full p-3 mr-4">
                                <i class="fas fa-hotel text-white text-lg"></i>
                            </div>
                            <h3 class="text-white font-semibold">Hotel</h3>
                        </div>
                        <p class="text-white text-opacity-80 text-sm">Akomodasi terbaik di seluruh dunia</p>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="flex items-center justify-center lg:justify-start space-x-8 mt-8">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">1M+</div>
                        <div class="text-white text-opacity-80 text-sm">Pengguna</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">50K+</div>
                        <div class="text-white text-opacity-80 text-sm">Destinasi</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">24/7</div>
                        <div class="text-white text-opacity-80 text-sm">Support</div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="flex justify-center lg:justify-end">
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
                        <h2 class="text-3xl font-bold text-white mb-3 text-shadow">Masuk ke Akun</h2>
                        <p class="text-white text-opacity-90 text-lg">Selamat datang kembali di MyTickets</p>
                    </div>
                    
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-6 p-4 bg-green-500 bg-opacity-20 border border-green-400 border-opacity-30 text-green-100 rounded-xl text-sm backdrop-filter backdrop-blur-sm">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
                        </div>
                    @endif

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

                    <form method="POST" action="{{ route('login') }}" class="space-y-7">
                        @csrf

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
                                   required autofocus autocomplete="username" />
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
                                       placeholder="masukkan password Anda"
                                       required autocomplete="current-password" />
                                <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800 transition-colors">
                                    <i id="toggleIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                            @if($errors->has('password'))
                                <div class="mt-3 text-red-300 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center text-white cursor-pointer">
                                <input id="remember_me" type="checkbox" 
                                       class="rounded border-white border-opacity-30 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-opacity-50 bg-white bg-opacity-20" 
                                       name="remember">
                                <span class="ml-3 text-sm font-medium">Ingat saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-white hover:text-blue-200 transition-colors duration-300 font-medium" 
                                   href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-semibold text-lg transform transition-all duration-300 hover:scale-105">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Akun
                        </button>

                        <!-- Register Link -->
                        <div class="text-center mt-8">
                            <p class="text-white text-opacity-90">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-white font-semibold hover:text-blue-200 transition-colors duration-300 underline decoration-2 underline-offset-4">
                                    Daftar sekarang
                                </a>
                            </p>
                        </div>

                        <!-- Social Login Divider -->
                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white border-opacity-30"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-6 bg-transparent text-white text-opacity-70 font-medium">atau masuk dengan</span>
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
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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
