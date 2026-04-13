<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kesehatan - Posyandu</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        table thead {
            background: linear-gradient(135deg, #4e0383 0%, #6b2ba8 100%);
            box-shadow: 0 4px 12px rgba(78, 3, 131, 0.15);
        }

        table thead th {
            font-weight: 600;
            letter-spacing: 0.5px;
            color: white;
            padding: 16px 24px;
            text-align: left;
        }

        table tbody tr {
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        table tbody tr:hover {
            background: linear-gradient(90deg, rgba(78, 3, 131, 0.03), rgba(78, 3, 131, 0.01));
        }

        table tbody td {
            padding: 16px 24px;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            box-shadow: inset 0 1px 2px rgba(21, 87, 36, 0.1);
        }

        .badge-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            box-shadow: inset 0 1px 2px rgba(133, 100, 4, 0.1);
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

        .breadcrumb {
            font-size: 14px;
            color: #6b7280;
        }

        .breadcrumb a {
            color: #4e0383;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: #3a025c;
        }

        .navbar {
            background: linear-gradient(135deg, #ffffff 0%, #f9fbfd 100%);
            border-bottom: 2px solid rgba(78, 3, 131, 0.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .navbar-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
        }

        .navbar-btn:hover {
            background: rgba(78, 3, 131, 0.1);
            color: #4e0383;
        }

        .navbar-btn-logout {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-btn-logout:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .navbar-divider {
            width: 1px;
            height: 24px;
            background: rgba(78, 3, 131, 0.2);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 20px;
        }

        .empty-state p {
            color: #6b7280;
            font-size: 16px;
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
        <!-- PAGE CONTENT -->
        <div class="page p-8 rounded-2xl shadow-sm">
            <!-- Breadcrumb -->
            <div class="breadcrumb mb-8">
                <a href="{{ route('keluarga.dashboard') }}">Dashboard</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-700">Riwayat Pemeriksaan</span>
            </div>

            <!-- Page Title -->
            <div class="mb-10">
                <h1 class="text-4xl font-bold text-gray-900 mb-3">Riwayat Pemeriksaan Kesehatan</h1>
                <p class="text-gray-600 text-lg font-light">Catatan lengkap pemeriksaan kesehatan seluruh keluarga</p>
                <div class="h-1 w-20 bg-gradient-to-r from-purple-500 to-orange-500 rounded-full mt-4"></div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mb-10">
                <a href="{{ route('keluarga.dashboard') }}" class="bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white px-6 py-3 rounded-lg font-medium shadow-md transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-2xl p-6 mb-8 border border-gray-200 shadow-sm">
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2 text-sm">Anggota Keluarga</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                            <option>-- Pilih Anggota --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2 text-sm">Tanggal Mulai</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2 text-sm">Tanggal Akhir</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg font-semibold shadow-md w-full transition-all duration-300">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Records Table -->
            <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Anggota Keluarga</th>
                            <th>Tanggal</th>
                            <th>Jenis Pemeriksaan</th>
                            <th>Hasil</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td colspan="6" class="text-center py-8">
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <p class="text-lg font-semibold text-gray-700 mb-2">Belum ada data riwayat</p>
                                    <p class="text-gray-600">Riwayat kesehatan akan muncul setelah ada pemeriksaan di posyandu</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
                <div class="flex items-start gap-4">
                    <div class="text-blue-500 text-2xl mt-1">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-blue-900 text-lg mb-2">Catatan Penting</p>
                        <p class="text-blue-800 text-sm">
                            Riwayat kesehatan keluarga akan ditampilkan setelah ada kunjungan ke posyandu. Gunakan fitur filter untuk mencari riwayat berdasarkan anggota keluarga atau rentang waktu tertentu.
                        </p>
                    </div>
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
