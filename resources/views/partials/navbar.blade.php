{{-- resources/views/layouts/navbar.blade.php --}}
<style>
  html, body { overflow-x: hidden; }
</style>

<div class="fixed inset-x-0 top-4 z-50">
  <nav class="font-poppins bg-white/95 backdrop-blur rounded-full shadow-xl px-4 sm:px-6 py-3 flex items-center w-full max-w-7xl mx-auto justify-between">
    {{-- Logo Sekolah + Partner --}}
    <div class="flex items-center gap-5 flex-shrink-0">
      <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah" class="h-10 sm:h-12 object-contain">
      <img src="{{ asset('images/logo-partner.png') }}" alt="Logo Partner" class="h-7 sm:h-9 lg:h-10 object-contain">
    </div>

    {{-- Desktop Menu --}}
    <ul class="items-center hidden md:flex space-x-6 lg:space-x-8 text-sm font-medium text-[#3C5148]">
      <li><a href="{{ route('index') }}" class="hover:text-[#678E4D] {{ request()->is('/') ? 'text-[#678E4D]' : '' }}">Beranda</a></li>
      <li><a href="{{ route('mitra.index') }}" class="hover:text-[#678E4D] {{ request()->is('mitra*') ? 'text-[#678E4D]' : '' }}">Mitra</a></li>
      <li><a href="{{ route('daftar-pkl.index') }}" class="hover:text-[#678E4D] {{ request()->is('daftar-pkl*') ? 'text-[#678E4D]' : '' }}">Daftar PKL</a></li>

      @auth
        <li>
          @if (request()->routeIs('profile.index'))
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="px-4 py-2 bg-[#3C5148] text-white rounded-full hover:bg-[#678E4D]">Logout</button>
            </form>
          @else
            <a href="{{ route('profile.index') }}" class="text-[#3C5148] hover:text-[#1B2727]" aria-label="Profil">
              <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </a>
          @endif
        </li>
      @else
        <li><a href="{{ route('login') }}" class="px-4 py-2 bg-[#3C5148] text-white rounded-full hover:bg-[#678E4D]">Login</a></li>
      @endauth
    </ul>

    {{-- Mobile Button --}}
    <button id="menu-toggle" class="md:hidden p-2 text-[#3C5148] hover:text-[#678E4D] transition w-10 h-10 ml-auto">
      <div class="relative w-7 h-7">
        <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="absolute w-7 h-7 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="4" y1="8" x2="20" y2="8"/>
          <line x1="4" y1="16" x2="20" y2="16"/>
        </svg>
        <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="absolute w-7 h-7 opacity-0 rotate-90 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </div>
    </button>
  </nav>

  {{-- ✅ Mobile Menu Panel (lebih jelas, tetap elegan) --}}
  <div
    id="mobile-menu"
    class="md:hidden absolute left-0 right-0 mx-auto mt-3 w-[92%] max-w-7xl origin-top scale-y-0 opacity-0 pointer-events-none
           bg-white rounded-2xl shadow-2xl overflow-hidden transition-all duration-200"
    style="transform-origin: top;"
  >
    <ul class="flex flex-col divide-y divide-gray-200 text-[#3C5148]">
      <li><a href="{{ route('index') }}" class="block px-6 py-4 text-base font-medium hover:bg-gray-50 {{ request()->is('/') ? 'text-[#678E4D]' : '' }}">Beranda</a></li>
      <li><a href="{{ route('mitra.index') }}" class="block px-6 py-4 text-base font-medium hover:bg-gray-50 {{ request()->is('mitra*') ? 'text-[#678E4D]' : '' }}">Mitra</a></li>
      <li><a href="{{ route('daftar-pkl.index') }}" class="block px-6 py-4 text-base font-medium hover:bg-gray-50 {{ request()->is('daftar-pkl*') ? 'text-[#678E4D]' : '' }}">Daftar PKL</a></li>

      @auth
        <li>
          @if (request()->routeIs('profile.index'))
            <form method="POST" action="{{ route('logout') }}" class="px-6 py-4">
              @csrf
              <button type="submit" class="w-full px-4 py-2 bg-[#3C5148] text-white rounded-full hover:bg-[#678E4D]">Logout</button>
            </form>
          @else
            <a href="{{ route('profile.index') }}" class="block px-6 py-4 text-base font-medium hover:bg-gray-50">Profil</a>
          @endif
        </li>
      @else
        <li class="px-6 py-4">
          <a href="{{ route('login') }}" class="block text-center px-4 py-2 bg-[#3C5148] text-white rounded-full hover:bg-[#678E4D]">Login</a>
        </li>
      @endauth
    </ul>
  </div>
</div>

{{-- Script --}}
<script>
  (function () {
    const toggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    let isOpen = false;
    function openMenu() {
      menu.classList.remove('opacity-0', 'scale-y-0', 'pointer-events-none');
      menu.classList.add('opacity-100', 'scale-y-100');
      menuIcon.classList.add('opacity-0', 'rotate-90');
      closeIcon.classList.remove('opacity-0', 'rotate-90');
      document.documentElement.style.overflow = 'hidden';
      document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
      menu.classList.add('opacity-0', 'scale-y-0', 'pointer-events-none');
      menu.classList.remove('opacity-100', 'scale-y-100');
      menuIcon.classList.remove('opacity-0', 'rotate-90');
      closeIcon.classList.add('opacity-0', 'rotate-90');
      document.documentElement.style.overflow = '';
      document.body.style.overflow = '';
    }

    toggle?.addEventListener('click', () => {
      isOpen ? closeMenu() : openMenu();
      isOpen = !isOpen;
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 768 && isOpen) {
        closeMenu(); isOpen = false;
      }
    });
  })();
</script>
