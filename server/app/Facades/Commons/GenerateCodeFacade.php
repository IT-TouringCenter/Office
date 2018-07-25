<?php 
namespace App\Facades\Commons;

use Illuminate\Support\Facades\Facade;

class GenerateCodeFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Commons\GenerateCodeClass";
    }
}