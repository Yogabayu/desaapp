<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <!-- Owl Theme Default Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}">
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <!-- Remixicon CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/remixicon.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
    <!-- Meanmenu Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/meanmenu.min.css') }}">
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <!-- Magnific Popup Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.min.css') }}">
    <!-- Odometer Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/odometer.min.css') }}">
    <!-- Date Picker Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/date-picker.min.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- C3 Chart css -->
    {{-- <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .logo img {
            max-width: 9.375rem;
            height: auto;
        }

        .social-icon {
            display: flex;
            gap: .625rem;
        }

        .address li,
        .quick-links li {
            margin-bottom: .625rem;
        }

        @media (max-width: 48rem) {
            .col-md-6 {
                margin-bottom: 1.875rem;
            }
        }
    </style>
    @stack('css')
    <!-- Favicon -->
    @php
        $logoPath = 'public/general_info/' . ($village->logo ?? '');
        $faviconUrl = Storage::exists($logoPath)
            ? asset('storage/general_info/' . $village->logo)
            : asset('frontend/assets/images/favicon.png');
    @endphp

    <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
    <!-- Title -->
    <title>@yield('title') {{ $village->name ?? 'DesaKU' }} </title>
</head>

<body>
    <!-- Start Preloader Area -->
    <div class="preloader">
        <div class="lds-ripple">
            <img src="{{ $faviconUrl }}" alt="{{ $village->name ?? 'DesaKU' }}" class="logo-animate" loading="lazy">
            {{-- <strong class="desa-name">
                    @php
                        $villageName = $village->name ?? 'DesaKU';
                        $cleanedName = str_replace(['Desa ', 'desa ', 'DESA '], '', $villageName);
                    @endphp
                    {{ $cleanedName }}
                </strong> --}}
        </div>
    </div>
    <!-- End Preloader Area -->

    <!-- Start Header Area -->
    <header class="header-area">

        <!-- Start Navbar Area -->
        <div class="navbar-area">
            <div class="mobile-responsive-nav">
                <div class="container">
                    <div class="mobile-responsive-menu">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img style="height: 3.75rem; margin-left: 1.25rem;" src="{{ $faviconUrl }}"
                                    alt="logo" loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="others-option-for-responsive" style="margin-right: 2rem">
                <div class="container">
                    <div class="dot-menu">
                        <div class="inner">
                            <div class="circle circle-one"></div>
                            <div class="circle circle-two"></div>
                            <div class="circle circle-three"></div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="option-inner">
                            <div class="others-option justify-content-center d-flex align-items-center">
                                <ul>
                                    <li>
                                        <a href="#" class="call">
                                            <i class="ri-phone-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="call">
                                            <i class="ri-whatsapp-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="call">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="call">
                                            <i class="ri-map-line"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="desktop-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img style="height: 3.75rem; margin-left: 1.25rem;" src="{{ $faviconUrl }}"
                                alt="logo" loading="lazy">
                            <strong>{{ $village->name ?? 'DesaKU' }}</strong>
                        </a>

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                                </li>
                                <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
                                    <a href="{{ url('/profile') }}" class="nav-link">Profile</a>
                                </li>
                                <li class="nav-item {{ request()->is('galeri') ? 'active' : '' }}">
                                    <a href="{{ url('/galeri') }}" class="nav-link">Galeri</a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ url('/umkm') }}" class="nav-link">UMKM</a>
                                </li>
                                <li class="nav-item {{ request()->is('article') ? 'active' : '' }}">
                                    <a href="{{ url('/article') }}" class="nav-link">Artikel</a>
                                </li>
                            </ul>

                            <div class="others-options">
                                <ul>
                                    <li>
                                        <a href="#" class="call">
                                            <i class="ri-phone-fill"></i>
                                            {{-- {{ $logo['telepon'] }} --}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

        </div>
        <!-- End Navbar Area -->
    </header>
    <!-- End Header Area -->

    @yield('content')

    <!-- Start Footer Area -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget">
                        <div class="d-flex justify-content-center mb-3">
                            <a href="{{ url('/') }}" class="logo">
                                <img src="{{ asset('frontend/assets/images/ponorogo.png') }}" alt="Logo Desa"
                                    loading="lazy" style="max-width: 5rem !important">
                            </a>
                        </div>
                        <p class="text-center">{{ $village->name }}, {{ $village->address }}
                        </p>
                        <div class="d-flex justify-content-center mb-3">
                            <ul class="social-icon">
                                <li><a href="{{ $village->fb }}" target="_blank"><i
                                            class="ri-facebook-fill"></i></a></li>
                                <li><a href="{{ $village->ig }}" target="_blank"><i
                                            class="ri-instagram-line"></i></a></li>
                                <li><a href="{{ $village->wa }}" target="_blank"><i
                                            class="ri-whatsapp-fill"></i></a></li>
                                <li><a href="{{ $village->ytb }}" target="_blank"><i
                                            class="ri-youtube-fill"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget">
                        <h3>Hubungi Kami</h3>
                        <ul class="address">
                            <li><i class="ri-map-pin-fill"></i> {{ $village->address }}</li>
                            <li><i class="ri-mail-open-fill"></i> <a
                                    href="mailto:{{ $village->email }}">{{ $village->email }}</a></li>
                            <li><i class="ri-global-fill"></i> {{ $village->web }}</li>
                            <li><i class="ri-phone-fill"></i> <a
                                    href="tel:{{ $village->tlp }}">{{ $village->tlp }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget">
                        <h3>Tautan Cepat</h3>
                        <ul class="quick-links">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="{{ url('/profile') }}">Profil Desa</a></li>
                            {{-- <li><a href="{{ url('/article') }}">Layanan</a></li> --}}
                            <li><a href="{{ url('/article') }}">Berita</a></li>
                            {{-- <li><a href="#">Kontak</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="shape footer-shape-1">
            <img src="{{ asset('frontend/assets/images/footer-shape-1.png') }}" alt="Footer Shape" loading="lazy">
        </div>

        <div class="shape footer-shape-2">
            <img src="{{ asset('frontend/assets/images/footer-shape-2.png') }}" alt="Footer Shape" loading="lazy">
        </div>
    </footer>
    <!-- End Footer Area -->

    <!-- Start Copy Right Area -->
    <div class="copy-right-area">
        <div class="container">
            <p>
                Copyright <i class="ri-copyright-line"></i> 2024. <a href="https://portofolio.yogabayuap.com">Yoga
                    Dev</a>
            </p>
        </div>
    </div>
    <!-- End Copy Right Area -->

    <!-- Start Go Top Area -->
    <div class="go-top">
        <i class="ri-arrow-up-s-fill"></i>
        <i class="ri-arrow-up-s-fill"></i>
    </div>
    <!-- End Go Top Area -->

    @stack('scripts')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    <!-- Jquery Min JS -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap Bundle Min JS -->
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Meanmenu Min JS -->
    <script src="{{ asset('frontend/assets/js/meanmenu.min.js') }}"></script>
    <!-- Owl Carousel Min JS -->
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <!-- Owl Carousel Thumbs Min JS -->
    <script src="{{ asset('frontend/assets/js/carousel-thumbs.min.js') }}"></script>
    <!-- Wow Min JS -->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <!-- Magnific Popup Min JS -->
    <script src="{{ asset('frontend/assets/js/magnific-popup.min.js') }}"></script>
    <!-- Appear Min JS -->
    <script src="{{ asset('frontend/assets/js/appear.min.js') }}"></script>
    <!-- Odometer Min JS -->
    <script src="{{ asset('frontend/assets/js/odometer.min.js') }}"></script>
    <!-- Mixitup Min JS -->
    <script src="{{ asset('frontend/assets/js/mixitup.min.js') }}"></script>
    <!-- Bootstrap Datepicker Min JS -->
    <script src="{{ asset('frontend/assets/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Form Validator Min JS -->
    <script src="{{ asset('frontend/assets/js/form-validator.min.js') }}"></script>
    <!-- Contact JS -->
    <script src="{{ asset('frontend/assets/js/contact-form-script.js') }}"></script>
    <!-- Ajaxchimp Min JS -->
    <script src="{{ asset('frontend/assets/js/ajaxchimp.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>

    <script>
        if ($(".category").length !== 0) {
            $(".category").click(function() {
                $(".category").removeAttr("style");
                $(".category#" + this.id).css("color", "#00aa55");
                $(".tab-pane").removeClass("active show");
                $(".tab-pane#" + this.id).addClass("active show");
            });
        }
    </script>
</body>

</html>
