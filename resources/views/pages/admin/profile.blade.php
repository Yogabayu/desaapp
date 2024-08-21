@extends('layouts.admin.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap-social/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .input-group {
            display: flex;
            align-items: center;
        }

        #password {
            flex: 1;
            /* Membuat input field menempati ruang yang tersisa */
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group-append {
            display: flex;
        }

        .input-group-append {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            padding-left: 12px;
            padding-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #eyeIcon {
            cursor: pointer;
            margin-left: 0.2rem;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <x-breadcrumb />
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
                <p class="section-lead">
                    Ubah data profil anda
                </p>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image" src="{{ asset('admin/img/avatar/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ Auth::user()->name }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div> {{ Auth::user()->role->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" class="needs-validation" novalidate="" action="{{ route('admin.profile.store') }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Ubah Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ Auth::user()->name }}" required="">
                                            <div class="invalid-feedback">
                                                Nama wajib diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control"
                                                value="{{ Auth::user()->email }}" required="">
                                            <div class="invalid-feedback">
                                                Email wajib diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>NIP</label>
                                            <input type="text" name="nip" class="form-control"
                                                value="{{ Auth::user()->nip }}" required="">
                                            <div class="invalid-feedback">
                                                NIP wajib diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control" name="password">
                                                <div class="input-group-append">
                                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        document.getElementById('eyeIcon').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
@endpush
