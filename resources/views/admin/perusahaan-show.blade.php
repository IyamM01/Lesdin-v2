{{-- resources/views/admin/perusahaan-show.blade.php --}}
@extends('layouts.admin-layouts')
@section('title', 'Detail Perusahaan | SMK N 2 Depok Sleman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.perusahaan') }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
                <i data-lucide="arrow-left" class="w-6 h-6 text-gray-600"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Perusahaan</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $mitra->name }}</p>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.perusahaan.edit', $mitra->id) }}" 
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition inline-flex items-center gap-2">
                <i data-lucide="pencil" class="w-4 h-4"></i>
                Edit Perusahaan
            </a>
            <a href="{{ route('admin.perusahaan') }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition inline-flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Info Perusahaan -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Perusahaan -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center gap-3 mb-6">
                    <i data-lucide="building-2" class="w-6 h-6 text-blue-600"></i>
                    <h2 class="text-lg font-semibold text-gray-800">Data Perusahaan</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Perusahaan</label>
                        <p class="text-gray-900 font-medium">{{ $mitra->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Jurusan</label>
                        <p class="text-gray-900 font-medium">{{ $mitra->jurusan->nama_jurusan ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                        <p class="text-gray-900 font-medium">{{ $mitra->email ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Telepon</label>
                        <p class="text-gray-900 font-medium">{{ $mitra->kontak ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Instagram</label>
                        <p class="text-gray-900 font-medium">{{ $mitra->instagram ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Posisi yang Tersedia</label>
                        <p class="text-gray-900 font-medium">{{ $mitra->posisi ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Kuota</label>
                        <p class="text-gray-900 font-medium">{{ $mitra->kuota ?? 0 }} siswa</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Terisi (Sedang PKL)</label>
                        @php
                            $sedangPkl = $mitra->registrationsDiterima->where('status', 'diterima')->count();
                        @endphp
                        <p class="text-gray-900 font-medium">
                            {{ $sedangPkl }} siswa
                            @if($mitra->kuota > 0)
                                <span class="text-sm text-gray-500">
                                    ({{ number_format(($sedangPkl / $mitra->kuota) * 100, 1) }}%)
                                </span>
                            @endif
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Siswa Selesai PKL</label>
                        @php
                            $selesaiPkl = $mitra->registrationsDiterima->where('status', 'selesai')->count();
                        @endphp
                        <p class="text-gray-900 font-medium">
                            {{ $selesaiPkl }} siswa
                            <span class="text-xs text-gray-500">(tidak mengurangi kuota)</span>
                        </p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Alamat</label>
                        <p class="text-gray-900 font-medium">{{ $mitra->alamat ?? '-' }}</p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Deskripsi</label>
                        <p class="text-gray-900">{{ $mitra->deskripsi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Daftar Siswa PKL di Perusahaan Ini -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center gap-3 mb-6">
                    <i data-lucide="users" class="w-6 h-6 text-green-600"></i>
                    <h2 class="text-lg font-semibold text-gray-800">Siswa PKL yang Diterima</h2>
                </div>
                
                @if($mitra->registrationsDiterima->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($mitra->registrationsDiterima as $index => $registration)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $registration->siswa->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $registration->siswa->user->email ?? '-' }}</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $registration->siswa->nis }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $registration->siswa->jurusan->nama_jurusan ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            @if($registration->status === 'diterima')
                                                <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                    Diterima
                                                </span>
                                            @elseif($registration->status === 'selesai')
                                                <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i data-lucide="users" class="w-16 h-16 mx-auto text-gray-300 mb-3"></i>
                        <p class="text-sm text-gray-500">Belum ada siswa yang diterima di perusahaan ini</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right: Logo & Info Tambahan -->
        <div class="space-y-6">
            <!-- Logo Perusahaan -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center gap-3 mb-4">
                    <i data-lucide="image" class="w-5 h-5 text-purple-600"></i>
                    <h2 class="text-lg font-semibold text-gray-800">Logo</h2>
                </div>
                
                <div class="aspect-square bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                    @if($mitra->image)
                        <img src="{{ asset('images/' . $mitra->image) }}" 
                             alt="{{ $mitra->name }}" 
                             class="object-contain w-full h-full p-4">
                    @else
                        <div class="text-center p-4">
                            <i data-lucide="image" class="w-12 h-12 mx-auto text-gray-300 mb-2"></i>
                            <p class="text-sm text-gray-400">Tidak ada logo</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistik Singkat -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center gap-3 mb-4">
                    <i data-lucide="bar-chart" class="w-5 h-5 text-orange-600"></i>
                    <h2 class="text-lg font-semibold text-gray-800">Statistik</h2>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                            <span class="text-sm font-medium text-gray-700">Siswa Diterima</span>
                        </div>
                        <span class="text-lg font-bold text-green-700">
                            {{ $mitra->registrationsDiterima->where('status', 'diterima')->count() }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-600"></i>
                            <span class="text-sm font-medium text-gray-700">Siswa Selesai</span>
                        </div>
                        <span class="text-lg font-bold text-blue-700">
                            {{ $mitra->registrationsDiterima->where('status', 'selesai')->count() }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-2">
                            <i data-lucide="users" class="w-5 h-5 text-gray-600"></i>
                            <span class="text-sm font-medium text-gray-700">Total Siswa</span>
                        </div>
                        <span class="text-lg font-bold text-gray-700">
                            {{ $mitra->registrationsDiterima->count() }}
                        </span>
                    </div>
                    
                    @if($mitra->kuota > 0)
                        <div class="pt-3 border-t border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Kuota Terisi (Sedang PKL)</span>
                                @php
                                    $sedangPkl = $mitra->registrationsDiterima->where('status', 'diterima')->count();
                                @endphp
                                <span class="text-sm font-semibold text-gray-900">
                                    {{ $sedangPkl }} / {{ $mitra->kuota }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" 
                                     style="width: {{ min(($sedangPkl / $mitra->kuota) * 100, 100) }}%">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center gap-3 mb-4">
                    <i data-lucide="info" class="w-5 h-5 text-gray-600"></i>
                    <h2 class="text-lg font-semibold text-gray-800">Info</h2>
                </div>
                
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">ID Perusahaan</label>
                        <p class="text-sm text-gray-900 font-mono">#{{ $mitra->id }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Terdaftar Sejak</label>
                        <p class="text-sm text-gray-900">{{ $mitra->created_at->format('d M Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Terakhir Diupdate</label>
                        <p class="text-sm text-gray-900">{{ $mitra->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>lucide.createIcons();</script>
@endsection
