<?php

namespace App\Providers;

use App\Models\NasabahModel;
use App\Models\SampahModel;
use App\Models\SopirModel;
use App\Models\TransaksiBaruModel;

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
        view::share('hitungNasabah', NasabahModel::count());

        View::share('hitungSopir', SopirModel::count());
        View::share('hitungSampah', SampahModel::count());

        View::share('hitungJadwal', TransaksiBaruModel::count());
    }

}

