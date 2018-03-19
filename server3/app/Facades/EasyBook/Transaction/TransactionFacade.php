<?php
namespace App\Facades\EasyBook\Transaction;

use Illuminate\Support\Facades\Facade;

class TransactionFacade extends Facade{
  	protected static function getFacadeAccessor(){
    	return "App\Facades\EasyBook\Transaction\TransactionClass";
  	}
}
?>