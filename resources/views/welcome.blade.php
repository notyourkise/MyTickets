<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyTickets') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --brand-blue: #0d74d6;
            --brand-blue-dark: #0b62b5;
            --brand-orange: #ff6600;
            --brand-gray: #f0f2f5;
            --text-dark: #1f2937;
            --primary: #006ce4;
            --sky-blue: #38bdf8;
        }
    .text-primary { color: var(--primary); }
    .bg-primary { background: var(--primary); }

        /* Modal Animation */
        .modal-content {
            transform: translateY(0);
            opacity: 1;
            transition: all 0.3s ease-out;
        }
        
        .modal-content.hidden {
            transform: translateY(-20px);
            opacity: 0;
        }
        
        /* Hide scrollbar for modal */
        .modal-scroll-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .modal-scroll-hide::-webkit-scrollbar {
            display: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        .bg-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/bromo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Traveloka Inspired Booking Card */
        .search-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            box-shadow: 0 12px 30px -8px rgba(0, 0, 0, .15);
            padding: 1.75rem 2rem 2rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .trip-type-switch {
            display: flex;
            gap: .5rem;
            background: #f1f5f9;
            padding: .4rem;
            border-radius: 9999px;
            width: max-content;
        }
        .trip-type-switch button {
            padding: .45rem 1rem;
            font-size: .75rem;
            font-weight: 500;
            border-radius: 9999px;
            background: transparent;
            transition: .25s;
            border: none;
            cursor: pointer;
        }
        .trip-type-switch button.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 10px -2px rgba(0, 0, 0, .25);
        }
        .input-box {
            position: relative;
        }
        .input-box input,
        .input-box .input-lookalike {
            width: 100%;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 1.1rem 1rem 0.7rem 3.2rem;
            font-size: .9rem;
            color: #111827;
            outline: none;
            transition: .25s;
            line-height: 1.5;
        }
        .input-box .input-lookalike {
            text-align: left;
            cursor: pointer;
        }
        .input-box input:focus,
        .input-box .input-lookalike:focus,
        .input-box .input-lookalike.active {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 108, 228, .2);
        }
        .input-box label {
            position: absolute;
            top: 50%;
            left: 3.2rem;
            transform: translateY(-50%);
            font-size: .9rem;
            color: #6b7280;
            pointer-events: none;
            transition: all 0.2s ease-out;
        }
        .input-box input:focus ~ label,
        .input-box input:not(:placeholder-shown) ~ label,
        .input-box .input-lookalike.active ~ label {
            top: .6rem;
            left: 3.2rem;
            font-size: .65rem;
            font-weight: 600;
            color: #475569;
            transform: translateY(0);
        }
        .input-box .icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1.1rem;
            transition: .25s;
        }
        .dropdown-panel {
            position: absolute;
            z-index: 40;
            background: #fff;
            border: 1px solid #d5d7db;
            border-radius: 14px;
            padding: 1rem;
            margin-top: .5rem;
            box-shadow: 0 18px 40px -12px rgba(0, 0, 0, .15);
            width: 280px;
        }
        .primary-action-button {
            background: var(--brand-orange);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            padding: 1.05rem 2.2rem;
            border-radius: 14px;
            font-weight: 600;
            font-size: .95rem;
            color: #fff;
            width: 100%;
            transition: .25s;
            box-shadow: 0 10px 20px -8px rgba(255, 102, 0, .4);
            border: none;
            cursor: pointer;
        }
        .primary-action-button:hover {
            background: #ff751c;
            box-shadow: 0 12px 26px -6px rgba(255, 102, 0, .55);
            transform: translateY(-2px);
        }
        .quick-links {
            display: flex;
            gap: 1.25rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }
        .quick-links a {
            font-size: .8rem;
            background: rgba(255, 255, 255, .15);
            padding: .45rem .85rem;
            border-radius: 8px;
            color: #fff;
            font-weight: 500;
            backdrop-filter: blur(4px);
            transition: .25s;
        }
        .quick-links a:hover {
            background: #ffffff;
            color: #0d74d6;
        }
        .social-proof {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-top: 1.25rem;
            flex-wrap: wrap;
        }
        .social-proof img {
            height: 28px;
            filter: grayscale(30%);
            opacity: .9;
            transition: .25s;
        }
        .social-proof img:hover {
            filter: none;
            opacity: 1;
        }

    /* Header Two-Tier */
    .site-header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 70;
        font-size: 14px;
        background: transparent;
        box-shadow: none;
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
        padding: 0;
        margin: 0;
    }
    .top-bar {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 1.5rem;
        padding: .75rem 2rem;
        background: transparent;
        box-shadow: none;
        position: relative;
        z-index: 10;
    }
    .top-bar a,
    .top-bar button,
    .site-logo,
    .product-tab,
    .nav-links a {
        color: #fff;
        font-weight: 700;
        background: transparent;
        transition: color 0.25s ease;
        border: none;
        border-radius: 0;
        padding: .35rem .75rem;
        cursor: pointer;
    }
    
    #loginBtn, #registerBtn {
        cursor: pointer !important;
        position: relative;
        z-index: 20;
    }
    
    #loginBtn:hover, #registerBtn:hover {
        color: #E86C00 !important;
    }
        cursor: pointer;
    }
    .top-bar .register-btn {
        background: var(--primary);
        border-radius: 6px;
        box-shadow: 0 4px 14px -4px rgba(0, 108, 228, .55);
    }
    .top-bar .register-btn:hover {
        filter: brightness(1.08);
    }
    .top-bar a:hover, 
    .top-bar button:not(.register-btn):hover, 
    .product-tab:hover, 
    .nav-links a:hover {
        color: var(--sky-blue);
    }
    .site-header .inner {
        max-width: 1280px;
        background: transparent;
        border-radius: 0;
        box-shadow: none;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 2rem;
        padding: 1.25rem 2rem;
    }
    .site-logo {
        font-size: 1.55rem;
        display: flex;
        align-items: center;
        gap: .55rem;
        letter-spacing: .5px;
    }
    .site-logo:hover {
        color: #fff !important;
    }
    .ticket-icon {
        width: 38px;
        height: 38px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .35);
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: none;
        box-shadow: none;
    }
    .ticket-icon svg {
        width: 20px;
        height: 20px;
        fill: #fff;
    }
    .product-tabs {
        display: flex;
        gap: .65rem;
        align-items: center;
    }
    .product-tab {
        display: flex;
        align-items: center;
        gap: .5rem;
        padding: .55rem .95rem;
        position: relative;
    }
    .product-tab i {
        font-size: .95rem;
    }
    .product-tab.active {
        box-shadow: none !important;
        position: relative;
    }
    .product-tab.active::after {
        content: '';
        position: absolute;
        bottom: -16px;
        left: 0;
        right: 0;
        height: 3px;
        background-color: var(--sky-blue);
        border-radius: 2px;
    }
    .nav-links {
        display: flex;
        gap: .75rem;
        margin-left: auto;
    }
    @media (max-width:900px) {
        .nav-links {
            display: none;
        }
        .product-tabs {
            flex-wrap: wrap;
        }
    }
    
    /* Stroke separator styles */
    .header-stroke {
        height: 1px;
        background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.1));
        width: 100%;
        margin: 0;
    }
    
    /* Search table styling and spacing */
    .search-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        box-shadow: 0 12px 30px -8px rgba(0, 0, 0, .15);
        padding: 1.75rem 2rem 2rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        margin-top: 1.5rem;
    }
    
    /* Hero section and search table positioning */
    .hero-content {
        padding-top: 180px;
        width: 100%;
        max-width: 100%;
        position: relative;
        z-index: 50;
    }
    
    .search-container {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    
    /* Ensure proper z-indexing */
    .bg-hero {
        position: relative;
        z-index: 1;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-content {
            padding-top: 140px;
        }
        
        .search-card {
            padding: 1.25rem;
        }
    }
    
    /* --- CSS UNTUK AUTH MODAL --- */
    .modal-input { 
        width: 100%;
        margin-top: 0.25rem;
        border-radius: 0.5rem;
        border: 1px solid #D1D5DB;
        padding: 0.625rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        transition: all 0.2s ease;
    }
    .modal-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 108, 228, 0.2);
        outline: none;
    }
    
    .modal-btn-primary {
        width: 100%;
        background-color: #FF6600;
        color: white;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }
    .modal-btn-primary:hover {
        background-color: #E65C00;
    }
    .modal-btn-primary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .modal-btn-social {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        background-color: white;
        border: 1px solid #D1D5DB;
        color: #4B5563;
        font-weight: 500;
        border-radius: 0.5rem;
        padding: 0.625rem 1rem;
        transition: all 0.2s ease;
    }
    .modal-btn-social:hover {
        background-color: #F9FAFB;
    }
    
    .separator {
        text-align: center;
        font-size: 0.75rem;
        color: #9CA3AF;
        position: relative;
        display: flex;
        align-items: center;
    }
    .separator::before, .separator::after { 
        content: ''; 
        flex-grow: 1; 
        background-color: #e5e7eb; 
        height: 1px; 
    }
    .separator::before { margin-right: 1rem; }
    .separator::after { margin-left: 1rem; }
    
    .otp-input { 
        width: 3rem;
        height: 3.5rem;
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1F2937;
        border: 2px solid #D1D5DB;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }
    .otp-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 108, 228, 0.2);
        outline: none;
    }
    
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        animation: fadeIn 0.3s ease-out;
    }
    
    .modal.active {
        display: flex !important;
    }
    
    .modal-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(3px);
    }
    
    .modal-content {
        position: relative;
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        width: 500px;
        max-width: 100%;
    overflow: hidden;
    max-height: calc(100vh - 140px); /* give breathing room top & bottom */
    display: flex;
    flex-direction: column;
    }
    
    .modal-step {
        display: none;
        animation: fadeIn 0.3s ease-out;
    }
    
    .modal-step.active {
        display: block;
    }
    
    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    /* Custom styling for the modal elements to match Traveloka design */
    #authModal .modal-content {
        border-radius: 8px;
        max-width: 500px;
    max-height: calc(100vh - 140px);
    overflow-y: auto;
    }
    
    #authModal #closeModal {
        font-size: 1.2rem;
        z-index: 10;
    }
    
    #authModal .modal-btn-primary {
        background-color: #E86C00;
        border: none;
        border-radius: 8px;
        height: 48px;
        font-weight: 600;
        box-shadow: none;
        transition: background-color 0.2s;
    }
    
    #authModal .modal-btn-primary:hover {
        background-color: #D96200;
    }
    
    #authModal .otp-input {
        border: 1px solid #D1D5DB;
        border-radius: 8px;
        font-size: 1.25rem;
        font-weight: 600;
    }
    
    #authModal .otp-input:focus {
        border-color: #E86C00;
        box-shadow: 0 0 0 2px rgba(232, 108, 0, 0.2);
    }
    
    /* Auth mode selection buttons */
    .auth-mode-btn {
        background: #f9f9f9;
        color: #666;
        font-weight: 500;
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
    }
    
    .auth-mode-btn.active {
        background: white;
        color: #E86C00;
        border-bottom: 3px solid #E86C00;
    }
