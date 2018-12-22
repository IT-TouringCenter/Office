<?php 
namespace App\Facades\Dashboard\Admin\Users\Add;

use Illuminate\Support\Facades\Facade;

class AdminUserManagementAddFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Admin\Users\Add\AdminUserManagementAddClass";
    }
}