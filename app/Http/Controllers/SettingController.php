<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function index()
    {
        $setting = getSetting();
        return view('setting.index', ['setting' => $setting]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'max_data_in_graph' => 'numeric',
            'delay_on_dashboard' => 'numeric'
        ]);
        
        if ($request->has('max_data_in_graph')) {
            Setting::where('name','max_data_in_graph')->update(['value' => $request->max_data_in_graph]);
        }

        if ($request->has('delay_on_dashboard')) {
            Setting::where('name','delay_on_dashboard')->update(['value' => $request->delay_on_dashboard]);
        }

        Alert::toast('Pengaturan berhasil diupdate!','success')
        ->position('center')
        ->timerProgressBar();

        return redirect('/setting');
    }
    
    public function testchart()
    {
        $setting = getSetting();

        DB::table('test_chart')->insert([
            'tegangan' => rand(1,240)/10,
            'arus' => rand(1,120)/10,
            'timestamps' => date('Y-m-d H:i:s')
        ]);
        
        $get = DB::table('test_chart')->take($setting['max_data_in_graph'])->orderByDesc('id')->get();
        
        $labels = $get->pluck('timestamps')->toArray();
        $tegangan = $get->pluck('tegangan')->toArray();
        $arus = $get->pluck('arus')->toArray();
        
        $labels = array_reverse($labels);
        $tegangan = array_reverse($tegangan);
        $arus = array_reverse($arus);
        
        return response()->json([
            'labels' => $labels,
            'tegangan' => $tegangan,
            'arus' => $arus
        ]);
    }
}
