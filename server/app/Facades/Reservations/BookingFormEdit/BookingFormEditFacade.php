<?php 
namespace App\Facades\Reservations\BookingFormEdit;

use Illuminate\Support\Facades\Facade;

class BookingFormEditFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Reservations\BookingFormEdit\BookingFormEditClass";
    }
}