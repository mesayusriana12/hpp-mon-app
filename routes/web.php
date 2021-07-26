<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArduinoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SunDataController;
use App\Http\Controllers\WindDataController;
use App\Http\Controllers\UserController;

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

//route arduino
Route::prefix('/arduino')->group(function () {
    Route::get('/simpanMatahari',[ArduinoController::class,'sun']);
    Route::get('/simpanAngin',[ArduinoController::class,'wind']);
});

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
    Route::get('/graph',[SunDataController::class,'graph'])->name('viewGraphSun');
    Route::post('/graph',[SunDataController::class,'ajaxGraph'])->name('ajaxGraphSun');
});

//route data angin
Route::prefix('/wind-data')->middleware('auth')->group(function () {
    Route::get('/',[WindDataController::class,'index'])->name('viewWindData');
    Route::get('/test',[WindDataController::class,'test'])->name('insertDummyWind');
    Route::delete('/',[WindDataController::class,'delete'])->name('deleteWindData');
    Route::get('/graph',[WindDataController::class,'graph'])->name('viewGraphWind');
    Route::post('/graph',[WindDataController::class,'ajaxGraph'])->name('ajaxGraphWind');
});

//route CRUD user
Route::prefix('/data-staff')->middleware('auth')->group(function () {
    Route::get('/',[UserController::class,'index'])->name('datastaff.list');
    Route::get('/create',[UserController::class,'create'])->name('datastaff.create');
    Route::post('/',[UserController::class,'store'])->name('datastaff.store');
    Route::get('/{user}/edit',[UserController::class,'edit'])->name('datastaff.edit');
    Route::put('/{user}',[UserController::class,'update'])->name('datastaff.update');
    Route::delete('/',[UserController::class,'destroy'])->name('datastaff.delete');
});

//route pelaporan
Route::prefix('/report')->middleware('auth')->group(function () {
    Route::get('/',[ReportController::class,'index'])->name('report');
    Route::post('/preview',[ReportController::class,'search'])->name('reportPreview');
    Route::get('/excel/{type}/{start}/{end}',[ReportController::class,'excel'])->name('reportExcel');
    Route::get('/pdf/{type}/{start}/{end}',[ReportController::class,'pdf'])->name('reportPDF');
});
//route log

//route pengaturan aplikasi
Route::prefix('/setting')->middleware('auth')->group(function () {
    Route::get('/',[SettingController::class,'index'])->name('setting');
    Route::post('/save',[SettingController::class,'save'])->name('saveSetting');
});

Route::get('/test',function () { return view('test'); })->name('test');
Route::post('/test',[SettingController::class,'testchart'])->name('testchart');