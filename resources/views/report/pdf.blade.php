<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HPP-Monitor | Cetak PDF</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" href="{{ asset('images/logo/HPP_Monitor-logo-mini.png')}}">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/all.min.css')}}">

    {{-- jquery --}}
    <script src="{{asset('js/jquery.slim.js')}}" type="text/javascript"></script>
    <style>
        #sun_info.table th, #sun_info.table td,
        #wind_info.table th, #wind_info.table td{
            border-top: 0 !important;
        }
    </style>
</head>

<body onload="window.print()">

<center>
    <h2>HPP Monitoring App</h2>
    <h3>Laporan Pencatatan Data</h3>
    <h5>Dari "{{ indonesian_date($start_date) }}" sampai "{{ indonesian_date($end_date) }}"</h5>
</center>
<hr>
@if (array_key_exists('sun', $data))
    <span class="mb-3" style="float: right">Sumber Energi : <strong>Matahari</strong></span>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: rgb(197, 197, 197)">
                    <th class="text-center">Kode Data</th>
                    <th class="text-center">Tegangan</th>
                    <th class="text-center">Lux</th>
                    <th class="text-center">Waktu Tercatat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['sun'] as $item)
                    <tr>
                        <td class="text-center">{{ $item->sun_id }}</td>
                        <td class="text-center">{{ $item->voltage }} V</td>
                        <td class="text-center">{{ $item->lux }} Lux</td>
                        <td class="text-center">{{ indonesian_date($item->recorded_at, true) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($data['sun']->isNotEmpty())
        <div class="row" id="sun_export">
            <div class="col-md-8">
                <div class="additional">
                    <table class="table" id="sun_info">
                        <tbody>
                            <tr>
                                <td>Tegangan Terbesar</td>
                                <td>:</td>
                                <td>{{ $info_sun['max_voltage_value'] }}</td>
                                <td> tercatat pada </td>
                                <td>:</td>
                                <td>{{ $info_sun['max_voltage_time'] }}</td>
                            </tr>
                            <tr>
                                <td>Lux Terbesar</td>
                                <td>:</td>
                                <td>{{ $info_sun['max_lux_value'] }}</td>
                                <td> tercatat pada </td>
                                <td>:</td>
                                <td>{{ $info_sun['max_lux_time'] }}</td>
                            </tr>
                            <tr>
                                <td>Rata-rata Tegangan</td>
                                <td>:</td>
                                <td>{{ round($info_sun['avg_voltage_value'], 2) }}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Rata-rata Lux</td>
                                <td>:</td>
                                <td>{{ round($info_sun['avg_lux_value'], 2) }}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="text-center">
            <h4 class="text-danger">Data tidak ditemukan.</h4>
        </div>
        @endif
@endif
@if (array_key_exists('wind', $data))
    <span class="mb-3" style="float: right">Sumber Energi : <strong>Angin</strong></span>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: rgb(197, 197, 197)">
                    <th class="text-center">Kode Data</th>
                    <th class="text-center">Tegangan</th>
                    <th class="text-center">Kecepatan Angin</th>
                    <th class="text-center">Waktu Tercatat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['wind'] as $item)
                    <tr>
                        <td class="text-center">{{ $item->wind_id }}</td>
                        <td class="text-center">{{ $item->voltage }} V </td>
                        <td class="text-center">{{ $item->wind_speed }} <sup>m/s</sup></td>
                        <td class="text-center">{{ indonesian_date($item->recorded_at, true) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($data['wind']->isNotEmpty())
        <div class="row" id="wind_export">
            <div class="col-md-8">
                <div class="additional">
                    <table class="table" id="wind_info">
                        <tbody>
                            <tr>
                                <td>Tegangan Terbesar</td>
                                <td>:</td>
                                <td>{{ $info_wind['max_voltage_value'] }}</td>
                                <td> tercatat pada </td>
                                <td>:</td>
                                <td>{{ $info_wind['max_voltage_time'] }}</td>
                            </tr>
                            <tr>
                                <td>Kec. Angin Terbesar</td>
                                <td>:</td>
                                <td>{{ $info_wind['max_ws_value'] }} <sup>m/s</sup></td>
                                <td> tercatat pada </td>
                                <td>:</td>
                                <td>{{ $info_wind['max_ws_time'] }}</td>
                            </tr>
                            <tr>
                                <td>Rata-rata Tegangan</td>
                                <td>:</td>
                                <td>{{ round($info_wind['avg_voltage_value'], 2) }}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Rata-rata Kec. Angin</td>
                                <td>:</td>
                                <td>{{ round($info_wind['avg_ws_value'], 2) }} <sup>m/s</sup></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <h4 class="text-danger">Data tidak ditemukan.</h4>
        </div>
    @endif
@endif

<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.perfect-scrollbar.js') }}"></script>
</body>
</html>