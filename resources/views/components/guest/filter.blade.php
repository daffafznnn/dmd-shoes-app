<div class="filters text-center bg-white dark:bg-darker h-auto">
    <div class="mx-auto flex w-full justify-center pt-6 sm:max-w-[640px] md:max-w-[768px] lg:max-w-[1024px] xl:max-w-[1280px] 2xl:max-w-[1536px] items-center">
        <div class="w-full p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" x-data="filters()">

                <!-- Category Filter -->
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                    <select id="category" x-model="category" @change="submitFilter" class="select select-bordered w-full bg-white dark:bg-darker">
                        <option value="">{{ __('Select Category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Type Filter -->
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                    <select id="type" x-model="type" @change="submitFilter" class="select select-bordered w-full bg-white dark:bg-darker">
                        <option value="">{{ __('Select Type') }}</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Material Filter -->
                <div class="mb-4">
                    <label for="material" class="block text-sm font-medium text-gray-700">{{ __('Material') }}</label>
                    <select id="material" x-model="material" @change="submitFilter" class="select select-bordered w-full bg-white dark:bg-darker">
                        <option value="">{{ __('Select Material') }}</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function filters() {
            return {
                category: '{{ request()->get('category', '') }}',
                type: '{{ request()->get('keyword', '') }}',
                material: '{{ request()->get('material', '') }}',

                submitFilter() {
                    const url = new URL(window.location.href);

                    if (this.category) {
                        url.searchParams.set('category', this.category);
                    } else {
                        url.searchParams.delete('category');
                    }

                    if (this.type) {
                        url.searchParams.set('keyword', this.type);
                    } else {
                        url.searchParams.delete('keyword');
                    }

                    if (this.material) {
                        url.searchParams.set('material', this.material);
                    } else {
                        url.searchParams.delete('material');
                    }

                    window.location.href = url;
                }
            };
        }
    </script>
@endpush

