<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('profile.profile',[
            'user' => $user
        ]);
    }

    public function update(Request $request){
        Validator::make($request->all(),[
            'username' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
        ]);
        $request->validate([
            'fullname' => 'required',
            'email' => 'email',
            'phone_number' => 'min:13'
        ]);
        DB::table('users')->where('id',Auth::user()->id)
        ->update([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);
        Alert::toast('Profile berhasil diupdate!','success')
        ->position('center')
        ->timerProgressBar();
        return redirect('/profile');
    }
}
