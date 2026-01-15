<?php

namespace App\Providers;

use App\Helpers\DownloadCategoriesHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Admin
        if ( request()->segment(1) == 'admin' ){

            view()->composer('*', function ($view) {
                // Get Reservations Count
                /*$oc = new OrdersHelper();
                $oc = $oc->getPendingOrdersCount();
                $reservationsCount = $oc['count'];*/
                $reservationsCount = 88;
                view()->share('navReservationsCount', $reservationsCount);
            });
        }
        else{
            view()->composer('*', function ($view) {
                // Get Download Categories
                $dch = new DownloadCategoriesHelper();
                $navDownloadCategories = $dch->getDownloadCategoriesForNavigation();
                view()->share('navDownloadCategories', $navDownloadCategories);
            });
        }
    }
}
