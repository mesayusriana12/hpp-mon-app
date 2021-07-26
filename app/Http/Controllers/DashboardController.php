<?php

namespace App\Http\Controllers;

use App\MasterSunData;
use App\MasterWindData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Array_;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {   
        $setting = getSetting();
        
        // $last_sun_data = MasterSunData::orderByDesc('id')->first();
        // $last_wind_data = MasterWindData::orderByDesc('id')->first();

        // $optimal = ($last_sun_data->voltage > $last_wind_data->voltage ? 'Mathari' : 'Angin');
        
        return view('dashboard.dashboard',[
            // 'optimal' => $optimal,
            'delay' => ($setting['delay_on_dashboard'] * 1000)
        ]);
    }

    public function ajaxRealtimeSun(){
        $setting = getSetting();

        $get_sun_data = MasterSunData::take($setting['max_data_in_graph'])->orderByDesc('id')->get();
        
        $labels = pushArrayDataTime($get_sun_data->pluck('created_at'));
        $voltage = pushArrayData($get_sun_data->pluck('voltage'));
        $lux = pushArrayData($get_sun_data->pluck('lux'), 1000);
        
        return response()->json([
            'labels' => $labels,
            'voltage' => $voltage,
            'lux' => $lux
        ]);
    }

    public function ajaxRealtimeWind(){
        $setting = getSetting();

        $get_wind_data = MasterWindData::take($setting['max_data_in_graph'])->orderByDesc('id')->get();
        
        $labels = pushArrayDataTime($get_wind_data->pluck('created_at'));
        $voltage = pushArrayData($get_wind_data->pluck('voltage'));
        $wind_speed = pushArrayData($get_wind_data->pluck('wind_speed'));
        
        return response()->json([
            'labels' => $labels,
            'voltage' => $voltage,
            'wind_speed' => $wind_speed
        ]);
    }
}
