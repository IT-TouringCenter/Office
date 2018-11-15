<?php 
namespace App\Facades\Dashboard\Affiliate\Commission;

use Illuminate\Support\Facades\Facade;

class DashboardAffiliateCommissionMonthlyFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionMonthlyClass";
    }
}