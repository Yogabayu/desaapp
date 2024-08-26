@extends('layouts.admin.app')

@section('title', 'Tambah Galeri Desa')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Galeri Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Tambah Galeri Desa</h2>
                <p class="section-lead">Form untuk menambahkan galeri desa.</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Galeri</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('galery.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Nama Galeri</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Deskripsi</label>
                                        <textarea class="form-control" id="desc" name="desc">{{ old('desc') }}</textarea>
                                        @error('desc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="type_id">Tipe Galeri</label>
                                        <select class="form-control" id="type_gallery_id" name="type_gallery_id" required>
                                            <option value="">Pilih Tipe</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('type_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="type_id">Apakah akan ditampilkan</label>
                                        <select class="form-control" id="is_show" name="is_show" required>
                                            <option value="">Pilih status</option>
                                            <option value='1'>Ditampilkan</option>
                                            <option value='0'>Disembunyikan</option>
                                        </select>
                                        @error('type_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


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