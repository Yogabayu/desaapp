@extends('layouts.admin.app')
@section('title', 'UMKM Desa')
@section('main')
    {{-- URUNG:  tampilan masih berantakan --}}
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>UMKM Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">UMKM Desa</h2>
                <p class="section-lead">Manajemen UMKM di desa.</p>

                <div class="card">
                    <div class="card-header">
                        <h4>Detail UMKM - {{ $umkm->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('storage/umkm_images/' . $umkm->images->first()->image) }}" alt="{{ $umkm->name }}" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Nama UMKM:</th>
                                        <td>{{ $umkm->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Desa:</th>
                                        <td>{{ $umkm->village->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon:</th>
                                        <td>{{ $umkm->tlp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Facebook:</th>
                                        <td>{{ $umkm->fb }}</td>
                                    </tr>
                                    <tr>
                                        <th>Instagram:</th>
                                        <td>{{ $umkm->ig }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi:</th>
                                        <td>{!! $umkm->desc !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            @if ($umkm->is_active == 1)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-secondary">Draft</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Gambar UMKM</h4>
                                <div class="row">
                                    @foreach ($umkm->images as $image)
                                        <div class="col-md-4 mb-3">
                                            <img src="{{ asset('storage/umkm_images/' . $image->image) }}" alt="{{ $umkm->name }}" class="img-fluid">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Ulasan UMKM</h4>
                                <div class="row">
                                    @foreach ($umkm->reviews as $review)
                                        <div class="col-md-12 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p>{{ $review->content }}</p>
                                                    <small class="text-muted">{{ $review->user->name }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection