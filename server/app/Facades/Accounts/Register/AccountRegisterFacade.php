<?php 
namespace App\Facades\Accounts\Register;

use Illuminate\Support\Facades\Facade;

class AccountRegisterFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Accounts\Register\AccountRegisterClass";
    }
}