<?php 
namespace App\Facades\Dashboard\Affiliate\Home;

use Illuminate\Support\Facades\Facade;

class DashboardAffiliateFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Affiliate\Home\DashboardAffiliateClass";
    }
}