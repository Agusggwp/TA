<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Posyandu</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #f0ebf8 0%, #f5f7fa 50%, #e8f4f8 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .verification-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fbfd 100%);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(78, 3, 131, 0.05);
            max-width: 500px;
            width: 100%;
            padding: 60px 40px;
            text-align: center;
        }

        .verification-icon {
            font-size: 80px;
            color: #4e0383;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .verification-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 15px;
        }

        .verification-text {
            font-size: 16px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .step-list {
            text-align: left;
            background: #f3f4f6;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .step-list ol {
            margin: 0;
            padding-left: 24px;
        }

        .step-list li {
            margin-bottom: 12px;
            color: #374151;
        }

        .step-list strong {
            color: #1f2937;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e0383 0%, #6b2ba8 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3a025c 0%, #5a1f8a 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(78, 3, 131, 0.3);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .info-box {
            background: #dbeafe;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: left;
        }

        .info-box p {
            margin: 0;
            color: #1e40af;
            font-size: 14px;
        }

        .resend-form {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .resend-form p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .resend-form input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .resend-form button {
            width: 100%;
            padding: 10px;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            color: #374151;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .resend-form button:hover {
            background: #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="verification-card">
        <!-- Icon -->
        <div class="verification-icon">
            <i class="fas fa-envelope-circle-check"></i>
        </div>

        <!-- Title -->
        <h1 class="verification-title">Registrasi Berhasil!</h1>

        <!-- Message -->
        <p class="verification-text">
            Terima kasih telah mendaftar. Silakan verifikasi email Anda untuk melanjutkan proses registrasi.
        </p>

        <!-- Steps -->
        <div class="step-list">
            <ol>
                <li>Buka email <strong>{{ old('email', 'email Anda') }}</strong></li>
                <li>Klik link verifikasi yang kami kirimkan</li>
                <li>Email Anda akan terverifikasi secara otomatis</li>
                <li>Tunggu approval dari admin untuk dapat login</li>
            </ol>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <p>
                <strong><i class="fas fa-info-circle"></i> Link verifikasi valid selama 24 jam.</strong>
                Link akan expired jika tidak digunakan dalam waktu tersebut.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('keluarga.login') }}" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Ke Login
            </a>
            <a href="{{ route('keluarga.register') }}" class="btn btn-secondary">
                <i class="fas fa-home"></i> Beranda
            </a>
        </div>

        <!-- Resend Email Form -->
        <div class="resend-form">
            <p>Tidak menerima email? Kirim ulang link verifikasi:</p>
            <form method="POST" action="{{ route('keluarga.resend-verification') }}">
                @csrf
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Masukkan email Anda" 
                    required
                />
                <button type="submit">
                    <i class="fas fa-redo"></i> Kirim Ulang Link Verifikasi
                </button>
            </form>
            @if ($message = session('success'))
                <div style="color: #059669; background: #ecfdf5; border-left: 4px solid #10b981; padding: 12px; border-radius: 6px; margin-top: 10px; font-size: 14px;">
                    <i class="fas fa-check-circle"></i> {{ $message }}
                </div>
            @endif
            @if ($message = session('info'))
                <div style="color: #0369a1; background: #f0f9ff; border-left: 4px solid #0284c7; padding: 12px; border-radius: 6px; margin-top: 10px; font-size: 14px;">
                    <i class="fas fa-info-circle"></i> {{ $message }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>