</style>
</head>
<body class="antialiased">
    <script>
        // Fallback global function to immediately open auth modal (runs before DOMContentLoaded)
        function showAuthModal(type){
            var modal=document.getElementById('authModal');
            if(!modal) return; 
            var initial=document.getElementById('initialStep');
            var verification=document.getElementById('verificationStep');
            var createPw=document.getElementById('createPasswordStep');
            var loginModeBtn=document.getElementById('loginModeBtn');
            var registerModeBtn=document.getElementById('registerModeBtn');
            var loginForm=document.getElementById('loginForm');
            var registerForm=document.getElementById('registerForm');
            modal.classList.add('active');
            if(initial){initial.classList.add('active');}
            if(verification){verification.classList.remove('active');}
            if(createPw){createPw.classList.remove('active');}
            if(type==='login'){
                if(loginModeBtn) loginModeBtn.classList.add('active');
                if(registerModeBtn) registerModeBtn.classList.remove('active');
                if(loginForm) loginForm.classList.remove('hidden');
                if(registerForm) registerForm.classList.add('hidden');
            } else {
                if(loginModeBtn) loginModeBtn.classList.remove('active');
                if(registerModeBtn) registerModeBtn.classList.add('active');
                if(loginForm) loginForm.classList.add('hidden');
                if(registerForm) registerForm.classList.remove('hidden');
            }
        }
    </script>
    <script>
        // Debug script to check elements on page load
        window.addEventListener('load', function() {
            console.log('Page fully loaded');
            console.log('Login button exists:', document.getElementById('loginBtn') !== null);
            console.log('Register button exists:', document.getElementById('registerBtn') !== null);
            console.log('Auth modal exists:', document.getElementById('authModal') !== null);
        });
    </script>
        <!-- Two-Tier Header with Stroke Separators -->
    <header class="site-header">
        <!-- Header Level 1 -->
        <div class="top-bar">
            <a href="#support">Support</a>
            <a href="#partnership">Partnership</a>
            <button id="loginBtn" type="button" onclick="showAuthModal('login')">Log In</button>
            <button class="register-btn" id="registerBtn" type="button" onclick="showAuthModal('register')">Register</button>
        </div>
        
        <!-- Stroke Separator 1 -->
        <div class="header-stroke"></div>
        
        <!-- Header Level 2 -->
        <div class="inner">
            <a href="/" class="site-logo" aria-label="Home">
                <span class="ticket-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4.5 5h10.8c.28 0 .54.12.72.33l3.5 4.17c.26.31.26.76 0 1.07l-3.5 4.17a.96.96 0 0 1-.72.33H4.5A2.5 2.5 0 0 1 2 12.5c0-.28.22-.5.5-.5a2 2 0 0 0 0-4c-.28 0-.5-.22-.5-.5A2.5 2.5 0 0 1 4.5 5Zm5 2a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm3 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm-6 4.75c0 .41.34.75.75.75h4.5a.75.75 0 0 0 0-1.5h-4.5a.75.75 0 0 0-.75.75Z"/></svg>
                </span>
                <span>MyTickets</span>
            </a>
            <div class="product-tabs" aria-label="Product Tabs">
                <button class="product-tab active" id="flightsTab"><i class="fas fa-plane"></i><span>Flights</span></button>
                <button class="product-tab" id="hotelsTab"><i class="fas fa-hotel"></i><span>Hotels</span></button>
                <button class="product-tab" id="trainsTab"><i class="fas fa-train"></i><span>Trains</span></button>
                <button class="product-tab" id="busTab"><i class="fas fa-bus"></i><span>Bus & Travel</span></button>
            </div>
            <div class="nav-links">
                <a href="#discover">Discover</a>
                <a href="#promos">Promos</a>
                <a href="#help">Help</a>
            </div>
        </div>
        
        <!-- Stroke Separator 2 -->
        <div class="header-stroke"></div>
    </header>
    
    <!-- Auth Modal -->
    <div id="authModal" class="modal">
        <div id="modalBackdrop" class="modal-backdrop"></div>
        <div class="modal-content">
            <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
            
            <!-- Initial Step - Email Form -->
            <div id="initialStep" class="modal-step px-8 pt-8 pb-6">
                <h2 id="authFormTitle" class="text-2xl font-bold text-center mb-5">Log In / Register</h2>
                
                <!-- Auth Mode Selection -->
                <div class="flex border border-gray-300 rounded-lg mb-5 overflow-hidden">
                    <button 
                        type="button" 
                        id="loginModeBtn" 
                        class="auth-mode-btn active flex-1 py-2 px-4 text-center font-medium"
                    >
                        Log In
                    </button>
                    <button 
                        type="button" 
                        id="registerModeBtn" 
                        class="auth-mode-btn flex-1 py-2 px-4 text-center font-medium"
                    >
                        Register
                    </button>
                </div>
                
                <!-- Login Form -->
                <form id="loginForm" class="space-y-5">
                    <div>
                        <label for="loginEmail" class="block text-sm font-medium text-gray-700 mb-1">Email/Mobile Number</label>
                        <input 
                            type="email" 
                            id="loginEmail" 
                            name="loginEmail" 
                            class="modal-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                            placeholder="Masukkan email Anda"
                            required
                        />
                    </div>
                    
                    <div>
                        <label for="loginPassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input 
                            type="password" 
                            id="loginPassword" 
                            name="loginPassword" 
                            class="modal-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                            placeholder="Masukkan password"
                            required
                        />
                    </div>
                    
                    <div class="text-right">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Lupa password?</a>
                    </div>
                    
                    <div>
                        <button 
                            type="button" 
                            id="loginSubmitBtn"
                            class="modal-btn-primary w-full"
                            style="background-color: #E86C00; border-radius: 8px; padding: 12px; font-weight: 600; box-shadow: none;"
                        >
                            Log In
                        </button>
                    </div>
                </form>
                
                <!-- Register Form -->
                <form id="registerForm" class="space-y-5 hidden">
                    <div>
                        <label for="registerEmail" class="block text-sm font-medium text-gray-700 mb-1">Email/Mobile Number</label>
                        <input 
                            type="email" 
                            id="registerEmail" 
                            name="registerEmail" 
                            class="modal-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                            placeholder="Masukkan email Anda"
                            required
                        />
                    </div>
                    
                    <div>
                        <button 
                            type="button" 
                            id="registerSubmitBtn"
                            class="modal-btn-primary w-full"
                            style="background-color: #E86C00; border-radius: 8px; padding: 12px; font-weight: 600; box-shadow: none;"
                        >
                            Continue
                        </button>
                    </div>
                </form>
                
                <div class="relative my-5">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">or sign in with</span>
                    </div>
                </div>
                
                <div class="w-full">
                    <button 
                        type="button" 
                        class="flex items-center justify-center w-full py-3 px-4 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors"
                    >
                        <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png" alt="Google" class="h-5 w-5 mr-3">
                        Google
                    </button>
                </div>
                
                <div class="text-xs text-center text-gray-600 mt-6">
                    By continuing, you agree to the <a href="#" class="text-blue-600">Terms & Conditions</a> and <a href="#" class="text-blue-600">Privacy Notice</a>.
                </div>
            </div>
            
            <!-- Verification Step - OTP Input -->
            <div id="verificationStep" class="modal-step p-8">
                <h2 class="text-2xl font-bold text-center mb-2">Verification</h2>
                <p class="text-gray-500 text-center mb-6">OTP code has been sent to <span id="verificationEmail" class="font-medium"></span></p>
                
                <form id="otpForm" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Enter OTP Code</label>
                        <div class="flex justify-between gap-2">
                            <input type="text" maxlength="1" class="otp-input w-full h-14 text-center text-xl font-bold border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                            <input type="text" maxlength="1" class="otp-input w-full h-14 text-center text-xl font-bold border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                            <input type="text" maxlength="1" class="otp-input w-full h-14 text-center text-xl font-bold border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                            <input type="text" maxlength="1" class="otp-input w-full h-14 text-center text-xl font-bold border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                            <input type="text" maxlength="1" class="otp-input w-full h-14 text-center text-xl font-bold border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                            <input type="text" maxlength="1" class="otp-input w-full h-14 text-center text-xl font-bold border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                        </div>
                    </div>
                    
                    <div>
                        <button 
                            type="button" 
                            id="verifyOtpBtn"
                            class="modal-btn-primary w-full"
                            style="background-color: #E86C00; border-radius: 8px; padding: 12px; font-weight: 600; box-shadow: none;"
                        >
                            Verify
                        </button>
                    </div>
                    
                    <div class="text-center">
                        <button type="button" id="resendOtpBtn" class="text-blue-600 hover:text-blue-800 font-medium">
                            Resend OTP Code
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Create Password Step (After Register Verification) -->
            <div id="createPasswordStep" class="modal-step p-8">
                <h2 class="text-2xl font-bold text-center mb-2">Create Password</h2>
                <p class="text-gray-500 text-center mb-6">Create a secure password for your account</p>
                
                <form id="passwordForm" class="space-y-6">
                    <div>
                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="newPassword" 
                                name="newPassword" 
                                class="modal-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                                placeholder="Enter your password"
                                required
                            />
                            <button 
                                type="button"
                                id="togglePassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 characters with letters and numbers</p>
                    </div>
                    
                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="confirmPassword" 
                                name="confirmPassword" 
                                class="modal-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                                placeholder="Confirm your password"
                                required
                            />
                            <button 
                                type="button"
                                id="toggleConfirmPassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <button 
                            type="button" 
                            id="createPasswordBtn"
                            class="modal-btn-primary w-full"
                            style="background-color: #E86C00; border-radius: 8px; padding: 12px; font-weight: 600; box-shadow: none;"
                        >
                            Complete Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Hero with Integrated Flight Search -->
    <section class="bg-hero min-h-[640px] flex items-center justify-center relative">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/25 to-black/60"></div>
        <div class="hero-content">
            <div class="search-container" x-data="flightSearch()" x-init="initPickers()">
                <div class="search-card">
                    <!-- Trip Type High Level -->
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-2 text-sm font-medium text-slate-600">
                            <div class="trip-type-switch">
                                <button :class="{'active':mode==='standard'}" @click="mode='standard'">One-way / Round-trip</button>
                                <button :class="{'active':mode==='multicity'}" @click="mode='multicity'">Multi-city</button>
                            </div>
                            <template x-if="mode==='standard'">
                                <div class="trip-type-switch ml-2">
                                    <button :class="{'active':tripType==='oneway'}" @click="tripType='oneway'; returnDate=''">One-way</button>
                                    <button :class="{'active':tripType==='roundtrip'}" @click="tripType='roundtrip'; $nextTick(()=>initPickers())">Round-trip</button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Standard Form -->
                    <div x-show="mode==='standard'" class="mt-6 space-y-4">
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4">
        
        <div class="input-box lg:col-span-3">
            <i class="icon fas fa-plane-departure"></i>
            <input type="text" x-model="origin" @input="filter('origin',$event.target.value)" @focus="focusField='origin'; showSuggest=true" @click.away="hideSuggest('origin')" placeholder=" " class="peer">
            <label>From</label>
            
        </div>
        
        <div class="input-box lg:col-span-3">
            <i class="icon fas fa-plane-arrival"></i>
            <input type="text" x-model="destination" @input="filter('destination',$event.target.value)" @focus="focusField='destination'; showSuggest=true" @click.away="hideSuggest('destination')" placeholder=" " class="peer">
            <label>To</label>
            
        </div>
        
        <div class="input-box lg:col-span-3">
            <i class="icon fas fa-calendar-day"></i>
            <input type="text" x-ref="departpicker" x-model="departureDate" readonly placeholder=" " class="peer">
            <label>Departure Date</label>
        </div>
        
        <div class="input-box lg:col-span-3" :class="tripType === 'oneway' ? 'opacity-50' : ''">
            <i class="icon fas fa-calendar-day"></i>
            <input type="text" x-ref="returnpicker" x-model="returnDate" readonly placeholder=" " class="peer" :disabled="tripType === 'oneway'">
            <label>Return Date</label>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
        
        <div class="input-box lg:col-span-9 relative">
            <i class="icon fas fa-users"></i>
            <button type="button" @click="showPassengers=!showPassengers" class="input-lookalike peer" :class="{'active': showPassengers}">
                <span x-text="passengerSummary()"></span> - <span x-text="travelClass"></span>
            </button>
            <label>Passengers & Class</label>
            
            <div x-show="showPassengers" @click.away="showPassengers=false" class="dropdown-panel">
                <template x-for="type in ['adult','child','infant']" :key="type">
                    <div class="flex items-center justify-between py-2" :class="{'border-b': type!=='infant'}">
                        <div class="text-sm font-medium capitalize" x-text="type"></div>
                        <div class="flex items-center gap-3">
                            <button type="button" @click="adjust(type,'-')" class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center"><i class="fas fa-minus text-xs"></i></button>
                            <span class="w-5 text-center text-sm" x-text="passengers[type]"></span>
                            <button type="button" @click="adjust(type,'+')" class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center"><i class="fas fa-plus text-xs"></i></button>
                        </div>
                    </div>
                </template>
                <button type="button" class="mt-3 w-full py-2 bg-primary text-white rounded-md text-sm font-semibold hover:brightness-110" @click="showPassengers=false">Done</button>
            </div>
        </div>
        
        <div class="lg:col-span-3">
            <button class="primary-action-button h-full" @click="submitStandard()">
                <i class="fas fa-search"></i><span>Search Flights</span>
            </button>
        </div>
    </div>
