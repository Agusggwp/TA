@extends('Admin.layouts.app')

@section('content')
<div class="flex-1">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Detail Data Ibu Hamil</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.ibu-hamil.edit', $ibu_hamil) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
                    <i class="mdi mdi-pencil mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.ibu-hamil.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="mdi mdi-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <!-- Identitas -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-3">Identitas</h3>
                <p class="text-sm mb-2"><span class="font-semibold">No. KK:</span> {{ $ibu_hamil->no_kk }}</p>
                <p class="text-sm mb-2"><span class="font-semibold">Nama Ibu:</span> {{ $ibu_hamil->nama_ibu }}</p>
                <p class="text-sm mb-2"><span class="font-semibold">NIK:</span> {{ $ibu_hamil->nik ?? '-' }}</p>
                <p class="text-sm mb-2"><span class="font-semibold">Tanggal Lahir:</span> {{ $ibu_hamil->tanggal_lahir?->format('d-m-Y') ?? '-' }}</p>
                <p class="text-sm mb-2"><span class="font-semibold">Kepala Keluarga:</span> {{ $ibu_hamil->kepalaKeluarga->nama_lengkap }}</p>
            </div>

            <!-- Antropometri -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-3">Antropometri</h3>
                <p class="text-sm mb-2"><span class="font-semibold">Berat Badan:</span> {{ $ibu_hamil->berat_badan ?? '-' }} kg</p>
                <p class="text-sm mb-2"><span class="font-semibold">Tinggi Badan:</span> {{ $ibu_hamil->tinggi_badan ?? '-' }} cm</p>
                <p class="text-sm mb-2"><span class="font-semibold">Lingkar Lengan:</span> {{ $ibu_hamil->lingkar_lengan ?? '-' }} cm</p>
                <p class="text-sm mb-2"><span class="font-semibold">Tanggal Kunjungan:</span> {{ $ibu_hamil->tanggal_kunjungan?->format('d-m-Y') ?? '-' }}</p>
            </div>

            <!-- Pemeriksaan -->
            <div class="bg-gray-50 p-4 rounded-lg col-span-2">
                <h3 class="font-semibold text-gray-700 mb-3">Pemeriksaan Tekanan Darah & Jantung</h3>
                <div class="grid grid-cols-4">
                    <p class="text-sm"><span class="font-semibold">TD Sistole:</span> {{ $ibu_hamil->tekanan_darah_sistole ?? '-' }} mmHg</p>
                    <p class="text-sm"><span class="font-semibold">TD Diastole:</span> {{ $ibu_hamil->tekanan_darah_diastole ?? '-' }} mmHg</p>
                    <p class="text-sm"><span class="font-semibold">Denyut Jantung:</span> {{ $ibu_hamil->denyut_jantung ?? '-' }} bpm</p>
                </div>
            </div>
        </div>

        <!-- Edit & Delete Buttons -->
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.ibu-hamil.edit', $ibu_hamil) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                Edit
            </a>
            <button onclick="confirmDelete('{{ route('admin.ibu-hamil.destroy', $ibu_hamil) }}')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Hapus
            </button>
        </div>
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
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success').then(() => {
                        window.location.href = '{{ route('admin.ibu-hamil.index') }}';
                    });
                }
            });
        }
    });
}
</script>
@endsection
