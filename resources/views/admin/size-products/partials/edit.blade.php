@foreach ($sizes as $size)
        <dialog id="editSizeProductModal{{ $size->id }}" class="modal">
            <form method="POST" action="{{ route('master.sizes.update', $size) }}" class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
                @csrf
                @method('PUT')
                <h3 class="font-bold text-lg">{{ __('Edit Ukuran') }}</h3>
                <div class="mt-4 space-y-4">
                    <input type="text" name="size_number" value="{{ $size->size_number }}"
                        placeholder="{{ __('Nomor Ukuran') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
                    <input type="text" name="size_chart" value="{{ $size->size_chart }}"
                        placeholder="{{ __('Bagan Ukuran') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
                    <select name="status" class="select select-bordered w-full bg-white dark:bg-darker" required>
                        <option value="1" {{ $size->status == 1 ? 'selected' : '' }}>{{ __('Aktif') }}
                        </option>
                        <option value="0" {{ $size->status == 0 ? 'selected' : '' }}>{{ __('Tidak Aktif') }}
                        </option>
                    </select>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                    <button class="btn" type="button"
                        onclick="document.getElementById('editSizeProductModal{{ $size->id }}').close()">
                        {{ __('Batal') }}
                    </button>
                </div>
            </form>
        </dialog>
    @endforeach
