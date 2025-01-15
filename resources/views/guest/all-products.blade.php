@section('title', 'Products')
<x-guest-layout>
    <!-- Start: Filter -->
    <section class="container mx-auto px-4 py-8">
        <x-guest.filter />
    </section>
    <!-- End: Filter -->
    <!-- Start: Featured Products -->
    <section class="container mx-auto px-4 py-8 bg-white shadow-md mb-8">
        <div class="w-full flex justify-between items-center px-4 border-b">
            <h2 class="text-3xl font-semibold mb-4">{{ __('All Products') }}</h2>
            <div class="form-control">
                <label class="label cursor-pointer gap-2">
                    <span class="label-text text-black dark:text-white">{{ __('Featured Products') }}</span>
                    <input type="checkbox" name="is_featured" id="is_featured" class="checkbox checkbox-black dark:checkbox-white" />
                </label>
            </div>
        </div>
        @if (request()->has('search'))
            <div class="py-3">
                <h2 class="text-xl font-semibold tracking-wider">Hasil pencarian untuk '{{ request()->get('search') }}'
                </h2>
            </div>
        @endif
        @if ($all_products->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($all_products as $product)
                    @component('components.guest.card-product', ['product' => $product])
                    @endcomponent
                @empty
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @for ($i = 0; $i < 12; $i++)
                            {{-- Menampilkan 12 skeleton loader --}}
                            <div class="flex flex-col gap-4">
                                <div class="h-40 w-40 rounded-md bg-gray-200 animate-pulse"></div> {{-- Skeleton untuk gambar --}}
                                <span class="loading loading-dots loading-lg"></span> {{-- Handle loading for image --}}
                                <div class="h-8 w-40 rounded-md bg-gray-200 animate-pulse"></div> {{-- Skeleton untuk nama produk --}}
                                <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div> {{-- Skeleton untuk harga --}}
                                <div class="h-5 w-1/2 rounded-md bg-gray-200 animate-pulse"></div> {{-- Skeleton untuk tombol --}}
                            </div>
                        @endfor
                    </div>
                @endforelse
            </div>
            @if ($all_products->total() > $all_products->perPage())
                <div>
                    @if ($all_products->hasPages())
                        <div class="flex justify-center items-center space-x-2 py-2">
                            {{-- Previous Page Link --}}
                            @if ($all_products->onFirstPage())
                                <span class="text-gray-500 cursor-not-allowed"><i
                                        class="fa-solid fa-circle-chevron-left"></i></span>
                            @else
                                <a id="paginationLink" href="{{ $all_products->previousPageUrl() }}"
                                    class="text-black hover:text-gray-700"><i
                                        class="fa-solid fa-circle-chevron-left"></i></a>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                $startPage = max($all_products->currentPage() - 2, 1); // Halaman mulai
                                $endPage = min($all_products->currentPage() + 2, $all_products->lastPage()); // Halaman akhir
                            @endphp

                            @for ($i = $startPage; $i <= $endPage; $i++)
                                @if ($i == $all_products->currentPage())
                                    <span class="bg-black text-white px-3 py-1">{{ $i }}</span>
                                @else
                                    <a id="paginationLink" href="{{ $all_products->url($i) }}"
                                        class="text-black hover:text-white hover:bg-black px-3 py-1 rounded-md">{{ $i }}</a>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($all_products->hasMorePages())
                                <a id="paginationLink" href="{{ $all_products->nextPageUrl() }}"
                                    class="text-black hover:text-gray-700"><i
                                        class="fa-solid fa-circle-chevron-right"></i></a>
                            @else
                                <span class="text-gray-500 cursor-not-allowed"><i
                                        class="fa-solid fa-circle-chevron-right"></i></span>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        @else
            <div class="text-center">
                <h2 class="text-xl font-semibold tracking-wider mt-4">{{ __('No products found') }}</h2>
            </div>
        @endif
    </section>
    <!-- End: Featured Products -->

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkbox = document.getElementById('is_featured');
                const url = new URL(window.location.href);
                const is_featuredParam = url.searchParams.get('is_featured');

                if (is_featuredParam) {
                    checkbox.checked = true;
                } else {
                    checkbox.checked = false;
                }

                checkbox.addEventListener('change', function() {
                    const isChecked = checkbox.checked;
                    const url = new URL(window.location.href);

                    if (isChecked) {
                        url.searchParams.set('is_featured', 1);
                        url.searchParams.set('page', 1); // Mengatur paginasi saat feature product checked
                    } else {
                        url.searchParams.delete('is_featured');
                    }

                    window.location.href = url;
                });

                // Tambahkan event listener untuk menangani pagination
                const paginationLinks = document.querySelectorAll('#paginationLink');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        const pageUrl = new URL(link.href);

                        // Menambahkan parameter 'page' ke URL yang sudah ada
                        const currentParams = new URLSearchParams(window.location.search);
                        const page = pageUrl.searchParams.get('page');
                        currentParams.set('page', page);

                        // Jika parameter lain ada di URL, kita akan mempertahankan parameter tersebut
                        window.location.search = currentParams.toString();
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>

