<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Create Order') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Formulir Create Order') }}</h2>
                <form action="{{ route('master.orders.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6 mt-4">
                    @csrf

                    <!-- Informasi Order -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Informasi Order') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="customer_name"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Pelanggan') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" id="customer_name" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan nama pelanggan') }}">
                            </div>
                            <div>
                                <label for="customer_contact"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kontak Pelanggan') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="customer_contact" id="customer_contact" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan kontak pelanggan') }}">
                            </div>
                            <div>
                                <label for="shipping_address"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Alamat Pengiriman') }}<span
                                        class="text-red-500">*</span></label>
                                <textarea name="shipping_address" id="shipping_address" required
                                    class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan alamat pengiriman') }}"></textarea>
                            </div>
                            <div>
                                <label for="note"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Catatan') }}</label>
                                <textarea name="note" id="note" class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan catatan') }}"></textarea>
                            </div>
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="status" id="status" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="pending">{{ __('Menunggu') }}</option>
                                    <option value="processing">{{ __('Proses') }}</option>
                                    <option value="completed">{{ __('Selesai') }}</option>
                                    <option value="cancelled">{{ __('Batal') }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="payment_method_id"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Metode Pembayaran') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="payment_method_id" id="payment_method_id" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('-- Pilih Metode Pembayaran --') }}</option>
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="shipping_method_id"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Metode Pengiriman') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="shipping_method_id" id="shipping_method_id" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('-- Pilih Metode Pengiriman --') }}</option>
                                    @foreach ($shippingMethods as $shippingMethod)
                                        <option value="{{ $shippingMethod->id }}">{{ $shippingMethod->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="tracking_number"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nomor Resi') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="text" name="tracking_number" id="tracking_number"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan nomor resi') }}">
                            </div>
                            <div>
                                <label for="quantity"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Jumlah') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="quantity" id="quantity" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan Jumlah') }}">
                            </div>
                            <div>
                                <label for="product_id"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Product') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="product_id" id="product_id" required
                                    class="select select-bordered w-full bg-white dark:bg-darker"
                                    onchange="getVariants(this.value)">
                                    <option value="">{{ __('-- Pilih Product --') }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="product_variant_id"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Variasi') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="product_variant_id" id="product_variant_id" required
                                    class="select select-bordered w-full bg-white dark:bg-darker" disabled>
                                    <option value="">{{ __('-- Pilih Variant --') }}</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="payment_proof"
                                class="block text-sm font-medium text-gray-800 dark:text-gray-300 mt-2">{{ __('Bukti Pembayaran') }}<span
                                    class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                            <input type="file" name="payment_proof" id="payment_proof"
                                class="file-input w-full bg-white dark:bg-darker" accept=".jpg,.jpeg,.png,.pdf">
                            <div class="mt-3" id="preview-payment-proof" class="hidden">
                                <!-- Preview will be dynamically inserted here -->
                            </div>
                            <button type="button" id="remove-payment-proof"
                                class="btn btn-danger mt-2 hidden">{{ __('Hapus Bukti Pembayaran') }}</button>
                            <p class="text-sm text-gray-500 mt-2">
                                {{ __('Ukuran file maksimal 2MB dan hanya menerima format file: .jpg, .jpeg, .png, .pdf') }}
                            </p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('master.orders.index') }}"
                            class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Order') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const inputPaymentProof = document.getElementById('payment_proof');
        const previewPaymentProof = document.getElementById('preview-payment-proof');
        const removePaymentProofButton = document.getElementById('remove-payment-proof');
        const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        removePaymentProofButton.addEventListener('click', () => {
            inputPaymentProof.value = ''; // Clear the input
            previewPaymentProof.innerHTML = ''; // Clear the preview
            removePaymentProofButton.classList.add('hidden');
        });

        inputPaymentProof.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const fileType = file ? file.type.split('/')[1] : '';
            const fileSize = file ? file.size : 0;

            if (file) {
                // Validate file type and size
                if (!['jpg', 'jpeg', 'png', 'pdf'].includes(fileType)) {
                    alert('Hanya file gambar dan PDF yang diizinkan.');
                    inputPaymentProof.value = ''; // Clear the input
                    previewPaymentProof.innerHTML = ''; // Clear the preview
                    removePaymentProofButton.classList.add('hidden');
                    return;
                }

                if (fileSize > maxFileSize) {
                    alert('Ukuran file tidak boleh lebih dari 2MB.');
                    inputPaymentProof.value = ''; // Clear the input
                    previewPaymentProof.innerHTML = ''; // Clear the preview
                    removePaymentProofButton.classList.add('hidden');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    if (['jpeg', 'jpg', 'png'].includes(fileType)) {
                        previewPaymentProof.innerHTML = `<img src="${e.target.result}" class="w-full h-32 object-cover" alt="File Preview">`;
                    } else if (fileType === 'pdf') {
                        previewPaymentProof.innerHTML = `<embed src="${e.target.result}" type="application/pdf" class="w-full h-32" alt="File Preview">`;
                    }
                    removePaymentProofButton.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                previewPaymentProof.innerHTML = ''; // Clear the preview
                removePaymentProofButton.classList.add('hidden');
            }
        });

        function getVariants(productId) {
            const variantSelect = document.getElementById('product_variant_id');
            if (!productId) {
                variantSelect.disabled = true;
                variantSelect.innerHTML = `<option value="">-- Pilih Variant --</option>`;
                return;
            }

            variantSelect.disabled = false;

            $.ajax({
                url: `/admin/master/orders/variant/${productId}`,
                method: 'GET',
                success: (response) => {
                    const variants = response;
                    variantSelect.innerHTML = `<option value="">-- Pilih Variant --</option>`; // Reset variant options

                    if (variants.length > 0) {
                        variants.forEach(variant => {
                            const option = document.createElement('option');
                            option.value = variant.id; // Set ID sebagai value

                            // Menangani kemungkinan relasi yang kosong (null)
                            const material = variant.product_materials || 'Unknown Material';
                            const color = variant.product_colors || 'Unknown Color';
                            const sizeNumber = variant.product_sizes ? variant.product_sizes.size_number : 'N/A';
                            const sizeChart = variant.product_sizes ? variant.product_sizes.size_chart : 'N/A';

                            option.text = `${material}, ${color}, ${sizeNumber} (${sizeChart})`; // Menampilkan deskripsi
                            variantSelect.appendChild(option);
                        });
                    } else {
                        const option = document.createElement('option');
                        option.value = '';
                        option.text = 'Tidak ada varian tersedia';
                        variantSelect.appendChild(option);
                    }
                },
                error: (error) => {
                    console.error('Error fetching variants:', error);
                    console.error('Error message:', error.responseText);
                    console.error('Error status:', error.status);
                    console.error('Error statusText:', error.statusText);
                }
            });
        }
    </script>
</x-app-layout>
