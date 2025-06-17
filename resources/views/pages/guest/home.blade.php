@extends('layouts.guest.main')
@push('css')
    <style>
        .umkm-thumbnail-link {
            display: block;
            overflow: hidden;
            aspect-ratio: 16 / 9;
        }

        .umkm-thumbnail {
            width: 15.625rem !important;
            height: auto;
            /* object-fit: cover; */
            transition: transform 0.3s ease;
        }

        .umkm-thumbnail:hover {
            transform: scale(1.05);
        }





        .single-services-box{
                max-width: fit-content;
        }

        .our-suctomers-section {
            height: 250px;
        }

        .single-services-box { 
            height: 200px;
        }

        .white-smoke-bg {
            background: whitesmoke!important;
        }
        .service-area { 
            margin:25px 0px !important;
        }

        .customers-box{ 
            text-align: center;
        }

        .customers-box img{
            max-width: 55%!important;
        }

        section { 
            margin-top: 10px;
        }

        #main_image img {
            justify-self: center; 
            /* height: 50vh!important;
            width: 50vw!important; */
        }

        .pfac-box {
            /* height: 80vh!important;
            width: 80vh!important; */
        }
        .project-slider { 
            height: 100vh!important;
            display: flex;
            flex-direction: row;
        }

        .facility { 
            display: flex;
            flex-direction: row;
        }

        .production-facility-box{
            width: 5`00px!important;
            height: 500px!important;
            margin: 20px;
            border: 5px solid rgba(0, 0, 0, 0.1);
            border-radius :7px;
        }

        .logo-corner {
            position: absolute;
            bottom: 15px;
            right: 15px;
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 10px;
            padding: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            object-fit: contain;
        }

        .d-flex {
            display: flex;
            flex-direction: row;
        }

        .img-spotlight {
            text-align: center;
        }
        .img-spotlight img {
                height: 250px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

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

                    {{-- <div class="slider-shape">
                        <img src="{{ asset('frontend/assets/images/coretan.png') }}" alt="Slider Shape" loading="lazy">
                    </div> --}}
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


        <!-- Start Discover Area -->
    <section class="discover-area discover-area-style-two pb-100">
        <div class="container">
            <div class="discover-bg pt-100">
                <div class="counter-bg">
                    <div class="row">
                        @foreach ([['count' => $data['penduduk'], 'title' => 'Product Category'], ['count' => $data['dusun'], 'title' => 'Customers Total'], ['count' => $data['rt'], 'title' => 'Employee Total'], ['count' => $data['umkm'], 'title' => 'Volume']] as $counter)
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
                    <h2>I want to be the best I can</h2>
                </div>

                <div class="row">
                    <div class="col-lg-6 pr-0">
                        <div class="discover-content">
                            <h2>{{ $data['budayaList'][0]['judul'] }}</h2>
                            {!! $data['budayaList'][0]['isi'] !!}
                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img style="width: -webkit-fill-available;" src="{{ asset('frontend/assets/images/bola-piala-dunia.png') }}"
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

    <!-- Start Services Area -->
    <section class="services-area pt-100 pb-70 white-smoke-bg">
        <div class="container">
            <div class="section-title" data-aos="fade-up" data-aos-delay="100">
                <h2>Our Customers</h2>
            </div>

            <div class="our-suctomers-section row col-12">
                <div class="slider-for">
                    <div class="col-lg-3 col-md-6">
                        <div class="col-12 customers-box">
                            <div class="services-shape">
                                <img class="" src="{{ asset('frontend/assets/images/customers/Adidas.png') }}" alt="Image" loading="lazy">
                            </div>
                            <h3>
                                <a href="javascript:;">
                                    ADIDAS
                                </a>
                            </h3>
                            <p></p>
                        </div>
                    </div>
                    

                    <div class="col-lg-3 col-md-6">
                        <div class="col-12 customers-box">
                            <div class="services-shape">
                                <img class="" src="{{ asset('frontend/assets/images/customers/puma.png') }}" alt="Image" loading="lazy">
                            </div>
                            <h3>
                                <a href="javascript:;">
                                    PUMA
                                </a>
                            </h3>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="col-12 customers-box">
                            <div class="services-shape">
                                <img class="" src="{{ asset('frontend/assets/images/customers/mizuno.png') }}" alt="Image" loading="lazy">
                            </div>
                            <h3>
                                <a href="javascript:;">
                                    MIZUNO
                                </a>
                            </h3>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="col-12 customers-box">
                            <div class="services-shape">
                                <img class="" src="{{ asset('frontend/assets/images/customers/Adidas.png') }}" alt="Image" loading="lazy">
                            </div>
                            <h3>
                                <a href="javascript:;">
                                    ADIDAS
                                </a>
                            </h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="col-12 customers-box">
                            <div class="services-shape">
                                <img class="" src="{{ asset('frontend/assets/images/customers/Adidas.png') }}" alt="Image" loading="lazy">
                            </div>
                            <h3>
                                <a href="javascript:;">
                                    ADIDAS
                                </a>
                            </h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="col-12 customers-box">
                            <div class="services-shape">
                                <img class="" src="{{ asset('frontend/assets/images/customers/Adidas.png') }}" alt="Image" loading="lazy">
                            </div>
                            <h3>
                                <a href="javascript:;">
                                    ADIDAS
                                </a>
                            </h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="col-12 customers-box">
                            <div class="services-shape">
                                <img class="" src="{{ asset('frontend/assets/images/customers/Adidas.png') }}" alt="Image" loading="lazy">
                            </div>
                            <h3>
                                <a href="javascript:;">
                                    ADIDAS
                                </a>
                            </h3>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Area -->


    <!-- Start Project Area -->
    @if (isset($villageOfficials) && count($villageOfficials) > 0)
        <section class="project-area bg-color pt-100 pb-70" data-aos="fade-up" data-aos-delay="100">
            <div class="container-fluid p-0">
                <div class="section-title" data-aos="fade-up" data-aos-delay="200">
                    <h2>Production Facility</h2>
                </div>

                <div class="col-12 facility" data-aos="fade-up" data-aos-delay="300">
                    @php $i = 0; @endphp
                    <?php 
                    foreach ($villageOfficials as $index => $al) : ?>
                    <div class="production-facility-box pfac-box single-project col-lg-6 col-xs-12">
                        <div id="main_image">
                            <img src={{ asset('frontend/assets/images/production-facility/' . $al['background_image']) }} alt="<?php echo $al['name']; ?>"
                                loading="lazy" style="border-radius: .625rem">
                        </div>
                        <div id="overlay_image" style="
                                position: absolute;
                                bottom: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background: linear-gradient(to top, rgba(0,0,0,0.6), rgba(0,0,0,0));
                                z-index: 1;
                                border-radius: 10px;">
                            <img class="logo-corner" src="{{ Storage::url('official/' . $al['image']) }}" alt="<?php echo $al['name']; ?>"
                                loading="lazy">
                        </div>

                        <div class="project-content" style="  position: absolute;
                                                                bottom: 0;
                                                                padding: 20px;
                                                                color: white;
                                                                z-index: 2;">
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
                    <h2>Spotlight</h2>
                </div>

                <div class="row justify-content-center">
                    @php $i = 0; @endphp
                    @foreach ($artikelList as $al)
                        @if ($i < 6)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-blog-box">
                                    <a href="{{ url('/article') }}">
                                        <div class="img-spotlight">
                                            <img style="width: -webkit-fill-available; " style=""
                                                src="{{ Storage::url('article/' . $al['thumbnail']) }}" alt="Images"
                                                loading="lazy">
                                        </div>
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
                                            Read More
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

    <!-- End Events Area --> --}}
@endsection

@push('scripts')
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $('.slider-for').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true
    });

    $('.facility').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true
    });
    

</script>
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
