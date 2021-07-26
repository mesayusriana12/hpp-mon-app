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

        $lastRowSun = MasterSunData::orderBy('data_id','desc')->first();
        $lastIdSun = $lastRowSun->data_id;
        $split = explode('-', $lastIdSun)[1];
        $split++;
        
        MasterSunData::create([
            'data_id' => 'M-' . $split,
            'voltage' => $request->teganganPanel1,
            'lux' => $request->lux,
            'main_data_id' => $lastId->id
        ]);
    }

    public function wind(Request $request){
        $lastId = DB::table('m_main_data')->orderByDesc('id')->first();
        $lastId->id++;
        DB::table('m_main_data')->insert(['id' => $lastId->id]);

        $lastRowWind = MasterWindData::orderBy('data_id','desc')->first();
        $lastIdWind = $lastRowWind->data_id;
        $split = explode('-', $lastIdWind)[1];
        $split++;
        
        MasterWindData::create([
            'data_id' => 'A-' . $split,
            'voltage' => $request->teganganBaling1,
            'wind_speed' => $request->kecepatan,
            'main_data_id' => $lastId->id
        ]);        
    }
}
