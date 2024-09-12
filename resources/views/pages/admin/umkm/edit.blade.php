@extends('layouts.admin.app')

@section('title', 'UMKM Desa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit UMKM - {{ $umkm->name }}</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h4>Informasi UMKM</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset('storage/umkm_images/' . $umkm->images->first()->image) }}"
                                            alt="{{ $umkm->name }}" class="img-fluid rounded mb-3">
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Nama UMKM:</th>
                                                <td>{{ $umkm->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Desa:</th>
                                                <td>{{ $umkm->village->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Telepon:</th>
                                                <td><a href="#">{{ $umkm->tlp }}</a></td>
                                            </tr>
                                            <tr>
                                                <th>Facebook:</th>
                                                <td><a href="#" target="_blank"
                                                        rel="noopener noreferrer">{{ $umkm->fb }}</a></td>
                                            </tr>
                                            <tr>
                                                <th>Instagram:</th>
                                                <td><a href="#" target="_blank"
                                                        rel="noopener noreferrer">{{ $umkm->ig }}</a></td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>
                                                    {{-- @if ($umkm->is_active == 1) --}}
                                                    {{-- <span class="badge badge-success">Published</span> --}}
                                                    <button onclick="toggleShow('{{ $umkm->slug }}')"
                                                        class="{{ $umkm->is_active ? 'btn btn-success' : 'btn btn-secondary' }}"
                                                        data-toggle="tooltip"
                                                        title="{{ $umkm->is_active ? 'Status: Ditampilkan' : 'Status: Disembunyikan' }}">
                                                        @if ($umkm->is_active == 1)
                                                            <span class="badge badge-success">Published</span>
                                                        @else
                                                            <span class="badge badge-secondary">Draft</span>
                                                        @endif
                                                    </button>
                                                    {{-- @else
                                                        <span class="badge badge-secondary">Draft</span>
                                                    @endif --}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5>Deskripsi:</h5>
                                    <p>{!! $umkm->desc !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mt-4">
                            <div class="card-header">
                                <h4>Galeri UMKM</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($umkm->images as $image)
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <a href="{{ asset('storage/umkm_images/' . $image->image) }}"
                                                data-fancybox="gallery">
                                                <img src="{{ asset('storage/umkm_images/' . $image->image) }}"
                                                    alt="{{ $umkm->name }}" class="img-fluid rounded">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h4>Ulasan UMKM</h4>
                            </div>
                            <div class="card-body">
                                <!-- Add review form -->
                                <form action="{{ route('umkmreview.store', $umkm->id) }}" method="POST" class="mb-4">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="umkm_id" value="{{ $umkm->id }}">
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                    <div class="form-group">
                                        <label for="review_content">Tambahkan Ulasan</label>
                                        <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                                </form>

                                <!-- Display reviews -->
                                @if ($reviews->count() > 0)
                                    <div id="reviews-container">
                                        @include('pages.admin.umkm.components.review', ['reviews' => $reviews])
                                    </div>

                                    @if ($reviews->hasMorePages())
                                        <div class="text-center mt-3">
                                            <button id="load-more" class="btn btn-secondary" data-page="2"
                                                data-umkm="{{ $umkm->id }}">
                                                Load More
                                            </button>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-center text-muted">Belum ada ulasan untuk UMKM ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
    <style>
        .review-list {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });

        function toggleShow(slug) {
            $.ajax({
                url: "{{ route('umkmreview.toggle-show') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    slug: slug,
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

        $('#load-more').click(function() {
            var page = $(this).data('page');
            var umkmId = $(this).data('umkm');

            $.ajax({
                url: '{{ route('umkmreview.load-more') }}',
                method: 'GET',
                data: {
                    page: page,
                    umkm_id: umkmId
                },
                success: function(response) {
                    $('#reviews-container').append(response.html);
                    if (response.last_page == page) {
                        $('#load-more').hide();
                    } else {
                        $('#load-more').data('page', page + 1);
                    }
                },
                error: function(xhr) {
                    console.log('Error loading more reviews');
                }
            });
        });
    </script>
@endpush
