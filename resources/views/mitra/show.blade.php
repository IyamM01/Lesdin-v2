@extends('layouts.app')
@section('content')
<div class="mt-24 min-h-screen bg-white">
    <!-- Hero Image -->
    <div class="relative w-full h-64 md:h-96 overflow-hidden bg-gray-200">
        @if($mitra->image)
            <img 
                src="{{ asset('images/' . $mitra->image) }}" 
                alt="{{ $mitra->name }}" 
                class="w-full h-full object-contain bg-white"
            >
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#3C5148] to-[#2E3C35]">
                <div class="text-white text-center">
                    <svg class="w-24 h-24 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-xl font-semibold">{{ $mitra->name }}</p>
                </div>
            </div>
        @endif
    </div>
    

    <div class="container mx-auto px-4 -mt-20 relative z-10">
        <!-- Company Info Card -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <a href="{{ route('mitra.index') }}"
            class="inline-flex items-center gap-2 px-3 py-2 mb-4 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-[#2E3C35] mb-2 md:mb-0">{{ $mitra->name }}</h1>
                @if($mitra->alamat)
                    <div class="flex items-center text-[#2E3C35]">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">{{ $mitra->alamat }}</span>
                    </div>
                @endif
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 bg-[#3C5148] rounded-xl p-6 text-white">
                <div class="text-center">
                    <div class="text-2xl font-bold mb-1">{{ $mitra->kuota ?? '-' }}</div>
                    <div class="text-xs opacity-90">KUOTA</div>
                </div>
                <div class="text-center border-l border-r border-white/30">
                    <div class="text-2xl font-bold mb-1">{{ $mitra->registrations_diterima_count ?? 0 }}</div>
                    <div class="text-xs opacity-90">SEDANG PKL</div>
                </div>
                <div class="text-center">
                    @php
                        $sisaKuota = $mitra->kuota > 0 ? $mitra->kuota - ($mitra->registrations_diterima_count ?? 0) : '-';
                    @endphp
                    <div class="text-2xl font-bold mb-1">{{ $sisaKuota }}</div>
                    <div class="text-xs opacity-90">SISA KUOTA</div>
                </div>
            </div>
        </div>

        <!-- Tentang Perusahaan -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-[#2E3C35] mb-4">Tentang Perusahaan</h2>
            @if($mitra->deskripsi)
                <p class="text-[#2E3C35] text-sm leading-relaxed text-justify">
                    {{ $mitra->deskripsi }}
                </p>
            @else
                <p class="text-gray-500 text-sm italic">Deskripsi perusahaan belum tersedia.</p>
            @endif
        </div>

        <!-- Posisi Pekerjaan -->
        @if($mitra->posisi)
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-[#2E3C35] mb-6">Posisi Pekerjaan</h2>
            
            <div class="space-y-3">
                @php
                    $posisiArray = explode(',', $mitra->posisi);
                @endphp
                
                @foreach($posisiArray as $index => $posisi)
                    <div class="border border-[#4A5A55] rounded-xl overflow-hidden">
                        <button 
                            onclick="toggleAccordion('accordion{{ $index + 1 }}')"
                            class="w-full bg-[#3C5148] text-white px-6 py-4 flex justify-between items-center hover:bg-[#32453D] transition"
                        >
                            <span class="font-medium text-sm">{{ trim($posisi) }}</span>
                            <svg id="icon{{ $index + 1 }}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="accordion{{ $index + 1 }}" class="hidden bg-white px-6 py-4">
                            <p class="text-sm text-[#2E3C35]">Posisi {{ trim($posisi) }} tersedia di {{ $mitra->name }}.</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Kontak -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-[#2E3C35] mb-6">Kontak</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <!-- Instagram -->
                @if($mitra->instagram)
                <div class="bg-white rounded-xl p-4 flex items-center gap-3 border border-[#4A5A55]">
                    <div class="w-10 h-10 bg-[#3C5148] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs text-[#2E3C35] font-medium mb-1">Instagram</div>
                        <a href="https://instagram.com/{{ ltrim($mitra->instagram, '@') }}" target="_blank" class="text-xs text-gray-600 hover:text-[#3C5148]">{{ $mitra->instagram }}</a>
                    </div>
                </div>
                @endif

                <!-- Gmail -->
                @if($mitra->email)
                <div class="bg-white rounded-xl p-4 flex items-center gap-3 border border-[#4A5A55]">
                    <div class="w-10 h-10 bg-[#3C5148] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs text-[#2E3C35] font-medium mb-1">Email</div>
                        <a href="mailto:{{ $mitra->email }}" class="text-xs text-gray-600 hover:text-[#3C5148]">{{ $mitra->email }}</a>
                    </div>
                </div>
                @endif

                <!-- Telepon -->
                @if($mitra->telepon)
                <div class="bg-white rounded-xl p-4 flex items-center gap-3 border border-[#4A5A55]">
                    <div class="w-10 h-10 bg-[#3C5148] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs text-[#2E3C35] font-medium mb-1">Telepon</div>
                        <a href="tel:{{ $mitra->telepon }}" class="text-xs text-gray-600 hover:text-[#3C5148]">{{ $mitra->telepon }}</a>
                    </div>
                </div>
                @endif

                @if(!$mitra->instagram && !$mitra->email && !$mitra->telepon)
                <div class="col-span-full text-center py-4">
                    <p class="text-gray-500 text-sm italic">Informasi kontak belum tersedia.</p>
                </div>
                @endif
            </div>

            <!-- Daftar Sekarang Button -->
            <div class="flex justify-center">
                <a href="{{ route('daftar-pkl.index') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-[#3C5148] text-white rounded-full hover:bg-[#32453D] transition duration-200 font-medium">
                    <span>Daftar Sekarang</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleAccordion(id) {
    const content = document.getElementById(id);
    const icon = document.getElementById('icon' + id.replace('accordion', ''));

    // Tutup semua accordion lain
    document.querySelectorAll('[id^="accordion"]').forEach(el => {
        if (el.id !== id && el.style.maxHeight) {
            el.style.maxHeight = null; 
            const otherIcon = document.getElementById('icon' + el.id.replace('accordion', ''));
            if (otherIcon) otherIcon.classList.remove('rotate-180');
        }
    });

    // Toggle accordion yang diklik
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
    } else {
        content.style.maxHeight = content.scrollHeight + "px";
    }

    // Animasi icon
    icon.classList.toggle('rotate-180');
}
</script>
@endsection