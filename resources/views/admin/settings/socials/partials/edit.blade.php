@foreach ($socials as $socialSetting)
    <dialog id="editSocialSettingModal{{ $socialSetting->id }}" class="modal">
        <form method="POST" action="{{ route('admin.socials.update', $socialSetting->id) }}" 
              class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
            @csrf
            @method('PUT')
            <h3 class="font-bold text-lg">{{ __('Edit Pengaturan Sosial Media') }}</h3>
            <div class="mt-4 space-y-4">
                <input type="text" name="name" value="{{ $socialSetting->name }}" 
                       placeholder="{{ __('Nama') }}" 
                       class="input input-bordered w-full bg-white text-gray-800 dark:bg-darker dark:text-gray-300" required>

                <!-- Select Icon -->
                <label for="icon-select-{{ $socialSetting->id }}" class="block mb-2 text-sm font-medium text-gray-800 dark:text-gray-300">
                    {{ __('Icon') }}
                </label>
                <select id="icon-select-{{ $socialSetting->id }}" name="icon" 
                        class="tom-select w-full bg-white dark:bg-darker text-gray-800 dark:text-gray-300" required>
                    <option value="" disabled>{{ __('Pilih Icon...') }}</option>
                    @foreach ($bootstrapIcons as $icon)
                        <option value="{{ $icon }}" {{ $socialSetting->icon === $icon ? 'selected' : '' }}>
                            {{ $icon }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="url" value="{{ $socialSetting->url }}" 
                       placeholder="{{ __('URL') }}" 
                       class="input input-bordered w-full bg-white text-gray-800 dark:bg-darker dark:text-gray-300" required>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                <button type="button" class="btn" 
                        onclick="document.getElementById('editSocialSettingModal{{ $socialSetting->id }}').close()">
                    {{ __('Batal') }}
                </button>
            </div>
        </form>
    </dialog>
@endforeach
