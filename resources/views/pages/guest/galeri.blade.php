@extends('layouts.guest.main')
@section('title')
    Galeri
@endsection

@section('content')
    <!-- Start Gallery Area -->
    <div class="container my-5">
        <div class="page-title-area bg-1 page-radius">
            <div class="container">
                <div class="page-title-content">
                    <h2 data-aos="fade-up">Galeri Foto</h2>
                </div>
            </div>
        </div>
        <div class="container mt-2">
            {{-- <div class="gallery-menu">
                <ul class="nav justify-content-center">
                    @foreach (['Pertanian', 'Pemukiman', 'Kesehatan', 'Pendidikan', 'All'] as $kategori)
                        <li class="nav-item">
                            <a class="nav-link {{ $kategori == 'All' ? 'active' : '' }}" href="#"
                                data-filter=".{{ $kategori == 'All' ? 'all' : strtolower($kategori) }}">{{ $kategori }}</a>
                        </li>
                    @endforeach
                </ul>
            </div> --}}

            <div class="gallery-container row">
                @foreach (['Pertanian', 'Pemukiman', 'Kesehatan', 'Pendidikan'] as $kategori)
                    @foreach (range(1, 4) as $index)
                        <div class="col-lg-3 col-md-4 col-sm-6 gallery-item {{ strtolower($kategori) }}" data-aos="fade-up" data-aos-delay="<?php echo (100 + ($index * 50)); ?>">
                            <div class="card h-100 border-0 shadow-sm" data-bs-toggle="modal"
                                data-bs-target="#galleryModal-{{ $kategori }}-{{ $index }}">
                                <img src="{{ asset('frontend/assets/images/gallery/gallery-' . $index . '.jpg') }}"
                                    alt="Gallery Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="gallery-overlay">
                                    <i class="ri-eye-fill"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Start Gallery Modal Area -->
        @foreach (['Pertanian', 'Pemukiman', 'Kesehatan', 'Pendidikan'] as $kategori)
            @foreach (range(1, 4) as $index)
                <div class="modal fade" id="galleryModal-{{ $kategori }}-{{ $index }}" tabindex="-1"
                    role="dialog" aria-labelledby="galleryModalLabel-{{ $kategori }}-{{ $index }}"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('frontend/assets/images/gallery/gallery-' . $index . '.jpg') }}"
                                    alt="Gallery Image" class="img-fluid">
                            </div>
                            <div class="modal-footer justify-content-center">
                                <h5>Keterangan Foto {{ $kategori }} {{ $index }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach

    </div>
    <!-- End Gallery Modal Area -->
    <!-- End Gallery Area -->
@endsection
