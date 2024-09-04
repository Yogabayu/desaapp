@extends('layouts.guest.main')
@section('title')
    {{ $umkm->name }} - UMKM Detail
@endsection

@push('css')
    <style>
        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }

        .umkm-description {
            line-height: 1.6;
            color: #333;
        }

        .umkm-info-card, .suggested-umkm-card {
            position: sticky;
            top: 20px;
            margin-bottom: 20px;
        }

        .review-item {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .social-links .btn {
            margin-bottom: 10px;
        }

        .suggested-umkm-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .suggested-umkm-item:last-child {
            border-bottom: none;
        }

        .suggested-umkm-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 5px;
        }

        @media (max-width: 991px) {
            .umkm-info-card, .suggested-umkm-card {
                position: static;
                margin-top: 20px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container my-5 mb-2">
        <div class="page-title-area bg-1 page-radius">
            <div class="container">
                <div class="page-title-content">
                    <h2 data-aos="fade-up">UMKM {{ $umkm->name }}</h2>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-8">
                <!-- Image Carousel -->
                <div id="umkmCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @forelse($umkm->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url('umkm_images/' . $image->image) }}" class="d-block w-100" style="object-fit: contain;" alt="{{ $umkm->name }}">
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img src="{{ asset('frontend/assets/images/services/services-8.jpg') }}" class="d-block w-100" alt="Placeholder">
                            </div>
                        @endforelse
                    </div>
                    @if ($umkm->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#umkmCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#umkmCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>

                

                <!-- Description -->
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Deskripsi</h4>
                    <hr>
                    <div class="card-text">{!! $umkm->desc !!}</div>
                  </div>
                </div>

                <!-- Reviews -->
                <h3>Ulasan</h3>
                <div class="umkm-reviews">
                    @forelse($umkm->reviews as $review)
                        <div class="review-item">
                            <h5>{{ $review->name }}</h5>
                            <p class="text-muted">{{ $review->created_at->format('d M Y') }}</p>
                            <p>{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p>Belum ada ulasan untuk UMKM ini.</p>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card umkm-info-card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Informasi UMKM</h4>
                        <p><strong>Desa:</strong> {{ $village->name }}</p>
                        @if ($umkm->tlp)
                            <p><strong>Telepon:</strong> {{ $umkm->tlp }}</p>
                        @endif
                        <div class="social-links mt-3">
                            @if ($umkm->fb)
                                <a href="{{ $umkm->fb }}" target="_blank" class="btn btn-outline-primary me-2">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                            @endif
                            @if ($umkm->ig)
                                <a href="{{ $umkm->ig }}" target="_blank" class="btn btn-outline-danger">
                                    <i class="fab fa-instagram"></i> Instagram
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Suggested UMKMs -->
                <div class="card suggested-umkm-card">
                    <div class="card-body">
                        <h4 class="card-title">UMKM Lainnya</h4>
                        @foreach($suggestedUmkms as $suggestedUmkm)
                            <div class="suggested-umkm-item">
                                <img src="{{ $suggestedUmkm->images->first() ? Storage::url('umkm_images/' . $suggestedUmkm->images->first()->image) : asset('frontend/assets/images/services/services-8.jpg') }}" alt="{{ $suggestedUmkm->name }}">
                                <div>
                                    <h6><a href="{{ route('umkm.show', $suggestedUmkm->slug) }}">{{ $suggestedUmkm->name }}</a></h6>
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