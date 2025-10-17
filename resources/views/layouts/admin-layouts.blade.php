<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Dashboard | SMK N 2 Depok Sleman')</title>

  {{-- Vite --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Favicon --}}
  <link rel="icon" href="{{ asset('images/logo-sekolah.png') }}" type="image/png">

  {{-- Google Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  {{-- Lucide Icons --}}
  <script src="https://unpkg.com/lucide@latest"></script>

  <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex">

  {{-- ===== Topbar (mobile & tablet) ===== --}}
  <header class="md:hidden fixed top-0 inset-x-0 z-40 bg-white/90 backdrop-blur border-b border-gray-200">
    <div class="h-14 flex items-center justify-between px-4">
      <button id="open-sidebar" class="p-2 rounded-md hover:bg-gray-100" aria-label="Open Sidebar">
        <i data-lucide="menu" class="w-5 h-5"></i>
      </button>
      <div class="flex items-center gap-2">
        <img src="{{ asset('images/logo-sekolah.png') }}" class="w-8 h-8 rounded-full" alt="Logo">
        <span class="font-semibold text-sm">SMK N 2 DEPOK</span>
      </div>
      <div class="w-5" aria-hidden="true"></div>
    </div>
  </header>

  {{-- ===== Sidebar + Overlay ===== --}}
  <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"></div>

  <aside id="sidebar"
         class="box-border fixed left-0 top-0 z-50 h-screen w-64 bg-[#2F463F] text-white flex flex-col justify-between shadow-lg
                transition-transform duration-300 -translate-x-full md:translate-x-0">

    {{-- Sidebar header --}}
    <div>
      <div class="hidden md:flex items-center gap-3 px-6 py-5">
        <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
        <h1 class="text-lg font-semibold leading-tight">SMK N 2 DEPOK</h1>
      </div>

      {{-- Close button (mobile) --}}
      <div class="md:hidden flex items-center justify-between px-4 py-4">
        <div class="flex items-center gap-3">
          <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo" class="w-9 h-9 rounded-full">
          <h1 class="text-base font-semibold leading-tight">SMK N 2 DEPOK</h1>
        </div>
        <button id="close-sidebar" class="p-2 rounded-md hover:bg-white/10" aria-label="Close Sidebar">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </div>

      {{-- Profile kecil --}}
      <div class="text-center mt-2 md:mt-6 px-4">
        <img src="{{ asset('images/profil-img.png') }}" alt="Profile" class="bg-gray-100 w-20 h-20 mx-auto rounded-full">
        <p class="mt-3 font-semibold text-sm">Admin</p>
        <p class="text-xs text-gray-300">Dashboard Admin</p>
      </div>

      {{-- Navigation --}}
      <nav class="mt-6 md:mt-8 flex flex-col space-y-1 px-3 md:px-4">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-md transition-all duration-200
           {{ request()->routeIs('dashboard')
              ? 'bg-white/20 text-white shadow-inner'
              : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
          <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
          <span>Dashboard</span>
        </a>

        {{-- Pendaftaran PKL --}}
        <a href="{{ route('admin.registrations.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-md transition-all duration-200
           {{ request()->routeIs('admin.registrations.*')
              ? 'bg-white/20 text-white shadow-inner'
              : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
          <i data-lucide="clipboard-list" class="w-5 h-5"></i>
          <span>Pendaftaran PKL</span>
        </a>

        {{-- Daftar Siswa --}}
        <a href="{{ route('admin.siswa') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-md transition-all duration-200
           {{ request()->routeIs('admin.siswa')
              ? 'bg-white/20 text-white shadow-inner'
              : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
          <i data-lucide="users" class="w-5 h-5"></i>
          <span>Daftar Siswa</span>
        </a>

        {{-- Daftar Perusahaan --}}
        <a href="{{ route('admin.perusahaan') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-md transition-all duration-200
           {{ request()->routeIs('admin.perusahaan')
              ? 'bg-white/20 text-white shadow-inner'
              : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
          <i data-lucide="building" class="w-5 h-5"></i>
          <span>Daftar Perusahaan</span>
        </a>

        {{-- Jadwal Pendaftaran --}}
        <a href="{{ route('admin.jadwal.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-md transition-all duration-200
           {{ request()->routeIs('admin.jadwal.*')
              ? 'bg-white/20 text-white shadow-inner'
              : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
          <i data-lucide="calendar" class="w-5 h-5"></i>
          <span>Jadwal Pendaftaran</span>
        </a>

        {{-- Daftar Berita --}}
        <a href="{{ route('admin.berita') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-md transition-all duration-200
           {{ request()->routeIs('admin.berita')
              ? 'bg-white/20 text-white shadow-inner'
              : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
          <i data-lucide="newspaper" class="w-5 h-5"></i>
          <span>Daftar Berita</span>
        </a>
      </nav>
    </div>

    {{-- Logout --}}
    <div class="px-3 md:px-4 py-5">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-2.5 rounded-md transition-all duration-200 text-gray-300 hover:bg-white/10 hover:text-white">
          <i data-lucide="log-out" class="w-5 h-5"></i>
          <span>Log out</span>
        </button>
      </form>
    </div>
  </aside>

  {{-- ===== Main Content ===== --}}
  <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto w-full
                pt-16 md:pt-0  {{-- kasih ruang topbar saat mobile --}}
                md:ml-64      {{-- offset 16rem saat desktop biar sejajar sidebar --}}
              ">
    <div class="max-w-screen-2xl mx-auto">
      @yield('content')
    </div>
  </main>

  <script>
    lucide.createIcons();

    const sidebar  = document.getElementById('sidebar');
    const overlay  = document.getElementById('sidebar-overlay');
    const openBtn  = document.getElementById('open-sidebar');
    const closeBtn = document.getElementById('close-sidebar');

    function openSidebar() {
      sidebar.classList.remove('-translate-x-full');
      overlay.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
      document.body.style.overflow = '';
    }

    openBtn?.addEventListener('click', openSidebar);
    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);

    // Guard saat resize: di desktop sidebar selalu tampil, overlay hilang
    window.addEventListener('resize', () => {
      if (window.innerWidth >= 768) {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
      } else {
        // kembali ke mode off-canvas
        sidebar.classList.add('-translate-x-full');
      }
    });
  </script>

  @stack('scripts')
</body>
</html>
