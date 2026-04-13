<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class KepalaKeluarga extends Model implements MustVerifyEmail
{
    protected $table = 'kepala_keluarga';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_kk',
        'no_nik',
        'password',
        'alamat',
        'no_telepon',
        'status',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'api_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the email address that should be used for verification.
     */
    public function getEmailForVerification()
    {
        return $this->email;
    }

    /**
     * Mark the user's email as verified.
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Determine if the user has verified their email address.
     */
    public function hasVerifiedEmail()
    {
        return null !== $this->email_verified_at;
    }

    /**
     * Get the verification URL for the user model.
     */
    public function getEmailVerificationUrl()
    {
        return route('keluarga.verification.verify', [
            'id' => $this->getKey(),
            'hash' => sha1($this->getEmailForVerification()),
        ]);
    }

    /**
     * Relasi ke Ibu Hamil
     */
    public function ibuHamil()
    {
        return $this->hasMany(IbuHamil::class);
    }

    /**
     * Relasi ke Nifas (Ibu Postpartum)
     */
    public function nifas()
    {
        return $this->hasMany(Nifas::class);
    }

    /**
     * Relasi ke Balita
     */
    public function balita()
    {
        return $this->hasMany(Balita::class);
    }

    /**
     * Relasi ke Remaja
     */
    public function remaja()
    {
        return $this->hasMany(Remaja::class);
    }

    /**
     * Relasi ke Dewasa
     */
    public function dewasa()
    {
        return $this->hasMany(Dewasa::class);
    }

    /**
     * Check if user account is approved
     */

    /**
     * Check if email is verified
     */
    public function isEmailVerified()
    {
        return $this->hasVerifiedEmail();
    }

    /**
     * Can user login
     */
    public function canLogin()
    {
        return $this->isEmailVerified() && $this->isApproved();
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        \Illuminate\Support\Facades\Mail::send(new \App\Mail\VerifyEmailNotification($this));
    }
}
