@extends('Admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')

@section('content')
<div class="p-8">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition animate-slideUp">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pengguna</p>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                </div>
                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center">
                    <iconify-icon icon="mdi:account" style="font-size: 2rem; color: #2563eb;"></iconify-icon>
                </div>
            </div>
        </div>

        <!-- Admin Users Card -->
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition animate-slideUp" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Admin</p>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $adminUsers }}</p>
                </div>
                <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center">
                    <iconify-icon icon="mdi:crown" style="font-size: 2rem; color: #a855f7;"></iconify-icon>
                </div>
            </div>
        </div>

        <!-- Kader Users Card -->
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition animate-slideUp" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Kader</p>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $kaderUsers }}</p>
                </div>
                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center">
                    <iconify-icon icon="mdi:briefcase" style="font-size: 2rem; color: #ea580c;"></iconify-icon>
                </div>
            </div>
        </div>

        <!-- Bidan Users Card -->
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition animate-slideUp" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Bidan</p>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $bidanUsers }}</p>
                </div>
                <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center">
                    <iconify-icon icon="mdi:stethoscope" style="font-size: 2rem; color: #16a34a;"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tindakan Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.users') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                <iconify-icon icon="mdi:eye" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
                Lihat Semua Pengguna
            </a>
            <a href="{{ route('admin.users.create') }}" class="btn-login inline-flex items-center justify-center px-6 py-3 rounded-lg text-white font-medium">
                <iconify-icon icon="mdi:plus" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
                Tambah Pengguna Baru
            </a>
        </div>
    </div>

    <!-- Kepala Keluarga Management Section -->
    <div class="mt-8 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-8 border border-emerald-200">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <iconify-icon icon="mdi:home-group" style="font-size: 1.75rem; margin-right: 0.5rem; color: #059669;"></iconify-icon>
                    Manajemen Kepala Keluarga
                </h2>
                <p class="text-gray-600 text-sm mt-1">Kelola persetujuan akun kepala keluarga dan verifikasi registrasi</p>
            </div>
        </div>
        <div class="flex gap-4 flex-wrap">
            <a href="{{ route('admin.kepala-keluarga') }}" class="btn-login inline-flex items-center justify-center px-6 py-3 rounded-lg text-white font-medium hover:shadow-lg transition">
                <iconify-icon icon="mdi:account-multiple" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
                Kelola Kepala Keluarga
            </a>
        </div>
    </div>
</div>
@endsection
