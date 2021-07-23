<?php

namespace App\Http\Controllers;

use App\MasterSunData;
use App\MasterWindData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function search(Request $request){

        $data = [];
        if ($request->sun) {
            $get_sun_data = MasterSunData::select(['voltage','lux','created_at'])
            ->whereDate('created_at','>=',$request->date_start)
            ->whereDate('created_at','<=',$request->date_end)
            ->get();

        }
        dd($request);
    }
}
