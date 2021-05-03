<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SunDataController;
use App\Http\Controllers\WindDataController;

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

//route data matahari
Route::prefix('/sun-data')->middleware('auth')->group(function () {
    Route::get('/',[SunDataController::class,'index'])->name('viewSunData');
    Route::get('/test',[SunDataController::class,'test'])->name('insertDummySun');
    Route::delete('/',[SunDataController::class,'delete'])->name('deleteSunData');
});

//route data angin
Route::prefix('/wind-data')->middleware('auth')->group(function () {
    Route::get('/',[WindDataController::class,'index'])->name('viewWindData');
    Route::get('/test',[WindDataController::class,'test'])->name('insertDummyWind');
    Route::delete('/',[WindDataController::class,'delete'])->name('deleteWindData');
});