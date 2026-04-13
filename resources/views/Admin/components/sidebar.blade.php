<!-- Sidebar -->
<aside class="sidebar w-64">
    <div class="flex items-center justify-center h-16 mb-8">
        <h1 class="text-2xl font-bold gradient-text">Posyandu</h1>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-purple-100 text-purple-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <iconify-icon icon="mdi:home" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
            Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.users', 'admin.users.create', 'admin.users.edit') ? 'bg-purple-100 text-purple-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <iconify-icon icon="mdi:account-multiple" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
            Kelola Pengguna
        </a>
        <a href="{{ route('admin.kepala-keluarga') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.kepala-keluarga', 'admin.kepala-keluarga.show') ? 'bg-purple-100 text-purple-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <iconify-icon icon="mdi:home-group" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
            Kepala Keluarga
        </a>

        <!-- Data Kesehatan Submenu -->
        <div class="px-2 mt-6 mb-4">
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Data Kesehatan</span>
        </div>

        <a href="{{ route('admin.ibu-hamil.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.ibu-hamil.*') ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <iconify-icon icon="mdi:mother" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
            Ibu Hamil
        </a>

        <a href="{{ route('admin.nifas.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.nifas.*') ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <iconify-icon icon="mdi:baby-face" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
            Nifas (Postpartum)
        </a>

        <a href="{{ route('admin.balita.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.balita.*') ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <iconify-icon icon="mdi:baby-carriage" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
            Balita (< 5 Tahun)
        </a>

        <a href="{{ route('admin.remaja.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.remaja.*') ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <iconify-icon icon="mdi:account-young" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
            Remaja (10-19 Tahun)
        </a>

        <a href="{{ route('admin.dewasa.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dewasa.*') ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <iconify-icon icon="mdi:account" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
            Dewasa (>= 18 Tahun)
        </a>
    </nav>

    <div class="mt-auto pt-6 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="button" onclick="confirmLogout()" class="w-full flex items-center px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition font-medium">
                <iconify-icon icon="mdi:logout" class="w-5 h-5 mr-3" style="font-size: 1.25rem;"></iconify-icon>
                Logout
            </button>
        </form>
    </div>
</aside>
