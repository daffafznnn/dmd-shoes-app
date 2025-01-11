@php
    use App\Models\Setting;

    $setting = Setting::first();
@endphp
<div
    class="group my-10 flex w-full max-w-xs flex-col overflow-hidden border border-gray-100 bg-white shadow-md rounded-lg">
    <div class="relative flex h-60 overflow-hidden">
        <img class="peer absolute top-0 right-0 h-full w-full object-cover"
            src="{{ $product->cover ? asset('storage/' . $product->cover) : asset('assets/images/no-image.png') }}"
            alt="product image" />
        @foreach ($product->product_images as $index => $image)
            <img class="peer md:absolute md:top-0 md:-right-96 md:h-full md:w-full md:object-cover md:transition-all md:delay-100 md:duration-1000 md:hover:right-0 md:peer-hover:right-0"
                src="{{ asset('storage/' . $image->image_path) }}" style="transition-delay: {{ $index * 1000 }}ms;"
                alt="product image" />
        @endforeach
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
        <a href="https://wa.me/{{ substr($setting->phone, 1) }}?text={{ urlencode(__('Checkout this product') . __(': :name at Rp :price', ['name' => $product->name, 'price' => number_format($product->default_price, 0, ',', '.')])) }}"
            target="_blank"
            class="flex items-center justify-center bg-green-500 px-2 py-1 text-sm text-white transition hover:bg-green-700">
            <i class="bi bi-whatsapp mr-2"></i>
            {{ __('Order') }}
        </a>
        <a class="mt-4 flex w-full items-center justify-center rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
            href="{{ route('product.detail', $product->getRouteKey()) }}">
            {{ __('View Detail') }}
        </a>
    </div>
</div>
