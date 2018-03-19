<?php
namespace App\Facades\EasyBook\Invoice;

// use App\transaction_transfer_convention as model;
use App\Repositories\EasyBook\Transaction\TransactionConventionRepository as ConvRepo;

class InvoiceConventionClass{
    public function __construct(ConvRepo $ConvRepo){
        $this->ConvRepo = $ConvRepo;
    }

    public function GetInvoiceByTransactionId($transactionId){

        $head = $this->ConvRepo->GetInvoieByTransactionId($transactionId);
        if($head == null){
            return [];
        }

        $passengers = $this->ConvRepo->GetPassengerByTransactionId($transactionId);
        if($passengers == null){
            return [];
        }

        return [
            'transactionId'=>$head[0]->transaction_id,
            'transfer'=>$head[0]->transfer,
            'billNumber'=>$head[0]->billlNumber,
            'issueDate'=>date('d F Y H:i:s', strtotime($head[0]->issueDate)).' Hrs.',
            'unit'=>$head[0]->unit,
            'price'=>$head[0]->price,
            'amount'=>$head[0]->amount,
            'passengers'=>$passengers
        ];

    }
}
?>