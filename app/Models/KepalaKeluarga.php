<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaKeluarga extends Model
{
    protected $table = 'kepala_keluarga';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_kk',
        'alamat',
        'no_telepon',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
