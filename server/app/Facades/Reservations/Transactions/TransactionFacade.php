<?php 
namespace App\Facades\Reservations\Transactions;

use Illuminate\Support\Facades\Facade;

class TransactionFacade extends Facade{
    protected static function getFacadeAccessor(){
        return "App\Facades\Reservations\Transactions\TransactionClass";
    }
}