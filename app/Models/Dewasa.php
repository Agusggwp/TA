<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Dewasa extends Model
{
    protected $table = 'dewasa';
    protected $dates = ['tanggal_lahir'];

    protected $fillable = [
        'kepala_keluarga_id',
        'nama',
        'nik',
        'tanggal_lahir',
        'umur',
        'alamat',
        'no_hp',
        'status_perkawinan',
        'pekerjaan',
        'dusun',
        'desa',
        'kecamatan',
        'riwayat_keluarga',
        'riwayat_diri',
        'merokok',
        'konsumsi_gula',
        'konsumsi_garam',
        'konsumsi_lemak',
        'waktu_kunjungan',
        'berat_badan',
        'tinggi_badan',
        'imt',
        'lingkar_perut',
        'sistole',
        'diastole',
        'tekanan_darah_status',
        'gula_darah',
        'mata_kanan',
        'mata_kiri',
        'telinga_kanan',
        'telinga_kiri',
        'jenis_kelamin',
        'usia_kategori',
        'skor_merokok',
        'napas_berat',
        'dahak',
        'batuk',
        'aktivitas_terganggu',
        'pemeriksaan_sebelumnya',
        'skor_puma',
        'batuk_tbc',
        'demam',
        'bb_turun',
        'kontak_tbc',
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

    public function scopeByNama($query, $nama)
    {
        return $query->where('nama', 'like', "%{$nama}%");
    }

    public function scopeImtKurus($query)
    {
        return $query->where('imt', 'Kurus');
    }

    public function scopeImtNormal($query)
    {
        return $query->where('imt', 'Normal');
    }

    public function scopeImtGemuk($query)
    {
        return $query->where('imt', 'Gemuk');
    }

    public function scopeImtObesitas($query)
    {
        return $query->where('imt', 'Obesitas');
    }

    public function scopeTekananDarahTinggi($query)
    {
        return $query->where('tekanan_darah_status', 'Tinggi');
    }

    public function scopeTekananDarahNormal($query)
    {
        return $query->where('tekanan_darah_status', 'Normal');
    }

    public function scopeTekananDarahRendah($query)
    {
        return $query->where('tekanan_darah_status', 'Rendah');
    }

    public function scopeGulaDarahTinggi($query)
    {
        return $query->whereRaw('CAST(gula_darah AS DECIMAL) > ?', [200]);
    }

    public function scopeSkriningTbcPositif($query)
    {
        return $query->where(function($q) {
            $q->where('batuk_tbc', 'Ya')
              ->orWhere('demam', 'Ya')
              ->orWhere('bb_turun', 'Ya')
              ->orWhere('kontak_tbc', 'Ya');
        });
    }

    public function scopePumaBerisiko($query)
    {
        return $query->where('skor_puma', '>=', 17);
    }

    public function scopePeerilakyRisiko($query)
    {
        return $query->where(function($q) {
            $q->where('merokok', 'Ya')
              ->orWhere('konsumsi_gula', 'Ya')
              ->orWhere('konsumsi_garam', 'Ya')
              ->orWhere('konsumsi_lemak', 'Ya');
        });
    }

    // ================== IMT HELPERS ==================

    public function isImtKurus()
    {
        return $this->imt === 'Kurus';
    }

    public function isImtNormal()
    {
        return $this->imt === 'Normal';
    }

    public function isImtGemuk()
    {
        return $this->imt === 'Gemuk';
    }

    public function isImtObesitas()
    {
        return $this->imt === 'Obesitas';
    }

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
        
        if ($imt < 18.5) return 'Kurus';
        if ($imt >= 18.5 && $imt < 25) return 'Normal';
        if ($imt >= 25 && $imt < 30) return 'Gemuk';
        
        return 'Obesitas';
    }

    // ================== TEKANAN DARAH HELPERS ==================

    public function isTekananDarahNormal()
    {
        return $this->tekanan_darah_status === 'Normal';
    }

    public function isTekananDarahTinggiAktual()
    {
        if (!$this->sistole || !$this->diastole) {
            return false;
        }
        
        // Kategori hipertensi: sistole ≥ 140 atau diastole ≥ 90
        // Eleveated: sistole 120-129 dan diastole < 80
        return $this->sistole >= 140 || $this->diastole >= 90;
    }

    public function isTekananDarahEleveated()
    {
        if (!$this->sistole || !$this->diastole) {
            return false;
        }
        
        // Elevated: sistole 120-129 dan diastole < 80
        return ($this->sistole >= 120 && $this->sistole < 140) && $this->diastole < 80;
    }

    public function isTekananDarahRendahAktual()
    {
        if (!$this->sistole || !$this->diastole) {
            return false;
        }
        
        return $this->sistole < 90 || $this->diastole < 60;
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

    public function isGulaDarahPuasaTinggi()
    {
        if (!$this->gula_darah) return false;
        
        $gulaDarah = floatval($this->gula_darah);
        return $gulaDarah > 125;
    }

    // ================== TBC SCREENING HELPERS ==================

    public function hasGejalaaTbc()
    {
        return $this->batuk_tbc === 'Ya' || 
               $this->demam === 'Ya' || 
               $this->bb_turun === 'Ya' || 
               $this->kontak_tbc === 'Ya';
    }

    public function getTbcGejalaCountAttribute()
    {
        $count = 0;
        if ($this->batuk_tbc === 'Ya') $count++;
        if ($this->demam === 'Ya') $count++;
        if ($this->bb_turun === 'Ya') $count++;
        if ($this->kontak_tbc === 'Ya') $count++;
        
        return $count;
    }

    public function isTbcBerisiko()
    {
        // Berisiko jika ada 2+ gejala TBC
        return $this->getTbcGejalaCountAttribute() >= 2;
    }

    // ================== PUMA (PENYAKIT PARU) SCORING ==================

    /**
     * Hitung skor PUMA (Penyakit Paru risk assessment)
     * Scoring: 0-16 = minimal risk, 17-25 = moderate, 26+ = high
     */
    public function calculatePumaScore()
    {
        $score = 0;

        // 1. Usia kategori
        if ($this->usia_kategori === '<40') $score += 0;
        elseif ($this->usia_kategori === '40-49') $score += 2;
        elseif ($this->usia_kategori === '50-59') $score += 4;
        elseif ($this->usia_kategori === '60+') $score += 4;

        // 2. Gender (Laki-laki = 2, Perempuan = 0)
        if ($this->jenis_kelamin === 'Laki-laki') $score += 2;

        // 3. Smoking status (sudah ada skor_merokok dari input)
        if ($this->skor_merokok) $score += $this->skor_merokok; // 0-4

        // 4. Gejala
        if ($this->napas_berat === 'Ya') $score += 5;
        if ($this->dahak === 'Ya') $score += 2;
        if ($this->batuk === 'Ya') $score += 2;
        if ($this->aktivitas_terganggu === 'Ya') $score += 5;

        // 5. Riwayat pemeriksaan sebelumnya
        if ($this->pemeriksaan_sebelumnya === 'Ya') $score += 4;

        return $score;
    }

    public function getPumaScoreAttribute()
    {
        return $this->skor_puma ?? $this->calculatePumaScore();
    }

    public function getPumaRiskLevelAttribute()
    {
        $score = $this->getPumaScoreAttribute();
        
        if ($score <= 16) return 'Minimal';
        if ($score >= 17 && $score <= 25) return 'Moderate';
        
        return 'High';
    }

    public function isPumaBerisiko()
    {
        return $this->getPumaScoreAttribute() >= 17;
    }

    // ================== PERILAKU HELPERS ==================

    public function isMerokok()
    {
        return $this->merokok === 'Ya';
    }

    public function hasRisikoDiet()
    {
        return $this->konsumsi_gula === 'Ya' || 
               $this->konsumsi_garam === 'Ya' || 
               $this->konsumsi_lemak === 'Ya';
    }

    public function getRisikoDietCountAttribute()
    {
        $count = 0;
        if ($this->konsumsi_gula === 'Ya') $count++;
        if ($this->konsumsi_garam === 'Ya') $count++;
        if ($this->konsumsi_lemak === 'Ya') $count++;
        
        return $count;
    }

    // ================== FUNGSI SENSORIK HELPERS ==================

    public function isMataKananNormal()
    {
        return $this->mata_kanan === 'Normal';
    }

    public function isMataKiriNormal()
    {
        return $this->mata_kiri === 'Normal';
    }

    public function hasMataCacat()
    {
        return $this->mata_kanan !== 'Normal' || $this->mata_kiri !== 'Normal';
    }

    public function isTelinga_KananNormal()
    {
        return $this->telinga_kanan === 'Normal';
    }

    public function isTelinga_KiriNormal()
    {
        return $this->telinga_kiri === 'Normal';
    }

    public function hasTelinga_Cacat()
    {
        return $this->telinga_kanan !== 'Normal' || $this->telinga_kiri !== 'Normal';
    }

    // ================== LINGKAR PERUT HELPERS ==================

    public function isLingkarPerutNormal()
    {
        if (!$this->lingkar_perut) return null;
        
        // Ambang batas lingkar perut untuk orang dewasa:
        // Laki-laki: > 90 cm = risiko
        // Perempuan: > 80 cm = risiko
        
        if ($this->jenis_kelamin === 'Laki-laki') {
            return $this->lingkar_perut <= 90;
        } else {
            return $this->lingkar_perut <= 80;
        }
    }

    public function getLingkarPerutStatusAttribute()
    {
        if (!$this->lingkar_perut) return 'Tidak Diukur';
        
        if ($this->jenis_kelamin === 'Laki-laki') {
            return $this->lingkar_perut > 90 ? 'Berisiko' : 'Normal';
        } else {
            return $this->lingkar_perut > 80 ? 'Berisiko' : 'Normal';
        }
    }

    // ================== URGENT ATTENTION HELPERS ==================

    public function needsUrgentAttention()
    {
        return $this->isTekananDarahTinggiAktual() || 
               $this->isGulaDarahTinggi() ||
               $this->isPumaBerisiko() ||
               $this->isTbcBerisiko() ||
               ($this->isImtObesitas() && !$this->isLingkarPerutNormal());
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

    public function getStatusKondensatAttribute()
    {
        $status = [];
        
        if ($this->isImtKurus()) $status[] = 'IMT: Kurus';
        if ($this->isImtObesitas()) $status[] = 'IMT: Obesitas';
        if (!$this->isLingkarPerutNormal()) $status[] = 'LP: Berisiko';
        if ($this->isTekananDarahTinggiAktual()) $status[] = 'TD: Tinggi';
        if ($this->isGulaDarahTinggi()) $status[] = 'Gula: Tinggi';
        if ($this->isPumaBerisiko()) $status[] = 'PUMA: Berisiko';
        if ($this->hasGejalaaTbc()) $status[] = 'Gejala TBC';
        if ($this->hasMataCacat()) $status[] = 'Mata: Cacat';
        if ($this->hasTelinga_Cacat()) $status[] = 'Telinga: Cacat';
        if ($this->isMerokok()) $status[] = 'Merokok';
        if ($this->hasRisikoDiet()) $status[] = 'Diet Berisiko';
        
        return count($status) > 0 ? implode(', ', $status) : 'Normal';
    }

    // ================== AGE CALCULATION ==================

    public function getUmurOtomatisAttribute()
    {
        if ($this->tanggal_lahir) {
            return Carbon::parse($this->tanggal_lahir)->diffInYears(Carbon::now());
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

    public function getUmurKategoriAttribute()
    {
        $umur = $this->getUmurTahunAttribute();
        
        if (!$umur) return null;
        
        if ($umur < 40) return '<40';
        if ($umur >= 40 && $umur < 50) return '40-49';
        if ($umur >= 50 && $umur < 60) return '50-59';
        
        return '60+';
    }
}
