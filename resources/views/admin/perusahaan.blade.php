{{-- resources/views/admin/perusahaan.blade.php --}}
@extends('layouts.admin-layouts')
@section('title','Daftar Perusahaan | SMK N 2 Depok Sleman')

@section('content')
<div class="max-w-6xl mx-auto">
  <!-- Header -->
  <div class="flex items-center gap-3 mb-6">
    <i data-lucide="building-2" class="w-7 h-7 text-[#3C5148]"></i>
    <h2 class="text-3xl font-extrabold tracking-wide text-[#3C5148]">Daftar Perusahaan</h2>
  </div>

  <!-- Flash Success -->
  @if(session('success'))
    <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3 ring-1 ring-green-200">
      {{ session('success') }}
    </div>
  @endif

  <!-- Main Card -->
  <div class="bg-white rounded-2xl shadow p-6 border border-[#F3F4F6]">
    
    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      @foreach($mitras as $i => $m)
        @php
          // Ambil gambar dari DB, fallback ke gama.png
          $img = $m->image ? asset('images/'.$m->image) : asset('images/gama.png');
        @endphp

        <div class="relative rounded-2xl border border-[#F3F4F6] bg-white p-4 shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
          
          <!-- Nomor urut -->
          <div class="text-xs text-gray-500 mb-1">
            {{ method_exists($mitras,'firstItem') ? $mitras->firstItem() + $i : $i+1 }}
          </div>
          
          <!-- Nama perusahaan -->
          <div class="font-medium text-sm mb-3 text-[#2F463F]">{{ $m->name }}</div>

          {{-- logo dari DB (kolom: image) --}}
          <a href="{{ route('admin.perusahaan.show', $m->id) }}" class="block">
            <div class="bg-white rounded-xl border h-32 grid place-items-center overflow-hidden hover:border-[#3C5148] transition">
              <img src="{{ $img }}" alt="{{ $m->name }}" class="object-contain max-h-28">
            </div>
          </a>

          {{-- Info singkat --}}
          <div class="mt-3 space-y-1">
            @if($m->jurusan)
              <div class="text-xs text-gray-600 flex items-center gap-1">
                <i data-lucide="graduation-cap" class="w-3 h-3"></i>
                <span>{{ $m->jurusan->nama_jurusan }}</span>
              </div>
            @endif
            @if($m->alamat)
              <div class="text-xs text-gray-600 flex items-center gap-1">
                <i data-lucide="map-pin" class="w-3 h-3"></i>
                <span class="line-clamp-1">{{ $m->alamat }}</span>
              </div>
            @endif
          </div>

          {{-- Tombol Aksi --}}
          <div class="absolute top-3 right-3 flex gap-1">
            <a href="{{ route('admin.perusahaan.show', $m->id) }}" 
               class="p-2 bg-white/90 rounded-full shadow hover:bg-white">
              <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
            </a>
            <form action="{{ route('admin.perusahaan.destroy', $m->id) }}" method="POST"
                  onsubmit="return confirm('Hapus perusahaan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="p-2 bg-white/90 rounded-full shadow hover:bg-white">
                <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
              </button>
            </form>
          </div>
        </div>
      @endforeach

      <!-- Kartu Tambah -->
      <a href="{{ route('admin.perusahaan.create') }}"
         class="rounded-2xl border border-[#F3F4F6] bg-white flex flex-col items-center justify-center min-h-[160px] shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group">
        <div class="flex flex-col items-center text-[#3C5148]">
          <i data-lucide="plus" class="w-12 h-12 group-hover:text-[#FEBC2F] transition"></i>
          <span class="mt-1 text-sm font-medium">Tambah</span>
        </div>
      </a>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{ $mitras->links() }}
    </div>
  </div>
</div>

<script>
  lucide.createIcons();
</script>
@endsection
