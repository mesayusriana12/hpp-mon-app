<?php

namespace App\Http\Controllers;

use App\MasterWindData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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
