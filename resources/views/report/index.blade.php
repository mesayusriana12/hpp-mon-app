@extends('layouts.app')
@section('title','Pelaporan')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item active" aria-current="page">Pelaporan</li>
        </ol>
    </nav>
@endsection

@section('third_party_stylesheets')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-accent-success">
                <div class="card-header">
                    Preview Laporan
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="preview">
                        <div class="row">
                            <div class="col-sm-5 col-md-5">
                                <div id="datepicker">
                                    <div class="input-group input-daterange">
                                        <input type="text" class="form-control" placeholder="Tanggal Mulai" 
                                            id="date_start" autocomplete="off">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-secondary">Sampai</button>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Tanggal Berakhir"
                                            id="date_end" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5">
                                Data untuk ditampilkan :
                                <input type="checkbox" name="sun" id="sun"> Matahari
                                <input type="checkbox" name="wind" id="wind"> Angin
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <button class="btn btn-dark" type="submit" id="btn-submit">Lihat Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div id="panel-output"></div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
    <script src="{{ asset('plugins/sweetalert2/js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function () {
            $('#datepicker .input-daterange').datepicker({
                format: 'yyyy-mm-dd',
                orientation:'bottom',
                autoclose: true,
                todayHighlight: true,
                endDate: '0d'
            });
            $('#preview').on('submit', function () {
                event.preventDefault();
                let date_start = $('#date_start').val();
                let date_end = $('#date_end').val();
                let sun = $('#sun').is(':checked');
                let wind = $('#wind').is(':checked');
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('reportPreview') }}",
                    type: 'POST',
                    data: {
                        date_start: date_start,
                        date_end: date_end,
                        sun: sun,
                        wind: wind
                    },
                    success: function(response) {
                        $('#panel-output').html(response);
                    },
                    error: function (jXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: 'Error!',
                        text: "Pencarian laporan gagal! Mohon periksa tanggal yang dicari!",
                        icon: 'error',
                        width: 600
                    });
                }
                });
            });
        });
    </script>
@endpush