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
        Alert::toast('Profil berhasil diupdate!','success')
        ->position('center')
        ->timerProgressBar();
        return redirect('/profile');
    }

    public function updateProfilePicture(Request $request){
        $image = $request->image;

        DB::table('users')->where('id', Auth::user()->id)
        ->update(['profile_picture' => Auth::user()->username .'.png']);
        
        $image_array_1 = explode(";", $image);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = 'images/profile_picture/' . Auth::user()->username . '.png';
        file_put_contents($image_name, $data);
        Alert::toast('Foto Profil berhasil diperbaharui!','success')
        ->position('center')
        ->timerProgressBar();
    }
}
