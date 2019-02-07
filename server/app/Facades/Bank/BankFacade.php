<?php 
namespace App\Facades\Bank;

use Illuminate\Support\Facades\Facade;

class BankFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Bank\BankClass";
    }
}