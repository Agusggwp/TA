<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nifas extends Model
{
    use HasFactory;

    protected $table = 'nifas';

    protected $fillable = [
        'kepala_keluarga_id',
        'nama_ibu',
        'nik',
        'tanggal_lahir',
        'umur',
        'nama_suami',
        'alamat',
        'no_hp',
        'dusun',
        'desa',
        'kecamatan',
        'tanggal_bersalin',
        'tempat_bersalin',
        'anak_ke',
        'tinggi_badan_ibu',
        'waktu_kunjungan',
        'berat_badan',
        'naik_turun',
        'tinggi_badan',
        'lila',
        'status_gizi',
        'sistole',
        'diastole',
        'tekanan_darah_status',
        'batuk',
        'demam',
        'bb_turun',
        'kontak_tbc',
        'vitamin_a',
        'menyusui',
        'kb',
        'edukasi',
        'rujukan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_bersalin' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'tinggi_badan_ibu' => 'decimal:2',
        'lila' => 'decimal:2',
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
     * Scope untuk filter berdasarkan tanggal bersalin
     */
    public function scopeByTanggalBersalin($query, $tanggal)
    {
        return $query->where('tanggal_bersalin', $tanggal);
    }

    /**
     * Scope untuk filter berdasarkan periode
     */
    public function scopeByPeriode($query, $tanggalMulai, $tanggalSelesai)
    {
        return $query->whereBetween('tanggal_bersalin', [$tanggalMulai, $tanggalSelesai]);
    }

    /**
     * Scope untuk filter by status gizi
     */
    public function scopeByStatusGizi($query, $status)
    {
        return $query->where('status_gizi', $status);
    }

    /**
     * Scope untuk filter by tekanan darah status
     */
    public function scopeByTekananDarahStatus($query, $status)
    {
        return $query->where('tekanan_darah_status', $status);
    }

    /**
     * Scope untuk skrining TBC positif
     */
    public function scopeSkriningTbcPositif($query)
    {
        return $query->where(function ($q) {
            $q->where('batuk', 'Ya')
              ->orWhere('demam', 'Ya')
              ->orWhere('bb_turun', 'Ya')
              ->orWhere('kontak_tbc', 'Ya');
        });
    }

    /**
     * Check status gizi
     */
    public function isStatusGiziNormal()
    {
        return $this->status_gizi === 'H'; // H = Healthy
    }

    public function isStatusGiziKurang()
    {
        return $this->status_gizi === 'K'; // K = Kurang
    }

    public function isStatusGiziMalnutrisi()
    {
        return $this->status_gizi === 'M'; // M = Malnutrition
    }

    /**
     * Check tekanan darah
     */
    public function isTekananDarahNormal()
    {
        return $this->tekanan_darah_status === 'N';
    }

    public function isTekananDarahTinggi()
    {
        return $this->tekanan_darah_status === 'T';
    }

    public function isTekananDarahRendah()
    {
        return $this->tekanan_darah_status === 'R';
    }

    /**
     * Check TBC screening
     */
    public function hasGejalaaTbc()
    {
        return in_array('Ya', [
            $this->batuk,
            $this->demam,
            $this->bb_turun,
            $this->kontak_tbc
        ]);
    }

    /**
     * Format tanggal untuk display
     */
    public function getTanggalBersalinFormattedAttribute()
    {
        return $this->tanggal_bersalin ? $this->tanggal_bersalin->format('d M Y') : '-';
    }

    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->format('d M Y') : '-';
    }

    /**
     * Ambil umur otomatis dari tanggal lahir
     */
    public function getUmurOtomatisAttribute()
    {
        return $this->tanggal_lahir ? \Carbon\Carbon::parse($this->tanggal_lahir)->age : null;
    }
}
