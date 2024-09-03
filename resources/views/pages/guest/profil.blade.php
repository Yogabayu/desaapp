@extends('layouts.guest.main')
@section('title')
    Profil Desa Sejahtera
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .page-radius {
            border-radius: 10px !important;
        }

        .section-header {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 30px;
            position: relative;
        }

        .section-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            position: relative;
            padding-bottom: 15px;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            display: block;
            width: 50px;
            height: 3px;
            background: #4CAF50;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .data-item {
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .data-item:hover {
            background-color: #f8f9fa;
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .data-item i {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.1);
            margin-right: 15px;
        }

        .data-item h6 {
            font-weight: 600;
        }

        .text-black {
            color: #000;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <div class="page-title-area bg-1 page-radius">
            <div class="container">
                <div class="page-title-content">
                    <h2 data-aos="fade-up">Profil Desa</h2>
                </div>
            </div>
        </div>

        <div class="row mb-5 mt-5">
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow" data-aos="fade-right">
                    <div class="section-header">
                        <h2>Sekilas Desa</h2>
                    </div>
                    <img src="{{ asset('frontend/assets/images/sawah.png') }}" alt="Foto Udara Desa" class="card-img-top"
                        style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        {{-- <p class="card-text">Desa Sejahtera didirikan pada tahun 1850 oleh sekelompok petani yang mencari
                            tanah subur untuk bercocok tanam. Sejak saat itu, desa ini telah berkembang menjadi komunitas
                            yang makmur dan harmonis.</p> --}}
                        {!! $village->short_desc !!}
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow" data-aos="fade-left">
                    <div class="section-header">
                        <h2>Data Desa</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="data-item d-flex align-items-center">
                                    <i class="fas fa-map-marked-alt fa-2x text-primary mr-3"></i>
                                    <div>
                                        <h6 class="mb-0">Luas Wilayah</h6>
                                        <p class="mb-0 text-muted">500 hektar</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="data-item d-flex align-items-center">
                                    <i class="fas fa-users fa-2x text-success mr-3"></i>
                                    <div>
                                        <h6 class="mb-0">Jumlah Penduduk</h6>
                                        <p class="mb-0 text-muted">5.000 jiwa</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="data-item d-flex align-items-center">
                                    <i class="fas fa-tractor fa-2x text-warning mr-3"></i>
                                    <div>
                                        <h6 class="mb-0">Mata Pencaharian</h6>
                                        <p class="mb-0 text-muted">Pertanian dan Perikanan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="data-item d-flex align-items-center">
                                    <i class="fas fa-hospital-alt fa-2x text-danger mr-3"></i>
                                    <div>
                                        <h6 class="mb-0">Fasilitas</h6>
                                        <p class="mb-0 text-muted">1 Puskesmas, 3 SD, 1 SMP</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5 shadow" data-aos="fade-up">
            <div class="card-body">
                <div class="section-header">
                    <h2>Seputar Desa</h2>
                </div>
                <div class="row">
                    <div class="col" data-aos="fade-up" data-aos-delay="200">
                        {!! $village->long_desc !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5 shadow" data-aos="fade-up">
            <div class="card-body">
                <div class="section-header">
                    <h2>Perangkat Desa</h2>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
                    @foreach (range(1, 3) as $index)
                        <div class="col" data-aos="fade-up" data-aos-delay="<?php echo (200 + ($index * 100)); ?>">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="{{ asset('frontend/assets/images/services/services-8.jpg') }}"
                                    class="card-img-top" alt="Foto Kepala Desa" style="height: 200px; object-fit: cover;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Kepala Desa</h5>
                                    <p class="card-text">Nama Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- visi misi --}}
        <div class="card mb-5 shadow" data-aos="fade-up">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="section-header text-center mb-4">
                            <h2 class="display-6">Visi</h2>
                        </div>
                        <div class="card bg-light p-3 border-0">
                            <p class="mb-0">Mewujudkan Desa Sejahtera sebagai desa mandiri, makmur, dan berbudaya.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-header text-center mb-4">
                            <h2 class="display-6">Misi</h2>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-start mb-2">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <strong class="text-black">Meningkatkan kualitas sumber daya manusia</strong>
                            </li>
                            <li class="d-flex align-items-start mb-2">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <strong class="text-black">Mengembangkan potensi ekonomi lokal</strong>
                            </li>
                            <li class="d-flex align-items-start mb-2">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <strong class="text-black">Melestarikan budaya dan kearifan lokal</strong>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <strong class="text-black">Membangun infrastruktur yang berkelanjutan</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow" data-aos="fade-up">
            <div class="card-body">
                {{-- <h2 class="card-title h4 mb-4">Galeri Desa</h2> --}}
                <div class="section-header">
                    <h2> Galeri Desa </h2>
                </div>
                <div class="row">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-6 col-md-3 mb-4">
                            <img src="{{ asset('frontend/assets/images/sawah.png') }}" alt="Foto Desa {{ $i }}"
                                class="img-fluid rounded shadow-sm" style="object-fit: cover; height: 150px; width: 100%;">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
