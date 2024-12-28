@foreach ($units as $unit)
<dialog id="editUnitModal{{ $unit->id }}" class="modal">
    <form method="POST" action="{{ route('master.units.update', $unit) }}" class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
        @csrf
        @method('PUT')
        <h3 class="font-bold text-lg">{{ __('Edit Satuan') }}</h3>
        <div class="mt-4 space-y-4">
            <input type="text" name="name" value="{{ $unit->name }}"
                placeholder="{{ __('Nama Satuan') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
            <input type="text" name="acronym" value="{{ $unit->acronym }}"
                placeholder="{{ __('Singkatan') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
            <select name="status" class="select select-bordered w-full bg-white dark:bg-darker" required>
                <option value="1" {{ $unit->status == 1 ? 'selected' : '' }}>{{ __('Aktif') }}
                </option>
                <option value="0" {{ $unit->status == 0 ? 'selected' : '' }}>{{ __('Tidak Aktif') }}
                </option>
            </select>
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
            <button type="button" class="btn"
                onclick="document.getElementById('editUnitModal{{ $unit->id }}').close()">{{ __('Batal') }}</button>
        </div>
    </form>
</dialog>
@endforeach
