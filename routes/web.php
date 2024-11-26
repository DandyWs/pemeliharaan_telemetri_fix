<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers2\HomeController;
use App\Http\Controllers2\UserController;
use App\Http\Controllers2\Setting2Controller;
use App\Http\Controllers2\Komponen2Controller;
use App\Http\Controllers\JenisAlatController;
use App\Http\Controllers2\PemeriksaanController;
use App\Http\Controllers\PemeliharaanController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CetakLaporan;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PageNasabahController;
use App\Http\Controllers\PageSopirController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\TransaksibaruController;
use App\Http\Controllers\TransaksiController;
use App\Models\DetailKomponen;
use App\Models\FormKomponen;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::prefix('/')
//     ->middleware('auth')
//     ->group(function () {
//         Route::resource('users', UserController::class);
//         Route::resource('komponen2s', Komponen2Controller::class);
//         Route::resource('jenis-alats', JenisAlatController::class);
//         Route::resource('pemeliharaan2s', Pemeliharaan2Controller::class);
//         Route::resource('setting2s', Setting2Controller::class);
//         Route::resource('detail-komponens', DetailKomponenController::class);
//         Route::resource('pemeriksaans', PemeriksaanController::class);
//     });

Auth::routes();
Route::get('/logout',[LoginController::class,'logout']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::resource('/detail_componen', DetailController::class)->parameter('detail_componen','id');
    Route::resource('/pemeliharaans', PemeliharaanController::class)->parameter('pemeliharaan','id');
    Route::post('pemeliharaans/data',[PemeliharaanController::class,'data'])->name('data_pemeliharaan');
    Route::post('detail_componen/data',[DetailController::class,'data'])->name('data_detail_componen');
    Route::resource('/alat', AlatController::class)->parameter('alat','id');
    Route::post('alat/data',[AlatController::class,'data'])->name('data_alat');
    Route::resource('/setting', SettingController::class)->parameter('setting','id');
    Route::post('setting/data',[SettingController::class,'data'])->name('data_setting');
    Route::resource('/form_komponen', FormKomponen::class)->parameter('form_komponen','id');
    Route::post('form_komponen/data',[FormKomponen::class,'data'])->name('data_form_komponen');
    Route::resource('/nasabah', NasabahController::class)->parameter('nasabah','id');
    Route::post('nasabah/data',[NasabahController::class,'data'])->name('data_nasabah');
    Route::resource('/sampah', SampahController::class)->parameter('sampah', 'id');
    Route::post('sampah/data',[SampahController::class,'data']);
    Route::resource('/sopir', SopirController::class)->parameter('sopir', 'id');
    Route::post('sopir/data',[SopirController::class,'data'])->name('datasopir');
    // Route::resource('/transaksi', TransaksiController::class)->parameter('transaksi', 'id');
    // Route::get('/laporan',[CetakLaporan::class,'index']);

    // Route::post('/laporan/cetak', [CetakLaporan::class,'cetak'])->name('laporan.cetak');
    // Route::get('/grafik_penjualan',[TransaksibaruController::class,'grafik']);
    // Route::get('/cetakTanggal/{tanggal_awal}/{tanggal_akhir}',[CetakLaporan::class,'cetakTanggal']);
});

Route::group(['middleware' => ['auth', 'role:mekanik']], function(){
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/', [IndexController::class, 'index'])->name('dashboard');
