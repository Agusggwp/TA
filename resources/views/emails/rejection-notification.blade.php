<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Pendaftaran - Posyandu</title>
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
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(220, 38, 38, 0.05) 100%);
            border-left: 4px solid #ef4444;
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
        .reason-box {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .reason-title {
            font-weight: 600;
            color: #991b1b;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .reason-text {
            color: #7f1d1d;
            font-size: 14px;
            line-height: 1.6;
        }
        .next-steps {
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .next-steps-title {
            font-weight: 600;
            color: #166534;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .step-item {
            margin-bottom: 12px;
            padding-left: 20px;
            position: relative;
            color: #15803d;
            font-size: 14px;
        }
        .step-item::before {
            content: '✓';
            position: absolute;
            left: 0;
            font-weight: 700;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 14px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s;
        }
        .cta-button:hover {
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
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
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
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
            <h1>⸻ Pembaruan Status</h1>
            <p>Informasi penting tentang pendaftaran Anda</p>
        </div>

        <!-- BODY -->
        <div class="email-body">
            <div class="greeting">Halo {{ $kepalaKeluarga->nama_lengkap }},</div>
            
            <div class="message">
                Terima kasih telah melakukan pendaftaran sebagai <span class="highlight">Kepala Keluarga</span> di Posyandu. Kami telah meninjau aplikasi Anda dengan cermat.
            </div>

            <div class="info-box">
                <div class="info-label">📧 Email Akun</div>
                <div class="info-value">{{ $kepalaKeluarga->email }}</div>
            </div>

            <div class="message" style="color: #dc2626; font-weight: 600;">
                Sayangnya, pendaftaran akun Anda <strong>belum dapat kami setujui pada saat ini</strong>.
            </div>

            @if($reason)
                <div class="reason-box">
                    <div class="reason-title">📋 Alasan Penolakan:</div>
                    <div class="reason-text">
                        {{ $reason }}
                    </div>
                </div>
            @endif

            <div class="next-steps">
                <div class="next-steps-title">✅ Langkah Selanjutnya:</div>
                <ul style="list-style: none;">
                    <li class="step-item">Periksa kembali data yang Anda masukkan</li>
                    <li class="step-item">Pastikan semua informasi sudah benar dan lengkap</li>
                    <li class="step-item">Hubungi tim support jika ada pertanyaan</li>
                    <li class="step-item">Anda dapat mendaftar ulang setelah memperbaiki data</li>
                </ul>
            </div>

            <div class="message">
                Kami menyarankan Anda untuk menghubungi tim support kami jika memiliki pertanyaan atau memerlukan bantuan lebih lanjut dalam proses pendaftaran.
            </div>

            <center>
                <a href="mailto:info@posyandu.local?subject=Pertanyaan%20Pendaftaran%20Kepala%20Keluarga" class="cta-button">Hubungi Support</a>
            </center>

            <div class="message" style="margin-top: 40px; text-align: center; color: #9ca3af; font-size: 14px;">
                Terima kasih atas pemahaman Anda. Kami berkomitmen untuk memberikan layanan terbaik.
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
