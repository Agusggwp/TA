@extends('layouts.app')

@section('title', 'Kelola Pengguna')
@section('page_title', 'Kelola Pengguna')

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

    <!-- Page Header with Button -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Daftar Pengguna</h2>
            <p class="text-gray-600 mt-2">Kelola semua pengguna sistem</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-login inline-flex items-center px-6 py-3 rounded-lg text-white font-medium">
            <iconify-icon icon="mdi:plus" style="font-size: 1.25rem; margin-right: 0.5rem;"></iconify-icon>
            Tambah Pengguna
        </a>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-purple-50 to-blue-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Bergabung</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-blue-500 flex items-center justify-center text-white font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-gray-600 text-sm">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->role === 'admin')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800 gap-1">
                                        <iconify-icon icon="mdi:crown" style="font-size: 0.9rem;"></iconify-icon> Admin
                                    </span>
                                @elseif ($user->role === 'kader')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-800 gap-1">
                                        <iconify-icon icon="mdi:briefcase" style="font-size: 0.9rem;"></iconify-icon> Kader
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 gap-1">
                                        <iconify-icon icon="mdi:stethoscope" style="font-size: 0.9rem;"></iconify-icon> Bidan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-gray-600 text-sm">{{ $user->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 transition">
                                    <iconify-icon icon="mdi:pencil" style="font-size: 1rem; margin-right: 0.25rem;"></iconify-icon>
                                    Edit
                                </a>
                                <button type="button" onclick="confirmDelete('{{ route('admin.users.destroy', $user) }}', '{{ $user->name }}')" class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 transition">
                                    <iconify-icon icon="mdi:delete" style="font-size: 1rem; margin-right: 0.25rem;"></iconify-icon>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <iconify-icon icon="mdi:inbox" style="font-size: 3rem; color: #d1d5db; display: inline-block; margin-bottom: 1rem;"></iconify-icon>
                                <p class="text-gray-600">Tidak ada pengguna yang ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url, userName) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Pengguna "${userName}" akan dihapus dan tidak dapat dipulihkan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = @json(csrf_field());
                form.innerHTML += '<input type="hidden" name="_method" value="DELETE">';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
