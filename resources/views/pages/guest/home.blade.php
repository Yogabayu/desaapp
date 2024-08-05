@extends('layouts.main')
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
                                        <span class="top-title">
                                            Selamat Datang di Portal Web Desa
                                            Cepoko
                                        </span>
                                        <h2>{{ $slider['title'] }}</h2>
                                        <br>
                                        <div class="slider-btn">
                                            <a href="{{ $slider['link'] }}" class="default-btn">
                                                Lihat selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-lg-6">
                                    @if ($slider['type'] == 'image')
                                        <div class='slider-img pl-15'>
                                            {{-- <img src="{{ asset('frontend/assets/images/sawah.png') }}" alt='{{ $slider['title'] }}'> --}}
                                            <img src="{{ $slider['file'] }}" alt='{{ $slider['title'] }}' class="curousel-image" >
                                        </div>
                                    {{-- @else
                                        <video autoplay loop src="{{ $slider['file'] }}" width='100%'></video> --}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="slider-shape">
                    <img src="{{ asset('frontend/assets/images/coretan.png') }}" alt="Slider Shape">
                </div>
            </div>
            @endforeach
        </div>
    
        <!-- Start Carousel Thumbs -->
        <div class="thumbs-wrap">
            <div class="owl-thumbs hero-slider-thumb" data-slider-id="1">
                @if(count($sliders) > 1)
                    @foreach($sliders as $index => $slider)
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
            <div class="section-title">
                <h2>Pelayanan Kami</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
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
                            <img src="{{ asset('frontend/assets/images/services-shape.png') }}" alt="Image">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-services-box">
                        <span class="flaticon-buildings"></span>

                        <h3>
                            <a href="services-details.html">
                                Pelayanan Umum
                            </a>
                        </h3>

                        <p>Meningkatkan dan mengembangkan kompetensi dan kualitas SDM dalam bidang pelayanan informasi.</p>

                        <div class="services-shape">
                            <img src="{{ asset('frontend/assets/images/services-shape.png') }}" alt="Image">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-services-box">
                        <span class="flaticon-government"></span>

                        <h3>
                            <a href="services-details.html">
                                Pemantauan Covid-19
                            </a>
                        </h3>

                        <p>Mewujudkan keterbukaan informasi Pemerintah Desa Tugu dengan proses yang cepat, tepat, mudah.</p>

                        <div class="services-shape">
                            <img src="{{ asset('frontend/assets/images/services-shape.png') }}" alt="Image">
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
                        @foreach([
                            ['count' => $data['penduduk'], 'title' => 'Jumlah Penduduk'],
                            ['count' => $data['dusun'], 'title' => 'Total Dusun'],
                            ['count' => $data['rt'], 'title' => 'Total Kebudayaan'],
                            ['count' => $data['umkm'], 'title' => 'Total UMKM']
                        ] as $counter)
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
                    <p>{{ $data['slider'][0]['judul'] }}</p>
                </div>
    
                <div class="row">
                    <div class="col-lg-6 pr-0">
                        <div class="discover-content">
                            <h2>{{ $data['budayaList'][0]['judul'] }}</h2>
                            {!! $data['budayaList'][0]['isi'] !!}
                        </div>
                    </div>
    
                    <div class="col-lg-6 pl-0">
                        <img style="width: -webkit-fill-available;"
                            src="{{ asset('frontend/assets/images/reog.png') }}"
                            alt="Images">
                    </div>
                </div>
    
                <div class="shape discover-shape-1">
                    <img src="{{ asset('frontend/assets/images/discover-shape-1.png') }}" alt="Image">
                </div>
    
                <div class="shape discover-shape-2">
                    <img src="{{ asset('frontend/assets/images/discover-shape-2.png') }}" alt="Image">
                </div>
            </div>
        </div>
    </section>
    <!-- End Discover Area -->

    <!-- Start Project Area -->
    <section class="project-area bg-color pt-100 pb-70">
        <div class="container-fluid p-0">
            <div class="section-title">
                <h2>Perangkat Desa</h2>
            </div>

            <div class="project-slider owl-carousel owl-theme">
                <?php 
                    $albumList = [
                        ['id' => 1, 'url' => 'frontend/assets/images/services/services-8.jpg'],
                        ['id' => 2, 'url' => 'frontend/assets/images/services/services-8.jpg'],
                        ['id' => 3, 'url' => 'frontend/assets/images/services/services-8.jpg'],
                        ['id' => 4, 'url' => 'frontend/assets/images/services/services-8.jpg'],
                        ['id' => 5, 'url' => 'frontend/assets/images/services/services-8.jpg'],
                        ['id' => 6, 'url' => 'frontend/assets/images/services/services-8.jpg'],
                    ];
                    foreach ($albumList as $al) : ?>
                <div class="single-project" style="margin: -13px auto 25px;">
                    <img src="{{ asset('frontend/assets/images/services/services-8.jpg') }}" alt="Image">

                    <div class="project-content">
                        <a href="{{ asset('frontend/assets/images/services/services-8.jpg') }}"> 
                            <strong>Pak John Doe</strong>
                            <p>Kepala Desa</p>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- End Project Area -->

    <!-- Start Blog Area -->
    <section class="blog-area bg-color pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>Artikel</h2>
            </div>
    
            <div class="row justify-content-center">
                @php $i = 0; @endphp
                @foreach ($artikelList as $al)
                    @if($i < 6)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog-box">
                                <a href="{{ url('/artikel/detail/' . $al['id']) }}">
                                    <img style="width: -webkit-fill-available;" 
                                         src="{{ asset('frontend/assets/images/blog'  . '/' . $al['gambar']) }}" 
                                         alt="Images">
                                </a>
    
                                <div class="blog-content">
                                    <ul>
                                        <li>
                                            <a href="{{ url('/artikel?kat=' . $al['kategori']) }}">
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
                                        <a href="{{ url('/artikel/detail/' . $al['id']) }}">
                                            {{ $al['judul'] }}
                                        </a>
                                    </h3>
                                    <p>{{ $al['slug'] }}</p>
                                    <a href="{{ url('/artikel/detail/' . $al['id']) }}" class="read-more">
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
            <img src="{{ asset('frontend/assets/images/blog/blog-shape-1.png') }}" alt="Image">
        </div>
    
        <div class="shape blog-shape-2">
            <img src="{{ asset('frontend/assets/images/blog/blog-shape-2.png') }}" alt="Image">
        </div>
    </section>
    <!-- End Blog Area -->

    <!-- Start Events Area -->
    <section class="events-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>UMKM</h2>
            </div>

            <div class="row justify-content-center">
                @php $i = 0; @endphp
                @foreach ($artikelList as $al)
                    @if($i < 6)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog-box">
                                <a href="{{ url('/artikel/detail/' . $al['id']) }}">
                                    <img style="width: -webkit-fill-available;" 
                                         src="{{ asset('frontend/assets/images/blog'  . '/' . $al['gambar']) }}" 
                                         alt="Images">
                                </a>
    
                                <div class="blog-content">
                                    <ul>
                                        <li>
                                            <a href="{{ url('/artikel?kat=' . $al['kategori']) }}">
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
                                        <a href="{{ url('/artikel/detail/' . $al['id']) }}">
                                            {{ $al['judul'] }}
                                        </a>
                                    </h3>
                                    <p>{{ $al['slug'] }}</p>
                                    <a href="{{ url('/artikel/detail/' . $al['id']) }}" class="read-more">
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
    </section>
    <!-- End Events Area -->
{{--
    <!-- Start Counter Are Area -->
    <section class="counter-area pb-5">
        <div class="container">
            <div class="section-title">
                <h2>Data Kasus Covid-19</h2>
            </div>

            <div class="counter-bg">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-counter">
                            <div class="count-title">
                                <h2>
                                    <span class="odometer"
                                        data-count="<?= count(
            array_filter($pendataan, function ($pd) {
                return $pd['status_covid'] == 1;
            }),
        ) ?>">00</span>
                                </h2>
                                <h4>Orang Dalam Pemantauan (ODP)</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-counter">
                            <div class="count-title">
                                <h2>
                                    <span class="odometer"
                                        data-count="<?= count(
            array_filter($pendataan, function ($pd) {
                return $pd['status_covid'] == 2;
            }),
        ) ?>">00</span>
                                </h2>
                                <h4>Pasien dalam Pengawasan (PDP)</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-counter">
                            <div class="count-title">
                                <h2>
                                    <span class="odometer"
                                        data-count="<?= count(
            array_filter($pendataan, function ($pd) {
                return $pd['status_covid'] == 3;
            }),
        ) ?>">00</span>
                                </h2>
                                <h4>Orang dalam Resiko (ODR)</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-counter">
                            <div class="count-title">
                                <h2>
                                    <span class="odometer"
                                        data-count="<?= count(
            array_filter($pendataan, function ($pd) {
                return $pd['status_covid'] == 4;
            }),
        ) ?>">00</span>
                                </h2>
                                <h4>Orang tanpa Gejala (OTG)</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-counter">
                            <div class="count-title">
                                <h2>
                                    <span class="odometer"
                                        data-count="<?= count(
            array_filter($pendataan, function ($pd) {
                return $pd['status_covid'] == 5;
            }),
        ) ?>">00</span>
                                </h2>
                                <h4>Positif Covid-19</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-counter">
                            <div class="count-title">
                                <h2>
                                    <span class="odometer"
                                        data-count="<?= count(
            array_filter($pendataan, function ($pd) {
                return $pd['status_covid'] == 6;
            }),
        ) ?>">00</span>
                                </h2>
                                <h4>Lainnya</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
