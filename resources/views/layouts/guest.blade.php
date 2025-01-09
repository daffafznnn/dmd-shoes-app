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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 bg-gray-100 antialiased">
    {{ $slot }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');
            const carousel = document.getElementById('carousel');
            let currentIndex = 0;
            const slides = carousel.children;

            // Function to show the next slide
            function showNextSlide() {
                if (currentIndex < slides.length - 1) {
                    currentIndex++;
                } else {
                    currentIndex = 0; // Loop back to the first slide
                }
                updateCarouselPosition();
            }

            // Function to show the previous slide
            function showPrevSlide() {
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = slides.length - 1; // Loop back to the last slide
                }
                updateCarouselPosition();
            }

            // Update the position of the carousel
            function updateCarouselPosition() {
                let offset = -currentIndex * 100; // Move the carousel based on the index
                carousel.style.transform = `translateX(${offset}%)`;
            }

            // Event listeners for buttons
            nextButton.addEventListener('click', showNextSlide);
            prevButton.addEventListener('click', showPrevSlide);
        });
    </script>
</body>

</html>
