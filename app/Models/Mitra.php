<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'deskripsi',
        'kontak',
        'email',
        'alamat',
        'kuota',
        'jurusan_id',
        'image',
    ];

    // Relasi ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    // Relasi ke Registrasi sebagai pilihan 1
    public function registrationsPilihan1()
    {
        return $this->hasMany(Registration::class, 'mitra_1_id');
    }

    // Relasi ke Registrasi sebagai pilihan 2
    public function registrationsPilihan2()
    {
        return $this->hasMany(Registration::class, 'mitra_2_id');
    }

    // Relasi ke Registrasi yang diterima
    public function registrationsDiterima()
    {
        return $this->hasMany(Registration::class, 'mitra_diterima_id');
    }

    // Relasi ke Jadwal Pendaftaran
    public function jadwalPendaftaran()
    {
        return $this->hasOne(JadwalPendaftaran::class);
    }

    /**
     * Get jadwal pendaftaran yang aktif untuk mitra ini
     */
    public function getJadwalAktifAttribute()
    {
        return $this->jadwalPendaftaran()->active()->first();
    }

    /**
     * Cek apakah mitra sedang buka pendaftaran
     */
    public function isBukaPendaftaran()
    {
        $jadwal = $this->jadwalPendaftaran;
        return $jadwal && $jadwal->isActive();
    }
}
