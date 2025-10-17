<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // =========================================================
    // ===============  ADMIN (protected)  =====================
    // =========================================================

    /**
     * List berita untuk admin.
     */
    public function index()
    {
        $beritas = Berita::latest()->paginate(6);
        return view('admin.berita', compact('beritas'));
    }

    /**
     * Form tambah berita.
     */
    public function create()
    {
        return view('admin.berita-create');
    }

    /**
     * Simpan berita baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'isi'   => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $path = $request->hasFile('image')
            ? $request->file('image')->store('berita', 'public')
            : null;

        Berita::create([
            'user_id' => Auth::id(),
            'judul'   => $data['judul'],
            'isi'     => $data['isi'],
            'gambar'  => $path,
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Detail berita (admin).
     */
    public function show(Berita $berita)
    {
        return view('admin.berita-show', compact('berita'));
    }

    /**
     * Form edit berita.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita-edit', compact('berita'));
    }

    /**
     * Update berita.
     */
    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'isi'   => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Update gambar jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('image')->store('berita', 'public');
        }

        $berita->update([
            'judul' => $data['judul'],
            'isi'   => $data['isi'],
            'gambar' => $data['gambar'] ?? $berita->gambar,
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita.
     */
    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // =========================================================
    // =====================  PUBLIK  ==========================
    // =========================================================

    /**
     * List berita untuk halaman publik.
     */
    public function publicIndex()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('berita.index', compact('beritas'));
    }
  /**
     *  Detail berita publik (“Baca selengkapnya”).
     */
    public function publicShow(Berita $berita)
    {
        $lainnya = Berita::whereKeyNot($berita->id)
            ->latest()
            ->take(6)
            ->get();

        return view('berita.show', compact('berita', 'lainnya'));
    }
}
