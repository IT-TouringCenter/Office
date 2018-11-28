<?php 
namespace App\Facades\Tours;

use Illuminate\Support\Facades\Facade;

class TourFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Tours\TourClass";
    }
}