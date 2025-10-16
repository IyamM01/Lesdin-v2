@extends('layouts.admin-layouts')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.siswa') }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Tambah Siswa Baru</h1>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-4xl">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.siswa.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan nama lengkap siswa"
                        required
                    >
                </div>

                <!-- NIS -->
                <div>
                    <label for="nis" class="block text-sm font-semibold text-gray-700 mb-2">
                        NIS <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nis" 
                        name="nis" 
                        value="{{ old('nis') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: 12345678"
                        required
                    >
                </div>

                <!-- NISN -->
                <div>
                    <label for="nisn" class="block text-sm font-semibold text-gray-700 mb-2">
                        NISN <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nisn" 
                        name="nisn" 
                        value="{{ old('nisn') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: 0012345678"
                        required
                    >
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="contoh@email.com"
                        required
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                </div>

                <!-- Jurusan -->
                <div>
                    <label for="jurusan_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jurusan <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="jurusan_id" 
                        name="jurusan_id" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($jurusans ?? [] as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }} ({{ $jurusan->kode_jurusan }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jenis Kelamin <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="gender" 
                        name="gender" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Tempat Tanggal Lahir -->
                <div class="md:col-span-2">
                    <label for="tempat_tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tempat, Tanggal Lahir
                    </label>
                    <input 
                        type="text" 
                        id="tempat_tanggal_lahir" 
                        name="tempat_tanggal_lahir" 
                        value="{{ old('tempat_tanggal_lahir') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: Yogyakarta, 01 Januari 2005"
                    >
                </div>

                <!-- Kontak -->
                <div>
                    <label for="kontak" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Kontak
                    </label>
                    <input 
                        type="text" 
                        id="kontak" 
                        name="kontak" 
                        value="{{ old('kontak') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: 08123456789"
                    >
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                        Alamat Lengkap
                    </label>
                    <textarea 
                        id="alamat" 
                        name="alamat" 
                        rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan alamat lengkap"
                    >{{ old('alamat') }}</textarea>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-200">
                <button 
                    type="submit"
                    class="px-6 py-2.5 bg-[#3C5148] hover:bg-green-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Data Siswa
                </button>
                <a 
                    href="{{ route('admin.siswa') }}"
                    class="px-6 py-2.5 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-lg transition duration-200"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
