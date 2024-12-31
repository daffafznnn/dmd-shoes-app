/*************  ✨ Codeium Command 🌟  *************/
<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb Section -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Title Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Tambah Produk Baru') }}</h1>
        </div>

        <!-- Form Section -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Formulir Tambah Produk') }}</h2>
                <form action="{{ route('master.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
                    @csrf

                    <!-- Informasi Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Informasi Produk') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Produk') }}</label>
                                <input type="text" name="name" id="name" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan nama produk') }}">
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kategori') }}</label>
                                <select name="category_id" id="category_id" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Pilih Kategori') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="default_price" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Harga Default') }}</label>
                                <input type="number" name="default_price" id="default_price" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan harga default') }}">
                            </div>
                            <div>
                                <label for="default_stock" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Stok Default') }}</label>
                                <input type="number" name="default_stock" id="default_stock" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan stok default') }}">
                            </div>
                            <div>
                                <label for="unit_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Satuan') }}</label>
                                <select name="unit_id" id="unit_id" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Pilih Satuan') }}</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}</label>
                                <select name="status" id="status" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1">{{ __('Aktif') }}</option>
                                    <option value="0">{{ __('Tidak Aktif') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Cover Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Foto Cover Produk') }}</h3>
                        <div class="mt-4">
                            <label for="cover_image" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Unggah Foto Cover') }}</label>
                            <input type="file" name="cover_image" id="cover_image" accept="image/*" required class="file-input file-input-bordered w-full bg-white dark:bg-darker">
                        </div>
                    </div>

                    <!-- Galeri Gambar Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Galeri Gambar Produk') }}</h3>
                        <div class="mt-4">
                            <label for="product_images" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Unggah Gambar Produk') }}</label>
                            <input type="file" name="product_images[]" id="product_images" accept="image/*" multiple class="file-input file-input-bordered w-full bg-white dark:bg-darker">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ __('Anda dapat mengunggah beberapa gambar sekaligus.') }}</p>
                        </div>
                    </div>

                    <!-- Deskripsi Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Deskripsi Produk') }}</h3>
                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Deskripsi') }}</label>
                            <textarea name="description" id="description" rows="5" class="textarea textarea-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan deskripsi produk') }}"></textarea>
                        </div>
                    </div>

                    <!-- Variasi Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Variasi Produk') }}</h3>
                        <div class="mt-4">
                            <label for="materials" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Bahan') }}</label>
                            <select name="materials[]" id="materials" multiple class="select select-bordered w-full bg-white dark:bg-darker">
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <label for="materials" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Bahan') }}</label>
                                <select name="materials[]" id="materials" multiple class="select select-bordered w-full bg-white dark:bg-darker">
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="sizes" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Ukuran') }}</label>
                                <select name="sizes[]" id="sizes" multiple class="select select-bordered w-full bg-white dark:bg-darker">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size_number }} - {{ $size->size_chart }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="colors" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Warna') }}</label>
                                <select name="colors[]" id="colors" multiple class="select select-bordered w-full bg-white dark:bg-darker">
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="sizes" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Ukuran') }}</label>
                            <select name="sizes[]" id="sizes" multiple class="select select-bordered w-full bg-white dark:bg-darker">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_number }} - {{ $size->size_chart }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="colors" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Warna') }}</label>
                            <select name="colors[]" id="colors" multiple class="select select-bordered w-full bg-white dark:bg-darker">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="variations-container" class="mt-6 space-y-4"></div>
                        <button type="button" id="generate-variations" class="btn btn-secondary">{{ __('Buat Variasi') }}</button>
                        <div id="variations-container" class="mt-6 space-y-4"></div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('master.products.index') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Produk') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('generate-variations').addEventListener('click', function () {
            const materials = Array.from(document.getElementById('materials').selectedOptions).map(option => option.text);
            const sizes = Array.from(document.getElementById('sizes').selectedOptions).map(option => option.text);
            const colors = Array.from(document.getElementById('colors').selectedOptions).map(option => option.text);

            const container = document.getElementById('variations-container');
            container.innerHTML = '';

            materials.forEach(material => {
                sizes.forEach(size => {
                    colors.forEach(color => {
                        const variationRow = document.createElement('div');
                        variationRow.classList.add('grid', 'grid-cols-1', 'md:grid-cols-3', 'gap-4');

                        variationRow.innerHTML = `
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Variasi') }}</label>
                                <input type="text" value="${material} - ${size} - ${color}" readonly class="input input-bordered w-full bg-white dark:bg-darker">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Harga') }}</label>
                                <input type="number" name="variation_prices[]" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan harga') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Stok') }}</label>
                                <input type="number" name="variation_stocks[]" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan stok') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Foto') }}</label>
                                <input type="file" name ="variation_images[]" accept="image/*" class="file-input file-input-bordered w-full bg-white dark:bg-darker">
                            </div>
                        `;

                        container.appendChild(variationRow);
                    });
                });
            });
        });
    </script>
</x-app-layout>

/******  1357a0b2-ae05-4a10-b96f-4d1eea220add  *******/