@extends('layouts.admin.app')

@section('title', 'Detail Desa')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .info-card {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .info-card .card-header {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
        }
        .info-label {
            font-weight: bold;
            color: #4e73df;
            margin-left: 10px;
        }
        .info-content {
            margin-bottom: 15px;
        }
        .social-link {
            color: #4e73df;
            text-decoration: none;
        }
        .social-link:hover {
            text-decoration: underline;
        }
        .img-preview {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .section-title {
            border-bottom: 2px solid #4e73df;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .indent {
            text-indent: 1.5rem;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Desa - {{ $generalInfo->name }}</h1>
            </div>
        </section>
        
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card info-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4><i class="fas fa-info-circle"></i> Info Umum Desa</h4>
                            <a href="{{ route('general-info.edit', $generalInfo->slug) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="section-title"><i class="fas fa-home"></i> Informasi Dasar</h5>
                                    @include('pages.admin.general-info.partials.basic-info')
                                </div>
                                <div class="col-md-6">
                                    <h5 class="section-title"><i class="fas fa-chart-bar"></i> Statistik Desa</h5>
                                    @include('pages.admin.general-info.partials.village-stats')
                                </div>
                            </div>
                            
                             <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="section-title"><i class="fas fa-share-alt"></i> Media Sosial</h5>
                                    @include('pages.admin.general-info.partials.social-media')
                                </div>
                                <div class="col-md-6">
                                    <h5 class="section-title"><i class="fas fa-image"></i> Gambar & Logo</h5>
                                    @include('pages.admin.general-info.partials.images')
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="section-title"><i class="fas fa-align-left"></i> Deskripsi</h5>
                                    @include('pages.admin.general-info.partials.description')
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="section-title"><i class="fas fa-building"></i> Fasilitas & Kegiatan</h5>
                                    @include('pages.admin.general-info.partials.facilities-activities')
                                </div>
                                <div class="col-md-6">
                                    <h5 class="section-title"><i class="fas fa-bullseye"></i> Visi & Misi</h5>
                                    @include('pages.admin.general-info.partials.vision-mission')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']]
                ]
            });
        });
    </script>
@endpush