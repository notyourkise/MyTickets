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
    <!-- Alpine.js for x-data/x-show bindings -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
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

    /* Hide elements until Alpine initializes to avoid flicker */
    [x-cloak] { display: none !important; }

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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/milky.jpg');
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
            background: transparent; /* fully transparent */
            backdrop-filter: none; /* no blur */
            border-radius: 18px;
            box-shadow: none; /* remove shadow */
            padding: 1.75rem 2rem 2rem;
            border: none; /* remove border */
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
    .dropdown-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:.5rem; }
    .dropdown-title { font-size:1.1rem; font-weight:700; color:#334155; }
    .dropdown-close { background:transparent; border:none; color:#64748b; font-size:1rem; padding:.25rem; border-radius:6px; cursor:pointer; }
    .dropdown-close:hover { background:#f1f5f9; color:#0f172a; }
    .passenger-row { display:flex; align-items:center; justify-content:space-between; padding:.5rem 0; border-bottom:1px solid #e5e7eb; }
    .passenger-row:last-child { border-bottom:none; }
    .passenger-row .left { display:flex; align-items:center; gap:.6rem; color:#334155; }
    .passenger-row .left i { color:#0ea5e9; width:18px; text-align:center; }
    .type-title { font-weight:600; line-height:1.1; }
    .type-sub { font-size:.75rem; color:#94a3b8; margin-top:2px; }
    .counter { display:flex; align-items:center; gap:.6rem; }
    .counter-btn { width:28px; height:28px; border-radius:9999px; background:#f1f5f9; border:1px solid #e2e8f0; color:#334155; display:flex; align-items:center; justify-content:center; cursor:pointer; }
    .counter-btn:hover { background:#e2e8f0; }
    .counter-btn:disabled { opacity:.5; cursor:not-allowed; }
    .counter .count { min-width:20px; text-align:center; font-weight:600; color:#0f172a; }
    .option-row { width:100%; display:flex; align-items:center; justify-content:space-between; gap:.75rem; padding:.6rem .5rem; border-radius:10px; border:1px solid transparent; background:#fff; cursor:pointer; }
    .option-row .left { display:flex; align-items:center; gap:.6rem; color:#334155; }
    .option-row .left i { color:#0ea5e9; }
    .option-row:hover { background:#f8fafc; border-color:#e2e8f0; }
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
            align-items: center;
            justify-content: flex-start; /* align left under airport button */
            gap: .5rem; /* tighter spacing */
            flex-wrap: wrap;
            margin-top: .75rem;
            margin-left: 2rem;
            color: #fff;
            max-width: 520px; /* match route combined button width */
        }
        .quick-links .ql-label { color: #fff; font-weight: 700; font-size: .95rem; margin-right: .25rem; }
        .quick-links a {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .4rem .7rem; /* smaller chip */
            border-radius: 8px; /* smaller radius */
            font-weight: 600;
            font-size: .9rem; /* smaller font */
            color: #fff;
            text-decoration: none;
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.35);
            backdrop-filter: blur(2px);
            transition: background-color .2s, border-color .2s, transform .2s;
        }
        .quick-links a i { color: #fff; font-size: .9rem; }
        @media (max-width: 1024px) {
            .quick-links { max-width: none; }
        }
        .quick-links a:hover {
            background: rgba(255,255,255,.28);
            border-color: rgba(255,255,255,.5);
            color: #fff;
            transform: translateY(-1px);
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
    /* --- CSS UNTUK DROPDOWN PENUMPANG & KELAS (trigger dan opsi) --- */
    .dropdown-trigger { display: flex; align-items: center; gap: 0.5rem; width: 180px; padding: 0.7rem 0.75rem; border: 1px solid #d1d5db; color: #fff; background: transparent; border-radius: 8px; font-weight: 700; font-size: 0.85rem; cursor: pointer; transition: all .2s ease; text-align: left; margin: 0 .375rem; }
    .dropdown-trigger:hover { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(0,108,228,.15); }
    .dropdown-trigger i:first-child { font-size: 0.95rem; color: var(--primary); width: 18px; text-align: center; }
    .dropdown-trigger.passengers-trigger { width: 300px; }
    .dropdown-trigger.class-trigger { width: 190px; }
    .dropdown-panel { position: absolute; right: 0; top: 100%; margin-top: 0.5rem; z-index: 50; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 1rem; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1); width: 320px; }
    .dropdown-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid #f3f4f6; }
    .dropdown-title { font-size: 1rem; font-weight: 600; color: #1f2937; }
    .dropdown-close { background: transparent; border: none; color: #9ca3af; cursor: pointer; }
    .dropdown-close:hover { color: #1f2937; }
    .passenger-row { display: flex; align-items: center; justify-content: space-between; padding: 0.5rem 0; }
    .passenger-row .left { display: flex; align-items: center; gap: 0.75rem; color: #374151; }
    .passenger-row .left i { font-size: 1.1rem; color: #6b7280; width: 20px; text-align: center; }
    .type-title { font-weight: 500; }
    .type-sub { font-size: 0.75rem; color: #9ca3af; margin-top: 1px; }
    .counter { display: flex; align-items: center; gap: 0.75rem; }
    .counter-btn { width: 32px; height: 32px; border-radius: 9999px; background: transparent; border: 1px solid #e5e7eb; color: #374151; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background-color .2s; }
    .counter-btn:hover { background: #e5e7eb; }
    .counter-btn:disabled { opacity: .5; cursor: not-allowed; background: #f9fafb; }
    .counter .count { min-width: 20px; text-align: center; font-weight: 500; font-size: 1rem; color: #1f2937; }
    .class-option { width: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0.6rem 0.75rem; border-radius: 8px; background: #ffffffff; cursor: pointer; text-align: left; border: none; font-size: 0.9rem; transition: background-color .2s; }
    .class-option:hover { background: #f9fafb; }
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
    /* Specific top-bar auth button styles */
    #loginBtn {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .4rem .85rem;
        border: 1.5px solid rgba(255,255,255,.9);
        border-radius: 8px;
        background: transparent;
        color: #fff;
        font-weight: 700;
    }
    #loginBtn i { font-size: .95rem; line-height: 1; -webkit-text-stroke: 1.25px #fff; color: transparent; }
    #loginBtn:hover { background: rgba(255,255,255,.08); border-color: #fff; color: #fff !important; }

    #registerBtn {
        background: var(--primary) !important;
        color: #fff !important;
        border-radius: 8px;
        padding: .4rem .95rem;
        box-shadow: 0 6px 18px -6px rgba(0,108,228,.6);
        font-weight: 700;
    }
    #registerBtn:hover { filter: brightness(1.08); color: #fff !important; }
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
        width: 150px;
        height: 38px;
        border-radius: 14px;
        background: transparent;
        border: none;
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
        background: transparent; /* fully transparent */
        backdrop-filter: none; /* no blur */
        border-radius: 18px;
        box-shadow: none; /* remove shadow */
        padding: 1.5rem 2rem 2rem;
        border: none; /* remove border */
        margin-top: 0.35rem; /* tighter gap to the stroke above */
    }

    /* Top-right chips for passengers & class */
    .control-chip {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .4rem .6rem;
        border: 1px solid rgba(255,255,255,.7);
        color: #fff;
        background: rgba(255,255,255,.08);
        border-radius: 12px;
        font-weight: 600;
        font-size: .85rem;
        line-height: 1;
        cursor: pointer;
        backdrop-filter: saturate(120%);
    }
    .control-chip i { font-size: .9rem; }
    .control-chip:hover { background: rgba(255,255,255,.12); }

    /* Swap and search buttons */
    .swap-btn {
        width: 42px; height: 42px;
        border-radius: 9999px;
        display: inline-flex; align-items: center; justify-content: center;
        color: #0d74d6;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 6px 16px -6px rgba(0,0,0,.35);
    }
    /* Spin animation for swap icon */
    .swap-btn i.spinning { animation: swap-spin .6s ease-in-out; }
    @keyframes swap-spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    .swap-btn:hover { filter: brightness(0.98); }
    .search-fab {
        width: 52px; height: 52px;
        border-radius: 9999px;
        display: inline-flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #ff7a1a, #ff5a00);
        color: #fff; font-size: 1.25rem; box-shadow: 0 12px 24px -10px rgba(255,90,0,.6);
        border: none;
    }
    .search-fab:hover { transform: translateY(-1px); filter: brightness(1.02); }

    /* Combined horizontal input groups (route and dates) */
        .combined-labels {
            display: flex; justify-content: space-between; align-items: center; color: #fff; font-weight: 700; font-size: .8rem;
            margin-bottom: .2rem; text-shadow: 0 1px 2px rgba(0,0,0,.25);
        }
        .combined-input {
            position: relative; background: #ffffff; border: 1px solid rgba(0,0,0,.12); border-radius: 16px;
            padding: 3px 5px; display: grid; grid-template-columns: 1fr 1fr; gap: 0; box-shadow: 0 10px 20px -12px rgba(0,0,0,.22);
        }
    .combined-input .center-divider { position: absolute; left: 50%; top: 14%; bottom: 14%; width: 2px; background: rgba(0,0,0,.08); border-radius: 2px; }
    .combined-input .swap-center { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 5; }
    .combined-field { position: relative; min-height: 40px; display: flex; align-items: center; }
    .combined-field .icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: .9rem; }
    .combo-input { width: 100%; border: none; outline: none; background: transparent; padding: 8px 8px 8px 34px; font-size: .85rem; color: #111827; }
    .combo-input[disabled] { color: #9CA3AF; }
    
    /* Hero section and search table positioning */
    .hero-content {
        padding-top: 70px; /* bring search area closer to header stroke */
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
            padding-top: 110px; /* closer on mobile too */
        }
        
        .search-card {
            padding: 1rem 1.25rem 1.25rem;
        }
    }
    
    /* --- CSS UNTUK AUTH MODAL --- */
    .modal-input { 
        width: 100%;
        margin-top: 0.25rem;
        border-radius: 0.5rem;
        border: 1px solid #D1D5DB;
        padding: 0.5rem 0.875rem; /* smaller padding */
        font-size: 0.95rem; /* slightly smaller font */
        line-height: 1.4;
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
        padding: 0.625rem 0.875rem; /* tighter padding */
        font-size: 0.95rem; /* slightly smaller font */
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
        width: 2.5rem; /* smaller width */
        height: 3rem;  /* smaller height */
        text-align: center;
        font-size: 1.25rem; /* smaller font */
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
        overflow-y: auto; /* allow overlay to scroll on small screens */
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
        /* remove overflow hidden so content can scroll */
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
        overflow-y: auto; /* enable internal scroll */
        -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
        touch-action: pan-y; /* allow vertical pan inside modal */
        font-size: 0.95rem; /* slightly smaller base font for modal */
    }
    
    #authModal #closeModal {
        font-size: 1.2rem;
        z-index: 10;
    }
    
    #authModal .modal-btn-primary {
        background-color: #E86C00;
        border: none;
        border-radius: 8px;
        height: 44px; /* slightly shorter button */
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
    /* Limit inner content width inside modal for breathing space */
    #authModal .modal-inner {
        max-width: 420px; /* content width, smaller than modal */
        margin: 0 auto;
        width: 100%;
    }

    /* Add comfortable spacing between fields inside modal forms */
    #authModal form > div + div {
    margin-top: 18px; /* increased space between stacked form rows */
    }
    /* Ensure labels have some breathing room from inputs */
    #authModal .modal-inner label {
        display: block;
    margin-bottom: 8px; /* slightly more space under labels */
    }
    
    /* --- CSS BARU UNTUK MENYESUAIKAN TAMPILAN --- */
    .control-chip {
        display: inline-flex; align-items: center; gap: .5rem; padding: .6rem .8rem;
        border: 1px solid #e5e7eb; color: #374151; background: #fff; border-radius: 8px;
        font-weight: 500; font-size: .875rem; cursor: pointer; transition: all .2s;
    }
    .control-chip:hover { background: #f3f4f6; }
    .control-chip i { font-size: .9rem; color: var(--primary); }
    
    .swap-btn {
        width: 36px; height: 36px; border-radius: 9999px; display: inline-flex; align-items: center; justify-content: center;
        color: var(--primary); background: #e0f2fe; border: 1px solid #bae6fd; box-shadow: 0 4px 10px -4px rgba(0,0,0,.2);
        transition: all .2s;
    }
    .swap-btn:hover { background: #cceefd; }
    
    .search-fab {
        width: 56px; height: 56px; border-radius: 9999px; display: inline-flex; align-items: center; justify-content: center;
        background: var(--brand-orange); color: #fff; font-size: 1.5rem; box-shadow: 0 10px 20px -8px rgba(255,102,0,.5);
        border: 2px solid #fff; cursor: pointer; transition: all .2s; position: relative; left: -1px;
    }
    .search-fab:hover { transform: translateY(-2px); box-shadow: 0 12px 28px -8px rgba(255,102,0,.6); }
    
    .combined-labels {
        display: grid; grid-template-columns: 1fr 1fr auto; align-items: end; gap: .5rem; color: #1f2937; font-weight: 600; font-size: .8rem;
        margin-bottom: .375rem; padding: 0 .25rem .125rem;
    }
    .labels-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0; padding: 0 .5rem; }
    .labels-grid span, .labels-grid label { line-height: 1; }
    .combined-input {
        position: relative; background: #ffffff; border: 1px solid transparent; border-radius: 9999px;
        padding: 4px; display: grid; grid-template-columns: 1fr 1fr; gap: 0; box-shadow: 0 4px 12px -4px rgba(0,0,0,.1);
        transition: all .2s;
    }
    .combined-input:focus-within { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(0,108,228,.2); }
    
    .combined-input .center-divider { position: absolute; left: 50%; top: 12%; bottom: 12%; width: 2px; background: rgba(0,0,0,.08); border-radius: 2px; }
    .combined-input .swap-center { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 5; }
    
    .combined-field { position: relative; display: flex; align-items: center; }
    .combined-field .icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 1rem; }
    .combo-input { width: 100%; border: none; outline: none; background: transparent; padding: 12px 12px 12px 48px; font-size: .9rem; font-weight: 500; color: #111827; }
    
    .quick-links-btn {
        display: inline-flex; align-items: center; gap: .5rem; background: rgba(255,255,255,0.85); color: #374151;
        border: 1px solid transparent; padding: .5rem 1rem; border-radius: 9999px; font-size: .875rem; font-weight: 500; cursor: pointer; transition: all .2s;
    }
    .quick-links-btn:hover { background: #fff; border-color: #d1d5db; }

    /* Overrides untuk layout satu baris yang lebih rapat */
    .search-card { padding: 1.25rem 1.25rem 1.25rem; }
    .combined-input { padding: 4px; border:3px solid rgba(76, 75, 75, 0.9); box-shadow: 0 0 0 2px rgba(0,0,0,.06); }
    /* Center divider default centered; the route box will override below */
    .combined-input .center-divider { left: 50%; width: 2px; top: 12%; bottom: 12%; background: rgba(0,0,0,.12); border-radius: 2px; }
    /* Swap stays offset; only present in the route box */
    .combined-input .swap-center { transform: translate(calc(-50% - 30px), -50%); }
    /* Taller button height */
    .combined-field { min-height: 48px; }
    .combined-field .icon { left: 8px; font-size: .85rem; }
    .combo-input { padding: 10px 8px 10px 30px; font-size: .8rem; }
    .swap-btn { width: 32px; height: 32px; }
    .search-fab { width: 44px; height: 44px; font-size: 1.1rem; }
    .combined-input, .combined-field, .combo-input { min-width: 0; }

    /* Suggestion dropdown for airports */
    .suggest-panel { position: absolute; left: 0; right: 0; top: calc(100% + 10px); background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 18px 30px -12px rgba(0,0,0,.25); overflow: hidden; z-index: 40; }
    .suggest-header { display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; border-bottom: 1px solid #f3f4f6; }
    .suggest-title { font-weight: 700; color: #111827; font-size: .95rem; }
    .suggest-clear { color: #0d74d6; font-weight: 600; font-size: .85rem; display: inline-flex; align-items: center; gap: 6px; }
    .suggest-body { max-height: 360px; overflow: auto; padding: 6px 0; }
    .suggest-item { width: 100%; text-align: left; display: grid; grid-template-columns: 28px 1fr; gap: 10px; padding: 10px 14px; background: transparent; border: none; cursor: pointer; }
    .suggest-item:hover { background: #f9fafb; }
    .suggest-item i { color: #6b7280; }
    .suggest-name { font-weight: 700; color: #111827; font-size: .95rem; display: flex; align-items: baseline; gap: .5rem; }
    .suggest-code { color: #6b7280; font-weight: 700; letter-spacing: .5px; }
    .suggest-sub { color: #6b7280; font-size: .85rem; margin-top: 2px; }

    /* Date box: nudge to the right a bit */
    .search-row > div:nth-child(2) .combined-input { margin-left: 40px; }

    /* Align 'Departure date' label with the shifted date box */
    .combined-labels > .labels-grid:nth-of-type(2) { margin-left: 40px; }

    /* Date placeholders black */
    input[x-ref="departpicker"]::placeholder,
    input[x-ref="returnpicker"]::placeholder { color: #111827; opacity: 1; }

    /* Grid khusus satu baris: rute | tanggal | tombol */
    .search-row { display: grid; grid-template-columns: minmax(0,1fr) minmax(0,1fr) auto; align-items: center; gap: .375rem; }
    /* Make the two combined buttons narrower on wide screens */
    .search-row > div > .combined-input { max-width: 520px; }
    @media (max-width: 1024px) {
        .search-row { grid-template-columns: 1fr; }
        .search-row > div > .combined-input { max-width: none; width: 100%; }
    .search-row > div:nth-child(2) .combined-input { margin-left: 0; }
    .combined-labels > .labels-grid:nth-of-type(2) { margin-left: 0; }
    }

    /* Only the first column (airport route) divider aligns with the offset swap */
    .search-row > div:first-child .combined-input .center-divider { left: calc(50% - 30px); }

    /* Label lebih ringkas + warna putih */
    .combined-labels { font-size: .75rem; margin-bottom: .25rem; }
    .labels-grid { padding: 0 .25rem; }
    .combined-labels, .combined-labels span, .combined-labels label { color: #fff !important; }

    /* Hotels: single connected bar with 3 equal segments */
    .search-row-hotels { display: grid; grid-template-columns: minmax(0,1fr) auto; align-items: center; gap: .375rem; }
    .search-row-hotels .combined-input { width: 100%; max-width: none; }
    .combined-input.three { grid-template-columns: 1fr 1fr 1fr; border-radius: 9999px; position: relative; }
    .combined-input.three .v-divider { position: absolute; top: 12%; bottom: 12%; width: 2px; background: rgba(0,0,0,.12); border-radius: 2px; }
    .combined-input.three .v-divider.div1 { left: 33.3333%; transform: translateX(-1px); }
    .combined-input.three .v-divider.div2 { left: 66.6667%; transform: translateX(-1px); }
    .combo-button { width: 100%; text-align: left; border: 0; background: transparent; padding: 10px 8px 10px 30px; font-size: .8rem; color: #111827; cursor: pointer; }
    .combo-button:focus { outline: none; }

    /* Hotels chips (Hotels | Villa | Apartment) */
    .stay-type { display:inline-flex; align-items:center; gap:.6rem; margin-top:0; margin-bottom:2.5rem; }
    .stay-chip { display:inline-flex; align-items:center; gap:.45rem; padding:.5rem .8rem; border-radius:9999px; background: rgba(0,0,0,.35); color:#fff; font-weight:700; border:1px solid rgba(255,255,255,.3); cursor:pointer; transition: .2s; }
    .stay-chip i { font-size:.95rem; }
    .stay-chip.active { background: var(--primary); border-color: transparent; }

    /* Nudge Hotels labels slightly right for Date and Guests */
    .hotel-ui .combined-labels > .labels-grid:nth-of-type(1) span:nth-child(2) { margin-left: 10px; }
    .hotel-ui .combined-labels > .labels-grid:nth-of-type(2) span:nth-child(1) { margin-left: 10px; }
    /* Nudge the date and guests text inside segments a bit to the right */
    .combined-input.three > .combined-field:nth-child(2) .combo-button,
    .combined-input.three > .combined-field:nth-child(3) .combo-button { padding-left: 40px; }

    /* Hotels date segment focus styling */
    .combined-input.three .date-field { position: relative; border-radius: 9999px; }
    .combined-input.three .date-field.is-open { box-shadow: inset 0 0 0 2px #1a73e8; background: #fff; }

    /* Flatpickr hotel theme (approximate reference) */
    .flatpickr-calendar.hotel { border:1px solid #e5e7eb; border-radius: 10px; box-shadow: 0 18px 40px -12px rgba(0,0,0,.2); overflow: hidden; }
    .flatpickr-calendar.hotel .flatpickr-months { padding: 6px 8px; }
    .flatpickr-calendar.hotel .flatpickr-current-month { font-weight: 700; }
    .flatpickr-calendar.hotel .flatpickr-weekdaycontainer span { font-weight: 600; color:#64748b; }
    .flatpickr-calendar.hotel .flatpickr-day.inRange { background: #e9f2ff; border-color: #e9f2ff; }
    .flatpickr-calendar.hotel .flatpickr-day.startRange,
    .flatpickr-calendar.hotel .flatpickr-day.endRange,
    .flatpickr-calendar.hotel .flatpickr-day.selected { background: #1a73e8; color: #fff; border-color: #1a73e8; }
    .flatpickr-calendar.hotel .flatpickr-day.startRange { border-radius: 999px 0 0 999px; }
    .flatpickr-calendar.hotel .flatpickr-day.endRange { border-radius: 0 999px 999px 0; }
    .flatpickr-calendar.hotel .flatpickr-day.selected { border-radius: 999px; }
    .flatpickr-calendar.hotel .flatpickr-next-month, 
    .flatpickr-calendar.hotel .flatpickr-prev-month { color:#1a73e8; }

    /* Custom header above calendar */
    .hotel-cal-header { padding: 14px 16px; border-bottom:1px solid #e5e7eb; background:#fff; }
    .hotel-cal-title { font-size: 1.4rem; font-weight: 800; color:#0f172a; }
    .hotel-cal-sub { display:grid; grid-template-columns: 1fr 1fr; gap: 1rem; padding-top: 10px; }
    .hotel-cal-sub .label { font-size: .9rem; color:#6b7280; font-weight:600; }
    .hotel-cal-sub .val { font-size: 1rem; color:#0f172a; font-weight:800; }
    /* --- HERO 4-UP LOGO ROTATOR (switches every 2s) --- */
    .hero-logos-frame { display: inline-flex; align-items: center; gap: 12px; padding: 10px 16px; border-radius: 16px; border: 1.5px solid #e5e7eb; background: #fff; box-shadow: 0 2px 16px -8px rgba(0,0,0,.08); }
    .trusted-label { color: #000000ff; font-weight: 600; font-size: .9rem; letter-spacing: .3px; white-space: nowrap; }
    .trusted-divider { color: #000; }
    .hero-logos { display: flex; align-items: center; justify-content: center; gap: 1.25rem; flex-wrap: nowrap; }
    .hero-logos img { max-height: 40px; width: auto; object-fit: contain; filter: none; opacity: 1; transition: transform .2s ease, opacity .2s ease; }
    .hero-logos img:hover { transform: scale(1.04); }
    @media (max-width: 640px) { .hero-logos { gap: .75rem; } .hero-logos img { max-height: 28px; } .hero-logos-frame { padding: 8px 12px; } }
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
            <button id="loginBtn" type="button" onclick="showAuthModal('login')"><i class="fas fa-user"></i> <span>Log In</span></button>
            <button class="register-btn" id="registerBtn" type="button" onclick="showAuthModal('register')">Register</button>
        </div>
        
        <!-- Stroke Separator 1 -->
        <div class="header-stroke"></div>
        
        <!-- Header Level 2 -->
        <div class="inner">
            <a href="/" class="site-logo" aria-label="Home">
                <span class="ticket-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="MyTickets" />
                </span>
            </a>
            <div class="product-tabs" aria-label="Product Tabs">
                <button class="product-tab active" id="flightsTab" onclick="selectProduct('flights')"><i class="fas fa-plane"></i><span>Flights</span></button>
                <button class="product-tab" id="hotelsTab" onclick="selectProduct('hotels')"><i class="fas fa-hotel"></i><span>Hotels</span></button>
                <!-- Trains tab removed per request -->
                <button class="product-tab" id="busTab" onclick="selectProduct('bus')"><i class="fas fa-bus"></i><span>Bus & Travel</span></button>
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
                <div class="modal-inner">
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
            </div>
            
            <!-- Verification Step - OTP Input -->
            <div id="verificationStep" class="modal-step p-8">
                <div class="modal-inner">
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
            </div>
            
            <!-- Create Password Step (After Register Verification) -->
            <div id="createPasswordStep" class="modal-step p-8">
                <div class="modal-inner">
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
    </div>

    <!-- Hero with Integrated Flight Search -->
    <section class="bg-hero min-h-[640px] flex items-center justify-center relative">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/25 to-black/60"></div>
        <div class="hero-content">
            <div class="search-container" x-data="flightSearch()" x-init="init()">
                <div class="search-card">
                    <!-- Top row: trip type (left) and control chips (right) - Flights only -->
                    <div class="flex items-center justify-between gap-4" x-show="product==='flights'" x-cloak>
                        <div class="flex items-center gap-2 text-sm font-medium text-white/90">
                            <div class="trip-type-switch">
                                <button :class="{'active':mode==='standard'}" @click="mode='standard'">One-way / Round-trip</button>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="relative" x-data="{ showPassengers: false }">
                                <button @click="showPassengers = !showPassengers" class="dropdown-trigger passengers-trigger">
                                    <i class="fas fa-user-group"></i>
                                    <span x-text="passengerSummary()"></span>
                                    <i class="fas fa-chevron-down text-xs ml-auto"></i>
                                </button>
                                <div x-show="showPassengers" x-cloak @click.outside="showPassengers = false" class="dropdown-panel" x-transition>
                                    <div class="dropdown-header">
                                        <div class="dropdown-title">Passengers</div>
                                        <button type="button" class="dropdown-close" @click="showPassengers=false"><i class="fas fa-times"></i></button>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="passenger-row">
                                            <div class="left"><i class="fas fa-user"></i><div><div class="type-title">Adult</div><div class="type-sub">Age 12 and over</div></div></div>
                                            <div class="counter">
                                                <button type="button" class="counter-btn" @click="adjust('adult','-')" :disabled="passengers.adult <= 1"><i class="fas fa-minus"></i></button>
                                                <span class="count" x-text="passengers.adult"></span>
                                                <button type="button" class="counter-btn" @click="adjust('adult','+')"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="passenger-row">
                                            <div class="left"><i class="fas fa-child"></i><div><div class="type-title">Child</div><div class="type-sub">Age 2 - 11</div></div></div>
                                            <div class="counter">
                                                <button type="button" class="counter-btn" @click="adjust('child','-')" :disabled="passengers.child <= 0"><i class="fas fa-minus"></i></button>
                                                <span class="count" x-text="passengers.child"></span>
                                                <button type="button" class="counter-btn" @click="adjust('child','+')"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="passenger-row">
                                            <div class="left"><i class="fas fa-baby"></i><div><div class="type-title">Infant (on lap)</div><div class="type-sub">Below age 2</div></div></div>
                                            <div class="counter">
                                                <button type="button" class="counter-btn" @click="adjust('infant','-')" :disabled="passengers.infant <= 0"><i class="fas fa-minus"></i></button>
                                                <span class="count" x-text="passengers.infant"></span>
                                                <button type="button" class="counter-btn" @click="adjust('infant','+')"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4"><button type="button" class="primary-action-button w-full" @click="showPassengers=false">Done</button></div>
                                </div>
                            </div>

                            <div class="relative" x-data="{ showClass: false }">
                                <button @click="showClass = !showClass" class="dropdown-trigger class-trigger">
                                    <i class="fas fa-chair"></i>
                                    <span x-text="travelClass"></span>
                                    <i class="fas fa-chevron-down text-xs ml-auto"></i>
                                </button>
                                <div x-show="showClass" x-cloak @click.outside="showClass = false" class="dropdown-panel" x-transition>
                                    <div class="space-y-1">
                                        <template x-for="cls in classes" :key="cls">
                                            <button type="button" class="class-option" @click="travelClass = cls; showClass = false">
                                                <span x-text="cls"></span>
                                                <i class="fas fa-check text-primary" x-show="travelClass === cls"></i>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Flights Form -->
                    <div x-show="product==='flights' && mode==='standard'" x-cloak class="mt-4">
                        <div class="combined-labels">
                            <!-- Label di atas From/To -->
                            <div class="labels-grid">
                                <span>From</span>
                                <span>To</span>
                            </div>
                            <!-- Label di atas Departure/Return -->
                            <div class="labels-grid">
                                <span>Departure date</span>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" class="accent-white" :checked="tripType==='roundtrip'" @change="tripType=$event.target.checked?'roundtrip':'oneway'; if(tripType==='oneway') returnDate=''; $nextTick(()=>initPickers())">
                                    Return Date
                                </label>
                            </div>
                            <!-- Placeholder untuk kolom tombol -->
                            <div></div>
                        </div>
                        <div class="search-row">
                            <!-- Combined route box -->
                            <div class="relative" @click.outside="hideSuggest(focusField)">
                                <div class="combined-input">
                                    <div class="combined-field">
                                        <i class="icon fas fa-plane-departure"></i>
                                        <input class="combo-input" type="text" x-model="origin" @input="filter('origin',$event.target.value)" @focus="focusField='origin'; showSuggest=true; filter('origin',$event.target.value || '')" placeholder="Jakarta (JKTA)">
                                    </div>
                                    <div class="combined-field">
                                        <i class="icon fas fa-plane-arrival"></i>
                                        <input class="combo-input" type="text" x-model="destination" @input="filter('destination',$event.target.value)" @focus="focusField='destination'; showSuggest=true; filter('destination',$event.target.value || '')" placeholder="Singapore (SIN)">
                                    </div>
                                    <div class="center-divider"></div>
                                    <button type="button" class="swap-btn swap-center" @click="spinSwap($event)"><i class="fas fa-arrows-rotate"></i></button>
                                </div>
                                <!-- Airports Suggestion Panel -->
                                <div class="suggest-panel" x-show="showSuggest" x-cloak x-transition>
                                    <div class="suggest-header">
                                        <div class="suggest-title">Your Recent Searches</div>
                                        <button type="button" class="suggest-clear" @click="clearRecents()"><i class="fas fa-eraser"></i> Clear</button>
                                    </div>
                                    <div class="suggest-body" x-show="recentSearches.length">
                                        <template x-for="(r, idx) in recentSearches" :key="r.ts + '-' + idx">
                                            <button type="button" class="suggest-item" @click="selectRecent(r)">
                                                <i class="fas fa-magnifying-glass"></i>
                                                <div>
                                                    <div class="suggest-name">
                                                        <span x-text="r.from + ' → ' + r.to"></span>
                                                    </div>
                                                    <div class="suggest-sub">
                                                        <span x-text="(r.date||'') + (r.cabin ? ' | '+r.cabin : '')"></span>
                                                    </div>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                    <div class="suggest-header">
                                        <div class="suggest-title">Popular Cities or Airports</div>
                                        <button type="button" class="suggest-clear" @click="showSuggest=false"><i class="fas fa-times"></i> Close</button>
                                    </div>
                                    <div class="suggest-body">
                                        <template x-for="item in suggestions[focusField]" :key="(item.code||'ALL') + '-' + item.label">
                                            <button type="button" class="suggest-item" @click="selectSuggestion(item)">
                                                <i class="fas fa-plane"></i>
                                                <div>
                                                    <div class="suggest-name">
                                                        <span x-text="item.label"></span>
                                                        <span class="suggest-code" x-text="item.code"></span>
                                                    </div>
                                                    <div class="suggest-sub">
                                                        <span x-text="item.city"></span><span x-show="item.city && item.country">, </span><span x-text="item.country"></span>
                                                        <template x-if="item.all"><span> (All Airports)</span></template>
                                                    </div>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <!-- Combined dates box -->
                            <div>
                                <div class="combined-input">
                                    <div class="combined-field">
                                        <i class="icon fas fa-calendar-day"></i>
                                        <input class="combo-input" type="text" x-ref="departpicker" x-model="departureDate" readonly placeholder="DD MMM YYYY">
                                    </div>
                                    <div class="combined-field">
                                        <i class="icon fas fa-calendar-day"></i>
                                        <input class="combo-input" type="text" x-ref="returnpicker" x-model="returnDate" :disabled="tripType==='oneway'" readonly placeholder="DD MMM YYYY">
                                    </div>
                                    <div class="center-divider"></div>
                                </div>
                            </div>
                            <!-- Search button -->
                            <div class="flex justify-center items-center">
                                <button type="button" class="search-fab" @click="submitStandard()"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                        <!-- Dropdowns dipindah ke bawah masing-masing chip di atas -->
                    </div>
                    
                    <!-- Hotels Form -->
                    <div x-show="product==='hotels'" x-cloak class="mt-0 hotel-ui">
                        <!-- Stay type chips -->
                        <div class="stay-type" x-data="{ }">
                            <button type="button" class="stay-chip" :class="{'active': stayType==='hotel'}" @click="stayType='hotel'"><i class="fas fa-hotel"></i> <span>Hotels</span></button>
                            <button type="button" class="stay-chip" :class="{'active': stayType==='villa'}" @click="stayType='villa'"><i class="fas fa-building"></i> <span>Villa</span></button>
                            <button type="button" class="stay-chip" :class="{'active': stayType==='apartment'}" @click="stayType='apartment'"><i class="fas fa-city"></i> <span>Apartment</span></button>
                        </div>
                        <div class="combined-labels">
                            <div class="labels-grid"><span>City, destination, or hotel name</span><span>Check-in & Check-out Dates</span></div>
                            <div class="labels-grid"><span>Guests and Rooms</span><span></span></div>
                            <div></div>
                        </div>
                        <div class="search-row-hotels">
                            <div class="relative" @click.outside="hideSuggest(focusField)">
                                <div class="combined-input three">
                                    <!-- Destination -->
                                    <div class="combined-field">
                                        <i class="icon fas fa-location-dot"></i>
                                        <input class="combo-input" type="text" x-model="hotelCity" @input="filter('hotelCity',$event.target.value)" @focus="focusField='hotelCity'; showSuggest=true; filter('hotelCity',$event.target.value||'')" placeholder="City, hotel, place to go">
                                    </div>
                                    <!-- Date range (button lookalike) -->
                                    <div class="combined-field date-field" x-ref="hotelDateField" :class="{'is-open': hotelRangeOpen}">
                                        <i class="icon fas fa-calendar-day"></i>
                                        <button type="button" class="combo-button" @click="openHotelRange()">
                                            <span x-text="hotelDateLabel()"></span>
                                        </button>
                                        <input type="text" x-ref="hotelRange" class="hidden" />
                                    </div>
                                    <!-- Guests & Rooms (button lookalike) -->
                                    <div class="combined-field">
                                        <i class="icon fas fa-user-group"></i>
                                        <div class="relative w-full" x-data="{open:false}">
                                            <button type="button" class="combo-button" @click="open = !open" x-text="hotelGuestsSummary()"></button>
                                            <div class="dropdown-panel" x-show="open" x-cloak @click.outside="open=false" x-transition>
                                                <div class="space-y-2">
                                                    <div class="passenger-row">
                                                        <div class="left"><i class="fas fa-bed"></i><div><div class="type-title">Rooms</div></div></div>
                                                        <div class="counter">
                                                            <button type="button" class="counter-btn" @click="rooms=Math.max(1,rooms-1)"><i class="fas fa-minus"></i></button>
                                                            <span class="count" x-text="rooms"></span>
                                                            <button type="button" class="counter-btn" @click="rooms=Math.min(9,rooms+1)"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="passenger-row">
                                                        <div class="left"><i class="fas fa-user"></i><div><div class="type-title">Guests</div></div></div>
                                                        <div class="counter">
                                                            <button type="button" class="counter-btn" @click="hotelGuests=Math.max(1,hotelGuests-1)"><i class="fas fa-minus"></i></button>
                                                            <span class="count" x-text="hotelGuests"></span>
                                                            <button type="button" class="counter-btn" @click="hotelGuests=Math.min(16,hotelGuests+1)"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3"><button type="button" class="primary-action-button w-full" @click="open=false">Done</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Vertical dividers -->
                                    <div class="v-divider div1"></div>
                                    <div class="v-divider div2"></div>
                                </div>
                                <!-- Suggestions for destination -->
                                <div class="suggest-panel" x-show="showSuggest && focusField==='hotelCity'" x-cloak x-transition>
                                    <div class="suggest-header"><div class="suggest-title">Popular Destinations</div><button type="button" class="suggest-clear" @click="showSuggest=false"><i class="fas fa-times"></i> Close</button></div>
                                    <div class="suggest-body">
                                        <template x-for="item in suggestions[focusField]" :key="(item.code||'CITY') + '-' + item.label">
                                            <button type="button" class="suggest-item" @click="selectSuggestion(item)">
                                                <i class="fas fa-location-dot"></i>
                                                <div>
                                                    <div class="suggest-name"><span x-text="item.city || item.label"></span></div>
                                                    <div class="suggest-sub"><span x-text="item.country"></span></div>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                <button type="button" class="search-fab" @click="submitHotel()"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Trains Form -->
                    <div x-show="product==='trains'" x-cloak class="mt-4">
                        <div class="combined-labels"><div class="labels-grid"><span>From (Station/City)</span><span>To (Station/City)</span></div><div class="labels-grid"><span>Departure date</span><span></span></div><div></div></div>
                        <div class="search-row">
                            <div class="relative" @click.outside="hideSuggest(focusField)">
                                <div class="combined-input">
                                    <div class="combined-field">
                                        <i class="icon fas fa-train"></i>
                                        <input class="combo-input" type="text" x-model="trainFrom" @input="filter('trainFrom',$event.target.value)" @focus="focusField='trainFrom'; showSuggest=true; filter('trainFrom',$event.target.value||'')" placeholder="Origin station or city">
                                    </div>
                                    <div class="combined-field">
                                        <i class="icon fas fa-train"></i>
                                        <input class="combo-input" type="text" x-model="trainTo" @input="filter('trainTo',$event.target.value)" @focus="focusField='trainTo'; showSuggest=true; filter('trainTo',$event.target.value||'')" placeholder="Destination station or city">
                                    </div>
                                    <div class="center-divider"></div>
                                </div>
                                <div class="suggest-panel" x-show="showSuggest && (focusField==='trainFrom' || focusField==='trainTo')" x-cloak x-transition>
                                    <div class="suggest-header"><div class="suggest-title">Popular Cities</div><button type="button" class="suggest-clear" @click="showSuggest=false"><i class="fas fa-times"></i> Close</button></div>
                                    <div class="suggest-body">
                                        <template x-for="item in suggestions[focusField]" :key="(item.code||'CITY') + '-' + item.label">
                                            <button type="button" class="suggest-item" @click="selectSuggestion(item)">
                                                <i class="fas fa-train"></i>
                                                <div>
                                                    <div class="suggest-name"><span x-text="item.city || item.label"></span></div>
                                                    <div class="suggest-sub"><span x-text="item.country"></span></div>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="combined-input">
                                    <div class="combined-field">
                                        <i class="icon fas fa-calendar-day"></i>
                                        <input class="combo-input" type="text" x-ref="trainDate" x-model="trainDate" readonly placeholder="DD MMM YYYY">
                                    </div>
                                    <div class="combined-field">
                                        <i class="icon fas fa-user"></i>
                                        <input class="combo-input" type="number" min="1" max="10" x-model.number="trainPassengers" placeholder="Passengers">
                                    </div>
                                    <div class="center-divider"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                <button type="button" class="search-fab" @click="submitTrains()"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Bus & Travel Form -->
                    <div x-show="product==='bus'" x-cloak class="mt-4">
                        <div class="combined-labels"><div class="labels-grid"><span>From (City/Terminal)</span><span>To (City/Terminal)</span></div><div class="labels-grid"><span>Departure date</span><span></span></div><div></div></div>
                        <div class="search-row">
                            <div class="relative" @click.outside="hideSuggest(focusField)">
                                <div class="combined-input">
                                    <div class="combined-field">
                                        <i class="icon fas fa-bus"></i>
                                        <input class="combo-input" type="text" x-model="busFrom" @input="filter('busFrom',$event.target.value)" @focus="focusField='busFrom'; showSuggest=true; filter('busFrom',$event.target.value||'')" placeholder="Origin city or terminal">
                                    </div>
                                    <div class="combined-field">
                                        <i class="icon fas fa-bus"></i>
                                        <input class="combo-input" type="text" x-model="busTo" @input="filter('busTo',$event.target.value)" @focus="focusField='busTo'; showSuggest=true; filter('busTo',$event.target.value||'')" placeholder="Destination city or terminal">
                                    </div>
                                    <div class="center-divider"></div>
                                </div>
                                <div class="suggest-panel" x-show="showSuggest && (focusField==='busFrom' || focusField==='busTo')" x-cloak x-transition>
                                    <div class="suggest-header"><div class="suggest-title">Popular Cities</div><button type="button" class="suggest-clear" @click="showSuggest=false"><i class="fas fa-times"></i> Close</button></div>
                                    <div class="suggest-body">
                                        <template x-for="item in suggestions[focusField]" :key="(item.code||'CITY') + '-' + item.label">
                                            <button type="button" class="suggest-item" @click="selectSuggestion(item)">
                                                <i class="fas fa-bus"></i>
                                                <div>
                                                    <div class="suggest-name"><span x-text="item.city || item.label"></span></div>
                                                    <div class="suggest-sub"><span x-text="item.country"></span></div>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="combined-input">
                                    <div class="combined-field">
                                        <i class="icon fas fa-calendar-day"></i>
                                        <input class="combo-input" type="text" x-ref="busDate" x-model="busDate" readonly placeholder="DD MMM YYYY">
                                    </div>
                                    <div class="combined-field">
                                        <i class="icon fas fa-user"></i>
                                        <input class="combo-input" type="number" min="1" max="10" x-model.number="busPassengers" placeholder="Passengers">
                                    </div>
                                    <div class="center-divider"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                <button type="button" class="search-fab" @click="submitBus()"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- Multi-city (Flights) -->
                    <div x-show="product==='flights' && mode==='multicity'" x-cloak class="mt-6 space-y-4">
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

                    <!-- Quick Links (Flights only) -->
                    <div class="quick-links mt-6" x-show="product==='flights'" x-cloak>
                        <span class="ql-label">Looking for</span>
                        <a href="#ideas"><i class="fas fa-globe"></i> <span>Discover Flight Ideas</span></a>
                        <a href="#price-alert"><i class="far fa-bell"></i> <span>Price Alert</span></a>
                    </div>
                </div>
                <!-- 4-logo rotator inside hero -->
                <div class="mt-6 flex justify-center" x-data="logoRotator()" :data-product="product" x-init="start(); setProduct($el.getAttribute('data-product'))" x-cloak>
                    <div class="hero-logos-frame">
                        <span class="trusted-label">Trusted by</span>
                        <span class="trusted-divider">|</span>
                        <div class="hero-logos">
                            <template x-for="(logo, idx) in currentSet" :key="idx">
                                <img :src="logo.src" :alt="logo.alt" loading="lazy" x-on:error="$el.style.display='none'">
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    function flightSearch(){
        return {
            // State
            product:'flights',
            mode:'standard', tripType:'oneway', origin:'Jakarta (JKTA)', destination:'Singapore (SIN)', departureDate:'', returnDate:'', travelClass:'Economy',
            passengers:{adult:1,child:0,infant:0}, showPassengers:false, showClass:false, focusField:null, showSuggest:false,
            classes:['Economy','Premium Economy','Business','First Class'],
            // Airports dataset (local + international)
            airports: [
                // Indonesia (local + international)
                {label:'Bandara Internasional Soekarno-Hatta', code:'CGK', city:'Tangerang', country:'Indonesia', popular:true},
                {label:'Bandara Internasional I Gusti Ngurah Rai', code:'DPS', city:'Denpasar', country:'Indonesia', popular:true},
                {label:'Bandara Internasional Juanda', code:'SUB', city:'Sidoarjo', country:'Indonesia'},
                {label:'Bandara Internasional Sultan Hasanuddin', code:'UPG', city:'Makassar', country:'Indonesia'},
                {label:'Bandara Internasional Kualanamu', code:'KNO', city:'Deli Serdang', country:'Indonesia'},
                {label:'Bandara Internasional Yogyakarta', code:'YIA', city:'Kulon Progo', country:'Indonesia'},
                {label:'Bandara Internasional Zainuddin Abdul Madjid', code:'LOP', city:'Lombok Tengah', country:'Indonesia'},
                {label:'Bandara Internasional Sam Ratulangi', code:'MDC', city:'Manado', country:'Indonesia'},
                {label:'Bandara Internasional SAMS Sepinggan', code:'BPN', city:'Balikpapan', country:'Indonesia'},
                {label:'Bandara Internasional Hang Nadim', code:'BTH', city:'Batam', country:'Indonesia'},
                {label:'Bandara Internasional Minangkabau', code:'PDG', city:'Padang Pariaman', country:'Indonesia'},
                {label:'Bandara Internasional Sultan Syarif Kasim II', code:'PKU', city:'Pekanbaru', country:'Indonesia'},
                {label:'Bandara Internasional Kertajati', code:'KJT', city:'Majalengka', country:'Indonesia'},
                // All airports example
                {label:'Kuala Lumpur', code:'', city:'Kuala Lumpur', country:'Malaysia', all:true, popular:true},
                // World famous airports
                {label:'Bandara Changi', code:'SIN', city:'Singapura', country:'Singapura', popular:true},
                {label:'Bandara Internasional Dubai', code:'DXB', city:'Dubai', country:'Uni Emirat Arab', popular:true},
                {label:'Bandara Heathrow', code:'LHR', city:'London', country:'Inggris', popular:true},
                {label:'Bandara Internasional Tokyo (Haneda)', code:'HND', city:'Tokyo', country:'Jepang', popular:true},
                {label:'Bandara Charles de Gaulle', code:'CDG', city:'Paris', country:'Prancis', popular:true},
                {label:'Bandara Internasional Los Angeles', code:'LAX', city:'Los Angeles', country:'Amerika Serikat', popular:true},
                {label:'Bandara Internasional John F. Kennedy', code:'JFK', city:'New York', country:'Amerika Serikat', popular:true},
                {label:'Bandara Schiphol', code:'AMS', city:'Amsterdam', country:'Belanda'},
                {label:'Bandara Internasional Incheon', code:'ICN', city:'Seoul', country:'Korea Selatan'},
                {label:'Bandara Istanbul', code:'IST', city:'Istanbul', country:'Turki'},
                {label:'Bandara Internasional Hong Kong', code:'HKG', city:'Hong Kong', country:'Hong Kong'},
                {label:'Bandara Internasional Hamad', code:'DOH', city:'Doha', country:'Qatar'},
                {label:'Bandara Frankfurt', code:'FRA', city:'Frankfurt', country:'Jerman'},
                {label:'Bandara Internasional Suvarnabhumi', code:'BKK', city:'Bangkok', country:'Thailand'},
                {label:'Bandara Sydney', code:'SYD', city:'Sydney', country:'Australia'},
                {label:'Bandara Internasional Toronto Pearson', code:'YYZ', city:'Toronto', country:'Kanada'},
            ],
            suggestions:{origin:[],destination:[], hotelCity:[], trainFrom:[], trainTo:[], busFrom:[], busTo:[]},
            recentSearches: JSON.parse(localStorage.getItem('recentSearches')||'[]'),
            segments:[{origin:'',destination:'',date:''}],
            // Hotels
            stayType:'hotel', hotelCity:'', hotelCheckIn:'', hotelCheckOut:'', rooms:1, hotelGuests:2, hotelRangeOpen:false,
            // Trains
            trainFrom:'', trainTo:'', trainDate:'', trainPassengers:1,
            // Bus
            busFrom:'', busTo:'', busDate:'', busPassengers:1,
            // Methods
            init(){
                // Default: mark Flights tab active
                window.selectProduct = (name)=>{
                    const ids = {flights:'flightsTab', hotels:'hotelsTab', bus:'busTab'}; // trains removed
                    // buttons
                    Object.values(ids).forEach(id=>{ const el=document.getElementById(id); if(el) el.classList.remove('active'); });
                    // prevent selecting 'trains' which is no longer available
                    if(!ids[name]) { return; }
                    const btn = document.getElementById(ids[name]); if(btn) btn.classList.add('active');
                    this.product = name;
                    this.$nextTick(()=>{
                        this.initPickersForProduct();
                        window.dispatchEvent(new CustomEvent('product:changed', { detail: { product: this.product } }));
                    });
                };
                // First render
                this.initPickersForProduct();
                window.dispatchEvent(new CustomEvent('product:changed', { detail: { product: this.product } }));
            },
            popular(){ return this.airports.filter(a=>a.popular).slice(0,8); },
            filter(field,q){
                const s = (q||'').toLowerCase().trim();
                if(!s){ this.suggestions[field] = this.popular(); return; }
                const matches = this.airports.filter(a=>{
                    return [a.label,a.city,a.country,(a.code||'')].some(v=> (v||'').toLowerCase().includes(s));
                });
                this.suggestions[field] = matches.slice(0,20);
            },
            hideSuggest(field){ setTimeout(()=>{ this.showSuggest=false; this.suggestions[field]=[]; },120); },
            selectSuggestion(item){
                const text = item.all
                    ? `${item.city} (All Airports)`
                    : `${item.city} (${item.code})`;
                if(this.focusField==='origin') this.origin = text;
                else if(this.focusField==='destination') this.destination = text;
                else if(this.focusField==='hotelCity') this.hotelCity = item.city || item.label;
                else if(this.focusField==='trainFrom') this.trainFrom = item.city || item.label;
                else if(this.focusField==='trainTo') this.trainTo = item.city || item.label;
                else if(this.focusField==='busFrom') this.busFrom = item.city || item.label;
                else if(this.focusField==='busTo') this.busTo = item.city || item.label;
                this.showSuggest = false;
            },
            clearRecents(){ this.recentSearches = []; localStorage.setItem('recentSearches','[]'); },
            selectRecent(r){ this.origin = r.from; this.destination = r.to; this.departureDate = r.date||this.departureDate; this.travelClass = r.cabin||this.travelClass; this.showSuggest=false; },
            passengerSummary(){ const p=this.passengers; return `${p.adult} Adult, ${p.child} Child, ${p.infant} Infant (on lap)`; },
            isPlusDisabled(type){ const lim={adult:[1,9],child:[0,8],infant:[0,4]}; return this.passengers[type] >= lim[type][1]; },
            isMinusDisabled(type){ const lim={adult:[1,9],child:[0,8],infant:[0,4]}; return this.passengers[type] <= lim[type][0]; },
            adjust(type,op){ const lim={adult:[1,9],child:[0,8],infant:[0,4]}; if(op==='+' && this.passengers[type]<lim[type][1]) this.passengers[type]++; if(op==='-' && this.passengers[type]>lim[type][0]) this.passengers[type]--; },
            addSegment(){ this.segments.push({origin:'',destination:'',date:''}); },
            removeSegment(i){ this.segments.splice(i,1); },
            initPickers(){ const base={ dateFormat:'Y-m-d', minDate:'today'}; flatpickr(this.$refs.departpicker,{...base,onChange:(d)=>{this.departureDate=d[0].toISOString().split('T')[0];}}); if(this.tripType==='roundtrip'){ flatpickr(this.$refs.returnpicker,{...base,onChange:(d)=>{this.returnDate=d[0].toISOString().split('T')[0];}});} },
            initPickersForProduct(){
                const base={ dateFormat:'Y-m-d', minDate:'today'};
                // Flights
                if(this.$refs.departpicker){ flatpickr(this.$refs.departpicker,{...base,onChange:(d)=>{this.departureDate=d[0].toISOString().split('T')[0];}}); }
                if(this.$refs.returnpicker && this.tripType==='roundtrip'){ flatpickr(this.$refs.returnpicker,{...base,onChange:(d)=>{this.returnDate=d[0].toISOString().split('T')[0];}}); }
                // Hotels: one range picker populating check-in/out
                if(this.$refs.hotelRange){
                    const anchor = this.$refs.hotelDateField || this.$el;
                    const fp = flatpickr(this.$refs.hotelRange,{
                        ...base,
                        mode:'range',
                        showMonths: 2,
                        disableMobile: true,
                        appendTo: document.body,
                        position: 'below',
                        positionElement: anchor,
                        onOpen: ()=>{ this.hotelRangeOpen = true; },
                        onClose: ()=>{ this.hotelRangeOpen = false; },
                        onChange:(dates)=>{
                            if(dates && dates.length){
                                this.hotelCheckIn = dates[0] ? dates[0].toISOString().split('T')[0] : '';
                                this.hotelCheckOut = dates[1] ? dates[1].toISOString().split('T')[0] : '';
                            }
                        }
                    });
                    if(fp && fp.calendarContainer){
                        fp.calendarContainer.classList.add('hotel-range-calendar');
                        // Manually position the calendar under the date field to avoid default top-left placement
                        const place = ()=>{
                            const rect = anchor.getBoundingClientRect();
                            const scrollY = window.scrollY || document.documentElement.scrollTop;
                            const scrollX = window.scrollX || document.documentElement.scrollLeft;
                            fp.calendarContainer.style.position = 'absolute';
                            fp.calendarContainer.style.top = (rect.bottom + scrollY + 8) + 'px';
                            fp.calendarContainer.style.left = (rect.left + scrollX) + 'px';
                            fp.calendarContainer.style.zIndex = 9999;
                        };
                        fp.config.onOpen.push(place);
                        window.addEventListener('resize', place);
                        window.addEventListener('scroll', place, true);
                    }
                }
                if(this.$refs.trainDate){ flatpickr(this.$refs.trainDate,{...base,onChange:(d)=>{this.trainDate=d[0].toISOString().split('T')[0];}}); }
                if(this.$refs.busDate){ flatpickr(this.$refs.busDate,{...base,onChange:(d)=>{this.busDate=d[0].toISOString().split('T')[0];}}); }
            },
            openHotelRange(){ if(this.$refs.hotelRange && this.$refs.hotelRange._flatpickr){ this.$refs.hotelRange._flatpickr.open(); } },
            hotelGuestsSummary(){ const g=this.hotelGuests, r=this.rooms; return `${g} Guest${g>1?'s':''}, ${r} Room${r>1?'s':''}`; },
            hotelDateLabel(){
                if(!this.hotelCheckIn && !this.hotelCheckOut) return 'Check-in - Check-out';
                try{
                    const ci = new Date(this.hotelCheckIn);
                    const co = this.hotelCheckOut ? new Date(this.hotelCheckOut) : null;
                    const fmt = (d,opts)=> d.toLocaleDateString('en-US', opts || { month:'short', day:'numeric' });
                    if(co && ci.getMonth()===co.getMonth() && ci.getFullYear()===co.getFullYear()){
                        return `${fmt(ci)} - ${co.toLocaleDateString('en-US',{ day:'numeric' })}`;
                    }
                    return `${fmt(ci)}${co ? ' - ' + fmt(co) : ''}`;
                }catch(e){
                    return `${this.hotelCheckIn}${this.hotelCheckOut? ' - ' + this.hotelCheckOut: ''}`.trim();
                }
            },
            submitStandard(){
                if(!this.origin||!this.destination||!this.departureDate){ alert('Lengkapi data'); return; }
                // save recent
                const recent = {from:this.origin,to:this.destination,date:this.departureDate,cabin:this.travelClass, ts:Date.now()};
                this.recentSearches = [recent, ...this.recentSearches].slice(0,5);
                localStorage.setItem('recentSearches', JSON.stringify(this.recentSearches));
                // navigate
                const params=new URLSearchParams({type:'flights',from:this.origin,to:this.destination,date:this.departureDate,trip:this.tripType,class:this.travelClass}); if(this.returnDate) params.append('return',this.returnDate); window.location.href='/search?'+params.toString();
            },
            submitMulticity(){ if(this.segments.some(s=>!s.origin||!s.destination||!s.date)){ alert('Lengkapi semua segmen'); return;} const params=new URLSearchParams({type:'flights',multi:JSON.stringify(this.segments),class:this.travelClass, pax:this.passengerSummary()}); window.location.href='/search?'+params.toString(); },
            submitHotel(){ if(!this.hotelCity||!this.hotelCheckIn||!this.hotelCheckOut){ alert('Lengkapi data hotel'); return;} const params=new URLSearchParams({type:'hotels',city:this.hotelCity,checkin:this.hotelCheckIn,checkout:this.hotelCheckOut,rooms:this.rooms,guests:this.hotelGuests}); window.location.href='/search?'+params.toString(); },
            submitTrains(){ if(!this.trainFrom||!this.trainTo||!this.trainDate){ alert('Lengkapi data kereta'); return;} const params=new URLSearchParams({type:'trains',from:this.trainFrom,to:this.trainTo,date:this.trainDate,pax:this.trainPassengers}); window.location.href='/search?'+params.toString(); },
            submitBus(){ if(!this.busFrom||!this.busTo||!this.busDate){ alert('Lengkapi data bus'); return;} const params=new URLSearchParams({type:'bus',from:this.busFrom,to:this.busTo,date:this.busDate,pax:this.busPassengers}); window.location.href='/search?'+params.toString(); },
            spinSwap(evt){
                const icon = evt.currentTarget.querySelector('i');
                if(icon){ icon.classList.remove('spinning'); void icon.offsetWidth; icon.classList.add('spinning'); setTimeout(()=>icon.classList.remove('spinning'), 650); }
                [this.origin, this.destination] = [this.destination, this.origin];
            }
        }
    }
    function logoRotator(){
        return {
            // Filenames per category
            catalog: {
                flights: [
                    'qatar_airways.png',
                    'emirates.png',
                    'batik_air.png',
                    'sriwijaya_air.png',
                    'garuda_indonesia.png',
                    'singapore_airlines.png',
                    'airasia.png',
                    'citilink.png',
                    'lion_air.png',
                    'pelita_air.png',
                ],
                hotels: [
                    'agoda.png',
                    'oyo_rooms.png',
                    'reddoorz.png',
                    'IHG.png',
                    'accor.png',
                    'archipelago.png',
                    'hilton.png',
                    'hyatt.png',
                    'marriot.png',
                    'santika.png',
                    'swissbell.png',
                    'traveloka.png',
                    'plataran.png',
                ],
                trains: [
                    'kai.png',
                    'mrt.png',
                    'whooshh.png',
                ],
                bus: [
                    'rosalia_indah.png',
                    'sinar_jaya.png',
                    'bluebird.png',
                    'harapan_jaya.png',
                    'juragan_99.png',
                    'kramat_jati.png',
                    'white_horse.png',
                    'damri.png',
                ],
            },
            // Map product -> folder name
            folderMap: { flights:'pesawat', hotels:'hotel', trains:'kereta', bus:'bus' },
            category: 'flights',
            index: 0,
            currentSet: [],
            pretty(name){ return name.replace(/_/g,' ').replace(/\.png|\.svg|\.jpg|\.jpeg/gi,'').replace(/\b\w/g, c=>c.toUpperCase()); },
            buildObjs(names, folder){ return names.map(n=>({ src: `/image/${folder}/${n}`, alt: this.pretty(n) })); },
            list(){
                const names = this.catalog[this.category];
                const folder = this.folderMap[this.category] || 'pesawat';
                const fallbackNames = this.catalog['flights'];
                return (names && names.length) ? this.buildObjs(names, folder) : this.buildObjs(fallbackNames, this.folderMap['flights']);
            },
            setProduct(p){ const map={flights:'flights',hotels:'hotels',trains:'trains',bus:'bus'}; const next = map[p] || 'flights'; if(next!==this.category){ this.category = next; this.index = 0; this.render(); } },
            start(){
                this.render();
                this.timer = setInterval(()=>this.next(), 2500);
                // Subscribe to global product changes from the main controller
                window.addEventListener('product:changed', (e)=>{
                    const p = (e && e.detail && e.detail.product) ? e.detail.product : null;
                    if(p) this.setProduct(p);
                });
            },
            next(){ const L = this.list().length || 1; this.index = (this.index + 4) % L; this.render(); },
            render(){ const arr=this.list(); this.currentSet = arr.slice(this.index, this.index + 4); if(this.currentSet.length < 4){ this.currentSet = this.currentSet.concat(arr.slice(0, 4 - this.currentSet.length)); } },
            timer: null,
            stop(){ if(this.timer) clearInterval(this.timer); }
        }
    }
    </script>

    <main class="main-content bg-white relative z-10">
        <div class="py-1 bg-white">
            <div class="max-w-6xl mx-auto">
                <!-- Scroller moved to hero as 4-logo rotator -->
            </div>
        </div>
        <!-- MITRA KAMI section removed; replaced by Coupons below -->

    <!-- Old floating booking section removed (replaced by hero integrated form) -->

        <!-- Coupons Section (referenced UI) -->
    <section id="coupons" class="pt-8 pb-16 bg-white">
            <style>
            /* Ticket-style coupon: navy. Simplified single-column card with bottom dashed divider */
            .coupon-card{position:relative;border-radius:16px;background:linear-gradient(135deg,#0b1430 0%,#112a63 100%);color:#e2e8f0;box-shadow:0 12px 30px -12px rgba(2,24,43,.6);width:100%;max-width:408px;display:grid;grid-template-columns:1fr;overflow:hidden;transition:transform .2s ease, box-shadow .2s ease}
            .coupon-card:hover{transform:translateY(-4px);box-shadow:0 18px 42px -16px rgba(2,24,43,.7)}
            /* Removed side notches on card edges to highlight the divider notches */
            /* Increase padding ~30% to add overall card height */
            .ticket-left{display:flex;flex-direction:column;gap:2px;padding:17px}
            /* Right stub and vertical perforation removed */
            .ticket-perf{display:none}
            .ticket-stub{display:none}
            .ticket-stub .stub-inner{display:none}
            .stub-label{font-weight:800;color:#bfdbfe;letter-spacing:.08em;writing-mode:vertical-rl;transform:rotate(180deg);font-size:13px;opacity:.95}
            .barcode{width:28px;height:52%;min-height:44px;background:repeating-linear-gradient(90deg,#dbeafe 0,#dbeafe 2px,transparent 2px,transparent 4px);border-radius:4px;opacity:.9;transition:opacity .2s ease}
            .coupon-card:hover .barcode{opacity:1}
            .stub-id{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:11px;color:#e5e7eb;background:rgba(255,255,255,.08);padding:2px 6px;border-radius:6px}
            /* Minimal, borderless copy button (no background color) */
            .copy-btn{background:transparent;border:0;color:#93c5fd;padding:0;transition:color .15s ease;text-decoration:none}
            .copy-btn:hover{color:#bfdbfe}
            .copy-btn:active{transform:none}
            .copy-success{font-size:11px;color:#22c55e;margin-top:4px;opacity:0;transform:translateY(-4px);transition:opacity .2s ease, transform .2s ease}
            .copy-success.show{opacity:1;transform:translateY(0)}
            /* Content sizing: keep card compact but ensure inner text remains readable */
            .coupon-card h3{font-size:13px;line-height:1.15}
            .coupon-card p{font-size:11px;line-height:1.15}
            .coupon-card code{font-size:12px}
            /* Emphasized coupon code (JALANYUK) */
            .coupon-code{font-size:14px;font-weight:500}
            .coupon-card .copy-btn{font-size:12px}
            .coupon-card h3,.coupon-card p{overflow-wrap:anywhere}
            .copy-success{font-size:11px}
            /* Green state when code text switches to confirmation */
            .code-copied{color:#22c55e !important;font-weight:700}
            .code-failed{color:#ef4444 !important;font-weight:700}
            /* Coupons heading blue theme */
            .coupon-heading .icon-circle{background:#e0f2fe;color:#0369a1}
            .coupon-heading .coupon-title{color:#0b1430}
            .coupon-heading .coupon-subtitle{color:#000; font-weight: 400;}
            /* Horizontal dashed divider with left/right notches */
            .coupon-hr{position:relative;border-top:1px dashed rgba(255,255,255,.35);margin:10px 0}
            /* Circular edge notches as half-circles at exact card edges */
            .coupon-hr:before,.coupon-hr:after{content:"";position:absolute;top:0;transform:translateY(-50%);width:14px;height:14px;background:#fff;border-radius:9999px}
            /* Place centers on the card edges: padding-left/right is 17px, radius is 7px => offset 17+7 = 24px */
            .coupon-hr:before{left:-24px}
            .coupon-hr:after{right:-24px}
            /* Info icon aligned with title row (right side) */
            .coupon-info{color:#93c5fd;opacity:.9;font-size:13px}
            .coupon-card:hover .coupon-info{opacity:1;color:#bfdbfe}
            /* Explicit icon colors to ensure they don't inherit white */
            .ci-hotel{color:#38bdf8 !important}
            .ci-xp{color:#fb7185 !important}
            .ci-shuttle{color:#2dd4bf !important}
            /* Badge backgrounds and fixed icon size to ensure visibility */
            .ci-badge{width:20px;height:20px;border-radius:9999px;display:inline-flex;align-items:center;justify-content:center}
            .ci-badge-hotel{background:rgba(56,189,248,.18)}
            .ci-badge-xp{background:rgba(244,63,94,.18)}
            .ci-badge-shuttle{background:rgba(45,212,191,.18)}
            .ci-ico{font-size:10px}
            /* New: Bus icon color and badge */
            .ci-bus{color:#f59e0b !important}
            .ci-badge-bus{background:rgba(245,158,11,.18)}
            /* Carousel: hide scrollbar for a cleaner look */
            #couponCarousel{scroll-behavior:smooth}
            #couponCarousel::-webkit-scrollbar{display:none}
            /* Navigation buttons removed per request */
            </style>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-6 coupon-heading">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center icon-circle">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h2 class="text-3xl md:text-[32px] font-extrabold coupon-title">8% New User Coupons</h2>
                    </div>
                    <p class="mt-1 coupon-subtitle">Valid for first transaction on MyTickets App</p>
                </div>

                <!-- Coupons Carousel -->
                <div class="relative">
                    <div id="couponCarousel" class="flex gap-3 overflow-x-auto pb-2" style="-ms-overflow-style:none; scrollbar-width:none;">
                        <!-- Coupon: Hotel 8% -->
                        <div class="coupon-card overflow-hidden flex-shrink-0">
                            <div class="ticket-left p-2.5">
                                <div class="flex items-start">
                                    <div class="flex items-start gap-3 flex-1">
                                        <span class="ci-badge ci-badge-hotel mt-0.5"><i class="fas fa-hotel ci-ico ci-hotel"></i></span>
                                        <div class="flex flex-col gap-0.5">
                                            <h3 class="font-semibold text-white leading-tight">Diskon 8% Hotel</h3>
                                            <p class="text-slate-300 leading-snug">min. transaksi Rp 500rb</p>
                                        </div>
                                    </div>
                                    <i class="fas fa-info-circle coupon-info mt-0.5" title="Info"></i>
                                </div>
                                <div class="coupon-hr"></div>
                                <div class="flex items-center justify-between">
                                    <code id="code-hotel" class="coupon-code font-mono text-slate-100">JALANYUK</code>
                                    <button id="copy-hotel" onclick="copyCoupon('JALANYUK','copy-hotel','msg-hotel','code-hotel')" class="copy-btn font-semibold">Copy</button>
                                </div>
                                <p id="msg-hotel" class="copy-success" aria-live="polite" role="status">Kode berhasil disalin</p>
                            </div>
                        </div>

                        <!-- Coupon: Xperience 8% -->
                        <div class="coupon-card overflow-hidden flex-shrink-0">
                            <div class="ticket-left p-2.5">
                                <div class="flex items-start">
                                    <div class="flex items-start gap-3 flex-1">
                                        <span class="ci-badge ci-badge-xp mt-0.5"><i class="fas fa-ticket-alt ci-ico ci-xp"></i></span>
                                        <div class="flex flex-col gap-0.5">
                                            <h3 class="font-semibold text-white leading-tight">Diskon s.d 8% Xperience</h3>
                                            <p class="text-slate-300 leading-snug">min. transaksi Rp 300rb</p>
                                        </div>
                                    </div>
                                    <i class="fas fa-info-circle coupon-info mt-0.5" title="Info"></i>
                                </div>
                                <div class="coupon-hr"></div>
                                <div class="flex items-center justify-between">
                                    <code id="code-xp" class="coupon-code font-mono text-slate-100">JALANYUK</code>
                                    <button id="copy-xp" onclick="copyCoupon('JALANYUK','copy-xp','msg-xp','code-xp')" class="copy-btn font-semibold">Copy</button>
                                </div>
                                <p id="msg-xp" class="copy-success" aria-live="polite" role="status">Kode berhasil disalin</p>
                            </div>
                        </div>

                        <!-- Coupon: Antar Jemput Bandara 12% -->
                        <div class="coupon-card overflow-hidden flex-shrink-0">
                            <div class="ticket-left p-2.5">
                                <div class="flex items-start">
                                    <div class="flex items-start gap-3 flex-1">
                                        <span class="ci-badge ci-badge-shuttle mt-0.5"><i class="fas fa-shuttle-van ci-ico ci-shuttle"></i></span>
                                        <div class="flex flex-col gap-0.5">
                                            <h3 class="font-semibold text-white leading-tight">Diskon 12% Antar Jemput Bandara</h3>
                                            <p class="text-slate-300 leading-snug">min. transaksi Rp 150rb</p>
                                        </div>
                                    </div>
                                    <i class="fas fa-info-circle coupon-info mt-0.5" title="Info"></i>
                                </div>
                                <div class="coupon-hr"></div>
                                <div class="flex items-center justify-between">
                                    <code id="code-shuttle" class="coupon-code font-mono text-slate-100">JALANYUK</code>
                                    <button id="copy-shuttle" onclick="copyCoupon('JALANYUK','copy-shuttle','msg-shuttle','code-shuttle')" class="copy-btn font-semibold">Copy</button>
                                </div>
                                <p id="msg-shuttle" class="copy-success" aria-live="polite" role="status">Kode berhasil disalin</p>
                            </div>
                        </div>

                        <!-- Coupon: Bus 10% (New) -->
                        <div class="coupon-card overflow-hidden flex-shrink-0">
                            <div class="ticket-left p-2.5">
                                <div class="flex items-start">
                                    <div class="flex items-start gap-3 flex-1">
                                        <span class="ci-badge ci-badge-bus mt-0.5"><i class="fas fa-bus ci-ico ci-bus"></i></span>
                                        <div class="flex flex-col gap-0.5">
                                            <h3 class="font-semibold text-white leading-tight">Diskon 10% Bus</h3>
                                            <p class="text-slate-300 leading-snug">min. transaksi Rp 200rb</p>
                                        </div>
                                    </div>
                                    <i class="fas fa-info-circle coupon-info mt-0.5" title="Info"></i>
                                </div>
                                <div class="coupon-hr"></div>
                                <div class="flex items-center justify-between">
                                    <code id="code-bus" class="coupon-code font-mono text-slate-100">JALANYUK</code>
                                    <button id="copy-bus" onclick="copyCoupon('JALANYUK','copy-bus','msg-bus','code-bus')" class="copy-btn font-semibold">Copy</button>
                                </div>
                                <p id="msg-bus" class="copy-success" aria-live="polite" role="status">Kode berhasil disalin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Optional carousel arrow (decorative) -->
                <div class="hidden lg:block">
                    <!-- Placeholder for future carousel controls -->
                </div>
            </div>
            <script>
            function copyCoupon(code, btnId, msgId, codeId){
                const updateUI = (ok)=>{
                    const btn = document.getElementById(btnId);
                    if(btn){
                        const old = btn.textContent; btn.textContent = ok ? 'Copied' : 'Copy';
                        // Keep button backgroundless; just tint text briefly on success
                        if(ok){ btn.classList.add('text-sky-200'); }
                        setTimeout(()=>{ btn.textContent = old; btn.classList.remove('text-sky-200'); }, 1600);
                    }
                    if(msgId){ const msg = document.getElementById(msgId); if(msg){ msg.classList.add('show'); setTimeout(()=>msg.classList.remove('show'), 1600); } }
                    if(codeId){
                        const c = document.getElementById(codeId);
                        if(c){
                            const prev = c.textContent;
                            if(ok){
                                c.textContent = 'Kode telah disalin'; c.classList.add('code-copied');
                                setTimeout(()=>{ c.textContent = prev; c.classList.remove('code-copied'); }, 1600);
                            } else {
                                c.textContent = prev; c.classList.add('code-failed');
                                setTimeout(()=>{ c.classList.remove('code-failed'); }, 1600);
                            }
                        }
                    }
                };

                const legacyCopy = ()=>{
                    try{
                        const ta = document.createElement('textarea');
                        ta.value = code; ta.setAttribute('readonly',''); ta.style.position = 'fixed'; ta.style.top = '-1000px'; ta.style.opacity = '0';
                        document.body.appendChild(ta); ta.select(); ta.setSelectionRange(0, code.length);
                        const ok = document.execCommand && document.execCommand('copy');
                        document.body.removeChild(ta);
                        updateUI(!!ok);
                    }catch(err){ updateUI(false); }
                };

                try{
                    if(navigator.clipboard && typeof navigator.clipboard.writeText === 'function'){
                        navigator.clipboard.writeText(code).then(()=>updateUI(true)).catch(()=>legacyCopy());
                    } else {
                        legacyCopy();
                    }
                }catch(e){
                    // No alerts; fallback gracefully
                    legacyCopy();
                }
            }
            // Carousel navigation buttons removed; horizontal scroll still available via touch/trackpad/mouse.
            </script>
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
                        if (data.debug_otp) {
                            console.log('DEBUG OTP (local env):', data.debug_otp);
                        }
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
                        // Surface detailed error from server (available when APP_DEBUG=true)
                        const detail = data && data.error ? `\n\nDetail: ${data.error}` : '';
                        alert((data.message || 'Failed to send OTP. Please try again.') + detail);
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
                        const detail = data && data.error ? `\n\nDetail: ${data.error}` : '';
                        alert((data.message || 'Failed to resend OTP. Please try again.') + detail);
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
