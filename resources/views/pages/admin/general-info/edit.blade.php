@extends('layouts.admin.app')

@section('title', 'Edit Data Desa - ' . $generalInfo->name)

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Desa - {{ $generalInfo->name }}</h1>
                <x-breadcrumb />
            </div>
            
        </section>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Info Umum Desa</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('general-info.update', $generalInfo->slug) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Desa:</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ $generalInfo->name }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat:</label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror" id="address"
                                                name="address" value="{{ $generalInfo->address }}">
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ $generalInfo->email }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tlp">Telepon:</label>
                                            <input type="text" class="form-control @error('tlp') is-invalid @enderror"
                                                id="tlp" name="tlp" value="{{ $generalInfo->tlp }}">
                                            @error('tlp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="area">Luas Wilayah (Ha):</label>
                                            <input type="number" class="form-control @error('area') is-invalid @enderror"
                                                id="area" name="area" value="{{ $generalInfo->area }}">
                                            @error('area')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="total_population">Jumlah Penduduk:</label>
                                            <input type="number"
                                                class="form-control @error('total_population') is-invalid @enderror"
                                                id="total_population" name="total_population"
                                                value="{{ $generalInfo->total_population }}">
                                            @error('total_population')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="total_dusun">Jumlah Dusun:</label>
                                            <input type="number"
                                                class="form-control @error('total_dusun') is-invalid @enderror"
                                                id="total_dusun" name="total_dusun"
                                                value="{{ $generalInfo->total_dusun }}">
                                            @error('total_dusun')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="total_rt">Jumlah RT:</label>
                                            <input type="number"
                                                class="form-control @error('total_rt') is-invalid @enderror"
                                                id="total_rt" name="total_rt"
                                                value="{{ $generalInfo->total_rt }}">
                                            @error('total_rt')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="total_umkm">Jumlah UMKM:</label>
                                            <input type="number"
                                                class="form-control @error('total_umkm') is-invalid @enderror"
                                                id="total_umkm" name="total_umkm"
                                                value="{{ $generalInfo->total_umkm }}">
                                            @error('total_umkm')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fb">Facebook:</label>
                                            <input type="text" class="form-control @error('fb') is-invalid @enderror"
                                                id="fb" name="fb" value="{{ $generalInfo->fb }}">
                                            @error('fb')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="wa">WhatsApp:</label>
                                            <input type="text" class="form-control @error('wa') is-invalid @enderror"
                                                id="wa" name="wa" value="{{ $generalInfo->wa }}">
                                            @error('wa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="ig">Instagram:</label>
                                            <input type="text" class="form-control @error('ig') is-invalid @enderror"
                                                id="ig" name="ig" value="{{ $generalInfo->ig }}">
                                            @error('ig')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="ytb">YouTube:</label>
                                            <input type="text" class="form-control @error('ytb') is-invalid @enderror"
                                                id="ytb" name="ytb" value="{{ $generalInfo->ytb }}">
                                            @error('ytb')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="web">Website:</label>
                                            <input type="text" class="form-control @error('web') is-invalid @enderror"
                                                id="web" name="web" value="{{ $generalInfo->web }}">
                                            @error('web')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="short_desc">Deskripsi Singkat:</label>
                                            <textarea class="form-control @error('short_desc') is-invalid @enderror" id="short_desc" name="short_desc">{{ $generalInfo->short_desc }}</textarea>
                                            @error('short_desc')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="long_desc">Deskripsi Lengkap:</label>
                                            <textarea class="form-control @error('long_desc') is-invalid @enderror" id="long_desc" name="long_desc">{{ $generalInfo->long_desc }}</textarea>
                                            @error('long_desc')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="general_image">Gambar Umum:</label>
                                            <input type="file"
                                                class="form-control-file @error('general_image') is-invalid @enderror"
                                                id="general_image" name="general_image">
                                            <img src="{{ asset('storage/general_info/' . $generalInfo->general_image) }}"
                                                class="img-thumbnail mt-2" alt="Gambar Umum Desa"
                                                style="max-width: 300px;">
                                            @error('general_image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="logo">Logo Desa:</label>
                                            <input type="file"
                                                class="form-control-file @error('logo') is-invalid @enderror"
                                                id="logo" name="logo">
                                            <img src="{{ asset('storage/general_info/' . $generalInfo->logo) }}"
                                                class="img-thumbnail mt-2" alt="Logo Desa" style="max-width: 100px;">
                                            @error('logo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fasilities">Fasilitas Desa:</label>
                                            <textarea class="form-control @error('fasilities') is-invalid @enderror" id="fasilities" name="fasilities">{{ $generalInfo->fasilities }}</textarea>
                                            @error('fasilities')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="general_work">Kegiatan Desa:</label>
                                            <textarea class="form-control @error('general_work') is-invalid @enderror" id="general_work" name="general_work">{{ $generalInfo->general_work }}</textarea>
                                            @error('general_work')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="visi">Visi:</label>
                                            <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi">{{ $generalInfo->visi }}</textarea>
                                            @error('visi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="misi">Misi:</label>
                                            <textarea class="form-control @error('misi') is-invalid @enderror" id="misi" name="misi">{{ $generalInfo->misi }}</textarea>
                                            @error('misi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
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
            $('#short_desc').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                    ['fontsize', ['fontsize']],
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32',
                    '36'
                ],
            });
            $('#long_desc').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                    ['fontsize', ['fontsize']],
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32',
                    '36'
                ],
            });
            $('#fasilities').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                    ['fontsize', ['fontsize']],
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32',
                    '36'
                ],
            });
            $('#general_work').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                    ['fontsize', ['fontsize']],
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32',
                    '36'
                ],
            });
            $('#visi').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                    ['fontsize', ['fontsize']],
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32',
                    '36'
                ],
            });
            $('#misi').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                    ['fontsize', ['fontsize']],
                ],
                fontSizes: ['8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32',
                    '36'
                ],
            });
        });
    </script>
@endpush
