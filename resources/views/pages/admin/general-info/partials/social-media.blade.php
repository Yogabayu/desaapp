<div class="form-group">
    <label class="info-label" for="fb">Facebook:</label>
    @if ($generalInfo->fb)
        <p class="info-content">
            <a href="{{ $generalInfo->fb }}" target="_blank" class="social-link"><i class="fab fa-facebook-square"></i> {{ $generalInfo->fb }}</a>
        </p>
    @else
        <p class="info-content">Belum tersedia</p>
    @endif
</div>
<div class="form-group">
    <label class="info-label" for="wa">WhatsApp:</label>
    @if ($generalInfo->wa)
        <p class="info-content">
            <a href="{{ $generalInfo->wa }}" target="_blank" class="social-link"><i class="fab fa-whatsapp"></i> {{ $generalInfo->wa }}</a>
        </p>
    @else
        <p class="info-content">Belum tersedia</p>
    @endif
</div>
<div class="form-group">
    <label class="info-label" for="ig">Instagram:</label>
    @if ($generalInfo->ig)
        <p class="info-content">
            <a href="{{ $generalInfo->ig }}" target="_blank" class="social-link"><i class="fab fa-instagram"></i> {{ $generalInfo->ig }}</a>
        </p>
    @else
        <p class="info-content">Belum tersedia</p>
    @endif
</div>
<div class="form-group">
    <label class="info-label" for="ytb">YouTube:</label>
    @if ($generalInfo->ytb)
        <p class="info-content">
            <a href="{{ $generalInfo->ytb }}" target="_blank" class="social-link"><i class="fab fa-youtube"></i> {{ $generalInfo->ytb }}</a>
        </p>
    @else
        <p class="info-content">Belum tersedia</p>
    @endif
</div>