@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('page_title', 'Edit Pengguna')

@section('content')
<div class="p-8 max-w-2xl">
    <!-- Back Link -->
    <a href="{{ route('admin.users') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium mb-6">
        <iconify-icon icon="mdi:chevron-left" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
        Kembali
    </a>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Form Edit Pengguna</h2>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6" onsubmit="handleSubmit(event)">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="form-label">Nama Lengkap</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    placeholder="Masukkan nama lengkap"
                    class="form-input @error('name') border-red-500 @enderror"
                    required
                />
                @error('name')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    placeholder="masukkan@email.com"
                    class="form-input @error('email') border-red-500 @enderror"
                    required
                />
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="form-label">Role</label>
                <select
                    name="role"
                    class="form-input @error('role') border-red-500 @enderror"
                    required
                >
                    <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                    <option value="kader" @selected(old('role', $user->role) === 'kader')>Kader</option>
                    <option value="bidan" @selected(old('role', $user->role) === 'bidan')>Bidan</option>
                </select>
                @error('role')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-700 flex items-start gap-2">
                    <iconify-icon icon="mdi:information" style="font-size: 1.25rem; margin-top: 0.125rem; flex-shrink: 0;"></iconify-icon>
                    <span><strong>Catatan:</strong> Untuk mengganti kata sandi, silakan hubungi administrator atau gunakan fitur reset password.</span>
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6">
                <button
                    type="submit"
                    class="btn-login flex-1 py-3 px-4 rounded-lg text-white font-semibold inline-flex items-center justify-center"
                >
                    <iconify-icon icon="mdi:content-save" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
                    Simpan Perubahan
                </button>
                <a
                    href="{{ route('admin.users') }}"
                    class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-3 px-4 rounded-lg text-center transition inline-flex items-center justify-center"
                >
                    <iconify-icon icon="mdi:close" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function handleSubmit(event) {
        const form = event.target;
        
        Swal.fire({
            title: 'Menyimpan...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }
</script>
@endsection
