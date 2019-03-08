<?php
namespace App\Facades\Dashboard\Member\Approval;

use Illuminate\Support\Facades\Facade;

class MemberApprovalFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Member\Approval\MemberApprovalClass";
    }
}