<?php
namespace App\Facades\EasyBook\Transaction;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\transaction as transaction;
use App\Repositories\EasyBook\Transaction\TransactionRepository as TransactionRepo;

class TransactionInvoiceClass{
	
	public function __construct(TransactionRepo $TransactionRepo){
		$this->TransactionRepo = $TransactionRepo;
	}

	public function GetTransactionBooking($transactionId){
		$this->transaction = new transaction;
		$this->transaction->transactionId = $this->TransactionRepo->CheckTransctionIdPay($transactionId);
		$this->GetTransactionTicket($transactionId);
		// $this->GetTransactionTransfer($transactionId);
		// $this->GetTransactionTour($transactionId);
		return $this->transaction;
		// return $this->GetTransactionTicket($transactionId);
	}

	public function GetTransactionTransfer($transactionId){
		$result = $this->TransactionRepo->GetTransactionTransfer($transactionId);
		$this->transaction->transfers = $result;
	}

	public function GetTransactionTicket($transactionId){
		$passengerConv = $this->TransactionRepo->GetPassengerTransactionConvention($transactionId);
		$passengerAir = $this->TransactionRepo->GetPassengerTransactionAirport($transactionId);
		$passengerTour = $this->TransactionRepo->GetPassengerTourProgram($transactionId);

		if($passengerConv){
			$this->transaction->isConvention = true;
		}else{
			$this->transaction->isConvention = false;
		}

		if($passengerAir){
			$this->transaction->isAirport = true;
		}else{
			$this->transaction->isAirport = false;
		}

		if($passengerTour){
			$this->transaction->isTour = true;
		}else{
			$this->transaction->isTour = false;
		}

		$passenger_arr = [];
		foreach($passengerConv as $value){
			$passenger = new transaction;
			$passenger->passengerId = \HelperFacade::Encode($value->passenger_id);
			$passenger->fullname = $value->firstname.' '.$value->lastname;
			array_push($passenger_arr, $passenger);
		}
		foreach($passengerAir as $val){
			$passenger = new transaction;
			$passenger->passengerId = \HelperFacade::Encode($val->passenger_id);
			$passenger->fullname = $val->firstname.' '.$val->lastname;
			array_push($passenger_arr, $passenger);
		}
		foreach($passengerTour as $valTour){
			$passenger = new transaction;
			$passenger->passengerId = \HelperFacade::Encode($valTour->passenger_id);
			$passenger->fullname = $valTour->firstname.' '.$valTour->lastname;
			array_push($passenger_arr, $passenger);
		}

		$passenger_arr = \HelperFacade::CheckUnique($passenger_arr);

		$ticket = $passenger_arr;
		$this->transaction->passengers = $ticket;
	}

	public function GetTransactionTour($transactionId){
		$tour = $this->TransactionRepo->GetTransctionCheckUnique($transactionId);
		$tour_arr = [];
		$tour = \HelperFacade::CheckUnique($tour);
		foreach($tour as $value){
			$tour_unique = $this->TransactionRepo->GetTransactionTour($transactionId,$value);
			$tour_unique->transactionTourId = \HelperFacade::Encode($tour_unique->transactionTourId);
			$tour_unique->tourDate = date('d F Y', strtotime($tour_unique->tourDate));
			array_push($tour_arr, $tour_unique);
		}
		$this->transaction->tours = $tour_arr;
	}
}