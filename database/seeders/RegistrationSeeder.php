<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\Siswa;
use App\Models\GuruPendamping;
use App\Models\Mitra;
use App\Models\JadwalPendaftaran;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = Siswa::all();
        $gurus = GuruPendamping::all();
        $mitras = Mitra::all();
        $jadwalAktif = JadwalPendaftaran::where('is_active', true)->first();

        $statuses = ['proses', 'diterima', 'ditolak', 'selesai'];

        // Buat registrasi untuk beberapa siswa dengan berbagai status
        foreach ($siswas->take(15) as $index => $siswa) {
            // Pilih 2 mitra berbeda
            $selectedMitras = $mitras->random(2);
            
            // Tentukan status dan mitra diterima
            $status = $statuses[$index % 4]; // Distribusi merata
            $mitraDiterima = in_array($status, ['diterima', 'selesai']) 
                ? $selectedMitras->random()->id 
                : null;
            
            // Buat tanggal daftar dalam 7 hari terakhir untuk grafik
            $tanggalDaftar = now()->subDays(rand(0, 6))->setTime(rand(8, 16), rand(0, 59));

            Registration::create([
                'siswa_id' => $siswa->id,
                'guru_pendamping_id' => $status !== 'proses' ? $gurus->random()->id : null,
                'mitra_1_id' => $selectedMitras[0]->id,
                'mitra_2_id' => $selectedMitras[1]->id,
                'mitra_diterima_id' => $mitraDiterima,
                'jadwal_pendaftaran_id' => $jadwalAktif->id,
                'status' => $status,
                'tanggal_daftar' => $tanggalDaftar,
            ]);
        }
    }
}