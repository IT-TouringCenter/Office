<?php 
namespace App\Facades\Dashboard\Admin\Users;

use Illuminate\Support\Facades\Facade;

class AdminUserManagementFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Admin\Users\AdminUserManagementClass";
    }
}