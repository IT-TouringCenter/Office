<?php 
namespace App\Facades\Dashboard\Affiliate\Traveled;

use Illuminate\Support\Facades\Facade;

class DashboardAffiliateTraveledMonthlyFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledMonthlyClass";
    }
}