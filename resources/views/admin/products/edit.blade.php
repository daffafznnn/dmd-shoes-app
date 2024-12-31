<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb Section -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Title Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Edit Produk') }}</h1>
        </div>

        <!-- Form Section -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Form Edit Produk') }}</h2>
                <form action="{{ route('master.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
                    @csrf
                    @method('PUT')

                    <!-- Nama Produk -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Produk') }}</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kategori') }}</label>
                        <select name="category_id" id="category_id" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="">{{ __('Pilih Kategori') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nomor Model -->
                    <div>
                        <label for="model_number" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nomor Model') }}</label>
                        <input type="text" name="model_number" id="model_number" value="{{ $product->model_number }}" class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Deskripsi') }}</label>
                        <textarea name="description" id="description" rows="4" class="textarea textarea-bordered w-full bg-white dark:bg-darker">{{ $product->description }}</textarea>
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label for="cover" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Gambar Produk') }}</label>
                        <input type="file" name="cover" id="cover" class="file-input file-input-bordered w-full bg-white dark:bg-darker">
                        @if($product->cover)
                            <img src="{{ asset('storage/' . $product->cover) }}" alt="{{ $product->name }}" class="w-24 h-24 mt-2">
                        @endif
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="default_price" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Harga') }}</label>
                        <input type="number" name="default_price" id="default_price" value="{{ $product->default_price }}" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="default_stock" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Stok') }}</label>
                        <input type="number" name="default_stock" id="default_stock" value="{{ $product->default_stock }}" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}</label>
                        <select name="status" id="status" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>{{ __('Aktif') }}</option>
                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>{{ __('Tidak Aktif') }}</option>
                        </select>
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label for="unit_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Satuan') }}</label>
                        <select name="unit_id" id="unit_id" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="">{{ __('Pilih Satuan') }}</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('master.products.index') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
