@extends('layouts.admin.app')

@section('title', 'Pegawai Desa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Pegawai Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Tambah Pegawai Desa</h2>
                <p class="section-lead">Manajemen data pegawai desa</p>

                <div class="card">
                    <form method="post" class="needs-validation" novalidate="" action="{{ route('officials.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" required="true">
                                    <div class="invalid-feedback">
                                        Nama wajib diisi
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Posisi</label>
                                    <input type="text" name="position" class="form-control" required="true">
                                    <div class="invalid-feedback">
                                        Posisi wajib diisi
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <div class="invalid-feedback">
                                        Foto wajib diisi
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
