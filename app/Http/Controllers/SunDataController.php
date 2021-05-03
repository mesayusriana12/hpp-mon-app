<?php

namespace App\Http\Controllers;

use App\MasterSunData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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
