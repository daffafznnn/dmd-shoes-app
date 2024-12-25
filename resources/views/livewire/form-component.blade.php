<div class="p-6">
    <!-- Form Submission -->
    <form wire:submit.prevent="save">
        @foreach($fields as $field => $type)
            <div class="mb-4">
                <!-- Label -->
                <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ ucfirst($field) }}
                </label>

                <!-- Input Fields -->
                @if($type == 'text' || $type == 'email' || $type == 'password')
                    <input 
                        type="{{ $type }}" 
                        id="{{ $field }}" 
                        wire:model="formData.{{ $field }}" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-indigo-500"
                    >
                @elseif($type == 'select')
                    <select 
                        id="{{ $field }}" 
                        wire:model="formData.{{ $field }}" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-indigo-500"
                    >
                        <option value="" disabled>Select {{ ucfirst($field) }}</option>
                        @foreach($options[$field] as $value => $label)
                            <option value="{{ $value }}" @selected($formData[$field] == $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                @endif

                <!-- Validation Errors -->
                @error("formData.{$field}")
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        @endforeach

        <!-- Submit Button -->
        <div class="mt-4 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">
                {{ $recordId ? 'Update User' : 'Create User' }}
            </button>
        </div>
    </form>
</div>
