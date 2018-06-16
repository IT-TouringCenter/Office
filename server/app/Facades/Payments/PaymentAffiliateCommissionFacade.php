<?php 
namespace App\Facades\Payments;

use Illuminate\Support\Facades\Facade;

class PaymentAffiliateCommissionFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Payments\PaymentAffiliateCommissionClass";
    }
}