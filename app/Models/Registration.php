<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'guru_pendamping_id',
        'mitra_1_id',
        'mitra_2_id',
        'mitra_diterima_id',
        'jadwal_pendaftaran_id',
        'status',
        'tanggal_daftar',
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
    ];

    /**
     * Relasi ke Mitra Pilihan 1
     */
    public function mitra1(): BelongsTo
    { 
        return $this->belongsTo(Mitra::class, 'mitra_1_id'); 
    }

    /**
     * Relasi ke Mitra Pilihan 2
     */
    public function mitra2(): BelongsTo
    { 
        return $this->belongsTo(Mitra::class, 'mitra_2_id'); 
    }

    /**
     * Relasi ke Mitra yang Diterima
     */
    public function mitraDiterima(): BelongsTo
    { 
        return $this->belongsTo(Mitra::class, 'mitra_diterima_id'); 
    }

    /**
     * Relasi ke Siswa
     */
    public function siswa(): BelongsTo
    { 
        return $this->belongsTo(Siswa::class); 
    }

    /**
     * Relasi ke Guru Pendamping
     */
    public function guruPendamping(): BelongsTo
    {
        return $this->belongsTo(GuruPendamping::class);
    }

    /**
     * Relasi ke Jadwal Pendaftaran
     */
    public function jadwal(): BelongsTo
    { 
        return $this->belongsTo(JadwalPendaftaran::class, 'jadwal_pendaftaran_id'); 
    }

    /**
     * Alias untuk jadwal (backward compatibility)
     */
    public function jadwalPendaftaran(): BelongsTo
    { 
        return $this->belongsTo(JadwalPendaftaran::class, 'jadwal_pendaftaran_id'); 
    }

    /**
     * Scope untuk filter by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk registration yang masih proses
     */
    public function scopeProses($query)
    {
        return $query->where('status', 'proses');
    }

    /**
     * Scope untuk registration yang diterima
     */
    public function scopeDiterima($query)
    {
        return $query->where('status', 'diterima');
    }

    /**
     * Scope untuk registration yang ditolak
     */
    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak');
    }
}


