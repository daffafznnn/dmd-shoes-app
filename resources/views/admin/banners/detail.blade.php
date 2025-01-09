<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Breadcrumb -->
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Detail Banner') }}</h1>
        </div>

        <!-- Session Alert -->
        <x-session-alert />

        <!-- Informasi Banner -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Informasi Banner') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Kolom Kiri -->
                    <div class="space-y-2">
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Nama Banner:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white font-semibold">{{ $banner->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Gambar Banner:') }}</span>
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                    </div>
                    <!-- Kolom Kanan -->
                    <div class="space-y-2">
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Target URL:') }}</span>
                            <p class="text-lg text-gray-800 dark:text-white">{{ $banner->target_url }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Status Banner:') }}</span>
                            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                                {{ $banner->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $banner->status ? __('Aktif') : __('Nonaktif') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Meta Banner -->
        <div class="card bg-white shadow-lg border dark:border-primary-darker dark:bg-darker mt-6">
            <div class="card-body">
                <h2 class="card-title text-gray-800 dark:text-white">{{ __('Meta Banner') }}</h2>
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Meta Title Banner:') }}</span>
                        <p class="text-lg text-gray-800 dark:text-white">{{ $banner->meta_title }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Meta Description Banner:') }}</span>
                        <p class="text-lg text-gray-800 dark:text-white">{{ $banner->meta_description }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Meta Keywords Banner:') }}</span>
                        <p class="text-lg text-gray-800 dark:text-white">{{ $banner->meta_keywords }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Tanggal Mulai Banner:') }}</span>
                        <p class="text-lg text-gray-800 dark:text-white">{{ $banner->start_date ? \Carbon\Carbon::parse($banner->start_date)->format('d-m-Y') : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ __('Tanggal Selesai Banner:') }}</span>
                        <p class="text-lg text-gray-800 dark:text-white">{{ $banner->end_date ? \Carbon\Carbon::parse($banner->end_date)->format('d-m-Y') : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('master.banners.index') }}" class="btn btn-primary">{{ __('Kembali ke Daftar Banner') }}</a>
        </div>
    </div>
</x-app-layout>

