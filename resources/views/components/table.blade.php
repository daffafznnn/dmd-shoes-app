<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                @foreach ($columns as $column)
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border border-gray-300">
                        {{ $column }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($data as $row)
                <tr>
                    @foreach ($columns as $key => $column)
                        <td class="px-4 py-2 text-sm text-gray-900 border border-gray-300">
                            {{ $row[$key] ?? '-' }}
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="px-4 py-2 text-center text-gray-500">
                        {{ $emptyMessage }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
