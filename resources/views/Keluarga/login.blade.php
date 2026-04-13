<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Posyandu Kepala Keluarga</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        .login-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
            background: white;
        }

        .login-left-content {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #6b7280;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f9fafb;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background-color: #fafbfc;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-group input.error {
            border-color: #ef4444;
        }

        .error-text {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .input-group {
            position: relative;
        }

        .input-group-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            padding: 12px 20px !important;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3e8a 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .login-footer {
            margin-top: 25px;
            text-align: center;
        }

        .login-footer p {
            color: #6b7280;
            font-size: 14px;
        }

        .login-footer a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .login-right {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-right::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(100px, -100px);
        }

        .login-right::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-100px, 100px);
        }

        .login-right-content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 40px;
        }

        .login-right-content svg {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
        }

        .login-right-content h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .login-right-content p {
            font-size: 15px;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        .alert-check-email {
            background-color: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-right {
                display: none;
            }

            .login-left {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
<div class="login-container">
    <!-- Left Side - Form -->
    <div class="login-left">
        <div class="login-left-content">
            <!-- Header -->
            <div class="login-header">
                <h1>Selamat Datang</h1>
                <p>Masuk ke akun Kepala Keluarga Anda</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <strong><i class="fas fa-exclamation-circle"></i> Login Gagal</strong>
                    <ul style="margin: 8px 0 0 20px; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error_not_verified'))
                <div class="alert alert-check-email">
                    <strong><i class="fas fa-exclamation-triangle"></i> Email Belum Diverifikasi</strong><br>
                    <p style="margin: 8px 0 0 0; line-height: 1.5;">
                        Silakan cek email Anda di <strong>{{ session('error_not_verified.email') }}</strong> untuk link verifikasi.
                        Tidak menemukan email? 
                        <a href="{{ route('keluarga.register') }}" style="color: inherit; font-weight: 600; text-decoration: underline;">Kirim ulang link</a>
                    </p>
                </div>
            @endif

            @if (session('error_not_approved'))
                <div class="alert alert-warning">
                    <strong><i class="fas fa-hourglass-half"></i> Menunggu Persetujuan Admin</strong><br>
                    <p style="margin: 8px 0 0 0;">
                        Email Anda sudah diverifikasi, namun akun masih menunggu persetujuan admin. Anda akan menerima email saat akun sudah disetujui.
                    </p>
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('keluarga.authenticate') }}" method="POST" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email Anda"
                            required
                            class="@error('email') error @enderror"
                        />
                        <span class="input-group-icon"><i class="fas fa-envelope"></i></span>
                    </div>
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password Anda"
                            required
                            class="@error('password') error @enderror"
                        />
                        <span class="input-group-icon" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Button Login -->
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p>Belum punya akun? <a href="{{ route('keluarga.register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>

    <!-- Right Side - Image -->
    <div class="login-right">
        <div class="login-right-content">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <h2>Posyandu</h2>
            <p>Sistem Informasi Kesehatan Keluarga</p>
            <p style="opacity: 0.8;">Kelola data kesehatan keluarga Anda dengan mudah</p>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = event.target.closest('.input-group-icon').querySelector('i');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Login',
            text: 'Memproses login Anda...',
            allowOutsideClick: false,
            didOpen: (modal) => {
                Swal.showLoading();
                this.submit();
            }
        });
    });
</script>
</body>
</html>


<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Verifikasi',
            text: 'Memverifikasi data Anda...',
            allowOutsideClick: false,
            didOpen: (modal) => {
                Swal.showLoading();
                this.submit();
            }
        });
    });
</script>
</body>
</html>
