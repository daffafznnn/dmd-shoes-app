@if ($banners->count() == 0)
    <section class="container mx-auto px-4 py-8 h-[10rem]">
        <div class="text-center">
            <span class="loading loading-dots loading-lg text-green-500"></span>
        </div>
    </section>
@else
    <div class="relative w-full max-w-6xl mx-auto overflow-hidden mt-5">
        <!-- Carousel container -->
        <div class="swiper-container h-[27rem]"> <!-- Mengubah tinggi menjadi 5h-[27rem]px -->
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <a href="{{ $banner->target_url ?? '#' }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text }}" class="w-full h-[27rem] object-cover"> <!-- Mengatur gambar agar mengisi 44px -->
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination (optional) -->
            <div class="swiper-pagination text-green-500"></div>

            <!-- Navigation buttons (optional) -->
            <div class="swiper-button-next text-green-500"></div>
            <div class="swiper-button-prev text-green-500"></div>
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

