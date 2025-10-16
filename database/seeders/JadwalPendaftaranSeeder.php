<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPendaftaran;
use Carbon\Carbon;

class JadwalPendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwalPendaftarans = [
            [
                'nama_periode' => 'Periode PKL Semester Genap 2025',
                'mitra_id' => null, // Jadwal umum untuk semua mitra
                'mulai_pendaftaran' => Carbon::now()->subDays(30),
                'akhir_pendaftaran' => Carbon::now()->addDays(30),
                'tanggal_pengumuman' => Carbon::now()->addDays(45),
                'is_active' => true, // Jadwal aktif
            ],
        ];

        foreach ($jadwalPendaftarans as $jadwal) {
            JadwalPendaftaran::create($jadwal);
        }
    }
}
