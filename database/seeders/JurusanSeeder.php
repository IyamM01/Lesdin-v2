<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel jurusan.
     */
    public function run(): void
    {
        $jurusans = [
            ['nama_jurusan' => 'Sistem Informasi Jaringan Aplikasi', 'kode_jurusan' => 'SIJA'],
            ['nama_jurusan' => 'Geologi Pertambangan', 'kode_jurusan' => 'GP'],
            ['nama_jurusan' => 'Teknik Fabrikasi Logam Manufaktur', 'kode_jurusan' => 'TFLM'],
            ['nama_jurusan' => 'Kimia Analisis', 'kode_jurusan' => 'KA'],
            ['nama_jurusan' => 'Kimia Industri', 'kode_jurusan' => 'KI'],
            ['nama_jurusan' => 'Teknik Pemesinan', 'kode_jurusan' => 'TP'],
            ['nama_jurusan' => 'Teknik Kendaraan Ringan', 'kode_jurusan' => 'TKR'],
            ['nama_jurusan' => 'Teknik Bodi Kendaraan Ringan', 'kode_jurusan' => 'TBKR'],
            ['nama_jurusan' => 'Teknik Otomasi Industri', 'kode_jurusan' => 'TOI'],
            ['nama_jurusan' => 'Teknik Instalasi Tenaga Listrik', 'kode_jurusan' => 'TITL'],
            ['nama_jurusan' => 'Desain Permodelan Informasi Bangunan', 'kode_jurusan' => 'DPIB'],
            ['nama_jurusan' => 'Konstruksi Gedung Sanitasi', 'kode_jurusan' => 'KGS'],
            ['nama_jurusan' => 'Teknik Elektronika Komunikasi', 'kode_jurusan' => 'TEK'],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
