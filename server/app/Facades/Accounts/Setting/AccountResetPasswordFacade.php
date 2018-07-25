<?php 
namespace App\Facades\Accounts\Setting;

use Illuminate\Support\Facades\Facade;

class AccountResetPasswordFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Accounts\Setting\AccountResetPasswordClass";
    }
}