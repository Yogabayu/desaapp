@extends('layouts.admin.app')
//TODO:  belum bisa
@section('title', 'Galeri Desa')

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
                                <div class="row">
                                    @forelse ($data as $gallery)
                                        <div class="col-md-4 mb-4">
                                            <div class="card card-primary">
                                                <img src="{{ asset('storage/gallery/' . $gallery->image) }}"
                                                    class="card-img-top" alt="{{ $gallery->name }}">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $gallery->name }}</h5>
                                                    <p class="card-text">{!! $gallery->desc !!}</p>
                                                    <button onclick="toggleShowGallery('{{ $gallery->id }}')"
                                                        class="{{ $gallery->is_show ? 'btn btn-success' : 'btn btn-secondary' }}"><i class="fas fa-eye"></i></button>
                                                    {{-- <a href="{{ route('galery.edit', $gallery->uuid) }}" class="btn btn-warning">Edit</a> --}}
                                                    <button onclick="deleteGallery('{{ $gallery->id }}')"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            // Send an AJAX request to update the is_show status
            $.ajax({
                url: "{{ route('galery.toggle-show') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    gallery_id: galleryId,
                },
                success: function(response) {
                    // Refresh the gallery list or update the gallery card
                    // You can use a variety of methods to update the UI
                    // {status: false, error: 'Undefined property: Illuminate\\Support\\Facades\\Request::$gallery_id'}
                    // For example, you might reload the page or use JavaScript to update the card directly
                    if (response.status) {
                        location.reload();
                    } else {
                        alert('Error updating gallery status.');
                    }
                },
                error: function(error) {
                    console.error(error);
                    alert('An error occurred. Please try again later.');
                }
            });
        }
    </script>
@endpush
