@extends('layouts.app')
@section('content')
<div class="mt-24 min-h-screen bg-white py-8 relative">
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
                <h2 class="text-xl font-semibold text-[#2E3C35] mb-6">Persetujuan</h2>

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
                    <form action="{{ route('daftar-pkl.submit') }}" method="POST" class="space-y-6">
                        @csrf

                    <!-- Informasi Text -->
                    <div class="bg-white p-6 rounded-xl border border-[#4A5A55]">
                        <p class="text-sm text-[#2E3C35] leading-relaxed">
                            Pastikan seluruh data sudah benar sebelum menekan tombol kirim. Setelah pendaftaran dikirm, data tidak dapat diubah tanpa persetujuan admin.
                        </p>
                    </div>

                    <!-- Checkbox Persetujuan -->
                    <div class="flex items-start gap-3">
                        <input 
                            type="checkbox" 
                            id="persetujuan" 
                            name="persetujuan"
                            value="1"
                            class="mt-1 w-4 h-4 text-[#3C5148] border-[#4A5A55] rounded focus:ring-[#3C5148] focus:ring-2"
                            required
                        >
                        <label for="persetujuan" class="text-sm text-[#2E3C35] cursor-pointer">
                            Saya menyetujui bahwa data yang saya isi sudah benar dan siap untuk diproses
                        </label>
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
                            Kirim
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full text-center transform transition-all">
            <!-- Success Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-[#6B8E6F] rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            <!-- Success Title -->
            <h3 class="text-2xl font-bold text-[#6B8E6F] mb-4">
                Pendaftaran Berhasil!
            </h3>

            <!-- Success Message -->
            <p class="text-sm text-[#2E3C35] mb-8">
                Silakan cek secara berkala website dan email Anda untuk informasi tahap berikutnya.
            </p>

            <!-- Close Button (Optional) -->
            <button 
                onclick="window.location.href='{{ route('profile.index') }}'"
                class="px-8 py-2.5 bg-[#3C5148] text-white rounded-full hover:bg-[#32463D] transition duration-200 font-medium"
            >
                Tutup
            </button>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    // Auto show modal if success message exists
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });
</script>
@endif

<script>
function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    // Redirect ke halaman profile
    window.location.href = "{{ route('profile.index') }}";
}

// Optional: Close modal when clicking outside
document.getElementById('successModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuccessModal();
    }
});
</script>
@endsection
