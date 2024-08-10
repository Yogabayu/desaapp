<div class="section-header-breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($loop->last)
            <div class="breadcrumb-item">{{ $breadcrumb['name'] }}</div>
        @else
            <div class="breadcrumb-item active"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></div>
        @endif
    @endforeach
</div>