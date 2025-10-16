@extends('layouts.admin-layouts')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.siswa') }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Detail Siswa</h1>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Data Pribadi -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Data Pribadi
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">NIS</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->nis }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">NISN</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->nisn }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Jurusan</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</p>
                        <p class="text-sm text-gray-500">{{ $siswa->jurusan->kode_jurusan ?? '' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Jenis Kelamin</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->gender }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Tempat, Tanggal Lahir</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->tempat_tanggal_lahir ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->user->email ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nomor Kontak</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->kontak ?? '-' }}</p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Alamat</label>
                        <p class="text-gray-900 font-medium">{{ $siswa->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Info -->
        <div class="space-y-6">
            <!-- Status Pendaftaran PKL -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Status PKL
                </h2>
                
                @if($siswa->registration)
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Status</label>
                            @if($siswa->registration->status == 'diterima')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    ✓ Diterima
                                </span>
                            @elseif($siswa->registration->status == 'ditolak')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    ✗ Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    ⏳ Proses
                                </span>
                            @endif
                        </div>
                        
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Pilihan Mitra 1</label>
                            <p class="text-sm text-gray-900 font-medium">{{ $siswa->registration->mitra1->name ?? '-' }}</p>
                        </div>
                        
                        @if($siswa->registration->mitra_2_id)
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Pilihan Mitra 2</label>
                                <p class="text-sm text-gray-900 font-medium">{{ $siswa->registration->mitra2->name ?? '-' }}</p>
                            </div>
                        @endif
                        
                        @if($siswa->registration->mitra_diterima_id)
                            <div class="pt-3 border-t border-gray-200">
                                <label class="block text-xs font-semibold text-green-700 mb-1">Diterima di</label>
                                <p class="text-sm text-green-900 font-bold">{{ $siswa->registration->mitraDiterima->name ?? '-' }}</p>
                            </div>
                        @endif
                        
                        @if($siswa->registration->guru_pendamping_id)
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Guru Pendamping</label>
                                <p class="text-sm text-gray-900 font-medium">{{ $siswa->registration->guruPendamping->name ?? '-' }}</p>
                            </div>
                        @endif
                        
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Tanggal Pendaftaran</label>
                            <p class="text-sm text-gray-900">{{ $siswa->registration->tanggal_daftar ? $siswa->registration->tanggal_daftar->format('d M Y') : '-' }}</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-sm text-gray-500">Belum mendaftar PKL</p>
                    </div>
                @endif
            </div>
            
            <!-- Info Akun -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Info Akun
                </h2>
                
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">User ID</label>
                        <p class="text-sm text-gray-900 font-mono">#{{ $siswa->user_id }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Role</label>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                            Siswa
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Terdaftar Sejak</label>
                        <p class="text-sm text-gray-900">{{ $siswa->created_at->format('d M Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Terakhir Diupdate</label>
                        <p class="text-sm text-gray-900">{{ $siswa->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
