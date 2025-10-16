@extends('layouts.admin-layouts')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pendaftaran PKL</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $registration->siswa->name }} - {{ $registration->siswa->nis }}</p>
        </div>
        <a href="{{ route('admin.registrations.index') }}" 
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Data Siswa & Pendaftaran -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Siswa -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Data Siswa</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-500">Nama Lengkap</label>
                        <p class="font-medium text-gray-900">{{ $registration->siswa->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">NIS</label>
                        <p class="font-medium text-gray-900">{{ $registration->siswa->nis }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">NISN</label>
                        <p class="font-medium text-gray-900">{{ $registration->siswa->nisn ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Jurusan</label>
                        <p class="font-medium text-gray-900">{{ $registration->siswa->jurusan->nama_jurusan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Email</label>
                        <p class="font-medium text-gray-900">{{ $registration->siswa->user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">No. Telepon</label>
                        <p class="font-medium text-gray-900">{{ $registration->siswa->kontak ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Pilihan Mitra -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Pilihan Perusahaan</h2>
                <div class="space-y-4">
                    <!-- Mitra 1 -->
                    <div class="p-4 border-2 rounded-lg {{ $registration->mitra_diterima_id === $registration->mitra_1_id ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">Pilihan 1</span>
                                    @if($registration->mitra_diterima_id === $registration->mitra_1_id)
                                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">✓ Diterima</span>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-900">{{ $registration->mitra1->name }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $registration->mitra1->alamat }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $registration->mitra1->kontak }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Mitra 2 -->
                    <div class="p-4 border-2 rounded-lg {{ $registration->mitra_diterima_id === $registration->mitra_2_id ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-1 text-xs font-semibold bg-purple-100 text-purple-800 rounded">Pilihan 2</span>
                                    @if($registration->mitra_diterima_id === $registration->mitra_2_id)
                                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">✓ Diterima</span>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-900">{{ $registration->mitra2->name }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $registration->mitra2->alamat }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $registration->mitra2->kontak }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dokumen Pendukung -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Dokumen Pendukung</h2>
                @if($dokumen && $dokumen->isComplete())
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Surat Pengantar</span>
                            </div>
                            <a href="{{ $dokumen->surat_pengantar_url }}" target="_blank" 
                               class="text-sm text-blue-600 hover:text-blue-800">
                                Lihat File
                            </a>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">CV</span>
                            </div>
                            <a href="{{ $dokumen->cv_url }}" target="_blank" 
                               class="text-sm text-blue-600 hover:text-blue-800">
                                Lihat File
                            </a>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-gray-500">Belum ada dokumen yang diupload</p>
                @endif
            </div>
        </div>

        <!-- Right: Form Approval -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Status Pendaftaran</h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-500">Status Saat Ini</label>
                        @if($registration->status === 'proses')
                            <p class="mt-1 px-3 py-2 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-lg inline-block">Menunggu Approval</p>
                        @elseif($registration->status === 'diterima')
                            <p class="mt-1 px-3 py-2 text-sm font-semibold text-green-800 bg-green-100 rounded-lg inline-block">Diterima</p>
                        @elseif($registration->status === 'ditolak')
                            <p class="mt-1 px-3 py-2 text-sm font-semibold text-red-800 bg-red-100 rounded-lg inline-block">Ditolak</p>
                        @elseif($registration->status === 'selesai')
                            <p class="mt-1 px-3 py-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-lg inline-block">Selesai</p>
                        @endif
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Tanggal Daftar</label>
                        <p class="font-medium text-gray-900">{{ $registration->tanggal_daftar->format('d M Y, H:i') }}</p>
                    </div>

                    @if($registration->guruPendamping)
                        <div>
                            <label class="text-sm text-gray-500">Guru Pendamping</label>
                            <p class="font-medium text-gray-900">{{ $registration->guruPendamping->name }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Approval (jika status masih proses) -->
            @if($registration->status === 'proses')
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Approval</h2>
                    <form method="POST" action="{{ route('admin.registrations.approve', $registration) }}" class="space-y-4">
                        @csrf
                        
                        <!-- Pilih Mitra -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Mitra yang Diterima *</label>
                            <div class="space-y-2">
                                <label class="flex items-center p-3 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition {{ old('mitra_diterima_id') == $registration->mitra_1_id ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                                    <input type="radio" name="mitra_diterima_id" value="{{ $registration->mitra_1_id }}" 
                                           class="mr-3 text-blue-600 focus:ring-blue-500"
                                           {{ old('mitra_diterima_id') == $registration->mitra_1_id ? 'checked' : '' }} required>
                                    <span class="text-sm font-medium text-gray-900">{{ $registration->mitra1->name }}</span>
                                </label>
                                <label class="flex items-center p-3 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition {{ old('mitra_diterima_id') == $registration->mitra_2_id ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                                    <input type="radio" name="mitra_diterima_id" value="{{ $registration->mitra_2_id }}" 
                                           class="mr-3 text-blue-600 focus:ring-blue-500"
                                           {{ old('mitra_diterima_id') == $registration->mitra_2_id ? 'checked' : '' }} required>
                                    <span class="text-sm font-medium text-gray-900">{{ $registration->mitra2->name }}</span>
                                </label>
                            </div>
                            @error('mitra_diterima_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pilih Guru Pendamping -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Guru Pendamping *</label>
                            <select name="guru_pendamping_id" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="">-- Pilih Guru Pendamping --</option>
                                @foreach($guruPendampings as $guru)
                                    <option value="{{ $guru->id }}" {{ old('guru_pendamping_id') == $guru->id ? 'selected' : '' }}>
                                        {{ $guru->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('guru_pendamping_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Approve -->
                        <button type="submit" 
                                class="w-full px-4 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                            Setujui Pendaftaran
                        </button>
                    </form>

                    <!-- Tombol Tolak -->
                    <form method="POST" action="{{ route('admin.registrations.reject', $registration) }}" class="mt-3">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Yakin ingin menolak pendaftaran ini?')"
                                class="w-full px-4 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                            Tolak Pendaftaran
                        </button>
                    </form>
                </div>
            @endif

            <!-- Tombol Selesaikan PKL (jika status diterima) -->
            @if($registration->status === 'diterima')
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h2>
                    <form method="POST" action="{{ route('admin.registrations.complete', $registration) }}">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Tandai PKL siswa ini sudah selesai?')"
                                class="w-full px-4 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                            Tandai PKL Selesai
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
