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
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Grafik Monitoring Tenaga Matahari | {{indonesian_date(date('Y-m-d'))}}
                </div>
                <div class="card-body">
                    <canvas id="test" width="400" height="100"></canvas>
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

        var setupTestChart = document.getElementById('test').getContext('2d');
        var testChart = new Chart(setupTestChart, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Tegangan',
                    data: [],
                    borderColor: [
                        'rgba(69, 173, 250, 1)',
                    ],
                    borderWidth: 2
                },{
                    label: 'Arus',
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

        var updateChart = function(){
            $.ajax({
                url: "{{ route('testchart') }}",
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    testChart.data.labels = data.labels;
                    testChart.data.datasets[0].data = data.tegangan;
                    testChart.data.datasets[1].data = data.arus;
                    testChart.update();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }
        
        updateChart();
        setInterval(() => {
            updateChart();
        }, 2000);
    </script>
@endpush