@extends('layouts.admin.app')
@section('title', 'Product')
@push('style')
    <style>
        .background-row {
            border-radius: 10px;
            background: #e0e0e07a;
            padding: 10px;
        }

        .card-primary {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .badge-primary {
            background-color: #6777ef;
            color: white;
            padding: 0.4em 0.6em;
            font-size: 0.75em;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product</h2>
                <p class="section-lead">Manajemen Product</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Product</h4>
                                <div class="card-header-action">
                                    {{-- <a href="{{ route('galery.create') }}" class="btn btn-primary">Tambah Galeri</a> --}}

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#insertModal">
                                        Insert
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="insertModal" data-backdrop="false" data-keyboard="false"
                                        tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="insertModalLabel">Insert Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('product.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="form-group">
                                                            <label for="name">Nama Product</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ old('name') }}" required>
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
                                                            <input type="file" class="form-control" id="image"
                                                                name="image" accept="image/*" required>
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
                                                                    <select class="form-control" id="type_gallery_id"
                                                                        name="type_gallery_id" required>
                                                                        <option value="">Pilih Tipe</option>
                                                                        @foreach ($types as $type)
                                                                            <option value="{{ $type->id }}">
                                                                                {{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('type_id')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-2" data-toggle="tooltip"
                                                                    title="Tambah Tipe">
                                                                    <button class="btn btn-primary ml-2" data-toggle="modal"
                                                                        data-target="#addType">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type_id">Apakah akan ditampilkan</label>
                                                            <select class="form-control" id="is_show" name="is_show"
                                                                required>
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Understood</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row background-row">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button"
                                                        data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Collapsible Group Item #1
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#accordionExample">
                                                <div class="card-body">
                                                    Some placeholder content for the first accordion panel. This panel is
                                                    shown by default, thanks to the <code>.show</code> class.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @forelse ($data as $gallery)
                                <div class="col-md-4 mb-4">
                                    <div class="card card-primary">
                                        <img src="{{ asset('storage/gallery/' . $gallery->image) }}"
                                            class="card-img-top" alt="{{ $gallery->name }}" style="height: 10rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $gallery->name }}</h5>
                                            <span class="badge badge-primary mb-2">{{ $gallery->type_gallery->name
                                                }}</span>
                                            <button onclick="toggleShowGallery('{{ $gallery->id }}')"
                                                class="{{ $gallery->is_show ? 'btn btn-success' : 'btn btn-secondary' }}"
                                                data-toggle="tooltip"
                                                title="{{ $gallery->is_show ? 'Status: Ditampilkan' : 'Status: Disembunyikan' }}">
                                                <i
                                                    class="{{ $gallery->is_show ? 'fas fa-eye' : 'fas fa-eye-slash' }}"></i>
                                            </button>
                                            <button onclick="deleteGallery('{{ $gallery->id }}')" class="btn btn-danger"
                                                data-toggle="tooltip" title="Hapus Gambar"><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        Tidak ada galeri desa.
                                    </div>
                                </div>
                                @endforelse --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function deleteGallery(uuid) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('galery.destroy', '') }}/${uuid}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                // Refresh the page or update the gallery section dynamically
                                location.reload(); // Simplest approach, reload the page
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            toastr.error('An error occurred while deleting the gallery.');
                        }
                    });
                }
            });
        }

        function toggleShowGallery(galleryId) {
            $.ajax({
                url: "{{ route('galery.toggle-show') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    gallery_id: galleryId,
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.error('Error updating status.');
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred. Please try again later.');
                }
            });
        }
    </script>
@endpush
