<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Posyandu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <!-- Logo / Header -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Posyandu</h2>
                <p class="mt-2 text-gray-600">Sistem Informasi Posyandu</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Masuk ke Akun Anda</h3>

                <!-- Form -->
                <form class="space-y-6">
                    <!-- Email/Username Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email atau Username
                        </label>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            placeholder="Masukkan email atau username"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        />
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Kata Sandi
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan kata sandi"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer bg-white"
                            />
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700">
                            Lupa kata sandi?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 ease-in-out"
                    >
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-6 flex items-center">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-2 text-sm text-gray-500">Atau</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Sign Up Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center text-sm text-gray-500">
                <p>&copy; 2026 Posyandu. Semua hak dilindungi.</p>
            </div>
        </div>
    </div>
</body>
</html>
