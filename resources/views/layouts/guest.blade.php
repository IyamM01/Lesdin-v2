<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Auth')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
  <div class="min-h-screen flex items-center justify-center p-6">
    <main class="w-full max-w-md bg-white shadow rounded-xl p-6">
      {{-- Untuk komponen: --}}
      {{ $slot ?? '' }}

      {{-- Untuk @extends/@section: --}}
      @yield('content')
    </main>
  </div>
</body>
</html>
