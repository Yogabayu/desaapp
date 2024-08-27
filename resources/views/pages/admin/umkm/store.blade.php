@extends('layouts.admin.app')

@section('title', 'Tambah UMKM di Desa')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqk1w27JHDn40mePbL+c9SDP7j2L49Z2mEzzulLBgTlE+y7+BQ+cNJ9V+ZAK/5sOH37PCaAL/sM="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><i class="fas fa-store"></i> UMKM Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fas fa-plus-circle"></i> Tambah UMKM</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row mb-3">
                                        <label for="name" class="col-sm-2 col-form-label">
                                            <i class="fas fa-user"></i> Nama UMKM
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="tlp" class="col-sm-2 col-form-label">
                                            <i class="fas fa-phone-alt"></i> Telepon/WhatsApp
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('tlp') is-invalid @enderror"
                                                id="tlp" name="tlp" value="{{ old('tlp') }}">
                                            @error('tlp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="fb" class="col-sm-2 col-form-label">
                                            <i class="fab fa-facebook-square"></i> Facebook
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('fb') is-invalid @enderror"
                                                id="fb" name="fb" value="{{ old('fb') }}">
                                            @error('fb')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="ig" class="col-sm-2 col-form-label">
                                            <i class="fab fa-instagram-square"></i> Instagram
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('ig') is-invalid @enderror"
                                                id="ig" name="ig" value="{{ old('ig') }}">
                                            @error('ig')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="desc" class="col-sm-2 col-form-label">
                                            <i class="fas fa-info-circle"></i> Deskripsi UMKM
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc">{{ old('desc') }}</textarea>
                                            @error('desc')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="is_active" class="col-sm-2 col-form-label">
                                            <i class="fas fa-toggle-on"></i> Status
                                        </label>
                                        <div class="col-sm-10">
                                            <select class="form-control @error('is_active') is-invalid @enderror" id="is_active"
                                                name="is_active">
                                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Draft
                                                </option>
                                                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>
                                                    Published</option>
                                            </select>
                                            @error('is_active')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="images" class="col-sm-2 col-form-label">
                                            <i class="fas fa-image"></i> Thumbnail
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="file"
                                                class="form-control-file @error('images') is-invalid @enderror"
                                                id="images" name="images[]" multiple accept="image/*">
                                            @error('images')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endSection

@push('scripts')
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#desc').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                    ['fontsize', ['fontsize']],
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32',
                    '36'
                ],
            });
        });
    </script>
@endpush