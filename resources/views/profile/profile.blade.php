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
    <link href="{{ asset('plugins/cropper/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/cropper/cropper.min.css')}}" rel="stylesheet">
    <script src="{{ asset('plugins/cropper/dropzone.min.js')}}"></script>
    <script src="{{ asset('plugins/cropper/cropper.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <form method="POST">
                        @csrf
                        <div class="text-center">
                            <label for="upload_image" id="overlay-img">
                                <img id='uploaded_image' src="{{ asset('images/profile_picture/'.Auth::user()->profile_picture)}}" alt="Profile Picture" width="230px" style="border:1px solid gray; cursor:pointer">
                                <input type="file" name="image" class="image" id="upload_image" style="display: none">
                            </label>
                            <div class="text-muted">Klik foto untuk merubah foto profil!</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="" id="sample_image" />
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
            //profile picture
            var modal = $('#modal');
            var image = document.getElementById('sample_image');
            var cropper;
            $('#upload_image').change(function(event){
                var files = event.target.files;
        
                var done = function(url){
                    image.src = url;
                    modal.modal('show');
                };
        
                if(files && files.length > 0)
                {
                    reader = new FileReader();
                    reader.onload = function(event)
                    {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });
            modal.on('shown.coreui.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    preview:'.preview'
                });
            }).on('hidden.coreui.modal', function(){
                cropper.destroy();
                cropper = null;
            });
        
            $('#crop').click(function(){
                canvas = cropper.getCroppedCanvas({
                    width:400,
                    height:400
                });
        
                canvas.toBlob(function(blob){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function(){
                        var base64data = reader.result;
                        var urlnya = "{{url('/profile/pp')}}";
                        $.ajax({
                            url:urlnya,
                            method:'POST',
                            data:{image:base64data},
                            success:function(data)
                            {
                                var url_pathname = window.location.href;
                                window.location = url_pathname;
                                modal.modal('hide');
                            }
                        });
                    };
                });
            });
            
        });
    </script>
@endpush