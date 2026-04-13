@extends('Admin.layouts.app')

@section('content')
<div class="flex-1">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-6 flex justify-between">
            <h1 class="text-2xl font-bold">Detail Data Balita</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.balita.edit', $balita) }}" class="bg-yellow-600 text-white px-4 py-2 rounded">Edit</a>
                <a href="{{ route('admin.balita.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Kembali</a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded">
                <h3 class="font-semibold mb-3">Identitas</h3>
                <p class="text-sm mb-1"><span class="font-semibold">No. KK:</span> {{ $balita->no_kk }}</p>
                <p class="text-sm mb-1"><span class="font-semibold">Nama Bayi:</span> {{ $balita->nama_bayi }}</p>
                <p class="text-sm mb-1"><span class="font-semibold">Tgl Lahir:</span> {{ $balita->tanggal_lahir?->format('d-m-Y') }}</p>
                <p class="text-sm mb-1"><span class="font-semibold">Umur:</span> {{ $balita->umur_otomatis }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded">
                <h3 class="font-semibold mb-3">Pengukuran</h3>
                <p class="text-sm mb-1"><span class="font-semibold">BB:</span> {{ $balita->berat_badan }} kg</p>
                <p class="text-sm mb-1"><span class="font-semibold">PB:</span> {{ $balita->panjang_badan }} cm</p>
                <p class="text-sm mb-1"><span class="font-semibold">Lingkar Kepala:</span> {{ $balita->lingkar_kepala }} cm</p>
                <p class="text-sm"><span class="font-semibold">Status Gizi:</span> {{ $balita->status_gizi }}</p>
            </div>
        </div>

        <div class="mt-6">
            <button onclick="confirmDelete('{{ route('admin.balita.destroy', $balita) }}')" class="px-4 py-2 bg-red-600 text-white rounded">
                Hapus
            </button>
        </div>
    </div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'Hapus'
    }).then((r) => {
        if (r.isConfirmed) {
            fetch(url, {
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}
            }).then(r => r.ok && Swal.fire('Terhapus!', '', 'success').then(() => 
                window.location.href = '{{ route('admin.balita.index') }}'
            ));
        }
    });
}
</script>
@endsection
