<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'nis',
        'nisn',
        'jurusan_id',
        'tempat_tanggal_lahir',
        'kontak',
        'alamat',
        'gender',
    ];

    /**
     * Relationship dengan User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship dengan Jurusan
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Relationship dengan Registration
     */
    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class);
    }

    /**
     * Relationship dengan Registrations (bisa lebih dari 1)
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Relationship dengan Dokumen Pendukung
     */
    public function dokumenPendukung(): HasOne
    {
        return $this->hasOne(DokumenPendukung::class);
    }

    /**
     * Cek apakah siswa sudah mendaftar PKL
     */
    public function hasDaftar(): bool
    {
        return $this->registrations()->exists();
    }

    /**
     * Get registration terbaru
     */
    public function getLatestRegistration()
    {
        return $this->registrations()->latest()->first();
    }

    /**
     * Cek apakah siswa sudah diterima di mitra
     */
    public function isDiterima(): bool
    {
        return $this->registrations()->where('status', 'diterima')->exists();
    }
}
