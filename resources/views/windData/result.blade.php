<div class="fade-in">
    <div class="card card-accent-primary">
        <div class="card-header">
            Grafik Monitoring Tenaga Angin Tanggal <strong>"{{indonesian_date($start)}}"</strong> sampai <strong>"{{indonesian_date($end)}}"</strong>
        </div>
        <div class="card-body">
            <canvas id="wind-chart" width="400" height="100"></canvas>
        </div>
    </div>
</div>

<script>
    var windData = {!! json_encode($data) !!}
    
    var renderWindChart1 = document.getElementById('wind-chart').getContext('2d');
    var windChart1 = new Chart(renderWindChart1, {
        type: 'line',
        data: {
            labels: windData.timestamp,
            datasets: [{
                label: 'Tegangan (V)',
                data: windData.voltage,
                borderColor: [
                    'rgba(69, 173, 250, 1)',
                ],
                borderWidth: 2
            },{
                label: 'Arus (A)',
                data: windData.current,
                borderColor: [
                    'rgba(191, 85, 138, 1)',
                ],
                borderWidth: 2
            },{
                label: 'RPM',
                data: windData.rpm,
                borderColor: [
                    'rgba(54, 76, 151, 1)',
                ],
                borderWidth: 2
            },{
                label: 'Kec. Angin (m/s)',
                data: windData.wind_speed,
                borderColor: [
                    'rgba(244, 148, 26, 1)',
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