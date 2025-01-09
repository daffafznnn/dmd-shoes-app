    <div class="relative w-full max-w-6xl mx-auto overflow-hidden mt-5">
        <!-- Carousel container -->
        <div id="carousel" class="carousel flex transition-all duration-500 ease-in-out">
            <!-- Slide 1 -->
            <div class="relative flex-shrink-0 w-full h-64 lg:h-72 xl:h-80">
                <img src="{{ asset('assets/images/carousel-1.webp') }}" alt="Image 1" class="w-full h-full">
            </div>

            <!-- Slide 2 -->
            <div class="relative flex-shrink-0 w-full h-64 lg:h-72 xl:h-80">
                <img src="{{ asset('assets/images/carousel-2.webp') }}" alt="Image 2"
                    class="w-full h-full object-cover">
            </div>

            <!-- Slide 3 -->
            <div class="relative flex-shrink-0 w-full h-64 lg:h-72 xl:h-80">
                <img src="{{ asset('assets/images/carousel-3.webp') }}" alt="Image 3"
                    class="w-full h-full object-contain">
            </div>
        </div>

        <!-- Carousel Controls -->
        <button id="prev"
            class="absolute top-1/2 left-0 transform -translate-y-1/2 p-4 hover:bg-black hover:text-white text-black rounded-full">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button id="next"
            class="absolute top-1/2 right-0 transform -translate-y-1/2 p-4 hover:bg-black hover:text-white text-black rounded-full">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    @push('scripts')
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

                // Start the carousel
                setInterval(showNextSlide, 3000);
            });
        </script>
    @endpush
