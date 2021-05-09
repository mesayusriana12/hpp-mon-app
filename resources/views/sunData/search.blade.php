@extends('layouts.app')
@section('title','Grafik | Matahari')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item">Grafik Monitoring</li>
            <li class="breadcrumb-item active" aria-current="page">Matahari</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Cari Grafik Monitoring Tenaga Matahari
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
    <script src="{{ asset('plugins/chartjs/chart.js') }}" type="text/javascript"></script>
@endsection
@push('page_scripts')
    <script>
        
    </script>
@endpush