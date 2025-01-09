<dialog id="createSocialSettingModal" class="modal">
    <form method="POST" action="{{ route('admin.socials.store') }}" 
          class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
        @csrf
        <h3 class="font-bold text-lg">{{ __('Tambah Pengaturan Sosial Media') }}</h3>
        <div class="mt-4 space-y-4">
            <input type="text" name="name" placeholder="{{ __('Nama') }}" 
                   class="input input-bordered w-full bg-white text-gray-800 dark:bg-darker dark:text-gray-300" required>

            <!-- Select Icon -->
            <label for="icon-select-create" class="block mb-2 text-sm font-medium text-gray-800 dark:text-gray-300">
                {{ __('Icon') }}
            </label>
            <select id="icon-select-create" name="icon" class="tom-select w-full bg-white dark:bg-darker text-gray-800 dark:text-gray-300" required>
                <option value="" disabled selected>{{ __('Pilih Icon...') }}</option>
                @foreach ($bootstrapIcons as $icon)
                    <option value="{{ $icon }}">{{ $icon }}</option>
                @endforeach
            </select>

            <input type="text" name="url" placeholder="{{ __('URL') }}" 
                   class="input input-bordered w-full bg-white text-gray-800 dark:bg-darker dark:text-gray-300" required>
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
            <button type="button" class="btn" onclick="createSocialSettingModal.close()">{{ __('Batal') }}</button>
        </div>
    </form>
</dialog>
