<?php 
namespace App\Facades\Dashboard\Manager\Affiliate;

use Illuminate\Support\Facades\Facade;

class ManagerAffiliateUpdateCommissionRateFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Manager\Affiliate\ManagerAffiliateUpdateCommissionRateClass";
    }
}