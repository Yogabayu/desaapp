@extends('layouts.admin.app')

@section('title', 'Edit Galeri Desa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Galeri Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Galeri Desa</h2>
                <p class="section-lead">Form untuk mengedit galeri desa.</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Galeri</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('galery.update', $gallery->uuid) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Nama Galeri</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $gallery->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Deskripsi</label>
                                        <textarea class="form-control" id="desc" name="desc">{{ old('desc', $gallery->desc) }}</textarea>
                                        @error('desc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection