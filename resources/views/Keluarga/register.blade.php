<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Posyandu Kepala Keluarga</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f0ebf8 0%, #f5f7fa 50%, #e8f4f8 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            min-height: 100vh;
        }

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fbfd 100%);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(78, 3, 131, 0.05);
            max-width: 600px;
            width: 100%;
            overflow: hidden;
        }

        .register-header {
            background: linear-gradient(135deg, #4e0383 0%, #6b2ba8 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .register-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .register-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .register-body {
            padding: 40px 30px;
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

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f9fafb;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4e0383;
            background-color: #fafbfc;
            box-shadow: 0 0 0 4px rgba(78, 3, 131, 0.08);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-grid-full {
            grid-column: 1 / -1;
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
        }

        .error-text {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .btn-register {
            background: linear-gradient(135deg, #4e0383 0%, #6b2ba8 100%);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #3a025c 0%, #5a1f8a 100%);
            box-shadow: 0 8px 20px rgba(78, 3, 131, 0.3);
            transform: translateY(-2px);
        }

        .register-footer {
            padding: 0 30px 30px;
            text-align: center;
        }

        .register-footer p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .register-footer a {
            color: #4e0383;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-footer a:hover {
            color: #3a025c;
            text-decoration: underline;
        }

        .field-icon {
            font-size: 14px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-info {
            background-color: #dbeafe;
            color: #1e3a8a;
            border-left: 4px solid #3b82f6;
        }

        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <h1><i class="fas fa-user-plus"></i> Registrasi</h1>
                <p>Buat akun Kepala Keluarga Anda</p>
            </div>

            <!-- Body -->
            <div class="register-body">
                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Terjadi kesalahan:</strong>
                        <ul style="margin: 8px 0 0 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('keluarga.register-store') }}" id="registerForm">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                        <div class="input-group">
                            <input
                                type="text"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                value="{{ old('nama_lengkap') }}"
                                placeholder="Masukkan nama lengkap Anda"
                                required
                                class="@error('nama_lengkap') border-red-500 @enderror"
                            />
                            <span class="input-group-icon"><i class="fas fa-user field-icon"></i></span>
                        </div>
                        @error('nama_lengkap')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email & NIK (2 column) -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="email">Email <span style="color: #ef4444;">*</span></label>
                            <div class="input-group">
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Masukkan email Anda"
                                    required
                                    class="@error('email') border-red-500 @enderror"
                                />
                                <span class="input-group-icon"><i class="fas fa-envelope field-icon"></i></span>
                            </div>
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_nik">Nomor NIK <span style="color: #ef4444;">*</span></label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    id="no_nik"
                                    name="no_nik"
                                    value="{{ old('no_nik') }}"
                                    placeholder="Masukkan 16 digit NIK"
                                    maxlength="16"
                                    required
                                    class="@error('no_nik') border-red-500 @enderror"
                                />
                                <span class="input-group-icon"><i class="fas fa-id-card field-icon"></i></span>
                            </div>
                            @error('no_nik')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- No KK & No Telepon (2 column) -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="no_kk">Nomor KK <span style="color: #ef4444;">*</span></label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    id="no_kk"
                                    name="no_kk"
                                    value="{{ old('no_kk') }}"
                                    placeholder="Nomor KK"
                                    required
                                    class="@error('no_kk') border-red-500 @enderror"
                                />
                                <span class="input-group-icon"><i class="fas fa-home field-icon"></i></span>
                            </div>
                            @error('no_kk')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_telepon">No. Telepon <span style="color: #ef4444;">*</span></label>
                            <div class="input-group">
                                <input
                                    type="tel"
                                    id="no_telepon"
                                    name="no_telepon"
                                    value="{{ old('no_telepon') }}"
                                    placeholder="Nomor telepon aktif"
                                    required
                                    class="@error('no_telepon') border-red-500 @enderror"
                                />
                                <span class="input-group-icon"><i class="fas fa-phone field-icon"></i></span>
                            </div>
                            @error('no_telepon')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat (full width) -->
                    <div class="form-group form-grid-full">
                        <label for="alamat">Alamat <span style="color: #ef4444;">*</span></label>
                        <textarea
                            id="alamat"
                            name="alamat"
                            placeholder="Masukkan alamat lengkap"
                            required
                            rows="3"
                            style="padding: 12px 14px; border: 1.5px solid #e5e7eb; border-radius: 10px; width: 100%; font-size: 14px; font-family: inherit; background-color: #f9fafb; resize: vertical;"
                            class="@error('alamat') border-red-500 @enderror"
                        ></textarea>
                        @error('alamat')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password & Confirm (2 column) -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="password">Password <span style="color: #ef4444;">*</span></label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Minimal 8 karakter"
                                    required
                                    class="@error('password') border-red-500 @enderror"
                                />
                                <span class="input-group-icon password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye field-icon"></i>
                                </span>
                            </div>
                            @error('password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password <span style="color: #ef4444;">*</span></label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Ulangi password"
                                    required
                                    class="@error('password_confirmation') border-red-500 @enderror"
                                />
                                <span class="input-group-icon password-toggle" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye field-icon"></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-register">
                        <i class="fas fa-check-circle"></i> Daftar
                    </button>
                </form>

                <!-- Info Alert -->
                <div class="alert alert-info" style="margin-top: 20px;">
                    <strong><i class="fas fa-info-circle"></i> Perhatian:</strong>
                    <ul style="margin: 8px 0 0 20px;">
                        <li>Pastikan data yang Anda masukkan sudah benar</li>
                        <li>NIK harus 16 digit</li>
                        <li>Email akan digunakan untuk verifikasi akun</li>
                        <li>Akun Anda perlu persetujuan admin sebelum dapat login</li>
                    </ul>
                </div>
            </div>

            <!-- Footer -->
            <div class="register-footer">
                <p>Sudah punya akun? <a href="{{ route('keluarga.login') }}">Login di sini</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = event.target.closest('.password-toggle').querySelector('i');
            
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

        // NIK validation - only numbers
        document.getElementById('no_nik').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html>
