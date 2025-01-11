<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb Section -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Title Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Daftar Pesanan') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <!-- Form Filter Section -->
        <div class="mb-6">
            <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-gray-800 dark:text-white">{{ __('Filter Pesanan') }}</h2>
                    <form action="{{ route('master.orders.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="col-span-2 lg:col-span-3">
                                <label for="search"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Cari') }}</label>
                                <input type="text" name="search" id="search"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Cari kode order') }}" value="{{ request()->query('search') }}">
                            </div>
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}</label>
                                <select name="status" id="status"
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">{{ __('Semua') }}</option>
                                    <option value="pending"
                                        {{ request()->query('status') == 'pending' ? 'selected' : '' }}>
                                        {{ __('Menunggu') }}</option>
                                    <option value="processing"
                                        {{ request()->query('status') == 'processing' ? 'selected' : '' }}>
                                        {{ __('Proses') }}</option>
                                    <option value="completed"
                                        {{ request()->query('status') == 'completed' ? 'selected' : '' }}>
                                        {{ __('Selesai') }}</option>
                                    <option value="cancelled"
                                        {{ request()->query('status') == 'cancelled' ? 'selected' : '' }}>
                                        {{ __('Batal') }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="trashed"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Tampilkan data yang terhapus') }}</label>
                                <select name="trashed" id="trashed"
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="" {{ request()->query('trashed') == '' ? 'selected' : '' }}>
                                        {{ __('Tidak') }}</option>
                                    <option value="with"
                                        {{ request()->query('trashed') == 'with' ? 'selected' : '' }}>
                                        {{ __('Ya') }}</option>
                                    <option value="only"
                                        {{ request()->query('trashed') == 'only' ? 'selected' : '' }}>
                                        {{ __('Hanya data yang terhapus') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                            <a href="{{ route('master.orders.index') }}"
                                class="btn btn-secondary ml-2">{{ __('Reset') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div
            class="overflow-hidden w-full rounded-lg shadow-lg bg-white border border-gray-300 dark:border-primary-darker dark:bg-darker">
            <div class="overflow-x-auto">
                @if ($isLoading)
                    <div class="flex justify-center py-8">
                        <span class="loading loading-infinity loading-lg"></span>
                    </div>
                @else
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300">
                                <th>{{ __('Kode Pesanan') }}</th>
                                <th>{{ __('Nama Pelanggan') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="text-gray-800 dark:text-gray-300">{{ $order->code_order }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $order->status === 'pending'
                                                ? 'badge-warning'
                                                : ($order->status === 'processing'
                                                    ? 'badge-primary'
                                                    : ($order->status === 'completed'
                                                        ? 'badge-success'
                                                        : 'badge-error')) }}">
                                            {{ $order->status === 'pending'
                                                ? __('Menunggu')
                                                : ($order->status === 'processing'
                                                    ? __('Proses')
                                                    : ($order->status === 'completed'
                                                        ? __('Selesai')
                                                        : __('Batal'))) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('master.orders.show', $order->id) }}"
                                                class="btn btn-accent btn-xs">{{ __('Detail') }}</a>
                                            @if ($order->deleted_at)
                                                <button
                                                    onclick="restoreOrder('{{ route('master.orders.restore', ['id' => $order->id]) }}')"
                                                    class="btn btn-secondary btn-xs">
                                                    {{ __('Restore') }}
                                                </button>
                                            @else
                                             <a href="{{ route('master.orders.edit', $order->id) }}"
                                                class="btn btn-secondary btn-xs">{{ __('Edit') }}</a>
                                                <button
                                                    onclick="deleteOrder('{{ route('master.orders.destroy', ['id' => $order->id]) }}')"
                                                    class="btn btn-error btn-xs">
                                                    {{ __('Hapus') }}
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-800 dark:text-gray-300">
                                        {{ __('Tidak ada order ditemukan.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Pagination Section -->
        <div class="mt-6 text-gray-800 dark:text-gray-300">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        function deleteOrder(url) {
            // Menggunakan SweetAlert untuk konfirmasi penghapusan
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Order ini akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, lakukan penghapusan dengan submit form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    // Tambahkan csrf token dan method DELETE
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);

                    // Kirim form untuk menghapus data
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function restoreOrder(url) {
            // Menggunakan SweetAlert untuk konfirmasi restore
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Order ini akan direstore.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Restore!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, lakukan restore dengan submit form
                    const form = document.createElement('form');
                    form.method = 'POST'; // Gunakan POST, tapi tambahkan _method untuk mengindikasikan PATCH
                    form.action = url;

                    // Tambahkan csrf token dan method PATCH
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PATCH'; // Ubah dari POST ke PATCH

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);

                    // Kirim form untuk restore data
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

</x-app-layout>
