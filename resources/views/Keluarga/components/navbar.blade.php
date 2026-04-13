<nav class="navbar sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="text-2xl text-purple-600"><i class="fas fa-hospital"></i></span>
            <span class="text-lg font-bold text-gray-900">Posyandu</span>
        </div>
        <div class="navbar-user">
            <span class="text-gray-700 font-medium">{{ session('kepala_keluarga_nama', 'User') }}</span>
            <div class="navbar-divider"></div>
            <button class="navbar-btn text-gray-700" title="Pengaturan">
                <i class="fas fa-cog text-xl"></i>
            </button>
            <button onclick="confirmLogout()" class="navbar-btn-logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span>
            </button>
        </div>
    </div>
</nav>

<style>
    .navbar {
        background: linear-gradient(135deg, #ffffff 0%, #f9fbfd 100%);
        border-bottom: 2px solid rgba(78, 3, 131, 0.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
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
        color: #4b5563;
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
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
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
</style>
