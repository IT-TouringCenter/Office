<?php 
namespace App\Facades\Reservation\Tour;

use Illuminate\Support\Facades\Facade;

class TourInvoiceFacade extends Facade{
  protected static function getFacadeAccessor(){
    return "App\Facades\EasyBook\Tour\TourInvoiceClass";
  }
}