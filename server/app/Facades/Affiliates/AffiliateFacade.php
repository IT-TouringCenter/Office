<?php 
namespace App\Facades\Affiliates;

use Illuminate\Support\Facades\Facade;

class AffiliateFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Affiliates\AffiliateClass";    }
}