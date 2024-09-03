@extends('layouts.guest.main')
@push('css')
    <style>
        .umkm-thumbnail-link {
            display: block;
            overflow: hidden;
            aspect-ratio: 16 / 9;
        }

        .umkm-thumbnail {
            width: 250px !important;
            height: auto;
            /* object-fit: cover; */
            transition: transform 0.3s ease;
        }

        .umkm-thumbnail:hover {
            transform: scale(1.05);
        }
    </style>
@endpush
@section('content')
    <!-- Start Hero Slider Area -->
    <section class="hero-slider-area">
        <div class="hero-slider owl-theme owl-carousel" data-slider-id="1">
            @foreach ($sliders as $slider)
                <div class="hero-slider-item">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="hero-slider-content pr-15">
                                            <span class="top-title" data-aos="fade-up" data-aos-delay="100">
                                                Selamat Datang di Portal Web {{ $village->name }}
                                            </span>
                                            <h2 data-aos="fade-left" data-aos-delay="300" class="sub-title">
                                                {{ $slider['title'] }}</h2>
                                            <br>
                                            <div class="slider-btn" data-aos="fade-right" data-aos-delay="500">
                                                <a href="{{ $slider['link'] }}" class="default-btn">
                                                    Lihat selengkapnya
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        @if ($slider['type'] == 'image')
                                            <div class='slider-img pl-15'>
                                                <img src="{{ $slider['file'] }}" alt='{{ $slider['title'] }}'
                                                    class="curousel-image" data-aos="fade-up" data-aos-delay="700"
                                                    loading="lazy">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slider-shape">
                        <img src="{{ asset('frontend/assets/images/coretan.png') }}" alt="Slider Shape" loading="lazy">
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Start Carousel Thumbs -->
        <div class="thumbs-wrap">
            <div class="owl-thumbs hero-slider-thumb" data-slider-id="1">
                @if (count($sliders) > 1)
                    @foreach ($sliders as $index => $slider)
                        <div class="owl-thumb-item">
                            <span>{{ $index + 1 }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!-- End Carousel Thumbs -->
    </section>
    <!-- End Hero Slide Area -->

    <!-- Start Services Area -->
    <section class="services-area pt-100 pb-70">
        <div class="container">
            <div class="section-title" data-aos="fade-up" data-aos-delay="100">
                <h2>Pelayanan Kami</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="single-services-box">
                        <span class="flaticon-group"></span>
                        <h3>
                            <a href="services-details.html">
                                Pelayanan Mandiri
                            </a>
                        </h3>
                        <p>Meningkatkan pengelolaan dan pelayanan informasi yang berkualitas, benar dan bertanggung jawab.
                        </p>
                        <div class="services-shape">
                            <img src="{{ asset('frontend/assets/images/services-shape.png') }}" alt="Image"
                                loading="lazy">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="single-services-box">
                        <span class="flaticon-buildings"></span>
                        <h3>
                            <a href="services-details.html">
                                Pelayanan Umum
                            </a>
                        </h3>
                        <p>Meningkatkan dan mengembangkan kompetensi dan kualitas SDM dalam bidang pelayanan informasi.</p>
                        <div class="services-shape">
                            <img src="{{ asset('frontend/assets/images/services-shape.png') }}" alt="Image"
                                loading="lazy">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="single-services-box">
                        <span class="flaticon-government"></span>
                        <h3>
                            <a href="services-details.html">
                                Pemberdayaan UMKM
                            </a>
                        </h3>
                        <p>Meningkatkan dan mengembangkan UMKM dalam berbagai bidang.</p>
                        <div class="services-shape">
                            <img src="{{ asset('frontend/assets/images/services-shape.png') }}" alt="Image"
                                loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Area -->

    <!-- Start Discover Area -->
    <section class="discover-area discover-area-style-two pb-100">
        <div class="container">
            <div class="discover-bg pt-100">
                <div class="counter-bg">
                    <div class="row">
                        @foreach ([['count' => $data['penduduk'], 'title' => 'Jumlah Penduduk'], ['count' => $data['dusun'], 'title' => 'Total Dusun'], ['count' => $data['rt'], 'title' => 'Total RT'], ['count' => $data['umkm'], 'title' => 'Total UMKM']] as $counter)
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-counter">
                                    <div class="count-title">
                                        <h2>
                                            <span class="odometer" data-count="{{ $counter['count'] }}">00</span>
                                        </h2>
                                        <h4>{{ $counter['title'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="section-title green-title">
                    <h2>Ayo kunjungi desa kami</h2>
                </div>

                <div class="row">
                    <div class="col-lg-6 pr-0">
                        <div class="discover-content">
                            <h2>{{ $data['budayaList'][0]['judul'] }}</h2>
                            {!! $data['budayaList'][0]['isi'] !!}
                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img style="width: -webkit-fill-available;" src="{{ asset('frontend/assets/images/reog.png') }}"
                            alt="Images" loading="lazy">
                    </div>
                </div>

                <div class="shape discover-shape-1">
                    <img src="{{ asset('frontend/assets/images/discover-shape-1.png') }}" alt="Image" loading="lazy">
                </div>

                <div class="shape discover-shape-2">
                    <img src="{{ asset('frontend/assets/images/discover-shape-2.png') }}" alt="Image" loading="lazy">
                </div>
            </div>
        </div>
    </section>
    <!-- End Discover Area -->

    <!-- Start Project Area -->
    @if (isset($villageOfficials) && count($villageOfficials) > 0)
        <section class="project-area bg-color pt-100 pb-70" data-aos="fade-up" data-aos-delay="100">
            <div class="container-fluid p-0">
                <div class="section-title" data-aos="fade-up" data-aos-delay="200">
                    <h2>Perangkat Desa</h2>
                </div>

                <div class="project-slider owl-carousel owl-theme" data-aos="fade-up" data-aos-delay="300">
                    @php $i = 0; @endphp
                    <?php 
                    foreach ($villageOfficials as $index => $al) : ?>
                    <div class="single-project" style="margin: -13px auto 25px;" data-aos="fade-up"
                        data-aos-delay="<?php echo 400 + $index * 100; ?>">
                        <div id="main_image">
                            <img src="frontend/assets/images/services/background.jpg" alt="<?php echo $al['name']; ?>"
                                loading="lazy" style="border-radius: 10px">
                        </div>

                        <div id="overlay_image"
                            style="
                                position: absolute;
                                right: 10px;
                                width: 7rem">
                            <img src="{{ Storage::url('official/' . $al['image']) }}" alt="<?php echo $al['name']; ?>"
                                loading="lazy">
                        </div>
                        <div class="project-content">
                            <a href="{{ asset($al['url']) }}">
                                <strong><?php echo $al['name']; ?></strong>
                                <p><?php echo $al['position']; ?></p>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    @endif
    <!-- End Project Area -->

    <!-- Start Blog Area -->
    @if (isset($artikelList) && count($artikelList) > 0)
        <section class="blog-area bg-color pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <h2>Artikel</h2>
                </div>

                <div class="row justify-content-center">
                    @php $i = 0; @endphp
                    @foreach ($artikelList as $al)
                        @if ($i < 6)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-blog-box">
                                    <a href="{{ url('/article') }}">
                                        <img style="width: -webkit-fill-available; " style=""
                                            src="{{ Storage::url('article/' . $al['thumbnail']) }}" alt="Images"
                                            loading="lazy">
                                    </a>

                                    <div class="blog-content">
                                        <ul>
                                            <li>
                                                <a href="{{ url('/article') }}">
                                                    <i class="ri-layout-grid-line"></i>
                                                    {{ $al['kategori'] }}
                                                </a>
                                            </li>
                                            <li>
                                                <i class="ri-calendar-line"></i>
                                                {{ \Carbon\Carbon::parse($al['tgl_upload'])->format('d F Y H:i') }}
                                            </li>
                                        </ul>
                                        <h3>
                                            <a href="{{ url('/article') }}">
                                                {{ $al['judul'] }}
                                            </a>
                                        </h3>
                                        <p>{{ $al['slug'] }}</p>
                                        <a href="{{ url('/article') }}" class="read-more">
                                            Baca selengkapnya
                                            <i class="ri-arrow-right-s-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php $i++; @endphp
                    @endforeach
                </div>
            </div>

            <div class="shape blog-shape-1">
                <img src="{{ asset('frontend/assets/images/blog/blog-shape-1.png') }}" alt="Image" loading="lazy">
            </div>

            <div class="shape blog-shape-2">
                <img src="{{ asset('frontend/assets/images/blog/blog-shape-2.png') }}" alt="Image" loading="lazy">
            </div>
        </section>
    @endif
    <!-- End Blog Area -->

    <!-- Start Events Area -->
    @if (isset($umkmList) && count($umkmList) > 0)
        <section class="events-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <h2>UMKM</h2>
                </div>

                <div class="row justify-content-center">
                    @php $i = 0; @endphp
                    @foreach ($umkmList as $umkm)
                        @if ($i < 6 && $umkm['is_active'] != 0)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-blog-box">
                                    <a href="#" class="umkm-thumbnail-link"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <img class="umkm-thumbnail" style="max-width: 150px !important; "
                                            src="{{ Storage::url('umkm_images/' . $umkm->images->first()->image) }}"
                                            alt="{{ $umkm['judul'] }}">
                                    </a>

                                    <div class="blog-content">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-layout-grid-line"></i>
                                                    {{ $umkm['tlp'] }}
                                                </a>
                                            </li>
                                            <li>
                                                <i class="ri-calendar-line"></i>
                                                {{ \Carbon\Carbon::parse($umkm['created_at'])->format('d F Y H:i') }}
                                            </li>
                                        </ul>
                                        <h3>
                                            <a href="#">
                                                {{ $umkm['name'] }}
                                            </a>
                                        </h3>
                                        <p>{{ $umkm['slug'] }}</p>
                                        <a href="#" class="read-more">
                                            Baca selengkapnya
                                            <i class="ri-arrow-right-s-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @php $i++; @endphp
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="events-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>APBD</h2>
            </div>

            @if (!empty($apbd1Data['data']))
                <div class="row justify-content-center">
                    <canvas id="chart1" width="400" height="100"></canvas>
                </div>
            @endif
        </div>
    </section>

    <!-- End Events Area -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const apbd1Data = JSON.parse('{!! json_encode($apbd1Data) !!}');
            const apbd2Data = JSON.parse('{!! json_encode($apbd2Data) !!}');
            const apbd3Data = JSON.parse('{!! json_encode($apbd3Data) !!}');

            new Chart(document.getElementById('chart1'), {
                type: 'bar', // Or choose another chart type
                data: {
                    labels: ['APBD'],
                    datasets: [apbd1Data, apbd2Data, apbd3Data]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
    </script>
@endpush
