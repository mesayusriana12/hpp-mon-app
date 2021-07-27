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
        $setting = getSetting();
        $data = new stdClass();
        $get_data = MasterSunData::latest()->take($setting['max_data_in_graph'])
        ->select(['voltage','lux','created_at'])
        ->whereDate('created_at','>=',$request->date_start)
        ->whereDate('created_at','<=',$request->date_end)
        ->get();

        pushObjectDataTime($data,$get_data->pluck('created_at'),'timestamp');
        ($request->voltage == 'true' ? pushObjectData($data,$get_data->pluck('voltage'),'voltage') : '');
        ($request->lux == 'true' ? pushObjectData($data,$get_data->pluck('lux'),'lux', $setting['lux_divider']) : '');
        
        $info =  'Hasil pengukuran lux dibagi ' . $setting['lux_divider'] . ' untuk mempermudah pembacaan data.
                    Untuk nilai aslinya cukup dikalikan ' . $setting['lux_divider'];

        return view('sunData.result',[
            'start' => $request->date_start,
            'end' => $request->date_end,
            'data' => $data,
            'info' => $info
        ]);
    }
}
