{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - SMK NEGERI 2 DEPOK SLEMAN</title>

    {{-- Vite (CSS & JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logo-sekolah.png') }}" type="image/png">

    {{-- Google Fonts: Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    {{-- AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="font-poppins antialiased text-gray-800">
<div class="min-h-screen flex flex-col lg:flex-row">

    {{-- Left Side - Carousel --}}
    <div class="flex-1 relative overflow-hidden h-64 lg:h-screen">
        {{-- Logo Sekolah --}}
        <div class="absolute top-4 left-4 lg:top-6 lg:left-6 z-20 flex items-center gap-2 lg:gap-3">
            <img src="{{ asset('images/logo-sekolah.png') }}"
                 alt="SMK Negeri 2 Depok Sleman"
                 class="w-8 h-8 lg:w-12 lg:h-12 object-contain rounded-full p-1 shadow-md" />
            <h1 class="font-bold text-sm lg:text-lg text-white drop-shadow">
                SMK Negeri 2 Depok Sleman
            </h1>
        </div>

        {{-- Carousel --}}
        <div x-data="{ 
                current: 0, 
                slides: [
                    { image: '{{ asset('images/carousel-1.png') }}', title: 'Mencetak Generasi Unggul dan Berkarakter', description: 'Kolaborasi dengan berbagai perusahaan terkemuka untuk memberikan pengalaman PKL terbaik bagi siswa.' },
                    { image: '{{ asset('images/carousel-2.png') }}', title: 'Pengalaman Nyata, Keahlian Nyata', description: 'Menghadirkan pembelajaran bermakna melalui pengalaman nyata.' },
                    { image: '{{ asset('images/carousel-3.png') }}', title: 'Bersama Mencetak Generasi Emas', description: 'Berkomitmen melahirkan generasi yang kreatif, inovatif, dan berdaya saing global.' }
                ] 
            }"
            x-init="setInterval(() => { current = (current + 1) % slides.length }, 5000)"
            class="relative w-full h-full">

            {{-- Slides --}}
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="current === index"
                     x-transition.opacity.duration.1000ms
                     class="absolute inset-0 w-full h-full">
                    <img :src="slide.image" :alt="slide.title"
                         class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-black/40"></div>

                    {{-- Overlay Desktop --}}
                    <div class="hidden lg:block absolute bottom-24 left-8 right-8 z-10">
                        <h2 class="text-white text-3xl font-bold mb-3 max-w-md leading-snug"
                            x-text="slide.title"></h2>
                        <p class="text-white/90 text-lg max-w-md leading-relaxed"
                           x-text="slide.description"></p>
                    </div>

                    {{-- Overlay Mobile --}}
                    <div class="lg:hidden absolute bottom-4 left-4 right-4 z-10">
                        <h2 class="text-white text-lg font-bold mb-1 leading-tight"
                            x-text="slide.title"></h2>
                    </div>
                </div>
            </template>

            {{-- Tombol Kiri --}}
            <button @click="current = (current - 1 + slides.length) % slides.length"
                class="absolute left-2 lg:left-4 top-1/2 -translate-y-1/2 z-20 w-8 h-8 lg:w-12 lg:h-12 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white/30 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:w-6 lg:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            {{-- Tombol Kanan --}}
            <button @click="current = (current + 1) % slides.length"
                class="absolute right-2 lg:right-4 top-1/2 -translate-y-1/2 z-20 w-8 h-8 lg:w-12 lg:h-12 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white/30 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:w-6 lg:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Dots --}}
            <div class="absolute bottom-2 left-4 lg:bottom-8 lg:left-8 z-20 flex gap-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="current = index"
                        :class="current === index ? 'bg-white' : 'bg-white/50'"
                        class="w-2 h-2 lg:w-3 lg:h-3 rounded-full transition"></button>
                </template>
            </div>
        </div>
    </div>

    {{-- Right Side - Login Form --}}
    <div class="flex-1 bg-gray-50 flex items-center justify-center p-4 lg:p-8">
        <div class="w-full max-w-md">

            {{-- Back Button --}}
            <a href="{{ route('index') }}" 
               class="inline-flex items-center gap-2 text-[#3C5148] hover:text-[#678E4D] font-medium mb-6 transition group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="text-sm lg:text-base">Kembali ke Beranda</span>
            </a>

            {{-- Welcome --}}
            <div class="text-start mb-6 lg:mb-8">
                <h2 class="text-2xl lg:text-3xl font-bold text-[#3C5148] mb-2">
                    Selamat Datang!
                </h2>
                <p class="text-sm lg:text-base text-[#1B2727]">
                    Setiap perjalanan dimulai dengan satu langkah. Mulailah di sini.
                </p>
            </div>

            {{-- Form Login --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4 lg:space-y-6">
                @csrf

                {{-- Email or NIS --}}
                <input type="text" name="login" placeholder="Email atau NIS"
                       class="w-full px-4 py-3 border border-[#D5DDDF] rounded-lg focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition text-sm lg:text-base"
                       value="{{ old('login') }}"
                       required />

                {{-- Error Login --}}
                @error('login')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror

                {{-- Password --}}
                <div class="relative" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'" name="password" placeholder="Kata Sandi"
                           class="w-full px-4 py-3 border border-[#D5DDDF] rounded-lg focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition pr-12 text-sm lg:text-base"
                           required />
                    <button type="button" @click="show = !show"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <template x-if="!show">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:w-5 lg:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </template>
                        <template x-if="show">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off-icon lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
                        </template>
                    </button>
                </div>

                {{-- Error Password --}}
                @error('password')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror

                {{-- Remember & Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer text-xs lg:text-sm text-[#3C5148]/70">
                        <input type="checkbox" name="remember"
                               class="w-3 h-3 lg:w-4 lg:h-4 text-[#3C5148] border-gray-300 rounded focus:ring-green-600">
                        Ingat saya
                    </label>
                    <a href="{{ route('password.request') }}"
                       class="text-[#3C5148]/70 hover:text-[#678E4D] text-xs lg:text-sm font-medium">
                        Lupa Kata Sandi?
                    </a>
                </div>

                {{-- Button --}}
                <button type="submit"
                        class="w-full bg-[#3C5148] hover:bg-[#678E4D] text-white font-semibold py-3 rounded-lg focus:ring-2 focus:ring-green-600 focus:ring-offset-2 transition text-sm lg:text-base">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</div>

{{-- AOS JS --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
    });
</script>
</body>
</html>
