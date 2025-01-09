<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb Section -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Title Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Daftar Metode Pembayaran') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <div class="mb-6">
            <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-gray-800 dark:text-white">{{ __('Filter Metode Pembayaran') }}</h2>
                    <form action="{{ route('admin.payment-methods.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="col-span-2 lg:col-span-3">
                                <label for="search"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Cari') }}</label>
                                <input type="text" name="search" id="search"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Cari berdasarkan nama metode pembayaran') }}"
                                    value="{{ request()->query('search') }}">
                            </div>

                            <div>
                                <label for="is_active"
                                    class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status') }}</label>
                                <select name="is_active" id="is_active"
                                    class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="">Semua</option>
                                    <option value="1" {{ request()->query('is_active') == '1' ? 'selected' : '' }}>
                                        {{ __('Aktif') }}</option>
                                    <option value="0" {{ request()->query('is_active') == '0' ? 'selected' : '' }}>
                                        {{ __('Tidak Aktif') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                            <a href="{{ route('admin.payment-methods.index') }}"
                                class="btn btn-secondary ml-2">{{ __('Reset') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex justify-end mb-4">
            <button class="btn btn-primary"
                onclick="createPaymentMethodModal.showModal()">{{ __('Tambah Metode Pembayaran') }}</button>
        </div>

        <div class="overflow-hidden w-full rounded-lg shadow-lg bg-white border border-gray-300 dark:border-primary-darker dark:bg-darker">
            <div class="overflow-x-auto">
                @if ($isLoading)
                    <div class="flex justify-center py-8">
                        <span class="loading loading-infinity loading-lg"></span>
                    </div>
                @else
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300">
                                <th>
                                   #
                                </th>
                                <th>{{ __('Nama') }}</th>
                                <th>{{ __('Deskripsi') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <th>
                                       <span class="text-gray-800 dark:text-gray-300">{{ $loop->iteration }}</span>
                                    </th>
                                    <td class="text-gray-800 dark:text-gray-300">{{ $payment->name }}</td>
                                    <td class="text-gray-800 dark:text-gray-300">{{ $payment->description }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $payment->is_active == 1 ? 'badge-success' : 'badge-error' }}">
                                            {{ $payment->is_active == 1 ? __('Aktif') : __('Tidak Aktif') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="btn btn-primary btn-xs"
                                                onclick="document.getElementById('editPaymentMethodModal{{ $payment->id }}').showModal()">
                                                {{ __('Edit') }}
                                            </button>

                                            <button onclick="deletePayment('{{ route('admin.payment-methods.destroy', ['id' => $payment->id]) }}')"
                                                class="btn btn-secondary btn-xs">
                                                {{ __('Delete') }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-800 dark:text-gray-300">
                                        {{ __('Tidak ada metode pembayaran ditemukan.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="mt-6">
            {{ $payments->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Create Payment Modal -->
    @include('admin.settings.payments.partials.create')

    <!-- Edit Payment Modals -->
    @include('admin.settings.payments.partials.edit', ['payments' => $payments])
</x-app-layout>

<script>
    function deletePayment(url) {
        // Menggunakan SweetAlert untuk konfirmasi penghapusan
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Metode pembayaran ini akan dihapus secara permanen.',
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
</script>

