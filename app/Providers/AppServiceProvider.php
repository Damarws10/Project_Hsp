<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        \View::composer('partials/navbarside', function ($view) {
        $TransaksiDetails= DB::table('transaksi_kendaraan')->select('id_transaksi')->count();
        $view->with(['kendaraan'=>$TransaksiDetails]);
        });

        Schema::defaultStringLength(191);
    }
}
