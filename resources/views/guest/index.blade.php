<x-guest-layout>
    <!-- Start: Carousel -->
    <x-guest.carousel />
    <!-- End: Carousel -->

    @if ($isLoading)
        <section class="container mx-auto px-4 py-8">
            <div class="text-center">
                <span class="loading loading-dots loading-lg text-green"></span>
            </div>
        </section>
    @else
        @if ($featuredProducts->isNotEmpty())
            <!-- Start: Featured Products -->
            <section class="container mx-auto px-4 py-8 bg-gray-100">
                <h2 class="text-3xl font-semibold mb-4">{{ __('Featured Products') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($featuredProducts as $product)
                        @component('components.guest.card-product', ['product' => $product])
                        @endcomponent
                    @empty
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @for ($i = 0; $i < 12; $i++)
                                {{-- Menampilkan 12 skeleton loader --}}
                                <div class="flex flex-col gap-4">
                                    <div class="h-40 w-40 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk gambar --}}
                                    <span class="loading loading-dots loading-lg"></span> {{-- Handle loading for image --}}
                                    <div class="h-8 w-40 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk nama produk --}}
                                    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk harga --}}
                                    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk tombol --}}
                                </div>
                            @endfor
                        </div>
                    @endforelse
                </div>
            </section>
            <!-- End: Featured Products -->
        @endif

        @if ($menProducts->isNotEmpty())
            <!-- Start: Men's Products -->
            <section class="container mx-auto px-4 py-8">
                <h2 class="text-3xl font-semibold mb-4">{{ __("Men's Products") }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($menProducts as $product)
                        @component('components.guest.card-product', ['product' => $product])
                        @endcomponent
                    @empty
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @for ($i = 0; $i < 12; $i++)
                                {{-- Menampilkan 12 skeleton loader --}}
                                <div class="flex flex-col gap-4">
                                    <div class="h-40 w-40 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk gambar --}}
                                    <span class="loading loading-dots loading-lg"></span> {{-- Handle loading for image --}}
                                    <div class="h-8 w-40 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk nama produk --}}
                                    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk harga --}}
                                    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk tombol --}}
                                </div>
                            @endfor
                        </div>
                    @endforelse
                </div>
                <div class="text-center mt-4">
                    <a href="{{ Route('product.all', ['keyword' => 'man']) }}"
                        class="text-blue-500 hover:underline">{{ __('See More Men\'s Products') }}</a>
                </div>
            </section>
            <!-- End: Men's Products -->
        @endif

        @if ($womenProducts->isNotEmpty())
            <!-- Start: Women's Products -->
            <section class="container mx-auto px-4 py-8">
                <h2 class="text-3xl font-semibold mb-4">{{ __("Women's Products") }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($womenProducts as $product)
                        @component('components.guest.card-product', ['product' => $product])
                        @endcomponent
                    @empty
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @for ($i = 0; $i < 12; $i++)
                                {{-- Menampilkan 12 skeleton loader --}}
                                <div class="flex flex-col gap-4">
                                    <div class="h-40 w-40 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk gambar --}}
                                    <span class="loading loading-dots loading-lg"></span> {{-- Handle loading for image --}}
                                    <div class="h-8 w-40 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk nama produk --}}
                                    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk harga --}}
                                    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk tombol --}}
                                </div>
                            @endfor
                        </div>
                    @endforelse
                </div>
                <div class="text-center mt-4">
                    <a href="{{ Route('product.all', ['keyword' => 'woman']) }}"
                        class="text-blue-500 hover:underline">{{ __('See More Women\'s Products') }}</a>
                </div>
            </section>
            <!-- End: Women's Products -->
        @endif

        @if ($unisexProducts->isNotEmpty())
            <!-- Start: Unisex Products -->
            <section class="container mx-auto px-4 py-8">
                <h2 class="text-3xl font-semibold mb-4">{{ __('Unisex Products') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($unisexProducts as $product)
                        @component('components.guest.card-product', ['product' => $product])
                        @endcomponent
                    @empty
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @for ($i = 0; $i < 12; $i++)
                                {{-- Menampilkan 12 skeleton loader --}}
                                <div class="flex flex-col gap-4">
                                    <div class="h-40 w-40 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk gambar --}}
                                    <span class="loading loading-dots loading-lg"></span> {{-- Handle loading for image --}}
                                    <div class="h-8 w-40 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk nama produk --}}
                                    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk harga --}}
                                    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div>
                                    {{-- Skeleton untuk tombol --}}
                                </div>
                            @endfor
                        </div>
                    @endforelse
                </div>
                <div class="text-center mt-4">
                    <a href="{{ Route('product.all', ['keyword' => 'unisex']) }}"
                        class="text-blue-500 hover:underline">{{ __('See More Unisex Products') }}</a>
                </div>
            </section>
            <!-- End: Unisex Products -->
        @endif
    @endif
</x-guest-layout>
