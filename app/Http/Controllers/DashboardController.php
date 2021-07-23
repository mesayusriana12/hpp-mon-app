<?php

namespace App\Http\Controllers;

use App\MasterSunData;
use App\MasterWindData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {   
        $setting = getSetting();
        $sun_data = new stdClass();
        $get_sun_data = MasterSunData::latest()->take($setting['max_data_in_graph'])
        ->select(['voltage','lux','created_at'])
        ->whereRaw("created_at LIKE '" . date('Y-m-d') . "%'")->get();

        pushObjectData($sun_data,$get_sun_data->pluck('voltage'),'voltage');
        pushObjectData($sun_data,$get_sun_data->pluck('lux'),'lux');
        pushObjectDataTime($sun_data,$get_sun_data->pluck('created_at'),'timestamp');
        
        $wind_data = new stdClass();
        $get_wind_data = MasterWindData::latest()->take($setting['max_data_in_graph'])
        ->select(['voltage','wind_speed','created_at'])
        ->whereRaw("created_at LIKE '" . date('Y-m-d') . "%'")->get();

        pushObjectData($wind_data,$get_wind_data->pluck('voltage'),'voltage');
        pushObjectData($wind_data,$get_wind_data->pluck('wind_speed'),'wind_speed');
        pushObjectDataTime($wind_data,$get_wind_data->pluck('created_at'),'timestamp');
        
        return view('dashboard.dashboard',[
            'sundata' => $sun_data,
            'winddata' => $wind_data
        ]);
    }
}
