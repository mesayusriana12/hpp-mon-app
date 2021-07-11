@extends('layouts.app')
@section('title','Pengaturan Aplikasi')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
        </ol>
    </nav>
@endsection

@push('page_css')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-accent-primary">
                <div class="card-header">
                    <strong> Pengaturan Aplikasi </strong>
                </div>
                <div class="card-body">
                    <form action="{{route('saveSetting')}}" class="form-horizontal" method="POST" id="setting">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="max_data_in_graph"> Jumlah data pada grafik : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('max_data_in_graph') is-invalid @enderror setting-form" id="max_data_in_graph" name="max_data_in_graph" type="number"
                                placeholder="Jumlah data yang ditampilkan pada grafik" value="{{ $setting['max_data_in_graph'] }}">
                                @error('max_data_in_graph') <div class="invalid-feedback">Mohon isi hanya dengan angka.</div> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="delay_on_dashboard">Delay grafik dashboard (detik): </label>
                            <div class="col-md-9">
                                <input class="form-control @error('delay_on_dashboard') is-invalid @enderror setting-form" id="delay_on_dashboard" name="delay_on_dashboard"
                                type="number" placeholder="Delay waktu update grafik pada dashboard (detik)" value="{{ $setting['delay_on_dashboard'] }}">
                                @error('delay_on_dashboard') <div class="invalid-feedback">Mohon isi hanya dengan angka.</div> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button class="btn btn-success" type="button" id="btn-submit" form="setting" disabled> Simpan </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('third_party_scripts')
    <script src="{{ asset('plugins/sweetalert2/js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function (){
            $(".setting-form").on("input", function() {
                $(this).css('border','1px solid #8bc34a');
                $('#btn-submit').attr('disabled', false);
            });

            $('#btn-submit').on('click', function (event) {
                event.preventDefault;
                Swal.fire({
                    width: 600,
                    title: 'Konfirmasi',
                    text: 'Anda yakin ingin menyimpan perubahan pengaturan baru?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value == true) {
                            $('#setting').submit();
                    } else {
                        return false;
                    }} 
                );
            });
        });
    </script>
@endpush