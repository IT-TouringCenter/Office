<?php
namespace App\Facades\EasyBook\Ticket;

use Illuminate\Support\Facades\Facade;

class TicketAirportFacade extends Facade{
  protected static function getFacadeAccessor(){
    return "App\Facades\EasyBook\Ticket\TicketAirportClass";
  }
}
?>