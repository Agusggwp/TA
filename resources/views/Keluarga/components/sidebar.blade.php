<div class="sidebar bg-gray-900 text-white w-64 min-h-screen flex flex-col">
    <!-- Logo/Brand -->
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center gap-3">
            <div class="bg-blue-500 rounded-lg p-2">
                <iconify-icon icon="mdi:home-heart" width="24" height="24" style="color: white;"></iconify-icon>
            </div>
            <div>
                <h1 class="font-bold text-lg">Posyandu</h1>
                <p class="text-xs text-gray-400">Kepala Keluarga</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <!-- Dashboard -->
        <a
            href="{{ route('keluarga.dashboard') }}"
            class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition @if(Route::currentRouteName() === 'keluarga.dashboard') bg-blue-600 @else hover:bg-gray-800 @endif"
        >
            <iconify-icon icon="mdi:home" width="20" height="20"></iconify-icon>
            <span>Dashboard</span>
        </a>

        <!-- Anggota Keluarga -->
        <a
            href="{{ route('keluarga.anggota') }}"
            class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition @if(Route::currentRouteName() === 'keluarga.anggota') bg-blue-600 @else hover:bg-gray-800 @endif"
        >
            <iconify-icon icon="mdi:account-multiple" width="20" height="20"></iconify-icon>
            <span>Anggota Keluarga</span>
        </a>

        <!-- Riwayat Kesehatan -->
        <a
            href="{{ route('keluarga.riwayat') }}"
            class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition @if(Route::currentRouteName() === 'keluarga.riwayat') bg-blue-600 @else hover:bg-gray-800 @endif"
        >
            <iconify-icon icon="mdi:file-document" width="20" height="20"></iconify-icon>
            <span>Riwayat Kesehatan</span>
        </a>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-gray-700">
        <button
            onclick="confirmLogout()"
            class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 transition text-white font-semibold"
        >
            <iconify-icon icon="mdi:logout" width="20" height="20"></iconify-icon>
            <span>Keluar</span>
        </button>
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
