@extends('layouts.admin.app')
@section('title', 'Galeri Desa')
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
                <h1>Galeri Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Galeri Desa</h2>
                <p class="section-lead">Manajemen Galeri desa.</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Galeri Desa</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('galery.create') }}" class="btn btn-primary">Tambah Galeri</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row background-row">
                                    @forelse ($data as $gallery)
                                        <div class="col-md-4 mb-4">
                                            <div class="card card-primary">
                                                <img src="{{ asset('storage/gallery/' . $gallery->image) }}"
                                                    class="card-img-top" alt="{{ $gallery->name }}" style="height: 10rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $gallery->name }}</h5>
                                                    <span
                                                        class="badge badge-primary mb-2">{{ $gallery->type_gallery->name }}</span>
                                                    <button onclick="toggleShowGallery('{{ $gallery->id }}')"
                                                        class="{{ $gallery->is_show ? 'btn btn-success' : 'btn btn-secondary' }}"
                                                        data-toggle="tooltip"
                                                        title="{{ $gallery->is_show ? 'Status: Ditampilkan' : 'Status: Disembunyikan' }}">
                                                        <i
                                                            class="{{ $gallery->is_show ? 'fas fa-eye' : 'fas fa-eye-slash' }}"></i>
                                                    </button>
                                                    {{-- <a href="{{ route('galery.edit', $gallery->uuid) }}" class="btn btn-warning">Edit</a> --}}
                                                    <button onclick="deleteGallery('{{ $gallery->id }}')"
                                                        class="btn btn-danger" data-toggle="tooltip" title="Hapus Gambar"><i
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
                                    @endforelse
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
