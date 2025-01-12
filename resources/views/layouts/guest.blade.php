<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
    use App\Models\Setting;

    $setting = Setting::first();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="title" content="{{ $__env->yieldContent('title') }}" />
    <meta name="description"
        content="{{ !empty(trim($__env->yieldContent('description'))) ? $__env->yieldContent('description') : '-' }}" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://domain.com/" />
    <meta property="og:title" content="{{ $__env->yieldContent('title') }}" />
    <meta property="og:description"
        content="{{ !empty(trim($__env->yieldContent('description'))) ? $__env->yieldContent('description') : '-' }}" />
    <meta property="og:image"
        content="{{ !empty(trim($__env->yieldContent('image'))) ? $__env->yieldContent('image') : asset('assets/images/logo.png') }}" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://domain.com/" />
    <meta property="twitter:title" content="{{ $__env->yieldContent('title') }}" />
    <meta property="twitter:description"
        content="{{ !empty(trim($__env->yieldContent('description'))) ? $__env->yieldContent('description') : '-' }}" />
    <meta property="twitter:image"
        content="{{ !empty(trim($__env->yieldContent('image'))) ? $__env->yieldContent('image') : asset('assets/images/logo.png') }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/f3a53ecdc1.js" crossorigin="anonymous"></script>

    <!-- CDN Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 bg-gray-100 antialiased">
    <!-- Header -->
    <x-guest.header />

    @if (Route::currentRouteName() === 'guest.index' || Route::currentRouteName() === 'product.all')
        <!-- New Navigation Below Header -->
        <x-guest.navbar />
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <!-- Footer -->
    <x-guest.footer />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
