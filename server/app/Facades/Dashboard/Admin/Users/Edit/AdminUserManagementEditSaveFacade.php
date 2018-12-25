<?php 
namespace App\Facades\Dashboard\Admin\Users\Edit;

use Illuminate\Support\Facades\Facade;

class AdminUserManagementEditSaveFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Admin\Users\Edit\AdminUserManagementEditSaveClass";
    }
}