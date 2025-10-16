{{-- resources/views/admin/perusahaan-create.blade.php --}}
@extends('layouts.admin-layouts')
@section('title','Tambah Perusahaan | SMK N 2 Depok Sleman')

@section('content')
<div class="max-w-5xl mx-auto">
  
  {{-- Header --}}
  <div class="flex items-center gap-3 mb-8">
    <i data-lucide="building-2" class="w-7 h-7 text-[#2F463F]"></i>
    <h2 class="text-3xl font-extrabold tracking-wide text-[#2F463F]">Tambah Perusahaan</h2>
  </div>

  {{-- Error --}}
  @if ($errors->any())
    <div class="mb-6 rounded-xl bg-red-50 text-red-700 px-4 py-3 ring-1 ring-red-200">
      <ul class="list-disc list-inside space-y-1">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Form Card --}}
  <div class="bg-[#d5dddf] rounded-2xl shadow p-8">
    <h3 class="text-lg font-semibold text-[#2F463F] mb-6 text-center">Masukkan Data Perusahaan</h3>

    <form action="{{ route('admin.perusahaan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      {{-- Gambar/Logo --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Logo / Gambar Perusahaan</label>

        {{-- preview --}}
        <div class="mb-3">
          <div class="w-full md:w-64 aspect-[4/3] bg-white rounded-xl border border-gray-200 flex items-center justify-center overflow-hidden">
            <img id="preview-image" alt="Preview" class="hidden object-contain max-h-56">
            <div id="preview-placeholder" class="flex flex-col items-center text-gray-400 text-sm">
              <i data-lucide="image" class="w-8 h-8 mb-1"></i>
              Belum ada gambar
            </div>
          </div>
        </div>

        <label class="relative flex items-center justify-center bg-white rounded-xl border border-gray-300 hover:border-[#2F463F] cursor-pointer py-5 transition">
          <input
            type="file"
            name="image"
            id="image-input"
            accept="image/*"
            class="absolute inset-0 opacity-0 cursor-pointer"
          >
          <div class="flex flex-col items-center text-gray-500">
            <i data-lucide="image-plus" class="w-7 h-7 mb-2"></i>
            <p class="text-xs">Klik untuk memilih gambar (.jpg/.png/.webp, maks 2MB)</p>
          </div>
        </label>
        @error('image')
          <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Nama --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Nama Perusahaan</label>
        <input name="name" value="{{ old('name') }}" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
      </div>

      {{-- Lokasi --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Lokasi</label>
        <input name="alamat" value="{{ old('alamat') }}" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
      </div>

      {{-- Deskripsi --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Deskripsi Singkat</label>
        <textarea name="deskripsi" rows="4" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">{{ old('deskripsi') }}</textarea>
      </div>

      {{-- Kuota + Jurusan --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-[#2F463F] mb-2">Kuota</label>
          <input type="number" name="kuota" value="{{ old('kuota') }}" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
        </div>
        <div>
          <label class="block text-sm font-medium text-[#2F463F] mb-2">Jurusan</label>
          <select name="jurusan_id" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
            <option value="">Pilih Jurusan</option>
            @foreach($jurusans as $j)
              <option value="{{ $j->id }}" @selected(old('jurusan_id')==$j->id)>{{ $j->nama_jurusan }}</option>
            @endforeach
          </select>
        </div>
      </div>

      {{-- Posisi --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Posisi Pekerjaan</label>
        <input name="posisi" value="{{ old('posisi') }}" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
      </div>

      {{-- Kontak --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Kontak</label>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <input name="instagram" placeholder="Instagram" value="{{ old('instagram') }}" class="rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
          <input name="telepon" placeholder="Telepon" value="{{ old('telepon') }}" class="rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
        </div>
      </div>

      {{-- Submit --}}
      <div class="flex justify-center pt-4">
        <button class="inline-flex items-center gap-2 px-10 py-3.5 rounded-full bg-[#2F463F] text-white font-medium hover:opacity-90 transition">
          <i data-lucide="upload" class="w-5 h-5"></i>
          Simpan
        </button>
      </div>

    </form>
  </div>
</div>

{{-- Preview script --}}
<script>
  const input = document.getElementById('image-input');
  const img   = document.getElementById('preview-image');
  const ph    = document.getElementById('preview-placeholder');

  input?.addEventListener('change', (e) => {
    const file = e.target.files?.[0];
    if (!file) {
      img.classList.add('hidden');
      ph.classList.remove('hidden');
      img.src = '';
      return;
    }
    const url = URL.createObjectURL(file);
    img.src = url;
    img.onload = () => URL.revokeObjectURL(url);
    img.classList.remove('hidden');
    ph.classList.add('hidden');
  });

  lucide.createIcons();
</script>
@endsection
