<?php 
namespace App\Facades\Tours;

use Illuminate\Support\Facades\Facade;

class TourCommissionFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Tours\TourCommissionClass";
    }
}