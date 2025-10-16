<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at'); // default sort by created_at
        $direction = $request->get('direction', 'desc'); // default descending
        
        // Validasi sort column untuk keamanan
        $allowedSorts = ['name', 'nis', 'jurusan_id', 'created_at'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        
        // Validasi direction
        $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'desc';
        
        $siswas = Siswa::with(['jurusan', 'registration'])
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends(['sort' => $sort, 'direction' => $direction]); // Preserve query params in pagination

        return view('admin.siswa', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.siswa-create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'nis' => 'required|string|unique:siswas,nis',
            'nisn' => 'required|string|unique:siswas,nisn',
            'jurusan_id' => 'required|exists:jurusans,id',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        // Buat user terlebih dahulu
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'siswa',
        ]);

        // Buat data siswa
        Siswa::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'nis' => $validated['nis'],
            'nisn' => $validated['nisn'],
            'jurusan_id' => $validated['jurusan_id'],
            'gender' => $validated['gender'],
            'tempat_tanggal_lahir' => $validated['tempat_tanggal_lahir'] ?? null,
            'kontak' => $validated['kontak'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        // Load relationships
        $siswa->load([
            'user',
            'jurusan',
            'registration.mitra1',
            'registration.mitra2',
            'registration.mitraDiterima',
            'registration.guruPendamping',
            'registration.jadwal'
        ]);
        
        return view('admin.siswa-show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $jurusans = Jurusan::all();
        $siswa->load('user', 'jurusan');
        return view('admin.siswa-edit', compact('siswa', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $siswa->user_id,
            'password' => 'nullable|string|min:8',
            'nis' => 'required|string|unique:siswas,nis,' . $siswa->id,
            'nisn' => 'required|string|unique:siswas,nisn,' . $siswa->id,
            'jurusan_id' => 'required|exists:jurusans,id',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        // Update user data
        $siswa->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $siswa->user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        // Update siswa data
        $siswa->update([
            'name' => $validated['name'],
            'nis' => $validated['nis'],
            'nisn' => $validated['nisn'],
            'jurusan_id' => $validated['jurusan_id'],
            'gender' => $validated['gender'],
            'tempat_tanggal_lahir' => $validated['tempat_tanggal_lahir'] ?? null,
            'kontak' => $validated['kontak'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('admin.siswa.show', $siswa->id)
            ->with('success', 'Data siswa berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        // Hapus user terkait (akan cascade delete siswa)
        $siswa->user->delete();

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa berhasil dihapus!')
            ->with('notification', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'message' => 'Data siswa berhasil dihapus!'
            ]);
    }
}
