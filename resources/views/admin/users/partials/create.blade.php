<dialog id="createUserModal" class="modal">
    <form method="POST" action="{{ route('admin.users.store') }}" class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
        @csrf
        <h3 class="font-bold text-lg text-gray-800 dark:text-gray-300">{{ __('Tambah Pengguna') }}</h3>
        <div class="mt-4 space-y-4">
            <input type="text" name="name" placeholder="{{ __('Nama Pengguna') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
            <input type="email" name="email" placeholder="{{ __('Email') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
            <select name="role" class="select select-bordered w-full bg-white dark:bg-darker" required>
                <option value="admin">{{ __('Admin') }}</option>
                <option value="superadmin">{{ __('Superadmin') }}</option>
            </select>
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
            <button type="button" class="btn" onclick="createUserModal.close()">{{ __('Batal') }}</button>
        </div>
    </form>
</dialog>
