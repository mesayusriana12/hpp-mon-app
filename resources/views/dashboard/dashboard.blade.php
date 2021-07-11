@extends('layouts.app')
@section('title','Dashboard')

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
        <div class="col-sm-12 col-md-12">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Grafik Monitoring Tenaga Matahari | {{indonesian_date(date('Y-m-d'))}}
                </div>
                <div class="card-body">
                    <canvas id="sun-chart1" width="400" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-accent-danger">
                <div class="card-header">
                    Grafik Monitoring Tenaga Angin | {{indonesian_date(date('Y-m-d'))}}
                </div>
                <div class="card-body">
                    <canvas id="wind-chart1" width="400" height="100"></canvas>
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
        var sunData = {!! json_encode($sundata) !!}
        var windData = {!! json_encode($winddata) !!}

        var renderSunChart1 = document.getElementById('sun-chart1').getContext('2d');
        var sunChart1 = new Chart(renderSunChart1, {
            type: 'line',
            data: {
                labels: sunData.timestamp,
                datasets: [{
                    label: 'Tegangan',
                    data: sunData.voltage,
                    borderColor: [
                        'rgba(69, 173, 250, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Arus',
                    data: sunData.current,
                    borderColor: [
                        'rgba(191, 85, 138, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nilai'
                        },
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Jam:Menit'
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                var get = this.getLabelForValue(value)
                                var trimmed = get.slice(get.length - 8,(get.length - 3))
                                return trimmed;
                            }
                        }
                    }
                },  
            }
        });

        var renderWindChart1 = document.getElementById('wind-chart1').getContext('2d');
        var windChart1 = new Chart(renderWindChart1, {
            type: 'line',
            data: {
                labels: windData.timestamp,
                datasets: [{
                    label: 'Tegangan',
                    data: windData.voltage,
                    borderColor: [
                        'rgba(154, 168, 58, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Arus',
                    data: windData.current,
                    borderColor: [
                        'rgba(255, 203, 19, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Nilai'
                        },
                        beginAtZero: true,
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Jam:Menit'
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                var get = this.getLabelForValue(value)
                                var trimmed = get.slice(get.length - 8,(get.length - 3))
                                return trimmed;
                            }
                        }
                    }
                },  
            }
        });
    </script>
@endpush