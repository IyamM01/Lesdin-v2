<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class DokumenPendukung extends Model
{
    protected $table = 'dokumen_pendukung';

    protected $fillable = [
        'siswa_id',
        'surat_pengantar',
        'cv',
    ];

    /**
     * Relasi ke Siswa
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Get full path untuk surat pengantar
     */
    public function getSuratPengantarUrlAttribute()
    {
        return $this->surat_pengantar 
            ? asset('storage/dokumen/surat_pengantar/' . $this->surat_pengantar) 
            : null;
    }

    /**
     * Get full path untuk CV
     */
    public function getCvUrlAttribute()
    {
        return $this->cv 
            ? asset('storage/dokumen/cv/' . $this->cv) 
            : null;
    }

    /**
     * Cek apakah semua dokumen sudah lengkap
     */
    public function isComplete(): bool
    {
        return !empty($this->surat_pengantar) && !empty($this->cv);
    }

    /**
     * Hapus file dokumen dari storage
     */
    public function deleteFiles()
    {
        if ($this->surat_pengantar && Storage::disk('public')->exists('dokumen/surat_pengantar/' . $this->surat_pengantar)) {
            Storage::disk('public')->delete('dokumen/surat_pengantar/' . $this->surat_pengantar);
        }
        
        if ($this->cv && Storage::disk('public')->exists('dokumen/cv/' . $this->cv)) {
            Storage::disk('public')->delete('dokumen/cv/' . $this->cv);
        }
    }
}
