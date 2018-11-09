<?php 
namespace App\Facades\Dashboard\Affiliate\Traveled;

use Illuminate\Support\Facades\Facade;

class DashboardAffiliateTraveledFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledClass";
    }
}