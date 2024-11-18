<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Setting2Controller;
use App\Http\Controllers\Komponen2Controller;
use App\Http\Controllers\JenisAlatController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\Pemeliharaan2Controller;
use App\Http\Controllers\DetailKomponenController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('komponen2s', Komponen2Controller::class);
        Route::resource('jenis-alats', JenisAlatController::class);
        Route::resource('pemeliharaan2s', Pemeliharaan2Controller::class);
        Route::resource('setting2s', Setting2Controller::class);
        Route::resource('detail-komponens', DetailKomponenController::class);
        Route::resource('pemeriksaans', PemeriksaanController::class);
    });
