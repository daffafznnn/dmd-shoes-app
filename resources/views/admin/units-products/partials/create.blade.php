<dialog id="createUnitModal" class="modal">
    <form method="POST" action="{{ route('master.units.store') }}" class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
        @csrf
        <h3 class="font-bold text-lg text-gray-800 dark:text-gray-300">{{ __('Tambah Satuan') }}</h3>
        <div class="mt-4 space-y-4">
            <input type="text" name="name" placeholder="{{ __('Nama Satuan') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
            <input type="text" name="acronym" placeholder="{{ __('Singkatan') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
            <select name="status" class="select select-bordered w-full bg-white dark:bg-darker" required>
                <option value="1">{{ __('Aktif') }}</option>
                <option value="0">{{ __('Tidak Aktif') }}</option>
            </select>
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
            <button type="button" class="btn" onclick="createUnitModal.close()">{{ __('Batal') }}</button>
        </div>
    </form>
</dialog>

