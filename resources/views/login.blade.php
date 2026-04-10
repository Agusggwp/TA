<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Posyandu</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <!-- CONTAINER -->
        <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden flex">
            <!-- LEFT SECTION: FORM -->
            <div class="login-left w-full md:w-1/2 flex items-center justify-center px-6 md:px-12 py-12 bg-white">
                <div class="w-full max-w-md">
                    <!-- HEADER -->
                    <div class="mb-12">
                        <h1 class="text-5xl font-bold text-gray-900 mb-2 leading-tight">Holla,<br><span class="gradient-text">Welcome Back</span></h1>
                        <p class="text-gray-600 text-base mt-4 leading-relaxed">Silakan masuk ke akun Anda untuk melanjutkan pengelolaan kesehatan keluarga</p>
                    </div>

                    <!-- Alert Messages -->
                    @if ($errors->any())
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal!',
                                html: `
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                `,
                                confirmButtonColor: '#0f766e'
                            });
                        </script>
                    @endif

                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: '{{ session('success') }}',
                                timer: 2000,
                                timerProgressBar: true,
                                confirmButtonColor: '#0f766e'
                            });
                        </script>
                    @endif

                    <!-- LOGIN FORM -->
                    <form method="POST" action="{{ route('authenticate') }}" class="space-y-6" onsubmit="handleLogin(event)">
                        @csrf

                        <!-- EMAIL -->
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input 
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="masukkan@email.com"
                                class="form-input @error('email') border-red-500 @enderror"
                                required
                            >
                            @error('email')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PASSWORD -->
                        <div class="form-group">
                            <div class="flex items-center justify-between mb-2">
                                <label class="form-label m-0">Password</label>
                                <a href="#" class="forgot-link">Lupa Password?</a>
                            </div>
                            <input 
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                class="form-input @error('password') border-red-500 @enderror"
                                required
                            >
                            @error('password')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- REMEMBER ME -->
                        <div class="checkbox-wrapper">
                            <input 
                                type="checkbox" 
                                id="remember"
                                name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                            >
                            <label for="remember" class="text-sm text-gray-700">Ingat saya</label>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <button 
                            type="submit"
                            class="btn-login w-full py-3 px-4 rounded-lg text-white font-semibold text-lg hover:shadow-lg active:scale-95 transition-all duration-200"
                        >
                            Masuk
                        </button>
                    </form>

                    <!-- DIVIDER -->
                    <div class="my-8 flex items-center gap-4">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-gray-500 text-sm">atau</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    <!-- FOOTER -->
                    <p class="text-center text-gray-600 text-sm">
                        &copy; 2026 Posyandu. Semua hak dilindungi.
                    </p>
                </div>
            </div>

            <!-- RIGHT SECTION: ILLUSTRATION -->
            <div class="hidden md:flex login-right w-1/2 relative items-center justify-center overflow-hidden">
                <!-- Background Image -->
                <img src="{{ asset('TAMPALATE/login.webp') }}" alt="Welcome" class="absolute inset-0 w-full h-full object-cover">
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-900/40 to-blue-900/40"></div>

                <!-- Center Logo/Icon -->
                <div class="text-center z-10">
                    <div class="inline-block mb-8">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-2xl">
                            <iconify-icon icon="mdi:hospital-box" style="font-size: 4rem; color: #9333ea;"></iconify-icon>
                        </div>
                    </div>
                    <h2 class="text-white text-4xl font-bold mb-2">Posyandu</h2>
                    <p class="text-white text-lg opacity-90">Sistem Informasi Kesehatan Keluarga</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleLogin(event) {
            Swal.fire({
                title: 'Memproses Login...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }
    </script>
</body>
</html>
</body>
</html>

