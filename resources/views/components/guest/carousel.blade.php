@if ($banners->count() == 0)
    <section class="container mx-auto px-4 py-8 h-[10rem]">
        <div class="text-center">
            <span class="loading loading-dots loading-lg text-gray-700"></span>
        </div>
    </section>
@else
    <div class="relative w-full max-w-6xl mx-auto overflow-hidden mt-5" style="z-index: 1">
        <!-- Carousel container -->
        <div class="swiper-container w-full h-[25vh] sm:h-[30vh] md:h-[40vh] lg:h-[50vh] xl:h-[60vh] 2xl:h-[70vh]">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <a href="{{ $banner->target_url ?? '#' }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text }}"
                                class="w-full h-full object-cover">
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination (optional) -->
            <div class="swiper-pagination text-gray-700"></div>

            <!-- Navigation buttons (optional) -->
            <div class="swiper-button-next text-gray-700"></div>
            <div class="swiper-button-prev text-gray-700"></div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1, // Tampilkan satu slide per tampilan
                    spaceBetween: 10, // Jarak antar slide
                    loop: true, // Loop carousel
                    autoplay: {
                        delay: 3000, // Autoplay setiap 3 detik
                        disableOnInteraction: false, // Menjaga autoplay meskipun pengguna berinteraksi
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true, // Memungkinkan untuk mengklik pagination
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        </script>
    @endpush
@endif
