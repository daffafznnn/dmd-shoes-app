@section('title', 'Detail Product' . $product->name)
<x-guest-layout>
    <div class="px-5 mt-8 mb-8">
        <!-- Product Detail -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white py-4 p-5 mb-8 pb-8">
            <!-- Product Image -->
            <div class="relative">
                <img id="main-image" src="{{ asset('storage/' . $product->cover) }}" alt="{{ $product->name }}"
                    class="w-full h-96 object-contain rounded-lg shadow-lg p-4 border border-black">

                <!-- Thumbnail Images -->
                <div id="thumbnails" class="flex flex-wrap mt-4 space-x-2">
                <img src="{{ asset('storage/' . $product->cover) }}" alt="Cover Image"
                    class="w-20 h-20 object-cover rounded-md border cursor-pointer"
                    onmouseover="updateImage('{{ asset('storage/' . $product->cover) }}')"
                    onclick="updateImage('{{ asset('storage/' . $product->cover) }}')">
                @foreach ($product->product_images as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image"
                        class="w-20 h-20 object-cover rounded-md border cursor-pointer flex-shrink-0 mb-2"
                        onmouseover="updateImage('{{ asset('storage/' . $image->image_path) }}')"
                        onclick="updateImage('{{ asset('storage/' . $image->image_path) }}')">
                @endforeach
            </div>

            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-between">
                <h1 class="text-3xl font-semibold text-gray-900">{{ $product->name }}
                    @if ($product->is_featured)
                        <span
                            class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-black text-gray-100 ml-2">{{ __('Featured') }}</span>
                    @endif
                </h1>
                <p id="price" class="text-xl font-bold text-gray-900 mt-4">Rp
                    {{ number_format($priceRange['min'], 0, ',', '.') }} - Rp
                    {{ number_format($priceRange['max'], 0, ',', '.') }}</p>

                <!-- Variations -->
                <div class="mt-4">
                    <div id="material-section">
                        <span class="font-semibold">{{ __('Material') }}:</span>
                        <div class="grid grid-cols-3 md:grid-cols-4 gap-2 mt-2 checked:text-gray-100 ">
                            @foreach ($product->product_variants->pluck('material_id')->unique() as $materialId)
                                @php
                                    $material = $materials->firstWhere('id', $materialId);
                                    $isAvailable = $product->product_variants->contains(function ($variant) use (
                                        $material,
                                    ) {
                                        return $variant->material_id == $material->id &&
                                            $variant->product_stocks->sum('stock') > 0;
                                    });
                                    $hasUnavailableVariants = $product->product_variants->where('material_id', $material->id)->contains(function ($variant) {
                                        return $variant->product_stocks->sum('stock') <= 0;
                                    });
                                @endphp
                                <button
                                    class="material-option border px-4 py-2 rounded {{ !$isAvailable ? 'opacity-50 cursor-not-allowed' : '' }} {{ $hasUnavailableVariants ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    data-id="{{ $material->id }}" data-name="{{ $material->name }}"
                                    {{ (!$isAvailable || $hasUnavailableVariants) ? 'disabled' : '' }}>
                                    {{ $material->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div id="color-section" class="mt-4">
                        <span class="font-semibold">{{ __('Color') }}:</span>
                        <div class="grid grid-cols-3 md:grid-cols-4 gap-2 mt-2">
                            @foreach ($product->product_variants->pluck('color_id')->unique() as $colorId)
                                @php
                                    $color = $colors->firstWhere('id', $colorId);
                                    $isAvailable = $product->product_variants->contains(function ($variant) use (
                                        $color,
                                    ) {
                                        return $variant->color_id == $color->id &&
                                            $variant->product_stocks->sum('stock') > 0;
                                    });
                                    $hasUnavailableVariants = $product->product_variants->where('color_id', $color->id)->contains(function ($variant) {
                                        return $variant->product_stocks->sum('stock') <= 0;
                                    });
                                @endphp
                                <button
                                    class="color-option border px-4 py-2 rounded {{ !$isAvailable ? 'opacity-50 cursor-not-allowed' : '' }} {{ $hasUnavailableVariants ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    data-id="{{ $color->id }}" {{ (!$isAvailable || $hasUnavailableVariants) ? 'disabled' : '' }}>
                                    {{ $color->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div id="size-section" class="mt-4">
                        <span class="font-semibold">{{ __('Size') }}:</span>
                        <div class="grid grid-cols-3 md:grid-cols-4 gap-2 mt-2">
                            @foreach ($product->product_variants->pluck('size_id')->unique() as $sizeId)
                                @php
                                    $size = $sizes->firstWhere('id', $sizeId);
                                    $isAvailable = $product->product_variants->contains(function ($variant) use (
                                        $size,
                                    ) {
                                        return $variant->size_id == $size->id &&
                                            $variant->product_stocks->sum('stock') > 0;
                                    });
                                    $hasUnavailableVariants = $product->product_variants->where('size_id', $size->id)->contains(function ($variant) {
                                        return $variant->product_stocks->sum('stock') <= 0;
                                    });
                                @endphp
                                <button
                                    class="size-option border px-4 py-2 rounded {{ !$isAvailable ? 'opacity-50 cursor-not-allowed' : '' }} {{ $hasUnavailableVariants ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    data-id="{{ $size->id }}" {{ (!$isAvailable || $hasUnavailableVariants) ? 'disabled' : '' }}>
                                    {{ $size->size_number }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- WhatsApp Button -->
                <div class="mt-6">
                    <a id="whatsapp-button" href="#" target="_blank"
                        class="px-4 py-3 bg-black text-white font-medium rounded-lg shadow-md hover:bg-black transition duration-200 disabled:opacity-50 disabled:pointer-events-none">
                         <i class="bi bi-whatsapp"></i> {{ __('Chat on WhatsApp') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Specifications -->
    <div class="px-5 mt-8">
        <div class="bg-white py-4 p-5 mb-8 pb-8">
            <h2 class="text-2xl font-semibold text-gray-900">{{ __('Product specifications') }}</h2>
            <p class="text-gray-600 mt-2"><span class="font-semibold">{{ __('Isi dalam Per Pax') }}:</span>
                {{ $product->default_stock ?? 0 }}</p>
            <p class="text-gray-600 mt-2"><span class="font-semibold">{{ __('Category') }}:</span>
                {{ $product->categories->name ?? '-' }}</p>
            <p class="text-gray-600 mt-2"><span class="font-semibold">{{ __('Type') }}:</span>
                {{ $product->type ?? '-' }}</p>
            <p class="text-gray-600 mt-2"><span class="font-semibold">{{ __('Units') }}:</span>
                {{ $product->units->name ?? '-' }} ({{ $product->units->acronym ?? '-' }})</p>
            <h2 class="text-2xl font-semibold text-gray-900 mt-4">{{ __('Product Description') }}</h2>
            <p class="text-gray-600 mt-2">{{ $product->description ?? '-' }}</p>
        </div>
    </div>
    <!-- End: Product Specifications -->


    <!-- Related Products -->
    @if (isset($relatedProducts) && count($relatedProducts) > 0)
        <div class="container px-5 mt-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-900">{{ __('Related Products') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                @foreach ($relatedProducts as $product_related)
                    @component('components.guest.card-product', ['product' => $product_related])
                    @endcomponent
                @endforeach
            </div>
        </div>
        <div class="text-center my-4 md:my-7">
            <a href="{{ Route('product.all', ['category' => $relatedProducts[0]->categories->id]) }}"
                class="bg-black hover:bg-black text-white px-5 py-3 rounded-md">{{ __('See More Related Products') }}<i
                    class="fa-solid fa-circle-chevron-right ml-3"></i></a>
        </div>
    @endif
    <!-- End: Related Products -->

    <script>
        const materials = @json($materials);
        const colors = @json($colors);
        const sizes = @json($sizes);
        const variants = @json($productVariants);
        const productName = "{{ $product->name }}";
        const productCategory = "{{ $product->categories->name }}";
        const productType = "{{ $product->type }}";
        const whatsappNumber = @json($whatsapp);

        let selectedMaterial = null;
        let selectedColor = null;
        let selectedSize = null;
        let selectedVariant = null;

        const priceRange = {
            min: {{ $priceRange['min'] }},
            max: {{ $priceRange['max'] }}
        };

        function updatePriceRange() {
            const priceElement = document.getElementById('price');
            priceElement.textContent =
                `Rp ${new Intl.NumberFormat('id-ID').format(priceRange.min)} - Rp ${new Intl.NumberFormat('id-ID').format(priceRange.max)}`;
        }

        function updateImage(src) {
            document.getElementById('main-image').src = src;
        }

        function updateDetails() {
            if (selectedMaterial && selectedColor) {
                const variant = variants.find(v =>
                    v.material_id == selectedMaterial &&
                    v.color_id == selectedColor
                );

                if (variant) {
                    selectedVariant = variant;
                    document.getElementById('price').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(variant.price)}`;

                    const imageUrl = variant.product_variant_images && variant.product_variant_images.length > 0 ?
                        `{{ asset('storage/') }}/${variant.product_variant_images[0].image}` :
                        '{{ asset('storage/' . $product->cover) }}';
                    updateImage(imageUrl);

                    updateWhatsAppLink();
                }
            }
        }

        function updateWhatsAppLink() {
            const whatsappButton = document.getElementById('whatsapp-button');
            const phoneNumber = whatsappNumber;

            if (selectedVariant) {
                const materialName = selectedVariant.product_materials ? selectedVariant.product_materials.name : 'Unknown Material';
                const colorName = selectedVariant.product_colors ? selectedVariant.product_colors.name : 'Unknown Color';
                const sizeNumber = selectedVariant.product_sizes ? selectedVariant.product_sizes.size_number : 'Unknown Size';

                const message = `Halo, saya tertarik dengan produk ${productName}\nBahan: ${materialName}\nWarna: ${colorName}\nUkuran: ${sizeNumber}\nKategori: ${productCategory}\nTipe: ${productType}`;

                whatsappButton.href = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                whatsappButton.disabled = false;
            } else {
                whatsappButton.href = '#';
                whatsappButton.disabled = true;
            }
        }

        document.querySelectorAll('.material-option').forEach(button => {
            button.addEventListener('click', () => {
                selectedMaterial = button.dataset.id;
                document.querySelectorAll('.material-option').forEach(btn => btn.classList.remove('bg-black', 'text-white'));
                button.classList.add('bg-black', 'text-white');
                selectedColor = null;
                selectedSize = null;
                updateDetails();
            });
        });

        document.querySelectorAll('.color-option').forEach(button => {
            button.addEventListener('click', () => {
                if (!button.disabled) {
                    selectedColor = button.dataset.id;
                    document.querySelectorAll('.color-option').forEach(btn => btn.classList.remove('bg-black', 'text-white'));
                    button.classList.add('bg-black', 'text-white');
                    selectedSize = null;
                    updateDetails();
                }
            });
        });

        document.querySelectorAll('.size-option').forEach(button => {
            button.addEventListener('click', () => {
                if (!button.disabled) {
                    selectedSize = button.dataset.id;
                    document.querySelectorAll('.size-option').forEach(btn => btn.classList.remove('bg-black', 'text-white'));
                    button.classList.add('bg-black', 'text-white');
                    updateDetails();
                }
            });
        });

        updatePriceRange();
    </script>
</x-guest-layout>
