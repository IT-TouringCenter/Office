<?php 
namespace App\Facades\Dashboard\Admin\Users\Delete;

use Illuminate\Support\Facades\Facade;

class AdminUserManagementDeleteSaveFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Admin\Users\Delete\AdminUserManagementDeleteSaveClass";
    }
}