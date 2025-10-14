<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SMK NEGERI 2 DEPOK SLEMAN')</title>

    {{-- Vite (CSS & JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logo-sekolah.png') }}" type="image/png">

    {{-- Google Fonts: Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    {{-- AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- Tambahan CSS per-halaman --}}
    @stack('styles')
</head>
<body class="font-poppins antialiased bg-[#3C5148]">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Header Section --}}
    <section class="w-full px-4 sm:px-6 lg:px-8 mt-32 sm:mt-32 lg:mt-40">
        <div class="max-w-7xl mx-auto">
            {{-- Header Card --}}
            <div class="bg-white text-gray-800 rounded-2xl p-6 sm:p-8 lg:p-12 flex flex-col sm:flex-row justify-between items-center shadow-lg gap-4">
                <div class="text-center sm:text-left flex-1">
                    <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-[#3C5148]">Mitra PKL</h1>
                    <p class="text-sm sm:text-lg lg:text-2xl text-[#3C5148] opacity-70 mt-1">Unggul, Berkarakter, Kompeten</p>
                </div>
                <div class="flex-shrink-0">
                    <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah" class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 object-contain">
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="mt-6 lg:-mt-6 w-full lg:max-w-[90%] mx-auto">
                <form action="" method="GET" class="relative" id="search-form">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Temukan mitra industri di sini…"
                        class="w-full pl-10 sm:pl-12 pr-12 sm:pr-14 py-3 sm:py-3.5 rounded-lg bg-gray-200 text-sm sm:text-base text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#3C5148]"
                    >
                    <button type="submit" aria-label="Cari" class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-[#3C5148] p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="sm:w-6 sm:h-6">
                            <path d="m21 21-4.34-4.34"/>
                            <circle cx="11" cy="11" r="8"/>
                        </svg>
                    </button>
                    <span class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="sm:w-6 sm:h-6">
                            <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/>
                            <path d="M22 10v6"/>
                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>
                        </svg>
                    </span>
                </form>
            </div>
        </div>
    </section>

    {{-- Berita Card Carousel --}}
    <section class="w-full px-4 sm:px-6 lg:px-8 mt-8 sm:mt-10 lg:mt-12">
        <div class="max-w-7xl mx-auto">
            <div class="swiper mitraSwiper">
                <div class="swiper-wrapper">
                    @foreach($beritas as $berita)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden text-gray-800 hover:scale-105 transition-transform duration-300 flex flex-col h-72 sm:h-80">
                                {{-- Gambar --}}
                                <div class="relative w-full h-32 sm:h-36 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="object-cover w-full h-full" />
                                </div>

                                {{-- Konten --}}
                                <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                                    <h3 class="font-bold text-sm sm:text-base line-clamp-2">{{ $berita->judul }}</h3>
                                    <p class="text-xs sm:text-sm text-gray-600 mt-2 line-clamp-3">{{ Str::limit($berita->isi, 100) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- List Perusahaan Section --}}
    <section id="company-section" class="w-full px-4 sm:px-6 lg:px-8 mt-10 sm:mt-12 lg:mt-16 mb-10 sm:mb-12 lg:mb-16">
        <div class="max-w-7xl mx-auto">
            {{-- Header --}}
            <h2 class="text-white text-xl sm:text-2xl lg:text-3xl font-bold mb-4 sm:mb-6">List Perusahaan</h2>

            {{-- Filter Buttons --}}
            <div class="flex flex-wrap gap-2 sm:gap-3 mb-6 sm:mb-8">
                <button class="filter-btn active px-4 sm:px-6 py-2 sm:py-2.5 bg-[#678E4D] text-white rounded-full text-xs sm:text-sm font-medium hover:bg-[#5a7842] transition-colors min-h-[44px]" data-filter="all">
                    SEMUA
                </button>
                @foreach($jurusans as $jurusan)
                    <button class="filter-btn px-4 sm:px-6 py-2 sm:py-2.5 bg-[#D9D9D9] text-[#2D3E34] rounded-full text-xs sm:text-sm font-medium hover:bg-[#5a7842] hover:text-white transition-colors min-h-[44px]" data-filter="{{ $jurusan->kode_jurusan }}">
                        {{ $jurusan->kode_jurusan }}
                    </button>
                @endforeach
            </div>

            {{-- Company Cards Grid --}}
            <div id="company-list" class="space-y-4 sm:space-y-6">
                @foreach($mitras as $mitra)
                    {{-- Desktop/Tablet Layout --}}
                    <div
                        class="company-card relative hidden sm:flex items-center w-full justify-center mx-auto"
                        data-category="{{ $mitra->jurusan->kode_jurusan ?? 'all' }}"
                        data-major="{{ Str::lower($mitra->jurusan->kode_jurusan ?? '') }}"
                        data-name="{{ Str::lower($mitra->name) }}"
                        data-desc="{{ Str::lower(Str::limit($mitra->deskripsi, 500)) }}"
                        data-addr="{{ Str::lower($mitra->alamat) }}"
                    >
                        {{-- Lingkaran logo --}}
                        <div class="bg-white rounded-full shadow-xl w-32 h-32 md:w-40 md:h-40 lg:w-[200px] lg:h-[200px] flex items-center justify-center z-10 absolute left-0">
                            <img src="{{ $mitra->image ? asset('images/'.$mitra->image) : asset('images/gama.png') }}" alt="{{ $mitra->name }} Logo" class="w-20 h-20 md:w-28 md:h-28 lg:w-[140px] lg:h-[140px] object-contain rounded-full">
                        </div>

                        {{-- Kartu perusahaan --}}
                        <div class="bg-white rounded-2xl shadow-md w-full min-h-[160px] md:min_h-[180px] lg:h-[210px] pl-20 md:pl-28 lg:pl-[175px] pr-6 md:pr-8 lg:pr-10 py-6 flex flex-col justify-center relative overflow-hidden ml-16 md:ml-20 lg:ml-[110px]">
                            <h2 class="text-base md:text-lg lg:text-xl font-bold text-black pr-24 md:pr-32">{{ $mitra->name }}</h2>
                            <p class="text-gray-500 text-xs md:text-sm lg:text-base mt-2 leading-relaxed line-clamp-2 pr-24 md:pr-32">
                                {{ $mitra->deskripsi }}
                            </p>
                            <div class="flex items-center mt-3 text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <span class="text-xs md:text-sm lg:text-base line-clamp-1">{{ $mitra->alamat }}</span>
                            </div>

                            {{-- Badge Kuota & Jurusan --}}
                            <div class="absolute top-3 md:top-4 right-3 md:right-4 flex flex-col sm:flex-row gap-2">
                                <span class="text-[10px] md:text-xs px-2.5 md:px-3 py-1 md:py-1.5 bg-[#3C5148] text-white rounded-full font-semibold whitespace-nowrap">
                                    {{ $mitra->jurusan->kode_jurusan ?? 'N/A' }}
                                </span>
                                <span class="text-[10px] md:text-xs px-2.5 md:px-3 py-1 md:py-1.5 bg-[#678E4D] text-white rounded-full font-semibold whitespace-nowrap">
                                    Kuota: {{ $mitra->kuota }}
                                </span>
                            </div>

                            {{-- Lengkungan kiri ke dalam --}}
                            <div class="absolute top-0 left-0 h-full w-16 md:w-20 lg:w-[100px] bg-[#3f544a] rounded-r-full"></div>
                        </div>
                    </div>

                    {{-- Mobile Layout --}}
                    <div
                        class="company-card sm:hidden block bg-white rounded-2xl shadow-lg overflow-hidden"
                        data-category="{{ $mitra->jurusan->kode_jurusan ?? 'all' }}"
                        data-major="{{ Str::lower($mitra->jurusan->kode_jurusan ?? '') }}"
                        data-name="{{ Str::lower($mitra->name) }}"
                        data-desc="{{ Str::lower(Str::limit($mitra->deskripsi, 500)) }}"
                        data-addr="{{ Str::lower($mitra->alamat) }}"
                    >
                        {{-- Logo Section --}}
                        <div class="bg-[#3f544a] p-4 flex justify-center items-center">
                            <div class="bg-white rounded-full shadow-xl w-24 h-24 flex items-center justify-center">
                                <img src="{{ $mitra->image ? asset('images/'.$mitra->image) : asset('images/gama.png') }}" alt="{{ $mitra->name }} Logo" class="w-16 h-16 object-contain rounded-full">
                            </div>
                        </div>

                        {{-- Content Section --}}
                        <div class="p-4">
                            {{-- Badges --}}
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="text-xs px-3 py-1.5 bg-[#3C5148] text-white rounded-full font-semibold">
                                    {{ $mitra->jurusan->kode_jurusan ?? 'N/A' }}
                                </span>
                                <span class="text-xs px-3 py-1.5 bg-[#678E4D] text-white rounded-full font-semibold">
                                    Kuota: {{ $mitra->kuota }}
                                </span>
                            </div>

                            {{-- Company Name --}}
                            <h2 class="text-lg font-bold text-black mb-2">{{ $mitra->name }}</h2>

                            {{-- Description --}}
                            <p class="text-gray-600 text-sm leading-relaxed mb-3 line-clamp-3">
                                {{ $mitra->deskripsi }}
                            </p>

                            {{-- Location --}}
                            <div class="flex items-start text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <span class="text-sm flex-1">{{ $mitra->alamat }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty state (disembunyikan default) --}}
            <div id="empty-state" class="text-white/90 text-center text-sm sm:text-base mt-6 hidden">
                Tidak ada hasil yang cocok.
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });

        // Swiper Initialization
        const swiper = new Swiper('.mitraSwiper', {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                375: { slidesPerView: 1.2, spaceBetween: 16 },
                480: { slidesPerView: 1.5, spaceBetween: 16 },
                640: { slidesPerView: 2, spaceBetween: 20 },
                768: { slidesPerView: 2.5, spaceBetween: 24 },
                1024:{ slidesPerView: 3.5, spaceBetween: 30 },
                1280:{ slidesPerView: 4, spaceBetween: 30 },
            },
        });

        // ===========================
        //  FILTER + SEARCH (FULL)
        // ===========================
        const searchForm   = document.getElementById('search-form');
        const searchInput  = searchForm?.querySelector('input[name="q"]');
        const filterBtns   = document.querySelectorAll('.filter-btn');
        const companyCards = document.querySelectorAll('.company-card');
        const emptyStateEl = document.getElementById('empty-state');

        let activeCategory = 'all';

        function debounce(fn, delay = 200) {
            let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), delay); };
        }

        function applyFilters() {
            const q = (searchInput?.value || '').trim().toLowerCase();
            let visibleCount = 0;

            companyCards.forEach(card => {
                const category = card.getAttribute('data-category') || 'all';
                const name  = card.getAttribute('data-name')  || '';
                const desc  = card.getAttribute('data-desc')  || '';
                const addr  = card.getAttribute('data-addr')  || '';
                const major = card.getAttribute('data-major') || '';

                const matchCategory = (activeCategory === 'all') || (category === activeCategory);
                const matchQuery = q === '' || name.includes(q) || desc.includes(q) || addr.includes(q) || major.includes(q);

                const isShow = matchCategory && matchQuery;
                card.style.display = isShow ? '' : 'none';
                if (isShow) {
                    visibleCount++;
                    card.classList.add('animate-fade-in');
                } else {
                    card.classList.remove('animate-fade-in');
                }
            });

            emptyStateEl.classList.toggle('hidden', visibleCount > 0);
        }

        // tombol jurusan
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-[#678E4D]', 'text-white');
                    b.classList.add('bg-[#D9D9D9]', 'text-[#2D3E34]');
                });
                btn.classList.add('active', 'bg-[#678E4D]', 'text-white');
                btn.classList.remove('bg-[#D9D9D9]', 'text-[#2D3E34]');

                activeCategory = btn.getAttribute('data-filter') || 'all';
                applyFilters();
            });
        });

        // cegah reload saat submit
        if (searchForm) {
            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                applyFilters();
                // Opsional sinkron URL:
                // const params = new URLSearchParams(window.location.search);
                // params.set('q', searchInput.value);
                // window.history.replaceState({}, '', `${location.pathname}?${params.toString()}`);
            });
        }

        // live search
        if (searchInput) {
            searchInput.addEventListener('input', debounce(applyFilters, 200));
        }

        // init pertama kali (pakai nilai q dari URL jika ada)
        applyFilters();
    </script>

    <style>
        .filter-btn.active {
            background-color: #678E4D;
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }

        .line-clamp-1 { display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; overflow:hidden; }
        .line-clamp-2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
        .line-clamp-3 { display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden; }

        * { transition: none; }
        .filter-btn, .company-card { transition: all 0.3s ease; }
    </style>

    {{-- Tambahan script per-halaman --}}
    @stack('scripts')
</body>
</html>
