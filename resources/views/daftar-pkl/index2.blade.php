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
            <div class="w-full max-w-3xl bg-gray-100 rounded-r-2xl shadow-lg p-8 min-h-[50vh]">
                <h2 class="text-xl font-semibold text-[#2E3C35] mb-6">Pilihan Tempat PKL</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(!$isPendaftaranBuka)
                    <!-- Warning Pendaftaran Ditutup -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-lg font-medium text-yellow-800">Pendaftaran Tidak Tersedia</h3>
                                <p class="mt-2 text-sm text-yellow-700">{{ $pesanPendaftaran }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('index') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Kembali ke Beranda
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <form action="{{ route('daftar-pkl.update-pilihan') }}" method="POST" class="space-y-5">
                        @csrf

                    <!-- Pilihan 1 -->
                    <div>
                        <label for="pilihan1" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            Pilihan 1 <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="pilihan1" 
                            name="pilihan1"
                            class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition-all duration-200 bg-white appearance-none cursor-pointer @error('pilihan1') border-red-500 @enderror"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1em;"
                            required
                        >
                            <option value="" disabled {{ old('pilihan1', $pilihan1 ?? '') ? '' : 'selected' }}>Pilih Perusahaan</option>
                            @foreach($mitras as $mitra)
                                <option value="{{ $mitra->id }}" {{ old('pilihan1', $pilihan1 ?? '') == $mitra->id ? 'selected' : '' }}>
                                    {{ $mitra->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pilihan1')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pilihan 2 -->
                    <div>
                        <label for="pilihan2" class="block text-sm font-medium text-[#2E3C35] mb-2">
                            Pilihan 2 <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        <select 
                            id="pilihan2" 
                            name="pilihan2"
                            class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition-all duration-200 bg-white appearance-none cursor-pointer @error('pilihan2') border-red-500 @enderror"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1em;"
                        >
                            <option value="" {{ old('pilihan2', $pilihan2 ?? '') ? '' : 'selected' }}>Pilih Perusahaan</option>
                            @foreach($mitras as $mitra)
                                <option value="{{ $mitra->id }}" {{ old('pilihan2', $pilihan2 ?? '') == $mitra->id ? 'selected' : '' }}>
                                    {{ $mitra->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pilihan2')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-center gap-4 pt-4">
                        <button 
                            type="button"
                            onclick="window.history.back()"
                            class="px-8 py-2.5 bg-gray-300 text-[#2E3C35] rounded-full hover:bg-gray-400 transition duration-200 font-medium"
                        >
                            Kembali
                        </button>
                        <button 
                            type="submit"
                            class="px-8 py-2.5 bg-[#3C5148] text-white rounded-full hover:bg-[#32463D] transition duration-200 font-medium"
                        >
                            Simpan & Lanjutkan
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pilihan1 = document.getElementById('pilihan1');
        const pilihan2 = document.getElementById('pilihan2');

        // Function untuk disable option yang sudah dipilih di select lain
        function updateOptions() {
            const value1 = pilihan1.value;
            const value2 = pilihan2.value;

            // Reset semua option ke enabled
            Array.from(pilihan1.options).forEach(option => {
                option.disabled = false;
            });
            Array.from(pilihan2.options).forEach(option => {
                option.disabled = false;
            });

            // Disable option di pilihan2 jika sudah dipilih di pilihan1
            if (value1) {
                Array.from(pilihan2.options).forEach(option => {
                    if (option.value === value1 && option.value !== '') {
                        option.disabled = true;
                    }
                });
            }

            // Disable option di pilihan1 jika sudah dipilih di pilihan2
            if (value2) {
                Array.from(pilihan1.options).forEach(option => {
                    if (option.value === value2 && option.value !== '') {
                        option.disabled = true;
                    }
                });
            }
        }

        // Event listener untuk kedua select
        pilihan1.addEventListener('change', updateOptions);
        pilihan2.addEventListener('change', updateOptions);

        // Validasi saat form submit
        const form = pilihan1.closest('form');
        form.addEventListener('submit', function(e) {
            if (pilihan1.value && pilihan2.value && pilihan1.value === pilihan2.value) {
                e.preventDefault();
                alert('Pilihan 1 dan Pilihan 2 tidak boleh sama!');
                return false;
            }
        });
    });
</script>
@endpush
@endsection