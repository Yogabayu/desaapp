@extends('layouts.admin.app')

@section('title', 'Pegawai Desa')

@push('style')
    <style>
        @media screen and (max-width: 767px) {
            table.dataTable.dtr-inline.collapsed>tbody>tr>td.no-column:first-child {
                padding-left: 30px !important;
                width: 20px !important;
            }

            table.dataTable.dtr-inline.collapsed>tbody>tr>td.no-column:first-child:before {
                left: 5px !important;
            }
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pegawai Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Daftar Pegawai Desa</h2>
                <p class="section-lead">Manajemen data pegawai desa.</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pegawai Desa</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('officials.create') }}" class="btn btn-primary">Tambah Pegawai</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th style="width: 1% !important">No</th>
                                                <th style="width: 30px !important">Photo</th>
                                                <th>Nama</th>
                                                <th>Posisi</th>
                                                <th>Desa</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.1/css/rowGroup.bootstrap4.min.css">

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            if (typeof toastr !== 'undefined') {
                // Initialize Toastr options here
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
            } else {
                console.error('Toastr is not loaded');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#table-1').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.childRowImmediate,
                        type: 'none',
                        target: ''
                    }
                },
                ajax: '{!! route('officials.index') !!}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'no-column',
                        responsivePriority: 1,
                        width: '1%'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        responsivePriority: 2,
                        width: '30px'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        responsivePriority: 3,
                        width: '20%'
                    },
                    {
                        data: 'position',
                        name: 'position',
                        responsivePriority: 4
                    },
                    {
                        data: 'village.name',
                        name: 'village.name',
                        responsivePriority: 5
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 6
                    }
                ],
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [{
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 2, 3] // sesuaikan dengan kolom yang ingin Anda print
                    }
                }],
            });

            // Buat tombol print secara manual
            var printButton = '<button id="printButton" class="btn btn-primary ml-2">Print</button>';

            // Tambahkan tombol print ke dalam elemen dengan class 'card-header-action'
            $('.card-header-action').prepend(printButton);

            // Tambahkan event listener untuk tombol print
            $('#printButton').on('click', function() {
                table.button('.buttons-print').trigger();
            });

        });
    </script>

    <script>
        function deleteOfficial(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('officials.destroy', '') }}/${id}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                $('#table-1').DataTable().ajax.reload();
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
@endpush
