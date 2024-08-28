@extends('layouts.admin.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin Aktif</h4>
                            </div>
                            <div class="card-body">
                                {{ $userActive }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin Non Aktif</h4>
                            </div>
                            <div class="card-body">
                                {{ $userInactive }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pegawai</h4>
                            </div>
                            <div class="card-body">
                                {{ $official }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total UMKM</h4>
                            </div>
                            <div class="card-body">
                                {{ $umkm }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik APBD</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="182"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Review UMKM terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($umkmReview as $review)
                                    <li class="media">
                                        <img class="rounded-circle mr-3" width="50"
                                            src="{{ asset('admin/img/avatar/avatar-1.png') }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="text-primary float-right">{{ $review->created_at->diffForHumans() }}
                                            </div>
                                            <div class="media-title">{{ $review->name }}</div>
                                            <span class="text-small text-muted">{{ $review->review }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Artikel</h4>
                            <div class="card-header-action">
                                <a href="{{ route('articles.index') }}" class="btn btn-primary">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Author</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($articles->count() == 0)
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @else
                                            @foreach ($articles as $article)
                                                <tr>
                                                    <td>
                                                        {{ $article->title }}
                                                        <div class="table-links">

                                                            <div class="bullet"></div>
                                                            <a href="{{ route('articles.show', $article->slug) }}">View</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="font-weight-600"><img
                                                                src="{{ asset('admin/img/avatar/avatar-1.png') }}"
                                                                alt="avatar" width="30" class="rounded-circle mr-1">
                                                            {{ $article->user->name }}</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                            title="Edit"
                                                            href="{{ route('articles.edit', $article->slug) }}"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <a class="btn btn-danger btn-action" data-toggle="tooltip"
                                                            title="Delete"
                                                            onclick="deleteArticle('{{ $article->slug }}')"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('admin/library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('admin/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin/library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script>
        var labels = {!! json_encode($labels) !!};
        var formattedDatasets = {!! json_encode($formattedDatasets) !!};

        function deleteArticle(slug) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Artikel yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('articles.destroy', '') }}/${slug}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                location.reload();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            toastr.error('An error occurred while deleting the official.');
                        }
                    });
                }
            });
        }
    </script>
    <script src="{{ asset('admin/js/page/index-0.js') }}"></script>
@endpush
