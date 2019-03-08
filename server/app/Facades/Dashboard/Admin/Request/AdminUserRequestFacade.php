<?php 
namespace App\Facades\Dashboard\Admin\Request;

use Illuminate\Support\Facades\Facade;

class AdminUserRequestFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Admin\Request\AdminUserRequestClass";
    }
}