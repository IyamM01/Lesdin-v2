<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Jurusan;

class MitraAdminController extends Controller
{
    public function index()
    {
        $mitras   = Mitra::with('jurusan')->latest()->paginate(8);
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();
        return view('admin.perusahaan', compact('mitras','jurusans'));
    }

    public function create()
    {
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();
        return view('admin.perusahaan-create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // ganti 'logo' → 'image' dan izinkan webp
            'image'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'name'        => ['required','string','max:200'],
            'alamat'      => ['nullable','string','max:255'],
            'deskripsi'   => ['nullable','string'],
            'kuota'       => ['nullable','integer','min:0'],
            'jurusan_id'  => ['nullable','exists:jurusans,id'],
            'posisi'      => ['nullable','string','max:200'],
            'instagram'   => ['nullable','string','max:200'],
            'email'       => ['nullable','email','max:200'],
            'telepon'     => ['nullable','string','max:50'],
        ]);

        // simpan ke public/images dan taruh NAMA FILE ke kolom 'image'
        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            @mkdir(public_path('images'), 0775, true); // pastikan folder ada
            $filename = uniqid('mitra_').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
        }

        Mitra::create([
            'name'        => $data['name'],
            'alamat'      => $data['alamat'] ?? null,
            'deskripsi'   => $data['deskripsi'] ?? null,
            'kuota'       => $data['kuota'] ?? 0,
            'jurusan_id'  => $data['jurusan_id'] ?? null,
            'posisi'      => $data['posisi'] ?? null,
            'instagram'   => $data['instagram'] ?? null,
            'email'       => $data['email'] ?? null,
            'telepon'     => $data['telepon'] ?? null,
            'image'       => $filename, // ⟵ konsisten dengan index.blade.php
        ]);

        return redirect()->route('admin.perusahaan')->with('success','Perusahaan berhasil ditambahkan.');
    }

    public function show(Mitra $mitra)
    {
        // Load relasi yang dibutuhkan
        $mitra->load([
            'jurusan',
            'registrationsDiterima.siswa.user',
            'registrationsDiterima.siswa.jurusan'
        ]);
        
        return view('admin.perusahaan-show', compact('mitra'));
    }

    public function edit(Mitra $mitra)
    {
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();
        return view('admin.perusahaan-edit', compact('mitra', 'jurusans'));
    }

    public function update(Request $request, Mitra $mitra)
    {
        $data = $request->validate([
            'image'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'name'        => ['required','string','max:200'],
            'alamat'      => ['nullable','string','max:255'],
            'deskripsi'   => ['nullable','string'],
            'kuota'       => ['nullable','integer','min:0'],
            'jurusan_id'  => ['nullable','exists:jurusans,id'],
            'posisi'      => ['nullable','string','max:200'],
            'instagram'   => ['nullable','string','max:200'],
            'email'       => ['nullable','email','max:200'],
            'telepon'     => ['nullable','string','max:50'],
        ]);

        // Upload gambar baru jika ada
        $filename = $mitra->image; // gunakan gambar lama sebagai default
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if (!empty($mitra->image)) {
                $oldPath = public_path('images/'.$mitra->image);
                if (is_file($oldPath)) @unlink($oldPath);
            }
            
            // Upload gambar baru
            $file = $request->file('image');
            @mkdir(public_path('images'), 0775, true);
            $filename = uniqid('mitra_').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
        }

        // Update data mitra
        $mitra->update([
            'name'        => $data['name'],
            'alamat'      => $data['alamat'] ?? null,
            'deskripsi'   => $data['deskripsi'] ?? null,
            'kuota'       => $data['kuota'] ?? 0,
            'jurusan_id'  => $data['jurusan_id'] ?? null,
            'posisi'      => $data['posisi'] ?? null,
            'instagram'   => $data['instagram'] ?? null,
            'email'       => $data['email'] ?? null,
            'telepon'     => $data['telepon'] ?? null,
            'image'       => $filename,
        ]);

        return redirect()->route('admin.perusahaan.show', $mitra->id)
            ->with('success','Perusahaan berhasil diperbarui.');
    }

    public function destroy(Mitra $mitra)
    {
        // hapus file di public/images bila ada
        if (!empty($mitra->image)) {
            $fullpath = public_path('images/'.$mitra->image);
            if (is_file($fullpath)) @unlink($fullpath);
        }
        $mitra->delete();
        return back()->with('success','Perusahaan dihapus.');
    }
}
