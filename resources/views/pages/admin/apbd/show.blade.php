@extends('layouts.admin.app')

@section('title', 'Lihat Data Publikasi APBD Desa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><i class="fas fa-store"></i> Publikasi APBD Desa</h1>
                <div class="section-header-breadcrumb">
                    <x-breadcrumb />
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fas fa-eye"></i> Lihat Publikasi APBD</h4> 
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">
                                        <i class="fas fa-info-circle"></i> Deskripsi
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="4" cols="50" readonly>{{ $apbd->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="amount" class="col-sm-2 col-form-label">
                                        <i class="fas fa-user"></i> Total Dana
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="text"
                                                   class="form-control @error('amount') is-invalid @enderror"
                                                   id="amount" name="amount" value="{{ number_format($apbd->amount, 0, ',', '.') }}"
                                                   data-type="currency" data-prefix="Rp " data-thousands="."
                                                   data-decimal="," readonly>
                                            @error('amount')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="date" class="col-sm-2 col-form-label">
                                        <i class="fas fa-user"></i> Tanggal
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                                               id="date" name="date" value="{{ $apbd->date }}" readonly>
                                        @error('date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="type" class="col-sm-2 col-form-label">
                                        <i class="fas fa-toggle-on"></i> Jenis Dana
                                    </label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('type') is-invalid @enderror" id="type"
                                                name="type" readonly>
                                            <option value="1" {{ $apbd->type == 1 ? 'selected' : 'disabled' }}> Pelaksanaan
                                            </option>
                                            <option value="2" {{ $apbd->type == 2 ? 'selected' : 'disabled' }}> Pendapatan
                                            </option>
                                            <option value="3" {{ $apbd->type == 3 ? 'selected' : 'disabled' }}>
                                                Pembelanjaan
                                            </option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endSection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#amount').maskMoney({
                prefix: 'Rp ',
                thousands: '.',
                decimal: ',',
                precision: 0, // Set precision to 0 to remove decimal places
                allowZero: true,
                allowNegative: false
            });
        });
    </script>
@endpush