{{-- resources/views/admin/perusahaan-edit.blade.php --}}
@extends('layouts.admin-layouts')
@section('title','Edit Perusahaan | SMK N 2 Depok Sleman')

@section('content')
<div class="max-w-5xl mx-auto">
  
  {{-- Header --}}
  <div class="flex items-center gap-3 mb-8">
    <a href="{{ route('admin.perusahaan.show', $mitra->id) }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
      <i data-lucide="arrow-left" class="w-6 h-6 text-gray-600"></i>
    </a>
    <div>
      <h2 class="text-3xl font-extrabold tracking-wide text-[#2F463F]">Edit Perusahaan</h2>
      <p class="text-sm text-gray-500 mt-1">{{ $mitra->name }}</p>
    </div>
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
    <h3 class="text-lg font-semibold text-[#2F463F] mb-6 text-center">Perbarui Data Perusahaan</h3>

    <form action="{{ route('admin.perusahaan.update', $mitra->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      {{-- Gambar/Logo --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Logo / Gambar Perusahaan</label>

        {{-- preview --}}
        <div class="mb-3">
          <div class="w-full md:w-64 aspect-[4/3] bg-white rounded-xl border border-gray-200 flex items-center justify-center overflow-hidden">
            @if($mitra->image)
              <img id="preview-image" src="{{ asset('images/'.$mitra->image) }}" alt="Preview" class="object-contain max-h-56">
              <div id="preview-placeholder" class="hidden flex flex-col items-center text-gray-400 text-sm">
                <i data-lucide="image" class="w-8 h-8 mb-1"></i>
                Belum ada gambar
              </div>
            @else
              <img id="preview-image" alt="Preview" class="hidden object-contain max-h-56">
              <div id="preview-placeholder" class="flex flex-col items-center text-gray-400 text-sm">
                <i data-lucide="image" class="w-8 h-8 mb-1"></i>
                Belum ada gambar
              </div>
            @endif
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
            <p class="text-xs">Klik untuk {{ $mitra->image ? 'mengganti' : 'memilih' }} gambar (.jpg/.png/.webp, maks 2MB)</p>
          </div>
        </label>
        @error('image')
          <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Nama --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Nama Perusahaan <span class="text-red-500">*</span></label>
        <input name="name" value="{{ old('name', $mitra->name) }}" required class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
      </div>

      {{-- Lokasi --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Lokasi</label>
        <input name="alamat" value="{{ old('alamat', $mitra->alamat) }}" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
      </div>

      {{-- Deskripsi --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Deskripsi Singkat</label>
        <textarea name="deskripsi" rows="4" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">{{ old('deskripsi', $mitra->deskripsi) }}</textarea>
      </div>

      {{-- Kuota + Jurusan --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-[#2F463F] mb-2">Kuota</label>
          <input type="number" name="kuota" value="{{ old('kuota', $mitra->kuota) }}" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
        </div>
        <div>
          <label class="block text-sm font-medium text-[#2F463F] mb-2">Jurusan</label>
          <select name="jurusan_id" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
            <option value="">Pilih Jurusan</option>
            @foreach($jurusans as $j)
              <option value="{{ $j->id }}" @selected(old('jurusan_id', $mitra->jurusan_id)==$j->id)>{{ $j->nama_jurusan }}</option>
            @endforeach
          </select>
        </div>
      </div>

      {{-- Posisi --}}
      <div>
        <label class="block text-sm font-medium text-[#2F463F] mb-2">Posisi Pekerjaan</label>
        <input name="posisi" value="{{ old('posisi', $mitra->posisi) }}" placeholder="contoh: Staff IT, Marketing, Accounting" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
        <p class="mt-1 text-xs text-gray-500">Pisahkan dengan koma jika ada beberapa posisi</p>
      </div>

      {{-- Instagram + Email + Telepon --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
          <label class="block text-sm font-medium text-[#2F463F] mb-2">Instagram</label>
          <input name="instagram" value="{{ old('instagram', $mitra->instagram) }}" placeholder="@nama_ig" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
        </div>
        <div>
          <label class="block text-sm font-medium text-[#2F463F] mb-2">Email</label>
          <input type="email" name="email" value="{{ old('email', $mitra->email) }}" placeholder="info@perusahaan.com" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
        </div>
        <div>
          <label class="block text-sm font-medium text-[#2F463F] mb-2">Telepon</label>
          <input name="telepon" value="{{ old('telepon', $mitra->telepon) }}" placeholder="081234567890" class="w-full rounded-xl border-gray-300 bg-white px-4 py-2.5 focus:border-[#2F463F] focus:ring-[#2F463F]">
        </div>
      </div>

      {{-- Tombol --}}
      <div class="flex items-center gap-3 pt-4">
        <button type="submit" class="flex-1 bg-[#3C5148] text-white py-3 px-6 rounded-xl hover:bg-[#2F463F] transition font-medium">
          <i data-lucide="save" class="inline-block w-4 h-4 mr-2"></i>
          Simpan Perubahan
        </button>
        <a href="{{ route('admin.perusahaan.show', $mitra->id) }}" class="flex-1 bg-gray-400 text-white py-3 px-6 rounded-xl hover:bg-gray-500 transition font-medium text-center">
          <i data-lucide="x" class="inline-block w-4 h-4 mr-2"></i>
          Batal
        </a>
      </div>
    </form>
  </div>
</div>

<script>
  // Preview gambar
  const input = document.getElementById('image-input');
  const preview = document.getElementById('preview-image');
  const placeholder = document.getElementById('preview-placeholder');

  input.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(evt) {
        preview.src = evt.target.result;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
      };
      reader.readAsDataURL(file);
    }
  });

  lucide.createIcons();
</script>
@endsection
