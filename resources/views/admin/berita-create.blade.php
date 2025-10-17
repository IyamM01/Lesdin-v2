@extends('layouts.admin-layouts')

@section('title', 'Tambah Berita | SMK N 2 Depok Sleman')

@section('content')
<div class="max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <i data-lucide="newspaper" class="w-7 h-7 text-[#2F463F]"></i>
        <h2 class="text-3xl font-extrabold tracking-wide text-[#2F463F]">Daftar Berita</h2>
    </div>

    {{-- Notifikasi --}}
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 text-red-700 px-4 py-3 ring-1 ring-red-200">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3 ring-1 ring-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM TAMBAH BERITA --}}
    <div class="bg-[#E8ECEB] rounded-2xl shadow-md p-8">
        <h3 class="text-center font-semibold text-[#2F463F] mb-6">Tambahkan Berita Baru</h3>

        <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- FOTO BERITA + PREVIEW --}}
            <div>
                <label for="image-input" class="block text-sm text-[#2F463F] mb-1 font-medium">
                    Foto Berita
                </label>

                <div class="relative flex flex-col items-center justify-center bg-white rounded-xl border border-gray-300 hover:border-[#2F463F] transition-colors duration-200 p-0 overflow-hidden">
                    {{-- Input file transparan menutupi area klik --}}
                    <input id="image-input" type="file" name="image" accept="image/*"
                           class="absolute inset-0 opacity-0 cursor-pointer">

                    {{-- Placeholder ketika belum ada gambar --}}
                    <div id="image-placeholder" class="flex flex-col items-center py-6 text-gray-400 w-full">
                        <i data-lucide="image-plus" class="w-8 h-8 mb-2"></i>
                        <p class="text-sm">Klik untuk memilih gambar</p>
                    </div>

                    {{-- Preview muncul setelah memilih gambar --}}
                    <div id="preview-wrapper" class="w-full hidden">
                        <img id="image-preview" alt="Preview gambar berita"
                             class="w-full h-64 object-cover">
                        <div class="flex items-center justify-between gap-3 px-4 py-3 bg-white border-t">
                            <p id="file-name" class="text-xs text-gray-600 truncate flex-1"></p>
                            <button type="button" id="change-image"
                                    class="text-xs px-3 py-1.5 rounded-full border border-[#2F463F] text-[#2F463F] hover:bg-[#2F463F] hover:text-white transition">
                                Ganti Gambar
                            </button>
                            <button type="button" id="remove-image"
                                    class="text-xs px-3 py-1.5 rounded-full border border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <p class="text-xs text-gray-500 mt-2">.jpg, .jpeg, .png — max 2MB</p>
                <p id="image-error" class="hidden mt-2 text-xs text-red-600"></p>
            </div>

            {{-- JUDUL --}}
            <div>
                <label class="block text-sm text-[#2F463F] mb-1 font-medium">Judul Berita</label>
                <input type="text" name="judul" value="{{ old('judul') }}"
                    class="w-full rounded-xl border-gray-300 bg-white text-gray-800 focus:border-[#2F463F] focus:ring-[#2F463F]"
                    placeholder="Masukkan judul berita">
            </div>

            {{-- ISI BERITA --}}
            <div>
                <label class="block text-sm text-[#2F463F] mb-1 font-medium">Isi Berita</label>
                <textarea name="isi" rows="6"
                    class="w-full rounded-xl border-gray-300 bg-white text-gray-800 focus:border-[#2F463F] focus:ring-[#2F463F]"
                    placeholder="Tulis isi berita di sini...">{{ old('isi') }}</textarea>
            </div>

            {{-- TOMBOL --}}
            <div class="flex justify-center">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-[#2F463F] text-white font-medium hover:opacity-90 transition">
                    <i data-lucide="upload" class="w-5 h-5"></i>
                    Unggah
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    lucide.createIcons();

    const input     = document.getElementById('image-input');
    const errorEl   = document.getElementById('image-error');
    const placeholder = document.getElementById('image-placeholder');
    const previewWrap = document.getElementById('preview-wrapper');
    const previewImg  = document.getElementById('image-preview');
    const fileNameEl  = document.getElementById('file-name');
    const changeBtn   = document.getElementById('change-image');
    const removeBtn   = document.getElementById('remove-image');

    const MAX_SIZE = 2 * 1024 * 1024; // 2MB
    const ALLOWED  = ['image/jpeg','image/jpg','image/png','image/webp'];

    function resetPreview() {
        input.value = '';
        previewWrap.classList.add('hidden');
        placeholder.classList.remove('hidden');
        errorEl.classList.add('hidden');
        errorEl.textContent = '';
        previewImg.src = '';
        fileNameEl.textContent = '';
    }

    function showPreview(file) {
        const url = URL.createObjectURL(file);
        previewImg.src = url;
        fileNameEl.textContent = file.name;
        placeholder.classList.add('hidden');
        previewWrap.classList.remove('hidden');
    }

    input.addEventListener('change', (e) => {
        errorEl.classList.add('hidden');
        errorEl.textContent = '';

        const file = e.target.files && e.target.files[0];
        if (!file) { resetPreview(); return; }

        if (!ALLOWED.includes(file.type)) {
            errorEl.textContent = 'Format tidak didukung. Gunakan JPG/PNG/WebP.';
            errorEl.classList.remove('hidden');
            resetPreview();
            return;
        }

        if (file.size > MAX_SIZE) {
            errorEl.textContent = 'Ukuran file melebihi 2MB.';
            errorEl.classList.remove('hidden');
            resetPreview();
            return;
        }

        showPreview(file);
    });

    changeBtn.addEventListener('click', () => input.click());
    removeBtn.addEventListener('click', resetPreview);
</script>
@endsection
