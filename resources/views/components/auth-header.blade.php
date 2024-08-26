<div class="login-brand">
    @if ($general->logo && Storage::disk('public')->exists('general_info/' . $general->logo))
        <img src="{{ asset('storage/general_info/' . $general->logo) }}" alt="logo" width="100"
            class="shadow-light rounded-circle">
    @else
        <img src="{{ asset('frontend/assets/images/ponorogo.png') }}" alt="logo" width="100"
            class="shadow-light rounded-circle">
    @endif
</div>