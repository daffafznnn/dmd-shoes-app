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
                                <label for="model_number" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nomor Model') }}<span class="text-red-500">*</span></label>
                                <input type="text" name="model_number" id="model_number" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan nomor model') }}">
                            </div>
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

                     <!-- Meta Information -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Information') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Title') }}<span class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="meta_title" id="meta_title" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan meta title') }}" maxlength="255">
                                @error('meta_title') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="meta_keywords" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Keywords') }}<span class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="meta_keywords" id="meta_keywords" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan meta keywords') }}" maxlength="255">
                                @error('meta_keywords') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="meta_description" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Description') }}<span class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <textarea name="meta_description" id="meta_description" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan meta description') }}" maxlength="255"></textarea>
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
                                <input type="file" name="cover" id="cover" accept="image/*" required class="file-input" class="file-input w-full max-w-lg">
                                <label class="fieldset-label dark:bg-darker">{{ __('Maksimal 5 mb') }}</label>
                            </fieldset>
                            <div id="cover_preview" class="mt-2"></div>
                            @error('cover') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Galeri Gambar Produk -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Galeri Gambar Produk') }}</h3>
                        <div class="mt-4">
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">{{ __('Unggah Gambar Produk') }}</legend>
                                <input type="file" name="product_images[]" id="product_images" accept="image/*" multiple class="file-input">
                                <label id="file-label" class="fieldset-label dark:bg-darker">{{ __('Maksimal 5 mb per gambar') }}</label>
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
    const maxVariations = 10;

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
                <input type="file" name="variations[${variationCount}][images][]" accept="image/*" class="file-input" multiple>
                <div class="preview-container" id="variation-preview-${variationCount}" class="mt-2"></div>
            </div>
            <button type="button" class="remove-variation text-red-500 mt-2">Hapus Variasi</button>
        `;
        
        // Tambahkan variasi ke kontainer
        container.appendChild(newVariation);

        // Event listener untuk tombol hapus
        newVariation.querySelector(".remove-variation").addEventListener("click", () => {
            // Hapus variasi dari DOM
            newVariation.remove();
        });

        variationCount++;
    });

    document.querySelectorAll('.file-input').forEach(function(inputElement) {
            inputElement.addEventListener('change', function(event) {
                const previewContainer = document.getElementById(`variation-preview-${variationCount}`);
                previewContainer.innerHTML = ''; // Menghapus preview sebelumnya

                const files = event.target.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Preview Image';
                        img.classList.add('w-full', 'h-32', 'object-cover', 'rounded-md');
                        previewContainer.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                }
            });
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
            galleryPreview.innerHTML = '';  // Clear existing preview
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
            const indexToRemove = Array.from(button.parentElement.querySelectorAll('img')).indexOf(button.parentElement.querySelector('img'));

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
    </script>
</x-app-layout>
