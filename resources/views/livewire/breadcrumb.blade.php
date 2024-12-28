<div class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($loop->first)
            <a href="{{ $breadcrumb['url'] }}" class="breadcrumb-item">
                <i class="bi bi-house-door-fill text-primary"></i>
                <span class="mr-2">{{ $breadcrumb['label'] }}</span>
            </a>
        @elseif ($loop->last)
            <span class="breadcrumb-item text-primary">
                <i class="bi bi-chevron-right mx-2"></i>
                <span class="">{{ $breadcrumb['label'] }}</span>
            </span>
        @else
            <a href="{{ $breadcrumb['url'] }}" class="breadcrumb-item">
                <i class="bi bi-chevron-right mx-2"></i>
                <span class="mr-2">{{ $breadcrumb['label'] }}</span>
            </a>
        @endif
    @endforeach
</div>
