<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Tambah Produk Baru') }}</h1>
        </div>

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
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kategori') }}</label>
                                <select name="category_id" id="category_id" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Pilih Kategori') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="default_price" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Harga Awal') }}</label>
                                <input type="number" name="default_price" id="default_price" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan harga default') }}">
                                @error('default_price') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="default_stock" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Stok Awal') }}</label>
                                <input type="number" name="default_stock" id="default_stock" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan stok default') }}">
                                @error('default_stock') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="unit_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Satuan') }}</label>
                                <select name="unit_id" id="unit_id" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Pilih Satuan') }}</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }} - ({{ $unit->acronym }})</option>
                                    @endforeach
                                </select>
                                @error('unit_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}</label>
                                <select name="status" id="status" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1">{{ __('Aktif') }}</option>
                                    <option value="0">{{ __('Tidak Aktif') }}</option>
                                </select>
                                @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            
                            <!-- Tambahan Kolom Baru -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Deskripsi Produk') }}</label>
                                <textarea name="description" id="description" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan deskripsi produk') }}"></textarea>
                                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="is_featured" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tampilkan sebagai Produk Unggulan') }}</label>
                                <select name="is_featured" id="is_featured" class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1">{{ __('Ya') }}</option>
                                    <option value="0">{{ __('Tidak') }}</option>
                                </select>
                                @error('is_featured') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                           <div>
                            <label for="type" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tipe Produk') }}</label>
                            <select name="type" id="type" class="select select-bordered w-full bg-white dark:bg-darker">
                                <option value="unisex">{{ __('Unisex') }}</option>
                                <option value="pria">{{ __('Pria') }}</option>
                                <option value="wanita">{{ __('Wanita') }}</option>
                            </select>
                            @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        </div>
                    </div>

                    <!-- Foto Cover Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Foto Cover Produk') }}</h3>
                        <div class="mt-4">
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">{{ __('Unggah Foto Cover') }}</legend>
                                <input type="file" name="cover_image" id="cover_image" accept="image/*" required class="file-input">
                                <label class="fieldset-label">{{ __('Maksimal 5 mb') }}</label>
                            </fieldset>
                            <div id="cover_preview" class="mt-2"></div>
                            @error('cover_image') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Galeri Gambar Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Galeri Gambar Produk') }}</h3>
                        <div class="mt-4">
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">{{ __('Unggah Gambar Produk') }}</legend>
                                <input type="file" name="product_images[]" id="product_images" accept="image/*" multiple class="file-input">
                                <label class="fieldset-label">{{ __('Maksimal 5 mb per gambar') }}</label>
                            </fieldset>
                            <div id="gallery_preview" class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2"></div>
                            @error('product_images.*') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Variasi Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Variasi Produk') }}</h3>
                        <div id="variations-container" class="space-y-6 mt-4"></div>
                        <button type="button" id="add-variation" class="btn btn-secondary mt-4">{{ __('Tambah Variasi') }}</button>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('master.products.index') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Produk') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        let variationCount = 0;

        // Menambahkan variasi baru
        document.getElementById("add-variation").addEventListener("click", () => {
            const materials = @json($materials);
            const sizes = @json($sizes);
            const colors = @json($colors);

            const container = document.getElementById("variations-container");
            const newVariation = document.createElement("div");
            newVariation.classList.add("flex", "flex-wrap", "space-x-6", "p-4", "border", "rounded-lg", "bg-gray-50", "dark:bg-darker", "shadow-sm");

            newVariation.innerHTML = `
                <div class="flex-1">
                    <label for="variations[${variationCount}][material]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Bahan</label>
                    <select name="variations[${variationCount}][material_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                        <option value="">{{ __('Pilih Bahan') }}</option>
                        ${materials.map(material => `<option value="${material.id}">${material.name}</option>`).join('')}
                    </select>
                </div>
                <div class="flex-1">
                    <label for="variations[${variationCount}][size]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Ukuran</label>
                    <select name="variations[${variationCount}][size_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                        <option value="">{{ __('Pilih Ukuran') }}</option>
                        ${sizes.map(size => `<option value="${size.id}">${size.size_number} - ${size.size_chart}</option>`).join('')}
                    </select>
                </div>
                <div class="flex-1">
                    <label for="variations[${variationCount}][color]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Warna</label>
                    <select name="variations[${variationCount}][color_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                        <option value="">{{ __('Pilih Warna') }}</option>
                        ${colors.map(color => `<option value="${color.id}">${color.name}</option>`).join('')}
                    </select>
                </div>
                <div class="flex-1">
                    <label for="variations[${variationCount}][price]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Harga</label>
                    <input type="number" name="variations[${variationCount}][price]" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="Masukkan harga">
                </div>
                <div class="flex-1">
                    <label for="variations[${variationCount}][stock]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Stok</label>
                    <input type="number" name="variations[${variationCount}][stock]" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="Masukkan stok">
                </div>
                <div class="flex-1">
                    <label for="variations[${variationCount}][images]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Gambar Variasi</label>
                    <input type="file" name="variations[${variationCount}][images][]" multiple accept="image/*" class="file-input file-input-bordered w-full bg-white dark:bg-darker">
                    <div id="variation_${variationCount}_image_preview" class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2"></div>
                </div>
                <div class="flex justify-end mt-2 w-full">
                    <button type="button" class="btn btn-error btn-sm remove-variation">Hapus Variasi</button>
                </div>
            `;

            container.appendChild(newVariation);
            variationCount++;

            // Hapus variasi
            newVariation.querySelector(".remove-variation").addEventListener("click", () => {
                // Update default stock when a variation is removed
                const stockValue = parseInt(stockInput.value);
                if (!isNaN(stockValue)) {
                    defaultStock -= stockValue; // Subtract the stock when variation is removed
                }
                document.querySelector("[name='default_stock']").value = defaultStock;

                newVariation.remove();
            });

            // Preview gambar variasi
            newVariation.querySelector("input[type='file']").addEventListener("change", (e) => {
                const previewContainer = newVariation.querySelector(`#variation_${variationCount - 1}_image_preview`);
                previewContainer.innerHTML = ''; // Clear any previous previews
                const files = e.target.files;
                for (let file of files) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const img = document.createElement("img");
                        img.src = event.target.result;
                        img.classList.add("w-24", "h-24", "object-cover", "rounded-lg");
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>

</x-app-layout>


