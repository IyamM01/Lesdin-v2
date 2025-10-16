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

          <!-- Logo -->
          <div class="bg-white rounded-xl border border-gray-200 h-32 w-full flex items-center justify-center overflow-hidden">
            <img src="{{ $img }}" alt="{{ $m->name }}" class="object-contain max-h-28 w-auto">
          </div>

          <!-- Tombol Hapus -->
          <form action="{{ route('admin.perusahaan.destroy', $m->id) }}" method="POST"
                onsubmit="return confirm('Hapus perusahaan ini?')"
                class="absolute top-3 right-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-2 bg-white/90 rounded-full shadow hover:bg-red-50 transition">
              <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
            </button>
          </form>
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
