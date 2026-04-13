@extends('Admin.layouts.app')

@section('content')
<div class="flex-1 bg-white shadow rounded-lg p-6">
    <div class="mb-6 flex justify-between">
        <h1 class="text-2xl font-bold">Detail Remaja</h1>
        <div><a href="{{ route('admin.remaja.edit', $remaja) }}" class="bg-yellow-600 text-white px-4 py-2 rounded mr-2">Edit</a>
        <a href="{{ route('admin.remaja.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Kembali</a></div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-gray-50 p-4 rounded">
            <h3 class="font-semibold mb-3">Identitas</h3>
            <p class="text-sm mb-1"><span class="font-semibold">No. KK:</span> {{ $remaja->no_kk }}</p>
            <p class="text-sm mb-1"><span class="font-semibold">Nama:</span> {{ $remaja->nama_anak }}</p>
            <p class="text-sm mb-1"><span class="font-semibold">Tgl Lahir:</span> {{ $remaja->tanggal_lahir?->format('d-m-Y') }}</p>
            <p class="text-sm"><span class="font-semibold">Umur:</span> {{ $remaja->umur_tahun }} tahun</p>
        </div>

        <div class="bg-gray-50 p-4 rounded">
            <h3 class="font-semibold mb-3">Pengukuran</h3>
            <p class="text-sm mb-1"><span class="font-semibold">BB/TB:</span> {{ $remaja->berat_badan ?? '-' }} kg / {{ $remaja->tinggi_badan ?? '-' }} cm</p>
            <p class="text-sm mb-1"><span class="font-semibold">IMT:</span> {{ $remaja->imt_status ?? '-' }}</p>
            <p class="text-sm"><span class="font-semibold">TD Sistole:</span> {{ $remaja->sistole ?? '-' }} mmHg</p>
        </div>
    </div>

    <div class="mt-6"><button onclick="confirmDelete('{{ route('admin.remaja.destroy', $remaja) }}')" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button></div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({title: 'Konfirmasi?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc2626'}).then((r) => {
        if (r.isConfirmed) fetch(url, {method: 'DELETE', headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}}).then(r => r.ok && Swal.fire('OK!', '', 'success').then(() => window.location.href = '{{ route('admin.remaja.index') }}'));
    });
}
</script>
@endsection
