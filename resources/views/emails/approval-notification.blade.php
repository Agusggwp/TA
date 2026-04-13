<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Disetujui - Posyandu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background: linear-gradient(135deg, #f0ebf8 0%, #f5f7fa 50%, #e8f4f8 100%);
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .email-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .email-header p {
            font-size: 16px;
            opacity: 0.95;
        }
        .email-body {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            font-size: 15px;
            color: #4b5563;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        .info-box {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
            border-left: 4px solid #10b981;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .info-label {
            font-size: 12px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 600;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 14px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            transition: all 0.3s;
        }
        .cta-button:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }
        .steps {
            margin: 30px 0;
        }
        .step {
            display: flex;
            margin-bottom: 20px;
        }
        .step-number {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .step-content {
            flex: 1;
            padding-top: 5px;
        }
        .step-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }
        .step-desc {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
        }
        .email-footer {
            background: #f9fafb;
            padding: 30px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
        .footer-link {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }
        .timeline {
            margin: 30px 0;
            position: relative;
        }
        .timeline-item {
            display: flex;
            margin-bottom: 20px;
            position: relative;
        }
        .timeline-item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 19px;
            top: 50px;
            width: 2px;
            height: 50px;
            background: #e5e7eb;
        }
        .timeline-dot {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }
        .timeline-content {
            flex: 1;
            padding-left: 20px;
            padding-top: 5px;
        }
        .timeline-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 3px;
        }
        .timeline-date {
            font-size: 12px;
            color: #9ca3af;
        }
        .highlight {
            background: linear-gradient(120deg, #fef3c7, #fcd34d);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- HEADER -->
        <div class="email-header">
            <h1>🎉 Akun Disetujui!</h1>
            <p>Selamat, pendaftaran Anda telah diterima</p>
        </div>

        <!-- BODY -->
        <div class="email-body">
            <div class="greeting">Halo {{ $kepalaKeluarga->nama_lengkap }},</div>
            
            <div class="message">
                Kami dengan senang hati memberitahu bahwa akun Anda sebagai <span class="highlight">Kepala Keluarga</span> telah <strong>disetujui oleh administrator</strong> Posyandu. 
            </div>

            <div class="info-box">
                <div class="info-label">📧 Email Akun</div>
                <div class="info-value">{{ $kepalaKeluarga->email }}</div>
            </div>

            <div class="message">
                Anda sekarang dapat mengakses sistem dengan akun Anda dan melihat informasi kesehatan keluarga yang telah terdaftar.
            </div>

            <!-- STEPS -->
            <div class="steps">
                <h3 style="color: #1f2937; margin-bottom: 20px; font-size: 16px;">✅ Langkah Selanjutnya:</h3>
                
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <div class="step-title">Login ke Sistem</div>
                        <div class="step-desc">Gunakan email dan password Anda untuk login ke portal Kepala Keluarga</div>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <div class="step-title">Lihat Data Keluarga</div>
                        <div class="step-desc">Akses data anggota keluarga dan riwayat kesehatan mereka</div>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <div class="step-title">Kelola Informasi</div>
                        <div class="step-desc">Update data keluarga dan pantau perkembangan kesehatan</div>
                    </div>
                </div>
            </div>

            <center>
                <a href="{{ url('/keluarga/login') }}" class="cta-button">Login ke Akun Saya</a>
            </center>

            <div class="message" style="margin-top: 40px; text-align: center; color: #9ca3af; font-size: 14px;">
                Jika Anda memiliki pertanyaan, silakan hubungi tim support kami.
            </div>
        </div>

        <!-- FOOTER -->
        <div class="email-footer">
            <p>© 2024 Sistem Informasi Kesehatan Keluarga (Posyandu). Semua hak dilindungi.</p>
            <p style="margin-top: 15px;">
                Alamat: Kantor Posyandu | 
                <a href="mailto:info@posyandu.local" class="footer-link">info@posyandu.local</a>
            </p>
        </div>
    </div>
</body>
</html>
