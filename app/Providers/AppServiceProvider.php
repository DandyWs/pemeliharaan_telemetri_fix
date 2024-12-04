<?php

namespace App\Providers;

use App\Models\AlatTelemetri;
use App\Models\JenisAlat;
use App\Models\Komponen2;
use App\Models\NasabahModel;
use App\Models\Pemeliharaan2;
use App\Models\SampahModel;
use App\Models\SopirModel;
use App\Models\TransaksiBaruModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap(); 
        view()->composer('*', function($view){
            $view->with('hitungUser', User::count());
            $view->with('hitungKomponen', Komponen2::count());
            $view->with('hitungPemeliharaan', Pemeliharaan2::count());
            $view->with('hitungPem', Pemeliharaan2::whereDate('tanggal', now()->toDateString())->count());
            // $view->with('hitungPemKet', Pemeliharaan2::whereNull('keterangan')->count());
            $view->with('hitungAlat', AlatTelemetri::count());
            $view->with('hitungJenis', JenisAlat::count());
        });
    }

}

