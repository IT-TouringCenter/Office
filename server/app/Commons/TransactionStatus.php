<?php
namespace App\Commons;

class TransactionStatus{
    const PENDING=1;
    const APPROVED = 2;
    const EXPIRED= 3;
    const CANCELLED = 4;
    const ERROR = 5;
}
?>