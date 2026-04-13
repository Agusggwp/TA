<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;

    protected $table = 'balita';

    protected $fillable = [
        'kepala_keluarga_id',
        'nama_bayi',
        'nik',
        'jenis_kelamin',
        'tanggal_lahir',
        'berat_badan_lahir',
        'panjang_badan_lahir',
        'nama_ortu',
        'alamat',
        'no_hp',
        'dusun',
        'desa',
        'kecamatan',
        'umur',
        'waktu_kunjungan',
        'berat_badan',
        'naik_tidak_naik',
        'status_bb_u',
        'panjang_badan',
        'status_pb_u',
        'status_bb_pb',
        'lingkar_lengan',
        'status_lila',
        'lingkar_kepala',
        'batuk',
        'demam',
        'bb_turun',
        'kontak_tbc',
        'perkembangan',
        'asi_eksklusif',
        'mpasi',
        'imunisasi',
        'vitamin_a',
        'obat_cacing',
        'mt_pangan',
        'edukasi',
        'catatan_kesehatan',
        'rujukan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berat_badan_lahir' => 'decimal:2',
        'panjang_badan_lahir' => 'decimal:2',
        'berat_badan' => 'decimal:2',
        'panjang_badan' => 'decimal:2',
        'lingkar_lengan' => 'decimal:2',
        'lingkar_kepala' => 'decimal:2',
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
     * Scope untuk filter berdasarkan tanggal lahir
     */
    public function scopeByTanggalLahir($query, $tanggal)
    {
        return $query->where('tanggal_lahir', $tanggal);
    }

    /**
     * Scope untuk filter berdasarkan range umur
     */
    public function scopeByUmur($query, $umurMin, $umurMax)
    {
        return $query->whereBetween('umur', [$umurMin, $umurMax]);
    }

    /**
     * Scope untuk filter by nama bayi
     */
    public function scopeByNamaBayi($query, $nama)
    {
        return $query->where('nama_bayi', 'like', "%{$nama}%");
    }

    /**
     * Scope untuk balita dengan status gizi kurang (SM/SK)
     */
    public function scopeStatusGiziKurang($query)
    {
        return $query->where(function ($q) {
            $q->whereIn('status_bb_u', ['SK', 'K']) // Sangat Kurang/Kurang
              ->orWhereIn('status_pb_u', ['SP', 'P']) // Sangat Pendek/Pendek
              ->orWhereIn('status_bb_pb', ['K']) // Kurang
              ->orWhereIn('status_lila', ['K', 'M']); // Kurang/Malnutrisi
        });
    }

    /**
     * Scope untuk balita normal
     */
    public function scopeStatusGiziNormal($query)
    {
        return $query->where('status_bb_u', 'N')
                     ->where('status_pb_u', 'N')
                     ->where('status_bb_pb', 'B')
                     ->where('status_lila', 'H');
    }

    /**
     * Check status gizi BB/U
     */
    public function isStatusBbuSangat()
    {
        return $this->status_bb_u === 'SK';
    }

    public function isStatusBbuKurang()
    {
        return $this->status_bb_u === 'K';
    }

    public function isStatusBbuNormal()
    {
        return $this->status_bb_u === 'N';
    }

    public function isStatusBbuTinggi()
    {
        return $this->status_bb_u === 'T';
    }

    /**
     * Check status gizi PB/U
     */
    public function isStatusPbuSangatPendek()
    {
        return $this->status_pb_u === 'SP';
    }

    public function isStatusPbuPendek()
    {
        return $this->status_pb_u === 'P';
    }

    public function isStatusPbuNormal()
    {
        return $this->status_pb_u === 'N';
    }

    /**
     * Check status gizi BB/PB
     */
    public function isStatusBbpbBaik()
    {
        return $this->status_bb_pb === 'B';
    }

    public function isStatusBbpbKurang()
    {
        return $this->status_bb_pb === 'K';
    }

    public function isStatusBbpbLebih()
    {
        return $this->status_bb_pb === 'L';
    }

    /**
     * Check LILA status
     */
    public function isLilaSehat()
    {
        return $this->status_lila === 'H';
    }

    public function isLilaKurang()
    {
        return $this->status_lila === 'K';
    }

    public function isLilaMalnutrisi()
    {
        return $this->status_lila === 'M';
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
     * Check perkembangan
     */
    public function isPerkembanganLengkap()
    {
        return $this->perkembangan === 'Lengkap';
    }

    public function isPerkembanganTidakLengkap()
    {
        return $this->perkembangan === 'Tidak';
    }

    public function isPerkembanganMonitor()
    {
        return $this->perkembangan === 'Monitor';
    }

    /**
     * Check imunisasi lengkap
     */
    public function hasImunisasiLengkap()
    {
        return $this->imunisasi ? true : false;
    }

    /**
     * Format tanggal untuk display
     */
    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->format('d M Y') : '-';
    }

    /**
     * Ambil umur otomatis dalam bulan dari tanggal lahir
     */
    public function getUmurOtomatisAttribute()
    {
        if ($this->tanggal_lahir) {
            $birthDate = \Carbon\Carbon::parse($this->tanggal_lahir);
            $now = \Carbon\Carbon::now();
            
            // Hitung umur dalam bulan
            $months = $birthDate->diffInMonths($now);
            return $months;
        }
        return null;
    }

    /**
     * Status balita untuk display (condensed)
     */
    public function getStatusGiziKondensatAttribute()
    {
        $status = [];
        
        if ($this->isStatusBbuSangat()) $status[] = 'BB/U: SK';
        if ($this->isStatusBbuKurang()) $status[] = 'BB/U: K';
        if ($this->isStatusPbuSangatPendek()) $status[] = 'PB/U: SP';
        if ($this->isStatusPbuPendek()) $status[] = 'PB/U: P';
        if ($this->isStatusBbpbKurang()) $status[] = 'BB/PB: K';
        if ($this->isLilaKurang() || $this->isLilaMalnutrisi()) $status[] = 'LILA: ' . $this->status_lila;
        
        return count($status) > 0 ? implode(', ', $status) : 'Normal';
    }

    /**
     * Check if balita needs urgent attention
     */
    public function needsUrgentAttention()
    {
        return $this->isStatusBbuSangat() || 
               $this->isStatusPbuSangatPendek() || 
               $this->isLilaMalnutrisi() || 
               $this->hasGejalaaTbc();
    }
}
