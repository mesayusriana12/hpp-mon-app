<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {   
        $sun_data = new stdClass();
        $get_sun_data = DB::table('m_sun_data')->latest()->take(15)
        ->select(['voltage','current','lux','created_at'])
        ->whereRaw("created_at LIKE '" . date('Y-m-d') . "%'")->get();

        pushObjectData($sun_data,$get_sun_data->pluck('voltage'),'voltage');
        pushObjectData($sun_data,$get_sun_data->pluck('current'),'current');
        pushObjectData($sun_data,$get_sun_data->pluck('lux'),'lux');
        pushObjectDataTime($sun_data,$get_sun_data->pluck('created_at'),'timestamp');
        
        $wind_data = new stdClass();
        $get_wind_data = DB::table('m_wind_data')->latest()->take(15)
        ->select(['voltage','current','rpm','wind_speed','created_at'])
        ->whereRaw("created_at LIKE '" . date('Y-m-d') . "%'")->get();

        pushObjectData($wind_data,$get_wind_data->pluck('voltage'),'voltage');
        pushObjectData($wind_data,$get_wind_data->pluck('current'),'current');
        pushObjectData($wind_data,$get_wind_data->pluck('rpm'),'rpm');
        pushObjectData($wind_data,$get_wind_data->pluck('wind_speed'),'wind_speed');
        pushObjectDataTime($wind_data,$get_wind_data->pluck('created_at'),'timestamp');
        
        return view('dashboard.dashboard',[
            'sundata' => $sun_data,
            'winddata' => $wind_data
        ]);
    }
}
