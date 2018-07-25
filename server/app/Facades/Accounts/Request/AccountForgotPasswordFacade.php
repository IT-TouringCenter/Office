<?php 
namespace App\Facades\Accounts\Request;

use Illuminate\Support\Facades\Facade;

class AccountForgotPasswordFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Accounts\Request\AccountForgotPasswordClass";
    }
}