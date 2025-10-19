<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - SMK NEGERI 2 DEPOK SLEMAN</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="icon" href="{{ asset('images/logo-sekolah.png') }}" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="font-poppins antialiased text-gray-800">
<div class="min-h-screen flex flex-col lg:flex-row">

  {{-- Left: Carousel (copy dari forgot/login) --}}
  @includeWhen(true, 'auth.partials.left-carousel')

  {{-- Right: Form --}}
  <div class="flex-1 bg-gray-50 flex items-center justify-center p-4 lg:p-8">
    <div class="w-full max-w-md">
      <a href="{{ route('index') }}"
         class="inline-flex items-center gap-2 text-[#3C5148] hover:text-[#678E4D] font-medium mb-6 transition group">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span class="text-sm lg:text-base">Kembali ke Beranda</span>
      </a>

      <div class="text-start mb-6 lg:mb-8">
        <h2 class="text-2xl lg:text-3xl font-bold text-[#3C5148] mb-2">Reset Password</h2>
        <p class="text-sm lg:text-base text-[#1B2727]">Silakan buat password baru Anda.</p>
      </div>

      @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 text-red-700 px-4 py-3 ring-1 ring-red-200">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('password.store') }}" class="space-y-4 lg:space-y-6">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        <input type="hidden" name="email" value="{{ old('email', request('email')) }}">

        <input type="email" name="email" placeholder="Email"
               class="w-full px-4 py-3 border border-[#D5DDDF] rounded-lg focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition text-sm lg:text-base"
               value="{{ old('email', request('email')) }}" required />

        <input type="password" name="password" placeholder="Password baru"
               class="w-full px-4 py-3 border border-[#D5DDDF] rounded-lg focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition text-sm lg:text-base"
               required />

        <input type="password" name="password_confirmation" placeholder="Konfirmasi password"
               class="w-full px-4 py-3 border border-[#D5DDDF] rounded-lg focus:ring-2 focus:ring-[#3C5148] focus:border-transparent transition text-sm lg:text-base"
               required />

        <button type="submit"
                class="w-full bg-[#3C5148] hover:bg-[#678E4D] text-white font-semibold py-3 rounded-lg focus:ring-2 focus:ring-green-600 focus:ring-offset-2 transition text-sm lg:text-base">
          Simpan Password
        </button>
      </form>
    </div>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script> AOS.init({ duration: 800, once: true }); </script>
</body>
</html>
