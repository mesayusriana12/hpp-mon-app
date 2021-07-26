<div class="card card-accent-primary fade-in">
    <div class="card-header">
        Cetak Laporan
    </div>
    <div class="card-body">
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
                                <td class="text-center">{{ $item->voltage }}</td>
                                <td class="text-center">{{ $item->lux }}</td>
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
                                        <td>{{ $info_sun['avg_voltage_value'] }}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Rata-rata Lux</td>
                                        <td>:</td>
                                        <td>{{ $info_sun['avg_lux_value'] }}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="button-action" style="position: absolute; bottom: 5px; right: 15px">
                            <a target="_blank" href="{{url('/report/pdf/sun/' . $start_date . '/' . $start_date)}}">
                                <button type="button" class="btn btn-danger mb-3">
                                    <span class="fa fa-file-pdf btn-icon mr-2"></span>
                                    Simpan PDF
                                </button>
                            </a>
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
                                <td class="text-center">{{ $item->voltage }}</td>
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
                                        <td>{{ $info_wind['avg_voltage_value'] }}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Rata-rata Kec. Angin</td>
                                        <td>:</td>
                                        <td>{{ $info_wind['avg_ws_value'] }} <sup>m/s</sup></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="button-action" style="position: absolute; bottom: 5px; right: 15px">
                            <a target="_blank" href="{{url('/report/pdf/wind/' . $start_date . '/' . $start_date)}}">
                                <button type="button" class="btn btn-danger mb-3">
                                    <span class="fa fa-file-pdf btn-icon mr-2"></span>
                                    Simpan PDF
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <h4 class="text-danger">Data tidak ditemukan.</h4>
                </div>
            @endif
        @endif
    </div>
</div>