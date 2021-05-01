@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Monitor Tenaga Matahari
                </div>
                <div class="card-body">
                    Line Chart
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Monitor Tenaga Angin
                </div>
                <div class="card-body">
                    Line Chart
                </div>
            </div>
        </div>
    </div>
@endsection