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
            'delay_on_dashboard' => 'numeric',
            'lux_divider' => 'numeric'
        ]);
        
        if ($request->has('max_data_in_graph')) {
            Setting::where('name','max_data_in_graph')->update(['value' => $request->max_data_in_graph]);
        }

        if ($request->has('delay_on_dashboard')) {
            Setting::where('name','delay_on_dashboard')->update(['value' => $request->delay_on_dashboard]);
        }

        if ($request->has('lux_divider')) {
            Setting::where('name','lux_divider')->update(['value' => $request->lux_divider]);
        }

        Alert::toast('Pengaturan berhasil diupdate!','success')
        ->position('center')
        ->timerProgressBar();

        return redirect('/setting');
    }
    
}
