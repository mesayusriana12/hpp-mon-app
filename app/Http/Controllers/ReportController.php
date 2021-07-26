<?php

namespace App\Http\Controllers;

use App\MasterSunData;
use App\MasterWindData;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function search(Request $request)
    {
        $data = [];
        $info_sun = [];
        $info_wind = [];

        if ($request->type == 'sun') {
            $get_sun_data = MasterSunData::select(['data_id AS sun_id','voltage','lux','created_at AS recorded_at'])
            ->whereDate('created_at','>=',$request->date_start)
            ->whereDate('created_at','<=',$request->date_end)
            ->get();
            $data['sun'] = $get_sun_data;

            if($data['sun']->isNotEmpty()){
                $info_sun['max_voltage_value'] = $get_sun_data->max('voltage') . ' V';
                $info_sun['max_voltage_time'] = indonesian_date($get_sun_data->where('voltage', $get_sun_data->max('voltage'))->first()->recorded_at, true);

                $info_sun['max_lux_value'] = $get_sun_data->max('lux') . ' Lux';
                $info_sun['max_lux_time'] = indonesian_date($get_sun_data->where('lux', $get_sun_data->max('lux'))->first()->recorded_at, true);

                $info_sun['avg_voltage_value'] = $get_sun_data->avg('voltage') . ' V';
                $info_sun['avg_lux_value'] = $get_sun_data->avg('lux') . ' Lux';
            }
        }

        if ($request->type == 'wind') {
            $get_wind_data = MasterWindData::select(['data_id AS wind_id','voltage','wind_speed','created_at AS recorded_at'])
            ->whereDate('created_at','>=',$request->date_start)
            ->whereDate('created_at','<=',$request->date_end)
            ->get();
            $data['wind'] = $get_wind_data;

            if($data['wind']->isNotEmpty()){
                $info_wind['max_voltage_value'] = $get_wind_data->max('voltage') . ' V';
                $info_wind['max_voltage_time'] = indonesian_date($get_wind_data->where('voltage', $get_wind_data->max('voltage'))->first()->recorded_at, true);

                $info_wind['max_ws_value'] = $get_wind_data->max('wind_speed');
                $info_wind['max_ws_time'] = indonesian_date($get_wind_data->where('wind_speed', $get_wind_data->max('wind_speed'))->first()->recorded_at, true);

                $info_wind['avg_voltage_value'] = $get_wind_data->avg('voltage') . ' V';
                $info_wind['avg_ws_value'] = $get_wind_data->avg('wind_speed');
            }
        }

        return view('report.result',[
            'data' => $data,
            'start_date' => $request->date_start,
            'end_date' => $request->date_end,
            'info_sun' => $info_sun,
            'info_wind' => $info_wind
        ]);
    }

    public function pdf($type, $start, $end)
    {
        $data = [];
        $info_sun = [];
        $info_wind = [];

        if ($type == 'sun') {
            $get_sun_data = MasterSunData::select(['data_id AS sun_id','voltage','lux','created_at AS recorded_at'])
            ->whereDate('created_at','>=',$start)
            ->whereDate('created_at','<=',$end)
            ->get();
            $data['sun'] = $get_sun_data;

            if($data['sun']->isNotEmpty()){
                $info_sun['max_voltage_value'] = $get_sun_data->max('voltage') . ' V';
                $info_sun['max_voltage_time'] = indonesian_date($get_sun_data->where('voltage', $get_sun_data->max('voltage'))->first()->recorded_at, true);

                $info_sun['max_lux_value'] = $get_sun_data->max('lux') . ' Lux';
                $info_sun['max_lux_time'] = indonesian_date($get_sun_data->where('lux', $get_sun_data->max('lux'))->first()->recorded_at, true);

                $info_sun['avg_voltage_value'] = $get_sun_data->avg('voltage') . ' V';
                $info_sun['avg_lux_value'] = $get_sun_data->avg('lux') . ' Lux';
            }
        }

        if ($type == 'wind') {
            $get_wind_data = MasterWindData::select(['data_id AS wind_id','voltage','wind_speed','created_at AS recorded_at'])
            ->whereDate('created_at','>=',$start)
            ->whereDate('created_at','<=',$end)
            ->get();
            $data['wind'] = $get_wind_data;

            if($data['wind']->isNotEmpty()){
                $info_wind['max_voltage_value'] = $get_wind_data->max('voltage') . ' V';
                $info_wind['max_voltage_time'] = indonesian_date($get_wind_data->where('voltage', $get_wind_data->max('voltage'))->first()->recorded_at, true);

                $info_wind['max_ws_value'] = $get_wind_data->max('wind_speed');
                $info_wind['max_ws_time'] = indonesian_date($get_wind_data->where('wind_speed', $get_wind_data->max('wind_speed'))->first()->recorded_at, true);

                $info_wind['avg_voltage_value'] = $get_wind_data->avg('voltage') . ' V';
                $info_wind['avg_ws_value'] = $get_wind_data->avg('wind_speed');
            }
        }

        return view('report.pdf', [
            'data' => $data,
            'start_date' => $start,
            'end_date' => $end,
            'info_sun' => $info_sun,
            'info_wind' => $info_wind
        ]);
    }
}
