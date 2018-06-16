<?php 
namespace App\Facades\Bookings;

use Illuminate\Support\Facades\Facade;

class SaveBookingFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Bookings\SaveBookingClass";
    }
}