<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Posyandu</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            padding: 30px 20px;
        }

        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .message {
            font-size: 14px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .verification-box {
            background-color: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .verification-box p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .verification-box .warning {
            color: #d97706;
            font-weight: 600;
            margin-top: 10px;
        }

        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .button:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3e8a 100%);
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .alt-link {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            color: #667eea;
            padding: 10px 20px;
            margin-top: 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
            word-break: break-all;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #e5e7eb;
        }

        .step-list {
            background-color: #f0f4ff;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .step-list ol {
            margin: 0;
            padding-left: 20px;
            font-size: 13px;
        }

        .step-list li {
            margin: 8px 0;
            color: #555;
        }

        .expires {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px 15px;
            border-radius: 4px;
            font-size: 12px;
            color: #92400e;
            margin: 15px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>Posyandu</h1>
        <p style="margin: 5px 0 0 0; font-size: 13px;">Sistem Informasi Kesehatan Keluarga</p>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="greeting">
            Halo <strong>{{ $kepalaKeluarga->nama_lengkap }}</strong>,
        </div>

        <div class="message">
            Terima kasih telah mendaftar di Posyandu! Untuk melengkapi proses pendaftaran, Anda perlu memverifikasi alamat email Anda.
        </div>

        <div class="button-container">
            <a href="{{ $verificationUrl }}" class="button">
                ✓ Verifikasi Email Saya
            </a>
        </div>

        <div class="verification-box">
            <p><strong>Atau salin link ini di browser Anda:</strong></p>
            <a href="{{ $verificationUrl }}" class="alt-link">{{ $verificationUrl }}</a>
        </div>

        <div class="step-list">
            <p style="margin: 0 0 10px 0; font-weight: 600; color: #333;">Yang perlu Anda lakukan:</p>
            <ol>
                <li>Klik tombol "Verifikasi Email Saya" di atas</li>
                <li>Email Anda akan terverifikasi secara otomatis</li>
                <li>Tunggu persetujuan dari admin Posyandu</li>
                <li>Setelah disetujui, Anda bisa login dan menggunakan sistem</li>
            </ol>
        </div>

        <div class="expires">
            <strong>⏱ Link verifikasi ini akan berlaku selama 24 jam.</strong> Jika link sudah expired, Anda bisa meminta pengiriman ulang dari halaman login.
        </div>

        <div class="message" style="font-size: 13px; color: #888; border-top: 1px solid #e5e7eb; padding-top: 15px;">
            Jika Anda tidak mendaftar di Posyandu, abaikan email ini atau hubungi admin.
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p style="margin: 0;">© {{ date('Y') }} Posyandu. Semua hak dilindungi.</p>
        <p style="margin: 5px 0 0 0;">Jangan reply email ini, hubungi admin jika ada pertanyaan.</p>
    </div>
</div>
</body>
</html>
