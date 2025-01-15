<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Edit Produk') }}</h1>
        </div>

        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Formulir Edit Produk') }}</h2>
                <form action="{{ route('master.products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6 mt-4">
                    @csrf
                    @method('PUT')

                    <!-- Informasi Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Informasi Produk') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="model_number"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nomor Model') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="model_number" id="model_number" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan nomor model') }}"
                                    value="{{ old('model_number', $product->model_number) }}">
                            </div>
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Produk') }}</label>
                                <input type="text" name="name" id="name" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan nama produk') }}"
                                    value="{{ old('name', $product->name) }}">
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="category_id"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kategori') }}</label>
                                <select name="category_id" id="category_id" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Pilih Kategori') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="default_price"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Harga Awal') }}</label>
                                <input type="number" name="default_price" id="default_price" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan harga default') }}"
                                    value="{{ old('default_price', $product->default_price) }}">
                                @error('default_price')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="default_stock"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Isi dalam Per Pax') }}</label>
                                <input type="number" name="default_stock" id="default_stock" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan stok default') }}"
                                    value="{{ old('default_stock', $product->default_stock) }}">
                                @error('default_stock')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="unit_id"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Satuan') }}</label>
                                <select name="unit_id" id="unit_id" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Pilih Satuan') }}</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}"
                                            {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->name }} - ({{ $unit->acronym }})</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}</label>
                                <select name="status" id="status" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1"
                                        {{ old('status', $product->status) == 1 ? 'selected' : '' }}>
                                        {{ __('Aktif') }}</option>
                                    <option value="0"
                                        {{ old('status', $product->status) == 0 ? 'selected' : '' }}>
                                        {{ __('Tidak Aktif') }}</option>
                                </select>
                                @error('status')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tambahan Kolom Baru -->
                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Deskripsi Produk') }}</label>
                                <textarea name="description" id="description" class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan deskripsi produk') }}">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="is_featured"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tampilkan sebagai Produk Unggulan') }}</label>
                                <select name="is_featured" id="is_featured"
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1"
                                        {{ old('is_featured', $product->is_featured) == 1 ? 'selected' : '' }}>
                                        {{ __('Ya') }}</option>
                                    <option value="0"
                                        {{ old('is_featured', $product->is_featured) == 0 ? 'selected' : '' }}>
                                        {{ __('Tidak') }}</option>
                                </select>
                                @error('is_featured')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="type"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tipe Produk') }}</label>
                                <select name="type" id="type"
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="unisex"
                                        {{ old('type', $product->type) == 'unisex' ? 'selected' : '' }}>
                                        {{ __('Unisex') }}</option>
                                    <option value="man"
                                        {{ old('type', $product->type) == 'pria' ? 'selected' : '' }}>
                                        {{ __('Pria') }}</option>
                                    <option value="woman"
                                        {{ old('type', $product->type) == 'wanita' ? 'selected' : '' }}>
                                        {{ __('Wanita') }}</option>
                                </select>
                                @error('type')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Meta Information -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Information') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="meta_title"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Title') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="meta_title" id="meta_title"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan meta title') }}"
                                    value="{{ old('meta_title', $product->meta_title) }}" maxlength="255">
                                @error('meta_title')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="meta_keywords"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Keywords') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="meta_keywords" id="meta_keywords"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan meta keywords') }}"
                                    value="{{ old('meta_keywords', $product->meta_keywords) }}" maxlength="255">
                                @error('meta_keywords')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="meta_description"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Description') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <textarea name="meta_description" id="meta_description" class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan meta description') }}" maxlength="255">{{ old('meta_description', $product->meta_description) }}</textarea>
                                @error('meta_description')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Foto Cover Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Foto Cover Produk') }}
                        </h3>
                        <div class="mt-4">
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">{{ __('Unggah Foto Cover') }}</legend>
                                <input type="file" name="cover" id="cover" accept="image/*"
                                    class="file-input">
                                <label class="fieldset-label">{{ __('Maksimal 5 mb') }}</label>
                            </fieldset>
                            <div id="cover_preview" class="mt-2">
                                @if ($product->cover)
                                    <img src="{{ asset('storage/' . $product->cover) }}"
                                        class="w-48 h-48 object-cover rounded-lg" />
                                @endif
                            </div>
                            @error('cover')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Galeri Gambar Produk -->
                    <div class="mt-4">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">
                            {{ __('Galeri Gambar Produk') }}</h3>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('Unggah Gambar Produk') }}</legend>
                            <input type="file" name="product_images[]" id="product_images" accept="image/*"
                                multiple class="file-input">
                            <label class="fieldset-label">{{ __('Maksimal 5 MB per gambar') }}</label>
                        </fieldset>

                        <!-- Preview Gambar -->
                        <div id="gallery_preview" class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2">
                            @if ($product->product_images && $product->product_images->isNotEmpty())
                                @foreach ($product->product_images as $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                            class="w-24 h-24 object-cover rounded-lg border shadow-sm" />
                                        <button type="button" class="absolute top-0 right-0 text-red-500"
                                            onclick="deleteProductImage({{ $image->id }})">&times;</button>
                                        <input type="hidden" name="removed_images[]" value="{{ $image->id }}"
                                            id="removed_image_{{ $image->id }}" />
                                    </div>
                                @endforeach
                            @else
                                <p>{{ __('Belum ada gambar produk yang diunggah.') }}</p>
                            @endif
                        </div>
                        @error('product_images.*')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Variasi Produk -->
                    <div class="p-4 border rounded-lg bg-gray-50 dark:bg-darker shadow-sm">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Variasi Produk') }}
                        </h3>
                        <div id="variations-container" class="space-y-6 mt-4">
                            @if (old('variations') || ($product->product_variants && $product->product_variants->count() > 0))
                                @foreach (old('variations', $product->product_variants) as $index => $variation)
                                    <div
                                        class="flex flex-wrap space-x-6 p-4 border rounded-lg bg-gray-50 dark:bg-darker shadow-sm">
                                        <!-- Bahan -->
                                        <div class="flex-1">
                                            <label for="variations[{{ $index }}][material]"
                                                class="block text-sm font-medium text-gray-800 dark:text-gray-300">Bahan</label>
                                            <select name="variations[{{ $index }}][material_id]" required
                                                class="select select-bordered w-full bg-white dark:bg-darker">
                                                <option value="">{{ __('Pilih Bahan') }}</option>
                                                @foreach ($materials as $material)
                                                    <option value="{{ $material->id }}"
                                                        {{ $material->id == $variation->material_id ? 'selected' : '' }}>
                                                        {{ $material->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Ukuran -->
                                        <div class="flex-1">
                                            <label for="variations[{{ $index }}][size]"
                                                class="block text-sm font-medium text-gray-800 dark:text-gray-300">Ukuran</label>
                                            <select name="variations[{{ $index }}][size_id]" required
                                                class="select select-bordered w-full bg-white dark:bg-darker">
                                                <option value="">{{ __('Pilih Ukuran') }}</option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}"
                                                        {{ $size->id == $variation->size_id ? 'selected' : '' }}>
                                                        {{ $size->size_number }} - {{ $size->size_chart }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Warna -->
                                        <div class="flex-1">
                                            <label for="variations[{{ $index }}][color]"
                                                class="block text-sm font-medium text-gray-800 dark:text-gray-300">Warna</label>
                                            <select name="variations[{{ $index }}][color_id]" required
                                                class="select select-bordered w-full bg-white dark:bg-darker">
                                                <option value="">{{ __('Pilih Warna') }}</option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}"
                                                        {{ $color->id == $variation->color_id ? 'selected' : '' }}>
                                                        {{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Harga -->
                                        <div class="flex-1">
                                            <label for="variations[{{ $index }}][price]"
                                                class="block text-sm font-medium text-gray-800 dark:text-gray-300">Harga</label>
                                            <input type="number" name="variations[{{ $index }}][price]"
                                                value="{{ $variation->price ?? '' }}" required
                                                class="input input-bordered w-full bg-white dark:bg-darker">
                                        </div>
                                        <!-- Stok -->
                                        <div class="flex-1">
                                            <label for="variations[{{ $index }}][stock]"
                                                class="block text-sm font-medium text-gray-800 dark:text-gray-300">Stok</label>
                                            <input type="number" name="variations[{{ $index }}][stock]"
                                                value="{{ $variation->product_stocks->count() > 0 ? $variation->product_stocks[0]->stock : '' }}"
                                                required class="input input-bordered w-full bg-white dark:bg-darker">
                                        </div>

                                        <!-- Gambar -->
                                        <div class="flex-1">
                                            <label for="variations[{{ $index }}][image]"
                                                class="block text-sm font-medium text-gray-800 dark:text-gray-300">Gambar</label>
                                            <input type="file" name="variations[{{ $index }}][image]"
                                                accept="image/*" class="file-input file-input-xs">
                                            <div id="variation-preview-{{ $index }}" class="mt-2">
                                                @if ($variation->product_variant_images->count() > 0)
                                                    @foreach ($variation->product_variant_images as $image)
                                                        <div class="relative">
                                                            <img src="{{ asset('storage/' . $image->image) }}"
                                                                class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                                            <button type="button"
                                                                class="absolute top-0 right-0 text-red-500"
                                                                onclick="removeImage({{ $image->id }}, {{ $index }})">&times;</button>
                                                            <input type="hidden"
                                                                name="variations[{{ $index }}][existing_images][]"
                                                                value="{{ $image->id }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Button Hapus -->
                                        <div class="flex-1">
                                            <input type="hidden" name="variations[{{ $index }}][delete]"
                                                value="0" class="delete-flag">
                                            <button type="button" class="btn btn-danger mt-4"
                                                onclick="deleteVariantProduct({{ $variation->id ?? '' }})">
                                                {{ __('Hapus') }}
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ __('Produk ini tidak memiliki variasi produk.') }}</p>
                            @endif
                        </div>
                        <!-- Tombol Tambah Variasi -->
                        <button type="button" id="add-variation"
                            class="btn btn-secondary mt-4">{{ __('Tambah Variasi') }}</button>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('master.products.index') }}"
                            class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Produk') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let variationCount = document.querySelectorAll("#variations-container > div").length;

            document.getElementById("add-variation").addEventListener("click", () => {
                const materials = @json($materials);
                const sizes = @json($sizes);
                const colors = @json($colors);

                const container = document.getElementById("variations-container");
                const newVariation = document.createElement("div");
                newVariation.classList.add("flex", "flex-wrap", "space-x-6", "p-4", "border", "rounded-lg",
                    "bg-gray-50", "dark:bg-darker", "shadow-sm");

                newVariation.innerHTML = `
                    <input type="hidden" name="variations[${variationCount}][id]" value="">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">Bahan</label>
                        <select name="variations[${variationCount}][material_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="">{{ __('Pilih Bahan') }}</option>
                            ${materials.map(material => `<option value="${material.id}">${material.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">Ukuran</label>
                        <select name="variations[${variationCount}][size_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="">{{ __('Pilih Ukuran') }}</option>
                            ${sizes.map(size => `<option value="${size.id}">${size.size_number} - ${size.size_chart}</option>`).join('')}
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">Warna</label>
                        <select name="variations[${variationCount}][color_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="">{{ __('Pilih Warna') }}</option>
                            ${colors.map(color => `<option value="${color.id}">${color.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">Harga</label>
                        <input type="number" name="variations[${variationCount}][price]" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">Stok</label>
                        <input type="number" name="variations[${variationCount}][stock]" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">Gambar</label>
                        <input type="file" name="variations[${variationCount}][image]" accept="image/*" class="file-input file-input-xs">
                        <div id="variation-preview-${variationCount}" class="mt-2"></div>
                    </div>
                    <button type="button" class="remove-variation text-red-500 mt-2">Hapus Variasi</button>
                `;

                container.appendChild(newVariation);

                const fileInput = newVariation.querySelector(".file-input");
                fileInput.addEventListener("change", (event) => {
                    const previewContainer = document.getElementById(
                        `variation-preview-${variationCount}`);
                    previewContainer.innerHTML = ""; // Hapus preview sebelumnya
                    const files = event.target.files;
                    if (files.length > 0) {
                        Array.from(files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                const img = document.createElement("img");
                                img.src = e.target.result;
                                img.alt = "Preview Image";
                                img.classList.add("w-full", "h-32", "object-cover",
                                    "rounded-md");
                                previewContainer.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                });

                newVariation.querySelector(".remove-variation").addEventListener("click", () => {
                    newVariation.remove();
                });

                variationCount++;
            });


            // Validasi untuk gambar cover
            document.getElementById('cover').addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file.size > 5 * 1024 * 1024) { // 5 MB
                    alert('Ukuran file terlalu besar. Maksimal 5 MB.');
                    e.target.value = ''; // Clear input
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('cover_preview');
                    preview.innerHTML = `
                    <div class="relative">
                        <img src="${event.target.result}" class="w-48 h-48 object-cover rounded-lg"/>
                        <button type="button" onclick="removeCoverImage()" class="btn btn-circle btn-sm btn-error absolute top-0 right-0">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    </div>
                `;
                };
                reader.readAsDataURL(file);
            });

            // Fungsi untuk menghapus gambar cover
            window.removeCoverImage = function() {
                document.getElementById('cover').value = ''; // Clear the file input
                document.getElementById('cover_preview').innerHTML = ''; // Clear the preview
            };

            // Preview gambar galeri
            document.getElementById('product_images').addEventListener('change', (e) => {
                const galleryPreview = document.getElementById('gallery_preview');
                galleryPreview.innerHTML = ''; // Clear existing preview
                Array.from(e.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        galleryPreview.innerHTML += `
                        <div class="relative">
                            <img src="${event.target.result}" class="w-24 h-24 object-cover rounded-lg border shadow-sm"/>
                            <button type="button" onclick="removeGalleryImage(this)" class="btn btn-circle btn-sm btn-error absolute top-0 right-0">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    `;
                    };
                    reader.readAsDataURL(file);
                });

                // Memperbarui label jumlah file yang dipilih
                const fileLabel = document.getElementById('file-label');
                fileLabel.textContent = `${e.target.files.length} file dipilih`;
            });

            // Fungsi untuk menghapus gambar galeri dan file terkait dari input
            window.removeGalleryImage = function(button) {
                const input = document.getElementById('product_images');
                const galleryPreview = document.getElementById('gallery_preview');

                // Menghapus gambar dari preview
                button.parentElement.remove();

                // Menyaring ulang file yang ada di input berdasarkan preview
                const filesArray = Array.from(input.files);
                const indexToRemove = Array.from(button.parentElement.querySelectorAll('img')).indexOf(button
                    .parentElement.querySelector('img'));

                // Menghapus file yang telah dihapus di preview
                const newFiles = filesArray.filter((file, index) => index !== indexToRemove);

                // Membuat DataTransfer baru untuk memperbarui input file
                const dataTransfer = new DataTransfer();
                newFiles.forEach(file => dataTransfer.items.add(file));

                // Memperbarui input file dengan file yang tersisa
                input.files = dataTransfer.files;

                // Memperbarui label jika jumlah file berubah
                const fileLabel = document.getElementById('file-label');
                if (input.files.length === 0) {
                    // Tidak ada file yang dipilih
                    fileLabel.textContent = 'Pilih file';
                } else {
                    // Memperbarui teks label dengan jumlah file yang tersisa
                    fileLabel.textContent = `${input.files.length} file dipilih`;
                }
            };
        });

        function deleteVariantProduct(variantId) {
            console.log("ID yang diterima:", variantId);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Varian ini akan dihapus dari produk.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/master/products/variations/${variantId}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: xhr.responseJSON.message ||
                                    'Terjadi kesalahan, coba lagi nanti.',
                                icon: 'error',
                                confirmButtonColor: '#d33',
                            });
                        }
                    });
                }
            });
        }

        function removeImage(imageId, variationIndex) {
            // Menghapus gambar dari tampilan
            const imageElement = document.querySelector(`#variation-preview-${variationIndex} img[src*="${imageId}"]`);
            if (imageElement) {
                imageElement.parentElement.remove(); // Menghapus elemen gambar
            }

            // Menandai gambar sebagai dihapus
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `variations[${variationIndex}][deleted_images][]`; // Menandai gambar yang dihapus
            hiddenInput.value = imageId; // ID gambar yang dihapus
            document.querySelector(`#variations-container`).appendChild(hiddenInput);
        }

        function deleteProductImage(imageId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Gambar ini akan dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/master/products/images/${imageId}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: xhr.responseJSON.message ||
                                    'Terjadi kesalahan, coba lagi nanti.',
                                icon: 'error',
                                confirmButtonColor: '#d33',
                            });
                        }
                    });
                }
            });
        }
    </script>

</x-app-layout>
