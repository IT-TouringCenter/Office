<?php 
namespace App\Facades\Accounts;

use Illuminate\Support\Facades\Facade;

class AccountLoginFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Accounts\AccountLoginClass";
    }
}