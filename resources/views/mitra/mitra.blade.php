@extends('layouts.app')
@section('content')
<div class="mt-24 min-h-screen bg-white">
    <!-- Hero Image -->
    <div class="relative w-full h-64 md:h-96 overflow-hidden">
        <img 
            src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1200" 
            alt="PT Cargloss Building" 
            class="w-full h-full object-cover"
        >
    </div>

    <div class="container mx-auto px-4 -mt-20 relative z-10">
        <!-- Company Info Card -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-[#2E3C35] mb-2 md:mb-0">PT Cargloss</h1>
                <div class="flex items-center text-[#2E3C35]">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium">Jakarta</span>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 bg-[#3C5148] rounded-xl p-6 text-white">
                <div class="text-center">
                    <div class="text-2xl font-bold mb-1">100 +</div>
                    <div class="text-xs opacity-90">KARYAWAN</div>
                </div>
                <div class="text-center border-l border-r border-white/30">
                    <div class="text-2xl font-bold mb-1">100 +</div>
                    <div class="text-xs opacity-90">NILAI</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold mb-1">100 +</div>
                    <div class="text-xs opacity-90">JUMLAH PKL</div>
                </div>
            </div>
        </div>

        <!-- Tentang Perusahaan -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-[#2E3C35] mb-4">Tentang Perusahaan</h2>
            <p class="text-[#2E3C35] text-sm leading-relaxed text-justify">
                Cargloss Group menjadi perusahaan dan merek otomotif untuk produk Cat, pelampung untuk Kapal, perawatan 400 ton, cat puluhan ribu drum per hari. sejak tahun 1980, Cargloss telah menjadi perusahaan Cat dan Coating terkemuka di indonesia. Produk Cargloss yang terkenal, produk tersebut digunakan oleh banyak 21%4 peluk per mobil, Perusahaan ini kurang perusahaan ini. Offbeat beluga grosfomous, dalam satu kuasa ada ada kolang dari 360.000 okit untuk anda adalah bagian punya cat produknya anda ini di bidang persetujuan yang dibuat untuk tipe wajah. PT Cargloss memproduksi mobil Porsein. Pads ment (MBS), blackheys1 mengapa secara Syma Asmoto Pulp dan Tehone. Tank mendiambing pernyatal oda Phaas untuk Chasah sekitar kebudayaan.
            </p>
        </div>

        <!-- Posisi Pekerjaan -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-[#2E3C35] mb-6">Posisi Pekerjaan</h2>
            
            <div class="space-y-3">
                <!-- Accordion Item 1 -->
                <div class="border border-[#4A5A55] rounded-xl overflow-hidden">
                    <button 
                        onclick="toggleAccordion('accordion1')"
                        class="w-full bg-[#3C5148] text-white px-6 py-4 flex justify-between items-center hover:bg-[#32453D] transition"
                    >
                        <span class="font-medium text-sm">Pelaksana Maintenance</span>
                        <svg id="icon1" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="accordion1" class="hidden bg-white px-6 py-4">
                        <p class="text-sm text-[#2E3C35]">Deskripsi pekerjaan untuk posisi Pelaksana Maintenance di PT Cargloss.</p>
                    </div>
                </div>

                <!-- Accordion Item 2 -->
                <div class="border border-[#4A5A55] rounded-xl overflow-hidden">
                    <button 
                        onclick="toggleAccordion('accordion2')"
                        class="w-full bg-[#3C5148] text-white px-6 py-4 flex justify-between items-center hover:bg-[#32453D] transition"
                    >
                        <span class="font-medium text-sm">Pelaksana Maintenance</span>
                        <svg id="icon2" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="accordion2" class="hidden bg-white px-6 py-4">
                        <p class="text-sm text-[#2E3C35]">Deskripsi pekerjaan untuk posisi Pelaksana Maintenance di PT Cargloss.</p>
                    </div>
                </div>

                <!-- Accordion Item 3 -->
                <div class="border border-[#4A5A55] rounded-xl overflow-hidden">
                    <button 
                        onclick="toggleAccordion('accordion3')"
                        class="w-full bg-[#3C5148] text-white px-6 py-4 flex justify-between items-center hover:bg-[#32453D] transition"
                    >
                        <span class="font-medium text-sm">Pelaksana Maintenance</span>
                        <svg id="icon3" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="accordion3" class="hidden bg-white px-6 py-4">
                        <p class="text-sm text-[#2E3C35]">Deskripsi pekerjaan untuk posisi Pelaksana Maintenance di PT Cargloss.</p>
                    </div>
                </div>

                <!-- Accordion Item 4 -->
                <div class="border border-[#4A5A55] rounded-xl overflow-hidden">
                    <button 
                        onclick="toggleAccordion('accordion4')"
                        class="w-full bg-[#3C5148] text-white px-6 py-4 flex justify-between items-center hover:bg-[#32453D] transition"
                    >
                        <span class="font-medium text-sm">Pelaksana Maintenance</span>
                        <svg id="icon4" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="accordion4" class="hidden bg-white px-6 py-4">
                        <p class="text-sm text-[#2E3C35]">Deskripsi pekerjaan untuk posisi Pelaksana Maintenance di PT Cargloss.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-[#2E3C35] mb-6">Kontak</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <!-- Instagram -->
                <div class="bg-white rounded-xl p-4 flex items-center gap-3 border border-[#4A5A55]">
                    <div class="w-10 h-10 bg-[#3C5148] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs text-[#2E3C35] font-medium mb-1">Instagram</div>
                        <div class="text-xs text-gray-600">@carglossautochem</div>
                    </div>
                </div>

                <!-- Gmail -->
                <div class="bg-white rounded-xl p-4 flex items-center gap-3 border border-[#4A5A55]">
                    <div class="w-10 h-10 bg-[#3C5148] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs text-[#2E3C35] font-medium mb-1">Gmail</div>
                        <div class="text-xs text-gray-600">cargloss@google.com</div>
                    </div>
                </div>

                <!-- Telepon -->
                <div class="bg-white rounded-xl p-4 flex items-center gap-3 border border-[#4A5A55]">
                    <div class="w-10 h-10 bg-[#3C5148] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs text-[#2E3C35] font-medium mb-1">Telepon</div>
                        <div class="text-xs text-gray-600">(021) 7318192</div>
                    </div>
                </div>
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
    
    // Close all other accordions
    document.querySelectorAll('[id^="accordion"]').forEach(el => {
        if (el.id !== id && !el.classList.contains('hidden')) {
            el.classList.add('hidden');
            const otherIcon = document.getElementById('icon' + el.id.replace('accordion', ''));
            if (otherIcon) {
                otherIcon.classList.remove('rotate-180');
            }
        }
    });
    
    // Toggle current accordion
    content.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>
@endsection