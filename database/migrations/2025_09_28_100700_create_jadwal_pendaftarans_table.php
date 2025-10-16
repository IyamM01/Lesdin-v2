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
        Schema::create('jadwal_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_periode')->nullable(); // contoh: "Periode Maret 2025"
            $table->date('mulai_pendaftaran');
            $table->date('akhir_pendaftaran');
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->nullOnDelete();
            $table->date('tanggal_pengumuman')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pendaftarans');
    }
};
