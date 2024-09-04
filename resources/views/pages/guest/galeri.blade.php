@extends('layouts.guest.main')
@section('title')
    Galeri
@endsection

@push('css')
    <style>
        .gallery-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-overlay i {
            color: white;
            font-size: 2rem;
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.1);
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-description {
            font-size: 0.9rem;
            line-height: 1.6;
            color: #666;
            overflow-y: auto;
            max-height: 200px;
            word-wrap: break-word;
            /* Adjust this value as needed */
            padding-right: 10px;
        }

        .gallery-description::-webkit-scrollbar {
            width: 5px;
        }

        .gallery-description::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .gallery-description::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        .gallery-description::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .gallery-details {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .gallery-details h6 {
            color: #555;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .modal-body {
        padding: 2rem;
        max-height: 80vh;
        overflow-y: auto;
    }
    </style>
@endpush

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
            <div class="gallery-container row">
                @foreach ($galleries as $index => $gallery)
                    <div class="col-lg-3 col-md-4 col-sm-6 gallery-item" data-aos="fade-up"
                        data-aos-delay="{{ 100 + $index * 50 }}">
                        <div class="card h-100 border-0 shadow-sm gallery-card" data-bs-toggle="modal"
                            data-bs-target="#galleryModal-{{ $gallery->id }}">
                            <div class="gallery-image-container">
                                <img src="{{ Storage::url('gallery/' . $gallery->image) }}" alt="{{ $gallery->name }}"
                                    class="card-img-top gallery-image">
                                <div class="gallery-overlay">
                                    <i class="ri-eye-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Gallery Modals -->
        @foreach ($galleries as $gallery)
            <div class="modal fade" id="galleryModal-{{ $gallery->id }}" tabindex="-1" role="dialog"
                aria-labelledby="galleryModalLabel-{{ $gallery->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="galleryModalLabel-{{ $gallery->id }}">{{ $gallery->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="{{ Storage::url('gallery/' . $gallery->image) }}" alt="{{ $gallery->name }}"
                                        class="img-fluid rounded">
                                </div>
                                <div class="col-md-4">
                                    <div class="gallery-details">
                                        <h6 class="mb-2">Kategori:</h6>
                                        <p class="text-muted mb-3">{{ $gallery->type_gallery->name }}</p>
                                        <h6 class="mb-2">Deskripsi:</h6>
                                        <div class="gallery-description">
                                            {!! $gallery->desc !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
