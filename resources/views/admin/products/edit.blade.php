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
                <form action="{{ route('master.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
                    @csrf
                    @method('PUT')

                    <!-- Informasi Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Informasi Produk') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="model_number" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nomor Model') }}<span class="text-red-500">*</span></label>
                                <input type="text" name="model_number" id="model_number" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan nomor model') }}" value="{{ old('model_number', $product->model_number) }}">
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Produk') }}</label>
                                <input type="text" name="name" id="name" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan nama produk') }}" value="{{ old('name', $product->name) }}">
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kategori') }}</label>
                                <select name="category_id" id="category_id" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Pilih Kategori') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="default_price" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Harga Awal') }}</label>
                                <input type="number" name="default_price" id="default_price" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan harga default') }}" value="{{ old('default_price', $product->default_price) }}">
                                @error('default_price') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="default_stock" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Stok Awal') }}</label>
                                <input type="number" name="default_stock" id="default_stock" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan stok default') }}" value="{{ old('default_stock', $product->default_stock) }}">
                                @error('default_stock') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="unit_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Satuan') }}</label>
                                <select name="unit_id" id="unit_id" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Pilih Satuan') }}</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->name }} - ({{ $unit->acronym }})</option>
                                    @endforeach
                                </select>
                                @error('unit_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}</label>
                                <select name="status" id="status" required class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>{{ __('Aktif') }}</option>
                                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>{{ __('Tidak Aktif') }}</option>
                                </select>
                                @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tambahan Kolom Baru -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Deskripsi Produk') }}</label>
                                <textarea name="description" id="description" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan deskripsi produk') }}">{{ old('description', $product->description) }}</textarea>
                                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="is_featured" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tampilkan sebagai Produk Unggulan') }}</label>
                                <select name="is_featured" id="is_featured" class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1" {{ old('is_featured', $product->is_featured) == 1 ? 'selected' : '' }}>{{ __('Ya') }}</option>
                                    <option value="0" {{ old('is_featured', $product->is_featured) == 0 ? 'selected' : '' }}>{{ __('Tidak') }}</option>
                                </select>
                                @error('is_featured') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tipe Produk') }}</label>
                                <select name="type" id="type" class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="unisex" {{ old('type', $product->type) == 'unisex' ? 'selected' : '' }}>{{ __('Unisex') }}</option>
                                    <option value="pria" {{ old('type', $product->type) == 'pria' ? 'selected' : '' }}>{{ __('Pria') }}</option>
                                    <option value="wanita" {{ old('type', $product->type) == 'wanita' ? 'selected' : '' }}>{{ __('Wanita') }}</option>
                                </select>
                                @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Meta Information -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Information') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Title') }}<span class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="meta_title" id="meta_title" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan meta title') }}" value="{{ old('meta_title', $product->meta_title) }}" maxlength="255">
                                @error('meta_title') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="meta_keywords" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Keywords') }}<span class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="meta_keywords" id="meta_keywords" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan meta keywords') }}" value="{{ old('meta_keywords', $product->meta_keywords) }}" maxlength="255">
                                @error('meta_keywords') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="meta_description" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Description') }}<span class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <textarea name="meta_description" id="meta_description" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan meta description') }}" maxlength="255">{{ old('meta_description', $product->meta_description) }}</textarea>
                                @error('meta_description') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Foto Cover Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Foto Cover Produk') }}</h3>
                        <div class="mt-4">
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">{{ __('Unggah Foto Cover') }}</legend>
                                <input type="file" name="cover" id="cover" accept="image/*" class="file-input">
                                <label class="fieldset-label">{{ __('Maksimal 5 mb') }}</label>
                            </fieldset>
                            <div id="cover_preview" class="mt-2">
                                @if($product->cover)
                                    <img src="{{ asset('storage/' . $product->cover) }}" class="w-48 h-48 object-cover rounded-lg"/>
                                @endif
                            </div>
                            @error('cover') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                <!-- Galeri Gambar Produk -->
                    <div class="mt-4">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Galeri Gambar Produk') }}</h3>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('Unggah Gambar Produk') }}</legend>
                            <input type="file" name="product_images[]" id="product_images" accept="image/*" multiple class="file-input">
                            <label class="fieldset-label">{{ __('Maksimal 5 MB per gambar') }}</label>
                        </fieldset>
                        
                        <!-- Preview Gambar -->
                        <div id="gallery_preview" class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2">
                            @if($product->product_images && $product->product_images->isNotEmpty())
                                @foreach($product->product_images as $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-24 h-24 object-cover rounded-lg border shadow-sm"/>
                                        <button type="button" class="absolute top-0 right-0 text-red-500" onclick="removeImage({{ $image->id }})">&times;</button>
                                        <input type="hidden" name="removed_images[]" value="{{ $image->id }}" id="removed_image_{{ $image->id }}" />
                                    </div>
                                @endforeach
                            @else
                                <p>{{ __('Belum ada gambar produk yang diunggah.') }}</p>
                            @endif
                        </div>
                        @error('product_images.*') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Variasi Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Variasi Produk') }}</h3>
                        <div id="variations-container" class="space-y-6 mt-4">
                            @if($product->product_variants && $product->product_variants->isNotEmpty())
                                <!-- Existing variations will be displayed here -->
                            @else
                                <p class="text-gray-600 dark:text-gray-400">{{ __('Produk ini tidak memiliki variasi produk.') }}</p>
                            @endif
                        </div>
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
            const maxVariations = 10;

            // Ambil data variasi yang sudah ada dari PHP
            const existingVariations = @json($product->product_variants);

            // Menambahkan variasi yang sudah ada ke dalam form
            existingVariations.forEach((variation, index) => {
                if (variationCount >= maxVariations) {
                    return;
                }

                const materials = @json($materials);
                const sizes = @json($sizes);
                const colors = @json($colors);

                const container = document.getElementById("variations-container");
                const newVariation = document.createElement("div");
                newVariation.classList.add("flex", "flex-wrap", "space-x-6", "p-4", "border", "rounded-lg", "bg-gray-50", "dark:bg-darker", "shadow-sm");

                // Menampilkan form untuk setiap variasi
                newVariation.innerHTML = `
                    <div class="flex-1">
                        <label for="variations[${variationCount}][material]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Bahan</label>
                        <select name="variations[${variationCount}][material_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="">{{ __('Pilih Bahan') }}</option>
                            ${materials.map(material => `
                                <option value="${material.id}" ${material.id === variation.material_id ? 'selected' : ''}>${material.name}</option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="variations[${variationCount}][size]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Ukuran</label>
                        <select name="variations[${variationCount}][size_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="">{{ __('Pilih Ukuran') }}</option>
                            ${sizes.map(size => `
                                <option value="${size.id}" ${size.id === variation.size_id ? 'selected' : ''}>${size.size_number} - ${size.size_chart}</option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="variations[${variationCount}][color]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Warna</label>
                        <select name="variations[${variationCount}][color_id]" required class="select select-bordered w-full bg-white dark:bg-darker">
                            <option value="">{{ __('Pilih Warna') }}</option>
                            ${colors.map(color => `
                                <option value="${color.id}" ${color.id === variation.color_id ? 'selected' : ''}>${color.name}</option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="variations[${variationCount}][price]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Harga</label>
                        <input type="number" name="variations[${variationCount}][price]" value="${variation.price}" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>
                    <div class="flex-1">
                        <label for="variations[${variationCount}][stock]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Stok</label>
                        <input type="number" name="variations[${variationCount}][stock]" value="${variation.product_stocks && variation.product_stocks.length > 0 ? variation.product_stocks[0].stock : 0}" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>
                    <div class="flex-1">
                        <label for="variations[${variationCount}][image]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Gambar</label>
                        <input type="file" name="variations[${variationCount}][image]" accept="image/*" class="file-input">
                        ${variation.product_variant_images && variation.product_variant_images.length > 0 ? `
                            <div class="mt-2">
                                <img src="{{ asset('storage/${variation.product_variant_images[0].image}') }}" class="w-24 h-24 object-cover rounded-lg border shadow-sm"/>
                            </div>
                        ` : ''}
                    </div>
                `;

                container.appendChild(newVariation);
                variationCount++;
            });

            // Menambahkan variasi baru
            document.getElementById("add-variation").addEventListener("click", () => {
                if (variationCount >= maxVariations) {
                    alert('Maksimal variasi yang diizinkan adalah 10.');
                    return;
                }
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
                        <input type="number" name="variations[${variationCount}][price]" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>
                    <div class="flex-1">
                        <label for="variations[${variationCount}][stock]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Stok</label>
                        <input type="number" name="variations[${variationCount}][stock]" required class="input input-bordered w-full bg-white dark:bg-darker">
                    </div>
                    <div class="flex-1">
                        <label for="variations[${variationCount}][image]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Gambar</label>
                        <input type="file" name="variations[${variationCount}][image]" accept="image/*" class="file-input">
                    </div>
                `;
                container.appendChild(newVariation);
                variationCount++;
            });
                        document.getElementById('product_images').addEventListener('change', (e) => {
                const galleryPreview = document.getElementById('gallery_preview');
                galleryPreview.innerHTML = '';
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

                const fileLabel = document.getElementById('file-label');
                fileLabel.textContent = `${e.target.files.length} file dipilih`;
            });

            window.removeGalleryImage = function(button) {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Gambar akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const imageId = button.parentElement.querySelector('input[name="removed_images[]"]').value;
                        $.ajax({
                            url: `/admin/master/products/images/${imageId}`,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.success) {
                                    button.parentElement.remove();
                                    Swal.fire(
                                        'Dihapus!',
                                        'Gambar telah dihapus.',
                                        'success'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Gagal menghapus gambar.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            };
        });
    </script>
</x-app-layout>
