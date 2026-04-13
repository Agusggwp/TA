<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Posyandu Kepala Keluarga</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="flex min-h-screen">
    <!-- Left Side - Form -->
    <div class="login-left w-full md:w-1/2 flex flex-col justify-center px-8 md:px-16 py-12 bg-white">
        <div class="w-full max-w-md mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
                <p class="text-gray-600">Masuk ke akun Kepala Keluarga Anda</p>
            </div>

            <!-- Form Login -->
            <form action="{{ route('keluarga.authenticate') }}" method="POST" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        placeholder="Masukkan email Anda"
                        required
                    />
                    @error('email')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor KK -->
                <div class="mb-6">
                    <label for="no_kk" class="block text-gray-700 font-semibold mb-2">
                        Nomor KK (Kartu Keluarga)
                    </label>
                    <input
                        type="text"
                        id="no_kk"
                        name="no_kk"
                        value="{{ old('no_kk') }}"
                        class="w-full px-4 py-3 border @error('no_kk') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        placeholder="Masukkan nomor KK Anda"
                        required
                    />
                    @error('no_kk')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Button Login -->
                <button
                    type="submit"
                    class="btn-login w-full py-3 px-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 transition duration-200"
                >
                    Masuk
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-gray-600 text-sm">
                    Belum punya akun? <a href="#" class="text-blue-500 font-semibold hover:underline">Hubungi admin</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Right Side - Image -->
    <div class="login-right hidden md:flex w-1/2 bg-gradient-to-br from-blue-500 to-blue-700 items-center justify-center relative">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        <div class="relative z-10 text-center text-white px-8">
            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-6">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <h2 class="text-3xl font-bold mb-4">Posyandu</h2>
            <p class="text-lg mb-2">Sistem Informasi Kesehatan Keluarga</p>
            <p class="text-blue-100">Kelola data kesehatan keluarga Anda dengan mudah</p>
        </div>
    </div>
</div>


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
