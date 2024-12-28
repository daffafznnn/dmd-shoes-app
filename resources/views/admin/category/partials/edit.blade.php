@foreach ($categories as $category)
        <dialog id="editCategoryModal{{ $category->id }}" class="modal">
            <form method="POST" action="{{ route('master.categories.update', $category) }}" class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
                @csrf
                @method('PUT')
                <h3 class="font-bold text-lg">{{ __('Edit Kategori') }}</h3>
                <div class="mt-4 space-y-4">
                    <input type="text" name="name" value="{{ $category->name }}"
                        placeholder="{{ __('Nama Kategori') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
                    <select name="status" class="select select-bordered w-full bg-white dark:bg-darker" required>
                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>{{ __('Aktif') }}
                        </option>
                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>{{ __('Tidak Aktif') }}
                        </option>
                    </select>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                    <button class="btn" type="button"
                        onclick="document.getElementById('editCategoryModal{{ $category->id }}').close()">
                        {{ __('Batal') }}
                    </button>
                </div>
            </form>
        </dialog>
    @endforeach