<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb Section -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Title Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Daftar Sosial Media') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <div class="mb-6">
            <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
                <div class="card-body">
                    <form action="{{ route('admin.socials.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="col-span-1 lg:col-span-2 space-y-2">
                                <input type="text" name="search" id="search"
                                    class="input input-bordered w-full bg-white dark:bg-darker"
                                    placeholder="{{ __('Cari berdasarkan nama sosial media') }}"
                                    value="{{ request()->query('search') }}">
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                                <a href="{{ route('admin.socials.index') }}"
                                    class="btn btn-secondary">{{ __('Reset') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex justify-end mb-4">
            <button class="btn btn-primary"
                onclick="createSocialSettingModal.showModal()">{{ __('Tambah Sosial Media') }}</button>
        </div>

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
                                <th>
                                    #
                                </th>
                                <th>{{ __('Nama') }}</th>
                                <th>{{ __('Ikon') }}</th>
                                <th>{{ __('URL') }}</th>
                                <th>{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($socials as $social)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <th>
                                        <span class="text-gray-800 dark:text-gray-300">{{ $loop->iteration }}</span>
                                    </th>
                                    <td class="text-gray-800 dark:text-gray-300">{{ $social->name }}</td>
                                    <td class="text-gray-800 dark:text-gray-300">{{ $social->icon }} <span><i class="{{ $social->icon }}"></i></span></td>
                                    <td class="text-gray-800 dark:text-gray-300"><a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">{{ $social->url }}&ensp;<i class="bi bi-box-arrow-up-right"></i></a></td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="btn btn-primary btn-xs"
                                                onclick="document.getElementById('editSocialSettingModal{{ $social->id }}').showModal()">
                                                {{ __('Edit') }}
                                            </button>

                                            <button
                                                onclick="deleteSocial('{{ route('admin.socials.destroy', ['id' => $social->id]) }}')"
                                                class="btn btn-secondary btn-xs">
                                                {{ __('Delete') }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-800 dark:text-gray-300">
                                        {{ __('Tidak ada sosial media ditemukan.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="mt-6">
            {{ $socials->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Create Social Modal -->
    @include('admin.settings.socials.partials.create', ['bootstrapIcons' => $bootstrapIcons])

    <!-- Edit Social Modals -->
    @include('admin.settings.socials.partials.edit', ['socials' => $socials, 'bootstrapIcons' => $bootstrapIcons])
</x-app-layout>

<script>
    function deleteSocial(url) {
        // Menggunakan SweetAlert untuk konfirmasi penghapusan
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Sosial media ini akan dihapus secara permanen.',
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
  // Aktifkan Tom Select untuk semua elemen select dengan class "tom-select"
  document.addEventListener('DOMContentLoaded', () => {
      const selects = document.querySelectorAll('.tom-select');
      selects.forEach(select => {
          new TomSelect(select, {
              placeholder: "Pilih Icon...",
              allowEmptyOption: true,
              searchField: ["text"],
              options: [
                  @foreach ($bootstrapIcons as $icon)
                      { value: '{{ $icon }}', text: '{{ $icon }}' },
                  @endforeach
              ],
          });
      });
  });

</script>
