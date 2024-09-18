@extends('layouts.guest.main')
@section('title')
    UMKM
@endsection

@push('css')
    <style>
        .umkm-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .umkm-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .umkm-card .card-img-top {
            height: 200px;
            object-fit: contain;
        }

        .umkm-card .card-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .umkm-card .card-text {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .umkm-card .card-footer {
            background-color: transparent;
            border-top: 1px solid rgba(0, 0, 0, .125);
        }

        .umkm-card .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
        }

        .umkm-card .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .page-title-area {
            background-color: #f8f9fa;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .page-title-content h2 {
            font-weight: bold;
            color: #333;
        }
    </style>
@endpush

@section('content')
    <div class="container my-5">
        <div class="page-title-area bg-1 page-radius">
            <div class="container">
                <div class="page-title-content">
                    <h2 data-aos="fade-up">UMKM Desa</h2>
                </div>
            </div>
        </div>

        <div class="umkm-list mt-5">
            <div class="row">
                @forelse($umkmList as $umkm)
                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" onclick="window.location.href='{{ route('umkm.detail', $umkm->slug) }}'" style="cursor: pointer;">
                        <div class="card h-100 umkm-card">
                            @if ($umkm->images->isNotEmpty())
                                <img src="{{ Storage::url('umkm_images/' . $umkm->images->first()->image) }}" class="card-img-top"
                                    alt="{{ $umkm->name }}">
                            @else
                                <img src="{{ asset('frontend/assets/images/services/services-8.jpg') }}" class="card-img-top"
                                    alt="Placeholder">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $umkm->name }}</h5>
                                {{-- <p class="card-text">{!! Str::limit($umkm->desc, 100) }}</p> --}}
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- <div class="btn-group">
                                        <a href="{{ route('umkm.detail', $umkm->slug) }}"
                                            class="btn btn-sm btn-outline-secondary">View</a>
                                    </div> --}}
                                    <small class="text-muted">{{ $umkm->village->name }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Tidak ada data UMKM saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $umkmList->links() }}
        </div>
    </div>
@endsection
