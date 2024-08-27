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
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name') }}" required>
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
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept="image/*" required>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="type_id">Tipe Gambar</label>
                                        <div class="row">

                                            <div class="col-md-10">
                                                <select class="form-control" id="type_gallery_id" name="type_gallery_id"
                                                    required>
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
                                            <div class="col-md-2" data-toggle="tooltip" title="Tambah Tipe">
                                                <button class="btn btn-primary ml-2" data-toggle="modal"
                                                    data-target="#addType">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
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

    <div class="modal fade" id="addType" tabindex="-1" role="dialog" aria-labelledby="addTypeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Tipe Galeri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addTypeForm">
                        @csrf
                        <div class="form-group">
                            <label for="typeName">Nama Tipe</label>
                            <input type="text" class="form-control" id="typeName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Tipe</button>
                    </form>
                    <hr>
                    <h6>Existing Types:</h6>
                    <ul id="typeList" class="list-group">
                        @foreach ($types as $type)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $type->name }}
                                <button class="btn btn-danger btn-sm deleteType"
                                    data-id="{{ $type->id }}">Delete</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
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

    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Add new type
            $('#addTypeForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('type-galery.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#type_gallery_id').append(new Option(response.type.name, response
                                .type.id));
                            $('#typeList').append(
                                `<li class="list-group-item d-flex justify-content-between align-items-center">
                                ${response.type.name}
                                <button class="btn btn-danger btn-sm deleteType" data-id="${response.type.id}">Delete</button>
                            </li>`
                            );
                            $('#typeName').val('');
                            toastr.success('Berhasil menambahkan tipe gambar');
                        } else {
                            toastr.error('error, ada gambar yang menggunakan tipe ini');
                        }
                    },
                    error: function() {
                        toastr.error('error, ada gambar yang menggunakan tipe ini');
                    }
                });
            });

            // Delete type
            $(document).on('click', '.deleteType', function() {
                var typeId = $(this).data('id');
                var listItem = $(this).closest('li');

                if (confirm('Apakah anda yakin menghapus tipe ini?')) {
                    $.ajax({
                        url: `/admin/type-galery/${typeId}`,
                        method: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                listItem.remove();
                                $(`#type_gallery_id option[value="${typeId}"]`).remove();
                                toastr.success('Tipe Gambar berhasil dihapus');
                            } else {
                                toastr.error('Error, Ada gambar yang menggunakan tipe ini');
                            }
                        },
                        error: function() {
                            toastr.error('Error, Ada gambar yang menggunakan tipe ini');
                        }
                    });
                }
            });
        });
    </script>
@endpush
