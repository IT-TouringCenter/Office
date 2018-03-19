<?php 
namespace App\Repositories\EasyBook\Reservation\Transaction;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class TransactionSourceRepository extends Repository{
    function model(){return 'App\transaction_source';}
}