@extends('Admin.layouts.app')

@section('content')
<div class="flex-1 bg-white shadow rounded-lg p-6">
    <div class="mb-6 flex justify-between">
        <h1 class="text-2xl font-bold">Detail Data Dewasa</h1>
        <div><a href="{{ route('admin.dewasa.edit', $dewasa) }}" class="bg-yellow-600 text-white px-4 py-2 rounded mr-2">Edit</a>
        <a href="{{ route('admin.dewasa.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Kembali</a></div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-gray-50 p-4 rounded">
            <h3 class="font-semibold mb-3">Identitas</h3>
            <p class="text-sm mb-1"><span class="font-semibold">No. KK:</span> {{ $dewasa->no_kk }}</p>
            <p class="text-sm mb-1"><span class="font-semibold">Nama:</span> {{ $dewasa->nama }}</p>
            <p class="text-sm mb-1"><span class="font-semibold">NIK:</span> {{ $dewasa->nik ?? '-' }}</p>
            <p class="text-sm mb-1"><span class="font-semibold">Umur:</span> {{ $dewasa->umur_tahun ?? '-' }} tahun</p>
            <p class="text-sm"><span class="font-semibold">Pekerjaan:</span> {{ $dewasa->pekerjaan ?? '-' }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded">
            <h3 class="font-semibold mb-3">Pemeriksaan Fisik</h3>
            <p class="text-sm mb-1"><span class="font-semibold">BB/TB:</span> {{ $dewasa->berat_badan ?? '-' }} kg / {{ $dewasa->tinggi_badan ?? '-' }} cm</p>
            <p class="text-sm mb-1"><span class="font-semibold">IMT:</span> {{ $dewasa->imt ?? '-' }}</p>
            <p class="text-sm mb-1"><span class="font-semibold">LP:</span> {{ $dewasa->lingkar_perut ?? '-' }} cm</p>
            <p class="text-sm"><span class="font-semibold">TD:</span> {{ $dewasa->sistole ?? '-' }}/{{ $dewasa->diastole ?? '-' }} mmHg</p>
        </div>

        <div class="bg-gray-50 p-4 rounded col-span-2">
            <h3 class="font-semibold mb-3">Laboratorium & Risiko</h3>
            <p class="text-sm mb-1"><span class="font-semibold">Gula Darah:</span> {{ $dewasa->gula_darah ?? '-' }} mg/dL</p>
            <p class="text-sm mb-1"><span class="font-semibold">Merokok:</span> {{ $dewasa->merokok ?? '-' }}</p>
            <p class="text-sm"><span class="font-semibold">Skor PUMA:</span> {{ $dewasa->skor_puma ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-6"><button onclick="confirmDelete('{{ route('admin.dewasa.destroy', $dewasa) }}')" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button></div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({title: 'Hapus?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc2626'}).then((r) => {
        if (r.isConfirmed) fetch(url, {method: 'DELETE', headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}}).then(r => r.ok && Swal.fire('OK!', '', 'success').then(() => window.location.href = '{{ route('admin.dewasa.index') }}'));
    });
}
</script>
@endsection
