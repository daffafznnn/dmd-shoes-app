@foreach ($shippings as $shipmentMethod)
        <dialog id="editShippingMethodModal{{ $shipmentMethod->id }}" class="modal">
            <form method="POST" action="{{ route('admin.shipping-methods.update', $shipmentMethod->id) }}" class="modal-box bg-white dark:bg-darker text-gray-800 dark:text-gray-300">
                @csrf
                @method('PUT')
                <h3 class="font-bold text-lg">{{ __('Edit Metode Pengiriman') }}</h3>
                <div class="mt-4 space-y-4">
                    <input type="text" name="name" value="{{ $shipmentMethod->name }}"
                        placeholder="{{ __('Nama Metode Pengiriman') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
                    <input type="number" step="0.01" name="cost" value="{{ $shipmentMethod->cost }}"
                        placeholder="{{ __('Biaya') }}" class="input input-bordered w-full bg-white dark:bg-darker" required>
                    <select name="is_active" class="select select-bordered w-full bg-white dark:bg-darker" required>
                        <option value="1" {{ $shipmentMethod->is_active == 1 ? 'selected' : '' }}>{{ __('Aktif') }}
                        </option>
                        <option value="0" {{ $shipmentMethod->is_active == 0 ? 'selected' : '' }}>{{ __('Tidak Aktif') }}
                        </option>
                    </select>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                   <button class="btn" type="button"
                        onclick="document.getElementById('editShippingMethodModal{{ $shipmentMethod->id }}').close()">
                        {{ __('Batal') }}
                    </button>
                </div>
            </form>
        </dialog>
    @endforeach

