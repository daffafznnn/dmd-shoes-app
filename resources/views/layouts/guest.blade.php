<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/f3a53ecdc1.js" crossorigin="anonymous"></script>

    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 bg-gray-100 antialiased">
    <!-- Header -->
    <x-guest.header />
    <!-- New Navigation Below Header -->
    <x-guest.navbar />
    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <!-- Footer -->
    <x-guest.footer />
    @stack('scripts')
</body>

</html>
