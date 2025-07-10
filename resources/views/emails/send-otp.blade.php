<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e5e7eb;
        }
        .otp-code {
            background-color: #4f46e5;
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            letter-spacing: 8px;
        }
        .footer {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-top: 20px;
        }
        .warning {
            background-color: #fef3c7;
            color: #92400e;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #f59e0b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>MyTickets</h1>
        <p>Verifikasi Akun Anda</p>
    </div>
    
    <div class="content">
        <h2>Halo, {{ $userName }}!</h2>
        
        <p>Terima kasih telah mendaftar di MyTickets. Untuk melengkapi proses registrasi Anda, silakan gunakan kode verifikasi OTP berikut:</p>
        
        <div class="otp-code">
            {{ $otpCode }}
        </div>
        
        <div class="warning">
            <strong>Penting:</strong>
            <ul>
                <li>Kode OTP ini berlaku selama <strong>10 menit</strong></li>
                <li>Jangan bagikan kode ini kepada siapa pun</li>
                <li>Jika Anda tidak meminta kode ini, abaikan email ini</li>
            </ul>
        </div>
        
        <p>Masukkan kode verifikasi di halaman registrasi untuk mengaktifkan akun Anda dan mulai memesan tiket transportasi serta hotel dengan mudah.</p>
        
        <p>Jika Anda mengalami kesulitan, jangan ragu untuk menghubungi tim dukungan kami.</p>
        
        <p>Salam,<br>Tim MyTickets</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon jangan balas email ini.</p>
        <p>&copy; {{ date('Y') }} MyTickets. All rights reserved.</p>
    </div>
</body>
</html>
