@extends('Admin.layouts.app')

@section('title', 'Detail Kepala Keluarga')
@section('page_title', 'Detail Kepala Keluarga')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Personal Information -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
            <div class="flex items-center mb-6 pb-4 border-b-2 border-gray-200">
                <iconify-icon icon="mdi:account" style="font-size: 1.5rem; margin-right: 0.5rem; color: #667eea;"></iconify-icon>
                <h2 class="text-lg font-bold text-gray-900">Informasi Pribadi</h2>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-2">Nama Lengkap</label>
                    <p class="text-gray-900 font-medium">{{ $kepalaKeluarga->nama_lengkap }}</p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-2">Email</label>
                    <p class="text-gray-900 font-medium">{{ $kepalaKeluarga->email }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-2">Nomor NIK</label>
                        <code class="text-gray-900 font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $kepalaKeluarga->no_nik }}</code>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-2">Nomor KK</label>
                        <code class="text-gray-900 font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $kepalaKeluarga->no_kk }}</code>
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-2">Nomor Telepon</label>
                    <p class="text-gray-900 font-medium">{{ $kepalaKeluarga->no_telepon }}</p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-2">Alamat</label>
                    <p class="text-gray-900 font-medium">{{ $kepalaKeluarga->alamat }}</p>
                </div>
            </div>
        </div>

        <!-- Account Status -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex items-center mb-6 pb-4 border-b-2 border-gray-200">
                <iconify-icon icon="mdi:shield-check" style="font-size: 1.5rem; margin-right: 0.5rem; color: #667eea;"></iconify-icon>
                <h2 class="text-lg font-bold text-gray-900">Status Akun</h2>
            </div>

            <!-- Verification Status -->
            @if ($kepalaKeluarga->email_verified_at)
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-6">
                    <div class="flex items-center">
                        <iconify-icon icon="mdi:check-circle" style="font-size: 1.5rem; margin-right: 0.5rem; color: #10b981;"></iconify-icon>
                        <div>
                            <p class="font-bold text-green-900">Email Terverifikasi</p>
                            <p class="text-sm text-green-700">{{ $kepalaKeluarga->email_verified_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded mb-6">
                    <div class="flex items-center">
                        <iconify-icon icon="mdi:alert-circle" style="font-size: 1.5rem; margin-right: 0.5rem; color: #ef4444;"></iconify-icon>
                        <div>
                            <p class="font-bold text-red-900">Email Belum Terverifikasi</p>
                            <p class="text-sm text-red-700">User belum mengklik link verifikasi</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Timeline -->
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-purple-600 text-white flex items-center justify-center">
                            <iconify-icon icon="mdi:account-plus"></iconify-icon>
                        </div>
                    </div>
                    <div class="pt-1">
                        <p class="font-bold text-gray-900">Pendaftaran</p>
                        <p class="text-sm text-gray-600">{{ $kepalaKeluarga->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                @if ($kepalaKeluarga->email_verified_at)
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center">
                                <iconify-icon icon="mdi:check"></iconify-icon>
                            </div>
                        </div>
                        <div class="pt-1">
                            <p class="font-bold text-gray-900">Email Diverifikasi</p>
                            <p class="text-sm text-gray-600">{{ $kepalaKeluarga->email_verified_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Status Card -->
        <div class="bg-gradient-to-br from-purple-600 to-purple-700 text-white rounded-2xl shadow-md p-6 mb-6">
            <p class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90">Status Persetujuan</p>
            <div class="text-2xl font-bold mb-4 flex items-center">
                @if ($kepalaKeluarga->status === 'pending')
                    <iconify-icon icon="mdi:hourglass-half" style="font-size: 1.75rem; margin-right: 0.5rem; color: #fbbf24;"></iconify-icon>
                    <span>Menunggu</span>
                @elseif ($kepalaKeluarga->status === 'approved')
                    <iconify-icon icon="mdi:check-circle" style="font-size: 1.75rem; margin-right: 0.5rem; color: #34d399;"></iconify-icon>
                    <span>Disetujui</span>
                @else
                    <iconify-icon icon="mdi:times-circle" style="font-size: 1.75rem; margin-right: 0.5rem; color: #f87171;"></iconify-icon>
                    <span>Ditolak</span>
                @endif
            </div>
            <div class="inline-block bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm font-medium">
                @if ($kepalaKeluarga->status === 'pending')
                    Membutuhkan Tindakan
                @elseif ($kepalaKeluarga->status === 'approved')
                    Akun Aktif
                @else
                    Akun Dinonaktifkan
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        @if ($kepalaKeluarga->status === 'pending' && $kepalaKeluarga->email_verified_at)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mb-6">
                <div class="flex items-start">
                    <iconify-icon icon="mdi:information" style="font-size: 1.25rem; margin-right: 0.5rem; margin-top: 2px; color: #3b82f6;"></iconify-icon>
                    <p class="text-sm text-blue-900">Email sudah terverifikasi. Anda bisa menyetujui atau menolak akun ini.</p>
                </div>
            </div>

            <div class="space-y-3">
                <button type="button" class="w-full flex items-center justify-center px-4 py-3 rounded-lg font-medium bg-green-600 hover:bg-green-700 text-white transition shadow-md hover:shadow-lg" onclick="confirmApprove('{{ $kepalaKeluarga->id }}', '{{ $kepalaKeluarga->nama_lengkap }}')">
                    <iconify-icon icon="mdi:check" style="font-size: 1.25rem; margin-right: 8px; color: #fff;"></iconify-icon>
                    <span>Setujui Akun</span>
                </button>

                <button type="button" onclick="showRejectModal('{{ $kepalaKeluarga->id }}', '{{ $kepalaKeluarga->nama_lengkap }}')" class="w-full flex items-center justify-center px-4 py-3 rounded-lg font-medium bg-red-600 hover:bg-red-700 text-white transition shadow-md hover:shadow-lg">
                    <iconify-icon icon="mdi:times" style="font-size: 1.25rem; margin-right: 8px; color: #fff;"></iconify-icon>
                    <span>Tolak Akun</span>
                </button>
            </div>
        @elseif ($kepalaKeluarga->status === 'pending' && !$kepalaKeluarga->email_verified_at)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <div class="flex items-start">
                    <iconify-icon icon="mdi:information" style="font-size: 1.25rem; margin-right: 0.5rem; margin-top: 2px; color: #3b82f6;"></iconify-icon>
                    <p class="text-sm text-blue-900">Tunggu user memverifikasi email terlebih dahulu.</p>
                </div>
            </div>
        @elseif ($kepalaKeluarga->status === 'approved')
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <div class="flex items-start">
                    <iconify-icon icon="mdi:check-circle" style="font-size: 1.25rem; margin-right: 0.5rem; margin-top: 2px; color: #10b981;"></iconify-icon>
                    <p class="text-sm text-green-900">Akun ini sudah disetujui dan aktif.</p>
                </div>
            </div>
        @else
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                <div class="flex items-start">
                    <iconify-icon icon="mdi:times-circle" style="font-size: 1.25rem; margin-right: 0.5rem; margin-top: 2px; color: #ef4444;"></iconify-icon>
                    <p class="text-sm text-red-900">Akun ini sudah ditolak.</p>
                </div>
            </div>
        @endif

        <!-- Quick Info -->
        <div class="bg-white rounded-2xl shadow-md p-6 mt-6">
            <div class="flex items-center mb-6 pb-4 border-b-2 border-gray-200">
                <iconify-icon icon="mdi:clock" style="font-size: 1.25rem; margin-right: 0.5rem; color: #667eea;"></iconify-icon>
                <h3 class="font-bold text-gray-900">Ringkasan</h3>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1">Status Terakhir Diubah</label>
                    <p class="text-sm text-gray-900">{{ $kepalaKeluarga->updated_at->format('d M Y H:i') }}</p>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1">ID Akun</label>
                    <code class="text-sm text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">{{ $kepalaKeluarga->id }}</code>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal (Hidden - Not Used) -->
<div id="rejectModal" style="display: none;"></div>

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
