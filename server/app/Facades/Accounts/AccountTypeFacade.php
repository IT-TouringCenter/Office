<?php 
namespace App\Facades\Accounts;

use Illuminate\Support\Facades\Facade;

class AccountTypeFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Accounts\AccountTypeClass";
    }
}