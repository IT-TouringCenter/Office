<?php 
namespace App\Facades\Reservations\Invoices;

use Illuminate\Support\Facades\Facade;

class InvoiceTourFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Reservations\Invoices\InvoiceTourClass";
    }
}