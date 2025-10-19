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

  {{-- Carousel (Alpine.js) --}}
  <div
    x-data="{
      current: 0,
      slides: [
        { image: '{{ asset('images/carousel-1.png') }}', title: 'Mencetak Generasi Unggul dan Berkarakter', description: 'Kolaborasi dengan berbagai perusahaan terkemuka untuk pengalaman PKL terbaik.' },
        { image: '{{ asset('images/carousel-2.png') }}', title: 'Pengalaman Nyata, Keahlian Nyata', description: 'Menghadirkan pembelajaran bermakna melalui pengalaman nyata.' },
        { image: '{{ asset('images/carousel-3.png') }}', title: 'Bersama Mencetak Generasi Emas', description: 'Generasi kreatif, inovatif, dan berdaya saing global.' }
      ]
    }"
    x-init="setInterval(() => { current = (current + 1) % slides.length }, 5000)"
    class="relative w-full h-full"
  >
    <template x-for="(slide, index) in slides" :key="index">
      <div x-show="current === index" x-transition.opacity.duration.1000ms class="absolute inset-0 w-full h-full">
        <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-black/40"></div>

        {{-- Overlay Desktop --}}
        <div class="hidden lg:block absolute bottom-24 left-8 right-8 z-10">
          <h2 class="text-white text-3xl font-bold mb-3 max-w-md leading-snug" x-text="slide.title"></h2>
          <p class="text-white/90 text-lg max-w-md leading-relaxed" x-text="slide.description"></p>
        </div>

        {{-- Overlay Mobile --}}
        <div class="lg:hidden absolute bottom-4 left-4 right-4 z-10">
          <h2 class="text-white text-lg font-bold mb-1 leading-tight" x-text="slide.title"></h2>
        </div>
      </div>
    </template>

    {{-- Tombol Kiri --}}
    <button
      type="button"
      @click="current = (current - 1 + slides.length) % slides.length"
      class="absolute left-2 lg:left-4 top-1/2 -translate-y-1/2 z-20 w-8 h-8 lg:w-12 lg:h-12 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white/30 transition"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:w-6 lg:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
      </svg>
    </button>

    {{-- Tombol Kanan --}}
    <button
      type="button"
      @click="current = (current + 1) % slides.length"
      class="absolute right-2 lg:right-4 top-1/2 -translate-y-1/2 z-20 w-8 h-8 lg:w-12 lg:h-12 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white/30 transition"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:w-6 lg:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
      </svg>
    </button>

    {{-- Dots --}}
    <div class="absolute bottom-2 left-4 lg:bottom-8 lg:left-8 z-20 flex gap-2">
      <template x-for="(slide, index) in slides" :key="index">
        <button
          type="button"
          @click="current = index"
          :class="current === index ? 'bg-white' : 'bg-white/50'"
          class="w-2 h-2 lg:w-3 lg:h-3 rounded-full transition"
        ></button>
      </template>
    </div>
  </div>
</div>
