<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Pengaturan Aplikasi') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Pengaturan Umum -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300 mb-4">{{ __('Pengaturan Umum') }}</h3>
                        <div>
                            <fieldset class="space-y-2">
                                <legend class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Kunci Aplikasi') }}<span class="text-red-500">*</span></legend>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ __('Kolom ini penting sebagai kunci aplikasi. Isikan dengan benar dan jangan berikan kepada siapapun.') }}
                                </p>
                                <input type="text" name="app_key" id="app_key" class="input input-bordered w-full bg-white dark:bg-darker" value="{{ old('app_key') }}" required>
                            </fieldset>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nama Aplikasi') }}</label>
                                <input type="text" name="name" id="name" class="input input-bordered w-full bg-white dark:bg-darker" value="{{ old('name', $setting->name) }}">
                            </div>
                            <div>
                                <label for="alias" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Alias Aplikasi') }}</label>
                                <input type="text" name="alias" id="alias" class="input input-bordered w-full bg-white dark:bg-darker" value="{{ old('alias', $setting->alias) }}">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Deskripsi Aplikasi') }}</label>
                                <textarea name="description" id="description" class="input input-bordered w-full bg-white dark:bg-darker">{{ old('description', $setting->description) }}</textarea>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Email Kontak') }}</label>
                                <input type="email" name="email" id="email" class="input input-bordered w-full bg-white dark:bg-darker" value="{{ old('email', $setting->email) }}">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Nomor Telepon') }}</label>
                                <input type="text" name="phone" id="phone" class="input input-bordered w-full bg-white dark:bg-darker" value="{{ old('phone', $setting->phone) }}">
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Alamat') }}</label>
                                <input type="text" name="address" id="address" class="input input-bordered w-full bg-white dark:bg-darker" value="{{ old('address', $setting->address) }}">
                            </div>
                            <div>
                                <label for="latitude" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Latitude') }}</label>
                                <input type="text" name="latitude" id="latitude" class="input input-bordered w-full bg-white dark:bg-darker" value="{{ old('latitude', $setting->latitude) }}" readonly>
                            </div>
                            <div>
                                <label for="longitude" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Longitude') }}</label>
                                <input type="text" name="longitude" id="longitude" class="input input-bordered w-full bg-white dark:bg-darker" value="{{ old('longitude', $setting->longitude) }}" readonly>
                            </div>
                            <div class="md:col-span-2">
                                <label for="is_maintenance" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Status Pemeliharaan') }}</label>
                                <select name="is_maintenance" id="is_maintenance" class="select select-bordered w-full bg-white dark:bg-darker">
                                    <option value="1" {{ old('is_maintenance', $setting->is_maintenance) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_maintenance', $setting->is_maintenance) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label for="location-search" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Cari Lokasi') }}</label>
                                <input type="text" id="location-search" class="input input-bordered w-full bg-white dark:bg-darker" placeholder="Cari lokasi...">
                            </div>
                            <div class="md:col-span-2">
                                <div id="map" class="w-full h-96 rounded-lg overflow-hidden"></div>
                            </div>
                            <!-- Upload Logo -->
                            <div class="form-control">
                                <label class="label" for="logo">
                                    <span class="label-text">{{ __('Logo') }}</span>
                                </label>
                                <input type="file" name="logo" id="logo" class="file-input w-full bg-white dark:bg-darker" accept="image/*">
                                @if ($setting->logo)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($setting->logo) }}" alt="Logo" class="mask mask-squircle w-24 h-24">
                                    </div>
                                @endif
                            </div>

                            <!-- Upload Favicon -->
                            <div class="form-control">
                                <label class="label" for="favicon">
                                    <span class="label-text">{{ __('Favicon') }}</span>
                                </label>
                                <input type="file" name="favicon" id="favicon" class="file-input w-full bg-white dark:bg-darker" accept="image/*">
                                @if ($setting->favicon)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($setting->favicon) }}" alt="Favicon" class="mask mask-squircle w-12 h-12">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('admin.settings.edit') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Pengaturan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const latitudeInput = document.getElementById('latitude');
                const longitudeInput = document.getElementById('longitude');
                const searchInput = document.getElementById('location-search');

                const map = L.map('map').setView([{{ $setting->latitude ?? -6.200000 }}, {{ $setting->longitude ?? 106.816666 }}], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                const marker = L.marker([{{ $setting->latitude ?? -6.200000 }}, {{ $setting->longitude ?? 106.816666 }}], { draggable: true }).addTo(map);

                marker.on('dragend', function (e) {
                    const position = marker.getLatLng();
                    latitudeInput.value = position.lat;
                    longitudeInput.value = position.lng;
                });

                searchInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        fetch(`https://nominatim.openstreetmap.org/search?q=${searchInput.value}&format=json&addressdetails=1&limit=1`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.length > 0) {
                                    const location = data[0];
                                    const lat = parseFloat(location.lat);
                                    const lon = parseFloat(location.lon);

                                    map.setView([lat, lon], 13);
                                    marker.setLatLng([lat, lon]);

                                    latitudeInput.value = lat;
                                    longitudeInput.value = lon;
                                }
                            });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
