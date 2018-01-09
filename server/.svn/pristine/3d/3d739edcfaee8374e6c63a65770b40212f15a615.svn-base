<?php 
namespace App\Facades\EasyBook\Ticket;

use Carbon\Carbon;
use App\transaction as transaction;

use App\Repositories\EasyBook\Transaction\TransactionConventionRepository as TransactionConventionRepo;
use App\Repositories\EasyBook\Passenger\PassengerRepository as PassengerRepo;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as TransactionTransferRepo;

class TicketConventionClass{

	public function __construct(TransactionConventionRepo $TransactionConventionRepo, PassengerRepo $PassengerRepo, TransactionTransferRepo $TransactionTransferRepo){
		$this->TransactionConventionRepo = $TransactionConventionRepo;
		$this->PassengerRepo = $PassengerRepo;
		$this->TransactionTransferRepo = $TransactionTransferRepo;

	}

    // Get by Ticket
	public function GetConventionTicketByPassenger($transactionId, $passengerId){
		$result =  $this->TransactionConventionRepo->GetTransactionConventionByPassengerId($transactionId, $passengerId);
        // Set format
        if($result==null){
        	return [];
        }
        $conventionId = $result[0]->id;

        // get convention date
        $date = $this->TransactionConventionRepo->GetTransactionConventionDate($conventionId);

        $setDate_arr = [];
        $fixDate_arr = [];

		$result[0]->firstname = strtoupper($result[0]->firstname);
		$result[0]->lastname = strtoupper($result[0]->lastname);
		$result[0]->ticketNumber = \HelperFacade::SetTicketNumberFormat($result[0]->ticketNumber);

		$passenger = new transaction;
		$passenger->transfer = 'CMECC TRANSFER';
		$passenger->passenger = $result[0];

		if(count($date)<4 && count($date)>0){
			$passenger->daypass = "( ".count($date)." Day Pass )";
			$count = 0;
			$fixDate = new transaction;
			foreach($date as $value){
				$count++;
				
				if($count>1){
					$fixDate->date .= ', '.date('d', strtotime($value->date));
				}else{
					$fixDate->date .= date('d', strtotime($value->date));
				}
				
				if($count==count($date)){
					$fixDate->date .= ' '.'July 2017';
				}

				array_push($setDate_arr, $fixDate);
			}

			// $setDate = new transaction;
			// if($setDate_arr[0]!=null || !empty($setDate_arr[0])){
			// 	$setDate->date .= $setDate_arr[0]->date;
			// }
			// if($setDate_arr[1]!=null || !empty($setDate_arr[1])){
			// 	$setDate->date .= ', '.$setDate_arr[1]->date;
			// }
			// if($setDate_arr[2]!=null || !empty($setDate_arr[2])){
			// 	$setDate->date .= ', '.$setDate_arr[2]->date;
			// }

			// $fixDate = new transaction;
			// $setDate->date .= ' '.'July 2017';

			// array_push($fixDate_arr, $setDate);
			$passenger->dates = $setDate_arr[0];
		}else{
			$fixDate = new transaction;
			$fixDate->date = "20-23 July 2017";

			array_push($fixDate_arr, $fixDate);
			$passenger->dates = $fixDate_arr[0];
			$passenger->daypass = "( 4 Day Pass )";
		}
		return $passenger;
    }
}