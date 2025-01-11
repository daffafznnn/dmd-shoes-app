@if ($paginator->hasPages())
    <div class="flex justify-center items-center space-x-2 py-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="text-gray-500 cursor-not-allowed"><i class="fa-solid fa-circle-chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="text-green-500 hover:text-green-700"><i
                    class="fa-solid fa-circle-chevron-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @php
            $startPage = max($paginator->currentPage() - 2, 1); // Halaman mulai
            $endPage = min($paginator->currentPage() + 2, $paginator->lastPage()); // Halaman akhir
        @endphp

        @for ($i = $startPage; $i <= $endPage; $i++)
            @if ($i == $paginator->currentPage())
                <span class="bg-green-500 text-white px-3 py-1">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}"
                    class="text-green-500 hover:text-white hover:bg-green-500 px-3 py-1 rounded-md">{{ $i }}</a>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="text-green-500 hover:text-green-700"><i
                    class="fa-solid fa-circle-chevron-right"></i></a>
        @else
            <span class="text-gray-500 cursor-not-allowed"><i class="fa-solid fa-circle-chevron-right"></i></span>
        @endif
    </div>
@endif
