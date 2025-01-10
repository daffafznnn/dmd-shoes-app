<div class="group my-10 flex w-full max-w-xs flex-col overflow-hidden border border-gray-100 bg-white shadow-md rounded-lg">
  <div class="relative flex h-60 overflow-hidden">
    <img class="peer absolute top-0 right-0 h-full w-full object-cover" src="{{ $product->cover ? asset('storage/' . $product->cover) : asset('assets/images/no-image.png') }}" alt="product image" />
    @foreach ($product->product_images as $index => $image)
        <img 
        class="peer md:absolute md:top-0 md:-right-96 md:h-full md:w-full md:object-cover md:transition-all md:delay-100 md:duration-1000 md:hover:right-0 md:peer-hover:right-0" 
        src="{{ asset('storage/' . $image->image_path) }}"
         style="transition-delay: {{ $index * 1000 }}ms;" 
        alt="product image" />
    @endforeach
    <div class="absolute right-0 bottom-0 mr-2 mb-4 space-y-2 md:absolute md:-right-16 md:bottom-0 md:mr-2 md:mb-4 md:transition-all md:duration-300 md:xl:group-hover:right-0">
      <button class="flex h-10 w-10 items-center justify-center bg-green-500 text-white transition hover:bg-green-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>
  </div>
  <div class="mt-4 px-5 pb-5">
      <h5 class="text-xl tracking-tight text-slate-900">{{ $product->name }}</h5>
      <p class="text-sm text-slate-500">{{ $product->type }}</p>
    <div class="mt-2 mb-5 flex items-center justify-between">
      <p>
         <span class="text-xl font-semibold text-green-500">Rp
        {{ number_format($product->default_price, 0, ',', '.') }}</span>
      </p>
    </div>
    <a href="https://wa.me/?text={{ urlencode(__('Check out this product: :name at Rp :price', ['name' => $product->name, 'price' => number_format($product->default_price, 0, ',', '.')])) }}" class="flex items-center justify-center bg-green-500 px-2 py-1 text-sm text-white transition hover:bg-green-700">
        <i class="bi bi-whatsapp mr-2"></i>
        {{ __('Order') }}
    </a>
    <a class="mt-4 flex w-full items-center justify-center rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" href="{{ route('product.detail', $product->getRouteKey()) }}">
      {{ __('View Detail') }}
    </a>
  </div>
</div>
