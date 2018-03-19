<?php 
namespace App\Repositories\EasyBook\Reservation\Transfer;

use App\transfer as Transfer;
use App\transaction_transfer_airport as Airport;
use App\transaction_transfer_convention as Convention;

class TransferRepository{    

	public function __construct(Transfer $Transfer, Convention $Convention,Airport $Airport){
		$this->TransferModel = $Transfer;
		$this->ConventionModel =$Convention;
		$this->AirportModel= $Airport;
	}
    public function GetTransferById($transferId){
    	return $this->TransferModel
    				->where('id', $transferId)
    				->where('is_active',1)
    				->get();
    }

	public function GetConventionTicketByTransactionIdAndPassengerId($transactionId,$passengerId){
		return $this->ConventionModel
					->where('transaction_id',$transactionId)
					->where('passenger_id',$passengerId)
					->where('is_active',1)
					->first();
	}

	public function GetConventionTicketByTransactionId($transactionId){
		return $this->ConventionModel
					->where('transaction_id',$transactionId)					
					->where('is_active',1)
					->groupBy('passenger_id')					
					->get(['passenger_id','transaction_id']);					
	}

	public function GetAirportTicketByTransactionId($transactionId){
		$passengers= $this->AirportModel
					->where('transaction_id',$transactionId)
					->where('is_active',1)
					->groupBy('passenger_id')					
					->get(['passenger_id','transaction_id']);

		$airports=[];
		foreach ($passengers as $flight) {
			$item = $this->GetAirportBy($flight->transaction_id,$flight->passenger_id);
			$airports[]=$item;
		}

		return $airports;
	}

	public function GetAirportBy($transactionId,$passengerId){
		return $this->AirportModel
			->where('is_active',1)
			->where('transaction_id',$transactionId)
			->where('passenger_id',$passengerId)
			->orderBy('flight_origin_id')
			->get();
	}
}