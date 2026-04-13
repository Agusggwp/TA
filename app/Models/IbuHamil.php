<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    use HasFactory;

    protected $table = 'ibu_hamil';

    protected $fillable = [
        'kepala_keluarga_id',
        'nik',
        'nama_ibu',
        'tanggal_lahir',
        'umur',
        'nama_suami',
        'alamat',
        'no_hp',
        'l_ibu_hamil',
        'kehamilan_ke',
        'jarak_anak_sebelumnya',
        'tinggi_badan',
        'berat_badan',
        'lingkar_lengan',
        'tekanan_darah',
        'denyut_jantung',
        'kondisi_ibu',
        'keluhan',
        'tanggal_kunjungan',
        'waktu_ke_posyandu',
        'petugas',
        'catatan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_kunjungan' => 'date',
        'tinggi_badan' => 'decimal:2',
        'berat_badan' => 'decimal:2',
        'lingkar_lengan' => 'decimal:2',
    ];

    /**
     * Relasi ke Kepala Keluarga
     */
    public function kepalaKeluarga()
    {
        return $this->belongsTo(KepalaKeluarga::class);
    }

    /**
     * Ambil no_kk dari relasi kepala_keluarga
     */
    public function getNoKkAttribute()
    {
        return $this->kepalaKeluarga?->no_kk;
    }

    /**
     * Scope untuk filter berdasarkan kepala keluarga
     */
    public function scopeByKepalaKeluarga($query, $kepalaKeluargaId)
    {
        return $query->where('kepala_keluarga_id', $kepalaKeluargaId);
    }

    /**
     * Scope untuk filter berdasarkan tanggal kunjungan
     */
    public function scopeByTanggalKunjungan($query, $tanggal)
    {
        return $query->where('tanggal_kunjungan', $tanggal);
    }

    /**
     * Scope untuk filter berdasarkan range tanggal
     */
    public function scopeByPeriode($query, $tanggalMulai, $tanggalSelesai)
    {
        return $query->whereBetween('tanggal_kunjungan', [$tanggalMulai, $tanggalSelesai]);
    }

    /**
     * Scope untuk filter by nama ibu
     */
    public function scopeByNamaIbu($query, $nama)
    {
        return $query->where('nama_ibu', 'like', "%{$nama}%");
    }

    /**
     * Scope untuk ibu hamil berisiko tinggi
     */
    public function scopeBerisiko($query)
    {
        return $query->where(function ($q) {
            $q->where('lingkar_lengan', '<', 23.5) // LILA < 23.5 = KEK (Kekurangan Energi Kronis)
              ->orWhere('berat_badan', '<', 45) // BB rendah
              ->orWhereIn('tekanan_darah', ['140/90', '150/100']);
        });
    }

    /**
     * Check if ibu hamil is KEK (Kekurangan Energi Kronis)
     */
    public function isKek()
    {
        return $this->lingkar_lengan && $this->lingkar_lengan < 23.5;
    }

    /**
     * Check tekanan darah tinggi
     */
    public function isTekananDarahTinggi()
    {
        return $this->tekanan_darah && str_contains($this->tekanan_darah, ['140', '150', '160']);
    }

    /**
     * Format tanggal untuk display
     */
    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->format('d M Y') : '-';
    }

    public function getTanggalKunjunganFormattedAttribute()
    {
        return $this->tanggal_kunjungan ? $this->tanggal_kunjungan->format('d M Y H:i') : '-';
    }

    /**
     * Ambil umur otomatis dari tanggal lahir
     */
    public function getUmurOtomatisAttribute()
    {
        return $this->tanggal_lahir ? \Carbon\Carbon::parse($this->tanggal_lahir)->age : null;
    }

    /**
     * Hitung usia kehamilan (jika ada data kehamilan)
     */
    public function getUsiaKehamilanAttribute()
    {
        if ($this->tanggal_kunjungan && $this->kehamilan_ke) {
            // Estimasi: kehamilan normal 40 minggu
            // Bisa dikustomisasi sesuai kebutuhan
            return 'Kehamilan ke-' . $this->kehamilan_ke;
        }
        return '-';
    }
}
