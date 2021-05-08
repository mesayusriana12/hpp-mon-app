@extends('layouts.app')
@section('title','Edit Data Staff')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item">Data Staff</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data Staff</li>
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
        .card {
            min-height: 350px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-accent-dark">
                <div class="card-header">
                    <strong> Form Edit Staff "{{$user->fullname}}" </strong>
                </div>
                <div class="card-body">
                    <form action="{{route('datastaff.update',['user' => $user->id])}}" class="form-horizontal" method="POST" id="formUpdateStaff">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="username">Username : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" placeholder="Username" value="{{$user->username}}">
                                @error('username') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="fullname">Nama Lengkap : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" type="text" placeholder="Nama Lengkap" value="{{$user->fullname}}">
                                @error('fullname') <div class="invalid-feedback">Mohon isi Nama Lengkap.</div> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="email">Email : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Email" value="{{$user->email}}">
                                @error('email') <div class="invalid-feedback">Mohon isi Email dengan format yang benar.</div> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="phone_number">Nomor Telepon : </label>
                            <div class="col-md-9">
                                <input class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" type="number" placeholder="Nomor Telepon (Mohon hanya isi dengan angka)" value="{{$user->phone_number}}">
                                @error('phone_number') <div class="invalid-feedback">Mohon isi Nomor Telepon hanya dengan angka.</div> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button class="btn btn-success" type="submit" id="btn-submit" form="formUpdateStaff"> Submit </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection