<?php 
namespace App\Facades\Reservations\BookingForms;

use Illuminate\Support\Facades\Facade;

class BookingFormFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Reservations\BookingForms\BookingFormClass";
    }
}