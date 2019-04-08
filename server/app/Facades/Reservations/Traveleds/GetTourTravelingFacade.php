<?php 
namespace App\Facades\Reservations\Traveleds;

use Illuminate\Support\Facades\Facade;

class GetTourTravelingFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Reservations\Traveleds\GetTourTravelingClass";
    }
}