<div class="login-brand">
    @if ($village->logo && Storage::disk('public')->exists('general_info/' . $village->logo))
        <img src="{{ asset('storage/general_info/' . $village->logo) }}" alt="logo" width="100"
            class="shadow-light rounded-circle">
    @else
        <img src="{{ asset('frontend/assets/images/ponorogo.png') }}" alt="logo" width="100"
            class="shadow-light rounded-circle">
    @endif
</div>