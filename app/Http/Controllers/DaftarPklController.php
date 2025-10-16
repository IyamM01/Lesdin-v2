<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Siswa;
use App\Models\Mitra;
use App\Models\Registration;
use App\Models\JadwalPendaftaran;
use App\Models\DokumenPendukung;

class DaftarPklController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data siswa berdasarkan user yang login
        $siswa = Siswa::where('user_id', Auth::id())->with('jurusan')->first();
        
        // Cek jadwal pendaftaran
        $jadwalData = $this->cekJadwalPendaftaran();
        
        return view('daftar-pkl.index', array_merge(compact('siswa'), $jadwalData));
    }

    /**
     * Update data siswa
     */
    public function updateSiswa(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:20',
            'nisn' => 'required|string|max:20',
            'jurusan_id' => 'required|exists:jurusans,id',
            'tempat_tanggal_lahir' => 'required|string',
            'gender' => 'required|in:Perempuan,Laki-Laki',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        $siswa->update($validated);

        return redirect()->route('daftar-pkl.index2')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Show step 2: Pilihan Tempat PKL
     */
    public function index2()
    {
        // Ambil semua mitra yang aktif
        $mitras = Mitra::orderBy('name')->get();
        
        // Ambil data siswa
        $siswa = Siswa::where('user_id', Auth::id())->first();
        
        // Cek jadwal pendaftaran
        $jadwalData = $this->cekJadwalPendaftaran();
        
        // Cek apakah siswa sudah punya registration
        $registration = Registration::where('siswa_id', $siswa->id)->first();
        
        // Ambil pilihan yang sudah disimpan
        $pilihan1 = $registration->mitra_1_id ?? null;
        $pilihan2 = $registration->mitra_2_id ?? null;
        
        return view('daftar-pkl.index2', array_merge(compact('mitras', 'pilihan1', 'pilihan2'), $jadwalData));
    }

    /**
     * Simpan pilihan tempat PKL
     */
    public function updatePilihan(Request $request)
    {
        $validated = $request->validate([
            'pilihan1' => 'required|exists:mitras,id',
            'pilihan2' => 'nullable|exists:mitras,id|different:pilihan1',
        ], [
            'pilihan1.required' => 'Pilihan 1 wajib diisi',
            'pilihan1.exists' => 'Mitra pilihan 1 tidak ditemukan',
            'pilihan2.exists' => 'Mitra pilihan 2 tidak ditemukan',
            'pilihan2.different' => 'Pilihan 2 tidak boleh sama dengan Pilihan 1',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        
        // Cek apakah ada jadwal pendaftaran yang aktif
        $jadwalAktif = JadwalPendaftaran::active()->first();
        
        if (!$jadwalAktif) {
            return redirect()->back()
                ->with('error', 'Belum ada jadwal pendaftaran yang aktif saat ini.');
        }

        // Update atau create registration
        Registration::updateOrCreate(
            ['siswa_id' => $siswa->id],
            [
                'mitra_1_id' => $validated['pilihan1'],
                'mitra_2_id' => $validated['pilihan2'] ?? null,
                'jadwal_pendaftaran_id' => $jadwalAktif->id,
                'status' => 'proses',
            ]
        );

        return redirect()->route('daftar-pkl.index3')
            ->with('success', 'Pilihan tempat PKL berhasil disimpan!');
    }

    /**
     * Show step 3: Upload Dokumen Pendukung
     */
    public function index3()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $dokumen = DokumenPendukung::where('siswa_id', $siswa->id)->first();
        
        // Cek jadwal pendaftaran
        $jadwalData = $this->cekJadwalPendaftaran();
        
        return view('daftar-pkl.index3', array_merge(compact('dokumen'), $jadwalData));
    }

    /**
     * Upload dan simpan dokumen pendukung
     */
    public function uploadDokumen(Request $request)
    {
        $request->validate([
            'surat_pengantar' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $siswa = auth()->user()->siswa;
        
        // Upload Surat Pengantar
        $suratPengantar = $request->file('surat_pengantar');
        $suratPengantarName = $siswa->nis . '_surat_pengantar_' . time() . '.' . $suratPengantar->getClientOriginalExtension();
        $suratPengantarPath = $suratPengantar->storeAs('dokumen/surat_pengantar', $suratPengantarName, 'public');

        // Upload CV
        $cv = $request->file('cv');
        $cvName = $siswa->nis . '_cv_' . time() . '.' . $cv->getClientOriginalExtension();
        $cvPath = $cv->storeAs('dokumen/cv', $cvName, 'public');

        // Simpan atau update dokumen
        DokumenPendukung::updateOrCreate(
            ['siswa_id' => $siswa->id],
            [
                'surat_pengantar' => basename($suratPengantarPath),
                'cv' => basename($cvPath),
            ]
        );

        return redirect()->route('daftar-pkl.index4')->with('success', 'Dokumen berhasil diupload!');
    }

    /**
     * Show step 4: Persetujuan dan Submit Final
     */
    public function index4()
    {
        $jadwalData = $this->cekJadwalPendaftaran();
        
        $siswa = Siswa::where('user_id', Auth::id())->first();
        
        // Cek apakah sudah ada registration
        $registration = Registration::where('siswa_id', $siswa->id)->first();
        
        // Cek apakah dokumen sudah lengkap
        $dokumen = DokumenPendukung::where('siswa_id', $siswa->id)->first();
        
        return view('daftar-pkl.index4', array_merge(compact('siswa', 'registration', 'dokumen'), $jadwalData));
    }

    /**
     * Submit final pendaftaran PKL
     */
    public function submitPendaftaran(Request $request)
    {
        $request->validate([
            'persetujuan' => 'required|accepted',
        ], [
            'persetujuan.required' => 'Anda harus menyetujui pernyataan terlebih dahulu',
            'persetujuan.accepted' => 'Anda harus menyetujui pernyataan terlebih dahulu',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        
        // Validasi: Pastikan sudah ada registration (dibuat di step 2)
        $registration = Registration::where('siswa_id', $siswa->id)->first();
        if (!$registration) {
            return redirect()->route('daftar-pkl.index2')
                ->with('error', 'Anda belum memilih tempat PKL. Silakan lengkapi pilihan mitra terlebih dahulu.');
        }

        // Validasi: Pastikan dokumen sudah lengkap
        $dokumen = DokumenPendukung::where('siswa_id', $siswa->id)->first();
        if (!$dokumen || !$dokumen->isComplete()) {
            return redirect()->route('daftar-pkl.index3')
                ->with('error', 'Dokumen pendukung belum lengkap. Silakan upload CV dan Surat Pengantar.');
        }

        // Validasi: Pastikan mitra_1_id sudah terisi
        if (!$registration->mitra_1_id) {
            return redirect()->route('daftar-pkl.index2')
                ->with('error', 'Pilihan mitra pertama wajib diisi.');
        }

        // Update status registration dan konfirmasi submit
        $registration->update([
            'status' => 'proses',
            'tanggal_daftar' => now(),
        ]);

        // Log untuk debugging (optional, bisa dihapus di production)
        Log::info('Pendaftaran PKL berhasil disubmit', [
            'siswa_id' => $siswa->id,
            'siswa_name' => $siswa->name,
            'mitra_1' => $registration->mitra1->name ?? 'N/A',
            'mitra_2' => $registration->mitra2->name ?? 'N/A',
            'jadwal_id' => $registration->jadwal_pendaftaran_id,
            'status' => $registration->status,
            'tanggal_daftar' => $registration->tanggal_daftar,
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'Pendaftaran PKL berhasil dikirim! Silakan cek secara berkala untuk informasi tahap berikutnya.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Helper: Cek status pendaftaran
     */
    private function cekJadwalPendaftaran()
    {
        $jadwalAktif = JadwalPendaftaran::where('is_active', true)->first();
        $isPendaftaranBuka = false;
        $pesanPendaftaran = null;
        
        if (!$jadwalAktif) {
            $pesanPendaftaran = 'Belum ada jadwal pendaftaran yang dibuka.';
        } else {
            $now = now();
            $mulai = $jadwalAktif->mulai_pendaftaran;
            $akhir = $jadwalAktif->akhir_pendaftaran;
            
            if ($now->lt($mulai)) {
                $pesanPendaftaran = 'Pendaftaran akan dibuka pada ' . $mulai->format('d M Y');
            } elseif ($now->gt($akhir)) {
                $pesanPendaftaran = 'Pendaftaran telah ditutup pada ' . $akhir->format('d M Y');
            } else {
                $isPendaftaranBuka = true;
            }
        }
        
        return compact('jadwalAktif', 'isPendaftaranBuka', 'pesanPendaftaran');
    }
}
