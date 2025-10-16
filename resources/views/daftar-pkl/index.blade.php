@extends('layouts.app')
@section('content')
<div class="mt-24 min-h-screen bg-white py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <h1 class="my-4 text-center text-2xl font-bold text-[#2E3C35] mb-8">
            Pendaftaran Praktik Kerja Lapangan
        </h1>

        <div class="flex flex-col md:flex-row max-w-6xl justify-center mx-auto">
            <!-- Sidebar -->
            <div class="w-full md:w-64 bg-[#3C5148] rounded-l-2xl p-6">
                <nav class="space-y-4">
                    <a href="{{ route('daftar-pkl.index') }}" class="flex items-center text-white hover:bg-[#32453D] rounded px-3 py-2 transition">
                        <span class="w-2 h-2 bg-[#B2C583] rounded-full mr-3"></span>
                        <span class="text-sm">Data Siswa</span>
                    </a>
                    <a href="{{ route('daftar-pkl.index2') }}" class="flex items-center text-white hover:bg-[#32453D] rounded px-3 py-2 transition">
                        <span class="w-2 h-2 bg-[#F4F6F4] rounded-full mr-3"></span>
                        <span class="text-sm">Pilihan Tempat PKL</span>
                    </a>
                    <a href="{{ route('daftar-pkl.index3') }}" class="flex items-center text-white hover:bg-[#32453D] rounded px-3 py-2 transition">
                        <span class="w-2 h-2 bg-[#F4F6F4] rounded-full mr-3"></span>
                        <span class="text-sm">Dokumen Pendukung</span>
                    </a>
                    <a href="{{ route('daftar-pkl.index4') }}" class="flex items-center text-white hover:bg-[#32453D] rounded px-3 py-2 transition">
                        <span class="w-2 h-2 bg-[#F4F6F4] rounded-full mr-3"></span>
                        <span class="text-sm">Permintaan</span>
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="w-full max-w-3xl bg-gray-100 rounded-r-2xl shadow-lg p-8">
                <h2 class="text-xl font-semibold text-[#2E3C35] mb-6">Data Siswa</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(!$isPendaftaranBuka)
                    <!-- Pesan Pendaftaran Ditutup -->
                    <div class="bg-yellow-50 border-2 border-yellow-400 rounded-xl p-8 text-center">
                        <div class="flex justify-center mb-4">
                            <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-yellow-800 mb-2">Pendaftaran Tidak Tersedia</h3>
                        <p class="text-yellow-700">{{ $pesanPendaftaran }}</p>
                        @if($jadwalAktif && $jadwalAktif->tanggal_pengumuman)
                            <p class="text-sm text-yellow-600 mt-2">
                                Pengumuman: {{ $jadwalAktif->tanggal_pengumuman->format('d M Y') }}
                            </p>
                        @endif
                        <div class="mt-6">
                            <a href="{{ route('index') }}" 
                               class="inline-block px-6 py-3 bg-[#3C5148] text-white rounded-lg hover:bg-[#2E3C35] transition">
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Form Pendaftaran -->
                    <form action="{{ route('daftar-pkl.update-siswa') }}" method="POST" class="space-y-5">
                        @csrf

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            Nama Lengkap
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name"
                            value="{{ old('name', $siswa->name ?? '') }}"
                            placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition-all duration-200"
                            required
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIS -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            NIS
                        </label>
                        <input 
                            type="text" 
                            id="nis" 
                            name="nis"
                            value="{{ old('nis', $siswa->nis ?? '') }}"
                            placeholder="Masukkan NIS"
                            class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition-all duration-200"
                            required
                        >
                        @error('nis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NISN -->
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            NISN
                        </label>
                        <input 
                            type="text" 
                            id="nisn" 
                            name="nisn"
                            value="{{ old('nisn', $siswa->nisn ?? '') }}"
                            placeholder="Masukkan NISN"
                            class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition-all duration-200"
                            required
                        >
                        @error('nisn')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jurusan (Readonly) -->
                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            Jurusan
                        </label>
                        <input 
                            type="text" 
                            id="jurusan" 
                            value="{{ $siswa->jurusan->nama_jurusan ?? '-' }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed"
                            readonly
                        >
                        <input type="hidden" name="jurusan_id" value="{{ $siswa->jurusan_id ?? '' }}">
                        <p class="mt-1 text-xs text-gray-500">Jurusan tidak dapat diubah</p>
                    </div>

                    <!-- Tempat, Tanggal Lahir -->
                    <div>
                        <label for="tempat_tanggal_lahir" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            Tempat, Tanggal Lahir
                        </label>
                        <input 
                            type="text" 
                            id="tempat_tanggal_lahir" 
                            name="tempat_tanggal_lahir"
                            value="{{ old('tempat_tanggal_lahir', $siswa->tempat_tanggal_lahir ?? '') }}"
                            placeholder="Contoh : Yogyakarta, 17 Agustus 2001"
                            class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition-all duration-200"
                            required
                        >
                        @error('tempat_tanggal_lahir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-[#2E3C35] mb-3">
                            Jenis Kelamin
                        </label>

                        <div class="flex gap-4">
                            <!-- Perempuan -->
                            <label class="relative flex items-center gap-2 cursor-not-allowed">
                                <input 
                                    type="radio" 
                                    name="gender" 
                                    value="Perempuan"
                                    {{ old('gender', $siswa->gender ?? '') == 'Perempuan' ? 'checked' : '' }}
                                    class="peer hidden"
                                    disabled
                                >
                                <div class="flex items-center gap-2 px-6 py-3 border-2 rounded-2xl border-[#3C5148] transition 
                                            peer-checked:bg-[#3C5148] peer-checked:text-white peer-checked:ring-2 peer-checked:ring-[#3C5148]
                                            {{ old('gender', $siswa->gender ?? '') == 'Perempuan' ? 'bg-[#3C5148] text-white ring-2 ring-[#3C5148]' : 'text-[#2E3C35]' }}">
                                    <span>♀</span>
                                    <span class="font-medium">Perempuan</span>
                                </div>
                            </label>

                            <label class="relative flex items-center gap-2 cursor-not-allowed">
                                <input 
                                    type="radio" 
                                    name="gender" 
                                    value="Laki-Laki"
                                    {{ old('gender', $siswa->gender ?? '') == 'Laki-Laki' ? 'checked' : '' }}
                                    class="peer hidden"
                                    disabled
                                >
                                <div class="flex items-center gap-2 px-6 py-3 border-2 rounded-2xl border-[#3C5148] transition 
                                            peer-checked:bg-[#3C5148] peer-checked:text-white peer-checked:ring-2 peer-checked:ring-[#3C5148]
                                            {{ old('gender', $siswa->gender ?? '') == 'Laki-Laki' ? 'bg-[#3C5148] text-white ring-2 ring-[#3C5148]' : 'text-[#2E3C35]' }}">
                                    <span>♂</span>
                                    <span class="font-medium">Laki-Laki</span>
                                </div>
                            </label>
                            <input type="hidden" name="gender" value="{{ old('gender', $siswa->gender ?? '') }}">
                        </div>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            Alamat
                        </label>
                        <textarea 
                            id="alamat" 
                            name="alamat"
                            rows="2"
                            placeholder="Masukkan Alamat Lengkap"
                            class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition-all duration-200"
                            required>{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomer Telepon -->
                    <div>
                        <label for="kontak" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            Nomer Telepon
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 py-2.5 border border-r-0 border-[#4A5A55] rounded-l-xl bg-gray-50 text-gray-600">
                                +62
                            </span>
                            <input 
                                type="tel" 
                                id="kontak" 
                                name="kontak"
                                value="{{ old('kontak', $siswa->kontak ?? '') }}"
                                placeholder="8xxxxxxxxx"
                                class="flex-1 px-4 py-2.5 border border-[#4A5A55] rounded-r-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition-all duration-200"
                                pattern="[0-9]{9,13}"
                                required
                            >
                        </div>
                        @error('kontak')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Contoh: 81234567890 (tanpa +62)</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center gap-3 pt-4">
                        <button 
                            type="submit"
                            class="inline-flex items-center px-8 py-2.5 bg-[#3C5148] text-white rounded-full hover:bg-[#32463D] transition duration-200 font-medium shadow-md">
                            Simpan & Lanjutkan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                        <a href="{{ route('daftar-pkl.index2') }}"
                            class="inline-flex items-center px-8 py-2.5 bg-gray-300 text-[#2E3C35] rounded-full hover:bg-gray-400 transition duration-200 font-medium">
                            Lewati
                        </a>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Pastikan radio button gender yang sesuai dengan database ter-select saat page load
    document.addEventListener('DOMContentLoaded', function() {
        const genderValue = "{{ old('gender', $siswa->gender ?? '') }}";
        
        if (genderValue) {
            const radioToCheck = document.querySelector(`input[name="gender"][value="${genderValue}"]`);
            if (radioToCheck) {
                radioToCheck.checked = true;
                // Trigger perubahan visual
                radioToCheck.dispatchEvent(new Event('change'));
            }
        }
    });
</script>
@endpush
@endsection
