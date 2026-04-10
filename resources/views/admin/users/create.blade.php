@extends('layouts.app')

@section('title', 'Tambah Pengguna')
@section('page_title', 'Tambah Pengguna')

@section('content')
<div class="p-8 max-w-2xl">
    <!-- Back Link -->
    <a href="{{ route('admin.users') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium mb-6">
        <iconify-icon icon="mdi:chevron-left" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
        Kembali
    </a>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Form Tambah Pengguna Baru</h2>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6" onsubmit="handleSubmit(event)">
            @csrf

            <!-- Name -->
            <div>
                <label class="form-label">Nama Lengkap</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
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
                    value="{{ old('email') }}"
                    placeholder="masukkan@email.com"
                    class="form-input @error('email') border-red-500 @enderror"
                    required
                />
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="form-label">Kata Sandi</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    class="form-input @error('password') border-red-500 @enderror"
                    required
                />
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label class="form-label">Konfirmasi Kata Sandi</label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Konfirmasi kata sandi"
                    class="form-input"
                    required
                />
            </div>

            <!-- Role -->
            <div>
                <label class="form-label">Role</label>
                <select
                    name="role"
                    class="form-input @error('role') border-red-500 @enderror"
                    required
                >
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                    <option value="kader" @selected(old('role') === 'kader')>Kader</option>
                    <option value="bidan" @selected(old('role') === 'bidan')>Bidan</option>
                </select>
                @error('role')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6">
                <button
                    type="submit"
                    class="btn-login flex-1 py-3 px-4 rounded-lg text-white font-semibold inline-flex items-center justify-center"
                >
                    <iconify-icon icon="mdi:content-save" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
                    Simpan Pengguna
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
        let isValid = true;
        
        // Basic validation check
        if (!form.name.value || !form.email.value || !form.password.value || !form.role.value) {
            isValid = false;
        }
        
        if (form.password.value !== form.password_confirmation.value) {
            isValid = false;
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan!',
                text: 'Kata sandi dan konfirmasi tidak cocok!'
            });
        }
        
        if (isValid) {
            Swal.fire({
                title: 'Menyimpan...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }
    }
}
</script>
@endsection
