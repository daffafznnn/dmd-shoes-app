<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Edit Pesanan') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Formulir Edit Pesanan') }}</h2>
                <form action="{{ route('master.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6 mt-4">
                    @csrf
                    @method('PUT')

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
                                    value="{{ old('customer_name', $order->customer_name) }}"
                                    placeholder="{{ __('Masukkan nama pemesan') }}">
                            </div>
                            <div>
                                <label for="customer_contact"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nomor Telepon') }}</label>
                                <input type="text" name="customer_contact" id="customer_contact" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    value="{{ old('customer_contact', $order->customer_contact) }}"
                                    placeholder="{{ __('Masukkan nomor telepon') }}">
                            </div>
                            <div>
                                <label for="shipping_address"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Alamat Pengiriman') }}<span
                                        class="text-red-500">*</span></label>
                                <textarea name="shipping_address" id="shipping_address" required
                                    class="input input-bordered w-full bg-white dark:bg-darker" placeholder="{{ __('Masukkan alamat pengiriman') }}">{{ old('shipping_address', $order->shipping_address) }}</textarea>
                            </div>
                            <div>
                                <label for="note"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Catatan') }}</label>
                                <textarea name="note" id="note" class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan catatan') }}">{{ old('note', $order->note) }}</textarea>
                            </div>
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="status" id="status" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="pending"
                                        {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>
                                        {{ __('Menunggu') }}</option>
                                    <option value="processing"
                                        {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>
                                        {{ __('Proses') }}</option>
                                    <option value="completed"
                                        {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>
                                        {{ __('Selesai') }}</option>
                                    <option value="cancelled"
                                        {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>
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
                                        <option value="{{ $paymentMethod->id }}"
                                            {{ old('payment_method_id', $order->payment_method_id) == $paymentMethod->id ? 'selected' : '' }}>
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
                                        <option value="{{ $shippingMethod->id }}"
                                            {{ old('shipping_method_id', $order->shipping_method_id) == $shippingMethod->id ? 'selected' : '' }}>
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
                                    value="{{ old('tracking_number', $order->tracking_number) }}"
                                    placeholder="{{ __('Masukkan nomor resi') }}">
                            </div>
                        </div>
                        <div>
                            <label for="payment_proof"
                                class="block text-sm font-medium text-gray-800 dark:text-gray-300 mt-2">{{ __('Bukti Pembayaran') }}<span
                                    class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                            <input type="file" name="payment_proof" id="payment_proof"
                                class="file-input w-full bg-white dark:bg-darker" accept=".jpg,.jpeg,.png,.pdf"
                                onchange="previewPaymentProof(this)">
                            <div class="mt-3" id="preview-payment-proof">
                                @if ($order->payment_proof)
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank"
                                        class="text-blue-500 hover:text-blue-700 hover:underline">
                                        {{ __('Klik di sini untuk melihat bukti pembayaran') }}
                                    </a>
                                @else
                                    <!-- Preview will be dynamically inserted here -->
                                    <p class="text-gray-500">{{ __('Belum ada bukti pembayaran yang diunggah.') }}</p>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                {{ __('Ukuran file maksimal 2MB dan hanya menerima format file: .jpg, .jpeg, .png, .pdf') }}
                            </p>
                        </div>
                    </div>

                   <!-- Produk yang Dibeli -->
                     <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Produk yang Dibeli') }}</h3>
                        <div id="products-container" class="space-y-6 mt-4">
                            @if ($order->order_details && $order->order_details->isNotEmpty())
                                @foreach ($order->order_details as $orderDetail)
                                    <div class="flex flex-wrap space-x-6 p-4 border rounded-lg bg-gray-50 dark:bg-darker shadow-sm">
                                        <div class="flex-1">
                                            <label for="order_details[{{ $loop->index }}][product_id]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Produk') }}</label>
                                            <select name="order_details[{{ $loop->index }}][product_id]" required class="select select-bordered w-full bg-white dark:bg-darker" onchange="getVariants(this.value, {{ $loop->index }})">
                                                <option value="">{{ __('Pilih Produk') }}</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" {{ $orderDetail->product_id == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex-1">
                                            <label for="order_details[{{ $loop->index }}][variant_id]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Varian') }}</label>
                                            <select name="order_details[{{ $loop->index }}][product_variant_id]" required class="select select-bordered w-full bg-white dark:bg-darker" id="order_details-{{ $loop->index }}-variant_id">
                                                <option value="">-- Pilih Varian --</option>
                                                @foreach ($orderDetail->products->product_variants as $variant)
                                                    <option value="{{ $variant->id }}" {{ $orderDetail->product_variant_id == $variant->id ? 'selected' : '' }}>
                                                        {{ $variant->product_materials->name }} {{ $variant->product_colors->name }} {{ $variant->product_sizes->size_number }} - {{ $variant->product_sizes->size_chart }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex-1">
                                            <label for="order_details[{{ $loop->index }}][quantity]" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Jumlah') }}</label>
                                            <input type="number" name="order_details[{{ $loop->index }}][quantity]" required class="input input-bordered w-full bg-white dark:bg-darker" placeholder="Jumlah" min="1" value="{{ $orderDetail->quantity }}">
                                        </div>
                                        <button type="button" onclick="deleteOrderProduct({{ $orderDetail->id }})" class="remove-product text-red-500 mt-2">Hapus Produk</button>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-500 text-center mt-4">{{ __('Tidak ada produk yang dibeli.') }}</p>
                            @endif
                        </div>
                        <button type="button" id="add-product" class="btn btn-secondary mt-4">{{ __('Tambah Produk') }}</button>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('master.orders.index') }}"
                            class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Periksa jika $order->order_details bukan null dan merupakan array/ koleksi yang dapat dihitung
        let productCount = {{ $order->order_details ? $order->order_details->count() : 0 }};
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

        function deleteOrderProduct(orderDetailId) {
            console.log("ID yang diterima:", orderDetailId);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Produk ini akan dihapus dari pesanan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/master/orders/product/${orderDetailId}`,
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
                                text: xhr.responseJSON.message || 'Terjadi kesalahan, coba lagi nanti.',
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
