<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Test</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .header h1 {
            color: #0ea5e9;
            font-size: 3rem;
            margin-bottom: 10px;
        }
        .header p {
            color: #666;
            font-size: 1.2rem;
        }
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }
        .nav-links a {
            background: #0ea5e9;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
        }
        .nav-links a:hover {
            background: #0284c7;
        }
        .hero-image {
            width: 100%;
            height: 400px;
            background: url('/images/bromo.jpg') center/cover;
            border-radius: 10px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-text {
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }
        .service-card {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        .service-card h3 {
            color: #0ea5e9;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>MyTickets</h1>
            <p>Platform Booking Tiket Terpercaya</p>
        </div>
        
        <div class="nav-links">
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
        
        <div class="hero-image">
            <div class="hero-text">
                <h2>Jelajahi Dunia Bersama MyTickets</h2>
                <p>Booking tiket pesawat, kereta, bus, dan hotel dengan mudah</p>
            </div>
        </div>
        
        <div class="services">
            <div class="service-card">
                <h3>Tiket Pesawat</h3>
                <p>Terbang ke seluruh dunia dengan harga terbaik</p>
            </div>
            <div class="service-card">
                <h3>Tiket Kereta</h3>
                <p>Perjalanan nyaman dengan kereta api</p>
            </div>
            <div class="service-card">
                <h3>Tiket Bus</h3>
                <p>Bus premium untuk perjalanan antar kota</p>
            </div>
            <div class="service-card">
                <h3>Hotel</h3>
                <p>Akomodasi terbaik di seluruh dunia</p>
            </div>
        </div>
    </div>
</body>
</html>
