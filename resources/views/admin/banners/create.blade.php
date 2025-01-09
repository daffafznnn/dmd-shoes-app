<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Tambah Banner Baru') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Formulir Tambah Banner') }}</h2>
                <form action="{{ route('master.banners.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6 mt-4">
                    @csrf

                    <!-- Informasi Banner -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Informasi Banner') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Banner') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan nama banner') }}">
                            </div>
                            <div>
                                <label for="alt_text"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Alt Text') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="alt_text" id="alt_text" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan alt text, misal: "Gambar Banner Promo"') }}">
                            </div>
                            <div>
                                <label for="target_url"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Target URL') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="url" name="target_url" id="target_url"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan target URL, misal: https://example.com') }}">
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ __('Masukkan URL tujuan banner, contoh: https://example.com atau produk tertentu.') }}
                                </p>
                            </div>
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="status" id="status" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1">{{ __('Aktif') }}</option>
                                    <option value="0">{{ __('Tidak Aktif') }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="start_date"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tanggal Mulai') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="start_date" id="start_date"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div>
                                <label for="end_date"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tanggal Berakhir') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="end_date" id="end_date"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div>
                                <label for="image"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">
                                    {{ __('Gambar') }}<span
                                        class="text-red-500">*</span>
                                </label>
                                <input type="file" name="image" id="image"
                                    class="file-input w-full bg-white dark:bg-darker" accept="image/*">
                                <div class="mt-3">
                                    <img src="" id="preview-image" class="w-full h-64 object-cover hidden"
                                        alt="Image Preview">
                                    <button type="button" id="remove-image"
                                        class="btn btn-danger mt-2 hidden">{{ __('Hapus Gambar') }}</button>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ __('Ukuran file maksimal 2MB dan hanya menerima format gambar (.jpg, .jpeg, .png)') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Meta Banner SEO -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">
                            {{ __('Informasi Meta Banner SEO') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="meta_title"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Title') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="meta_title" id="meta_title"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan meta title') }}" maxlength="255">
                            </div>
                            <div>
                                <label for="meta_description"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Description') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <textarea name="meta_description" id="meta_description" class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan meta description') }}" maxlength="255"></textarea>
                            </div>
                            <div>
                                <label for="meta_keywords"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Meta Keywords') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="meta_keywords" id="meta_keywords"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan meta keywords') }}" maxlength="255">
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('master.banners.index') }}"
                            class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Banner') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const inputImage = document.getElementById('image');
        const previewImage = document.getElementById('preview-image');
        const removeImageButton = document.getElementById('remove-image');
        const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        inputImage.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const fileType = file ? file.type.split('/')[1] : '';
            const fileSize = file ? file.size : 0;

            if (file) {
                // Validate file type and size
                if (!['jpeg', 'jpg', 'png'].includes(fileType)) {
                    alert('Hanya file gambar (.jpg, .jpeg, .png) yang diizinkan.');
                    inputImage.value = ''; // Clear the input
                    previewImage.classList.add('hidden');
                    removeImageButton.classList.add('hidden');
                    return;
                }

                if (fileSize > maxFileSize) {
                    alert('Ukuran file gambar tidak boleh lebih dari 2MB.');
                    inputImage.value = ''; // Clear the input
                    previewImage.classList.add('hidden');
                    removeImageButton.classList.add('hidden');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    removeImageButton.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
                removeImageButton.classList.add('hidden');
            }
        });

        removeImageButton.addEventListener('click', () => {
            inputImage.value = ''; // Clear the file input
            previewImage.src = ''; // Clear the preview image
            previewImage.classList.add('hidden');
            removeImageButton.classList.add('hidden');
        });
    </script>
</x-app-layout>
