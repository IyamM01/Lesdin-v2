<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\GuruPendamping;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Tampilkan daftar pendaftaran PKL
     */
    public function index(Request $request)
    {
        $query = Registration::with(['siswa.user', 'siswa.jurusan', 'mitra1', 'mitra2', 'mitraDiterima', 'guruPendamping'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $registrations = $query->paginate(15);

        return view('admin.registrations.index', compact('registrations'));
    }

    /**
     * Tampilkan detail pendaftaran untuk approval
     */
    public function show(Registration $registration)
    {
        $registration->load([
            'siswa.user',
            'siswa.jurusan',
            'mitra1',
            'mitra2',
            'mitraDiterima',
            'guruPendamping',
            'jadwalPendaftaran'
        ]);

        // Load dokumen pendukung
        $dokumen = $registration->siswa->dokumenPendukung;

        // Load semua guru pendamping untuk dropdown
        $guruPendampings = GuruPendamping::all();

        return view('admin.registrations.show', compact('registration', 'dokumen', 'guruPendampings'));
    }

    /**
     * Approve pendaftaran dan pilih mitra
     */
    public function approve(Request $request, Registration $registration)
    {
        $request->validate([
            'mitra_diterima_id' => 'required|in:' . $registration->mitra_1_id . ',' . $registration->mitra_2_id,
            'guru_pendamping_id' => 'required|exists:guru_pendampings,id',
        ], [
            'mitra_diterima_id.required' => 'Pilih salah satu mitra yang diterima',
            'mitra_diterima_id.in' => 'Mitra yang dipilih harus salah satu dari pilihan siswa',
            'guru_pendamping_id.required' => 'Pilih guru pendamping',
            'guru_pendamping_id.exists' => 'Guru pendamping tidak valid',
        ]);

        $registration->update([
            'status' => 'diterima',
            'mitra_diterima_id' => $request->mitra_diterima_id,
            'guru_pendamping_id' => $request->guru_pendamping_id,
        ]);

        return redirect()
            ->route('admin.registrations.show', $registration)
            ->with('success', 'Pendaftaran berhasil disetujui!');
    }

    /**
     * Tolak pendaftaran
     */
    public function reject(Request $request, Registration $registration)
    {
        $request->validate([
            'alasan_penolakan' => 'nullable|string|max:500',
        ]);

        $registration->update([
            'status' => 'ditolak',
            'mitra_diterima_id' => null,
            'guru_pendamping_id' => null,
        ]);

        return redirect()
            ->route('admin.registrations.index')
            ->with('success', 'Pendaftaran ditolak');
    }

    /**
     * Update status menjadi selesai
     */
    public function complete(Registration $registration)
    {
        if ($registration->status !== 'diterima') {
            return back()->with('error', 'Hanya pendaftaran yang diterima yang bisa diselesaikan');
        }

        $registration->update([
            'status' => 'selesai',
        ]);

        return redirect()
            ->route('admin.registrations.show', $registration)
            ->with('success', 'Status PKL berhasil diubah menjadi Selesai');
    }
}
