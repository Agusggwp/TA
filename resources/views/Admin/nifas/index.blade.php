@extends('Admin.layouts.app')

@section('content')
<div class="flex-1">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Data Nifas (Ibu Postpartum)</h1>
            <a href="{{ route('admin.nifas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                <i class="mdi mdi-plus mr-2"></i>Tambah Data
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold">No. KK</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold">Nama</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold">Tgl Bersalin</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold">Status Gizi</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nifas as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $item->no_kk }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->nama_ibu }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->tanggal_bersalin?->format('d-m-Y') ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->status_gizi ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('admin.nifas.show', $item) }}" class="inline-flex items-center px-3 py-1 rounded bg-blue-100 text-blue-600 hover:bg-blue-200 mr-2">
                                    <i class="mdi mdi-eye mr-1"></i><span class="text-xs">Lihat</span>
                                </a>
                                <a href="{{ route('admin.nifas.edit', $item) }}" class="inline-flex items-center px-3 py-1 rounded bg-yellow-100 text-yellow-600 hover:bg-yellow-200 mr-2">
                                    <i class="mdi mdi-pencil mr-1"></i><span class="text-xs">Edit</span>
                                </a>
                                <button onclick="confirmDelete('{{ route('admin.nifas.destroy', $item) }}')" class="inline-flex items-center px-3 py-1 rounded bg-red-100 text-red-600 hover:bg-red-200">
                                    <i class="mdi mdi-trash-can mr-1"></i><span class="text-xs">Hapus</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $nifas->links() }}</div>
    </div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            }).then(response => {
                if (response.ok) {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success').then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}
</script>
@endsection
