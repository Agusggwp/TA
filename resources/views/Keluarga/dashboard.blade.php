<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keluarga - Posyandu</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background: linear-gradient(135deg, #f0ebf8 0%, #f5f7fa 50%, #e8f4f8 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            min-height: 100vh;
        }

        .page {
            background: linear-gradient(135deg, #ffffff 0%, #f9fbfd 100%);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06), 0 2px 8px rgba(78, 3, 131, 0.05);
            animation: slideUp 0.5s ease-out;
            border: 1px solid rgba(78, 3, 131, 0.05);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e0383 0%, #6b2ba8 50%, #5a1f8a 100%);
            box-shadow: 0 4px 15px rgba(78, 3, 131, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3a025c 0%, #5a1f8a 50%, #4a1575 100%);
            box-shadow: 0 12px 35px rgba(78, 3, 131, 0.4);
            transform: translateY(-4px);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff 0%, #f9fbfd 100%);
            border-radius: 12px;
            border: 1px solid rgba(78, 3, 131, 0.08);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            animation: slideUp 0.5s ease-out;
        }

        .stat-card:hover {
            box-shadow: 0 16px 40px rgba(78, 3, 131, 0.15);
            border-color: rgba(78, 3, 131, 0.15);
            transform: translateY(-8px);
        }

        header {
            animation: slideInDown 0.5s ease-out;
            position: relative;
            overflow: hidden;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
            opacity: 0.5;
        }

        header > * {
            position: relative;
            z-index: 1;
        }

        button {
            font-weight: 500;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        button:active {
            transform: scale(0.96);
        }
    </style>
</head>
<body class="text-gray-800">
    <!-- NAVBAR -->
    @include('Keluarga.components.navbar')

    <!-- HEADER -->
    <header class="bg-gradient-to-r from-purple-700 via-purple-600 to-purple-500 text-white p-8 shadow-lg relative">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center gap-4 mb-3">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-pink-400 to-purple-400 rounded-lg blur opacity-30 animate-pulse"></div>
                    <span class="relative text-5xl"><i class="fas fa-hospital"></i></span>
                </div>
                <div class="flex-1">
                    <h1 class="text-4xl font-bold tracking-tight leading-tight">Sistem Informasi Kesehatan Keluarga</h1>
                    <p class="text-purple-100 text-base mt-2 font-light">Manajemen kesehatan keluarga yang lebih baik & terpercaya</p>
                </div>
            </div>
            <div class="h-1 w-32 bg-gradient-to-r from-pink-300 to-purple-300 rounded-full mt-4"></div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto p-6">
        <!-- DASHBOARD KELUARGA -->
        <div class="page p-8 rounded-2xl shadow-sm">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-3">Dashboard Keluarga</h1>
                <p class="text-gray-600 text-lg font-light">Kelola dan monitor kesehatan keluarga Anda dengan mudah</p>
                <div class="h-1 w-20 bg-gradient-to-r from-purple-500 to-orange-500 rounded-full mt-4"></div>
            </div>
            
            <!-- Action Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                <a href="{{ route('keluarga.anggota') }}" class="btn-primary text-white px-8 py-6 rounded-xl font-semibold flex items-center justify-center gap-3 shadow-md hover:shadow-xl transition-all duration-300">
                    <span class="text-3xl"><i class="fas fa-people-group"></i></span>
                    <div class="text-left">
                        <span class="block text-sm font-light opacity-90">Lihat</span>
                        <span class="block">Data Anggota</span>
                    </div>
                </a>
                <a href="{{ route('keluarga.riwayat') }}" class="btn-primary text-white px-8 py-6 rounded-xl font-semibold flex items-center justify-center gap-3 shadow-md hover:shadow-xl transition-all duration-300">
                    <span class="text-3xl"><i class="fas fa-list-check"></i></span>
                    <div class="text-left">
                        <span class="block text-sm font-light opacity-90">Lihat</span>
                        <span class="block">Riwayat Cek</span>
                    </div>
                </a>
                <a href="#" class="btn-primary text-white px-8 py-6 rounded-xl font-semibold flex items-center justify-center gap-3 shadow-md hover:shadow-xl transition-all duration-300">
                    <span class="text-3xl"><i class="fas fa-chart-column"></i></span>
                    <div class="text-left">
                        <span class="block text-sm font-light opacity-90">Lihat</span>
                        <span class="block">Laporan</span>
                    </div>
                </a>
            </div>

            <!-- Statistics Section -->
            <div class="bg-gradient-to-br from-purple-50 via-blue-50 to-orange-50 p-8 rounded-2xl border border-purple-100 shadow-sm">
                <div class="flex items-center gap-2 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900"><i class="fas fa-chart-line"></i> Statistik Keluarga</h2>
                    <span class="text-sm text-gray-600 font-light">Perbarui otomatis</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Total Anggota -->
                    <div class="stat-card p-8 rounded-2xl border-l-4 border-purple-500">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold uppercase tracking-wider">Total Anggota</p>
                                <p class="text-5xl font-bold text-purple-600 mt-3">{{ $totalAnggota ?? 0 }}</p>
                            </div>
                            <span class="text-4xl text-purple-600"><i class="fas fa-users"></i></span>
                        </div>
                        <p class="text-gray-500 text-sm mt-4">orang keluarga</p>
                        <div class="h-1 w-12 bg-gradient-to-r from-purple-400 to-purple-500 rounded-full mt-4"></div>
                    </div>

                    <!-- Pemeriksaan Terakhir -->
                    <div class="stat-card p-8 rounded-2xl border-l-4 border-orange-500">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold uppercase tracking-wider">Pemeriksaan Terakhir</p>
                                <p class="text-5xl font-bold text-orange-500 mt-3">-</p>
                            </div>
                            <span class="text-4xl text-orange-500"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <p class="text-gray-500 text-sm mt-4">{{ $kunjunganTerakhir ?? '-' }}</p>
                        <div class="h-1 w-12 bg-gradient-to-r from-orange-400 to-orange-500 rounded-full mt-4"></div>
                    </div>

                    <!-- Status Kesehatan -->
                    <div class="stat-card p-8 rounded-2xl border-l-4 border-green-500">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold uppercase tracking-wider">Status Kesehatan</p>
                                <p class="text-5xl font-bold text-green-600 mt-3"><i class="fas fa-check"></i></p>
                            </div>
                            <span class="text-4xl text-green-600"><i class="fas fa-hospital"></i></span>
                        </div>
                        <p class="text-gray-500 text-sm mt-4">Semua normal</p>
                        <div class="h-1 w-12 bg-gradient-to-r from-green-400 to-green-500 rounded-full mt-4"></div>
                    </div>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="mt-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-md p-8 text-white">
                <h2 class="text-3xl font-bold mb-4">Selamat Datang, {{ session('kepala_keluarga_nama', 'User') }}!</h2>
                <p class="text-blue-100 mb-6 text-lg">
                    Halaman ini menampilkan informasi kesehatan keluarga Anda. Kelola data anggota keluarga, pantau riwayat kesehatan, dan jadwal kunjungan ke posyandu.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('keluarga.anggota') }}" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-blue-50 transition">
                        Lihat Anggota Keluarga
                    </a>
                    <a href="{{ route('keluarga.riwayat') }}" class="bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-800 transition border border-blue-700">
                        Lihat Riwayat Kesehatan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar dari akun Anda?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('keluarga.logout') }}";
                }
            });
        }
    </script>
</body>
</html>
