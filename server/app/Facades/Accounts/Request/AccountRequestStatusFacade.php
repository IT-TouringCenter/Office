<?php 
namespace App\Facades\Accounts\Request;

use Illuminate\Support\Facades\Facade;

class AccountRequestStatusFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Accounts\Request\AccountRequestStatusClass";
    }
}