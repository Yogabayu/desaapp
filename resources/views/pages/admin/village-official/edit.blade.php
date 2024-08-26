@extends('layouts.admin.app')

@section('title', 'Pegawai Desa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Pegawai Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Pegawai Desa</h2>
                <p class="section-lead">Manajemen data pegawai desa</p>

                <div class="card">
                    <form method="post" class="needs-validation" novalidate=""
                        action="{{ route('officials.update', $data->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $data->name) }}" required="true">
                                    <div class="invalid-feedback">
                                        Nama wajib diisi
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Posisi</label>
                                    <input type="text" name="position" class="form-control" required="true"
                                        value="{{ old('position', $data->position) }}">
                                    <div class="invalid-feedback">
                                        Posisi wajib diisi
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*">
                                    <div class="invalid-feedback">
                                        Foto wajib diisi
                                    </div>

                                    <div class="form-group">
                                        <label class="info-label" for="logo">Photo Saat ini:</label>
                                        <p class="d-flex justify-content-center align-items-center">
                                            @if ($data->image)
                                                <img src="{{ asset('storage/official/' . $data->image) }}" class="img-preview" alt="Logo Desa"
                                                    style="max-width: 150px; height: auto;">
                                            @else
                                                <p class="info-content">Belum tersedia</p>
                                            @endif
                                        </p>
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
        </section>
    </div>
@endsection
