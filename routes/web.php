<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//route auth
Route::get('/', function () { return redirect('/login'); });
Auth::routes();

//route dashboard
Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth')->name('dashboard');

//route profile
Route::prefix('/profile')->middleware('auth')->group(function () {
    Route::get('/',[ProfileController::class,'index'])->name('viewProfile');
    Route::put('/',[ProfileController::class,'update'])->name('updateProfile');
    Route::post('/pp',[ProfileController::class,'updateProfilePicture'])->name('updateProfilePicture');
});

