<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            // relasi siswa dan guru pendamping
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('guru_pendamping_id')->nullable()->constrained('guru_pendampings')->nullOnDelete();

            // dua pilihan mitra (perusahaan)
            $table->foreignId('mitra_1_id')->constrained('mitras')->cascadeOnDelete();
            $table->foreignId('mitra_2_id')->nullable()->constrained('mitras')->nullOnDelete();

            // mitra yang diterima (dipilih admin)
            $table->foreignId('mitra_diterima_id')->nullable()->constrained('mitras')->nullOnDelete();

            // relasi jadwal pendaftaran
            $table->foreignId('jadwal_pendaftaran_id')->constrained('jadwal_pendaftarans')->cascadeOnDelete();

            // status pendaftaran
            $table->enum('status', ['proses', 'diterima', 'ditolak', 'selesai'])->default('proses')->index();

            // waktu daftar
            $table->timestamp('tanggal_daftar')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
