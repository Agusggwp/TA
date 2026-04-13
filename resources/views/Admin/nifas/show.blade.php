@extends('Admin.layouts.app')

@section('content')
<div class="flex-1">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Detail Data Nifas</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.nifas.edit', $nifa) }}" class="bg-yellow-600 text-white px-4 py-2 rounded">Edit</a>
                <a href="{{ route('admin.nifas.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Kembali</a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded">
                <h3 class="font-semibold mb-3">Identitas</h3>
                <p class="text-sm mb-1"><span class="font-semibold">No. KK:</span> {{ $nifa->no_kk }}</p>
                <p class="text-sm mb-1"><span class="font-semibold">Nama Ibu:</span> {{ $nifa->nama_ibu }}</p>
                <p class="text-sm mb-1"><span class="font-semibold">NIK:</span> {{ $nifa->nik ?? '-' }}</p>
                <p class="text-sm mb-1"><span class="font-semibold">Tanggal Lahir:</span> {{ $nifa->tanggal_lahir?->format('d-m-Y') ?? '-' }}</p>
                <p class="text-sm"><span class="font-semibold">Tanggal Bersalin:</span> {{ $nifa->tanggal_bersalin?->format('d-m-Y') ?? '-' }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded">
                <h3 class="font-semibold mb-3">Pengukuran</h3>
                <p class="text-sm mb-1"><span class="font-semibold">BB:</span> {{ $nifa->berat_badan ?? '-' }} kg</p>
                <p class="text-sm mb-1"><span class="font-semibold">TB:</span> {{ $nifa->tinggi_badan ?? '-' }} cm</p>
                <p class="text-sm mb-1"><span class="font-semibold">Status Gizi:</span> {{ $nifa->status_gizi ?? '-' }}</p>
                <p class="text-sm mb-1"><span class="font-semibold">LILA:</span> {{ $nifa->lila ?? '-' }} cm</p>
            </div>

            <div class="bg-gray-50 p-4 rounded col-span-2">
                <h3 class="font-semibold mb-3">Tekanan Darah & Skrining TBC</h3>
                <p class="text-sm mb-1"><span class="font-semibold">Sistole/Diastole:</span> {{ $nifa->sistole ?? '-' }}/{{ $nifa->diastole ?? '-' }} mmHg</p>
                <p class="text-sm"><span class="font-semibold">Gejala TBC:</span> 
                    @if($nifa->hasGejalaaTbc())
                        <span class="text-red-600 font-semibold">Ada</span>
                    @else
                        Tidak
                    @endif
                </p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button onclick="confirmDelete('{{ route('admin.nifas.destroy', $nifa) }}')" class="px-4 py-2 bg-red-600 text-white rounded">
                Hapus
            </button>
        </div>
    </div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
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
                        window.location.href = '{{ route('admin.nifas.index') }}';
                    });
                }
            });
        }
    });
}
</script>
@endsection
