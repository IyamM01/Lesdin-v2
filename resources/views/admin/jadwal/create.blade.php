@extends('layouts.admin-layouts')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Jadwal Pendaftaran</h1>
            <p class="text-sm text-gray-500 mt-1">Buat jadwal pendaftaran PKL baru</p>
        </div>
        <a href="{{ route('admin.jadwal.index') }}" 
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form method="POST" action="{{ route('admin.jadwal.store') }}" class="space-y-6">
            @csrf

            <!-- Nama Periode -->
            <div>
                <label for="nama_periode" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Periode *
                </label>
                <input type="text" 
                       name="nama_periode" 
                       id="nama_periode"
                       value="{{ old('nama_periode') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_periode') border-red-500 @enderror"
                       placeholder="Contoh: Periode PKL Semester Genap 2025"
                       required>
                @error('nama_periode')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Mulai & Akhir -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="mulai_pendaftaran" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Mulai Pendaftaran *
                    </label>
                    <input type="date" 
                           name="mulai_pendaftaran" 
                           id="mulai_pendaftaran"
                           value="{{ old('mulai_pendaftaran') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mulai_pendaftaran') border-red-500 @enderror"
                           required>
                    @error('mulai_pendaftaran')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="akhir_pendaftaran" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Akhir Pendaftaran *
                    </label>
                    <input type="date" 
                           name="akhir_pendaftaran" 
                           id="akhir_pendaftaran"
                           value="{{ old('akhir_pendaftaran') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('akhir_pendaftaran') border-red-500 @enderror"
                           required>
                    @error('akhir_pendaftaran')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tanggal Pengumuman -->
            <div>
                <label for="tanggal_pengumuman" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Pengumuman
                </label>
                <input type="date" 
                       name="tanggal_pengumuman" 
                       id="tanggal_pengumuman"
                       value="{{ old('tanggal_pengumuman') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_pengumuman') border-red-500 @enderror">
                @error('tanggal_pengumuman')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Opsional. Tanggal pengumuman hasil seleksi</p>
            </div>

            <!-- Status Aktif -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active') ? 'checked' : '' }}
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="ml-2 text-sm font-medium text-gray-700">Aktifkan jadwal ini</span>
                </label>
                <p class="mt-1 text-sm text-gray-500">Hanya satu jadwal yang bisa aktif pada saat bersamaan</p>
            </div>

            <!-- Tombol Submit -->
            <div class="flex gap-3 pt-4">
                <button type="submit" 
                        class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Simpan Jadwal
                </button>
                <a href="{{ route('admin.jadwal.index') }}"
                   class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
