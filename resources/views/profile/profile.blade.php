@extends('layouts.app')
@section('title','Profile')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/css/sweetalert2.min.css')}}">
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
        <div class="col-sm-8 col-md-8">
            <div class="card card-accent-dark">
                <div class="card-header">
                    <strong> Informasi </strong>
                </div>
                <div class="card-body">
                    <form action="{{route('updateProfile')}}" class="form-horizontal" method="POST" id="formUpdateProfile">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="username">Username : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" placeholder="Username" value="{{$user->username}}" readonly>
                                @error('username') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="fullname">Nama Lengkap : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" type="text" placeholder="Nama Lengkap" value="{{$user->fullname}}" readonly>
                                @error('fullname') <div class="invalid-feedback">Mohon isi Nama Lengkap.</div> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="email">Email : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Email" value="{{$user->email}}" readonly>
                                @error('email') <div class="invalid-feedback">Mohon isi Email dengan format yang benar.</div> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="phone_number">Nomor Telepon : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" type="number" placeholder="Nomor Telepon (Mohon hanya isi dengan angka)" value="{{$user->phone_number}}" readonly>
                                @error('phone_number') <div class="invalid-feedback">Mohon isi Nomor Telepon hanya dengan angka dan tidak melebihi 13 karakter.</div> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button class="btn btn-info" type="button" id="btn-change"> Ubah Informasi </button>
                        <button class="btn btn-danger" type="submit" id="btn-reset" hidden> Batalkan Perubahan </button>
                        <button class="btn btn-success" type="submit" id="btn-submit" hidden> Konfirmasi Perubahan </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="card card-accent-dark">
                <div class="card-header">
                    <strong> Foto Profil </strong>
                </div>
                <div class="card-body">
                    Line Chart
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
        var user = {!! json_encode($user) !!}
        $(document).ready(function () {
            $('#phone_number').on('keyup', function () { 
                this.value = this.value.replace(/[^,\d]/g, '');
            });
            $('#btn-change').on('click', function () {
                $('#username').attr('readonly',false)
                $('#fullname').attr('readonly',false)
                $('#email').attr('readonly',false)
                $('#phone_number').attr('readonly',false)
                $('#btn-submit').attr('hidden',false)
                $('#btn-reset').attr('hidden',false)
                $('#btn-change').attr('hidden',true)
            });
            $('#btn-reset').on('click', function () {
                $('#username').attr('readonly',true).val(user.username)
                $('#fullname').attr('readonly',true).val(user.fullname)
                $('#email').attr('readonly',true).val(user.email)
                $('#phone_number').attr('readonly',true).val(user.phone_number)
                $('#btn-submit').attr('hidden',true)
                $('#btn-change').attr('hidden',false)
                $('#btn-reset').attr('hidden',true)
            });
            $('#btn-submit').on('click', function () {
                Swal.fire({
                    width: 550,
                    title: 'Konfirmasi',
                    text: 'Anda yakin menerapkan perubahan pada profil?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#formUpdateProfile').submit();
                    }
                });
                
            });
        });
    </script>
@endpush