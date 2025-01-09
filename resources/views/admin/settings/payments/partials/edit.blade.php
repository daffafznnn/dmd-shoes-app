@foreach ($payments as $paymentMethod)
        <dialog id="editPaymentMethodModal{{ $paymentMethod->id }}" class="modal">
            <form method="POST" action="{{ route('admin.payment-methods.update', $paymentMethod) }}" class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
                @csrf
                @method('PUT')
                <h3 class="font-bold text-lg">{{ __('Edit Metode Pembayaran') }}</h3>
                <div class="mt-4 space-y-4">
                    <input type="text" name="name" value="{{ $paymentMethod->name }}"
                        placeholder="{{ __('Nama Metode Pembayaran') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
                    <textarea name="description" placeholder="{{ __('Deskripsi') }}" class="textarea textarea-bordered w-full bg-white dark:bg-darker" required>{{ $paymentMethod->description }}</textarea>
                    <select name="is_active" class="select select-bordered w-full bg-white dark:bg-darker" required>
                        <option value="1" {{ $paymentMethod->is_active == 1 ? 'selected' : '' }}>{{ __('Aktif') }}
                        </option>
                        <option value="0" {{ $paymentMethod->is_active == 0 ? 'selected' : '' }}>{{ __('Tidak Aktif') }}
                        </option>
                    </select>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                     <button class="btn" type="button"
                        onclick="document.getElementById('editPaymentMethodModal{{ $paymentMethod->id }}').close()">
                        {{ __('Batal') }}
                    </button>
                </div>
            </form>
        </dialog>
    @endforeach
