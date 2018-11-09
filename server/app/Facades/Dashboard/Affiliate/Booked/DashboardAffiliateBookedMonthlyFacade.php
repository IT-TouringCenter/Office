<?php 
namespace App\Facades\Dashboard\Affiliate\Booked;

use Illuminate\Support\Facades\Facade;

class DashboardAffiliateBookedMonthlyFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Affiliate\Booked\DashboardAffiliateBookedMonthlyClass";
    }
}