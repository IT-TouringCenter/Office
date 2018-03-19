<?php 
namespace App\Facades\EasyBook\Reservation\Activity\Tour;

use Illuminate\Support\Facades\Facade;

class TourProgramFacade extends Facade{
  protected static function getFacadeAccessor(){
    return "App\Facades\EasyBook\Reservation\Activity\Tour\TourProgramClass";
  }
}