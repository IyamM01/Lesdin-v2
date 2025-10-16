<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPendaftaran;
use Illuminate\Http\Request;

class JadwalPendaftaranController extends Controller
{
    /**
     * Tampilkan daftar jadwal pendaftaran
     */
    public function index()
    {
        $jadwals = JadwalPendaftaran::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Form tambah jadwal
     */
    public function create()
    {
        return view('admin.jadwal.create');
    }

    /**
     * Simpan jadwal baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'mulai_pendaftaran' => 'required|date',
            'akhir_pendaftaran' => 'required|date|after:mulai_pendaftaran',
            'tanggal_pengumuman' => 'nullable|date|after:akhir_pendaftaran',
            'is_active' => 'boolean',
        ], [
            'nama_periode.required' => 'Nama periode harus diisi',
            'mulai_pendaftaran.required' => 'Tanggal mulai pendaftaran harus diisi',
            'akhir_pendaftaran.required' => 'Tanggal akhir pendaftaran harus diisi',
            'akhir_pendaftaran.after' => 'Tanggal akhir harus setelah tanggal mulai',
            'tanggal_pengumuman.after' => 'Tanggal pengumuman harus setelah tanggal akhir pendaftaran',
        ]);

        // Jika is_active true, nonaktifkan jadwal lain
        if ($request->is_active) {
            JadwalPendaftaran::where('is_active', true)->update(['is_active' => false]);
        }

        JadwalPendaftaran::create([
            'nama_periode' => $request->nama_periode,
            'mulai_pendaftaran' => $request->mulai_pendaftaran,
            'akhir_pendaftaran' => $request->akhir_pendaftaran,
            'tanggal_pengumuman' => $request->tanggal_pengumuman,
            'is_active' => $request->is_active ?? false,
        ]);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal pendaftaran berhasil ditambahkan!');
    }

    /**
     * Form edit jadwal
     */
    public function edit(JadwalPendaftaran $jadwal)
    {
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update jadwal
     */
    public function update(Request $request, JadwalPendaftaran $jadwal)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'mulai_pendaftaran' => 'required|date',
            'akhir_pendaftaran' => 'required|date|after:mulai_pendaftaran',
            'tanggal_pengumuman' => 'nullable|date|after:akhir_pendaftaran',
            'is_active' => 'boolean',
        ], [
            'nama_periode.required' => 'Nama periode harus diisi',
            'mulai_pendaftaran.required' => 'Tanggal mulai pendaftaran harus diisi',
            'akhir_pendaftaran.required' => 'Tanggal akhir pendaftaran harus diisi',
            'akhir_pendaftaran.after' => 'Tanggal akhir harus setelah tanggal mulai',
            'tanggal_pengumuman.after' => 'Tanggal pengumuman harus setelah tanggal akhir pendaftaran',
        ]);

        // Jika is_active true, nonaktifkan jadwal lain
        if ($request->is_active) {
            JadwalPendaftaran::where('is_active', true)
                ->where('id', '!=', $jadwal->id)
                ->update(['is_active' => false]);
        }

        $jadwal->update([
            'nama_periode' => $request->nama_periode,
            'mulai_pendaftaran' => $request->mulai_pendaftaran,
            'akhir_pendaftaran' => $request->akhir_pendaftaran,
            'tanggal_pengumuman' => $request->tanggal_pengumuman,
            'is_active' => $request->is_active ?? false,
        ]);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal pendaftaran berhasil diupdate!');
    }

    /**
     * Aktifkan/Nonaktifkan jadwal
     */
    public function toggleActive(JadwalPendaftaran $jadwal)
    {
        if (!$jadwal->is_active) {
            // Nonaktifkan semua jadwal lain
            JadwalPendaftaran::where('is_active', true)->update(['is_active' => false]);
        }

        $jadwal->update(['is_active' => !$jadwal->is_active]);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Status jadwal berhasil diubah!');
    }

    /**
     * Hapus jadwal
     */
    public function destroy(JadwalPendaftaran $jadwal)
    {
        // Cek apakah ada pendaftaran yang menggunakan jadwal ini
        if ($jadwal->registrations()->count() > 0) {
            return back()->with('error', 'Jadwal tidak dapat dihapus karena sudah digunakan dalam pendaftaran!');
        }

        $jadwal->delete();

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal pendaftaran berhasil dihapus!');
    }
}
