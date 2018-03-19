<?php 
namespace App\Facades\Reservations\BookingStatistics;

use Illuminate\Support\Facades\Facade;

class BookingStatisticsFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Reservations\BookingStatistics\BookingStatisticsClass";
    }
}