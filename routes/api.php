<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Setting2Controller;
use App\Http\Controllers\Api\Komponen2Controller;
use App\Http\Controllers\Api\JenisAlatController;
use App\Http\Controllers\Api\PemeriksaanController;
use App\Http\Controllers\Api\Pemeliharaan2Controller;
use App\Http\Controllers\Api\DetailKomponenController;
use App\Http\Controllers\Api\UserPemeliharaan2sController;
use App\Http\Controllers\Api\JenisAlatAlatTelemetrisController;
use App\Http\Controllers\Api\Komponen2DetailKomponensController;
use App\Http\Controllers\Api\Pemeliharaan2PemeriksaansController;
use App\Http\Controllers\Api\Pemeliharaan2FormKomponensController;
use App\Http\Controllers\Api\DetailKomponenFormKomponensController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UserController::class);

        // User Pemeliharaan2s
        Route::get('/users/{user}/pemeliharaan2s', [
            UserPemeliharaan2sController::class,
            'index',
        ])->name('users.pemeliharaan2s.index');
        Route::post('/users/{user}/pemeliharaan2s', [
            UserPemeliharaan2sController::class,
            'store',
        ])->name('users.pemeliharaan2s.store');

        Route::apiResource('komponen2s', Komponen2Controller::class);

        // Komponen2 Detail Komponens
        Route::get('/komponen2s/{komponen2}/detail-komponens', [
            Komponen2DetailKomponensController::class,
            'index',
        ])->name('komponen2s.detail-komponens.index');
        Route::post('/komponen2s/{komponen2}/detail-komponens', [
            Komponen2DetailKomponensController::class,
            'store',
        ])->name('komponen2s.detail-komponens.store');

        Route::apiResource('jenis-alats', JenisAlatController::class);

        // JenisAlat Alat Telemetris
        Route::get('/jenis-alats/{jenisAlat}/alat-telemetris', [
            JenisAlatAlatTelemetrisController::class,
            'index',
        ])->name('jenis-alats.alat-telemetris.index');
        Route::post('/jenis-alats/{jenisAlat}/alat-telemetris', [
            JenisAlatAlatTelemetrisController::class,
            'store',
        ])->name('jenis-alats.alat-telemetris.store');

        Route::apiResource('pemeliharaan2s', Pemeliharaan2Controller::class);

        // Pemeliharaan2 Form Komponens
        Route::get('/pemeliharaan2s/{pemeliharaan2}/form-komponens', [
            Pemeliharaan2FormKomponensController::class,
            'index',
        ])->name('pemeliharaan2s.form-komponens.index');
        Route::post('/pemeliharaan2s/{pemeliharaan2}/form-komponens', [
            Pemeliharaan2FormKomponensController::class,
            'store',
        ])->name('pemeliharaan2s.form-komponens.store');

        // Pemeliharaan2 Pemeriksaans
        Route::get('/pemeliharaan2s/{pemeliharaan2}/pemeriksaans', [
            Pemeliharaan2PemeriksaansController::class,
            'index',
        ])->name('pemeliharaan2s.pemeriksaans.index');
        Route::post('/pemeliharaan2s/{pemeliharaan2}/pemeriksaans', [
            Pemeliharaan2PemeriksaansController::class,
            'store',
        ])->name('pemeliharaan2s.pemeriksaans.store');

        Route::apiResource('setting2s', Setting2Controller::class);

        Route::apiResource('detail-komponens', DetailKomponenController::class);

        // DetailKomponen Form Komponens
        Route::get('/detail-komponens/{detailKomponen}/form-komponens', [
            DetailKomponenFormKomponensController::class,
            'index',
        ])->name('detail-komponens.form-komponens.index');
        Route::post('/detail-komponens/{detailKomponen}/form-komponens', [
            DetailKomponenFormKomponensController::class,
            'store',
        ])->name('detail-komponens.form-komponens.store');

        Route::apiResource('pemeriksaans', PemeriksaanController::class);
    });
