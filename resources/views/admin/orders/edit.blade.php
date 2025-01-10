<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Edit Order') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Formulir Edit Order') }}</h2>
                <form action="{{ route('master.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6 mt-4">
                    @csrf
                    @method('PUT')

                    <!-- Informasi Order -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{{ __('Informasi Order') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="code_order"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kode Order') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="code_order" id="code_order" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan kode order') }}" value="{{ $order->code_order }}">
                            </div>
                            <div>
                                <label for="customer_name"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Pelanggan') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" id="customer_name" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan nama pelanggan') }}" value="{{ $order->customer_name }}">
                            </div>
                            <div>
                                <label for="customer_contact"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kontak Pelanggan') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="customer_contact" id="customer_contact" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan kontak pelanggan') }}" value="{{ $order->customer_contact }}">
                            </div>
                            <div>
                                <label for="shipping_address"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Alamat Pengiriman') }}<span
                                        class="text-red-500">*</span></label>
                                <textarea name="shipping_address" id="shipping_address" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan alamat pengiriman') }}">{{ $order->shipping_address }}</textarea>
                            </div>
                            <div>
                                <label for="note"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Catatan') }}</label>
                                <textarea name="note" id="note"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan catatan') }}">{{ $order->note }}</textarea>
                            </div>
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="status" id="status" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>{{ __('Menunggu') }}</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>{{ __('Proses') }}</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>{{ __('Selesai') }}</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>{{ __('Batal') }}</option>
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
                                        <option value="{{ $paymentMethod->id }}" {{ $order->payment_method_id === $paymentMethod->id ? 'selected' : '' }}>{{ $paymentMethod->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="payment_proof"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Bukti Pembayaran') }}<span
                                        class="text-gray-500"> ({{ __('Opsional') }})</span></label>
                                <input type="file" name="payment_proof" id="payment_proof"
                                    class="file-input w-full bg-white dark:bg-darker" accept="image/*">
                                <div class="mt-3">
                                    <img src="{{ $order->payment_proof ? url('storage/' . $order->payment_proof) : '' }}"
                                        id="preview-payment-proof" class="w-full h-64 object-cover"
                                        alt="Image Preview">
                                    <button type="button" id="remove-payment-proof"
                                        class="btn btn-danger mt-2 {{ $order->payment_proof ? '' : 'hidden' }}">{{ __('Hapus Bukti Pembayaran') }}</button>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ __('Ukuran file maksimal 2MB dan hanya menerima format gambar (.jpg, .jpeg, .png)') }}
                                </p>
                            </div>
                            <div>
                                <label for="shipping_method_id"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Metode Pengiriman') }}<span
                                        class="text-red-500">*</span></label>
                                <select name="shipping_method_id" id="shipping_method_id" required
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('-- Pilih Metode Pengiriman --') }}</option>
                                    @foreach ($shippingMethods as $shippingMethod)
                                        <option value="{{ $shippingMethod->id }}" {{ $order->shipping_method_id === $shippingMethod->id ? 'selected' : '' }}>{{ $shippingMethod->name }}
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
                                    placeholder="{{ __('Masukkan nomor resi') }}" value="{{ $order->tracking_number }}">
                            </div>
                            <div>
                                <label for="total"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Total') }}<span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="total" id="total" required
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Masukkan total') }}" step="100" value="{{ $order->total }}">
                            </div>
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

    <script>
        const inputPaymentProof = document.getElementById('payment_proof');
        const previewPaymentProof = document.getElementById('preview-payment-proof');
        const removePaymentProofButton = document.getElementById('remove-payment-proof');
        const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        inputPaymentProof.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const fileType = file ? file.type.split('/')[1] : '';
            const fileSize = file ? file.size : 0;

            if (file) {
                // Validate file type and size
                if (!['jpeg', 'jpg', 'png', 'gif', 'pdf', 'doc', 'docx'].includes(fileType)) {
                    alert('Only image files (.jpg, .jpeg, .png, .gif) and document files (.pdf, .doc, .docx) are allowed.');
                    inputPaymentProof.value = ''; // Clear the input
                    previewPaymentProof.classList.add('hidden');
                    removePaymentProofButton.classList.add('hidden');
                    return;
                }
    
                if (fileSize > maxFileSize) {
                    alert('Ukuran file gambar tidak boleh lebih dari 2MB.');
                    inputPaymentProof.value = ''; // Clear the input
                    previewPaymentProof.classList.add('hidden');
                    removePaymentProofButton.classList.add('hidden');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    previewPaymentProof.src = e.target.result;
                    previewPaymentProof.classList.remove('hidden');
                    removePaymentProofButton.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                previewPaymentProof.classList.add('hidden');
                removePaymentProofButton.classList.add('hidden');
            }
        });

        removePaymentProofButton.addEventListener('click', () => {
            inputPaymentProof.value = ''; // Clear the file input
            previewPaymentProof.src = ''; // Clear the image preview
            previewPaymentProof.classList.add('hidden');
            removePaymentProofButton.classList.add('hidden');
        });
    </script>

