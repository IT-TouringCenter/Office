<?php
namespace App\Repositories\EasyBook\Ticket;

use App\Repositories\EasyBook\Email\EmailTransactionReposity as EmailTransactionReposity;
use App\Repositories\EasyBook\Reservation\TransactionRepository as TransactionRepository;
use App\Repositories\EasyBook\Reservation\TransactionDetailReposity as TransactionDetailReposity;

class TicketReposity{
    public function __construct(EmailTransactionReposity $EmailTransactionReposity,TransactionDetailReposity $TransactionDetailReposity,TransactionRepository $TransactionRepository){
        $this->EmailTransactionReposity = $EmailTransactionReposity;
        $this->TransactionRepository =$TransactionRepository;
        $this->TransactionDetailReposity = $TransactionDetailReposity;
    }

    public function GetTicketsByTransactionId($transactionId){
        $transactionDetails= $this->TransactionDetailReposity->GetDataByTransactionId($transactionId);
        if(count($transactionDetails)< 1 || $transactionDetails==null){
            return ["status"=>false,"data"=>"Transactin unvariable to use."];
        }

        $mailDetail = $this->EmailTransactionReposity->GetPendingEmailByTransactionId($transactionId);
         if(count($transactionDetails)< 1 || $transactionDetails==null){
            return ["status"=>false,"data"=>"Find not found primary contact."];
        }

        foreach ($transactionDetails as $item) {
            
        }
    }
}
?>