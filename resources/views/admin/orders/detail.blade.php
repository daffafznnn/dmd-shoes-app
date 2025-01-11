<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Detail Pesanan') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <!-- Informasi Pesanan -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Informasi Pesanan') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Kolom Kiri -->
                    <div class="space-y-2">
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Nama Pemesan:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white font-semibold">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Nomor Telepon:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $order->customer_contact }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Alamat Pengiriman:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $order->shipping_address }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Catatan:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $order->note }}</p>
                        </div>
                    </div>
                    <!-- Kolom Kanan -->
                    <div class="space-y-2">
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Status:') }}</span>
                            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : ($order->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                {{ $order->status == 'pending' ? __('Menunggu') : ($order->status == 'processing' ? __('Proses') : ($order->status == 'completed' ? __('Selesai') : __('Batal'))) }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Metode Pembayaran:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $order->payment_methods->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Metode Pengiriman:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $order->shipping_methods->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Nomor Resi:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $order->tracking_number ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Bukti Pembayaran:') }}</span>
                            @if ($order->payment_proof)
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline">
                                    {{ __('Klik di sini untuk melihat bukti pembayaran') }}
                                </a>
                            @else
                                <p class="text-lg text-gray-800 dark:text-white">{{ __('Belum ada bukti pembayaran yang diunggah.') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk yang Dibeli -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker mt-6">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Produk yang Dibeli') }}</h2>
                <div class="grid grid-cols-1 gap-6 mt-4">
                    @foreach ($order->order_details as $orderDetail)
                        <div class="flex flex-wrap space-x-6 p-4 border rounded-lg bg-gray-50 dark:bg-darker shadow-sm">
                            <div class="flex-1">
                                <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Produk:') }}</span>
                                <p class="text-lg text-gray-800 dark:text-white">{{ $orderDetail->product_variant->products->name }}</p>
                            </div>
                            <div class="flex-1">
                                <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Varian:') }}</span>
                                <p class="text-lg text-gray-800 dark:text-white">{{ $orderDetail->product_variant->product_materials->name }}, {{ $orderDetail->product_variant->product_colors->name }}, {{ $orderDetail->product_variant->product_sizes->size_number }} ({{ $orderDetail->product_variant->product_sizes->size_chart }})</p>
                            </div>
                            <div class="flex-1">
                                <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Jumlah:') }}</span>
                                <p class="text-lg text-gray-800 dark:text-white">{{ $orderDetail->quantity }}</p>
                            </div>
                            <div class="flex-1">
                                <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Harga:') }}</span>
                                <p class="text-lg text-gray-800 dark:text-white">{{ \NumberFormatter::create('id_ID', \NumberFormatter::CURRENCY)->format($orderDetail->price) }}</p>
                            </div>
                            <div class="flex-1">
                                <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Subtotal:') }}</span>
                                <p class="text-lg text-gray-800 dark:text-white">{{ \NumberFormatter::create('id_ID', \NumberFormatter::CURRENCY)->format($orderDetail->sub_total) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Total Harga -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker mt-6">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Total Harga') }}</h2>
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Subtotal:') }}</span>
                        <p class="text-lg text-gray-800 dark:text-white">{{ \NumberFormatter::create('id_ID', \NumberFormatter::CURRENCY)->format($order->order_details->sum('sub_total')) }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Ongkir:') }}</span>
                        <p class="text-lg text-gray-800 dark:text-white">{{ \NumberFormatter::create('id_ID', \NumberFormatter::CURRENCY)->format($order->order_details->sum('quantity') * $order->shipping_methods->cost) }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Total:') }}</span>
                        <p class="text-lg text-gray-800 dark:text-white">{{ \NumberFormatter::create('id_ID', \NumberFormatter::CURRENCY)->format($order->total) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('master.orders.index') }}" class="btn btn-primary">{{ __('Kembali ke Daftar Pesanan') }}</a>
        </div>
    </div>
</x-app-layout>

