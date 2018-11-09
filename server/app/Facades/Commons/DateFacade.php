<?php 
namespace App\Facades\Commons;

use Illuminate\Support\Facades\Facade;

class DateFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Commons\DateClass";
    }
}