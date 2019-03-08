<?php 
namespace App\Facades\Dashboard\Admin\Request;

use Illuminate\Support\Facades\Facade;

class AdminUserRequestUpdateFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Admin\Request\AdminUserRequestUpdateClass";
    }
}