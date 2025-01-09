<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb Section -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Title Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Daftar Produk') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <!-- Form Filter Section -->
        <div class="mb-6">
            <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-gray-800 dark:text-white">{{ __('Filter Produk') }}</h2>
                    <form action="{{ route('master.products.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="col-span-2 lg:col-span-3">
                                <label for="search" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Cari') }}</label>
                                <input type="text" name="search" id="search" class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Cari nama produk') }}"
                                    value="{{ request()->query('search') }}">
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kategori') }}</label>
                                <select name="category" id="category" class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Semua') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->query('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}</label>
                                <select name="status" id="status" class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Semua') }}</option>
                                    <option value="1" {{ request()->query('status') == '1' ? 'selected' : '' }}>{{ __('Aktif') }}</option>
                                    <option value="0" {{ request()->query('status') == '0' ? 'selected' : '' }}>{{ __('Tidak Aktif') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                            <a href="{{ route('master.products.index') }}" class="btn btn-secondary ml-2">{{ __('Reset') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-hidden w-full rounded-lg shadow-lg bg-white border border-gray-300 dark:border-primary-darker dark:bg-darker">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300">
                            <th>{{ __('Nama Produk') }}</th>
                            <th>{{ __('Kategori') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="text-gray-800 dark:text-gray-300">{{ $product->name }}</td>
                                <td class="text-gray-800 dark:text-gray-300">{{ $product->categories->name }}</td>
                                <td>
                                    <span class="badge {{ $product->status == 1 ? 'badge-success' : 'badge-error' }}">
                                        {{ $product->status == 1 ? __('Aktif') : __('Tidak Aktif') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('master.products.edit', $product->getRouteKey()) }}" class="btn btn-primary btn-xs">{{ __('Edit') }}</a>
                                        <a href="{{ route('master.products.show', $product->getRouteKey()) }}" class="btn btn-accent btn-xs">{{ __('Detail') }}</a>
                                        <button onclick="deleteProduct('{{ route('master.products.destroy', ['id' => $product->id]) }}')"
                                                class="btn btn-secondary btn-xs">
                                                {{ __('Delete') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-800 dark:text-gray-300">{{ __('Tidak ada produk ditemukan.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Section -->
        <div class="mt-6 text-gray-800 dark:text-gray-300">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        function deleteProduct(url) {
            // Menggunakan SweetAlert untuk konfirmasi penghapusan
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Produk ini akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, lakukan penghapusan dengan submit form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    // Tambahkan csrf token dan method DELETE
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);

                    // Kirim form untuk menghapus data
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

</x-app-layout>
