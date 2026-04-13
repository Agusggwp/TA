@extends('Admin.layouts.app')

@section('title', 'Kelola Kepala Keluarga')
@section('page_title', 'Kelola Kepala Keluarga')

@section('content')
<!-- Success Message -->
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

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Pending Card -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-yellow-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Menunggu Persetujuan</p>
                <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $stats['pending'] }}</p>
            </div>
            <div class="w-16 h-16 bg-yellow-100 rounded-xl flex items-center justify-center">
                <iconify-icon icon="mdi:hourglass-half" style="font-size: 2rem; color: #f59e0b;"></iconify-icon>
            </div>
        </div>
    </div>

    <!-- Approved Card -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-green-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Disetujui</p>
                <p class="text-4xl font-bold text-green-600 mt-2">{{ $stats['approved'] }}</p>
            </div>
            <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center">
                <iconify-icon icon="mdi:check-circle" style="font-size: 2rem; color: #10b981;"></iconify-icon>
            </div>
        </div>
    </div>

    <!-- Rejected Card -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-red-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Ditolak</p>
                <p class="text-4xl font-bold text-red-600 mt-2">{{ $stats['rejected'] }}</p>
            </div>
            <div class="w-16 h-16 bg-red-100 rounded-xl flex items-center justify-center">
                <iconify-icon icon="mdi:times-circle" style="font-size: 2rem; color: #ef4444;"></iconify-icon>
            </div>
        </div>
    </div>

    <!-- Total Card -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total</p>
                <p class="text-4xl font-bold text-gray-900 mt-2">{{ $stats['total'] }}</p>
            </div>
            <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center">
                <iconify-icon icon="mdi:home-group" style="font-size: 2rem; color: #6b7280;"></iconify-icon>
            </div>
        </div>
    </div>
</div>

<!-- Filter Buttons -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6 flex flex-wrap gap-3">
    <a href="{{ route('admin.kepala-keluarga', ['status' => 'all']) }}" 
       class="px-4 py-2 rounded-lg font-medium transition {{ $status === 'all' ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
        Semua
    </a>
    <a href="{{ route('admin.kepala-keluarga', ['status' => 'pending']) }}" 
       class="px-4 py-2 rounded-lg font-medium transition {{ $status === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
        Menunggu
    </a>
    <a href="{{ route('admin.kepala-keluarga', ['status' => 'approved']) }}" 
       class="px-4 py-2 rounded-lg font-medium transition {{ $status === 'approved' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
        Disetujui
    </a>
    <a href="{{ route('admin.kepala-keluarga', ['status' => 'rejected']) }}" 
       class="px-4 py-2 rounded-lg font-medium transition {{ $status === 'rejected' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
        Ditolak
    </a>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-md overflow-hidden overflow-x-auto">
    @if ($kepalaKeluargas->count() > 0)
        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">NIK</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No. KK</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Verifikasi Email</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Terdaftar</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($kepalaKeluargas as $kk)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-900">{{ $kk->nama_lengkap }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $kk->no_telepon }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $kk->email }}</td>
                        <td class="px-6 py-4 text-sm"><code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $kk->no_nik }}</code></td>
                        <td class="px-6 py-4 text-sm"><code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $kk->no_kk }}</code></td>
                        <td class="px-6 py-4">
                            @if ($kk->status === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <iconify-icon icon="mdi:hourglass-half" style="margin-right: 4px;"></iconify-icon> Menunggu
                                </span>
                            @elseif ($kk->status === 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <iconify-icon icon="mdi:check-circle" style="margin-right: 4px;"></iconify-icon> Disetujui
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <iconify-icon icon="mdi:times-circle" style="margin-right: 4px;"></iconify-icon> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($kk->email_verified_at)
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                    <iconify-icon icon="mdi:check" style="margin-right: 2px;"></iconify-icon> Terverifikasi
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">
                                    <iconify-icon icon="mdi:times" style="margin-right: 2px;"></iconify-icon> Belum
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $kk->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.kepala-keluarga.show', $kk) }}" class="inline-flex items-center px-3 py-2 rounded-lg text-xs font-medium bg-purple-600 hover:bg-purple-700 text-white transition shadow-sm hover:shadow-md">
                                    <iconify-icon icon="mdi:eye" style="font-size: 1rem; margin-right: 4px; color: #fff;"></iconify-icon> Lihat
                                </a>
                                @if ($kk->status === 'pending')
                                    <button type="button" class="inline-flex items-center px-3 py-2 rounded-lg text-xs font-medium bg-green-600 hover:bg-green-700 text-white transition shadow-sm hover:shadow-md" onclick="confirmApprove({{ $kk->id }}, '{{ $kk->nama_lengkap }}')">
                                        <iconify-icon icon="mdi:check" style="font-size: 1rem; margin-right: 4px; color: #fff;"></iconify-icon> Setujui
                                    </button>
                                    <button type="button" class="inline-flex items-center px-3 py-2 rounded-lg text-xs font-medium bg-red-600 hover:bg-red-700 text-white transition shadow-sm hover:shadow-md" onclick="showRejectModal({{ $kk->id }}, '{{ $kk->nama_lengkap }}')">
                                        <iconify-icon icon="mdi:times" style="font-size: 1rem; margin-right: 4px; color: #fff;"></iconify-icon> Tolak
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        @if ($kepalaKeluargas->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $kepalaKeluargas->links() }}
            </div>
        @endif
    @else
        <div class="flex flex-col items-center justify-center py-16">
            <iconify-icon icon="mdi:inbox-multiple" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></iconify-icon>
            <p class="text-lg font-semibold text-gray-900">Tidak Ada Data</p>
            <p class="text-gray-500 text-sm">Belum ada kepala keluarga dengan status ini</p>
        </div>
    @endif
</div>

<script>
    function confirmApprove(id, nama) {
        Swal.fire({
            title: 'Setujui Akun?',
            text: `Anda akan menyetujui akun dari: ${nama}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit approve request
                fetch(`/admin/kepala-keluarga/${id}/approve`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                  .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Akun ${nama} telah disetujui`,
                            timer: 2000,
                            timerProgressBar: true,
                            didClose: () => location.reload()
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat menyetujui akun'
                        });
                    }
                  }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan jaringan'
                    });
                  });
            }
        });
    }

    function showRejectModal(id, nama) {
        Swal.fire({
            title: 'Tolak Akun',
            html: `
                <div style="text-align: left; margin-top: 1rem;">
                    <p style="color: #4b5563; font-size: 0.95rem; margin-bottom: 1rem;">
                        Anda akan menolak akun dari: <strong>${nama}</strong>
                    </p>
                    <label style="display: block; color: #6b7280; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem; text-align: left;">
                        Alasan Penolakan (Opsional)
                    </label>
                    <textarea id="rejectReason" style="width: 100%; padding: 0.75rem; border: 1.5px solid #e5e7eb; border-radius: 6px; font-family: inherit; font-size: 0.9rem; resize: vertical; min-height: 100px;" placeholder="Jelaskan alasan penolakan..."></textarea>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Tolak Akun',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                document.getElementById('rejectReason')?.focus();
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const reason = document.getElementById('rejectReason')?.value || '';
                
                fetch(`/admin/kepala-keluarga/${id}/reject`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ reason: reason })
                }).then(response => response.json())
                  .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Akun ${nama} telah ditolak`,
                            timer: 2000,
                            timerProgressBar: true,
                            didClose: () => location.reload()
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat menolak akun'
                        });
                    }
                  }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan jaringan'
                    });
                  });
            }
        });
    }
</script>
@endsection
