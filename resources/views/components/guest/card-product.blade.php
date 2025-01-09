@forelse ($products as $product)
<div class="group my-10 flex w-full max-w-xs flex-col overflow-hidden border border-gray-100 bg-white shadow-md rounded-lg">
  <a class="relative flex h-60 overflow-hidden" href="#">
    <img class="peer absolute top-0 right-0 h-full w-full object-cover" src="{{ $product->cover ? asset('storage/' . $product->cover) : asset('assets/images/no-image.png') }}" alt="product image" />
    @foreach ($product->product_images as $index => $image)
        <img 
        class="peer absolute top-0 -right-96 h-full w-full object-cover transition-all delay-100 duration-1000 hover:right-0 peer-hover:right-0" 
        src="{{ asset('storage/' . $image->image_path) }}"
         style="transition-delay: {{ $index * 1000 }}ms;" 
        alt="product image" />
    @endforeach
    <div class="absolute -right-16 bottom-0 mr-2 mb-4 space-y-2 transition-all duration-300 group-hover:right-0">
      <button class="flex h-10 w-10 items-center justify-center bg-green-500 text-white transition hover:bg-green-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>
  </a>
  <div class="mt-4 px-5 pb-5">
    <a href="#">
      <h5 class="text-xl tracking-tight text-slate-900">{{ $product->name }}</h5>
      <p class="text-sm text-slate-500">{{ $product->type }}</p>
    </a>
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
  </div>
</div>
@empty
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  @for ($i = 0; $i < 12; $i++) {{-- Menampilkan 12 skeleton loader --}}
  <div class="flex flex-col gap-4">
    <div class="h-40 w-40 rounded-md bg-gray-200 animate-pulse"></div> {{-- Skeleton untuk gambar --}}
    <div class="h-8 w-40 rounded-md bg-gray-200 animate-pulse"></div> {{-- Skeleton untuk nama produk --}}
    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div> {{-- Skeleton untuk harga --}}
    <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div> {{-- Skeleton untuk tombol --}}
  </div>
  @endfor
</div>
@endforelse

