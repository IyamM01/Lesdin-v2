@extends('layouts.admin-layouts')

@section('title', 'Daftar Berita | SMK N 2 Depok Sleman')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <i data-lucide="newspaper" class="w-7 h-7 text-[#2F463F]"></i>
            <h2 class="text-3xl font-extrabold tracking-wide text-[#2F463F]">Daftar Berita</h2>
        </div>
        <a href="{{ route('admin.berita.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-[#3C5148] text-white rounded-lg hover:bg-[#2F463F] transition duration-200">
            <i data-lucide="plus" class="w-5 h-5"></i>
            <span>Tambah Berita</span>
        </a>
    </div>

    @if (session('success'))
      <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3 ring-1 ring-green-200">
        {{ session('success') }}
      </div>
    @endif

    <div class="bg-white rounded-2xl shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Kartu Berita --}}
            @forelse ($beritas as $b)
                @php
                    $img = $b->gambar
                        ? (\Illuminate\Support\Str::startsWith($b->gambar, ['http://','https://'])
                            ? $b->gambar
                            : \Illuminate\Support\Facades\Storage::url($b->gambar))
                        : asset('images/news-placeholder.jpg');
                @endphp

                <article class="relative rounded-xl shadow-sm ring-1 ring-gray-100 overflow-hidden bg-white">
                    {{-- Tombol Edit & Hapus --}}
                    <div class="absolute right-3 top-3 z-10 flex gap-2">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.berita.edit', $b->id) }}" 
                           class="p-2 rounded-full bg-white/90 hover:bg-white shadow">
                            <i data-lucide="edit" class="w-4 h-4 text-blue-600"></i>
                        </a>
                        
                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST"
                              onsubmit="return confirm('Hapus berita ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-full bg-white/90 hover:bg-white shadow">
                                <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Gambar --}}
                    <img src="{{ $img }}" alt="{{ $b->judul }}" class="w-full h-40 object-cover">

                    {{-- Konten --}}
                    <div class="p-4">
                        <span class="text-xs font-semibold text-green-700">
                            {{ \Carbon\Carbon::parse($b->created_at)->translatedFormat('d F Y') }}
                        </span>
                        <h4 class="mt-1 font-semibold text-gray-900 leading-tight line-clamp-2">
                            {{ $b->judul }}
                        </h4>
                        <p class="mt-1 text-sm text-gray-600 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit(strip_tags($b->isi), 120) }}
                        </p>

                        @if (Route::has('admin.berita.show'))
                        <a href="{{ route('admin.berita.show', $b->id) }}"
                           class="mt-3 inline-flex items-center gap-1 text-sm text-emerald-700 hover:underline">
                            Baca Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        @endif
                    </div>
                </article>
            @empty
                <div class="col-span-2 text-center text-gray-500 py-12">Belum ada berita.</div>
            @endforelse

            {{-- Kartu Plus (ke halaman create) --}}
            <a href="{{ route('admin.berita.create') }}"
               class="rounded-xl ring-1 ring-gray-100 bg-white hover:bg-gray-50 transition grid place-items-center min-h-[196px]">
                <div class="flex flex-col items-center text-[#2F463F]">
                    <i data-lucide="plus" class="w-12 h-12"></i>
                    <span class="mt-2 text-sm font-medium">Tambah Berita</span>
                </div>
            </a>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $beritas->links() }}
        </div>
    </div>
</div>
<script>lucide.createIcons();</script>
@endsection

