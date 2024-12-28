@foreach ($users as $user)
    <dialog id="editUserModal{{ $user->id }}" class="modal">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
            @csrf
            @method('PUT')
            <h3 class="font-bold text-lg">{{ __('Edit Pengguna') }}</h3>
            <div class="mt-4 space-y-4">
                <input type="text" name="name" value="{{ $user->name }}"
                    placeholder="{{ __('Nama Pengguna') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
                <input type="email" name="email" value="{{ $user->email }}"
                    placeholder="{{ __('Email') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
                <select name="role" class="select select-bordered w-full bg-white dark:bg-darker" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}
                    </option>
                    <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>{{ __('Superadmin') }}
                    </option>
                </select>
                <input type="password" name="password" placeholder="{{ __('Password Baru') }}"
                    class="input input-bordered w-full bg-white dark:bg-darker">
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                <button class="btn" type="button"
                    onclick="document.getElementById('editUserModal{{ $user->id }}').close()">
                    {{ __('Batal') }}
                </button>
            </div>
        </form>
    </dialog>
@endforeach
