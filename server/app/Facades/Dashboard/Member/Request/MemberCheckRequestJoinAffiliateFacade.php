<?php
namespace App\Facades\Dashboard\Member\Request;

use Illuminate\Support\Facades\Facade;

class MemberCheckRequestJoinAffiliateFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Member\Request\MemberCheckRequestJoinAffiliateClass";
    }
}