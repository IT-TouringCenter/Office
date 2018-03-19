<?php
namespace App\Facades\EasyBook\Transaction;

use Illuminate\Support\Facades\Facade;

class TransactionTransferFacade extends Facade{
    protected static function getFacadeAccessor(){
        return 'App\Facades\EasyBook\Transaction\TransactionTransferClass';
    }
}
?>