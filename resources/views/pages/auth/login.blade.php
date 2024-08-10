@extends('layouts.auth.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap-social/bootstrap-social.css') }}">
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
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
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
            <form method="POST" action="{{ route('auth.login') }}" class="needs-validation" novalidate="">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="user">Email/NIP</label>
                    <input id="user" type="text" class="form-control" name="text" tabindex="1" required
                        autofocus>
                    <div class="invalid-feedback">
                        Harap isi Email atau NIP anda
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    {{-- <input id="password" type="password" class="form-control" name="password" tabindex="2" required> --}}
                    <div class="input-group">
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                        <div class="input-group-append">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        Harap password diisi
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                    <a href="{{ route('guest.home') }}" style="text-decoration: none">
                        <button type="button" class="btn btn-secondary btn-lg btn-block mt-2" tabindex="4">
                            Lihat Situs
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
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
