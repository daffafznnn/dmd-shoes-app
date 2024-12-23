<div class="space-y-6">
    <!-- Pencarian -->
    <div class="mb-6 flex items-center">
        <input 
            type="text" 
            wire:model="search" 
            placeholder="Search..." 
            class="form-input w-full p-3 border border-neutral-300 rounded-md text-neutral-700 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
        >
    </div>

    <!-- Tabel Data -->
    <div class="overflow-hidden w-full rounded-md border border-neutral-300 dark:border-neutral-700 shadow-lg bg-white dark:bg-neutral-800">
        <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
            <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col" class="px-6 py-3 text-left font-medium text-neutral-800 dark:text-neutral-200">{{ ucwords(str_replace('_', ' ', $column)) }}</th>
                    @endforeach
                    @if (count($actions) > 0)
                        <th scope="col" class="px-6 py-3 text-left font-medium text-neutral-800 dark:text-neutral-200">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                @foreach ($data as $item)
                    <tr class="hover:bg-neutral-100 dark:hover:bg-neutral-700 transition-colors">
                        @foreach ($columns as $column)
                            <td class="px-6 py-4">{{ $item->{$column} }}</td>
                        @endforeach
                        @if (count($actions) > 0)
                            <td class="px-6 py-4 text-center">
                                @foreach ($actions as $action)
                                    <!-- Aksi Edit -->
                                    @if ($action == 'edit' && $edit_route)
                                        <a href="{{ str_replace('__id__', $item->id, $edit_route) }}" 
                                           class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 font-semibold transition duration-200">
                                           <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    @endif
                                    <!-- Aksi Delete -->
                                    @if ($action == 'delete' && $delete_route)
                                        <button 
                                            wire:click="delete({{ $item->id }})" 
                                            class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 font-semibold transition duration-200"
                                            data-id="{{ $item->id }}" data-route="{{ str_replace('__id__', $item->id, $delete_route) }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $data->links('pagination::tailwind') }}
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('[data-id][data-route]').forEach(button => {
        button.addEventListener('click', function() {
            const recordId = this.getAttribute('data-id');
            const deleteUrl = this.getAttribute('data-route');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteUrl, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Dihapus!',
                                'Data telah dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Terjadi Kesalahan!',
                                'Terjadi kesalahan. Silakan coba lagi.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
