<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPendaftaran extends Model
{
    protected $fillable = [
        'nama_periode',
        'mulai_pendaftaran',
        'akhir_pendaftaran',
        'mitra_id',
        'tanggal_pengumuman',
        'is_active',
    ];

    protected $casts = [
        'mulai_pendaftaran' => 'date',
        'akhir_pendaftaran' => 'date',
        'tanggal_pengumuman' => 'date',
    ];

    /**
     * Relasi ke Registrations
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'jadwal_pendaftaran_id');
    }

    /**
     * Relasi ke Mitra (opsional, jika jadwal khusus per mitra)
     */
    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class);
    }

    /**
     * Cek apakah pendaftaran sedang aktif/buka
     */
    public function isActive(): bool
    {
        $now = Carbon::now()->startOfDay();
        $mulai = Carbon::parse($this->mulai_pendaftaran)->startOfDay();
        $akhir = Carbon::parse($this->akhir_pendaftaran)->endOfDay();
        
        return $now->between($mulai, $akhir);
    }

    /**
     * Cek apakah pendaftaran sudah ditutup
     */
    public function isClosed(): bool
    {
        $now = Carbon::now()->startOfDay();
        $akhir = Carbon::parse($this->akhir_pendaftaran)->endOfDay();
        
        return $now->greaterThan($akhir);
    }

    /**
     * Cek apakah pendaftaran belum dibuka (upcoming)
     */
    public function isUpcoming(): bool
    {
        $now = Carbon::now()->startOfDay();
        $mulai = Carbon::parse($this->mulai_pendaftaran)->startOfDay();
        
        return $now->lessThan($mulai);
    }

    /**
     * Get status pendaftaran dalam bentuk string
     */
    public function getStatusAttribute(): string
    {
        if ($this->isActive()) {
            return 'Dibuka';
        } elseif ($this->isClosed()) {
            return 'Ditutup';
        } else {
            return 'Belum Dibuka';
        }
    }

    /**
     * Get sisa hari pendaftaran
     */
    public function getSisaHariAttribute(): ?int
    {
        if ($this->isClosed()) {
            return null;
        }

        if ($this->isUpcoming()) {
            return Carbon::now()->startOfDay()->diffInDays(
                Carbon::parse($this->mulai_pendaftaran)->startOfDay()
            );
        }

        if ($this->isActive()) {
            return Carbon::now()->startOfDay()->diffInDays(
                Carbon::parse($this->akhir_pendaftaran)->endOfDay()
            );
        }

        return null;
    }

    /**
     * Scope untuk jadwal yang sedang aktif
     */
    public function scopeActive($query)
    {
        $now = Carbon::now();
        return $query->whereDate('mulai_pendaftaran', '<=', $now)
                    ->whereDate('akhir_pendaftaran', '>=', $now);
    }

    /**
     * Scope untuk jadwal yang akan datang
     */
    public function scopeUpcoming($query)
    {
        return $query->whereDate('mulai_pendaftaran', '>', Carbon::now());
    }

    /**
     * Scope untuk jadwal yang sudah ditutup
     */
    public function scopeClosed($query)
    {
        return $query->whereDate('akhir_pendaftaran', '<', Carbon::now());
    }
}
