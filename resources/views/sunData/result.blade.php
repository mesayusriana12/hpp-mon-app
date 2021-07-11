<div class="fade-in">
    <div class="card card-accent-primary">
        <div class="card-header">
            Grafik Monitoring Tenaga Matahari Tanggal <strong>"{{indonesian_date($start)}}"</strong> sampai <strong>"{{indonesian_date($end)}}"</strong>
        </div>
        <div class="card-body">
            <canvas id="sun-chart" width="400" height="100"></canvas>
        </div>
    </div>
</div>

<script>
    var sunData = {!! json_encode($data) !!}
    
    var renderSunChart1 = document.getElementById('sun-chart').getContext('2d');
    var sunChart1 = new Chart(renderSunChart1, {
        type: 'line',
        data: {
            labels: sunData.timestamp,
            datasets: [{
                label: 'Tegangan (V)',
                data: sunData.voltage,
                borderColor: [
                    'rgba(69, 173, 250, 1)',
                ],
                borderWidth: 2
            },{
                label: 'Arus (A)',
                data: sunData.current,
                borderColor: [
                    'rgba(191, 85, 138, 1)',
                ],
                borderWidth: 2
            },{
                label: 'Lux (Lux)',
                data: sunData.lux,
                borderColor: [
                    'rgba(54, 76, 151, 1)',
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
                            console.log(trimmed);
                            return trimmed;
                        }
                    }
                }
            },  
        }
    });
</script>