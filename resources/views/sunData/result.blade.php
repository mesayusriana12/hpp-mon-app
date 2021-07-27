<div class="fade-in">
    <div class="card card-accent-primary">
        <div class="card-header">
            Grafik Monitoring Tenaga Matahari Tanggal <strong>"{{indonesian_date($start)}}"</strong> sampai <strong>"{{indonesian_date($end)}}"</strong>
        </div>
        <div class="card-body">
            <canvas id="sun-chart" width="400" height="100"></canvas>
            <div class="text-center text-info">{{ $info }}</div>
        </div>
    </div>
</div>

<script>
    var sunData = {!! json_encode($data) !!}
    
    var renderSunChart1 = document.getElementById('sun-chart');
    var sunChart1 = new Chart(renderSunChart1, {
        type: 'line',
        data: {
            labels: sunData.timestamp,
            datasets: [{
                fill: true,
                label: 'Tegangan (V)',
                data: sunData.voltage,
                borderColor: [
                    'rgba(69, 173, 250, 1)',
                ],
                borderWidth: 2
            },{
                fill: true,
                label: 'Lux (Lux)',
                data: sunData.lux,
                borderColor: [
                    'rgba(221, 77, 134, 1)',
                ],
                borderWidth: 2
            },
            ]
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
                            let get = this.getLabelForValue(value)
                            let trimmed = get.slice(get.length - 8,(get.length - 3))
                            return trimmed;
                        }
                    }
                }
            },  
        }
    });
</script>