<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Posyandu - Kepala Keluarga' }}</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('Keluarga.components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <div class="bg-white shadow-md h-16 flex items-center justify-between px-8 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $title ?? 'Dashboard' }}
                </h2>
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 text-sm">Selamat datang, <span class="font-semibold">{{ session('kepala_keluarga_nama', 'User') }}</span></span>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto">
                <div class="p-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-hide alerts setelah 5 detik
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            });
        });
    </script>
</body>
</html>
