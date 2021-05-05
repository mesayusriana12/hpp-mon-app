@extends('layouts.app')
@section('title','Data Matahari')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item">Monitoring</li>
            <li class="breadcrumb-item active" aria-current="page">Matahari</li>
        </ol>
    </nav>
@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables/css/datatables.min.css')}}"  type="text/css">
@endsection

@push('page_css')
    <style>
        div.dataTables_wrapper div.dataTables_length select{
            width: 60px
        }
        .separator{
            border-bottom: 1px solid #d8dbe0;
            margin-bottom: 1em;
        }
        .swal2-title{
            font-size: 1.5em !important;
        }
        .swal2-content{
            font-size: 1em !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-accent-primary">
                <div class="card-header">
                    <strong>Data dari Energi Matahari</strong>
                </div>
                <div class="card-body">
                    <form action="{{route('deleteSunData')}}" method="post" id="delete-sundata">
                        @csrf
                        @method('delete')
                    </form>
                    <form action="{{route('insertDummySun')}}" method="get" id="insert-dummy"></form>
                    <button type="button" class="btn btn-danger mb-3" id="btn-delete" form="delete-sundata">
                        <span class="cil-trash btn-icon mr-2"></span>
                        Hapus Data Terpilih
                    </button>
                    <button type="submit" class="btn btn-info mb-3" id="btn-delete" form="insert-dummy">
                        <span class="cil-plus btn-icon mr-2"></span>
                        Tambah Data Dummy
                    </button>
                    <div class="separator"></div>
                    <table id="table-sun" class="table table-bordered table-stripped text-center" width="100%">
                        <thead>
                            <tr>
                                <th scope="col" width="6%">Checkbox</th>
                                <th scope="col">Data ID</th>
                                <th scope="col">Tegangan</th>
                                <th scope="col">Arus</th>
                                <th scope="col">Lux</th>
                                <th scope="col">Timestamps</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sundata as $item)
                                <tr>
                                    <td><input type="checkbox" name="selectid[]" value="{{$item->id}}" class="check-item" form="delete-sundata"></td>
                                    <td>{{$item->data_id}}</td>
                                    <td>{{$item->voltage}} V</td>
                                    <td>{{$item->current}} A</td>
                                    <td>{{$item->lux}}</td>
                                    <td>{{indonesian_date($item->created_at,true)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('third_party_scripts')
    <script src="{{ asset('plugins/sweetalert2/js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datatables/js/datatables.min.js') }}" type="text/javascript"></script>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#table-sun').DataTable({
                language: {
                    url: "{{asset('plugins/datatables/js/Indonesian.json')}}"
                }   
            });
            $('#btn-delete').on('click', function () {
                var check = document.querySelector('.check-item:checked');
                if(check === null){
                    Swal.fire({
                        width: 600,
                        title: 'Sepertinya ada kesalahan...',
                        text: "Tidak ada data yang dipilih untuk dihapus!",
                        icon: 'error',
                    });
                } else {
                    Swal.fire({
                        width: 700,
                        title: 'Anda yakin ingin menghapus data terpilih?',
                        text: "Data yang sudah di hapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.value == true) {
                            $("#delete-sundata").submit();
                        }}
                    );
                }
            });
        });
    </script>
@endpush