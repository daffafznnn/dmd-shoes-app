<x-app-layout>
  <div class="container mx-auto px-6 py-8">
    <!-- Breadcrumb Section -->
    <div class="mb-4">
      @livewire('breadcrumb')
    </div>

    <!-- Title Section -->
    <div class="mb-6">
      <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">Tambah Pengguna</h1>
    </div>

    <!-- Form Section -->
    <div class="overflow-hidden w-full rounded-lg shadow-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800">
      <!-- Livewire Form -->
      {{-- <livewire:edit-user-form :user="$user" /> --}}
    </div>
  </div>
</x-app-layout>