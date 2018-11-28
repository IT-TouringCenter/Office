<?php 
namespace App\Facades\Affiliates\Commission;

use Illuminate\Support\Facades\Facade;

class AffiliateCommissionFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Affiliates\Commission\AffiliateCommissionClass";
    }
}