</div>
                    </div>

                    <!-- Multi-city -->
                    <div x-show="mode==='multicity'" class="mt-6 space-y-4">
                        <template x-for="(seg,idx) in segments" :key="idx">
                            <div class="grid gap-4 md:grid-cols-4">
                                <div class="relative">
                                    <label class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">From</label>
                                    <input type="text" class="mt-1 w-full rounded-lg py-3 px-3 bg-white border" x-model="seg.origin" placeholder="Origin">
                                </div>
                                <div class="relative">
                                    <label class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">To</label>
                                    <input type="text" class="mt-1 w-full rounded-lg py-3 px-3 bg-white border" x-model="seg.destination" placeholder="Destination">
                                </div>
                                <div class="relative">
                                    <label class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Date</label>
                                    <input type="date" class="mt-1 w-full rounded-lg py-3 px-3 bg-white border" x-model="seg.date">
                                </div>
                                <div class="flex items-end">
                                    <button type="button" class="w-full py-3 rounded-lg border text-sm font-medium hover:bg-slate-50" @click="removeSegment(idx)" x-show="segments.length>1">Remove</button>
                                </div>
                            </div>
                        </template>
                        <div class="flex gap-3">
                            <button type="button" class="px-4 py-2 rounded-lg border text-sm font-semibold hover:bg-slate-50" @click="addSegment()" x-show="segments.length<5">Add Flight</button>
                            <div class="ml-auto">
                                <button class="primary-action-button px-6" @click="submitMulticity()"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="quick-links mt-6">
                        <a href="#ideas">Discover Flight Ideas</a>
                        <a href="#price-alert">Price Alert</a>
                    </div>
                    <!-- Social Proof -->
                    <div class="social-proof">
                        <span class="text-xs uppercase tracking-wide text-white/80 font-semibold">Trusted by</span>
                        <img src="{{ asset('image/garuda_indonesia.png') }}" alt="Garuda" loading="lazy">
                        <img src="{{ asset('image/airasia.png') }}" alt="AirAsia" loading="lazy">
                        <img src="{{ asset('image/citilink.png') }}" alt="Citilink" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function flightSearch(){
            return {
                mode:'standard', tripType:'oneway', origin:'', destination:'', departureDate:'', returnDate:'', travelClass:'Economy',
                passengers:{adult:1,child:0,infant:0}, showPassengers:false, showClass:false, focusField:null, showSuggest:false,
                classes:['Economy','Premium Economy','Business','First Class'],
                list:['Jakarta (CGK)','Surabaya (SUB)','Denpasar (DPS)','Yogyakarta (YIA)','Medan (KNO)','Makassar (UPG)','Balikpapan (BPN)','Bandung (BDO)','Semarang (SRG)','Lombok (LOP)'],
                suggestions:{origin:[],destination:[]},
                segments:[{origin:'',destination:'',date:''}],
                filter(field,q){ if(!q){ this.suggestions[field]=[]; return;} const s=q.toLowerCase(); this.suggestions[field]=this.list.filter(c=>c.toLowerCase().includes(s)).slice(0,8); },
                hideSuggest(field){ setTimeout(()=>{ this.showSuggest=false; this.suggestions[field]=[]; },150); },
                passengerSummary(){ const p=this.passengers; return `${p.adult} Adult${p.child?`, ${p.child} Child`:''}${p.infant?`, ${p.infant} Infant`:''}`; },
                adjust(type,op){ const lim={adult:[1,9],child:[0,8],infant:[0,4]}; if(op==='+' && this.passengers[type]<lim[type][1]) this.passengers[type]++; if(op==='-' && this.passengers[type]>lim[type][0]) this.passengers[type]--; },
                addSegment(){ this.segments.push({origin:'',destination:'',date:''}); },
                removeSegment(i){ this.segments.splice(i,1); },
                initPickers(){ const base={ dateFormat:'Y-m-d', minDate:'today'}; flatpickr(this.$refs.departpicker,{...base,onChange:(d)=>{this.departureDate=d[0].toISOString().split('T')[0];}}); if(this.tripType==='roundtrip'){ flatpickr(this.$refs.returnpicker,{...base,onChange:(d)=>{this.returnDate=d[0].toISOString().split('T')[0];}});} },
                submitStandard(){ if(!this.origin||!this.destination||!this.departureDate){ alert('Lengkapi data'); return;} const params=new URLSearchParams({type:'flights',from:this.origin,to:this.destination,date:this.departureDate,trip:this.tripType,class:this.travelClass}); if(this.returnDate) params.append('return',this.returnDate); window.location.href='/search?'+params.toString(); },
                submitMulticity(){ if(this.segments.some(s=>!s.origin||!s.destination||!s.date)){ alert('Lengkapi semua segmen'); return;} const params=new URLSearchParams({type:'flights',multi:JSON.stringify(this.segments),class:this.travelClass, pax:this.passengerSummary()}); window.location.href='/search?'+params.toString(); }
            }
        }
    </script>

    <main class="main-content bg-white relative z-10">
        <!-- Partner Logos Section -->
        @php
            $partnerLogos = app(App\Http\Controllers\PartnerController::class)->getPartnerLogos();
        @endphp
        @include('components.partners-scroller', ['partnerLogos' => $partnerLogos])

    <!-- Old floating booking section removed (replaced by hero integrated form) -->

        <!-- Promo Section -->
        <section class="py-16 bg-white relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-sky-50 to-white opacity-50"></div>
            
            <!-- Section Header -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-sky-600 font-semibold tracking-wider uppercase text-sm">Promo Spesial</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">
                        Kupon Diskon untuk Anda
                    </h2>
                </div>

                <!-- Ticket/Coupon Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Ticket 1 -->
                    <div class="group">
                        <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <!-- Ticket Border Pattern -->
                            <div class="absolute left-0 top-0 h-full w-1 bg-sky-500"></div>
                            <div class="absolute right-0 top-0 h-full w-[3px] bg-gradient-to-b from-transparent via-gray-200 to-transparent"></div>
                            
                            <!-- Ticket Content -->
                            <div class="p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-plane text-sky-500 text-2xl"></i>
                                            <div>
                                                <span class="inline-block px-2 py-0.5 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">
                                                    First Transaction
                                                </span>
                                                <h3 class="text-lg font-bold text-gray-900 mt-1">Diskon Tiket Pesawat</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <span class="text-3xl font-bold text-sky-600">8%</span>
                                        <p class="text-xs text-gray-500">OFF</p>
                                    </div>
                                </div>
                                
                                <div class="mt-3 space-y-1">
                                    <p class="text-sm text-gray-600">Potongan hingga Rp 240rb</p>
                                    <p class="text-xs text-gray-500">Min. transaksi Rp 2jt</p>
                                </div>

                                <!-- Dotted Line -->
                                <div class="my-3 border-t-2 border-dashed border-sky-500/50"></div>

                                <!-- Coupon Code -->
                                <div class="flex items-center justify-between">
                                    <div class="bg-sky-50 px-3 py-1.5 rounded flex items-center gap-2">
                                        <i class="fas fa-ticket-alt text-sky-500 text-sm"></i>
                                        <code class="text-gray-800 font-mono text-sm">JALANYUK</code>
                                    </div>
                                    <button class="text-sky-600 hover:text-sky-700 font-medium flex items-center gap-1 text-sm">
                                        <i class="fas fa-copy"></i>
                                        Salin
                                    </button>
                                </div>
                            </div>

                            <!-- Ticket Edge Circles -->
                            <div class="absolute -left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-sky-50 rounded-full border-2 border-dashed border-sky-500/50"></div>
                            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-sky-50 rounded-full border-2 border-dashed border-sky-500/50"></div>
                        </div>
                    </div>

                    <!-- Ticket 2 -->
                    <div class="group">
                        <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <!-- Ticket Border Pattern -->
                            <div class="absolute left-0 top-0 h-full w-1 bg-sky-500"></div>
                            <div class="absolute right-0 top-0 h-full w-[3px] bg-gradient-to-b from-transparent via-gray-200 to-transparent"></div>
                            
                            <!-- Ticket Content -->
                            <div class="p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-hotel text-sky-500 text-2xl"></i>
                                            <div>
                                                <span class="inline-block px-2 py-0.5 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">
                                                    Hotel Deals
                                                </span>
                                                <h3 class="text-lg font-bold text-gray-900 mt-1">Diskon Hotel</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <span class="text-3xl font-bold text-sky-600">8%</span>
                                        <p class="text-xs text-gray-500">OFF</p>
                                    </div>
                                </div>
                                
                                <div class="mt-3 space-y-1">
                                    <p class="text-sm text-gray-600">Potongan hingga Rp 500rb</p>
                                    <p class="text-xs text-gray-500">Min. transaksi Rp 500rb</p>
                                </div>

                                <!-- Dotted Line -->
                                <div class="my-3 border-t-2 border-dashed border-sky-500/50"></div>

                                <!-- Coupon Code -->
                                <div class="flex items-center justify-between">
                                    <div class="bg-sky-50 px-3 py-1.5 rounded flex items-center gap-2">
                                        <i class="fas fa-ticket-alt text-sky-500 text-sm"></i>
                                        <code class="text-gray-800 font-mono text-sm">JALANYUK</code>
                                    </div>
                                    <button class="text-sky-600 hover:text-sky-700 font-medium flex items-center gap-1 text-sm">
                                        <i class="fas fa-copy"></i>
                                        Salin
                                    </button>
                                </div>
                            </div>

                            <!-- Ticket Edge Circles -->
                            <div class="absolute -left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-sky-50 rounded-full border-2 border-dashed border-sky-500/50"></div>
                            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-sky-50 rounded-full border-2 border-dashed border-sky-500/50"></div>
                        </div>
                    </div>

                    <!-- Ticket 3 -->
                    <div class="group">
                        <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <!-- Ticket Border Pattern -->
                            <div class="absolute left-0 top-0 h-full w-1 bg-sky-500"></div>
                            <div class="absolute right-0 top-0 h-full w-[3px] bg-gradient-to-b from-transparent via-gray-200 to-transparent"></div>
                            
                            <!-- Ticket Content -->
                            <div class="p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-map-marked-alt text-sky-500 text-2xl"></i>
                                            <div>
                                                <span class="inline-block px-2 py-0.5 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">
                                                    Experience
                                                </span>
                                                <h3 class="text-lg font-bold text-gray-900 mt-1">Diskon Xperience</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <span class="text-3xl font-bold text-sky-600">8%</span>
                                        <p class="text-xs text-gray-500">OFF</p>
                                    </div>
                                </div>
                                
                                <div class="mt-3 space-y-1">
                                    <p class="text-sm text-gray-600">Potongan hingga Rp 300rb</p>
                                    <p class="text-xs text-gray-500">Min. transaksi Rp 300rb</p>
                                </div>

                                <!-- Dotted Line -->
                                <div class="my-3 border-t-2 border-dashed border-sky-500/50"></div>

                                <!-- Coupon Code -->
                                <div class="flex items-center justify-between">
                                    <div class="bg-sky-50 px-3 py-1.5 rounded flex items-center gap-2">
                                        <i class="fas fa-ticket-alt text-sky-500 text-sm"></i>
                                        <code class="text-gray-800 font-mono text-sm">JALANYUK</code>
                                    </div>
                                    <button class="text-sky-600 hover:text-sky-700 font-medium flex items-center gap-1 text-sm">
                                        <i class="fas fa-copy"></i>
                                        Salin
                                    </button>
                                </div>
                            </div>

                            <!-- Ticket Edge Circles -->
                            <div class="absolute -left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-gray-100 rounded-full"></div>
                            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-gray-100 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Destinations Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-sky-600 font-semibold tracking-wider uppercase text-sm">Jelajahi Indonesia</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                        Destinasi Populer
                    </h2>
                    <p class="text-gray-600">Temukan destinasi menarik dengan penawaran terbaik untuk perjalanan tak terlupakan</p>
                </div>

                <!-- Destinations Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Destination 1: Bali -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('images/bali.jpg') }}" alt="Bali" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/50 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white text-xl font-bold mb-2">Bali</h3>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-plane-departure text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 800rb</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-hotel text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 300rb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0" aria-label="Lihat detail Bali"></a>
                    </div>

                    <!-- Destination 2: Yogyakarta -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('images/jogjakarta.jpg') }}" alt="Yogyakarta" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/50 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white text-xl font-bold mb-2">Yogyakarta</h3>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-plane-departure text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 600rb</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-hotel text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 200rb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0" aria-label="Lihat detail Yogyakarta"></a>
                    </div>

                    <!-- Destination 3: Raja Ampat -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('images/raja_ampat.jpg') }}" alt="Raja Ampat" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/50 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white text-xl font-bold mb-2">Raja Ampat</h3>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-plane-departure text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 2.5jt</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-hotel text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 500rb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0" aria-label="Lihat detail Raja Ampat"></a>
                    </div>
                </div>

                <!-- View All Button -->
                <div class="text-center mt-12">
                    <a href="#" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-sky-500 text-white font-semibold hover:bg-sky-600 transition-colors">
                        Lihat Semua Destinasi
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Flight Deals Section -->
        <section class="py-16 bg-gray-100" x-data="{ selectedCity: 'Surabaya' }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-8">
                    <span class="text-sky-600 font-semibold tracking-wider uppercase text-sm">Penerbangan Populer</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                        Penawaran Terbaik untuk Anda
                    </h2>
                    <p class="text-gray-600">Temukan harga tiket pesawat termurah ke berbagai destinasi</p>
                </div>

                <!-- City Navigation -->
                <div class="mb-8">
                    <div class="flex items-center justify-center space-x-6 overflow-x-auto whitespace-nowrap py-2">
                        <button 
                            @click="selectedCity = 'Medan'" 
                            :class="{ 'active': selectedCity === 'Medan' }" 
                            class="city-link">Medan</button>
                        <button 
                            @click="selectedCity = 'Bali'" 
                            :class="{ 'active': selectedCity === 'Bali' }" 
                            class="city-link">Bali</button>
                        <button 
                            @click="selectedCity = 'Surabaya'" 
                            :class="{ 'active': selectedCity === 'Surabaya' }" 
                            class="city-link">Surabaya</button>
                        <button 
                            @click="selectedCity = 'Balikpapan'" 
                            :class="{ 'active': selectedCity === 'Balikpapan' }" 
                            class="city-link">Balikpapan</button>
                        <button 
                            @click="selectedCity = 'Lampung'" 
                            :class="{ 'active': selectedCity === 'Lampung' }" 
                            class="city-link">Lampung</button>
                        <button 
                            @click="selectedCity = 'Jakarta'" 
                            :class="{ 'active': selectedCity === 'Jakarta' }" 
                            class="city-link">Jakarta</button>
                    </div>
                </div>

                <!-- Flight Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Surabaya Flights -->
                    <template x-if="selectedCity === 'Surabaya'">
                        <div class="contents">
                            <!-- Jakarta to Surabaya -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Surabaya</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 856.200</p>
                                            <p class="text-sky-600 font-bold">Rp 756.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medan to Surabaya -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Surabaya</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.350.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.150.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bali to Surabaya -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Bali - Surabaya</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 750.000</p>
                                            <p class="text-sky-600 font-bold">Rp 625.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Surabaya -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Surabaya</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.150.000</p>
                                            <p class="text-sky-600 font-bold">Rp 950.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Balikpapan Flights -->
                    <template x-if="selectedCity === 'Balikpapan'">
                        <div class="contents">
                            <!-- Jakarta to Balikpapan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Balikpapan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.256.200</p>
                                            <p class="text-sky-600 font-bold">Rp 1.056.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medan to Balikpapan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Balikpapan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.550.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.350.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bali to Balikpapan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Bali - Balikpapan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.250.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.050.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Balikpapan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Balikpapan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.150.000</p>
                                            <p class="text-sky-600 font-bold">Rp 950.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Medan Flights -->
                    <template x-if="selectedCity === 'Medan'">
                        <div class="contents">
                            <!-- Jakarta to Medan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Medan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">29 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.212.400</p>
                                            <p class="text-sky-600 font-bold">Rp 1.012.400</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bali to Medan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Bali - Medan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">30 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.450.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.225.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Medan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Medan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">28 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.350.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.150.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Medan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Medan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">31 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.550.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.332.100</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Lampung Flights -->
                    <template x-if="selectedCity === 'Lampung'">
                        <div class="contents">
                            <!-- Jakarta to Lampung -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Lampung</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 856.200</p>
                                            <p class="text-sky-600 font-bold">Rp 756.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medan to Lampung -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Lampung</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.250.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.050.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Lampung -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Lampung</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 950.000</p>
                                            <p class="text-sky-600 font-bold">Rp 825.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Lampung -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Lampung</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.150.000</p>
                                            <p class="text-sky-600 font-bold">Rp 950.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Bali Flights -->
                    <template x-if="selectedCity === 'Bali'">
                        <div class="contents">
                            <!-- Jakarta to Bali -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/bali.jpg') }}" alt="Bali" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Bali</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 956.200</p>
                                            <p class="text-sky-600 font-bold">Rp 856.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medan to Bali -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Bali</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.350.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.150.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Bali -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Bali</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 750.000</p>
                                            <p class="text-sky-600 font-bold">Rp 625.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Bali -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Bali</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.250.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.050.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Jakarta Flights -->
                    <template x-if="selectedCity === 'Jakarta'">
                        <div class="contents">
                            <!-- Medan to Jakarta -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/jakarta.jpg') }}" alt="Jakarta" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Jakarta</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">29 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.212.400</p>
                                            <p class="text-sky-600 font-bold">Rp 1.012.400</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bali to Jakarta -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/jakarta.jpg') }}" alt="Jakarta" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Bali - Jakarta</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 956.200</p>
                                            <p class="text-sky-600 font-bold">Rp 856.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Jakarta -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/jakarta.jpg') }}" alt="Jakarta" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Jakarta</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 850.000</p>
                                            <p class="text-sky-600 font-bold">Rp 725.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Jakarta -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/jakarta.jpg') }}" alt="Jakarta" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Jakarta</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.250.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.050.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                <!-- View All Button -->
                <div class="text-center mt-12">
                    <a href="#" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-sky-500 text-white font-semibold hover:bg-sky-600 transition-colors">
                        Lihat Semua Penerbangan
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-16 bg-gradient-to-br from-sky-500 to-sky-600 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="2" fill="currentColor"/>
                    </pattern>
                    <rect x="0" y="0" width="100%" height="100%" fill="url(#dots)"/>
                </svg>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-white mb-4">
                        Dapatkan Penawaran Eksklusif
                    </h2>
                    <p class="text-sky-100 mb-8">
                        Berlangganan newsletter kami dan dapatkan info promo terbaru langsung di inbox Anda
                    </p>
                    
                    <!-- Newsletter Form -->
                    <form class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                        <input 
                            type="email" 
                            placeholder="Masukkan email Anda" 
                            class="flex-1 px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-sky-500"
                        >
                        <button type="submit" class="px-6 py-3 bg-white text-sky-600 font-semibold rounded-lg hover:bg-sky-50 transition-colors">
                            Berlangganan
                        </button>
                    </form>
                    
                    <!-- Privacy Notice -->
                    <p class="text-sky-100 text-sm mt-4">
                        Kami menghargai privasi Anda. Unsubscribe kapan saja.
                    </p>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
            <!-- Industrial Pattern Background -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM36 6V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                </div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4 tracking-tight">
                        Kenapa Memilih MyTickets?
                    </h2>
                    <div class="w-24 h-1 bg-sky-500 mx-auto mb-6"></div>
                    <p class="text-lg text-gray-300">
                        Platform pemesanan tiket terpercaya dengan berbagai keunggulan untuk perjalanan nyaman Anda
                    </p>
                </div>

                <!-- Features Carousel -->
                <div class="relative" x-data="{ 
                    activeSlide: 0,
                    scroll(direction) {
                        const container = $refs.carousel;
                        const scrollAmount = direction === 'next' ? 600 : -600;
                        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                    }
                }">
                    <!-- Carousel Inner -->
                    <div class="flex gap-4 overflow-hidden" x-ref="carousel">
                        <!-- Slide 1 -->
                        <div class="min-w-[300px] flex-shrink-0">
                            <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow">
                                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-sky-500 text-white mx-auto mb-4">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-center mb-2">Harga Terjangkau</h3>
                                <p class="text-gray-600 text-sm text-center">
                                    Nikmati perjalanan hemat dengan harga tiket yang bersaing dan penawaran spesial.
                                </p>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="min-w-[300px] flex-shrink-0">
                            <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow">
                                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-sky-500 text-white mx-auto mb-4">
                                    <i class="fas fa-lock fa-2x"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-center mb-2">Transaksi Aman</h3>
                                <p class="text-gray-600 text-sm text-center">
                                    Keamanan data dan privasi Anda adalah prioritas kami. Bertransaksilah dengan tenang.
                                </p>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="min-w-[300px] flex-shrink-0">
                            <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow">
                                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-sky-500 text-white mx-auto mb-4">
                                    <i class="fas fa-headset fa-2x"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-center mb-2">Layanan Pelanggan 24/7</h3>
                                <p class="text-gray-600 text-sm text-center">
                                    Tim dukungan kami siap membantu Anda kapan saja, di mana saja. Jangan ragu untuk menghubungi kami.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 flex justify-between px-4">
                        <button @click="scroll('prev')" class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center -translate-x-1/2">
                            <i class="fas fa-chevron-left text-sky-600"></i>
                        </button>
                        <button @click="scroll('next')" class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center translate-x-1/2">
                            <i class="fas fa-chevron-right text-sky-600"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-8 bg-gray-900 text-gray-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <a href="/" class="text-2xl font-bold text-white">
                            MyTickets
                        </a>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4">
                        <a href="#" class="hover:text-white transition-colors">Tentang Kami</a>
                        <a href="#" class="hover:text-white transition-colors">Kontak</a>
                        <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>

    <!-- Auth Modal content was removed from here to avoid duplication -->
    
    <script>
        // JavaScript for Modal Control
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded');
            
            try {
                // Get modal elements
                const modal = document.getElementById('authModal');
                console.log('Modal element:', modal);
                
                const closeModalBtn = document.getElementById('closeModal');
                console.log('Close button:', closeModalBtn);
                
                const modalBackdrop = document.getElementById('modalBackdrop');
                console.log('Modal backdrop:', modalBackdrop);
                
                // Get step elements first to ensure they exist
                const initialStep = document.getElementById('initialStep');
                const verificationStep = document.getElementById('verificationStep');
                const createPasswordStep = document.getElementById('createPasswordStep');
                
                if (!initialStep) console.error('Initial step not found');
                if (!verificationStep) console.error('Verification step not found');
                if (!createPasswordStep) console.error('Create password step not found');
                
                // Close modal handler
                if (closeModalBtn) {
                    closeModalBtn.onclick = function() {
                        console.log('Close button clicked');
                        if (modal) {
                            modal.classList.remove('active');
                            setTimeout(() => {
                                modal.style.display = 'none';
                            }, 300);
                        }
                        if (initialStep) initialStep.classList.remove('active');
                        if (verificationStep) verificationStep.classList.remove('active');
                        if (createPasswordStep) createPasswordStep.classList.remove('active');
                    };
                }
                
                // Click on backdrop to close
                if (modalBackdrop) {
                    modalBackdrop.onclick = function() {
                        console.log('Backdrop clicked');
                        if (modal) {
                            modal.classList.remove('active');
                            setTimeout(() => {
                                modal.style.display = 'none';
                            }, 300);
                        }
                        if (initialStep) initialStep.classList.remove('active');
                        if (verificationStep) verificationStep.classList.remove('active');
                        if (createPasswordStep) createPasswordStep.classList.remove('active');
                    };
                }
                
                // Auth mode buttons
                const loginModeBtn = document.getElementById('loginModeBtn');
                const registerModeBtn = document.getElementById('registerModeBtn');
                
                if (loginModeBtn) {
                    loginModeBtn.addEventListener('click', () => switchAuthMode('login'));
                }
                
                if (registerModeBtn) {
                    registerModeBtn.addEventListener('click', () => switchAuthMode('register'));
                }
                
                // Form submission handlers
                const loginSubmitBtn = document.getElementById('loginSubmitBtn');
                if (loginSubmitBtn) {
                    loginSubmitBtn.addEventListener('click', handleLogin);
                }
                
                const registerSubmitBtn = document.getElementById('registerSubmitBtn');
                if (registerSubmitBtn) {
                    registerSubmitBtn.addEventListener('click', initiateRegistration);
                }
                
                const verifyOtpBtn = document.getElementById('verifyOtpBtn');
                if (verifyOtpBtn) {
                    verifyOtpBtn.addEventListener('click', verifyOtp);
                }
                
                const createPasswordBtn = document.getElementById('createPasswordBtn');
                if (createPasswordBtn) {
                    createPasswordBtn.addEventListener('click', completeRegistration);
                }
                
                const resendOtpBtn = document.getElementById('resendOtpBtn');
                if (resendOtpBtn) {
                    resendOtpBtn.addEventListener('click', resendOtp);
                }
                
            } catch (err) {
                console.error('Error initializing modal:', err);
            }
            
            const closeModalBtn = document.getElementById('closeModal');
            console.log('Close button:', closeModalBtn);
            
            const modalBackdrop = document.getElementById('modalBackdrop');
            console.log('Modal backdrop:', modalBackdrop);
            
            // Auth mode buttons
            const loginModeBtn = document.getElementById('loginModeBtn');
            const registerModeBtn = document.getElementById('registerModeBtn');
            
            // Forms
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            
            // Step elements
            const initialStep = document.getElementById('initialStep');
            const verificationStep = document.getElementById('verificationStep');
            const createPasswordStep = document.getElementById('createPasswordStep');
            
            // Current auth mode
            let currentAuthMode = 'login'; // 'login' or 'register'
            
            // Button elements
            const loginSubmitBtn = document.getElementById('loginSubmitBtn');
            const registerSubmitBtn = document.getElementById('registerSubmitBtn');
            const verifyOtpBtn = document.getElementById('verifyOtpBtn');
            const createPasswordBtn = document.getElementById('createPasswordBtn');
            const resendOtpBtn = document.getElementById('resendOtpBtn');
            // Header buttons
            const loginBtn = document.getElementById('loginBtn');
            const registerBtn = document.getElementById('registerBtn');
            
            // Email values
            let currentEmail = '';
            
            // Function to toggle password visibility
            function setupPasswordToggles() {
                const togglePassword = document.getElementById('togglePassword');
                const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
                
                if (togglePassword) {
                    togglePassword.addEventListener('click', function() {
                        const passwordInput = document.getElementById('newPassword');
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        this.querySelector('i').classList.toggle('fa-eye');
                        this.querySelector('i').classList.toggle('fa-eye-slash');
                    });
                }
                
                if (toggleConfirmPassword) {
                    toggleConfirmPassword.addEventListener('click', function() {
                        const confirmInput = document.getElementById('confirmPassword');
                        const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        confirmInput.setAttribute('type', type);
                        this.querySelector('i').classList.toggle('fa-eye');
                        this.querySelector('i').classList.toggle('fa-eye-slash');
                    });
                }
            }
            
            // Function to switch between login and register modes
            function switchAuthMode(mode) {
                currentAuthMode = mode;
                
                // Update UI
                if (mode === 'login') {
                    loginModeBtn.classList.add('active');
                    registerModeBtn.classList.remove('active');
                    loginForm.classList.remove('hidden');
                    registerForm.classList.add('hidden');
                } else {
                    loginModeBtn.classList.remove('active');
                    registerModeBtn.classList.add('active');
                    loginForm.classList.add('hidden');
                    registerForm.classList.remove('hidden');
                }
            }
            
            // Function to open modal
            function openModal(type) {
                console.log('Opening modal with type:', type);
                modal.classList.add('active');
                initialStep.classList.add('active');
                verificationStep.classList.remove('active');
                createPasswordStep.classList.remove('active');
                
                // Set initial auth mode based on button clicked
                switchAuthMode(type === 'login' ? 'login' : 'register');
            }
            // expose globally for any inline usage (if added later)
            window.openModal = openModal;
            
            // Function to close modal
            function closeModal() {
                console.log('Closing modal');
                modal.classList.remove('active');
                initialStep.classList.remove('active');
                verificationStep.classList.remove('active');
                createPasswordStep.classList.remove('active');
                
                // Reset forms
                if (loginForm) loginForm.reset();
                if (registerForm) registerForm.reset();
                
                // Reset OTP inputs
                document.querySelectorAll('.otp-input').forEach(input => {
                    input.value = '';
                });
            }
            
            // Function to handle login
            function handleLogin() {
                const email = document.getElementById('loginEmail').value;
                const password = document.getElementById('loginPassword').value;
                
                // Validate inputs
                if (!email || !email.includes('@')) {
                    alert('Please enter a valid email address');
                    return;
                }
                
                if (!password || password.length < 6) {
                    alert('Please enter a valid password (at least 6 characters)');
                    return;
                }
                
                console.log('Attempting login with:', email);
                
                // Show loading indicator
                const loginSubmitBtn = document.getElementById('loginSubmitBtn');
                if (loginSubmitBtn) {
                    loginSubmitBtn.textContent = 'Logging in...';
                    loginSubmitBtn.disabled = true;
                }
                
                // Use traditional form submit to /login (web route) for reliability
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/login';
                
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.appendChild(tokenInput);
                
                const emailInput = document.createElement('input');
                emailInput.type = 'hidden';
                emailInput.name = 'email';
                emailInput.value = email;
                form.appendChild(emailInput);
                
                const passwordInput = document.createElement('input');
                passwordInput.type = 'hidden';
                passwordInput.name = 'password';
                passwordInput.value = password;
                form.appendChild(passwordInput);
                
                document.body.appendChild(form);
                form.submit();
            }
            
            // Function to initiate registration - Step 1: Email Validation
            function initiateRegistration() {
                const email = document.getElementById('registerEmail').value;
                
                // Validate email
                if (!email || !email.includes('@')) {
                    alert('Please enter a valid email address');
                    return;
                }
                
                // Save email for later steps
                currentEmail = email;
                
                console.log('Initiating registration for:', email);
                
                // Create a hidden form to submit email to server
                const formData = new FormData();
                formData.append('email', email);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                // Show loading indicator
                const registerSubmitBtn = document.getElementById('registerSubmitBtn');
                if (registerSubmitBtn) {
                    registerSubmitBtn.textContent = 'Sending...';
                    registerSubmitBtn.disabled = true;
                }
                
                // Send request to generate OTP and send email
                fetch('/api/send-otp', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button
                    if (registerSubmitBtn) {
                        registerSubmitBtn.textContent = 'Continue';
                        registerSubmitBtn.disabled = false;
                    }
                    
                    if (data.success) {
                        // Update verification email display
                        const verificationEmailSpan = document.getElementById('verificationEmail');
                        if (verificationEmailSpan) {
                            verificationEmailSpan.textContent = email;
                        }
                        
                        // Switch to verification step
                        initialStep.classList.remove('active');
                        verificationStep.classList.add('active');
                        
                        // Focus the first OTP input
                        setTimeout(() => {
                            const firstOtpInput = document.querySelector('.otp-input');
                            if (firstOtpInput) {
                                firstOtpInput.focus();
                            }
                        }, 300);
                    } else {
                        alert(data.message || 'Failed to send OTP. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error sending OTP:', error);
                    alert('An error occurred while sending OTP. Please try again.');
                    
                    if (registerSubmitBtn) {
                        registerSubmitBtn.textContent = 'Continue';
                        registerSubmitBtn.disabled = false;
                    }
                });
            }
            
            // Function to verify OTP
            function verifyOtp() {
                console.log('Verifying OTP');
                
                // Get all OTP inputs
                const otpInputs = document.querySelectorAll('.otp-input');
                let otp = '';
                
                // Collect OTP values
                otpInputs.forEach(input => {
                    otp += input.value;
                });
                
                // Check if OTP is complete
                if (otp.length !== 6) {
                    alert('Please enter the complete 6-digit OTP');
                    return;
                }
                
                console.log('OTP entered:', otp);
                
                // Show loading indicator
                const verifyButton = document.getElementById('verifyOtpBtn');
                if (verifyButton) {
                    verifyButton.textContent = 'Verifying...';
                    verifyButton.disabled = true;
                }
                
                // Create form data
                const formData = new FormData();
                formData.append('email', currentEmail);
                formData.append('otp_code', otp);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                // Send request to verify OTP
                fetch('/api/verify-otp', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button
                    if (verifyButton) {
                        verifyButton.textContent = 'Verify';
                        verifyButton.disabled = false;
                    }
                    
                    if (data.success) {
                        if (currentAuthMode === 'register') {
                            // For registration flow: Move to create password step
                            verificationStep.classList.remove('active');
                            createPasswordStep.classList.add('active');
                            
                            // Setup password toggles
                            setupPasswordToggles();
                        } else {
                            // For login flow with OTP (not implemented in this UI, but could be)
                            alert('Verification successful! You are now logged in.');
                            closeModal();
                            
                            // Update UI to show logged in state
                            if (loginBtn) {
                                loginBtn.textContent = 'My Account';
                            }
                            if (registerBtn) {
                                registerBtn.style.display = 'none';
                            }
                        }
                    } else {
                        alert(data.message || 'Invalid OTP. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error verifying OTP:', error);
                    alert('An error occurred while verifying OTP. Please try again.');
                    
                    if (verifyButton) {
                        verifyButton.textContent = 'Verify';
                        verifyButton.disabled = false;
                    }
                });
            }
            
            // Function to complete registration by creating password
            function completeRegistration() {
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                // Validate password
                if (!newPassword || newPassword.length < 8) {
                    alert('Password must be at least 8 characters long');
                    return;
                }
                
                if (newPassword !== confirmPassword) {
                    alert('Passwords do not match');
                    return;
                }
                
                console.log('Completing registration with email:', currentEmail);
                
                // Show loading indicator
                const createPasswordBtn = document.getElementById('createPasswordBtn');
                if (createPasswordBtn) {
                    createPasswordBtn.textContent = 'Processing...';
                    createPasswordBtn.disabled = true;
                }
                
                // Create form data
                const formData = new FormData();
                formData.append('email', currentEmail);
                formData.append('password', newPassword);
                formData.append('password_confirmation', confirmPassword);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                // Send request to complete registration
                fetch('/api/complete-registration', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button state
                    if (createPasswordBtn) {
                        createPasswordBtn.textContent = 'Complete Registration';
                        createPasswordBtn.disabled = false;
                    }
                    if (data.success) {
                        alert('Registration successful! Your account has been created.');
                        closeModal();
                        if (loginBtn) loginBtn.textContent = 'My Account';
                        if (registerBtn) registerBtn.style.display = 'none';
                        window.location.reload();
                    } else {
                        alert(data.message || 'Failed to complete registration. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error completing registration:', error);
                    alert('An error occurred while completing registration. Please try again.');
                    if (createPasswordBtn) {
                        createPasswordBtn.textContent = 'Complete Registration';
                        createPasswordBtn.disabled = false;
                    }
                });
            }
            
            // Function to resend OTP
            function resendOtp() {
                console.log('Resending OTP to:', currentEmail);
                
                // Create a hidden form to submit email to server
                const formData = new FormData();
                formData.append('email', currentEmail);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                // Show loading indicator
                const resendButton = document.getElementById('resendOtpBtn');
                if (resendButton) {
                    resendButton.textContent = 'Sending...';
                    resendButton.disabled = true;
                }
                
                // Send request to resend OTP
                fetch('/api/resend-otp', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button
                    if (resendButton) {
                        resendButton.textContent = 'Resend OTP Code';
                        resendButton.disabled = false;
                    }
                    
                    if (data.success) {
                        alert('A new OTP has been sent to ' + currentEmail);
                        
                        // Reset OTP inputs
                        document.querySelectorAll('.otp-input').forEach(input => {
                            input.value = '';
                        });
                        
                        // Focus the first input
                        document.querySelector('.otp-input').focus();
                    } else {
                        alert(data.message || 'Failed to resend OTP. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error resending OTP:', error);
                    alert('An error occurred while resending OTP. Please try again.');
                    
                    if (resendButton) {
                        resendButton.textContent = 'Resend OTP Code';
                        resendButton.disabled = false;
                    }
                });
            }
            
            // Setup event listeners for auth mode buttons
            if (loginModeBtn) {
                loginModeBtn.addEventListener('click', function() {
                    switchAuthMode('login');
                });
            }
            
            if (registerModeBtn) {
                registerModeBtn.addEventListener('click', function() {
                    switchAuthMode('register');
                });
            }
            
            // Event listeners for main buttons - Commented out in favor of direct onclick handlers above
            /*
            if (loginBtn) loginBtn.addEventListener('click', () => openModal('login'));
            if (registerBtn) registerBtn.addEventListener('click', () => openModal('register'));
            */
            
            // Modal controls
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }
            
            if (modalBackdrop) {
                modalBackdrop.addEventListener('click', closeModal);
            }
            
            // Form submission handlers
            if (loginSubmitBtn) {
                loginSubmitBtn.addEventListener('click', handleLogin);
            }
            
            if (registerSubmitBtn) {
                registerSubmitBtn.addEventListener('click', initiateRegistration);
            }
            
            if (verifyOtpBtn) {
                verifyOtpBtn.addEventListener('click', verifyOtp);
            }
            
            if (createPasswordBtn) {
                createPasswordBtn.addEventListener('click', completeRegistration);
            }
            
            if (resendOtpBtn) {
                resendOtpBtn.addEventListener('click', resendOtp);
            }
            
            // Handle form submissions
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    handleLogin();
                });
            }
            
            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    initiateRegistration();
                });
            }
            
            // Handle OTP inputs
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('otp-input')) {
                    // Allow only numbers
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');
                    
                    if (e.target.value.length === 1) {
                        const nextInput = e.target.nextElementSibling;
                        if (nextInput && nextInput.classList.contains('otp-input')) {
                            nextInput.focus();
                        }
                    }
                }
            });
            
            // Handle backspace in OTP inputs
            document.addEventListener('keydown', function(e) {
                if (e.target.classList.contains('otp-input') && e.key === 'Backspace' && !e.target.value) {
                    const prevInput = e.target.previousElementSibling;
                    if (prevInput && prevInput.classList.contains('otp-input')) {
                        prevInput.focus();
                    }
                }
            });
            
            // Product tabs functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanels = document.querySelectorAll('.tab-panel');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and panels
                    tabButtons.forEach(btn => btn.classList.remove('bg-indigo-600', 'text-white'));
                    tabPanels.forEach(panel => panel.classList.add('hidden'));
                    
                    // Add active class to current button
                    button.classList.add('bg-indigo-600', 'text-white');
                    
                    // Show the corresponding panel
                    const panelId = button.getAttribute('data-target');
                    const panel = document.getElementById(panelId);
                    if (panel) {
                        panel.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>
