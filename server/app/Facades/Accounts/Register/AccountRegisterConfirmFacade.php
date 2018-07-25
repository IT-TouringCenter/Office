<?php 
namespace App\Facades\Accounts\Register;

use Illuminate\Support\Facades\Facade;

class AccountRegisterConfirmFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Accounts\Register\AccountRegisterConfirmClass";
    }
}