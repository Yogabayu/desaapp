@extends('layouts.guest.main')
@section('title')
    Profil Desa Sejahtera
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .page-radius {
            border-radius: .625rem !important;
        }

        .section-header {
            text-align: center;
            margin-top: .625rem;
            margin-bottom: 1.875rem;
            position: relative;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            position: relative;
            padding-bottom: .9375rem;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            display: block;
            width: 3.125rem;
            height: .1875rem;
            background: #4CAF50;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .data-item {
            padding: .9375rem;
            border-radius: .625rem;
            transition: all 0.3s ease;
        }

        .data-item:hover {
            background-color: #f8f9fa;
            transform: translateY(-0.3125rem);
            box-shadow: 0 .25rem .375rem rgba(0, 0, 0, 0.1);
        }

        .data-item i {
            width: 3.125rem;
            height: 3.125rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.1);
            margin-right: .9375rem;
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
                        style="height: 15.625rem; object-fit: cover;">
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
                                        <p class="mb-0 text-muted">{{ $village->area }} hektar</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="data-item d-flex align-items-center">
                                    <i class="fas fa-users fa-2x text-success mr-3"></i>
                                    <div>
                                        <h6 class="mb-0">Jumlah Penduduk</h6>
                                        <p class="mb-0 text-muted">{{ $village->total_population }} jiwa</p>
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
                                        <p class="mb-0 text-muted">{!! $village->fasilities !!}</p>
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
                    @php $i = 0; @endphp
                    <?php 
                    foreach ($villageOfficials as $index => $al) : ?>
                    <div class="col" data-aos="fade-up" data-aos-delay="<?php echo 200 + $index * 100; ?>">
                        <div class="card h-100 border-0 shadow-sm">
                            {{-- <img src="{{ asset('frontend/assets/images/services/services-8.jpg') }}"
                                    class="card-img-top" alt="Foto Kepala Desa" style="height: 12.5rem; object-fit: cover;"> --}}

                            <div id="main_image">
                                <img src="frontend/assets/images/services/background.jpg" alt="<?php echo $al['name']; ?>"
                                    loading="lazy" style="border-radius: .625rem">
                            </div>

                            <div id="overlay_image"
                                style="
                                            position: absolute;
                                            bottom: 6.2rem;
                                            right: .625rem;
                                            width: 6rem">
                                <img src="{{ Storage::url('official/' . $al['image']) }}" alt="<?php echo $al['name']; ?>"
                                    loading="lazy">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $al['name']; ?></h5>
                                <p class="card-text"><?php echo $al['position']; ?></p>
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
                        <div class="card bg-light p-3 border-0 mb-0 d-flex align-items-center" style="font-weight: bold">
                            {{-- <p class="mb-0">Mewujudkan Desa Sejahtera sebagai desa mandiri, makmur, dan berbudaya.</p> --}}
                            {!! $village->visi !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-header text-center mb-4">
                            <h2 class="display-6">Misi</h2>
                        </div>
                        <div style="
                                font-weight: bold;
                                display: flex;
                                justify-content: center;">
                            {!! $village->misi !!}
                        </div>
                        {{-- <ul class="list-unstyled">
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
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow" data-aos="fade-up">
            <div class="card-body">
                <div class="section-header">
                    <h2> Galeri Desa </h2>
                </div>
                <div class="row">
                    @foreach ($galleries as $i => $g)
                        <div class="col-6 col-md-3 mb-4">
                            <img src="{{ Storage::url('gallery/' . $g['image']) }}" alt="Foto Desa {{ $village->name }}"
                                class="img-fluid rounded shadow-sm"
                                style="object-fit: cover; height: 9.375rem; width: 100%;">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection