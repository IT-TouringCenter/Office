<?php
namespace App\Facades\EasyBook\Invoice;

use App\transaction_transfer_airport as TransactionAirport;
use App\Repositories\EasyBook\Transaction\TransactionAirportRepository as AirRepo;

class InvoiceAirportClass{
    public function __construct(AirRepo $AirRepo){
        $this->AirRepo = $AirRepo;
    }

    public function GetInvoiceByTransactionId($transactionId){
        $head = $this->AirRepo->GetInvoiceByTransactionId($transactionId);
        if($head == null){
            return [];
        }
        $passengers = $this->AirRepo->GetPassengersByTransactionId($transactionId);

        $this->one_or_round = new TransactionAirport;
        $this->CheckOnewayOrRoundtrip($transactionId);
        $totalPrice = $this->one_or_round[0]->amount+$this->one_or_round[1]->amount;
        $services = $this->one_or_round;

        return [
            'transactionId'=>$head[0]->transaction_id,
            'billNumber'=>$head[0]->billNumber,
            'transfer'=>$head[0]->transfer,
            'issueDate'=>date('d F Y H:i:s', strtotime($head[0]->issueDate)).' Hrs.',
            'totalPrice'=>$totalPrice,
            'services'=>$services,
            'passengers'=>$passengers
        ];
    }

    public function CheckOnewayOrRoundtrip($transactionId){
        $passenger = $this->AirRepo->GetPassengerId($transactionId);

        $book_arr = [];
        foreach($passenger as $value){
            $book = $this->AirRepo->GetPassengerBook($transactionId, $value->passengerId);
            array_push($book_arr, $book);
        }

        // Set One Way default value
        $serviceOne = new TransactionAirport;
        $serviceOne->unit = 0;
        $serviceOne->price = 0;
        $serviceOne->amount = 0;
        $serviceOne->origin = "One Way";

        // Set Round Trip default value
        $serviceRound = new TransactionAirport;
        $serviceRound->unit = 0;
        $serviceRound->price = 0;
        $serviceRound->amount = 0;
        $serviceRound->origin = "Round Trip";

        $service_arr = [
            $serviceOne,
            $serviceRound
        ];

        $count_book = count($book_arr);
        foreach($book_arr as $val){
            if($val->origin=="One Way"){
                $service_arr[0]->unit += $val->unit;
                $service_arr[0]->price = $val->price;
                $service_arr[0]->amount += $val->amount;
            }else if($val->origin=="Round Trip"){
                $service_arr[1]->unit += $val->unit;
                $service_arr[1]->price = $val->price;
                $service_arr[1]->amount += $val->amount;
            }
        }
        $this->one_or_round = $service_arr;
    }
}
?>