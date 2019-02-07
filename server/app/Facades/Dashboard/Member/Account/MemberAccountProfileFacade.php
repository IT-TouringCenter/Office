<?php
namespace App\Facades\Dashboard\Member\Account;

use Illuminate\Support\Facades\Facade;

class MemberAccountProfileFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Member\Account\MemberAccountProfileClass";
    }
}