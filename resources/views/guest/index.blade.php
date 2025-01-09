<x-guest-layout>
    <!-- Start: Carousel -->
    <x-guest.carousel />
    <!-- End: Carousel -->

    <!-- Start: Filter -->
    <section class="container mx-auto px-4 py-8">
        <x-guest.filter />
    </section>
    <!-- End: Filter -->

    @if($featuredProducts->isNotEmpty())
    <!-- Start: Featured Products -->
    <section class="container mx-auto px-4 py-8 bg-gray-100 rounded-md shadow-md">
        <h2 class="text-3xl font-semibold mb-4">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @component('components.guest.card-product', ['products' => $featuredProducts])
            @endcomponent
        </div>
    </section>
    <!-- End: Featured Products -->
    @endif

    @if($menProducts->isNotEmpty())
    <!-- Start: Men's Products -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">Men's Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @component('components.guest.card-product', ['products' => $menProducts])
            @endcomponent
        </div>
        <div class="text-center mt-4">
            <a href="#" class="text-blue-500 hover:underline">See More Men's Products</a>
        </div>
    </section>
    <!-- End: Men's Products -->
    @endif

    @if($womenProducts->isNotEmpty())
    <!-- Start: Women's Products -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">Women's Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @component('components.guest.card-product', ['products' => $womenProducts])
            @endcomponent
        </div>
        <div class="text-center mt-4">
            <a href="#" class="text-blue-500 hover:underline">See More Women's Products</a>
        </div>
    </section>
    <!-- End: Women's Products -->
    @endif

    @if($unisexProducts->isNotEmpty())
    <!-- Start: Unisex Products -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">Unisex Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @component('components.guest.card-product', ['products' => $unisexProducts])
            @endcomponent
        </div>
        <div class="text-center mt-4">
            <a href="#" class="text-blue-500 hover:underline">See More Unisex Products</a>
        </div>
    </section>
    <!-- End: Unisex Products -->
    @endif
</x-guest-layout>

