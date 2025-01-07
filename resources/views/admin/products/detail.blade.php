<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Detail Produk') }}</h1>
        </div>
        <!-- Informasi Produk -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Informasi Produk') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Kolom Kiri -->
                    <div class="space-y-2">
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Nama Produk:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white font-semibold">{{ $product->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Kategori:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $product->categories->name ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Unit:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $product->units->name ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Deskripsi:') }}</span>
                            <p class="text-gray-800 dark:text-gray-300">{{ $product->description }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Status:') }}</span>
                            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                                {{ $product->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->status ? __('Aktif') : __('Nonaktif') }}
                            </span>
                        </div>
                    </div>
                    <!-- Kolom Kanan -->
                    <div class="space-y-2">
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Harga Default:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white font-semibold">
                                Rp {{ number_format($product->default_price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Stok Default:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $product->default_stock }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Produk Unggulan:') }}</span>
                            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                                {{ $product->is_featured ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->is_featured ? __('Ya, produk ini diunggulkan') : __('Tidak, produk ini tidak diunggulkan') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Meta Title:') }}</span>
                            <p class="text-gray-800 dark:text-gray-300">{{ $product->meta_title }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Meta Keywords:') }}</span>
                            <p class="text-gray-800 dark:text-gray-300">{{ $product->meta_keywords }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Meta Description:') }}</span>
                            <p class="text-gray-800 dark:text-gray-300">{{ $product->meta_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Galeri Gambar -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker mt-6">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Galeri Gambar') }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                    @forelse ($product->product_images as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-32 object-cover rounded-lg shadow">
                            @if ($image->is_main)
                                <span class="absolute top-0 left-0 bg-green-600 text-white text-xs px-2 py-1 rounded-br-lg">
                                    {{ __('Utama') }}
                                </span>
                            @endif
                        </div>
                    @empty
                        <p>{{ __('Tidak ada gambar yang tersedia.') }}</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Variasi Produk -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker mt-6">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Variasi Produk') }}</h2>
                <div class="mt-4">
                    @if ($product->product_variants->isNotEmpty())
                        <table class="w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-800">
                                    <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ __('Bahan') }}</th>
                                    <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ __('Ukuran') }}</th>
                                    <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ __('Warna') }}</th>
                                    <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ __('Harga') }}</th>
                                    <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ __('Stok') }}</th>
                                    <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ __('Gambar') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->product_variants as $variant)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2">{{ $variant->product_materials->name ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $variant->product_sizes->size_number ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $variant->product_colors->name ?? '-' }}</td>
                                        <td class="px-4 py-2">Rp {{ number_format($variant->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2">{{ $variant->product_stocks->sum('stock') }}</td>
                                        <td class="px-4 py-2">
                                            @if ($variant->product_variant_images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $variant->product_variant_images->first()->image) }}" 
                                                     alt="{{ $variant->material->name ?? 'Gambar' }}" 
                                                     class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                {{ __('Tidak ada gambar') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{ __('Tidak ada variasi produk.') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('master.products.index') }}" class="btn btn-primary">{{ __('Kembali ke Daftar Produk') }}</a>
        </div>
    </div>
</x-app-layout>
