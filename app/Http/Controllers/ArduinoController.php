<?php

namespace App\Http\Controllers;

use App\MasterSunData;
use App\MasterWindData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArduinoController extends Controller
{
    public function sun(Request $request){
        $lastId = DB::table('m_main_data')->orderByDesc('id')->first();
        $lastId->id++;
        DB::table('m_main_data')->insert(['id' => $lastId->id]);

        $lastRowSun = MasterSunData::count();
        $lastRowSun++;
        
        MasterSunData::create([
            'data_id' => 'M-' . $lastRowSun,
            'voltage' => $request->teganganPanel1,
            'lux' => $request->lux,
            'main_data_id' => $lastId->id
        ]);
    }

    public function wind(Request $request){
        $lastId = DB::table('m_main_data')->orderByDesc('id')->first();
        $lastId->id++;
        DB::table('m_main_data')->insert(['id' => $lastId->id]);

        $lastRowWind = MasterWindData::count();
        $lastRowWind++;
        
        MasterWindData::create([
            'data_id' => 'A-' . $lastRowWind,
            'voltage' => $request->teganganBaling1,
            'wind_speed' => $request->kecepatan,
            'main_data_id' => $lastId->id
        ]);        
    }
}
