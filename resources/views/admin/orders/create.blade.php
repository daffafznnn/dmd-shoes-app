<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Menambahkan Pesanan') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Formulir Menambahkan Pesanan') }}</h2>
                <form action="{{ route('master.orders.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6 mt-4">
                    @csrf

                    <!-- Informasi Order -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Informasi Pesanan') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="customer_name"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Pemesan') }}</label>
                                <input type="text" name="customer_name" id="customer_name" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan nama pemesan') }}">
                            </div>
                            <div>
                                <label for="customer_contact"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nomor Telepon') }}</label>
                                <input type="text" name="customer_contact" id="customer_contact" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan nomor telepon') }}">
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
                                    <option value="pending" selected>
                                        {{ __('Menunggu') }}</option>
                                    <option value="processing">
                                        {{ __('Proses') }}</option>
                                    <option value="completed">
                                        {{ __('Selesai') }}</option>
                                    <option value="cancelled">
                                        {{ __('Batal') }}</option>
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
                                        <option value="{{ $paymentMethod->id }}">
                                            {{ $paymentMethod->name }}
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
                                        <option value="{{ $shippingMethod->id }}">
                                            {{ $shippingMethod->name }}
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
                        </div>
                        <div>
                            <label for="payment_proof"
                                class="block text-sm font-medium text-gray-800 dark:text-gray-300 mt-2">{{ __('Bukti Pembayaran') }}<span
                                    class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                            <input type="file" name="payment_proof" id="payment_proof"
                                class="file-input w-full bg-white dark:bg-darker" accept=".jpg,.jpeg,.png,.pdf">
                            <p class="text-sm text-gray-500 mt-2">
                                {{ __('Ukuran file maksimal 2MB dan hanya menerima format file: .jpg, .jpeg, .png, .pdf') }}
                            </p>
                        </div>
                    </div>

                   <!-- Produk yang Dibeli -->
                     <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Produk yang Dibeli') }}</h3>
                        <div id="products-container" class="space-y-6 mt-4">
                        </div>
                        <button type="button" id="add-product" class="btn btn-secondary mt-4">{{ __('Tambah Produk') }}</button>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('master.orders.index') }}"
                            class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Pesanan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let productCount = 1;
        const productsContainer = document.getElementById("products-container");
        const addProductButton = document.getElementById("add-product");

        addProductButton.addEventListener("click", () => {

            const newProduct = document.createElement("div");
            newProduct.classList.add("flex", "flex-wrap", "space-x-6", "p-4", "border", "rounded-lg", "bg-gray-50", "dark:bg-darker", "shadow-sm");
            newProduct.innerHTML = `
                <div class="flex-1">
                    <label for="order_details[${productCount}][product_id]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Produk') }}</label>
                    <select name="order_details[${productCount}][product_id]" required class="select select-bordered w-full bg-white dark:bg-darker" onchange="getVariants(this.value, ${productCount})">
                        <option value="">{{ __('Pilih Produk') }}</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label for="order_details[${productCount}][variant_id]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Varian') }}</label>
                    <select name="order_details[${productCount}][product_variant_id]" required class="select select-bordered w-full bg-white dark:bg-darker" id="order_details-${productCount}-variant_id">
                        <option value="">-- Pilih Varian --</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label for="order_details[${productCount}][quantity]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Jumlah') }}</label>
                    <input type="number" name="order_details[${productCount}][quantity]" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="Jumlah" min="1">
                </div>
                <button type="button" class="remove-product text-red-500 mt-2">Hapus Produk</button>
            `;

            // Tambahkan produk ke kontainer
            productsContainer.appendChild(newProduct);

            // Event listener untuk tombol hapus
            newProduct.querySelector(".remove-product").addEventListener("click", () => {
                newProduct.remove();
                productCount--;
            });

            productCount++;
        });

        function getVariants(productId, index) {
            const variantSelect = document.getElementById(`order_details-${index}-variant_id`);
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
                }
            });
        }
    </script>
</x-app-layout>
