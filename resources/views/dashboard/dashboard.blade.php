@extends('layouts.app')
@section('title','Dashboard')

@push('page_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
@endsection

@section('content')
    {{-- <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="text-muted text-right">
                        <i class="fa fa-bolt fa-3x"></i>
                    </div>
                    <div class="text-value-lg"> {{ $optimal }} </div>
                    <small class="text-muted text-uppercase font-weight-bold">Tegangan terbesar</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="text-muted text-right">
                        <i class="fa fa-clock fa-3x"></i>
                    </div>
                    <div class="text-value-lg"> cek cek </div>
                    <small class="text-muted text-uppercase font-weight-bold">Data terbaru tercatat</small>
                </div>
            </div>
        </div>
    </div> --}}
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

        var renderSunChart1 = document.getElementById('sun-chart1').getContext('2d');
        var sunChart1 = new Chart(renderSunChart1, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    fill: true,
                    label: 'Tegangan (V)',
                    data: [],
                    borderColor: [
                        'rgba(69, 173, 250, 1)',
                    ],
                    borderWidth: 2
                },{
                    fill: true,
                    label: 'Lux (Lux) * 10',
                    data: [],
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
                labels: [],
                datasets: [{
                    fill: true,
                    label: 'Tegangan (V)',
                    data: [],
                    borderColor: [
                        'rgba(154, 168, 58, 1)',
                    ],
                    borderWidth: 2
                },{
                    fill: true,
                    label: 'Kecepatan Angin (m/s)',
                    data: [],
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

        var updateChart1 = function(){
            $.ajax({
                url: "{{ route('ajaxRTS') }}",
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    sunChart1.data.labels = data.labels;
                    sunChart1.data.datasets[0].data = data.voltage;
                    sunChart1.data.datasets[1].data = data.lux;
                    sunChart1.update();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        var updateChart2 = function(){
            $.ajax({
                url: "{{ route('ajaxRTW') }}",
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    windChart1.data.labels = data.labels;
                    windChart1.data.datasets[0].data = data.voltage;
                    windChart1.data.datasets[1].data = data.wind_speed;
                    windChart1.update();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        updateChart1();
        updateChart2();
        setInterval(() => {
            updateChart1();
            updateChart2();
        }, {{ $delay }});
    </script>
@endpush