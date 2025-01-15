@section('title', 'Home')
<x-guest-layout>
    <!-- Start: Carousel -->
    <x-guest.carousel />
    <!-- End: Carousel -->
        @if ($isLoading)
            <section class="container mx-auto px-4 py-8">
                <div class="text-center">
                    <span class="loading loading-dots loading-lg text-black"></span>
                </div>
            </section>
        @else
        @if ($featuredProducts->isNotEmpty())
            <!-- Start: Featured Products -->
            <section class="container mx-auto px-4 py-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-semibold mb-4">{{ __('Featured Products') }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($featuredProducts as $product)
                        @component('components.guest.card-product', ['product' => $product])
                        @endcomponent
                    @endforeach
                </div>
                 <div class="text-center mt-4">
                    <a href="{{ Route('product.all', ['is_featured' => 1, 'page' => 1]) }}"
                        class="bg-black hover:bg-gray-900 text-white px-5 py-3 rounded-md">{{ __('See More Featured Products') }}<i
                    class="fa-solid fa-circle-chevron-right ml-3"></i></a>
                </div>
            </section>
            <!-- End: Featured Products -->
        @else
            <section class="container mx-auto px-4 py-8">
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-300">
                        {{ __('No featured products available') }}
                    </p>
                </div>
            </section>
        @endif

        @if ($menProducts->isNotEmpty())
            <!-- Start: Men's Products -->
            <section class="container mx-auto px-4 py-8">
                <h2 class="text-3xl font-semibold mb-4">{{ __("Men's Products") }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($menProducts as $product)
                        @component('components.guest.card-product', ['product' => $product])
                        @endcomponent
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ Route('product.all', ['keyword' => 'man']) }}"
                        class="bg-black hover:bg-gray-900 text-white px-5 py-3 rounded-md">{{ __('See More Men\'s Products') }}<i
                    class="fa-solid fa-circle-chevron-right ml-3"></i></a>
                </div>
            </section>
            <!-- End: Men's Products -->
        @else
            <section class="container mx-auto px-4 py-8">
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-300">
                        {{ __('No men`s products available') }}
                    </p>
                </div>
            </section>
        @endif

        @if ($womenProducts->isNotEmpty())
            <!-- Start: Women's Products -->
            <section class="container mx-auto px-4 py-8">
                <h2 class="text-3xl font-semibold mb-4">{{ __("Women's Products") }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($womenProducts as $product)
                        @component('components.guest.card-product', ['product' => $product])
                        @endcomponent
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ Route('product.all', ['keyword' => 'woman']) }}"
                        class="bg-black hover:bg-gray-900 text-white px-5 py-3 rounded-md">{{ __('See More Women\'s Products') }}<i
                    class="fa-solid fa-circle-chevron-right ml-3"></i></a>
                </div>
            </section>
            <!-- End: Women's Products -->
        @else
            <section class="container mx-auto px-4 py-8">
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-300">
                        {{ __('No women`s products available') }}
                    </p>
                </div>
            </section>
        @endif

        @if ($unisexProducts->isNotEmpty())
            <!-- Start: Unisex Products -->
            <section class="container mx-auto px-4 py-8">
                <h2 class="text-3xl font-semibold mb-4">{{ __('Unisex Products') }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($unisexProducts as $product)
                        @component('components.guest.card-product', ['product' => $product])
                        @endcomponent
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ Route('product.all', ['keyword' => 'unisex']) }}"
                        class="bg-black hover:bg-gray-900 text-white px-5 py-3 rounded-md">{{ __('See More Unisex Products') }}<i
                    class="fa-solid fa-circle-chevron-right ml-3"></i></a>
                </div>
            </section>
            <!-- End: Unisex Products -->
        @else
            <section class="container mx-auto px-4 py-8">
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-300">
                        {{ __('No unisex products available') }}
                    </p>
                </div>
            </section>
        @endif
    @endif
</x-guest-layout>

