@extends('layouts.guest.main')
@section('title')
    {{ $umkm->name }} - UMKM Detail
@endsection

@push('css')
    <style>
        .carousel-item img {
            height: 25rem;
            object-fit: cover;
        }

        .umkm-description {
            line-height: 1.6;
            color: #333;
        }

        .umkm-info-card {
            position: sticky;
            top: 6.25rem;
            margin-bottom: 1.25rem;
        }

        .suggested-umkm-card {
            position: sticky;
            top: 18.25rem;
            margin-bottom: 1.25rem;
        }

        .review-item {
            border-bottom: .0625rem solid #eee;
            padding-bottom: .9375rem;
            margin-bottom: .9375rem;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .social-links .btn {
            margin-bottom: .625rem;
        }

        .suggested-umkm-item {
            display: flex;
            align-items: center;
            margin-bottom: .9375rem;
            padding-bottom: .9375rem;
            border-bottom: .0625rem solid #eee;
        }

        .suggested-umkm-item:last-child {
            border-bottom: none;
        }

        .suggested-umkm-item img {
            width: 3.75rem;
            height: 3.75rem;
            object-fit: cover;
            margin-right: .9375rem;
            border-radius: .3125rem;
        }

        @media (max-width: 61.9375rem) {

            .suggested-umkm-card {
                position: static;
                margin-top: 1.25rem;
            }

            .umkm-info-card {
                position: static;
                margin-top: 1.25rem;
            }
        }

        .umkm-title {
            display: flex;
            justify-content: center;
            color: #012970;
            transition: 0.3s;
        }

        .umkm-reviews {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        .review-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 5px;
        }

        .review-item h5 {
            margin-top: 0;
        }

        .review-item p {
            margin-bottom: 10px;
        }

        .review-item .text-muted {
            font-size: 0.9em;
            color: #888;
        }

        /* Styling untuk form */
        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('content')
    {{-- URUNG : summernote blm bisa --}}
    <div class="container my-5 mb-2">
        <div class="page-title-area bg-1 page-radius">
            <div class="container">
                <div class="page-title-content">
                    <h2 data-aos="fade-up">UMKM {{ $umkm->name }}</h2>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-8" style="box-shadow: 0 .25rem 1rem rgba(0, 0, 0, 0.1);">
                <!-- Image Carousel -->
                <div id="umkmCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @forelse($umkm->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url('umkm_images/' . $image->image) }}" class="d-block w-100"
                                    style="object-fit: contain;" alt="{{ $umkm->name }}">
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img src="{{ asset('frontend/assets/images/services/services-8.jpg') }}"
                                    class="d-block w-100" alt="Placeholder">
                            </div>
                        @endforelse
                    </div>
                    @if ($umkm->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#umkmCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#umkmCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>

                <div>
                    <h3 class="card-title umkm-title">
                        {{ $umkm->name }}
                    </h3>
                </div>

                <div class="d-flex justify-content-between m-2">
                    <div>
                        <a href="https://facebook.com/{{ $umkm->facebook }}" target="_blank" rel="noopener noreferrer">
                            <i class="ri-facebook-fill me-2"></i>
                        </a>
                        <a href="https://instagram.com/{{ $umkm->instagram }}" target="_blank" rel="noopener noreferrer">
                            <i class="ri-instagram-fill me-2"></i>
                        </a>
                        <a href="tel:{{ $umkm->phone }}">
                            <i class="ri-phone-fill me-2"></i>
                        </a>
                    </div>
                    <div>
                        {{ $umkm->created_at->format('d M Y') }}
                    </div>
                </div>

                <!-- Description -->
                <div class="card" style="text-indent: 1rem">
                    <div class="card-body">
                        <div class="card-text">{!! $umkm->desc !!}</div>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="mt-4">
                    <h4>Tulis Ulasan</h4>
                    <form action="{{ route('umkm.addReview', $umkm->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="umkm_id" value="{{ $umkm->id }}">
                        <div class="form-group row">
                            <div class="col">
                                <label for="name">Nama :</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Komentar Anda:</label>
                            {{-- <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea> --}}
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                        </div>
                    </form>
                </div>

                <h3>Ulasan</h3>
                <div class="umkm-reviews">
                    @forelse($reviews as $review)
                        <div class="review-item bg-light p-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <h5>{{ $review->name }}</h5>
                                <p class="text-muted">{{ $review->created_at->format('d M Y') }}</p>
                            </div>
                            <p>{!! $review->review !!}</p>
                        </div>
                    @empty
                        <p class="text-center text-muted">Belum ada ulasan untuk UMKM ini.</p>
                    @endforelse

                    <div class="d-flex justify-content-center mt-4">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card umkm-info-card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Informasi UMKM</h4>
                        <hr>
                        @if ($umkm->tlp)
                            <p><strong>Telepon:</strong> {{ $umkm->tlp }}</p>
                        @endif
                        <div class="social-links mt-3">
                            @if ($umkm->fb)
                                <a href="{{ $umkm->fb }}" target="_blank" class="btn btn-outline-primary me-2">
                                    <i class="ri-facebook-fill me-1"></i>
                                </a>
                            @endif
                            @if ($umkm->ig)
                                <a href="{{ $umkm->ig }}" target="_blank" class="btn btn-outline-danger">
                                    <i class="ri-instagram-fill me-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Suggested UMKMs -->
                <div class="card suggested-umkm-card ">
                    <div class="card-body">
                        <h4 class="card-title">UMKM Lainnya</h4>
                        <hr>
                        @foreach ($suggestedUmkms as $suggestedUmkm)
                            <div class="suggested-umkm-item" style="cursor: pointer; border-radius: 0.25rem; transition: 0.3s;"
                            onmouseover="this.style.border='1px solid #ccc'"
                            onmouseout="this.style.border='none'" onclick="window.location.href='{{ route('umkm.detail', $suggestedUmkm->slug) }}'">
                                <img src="{{ $suggestedUmkm->images->first() ? Storage::url('umkm_images/' . $suggestedUmkm->images->first()->image) : asset('frontend/assets/images/services/services-8.jpg') }}"
                                    alt="{{ $suggestedUmkm->name }}">
                                <div>
                                    <h6><a
                                            href="{{ route('umkm.detail', $suggestedUmkm->slug) }}">{{ $suggestedUmkm->name }}</a>
                                    </h6>
                                    <small>{{ $suggestedUmkm->village->name }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Now load Summernote -->
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#comment').summernote({
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
