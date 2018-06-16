<?php 
namespace App\Facades\Reservations\Transactions;

use Illuminate\Support\Facades\Facade;

class EditReservationFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Reservations\Transactions\EditReservationClass";
    }
}