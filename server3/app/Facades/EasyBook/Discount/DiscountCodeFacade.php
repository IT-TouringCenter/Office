<?php
namespace App\Facades\EasyBook\Discount;

use Illuminate\Support\Facades\Facade;

class DiscountCodeFacade extends Facade{
  	protected static function getFacadeAccessor(){
    	return "App\Facades\EasyBook\Discount\DiscountCodeClass";
  	}
}
?>