<div class="flex items-center space-x-2 text-gray-600 dark:text-gray-300">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($loop->first)
            <a href="{{ $breadcrumb['url'] }}" class="text-sm font-medium hover:text-blue-600 dark:hover:text-blue-400 flex items-center">
                <i class="bi bi-house-door-fill mr-1"></i> {{ $breadcrumb['label'] }}
            </a>
        @elseif ($loop->last)
            <span class="flex items-center text-sm font-medium text-blue-600 dark:text-blue-400">
                <i class="bi bi-chevron-right mx-2"></i> {{ $breadcrumb['label'] }}
            </span>
        @else
            <a href="{{ $breadcrumb['url'] }}" class="flex items-center text-sm font-medium hover:text-blue-600 dark:hover:text-blue-400">
                <i class="bi bi-chevron-right mx-2"></i> {{ $breadcrumb['label'] }}
            </a>
        @endif
    @endforeach
</div>
