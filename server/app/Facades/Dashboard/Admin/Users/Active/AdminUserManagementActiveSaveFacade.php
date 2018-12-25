<?php 
namespace App\Facades\Dashboard\Admin\Users\Active;

use Illuminate\Support\Facades\Facade;

class AdminUserManagementActiveSaveFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Admin\Users\Active\AdminUserManagementActiveSaveClass";
    }
}