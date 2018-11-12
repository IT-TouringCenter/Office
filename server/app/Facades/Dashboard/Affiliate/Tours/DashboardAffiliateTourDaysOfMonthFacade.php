<?php 
namespace App\Facades\Dashboard\Affiliate\Tours;

use Illuminate\Support\Facades\Facade;

class DashboardAffiliateTourDaysOfMonthFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Affiliate\Tours\DashboardAffiliateTourDaysOfMonthClass";
    }
}