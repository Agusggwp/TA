<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Remaja extends Model
{
    protected $table = 'remaja';
    protected $dates = ['tanggal_lahir'];

    protected $fillable = [
        'kepala_keluarga_id',
        'nama_anak',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ortu',
        'alamat',
        'no_hp',
        'dusun',
        'desa',
        'kecamatan',
        'riwayat_keluarga',
        'riwayat_diri',
        'waktu_kunjungan',
        'berat_badan',
        'tinggi_badan',
        'imt_status',
        'lingkar_perut',
        'sistole',
        'diastole',
        'tekanan_darah_status',
        'gula_darah',
        'hemoglobin',
        'anemia',
        'batuk',
        'demam',
        'bb_turun',
        'kontak_tbc',
        'masalah_rumah',
        'masalah_pendidikan',
        'masalah_makan',
        'masalah_aktivitas',
        'masalah_obat',
        'masalah_seksual',
        'masalah_emosi',
        'masalah_keamanan',
        'edukasi',
        'rujukan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'lingkar_perut' => 'decimal:2',
    ];

    // ================== RELASI ==================
    
    public function kepalaKeluarga()
    {
        return $this->belongsTo(KepalaKeluarga::class);
    }

    public function getNoKkAttribute()
    {
        return $this->kepalaKeluarga->no_kk ?? null;
    }

    // ================== SCOPES ==================

    public function scopeByKepalaKeluarga($query, $kepalaKeluargaId)
    {
        return $query->where('kepala_keluarga_id', $kepalaKeluargaId);
    }

    public function scopeByTanggalLahir($query, $tanggal)
    {
        return $query->where('tanggal_lahir', $tanggal);
    }

    public function scopeByUmur($query, $minUmur, $maxUmur)
    {
        // Umur dalam tahun
        $minTanggal = Carbon::now()->subYears($maxUmur)->toDateString();
        $maxTanggal = Carbon::now()->subYears($minUmur)->toDateString();
        
        return $query->where('tanggal_lahir', '<=', $maxTanggal)
                     ->where('tanggal_lahir', '>=', $minTanggal);
    }

    public function scopeByNamaRemaja($query, $nama)
    {
        return $query->where('nama_anak', 'like', "%{$nama}%");
    }

    public function scopeImtKurus($query)
    {
        return $query->where('imt_status', 'Kurus');
    }

    public function scopeImtNormal($query)
    {
        return $query->where('imt_status', 'Normal');
    }

    public function scopeImtGemuk($query)
    {
        return $query->where('imt_status', 'Gemuk');
    }

    public function scopeImtObesitas($query)
    {
        return $query->where('imt_status', 'Obesitas');
    }

    public function scopeTekananDarahTinggi($query)
    {
        return $query->where('tekanan_darah_status', 'Tinggi');
    }

    public function scopeTekananDarahRendah($query)
    {
        return $query->where('tekanan_darah_status', 'Rendah');
    }

    public function scopeAnemiaPositif($query)
    {
        return $query->where('anemia', 'Ya');
    }

    public function scopeSkriningTbcPositif($query)
    {
        return $query->where(function($q) {
            $q->where('batuk', 'Ya')
              ->orWhere('demam', 'Ya')
              ->orWhere('bb_turun', 'Ya')
              ->orWhere('kontak_tbc', 'Ya');
        });
    }

    public function scopeHeadssBerisiko($query)
    {
        return $query->where(function($q) {
            $q->where('masalah_rumah', 'Ya')
              ->orWhere('masalah_pendidikan', 'Ya')
              ->orWhere('masalah_makan', 'Ya')
              ->orWhere('masalah_aktivitas', 'Ya')
              ->orWhere('masalah_obat', 'Ya')
              ->orWhere('masalah_seksual', 'Ya')
              ->orWhere('masalah_emosi', 'Ya')
              ->orWhere('masalah_keamanan', 'Ya');
        });
    }

    // ================== IMT HELPERS ==================

    public function isImtKurus()
    {
        return $this->imt_status === 'Kurus';
    }

    public function isImtNormal()
    {
        return $this->imt_status === 'Normal';
    }

    public function isImtGemuk()
    {
        return $this->imt_status === 'Gemuk';
    }

    public function isImtObesitas()
    {
        return $this->imt_status === 'Obesitas';
    }

    // ================== STATUS GIZI HELPERS ==================

    public function calculateImt()
    {
        if (!$this->berat_badan || !$this->tinggi_badan) {
            return null;
        }
        
        // IMT = Berat Badan (kg) / (Tinggi Badan (m))²
        $tinggiMeter = $this->tinggi_badan / 100;
        return round($this->berat_badan / ($tinggiMeter * $tinggiMeter), 2);
    }

    public function getImtKategoriAttribute()
    {
        $imt = $this->calculateImt();
        
        if (!$imt) return 'Tidak Terhitung';
        
        if ($imt < 17) return 'Kurus';
        if ($imt >= 17 && $imt < 23) return 'Normal';
        if ($imt >= 23 && $imt < 27) return 'Gemuk';
        
        return 'Obesitas';
    }

    // ================== TEKANAN DARAH HELPERS ==================

    public function isTekananDarahNormal()
    {
        return $this->tekanan_darah_status === 'Normal';
    }

    public function isTekananDarahTinggiAktual()
    {
        // Berdasarkan sistole/diastole
        if (!$this->sistole || !$this->diastole) {
            return false;
        }
        
        // Kategori hipertensi stadium 1: sistole 130-139 atau diastole 80-89
        // Kategori hipertensi stadium 2: sistole ≥ 140 atau diastole ≥ 90
        return $this->sistole >= 130 || $this->diastole >= 80;
    }

    public function isTekananDarahRendahAktual()
    {
        if (!$this->sistole || !$this->diastole) {
            return false;
        }
        
        return $this->sistole < 90 || $this->diastole < 60;
    }

    // ================== TBC SCREENING HELPERS ==================

    public function hasGejalaaTbc()
    {
        return $this->batuk === 'Ya' || 
               $this->demam === 'Ya' || 
               $this->bb_turun === 'Ya' || 
               $this->kontak_tbc === 'Ya';
    }

    public function getTbcGejalaCountAttribute()
    {
        $count = 0;
        if ($this->batuk === 'Ya') $count++;
        if ($this->demam === 'Ya') $count++;
        if ($this->bb_turun === 'Ya') $count++;
        if ($this->kontak_tbc === 'Ya') $count++;
        
        return $count;
    }

    // ================== HEMOGLOBIN & ANEMIA HELPERS ==================

    public function isAnemia()
    {
        return $this->anemia === 'Ya';
    }

    public function getHemoglobinStatusAttribute()
    {
        if (!$this->hemoglobin) return 'Tidak Diukur';
        
        // Ambang batas hemoglobin untuk remaja:
        // Laki-laki: < 13.5 g/dL = anemia
        // Perempuan: < 12.0 g/dL = anemia
        
        $hemoglobinValue = floatval($this->hemoglobin);
        
        if ($this->jenis_kelamin === 'Laki-laki') {
            return $hemoglobinValue < 13.5 ? 'Anemia' : 'Normal';
        } else {
            return $hemoglobinValue < 12.0 ? 'Anemia' : 'Normal';
        }
    }

    // ================== HEADSS ASSESSMENT HELPERS ==================

    public function getHeadssProblemaCountAttribute()
    {
        $count = 0;
        if ($this->masalah_rumah === 'Ya') $count++;
        if ($this->masalah_pendidikan === 'Ya') $count++;
        if ($this->masalah_makan === 'Ya') $count++;
        if ($this->masalah_aktivitas === 'Ya') $count++;
        if ($this->masalah_obat === 'Ya') $count++;
        if ($this->masalah_seksual === 'Ya') $count++;
        if ($this->masalah_emosi === 'Ya') $count++;
        if ($this->masalah_keamanan === 'Ya') $count++;
        
        return $count;
    }

    public function hasHeadssProblem()
    {
        return $this->masalah_rumah === 'Ya' || 
               $this->masalah_pendidikan === 'Ya' || 
               $this->masalah_makan === 'Ya' || 
               $this->masalah_aktivitas === 'Ya' || 
               $this->masalah_obat === 'Ya' || 
               $this->masalah_seksual === 'Ya' || 
               $this->masalah_emosi === 'Ya' || 
               $this->masalah_keamanan === 'Ya';
    }

    public function isHeadssBerisiko()
    {
        // Berisiko jika ada 3+ masalah HEADSS
        return $this->getHeadssProblemaCountAttribute() >= 3;
    }

    // ================== GULA DARAH HELPERS ==================

    public function isGulaDarahTinggi()
    {
        if (!$this->gula_darah) return false;
        
        $gulaDarah = floatval($this->gula_darah);
        
        // Puasa: > 125 mg/dL = diabetes
        // Sewaktu: > 200 mg/dL = diabetes
        return $gulaDarah > 200; // Asumsi sewaktu
    }

    // ================== URGENT ATTENTION HELPERS ==================

    public function needsUrgentAttention()
    {
        return $this->isTekananDarahTinggiAktual() || 
               $this->isAnemia() ||
               $this->hasGejalaaTbc() && $this->getTbcGejalaCountAttribute() >= 2 ||
               $this->isGulaDarahTinggi() ||
               $this->isHeadssBerisiko();
    }

    // ================== DISPLAY HELPERS ==================

    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->format('d-m-Y') : null;
    }

    public function getTanggalLahirIndonesianAttribute()
    {
        if (!$this->tanggal_lahir) return null;
        
        return $this->tanggal_lahir->translatedFormat('d F Y');
    }

    public function getWaktuKunjunganFormattedAttribute()
    {
        return $this->waktu_kunjungan;
    }

    public function getStatusKondensatAttribute()
    {
        $status = [];
        
        if ($this->isImtKurus()) $status[] = 'IMT: Kurus';
        if ($this->isImtObesitas()) $status[] = 'IMT: Obesitas';
        if ($this->isTekananDarahTinggiAktual()) $status[] = 'TD: Tinggi';
        if ($this->isAnemia()) $status[] = 'Anemia';
        if ($this->hasGejalaaTbc()) $status[] = 'Gejala TBC';
        if ($this->isHeadssBerisiko()) $status[] = 'HEADSS: Berisiko';
        if ($this->isGulaDarahTinggi()) $status[] = 'Gula: Tinggi';
        
        return count($status) > 0 ? implode(', ', $status) : 'Normal';
    }

    // ================== AGE CALCULATION ==================

    public function getUmurOtomatisAttribute()
    {
        if ($this->tanggal_lahir) {
            $umur = Carbon::parse($this->tanggal_lahir)->diffInYears(Carbon::now());
            $bulan = Carbon::parse($this->tanggal_lahir)->addYears($umur)->diffInMonths(Carbon::now());
            
            return "{$umur} tahun {$bulan} bulan";
        }
        return null;
    }

    public function getUmurTahunAttribute()
    {
        if ($this->tanggal_lahir) {
            return Carbon::parse($this->tanggal_lahir)->diffInYears(Carbon::now());
        }
        return null;
    }

    public function getUmurBulanAttribute()
    {
        if ($this->tanggal_lahir) {
            $umur = Carbon::parse($this->tanggal_lahir)->diffInYears(Carbon::now());
            return Carbon::parse($this->tanggal_lahir)->addYears($umur)->diffInMonths(Carbon::now());
        }
        return null;
    }
}
