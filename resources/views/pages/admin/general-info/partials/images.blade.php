<div class="form-group">
    <label class="info-label" for="general_image">Gambar Umum:</label>
    @if ($generalInfo->general_image)
        <img src="{{ asset('storage/general_info/' . $generalInfo->general_image) }}" class="img-preview"
            alt="Gambar Umum Desa" style="max-width: 100%; height: auto;">
    @else
        <p class="info-content">Belum tersedia</p>
    @endif
</div>
<div class="form-group">
    <label class="info-label" for="logo">Logo Desa:</label>
    <p class="d-flex justify-content-center align-items-center">
        @if ($generalInfo->logo)
            <img src="{{ asset('storage/general_info/' . $generalInfo->logo) }}" class="img-preview" alt="Logo Desa"
                style="max-width: 150px; height: auto;">
        @else
            <p class="info-content">Belum tersedia</p>
        @endif
    </p>
</div>
