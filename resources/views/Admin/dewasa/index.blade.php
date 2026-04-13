@extends('Admin.layouts.app')

@section('content')
<div class="flex-1">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-6 flex justify-between">
            <h1 class="text-3xl font-bold">Data Dewasa (>= 18 Tahun)</h1>
            <a href="{{ route('admin.dewasa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded"><i class="mdi mdi-plus mr-2"></i>Tambah</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left text-sm font-semibold">No. KK</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold">Nama</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold">Umur</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold">IMT</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold">TD</th>
                        <th class="border px-4 py-2 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dewasa as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $item->no_kk }}</td>
                            <td class="border px-4 py-2">{{ $item->nama }}</td>
                            <td class="border px-4 py-2">{{ $item->umur_tahun ?? '-' }} tahun</td>
                            <td class="border px-4 py-2">{{ $item->imt ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $item->tekanan_darah_status ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('admin.dewasa.show', $item) }}" class="inline-flex items-center px-3 py-1 rounded bg-blue-100 text-blue-600 hover:bg-blue-200 mr-2"><i class="mdi mdi-eye mr-1"></i><span class="text-xs">Lihat</span></a>
                                <a href="{{ route('admin.dewasa.edit', $item) }}" class="inline-flex items-center px-3 py-1 rounded bg-yellow-100 text-yellow-600 hover:bg-yellow-200 mr-2"><i class="mdi mdi-pencil mr-1"></i><span class="text-xs">Edit</span></a>
                                <button onclick="confirmDelete('{{ route('admin.dewasa.destroy', $item) }}')" class="inline-flex items-center px-3 py-1 rounded bg-red-100 text-red-600 hover:bg-red-200"><i class="mdi mdi-trash-can mr-1"></i><span class="text-xs">Hapus</span></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="border px-4 py-2 text-center text-gray-500">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $dewasa->links() }}</div>
    </div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({title: 'Hapus?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc2626'}).then((r) => {
        if (r.isConfirmed) fetch(url, {method: 'DELETE', headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}}).then(r => r.ok && Swal.fire('OK!', '', 'success').then(() => location.reload()));
    });
}
</script>
@endsection
