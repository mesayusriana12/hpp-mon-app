<?php

namespace App\Http\Controllers;

use App\MasterWindData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;

class WindDataController extends Controller
{
    public function index(){
        $windData = MasterWindData::get();
        return view('windData.list',[
            'windData' => $windData
        ]);
    }

    public function delete(Request $request){
        foreach ($request->selectid as $item) {
            MasterWindData::where('id',$item)->delete();
        }
        Alert::toast('Data angin terpilih berhasil dihapus!','success')
        ->position('center')
        ->timerProgressBar();
        return redirect('/wind-data');
    }

    public function graph(){
        return view('windData.search');
    }

    public function ajaxGraph(Request $request){
        $setting = getSetting();
        $data = new stdClass();
        $get_data = DB::table('m_wind_data')->latest()->take($setting['max_data_in_graph'])
        ->select(['voltage','current','rpm','wind_speed','created_at'])
        ->whereDate('created_at','>=',$request->date_start)
        ->whereDate('created_at','<=',$request->date_end)
        ->get();

        pushObjectDataTime($data,$get_data->pluck('created_at'),'timestamp');
        ($request->voltage == 'true' ? pushObjectData($data,$get_data->pluck('voltage'),'voltage') : '');
        ($request->current == 'true' ? pushObjectData($data,$get_data->pluck('current'),'current') : '');
        ($request->rpm == 'true' ? pushObjectData($data,$get_data->pluck('rpm'),'rpm',1000) : '');
        ($request->wind_speed == 'true' ? pushObjectData($data,$get_data->pluck('wind_speed'),'wind_speed') : '');
        
        return view('windData.result',[
            'start' => $request->date_start,
            'end' => $request->date_end,
            'data' => $data
        ]);
    }
    
    public function test(){
        $lastId = DB::table('m_main_data')->orderByDesc('id')->first();
        $lastId->id++;
        DB::table('m_main_data')->insert(['id' => $lastId->id]);
        MasterWindData::create([
            'data_id' => 'A-' . rand(1,100),
            'voltage' => rand(1,240)/10,
            'current' => rand(1,120)/10,
            'rpm' => rand(1,64000),
            'wind_speed' => rand(1,500)/10,
            'main_data_id' => $lastId->id
        ]);
        return redirect('/wind-data');
    }
}
