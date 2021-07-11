<?php

namespace App\Http\Controllers;

use App\MasterSunData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;

class SunDataController extends Controller
{
    public function index(){
        $sunData = MasterSunData::get();
        return view('sunData.list',[
            'sundata' => $sunData
        ]);
    }

    public function delete(Request $request){
        foreach ($request->selectid as $item) {
            MasterSunData::where('id',$item)->delete();
        }
        Alert::toast('Data matahari terpilih berhasil dihapus!','success')
        ->position('center')
        ->timerProgressBar();
        return redirect('/sun-data');
    }

    public function graph(){
        return view('sunData.search');
    }

    public function ajaxGraph(Request $request){
        $data = new stdClass();
        $get_data = DB::table('m_sun_data')->latest()->take(env('HPP_MAX_DATA_IN_GRAPH'))
        ->select(['voltage','current','lux','created_at'])
        ->whereDate('created_at','>=',$request->date_start)
        ->whereDate('created_at','<=',$request->date_end)
        ->get();

        pushObjectDataTime($data,$get_data->pluck('created_at'),'timestamp');
        ($request->voltage == 'true' ? pushObjectData($data,$get_data->pluck('voltage'),'voltage') : '');
        ($request->current == 'true' ? pushObjectData($data,$get_data->pluck('current'),'current') : '');
        ($request->lux == 'true' ? pushObjectData($data,$get_data->pluck('lux'),'lux',1000) : '');
        
        return view('sunData.result',[
            'start' => $request->date_start,
            'end' => $request->date_end,
            'data' => $data
        ]);
    }
    
    public function test(){
        $lastId = DB::table('m_main_data')->orderByDesc('id')->first();
        $lastId->id++;
        DB::table('m_main_data')->insert(['id' => $lastId->id]);
        MasterSunData::create([
            'data_id' => 'M-' . rand(1,100),
            'voltage' => rand(1,240)/10,
            'current' => rand(1,120)/10,
            'lux' => rand(1,1000000)/10,
            'main_data_id' => $lastId->id
        ]);
        return redirect('/sun-data');
    }
}
