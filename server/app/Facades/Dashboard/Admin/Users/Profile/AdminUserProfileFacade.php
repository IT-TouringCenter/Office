<?php 
namespace App\Facades\Dashboard\Admin\Users\Profile;

use Illuminate\Support\Facades\Facade;

class AdminUserProfileFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Dashboard\Admin\Users\Profile\AdminUserProfileClass";
    }
}