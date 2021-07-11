<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $userData = User::get();
        return view('dataStaff.list',[
            'userdata' => $userData
        ]);
    }

    public function create()
    {
        return view('dataStaff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'fullname' => 'required',
            'email' => 'email',
            'phone_number' => 'numeric'
        ]);
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make('hppmon'),
            'fullname' => $request->fullname,
            'phone_number' => $request->phone_number,
            'profile_picture' => 'default.jpg',
            'role_id' => 2
        ]);
        Alert::toast('Data staff baru berhasil ditambahkan!','success')        
        ->timerProgressBar();
        return redirect('/data-staff');
    }

    public function edit(User $user)
    {
        return view('dataStaff.edit',['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        Validator::make($request->all(),[
            'username' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        $request->validate([
            'fullname' => 'required',
            'email' => 'email',
            'phone_number' => 'numeric'
        ]);
        User::where('id',$user->id)
        ->update([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);
        Alert::toast('Data staff "' . $user->fullname . '" berhasil diperbaharui!','success')        
        ->timerProgressBar();
        return redirect('/data-staff');
    }

    public function destroy(Request $request)
    {
        foreach ($request->selectid as $item) {
            User::where('id',$item)->delete();
        }
        Alert::toast('Staff terpilih berhasil dihapus!','success')
        ->timerProgressBar();
        return redirect('/data-staff');
    }
}
