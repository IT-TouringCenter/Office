<?php 
namespace App\Facades\Bookings;

use Illuminate\Support\Facades\Facade;

class UpdateBookingPaymentFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Bookings\UpdateBookingPaymentClass";
    }
}