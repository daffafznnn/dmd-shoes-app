<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-4">
            @livewire('breadcrumb')
        </div>

        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">Buat Pengguna Baru</h1>
        </div>

        <div class="overflow-hidden w-full rounded-lg shadow-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800">
            <livewire:form-component 
                :model="$model"
                :action="$action"
                :fields="$fields"
                :rules="$rules"
                :options="$options" />
        </div>
    </div>
</x-app-layout>
