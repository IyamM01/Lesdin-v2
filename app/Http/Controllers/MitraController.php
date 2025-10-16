<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Mitra;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::all();
        $mitras = Mitra::with('jurusan')->get();
        $jurusans = Jurusan::all();
        return view('mitra.index', compact('beritas', 'mitras', 'jurusans'));
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
    public function show($id)
    {
        $mitra = Mitra::with('jurusan')->findOrFail($id); // ambil data mitra
        return view('mitra.mitra', compact('mitra'));
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
}
