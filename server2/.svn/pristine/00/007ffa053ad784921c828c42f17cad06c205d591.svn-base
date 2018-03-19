<?php 
namespace App\Facades\EasyBook\Ticket;

use Carbon\Carbon;
use App\transaction as transaction;

use App\Repositories\EasyBook\Transaction\TransactionAirportRepository as TransactionAirportRepo;

class TicketAirportClass{

	public function __construct(TransactionAirportRepo $TransactionAirportRepo){
		$this->TransactionAirportRepo = $TransactionAirportRepo;
	}

	// public function GetAirportTicketByPassenger($transactionId, $passengerId){
	// 	$result = $this->TransactionAirportRepo->GetTransactionAirportByPassengerId($transactionId, $passengerId);
	// 	if($result==null){
	// 		return [];
	// 	}


	// 	if(count($result)<2){
	// 		$flight_date = date('d F Y H:i:s', strtotime($result[0]->flight_date));
	// 		if($result[0]->flight_origin_id=='1'){
	// 			$arrival = $result[0]->flight_number.' ('.$flight_date.' Hrs.)';
	// 			$departure = null;
	// 		}else{
	// 			$arrival = null;
	// 			$departure = $result[0]->flight_number.' ('.$flight_date.' Hrs.)';
	// 		}
	// 	}else{
	// 		$date_arrival = date('d F Y H:i:s', strtotime($result[1]->flight_date));
	// 		$arrival = $result[1]->flight_number.' ('.$date_arrival.' Hrs.)';

	// 		$date_departure = date('d F Y H:i:s', strtotime($result[0]->flight_date));
	// 		$departure = $result[0]->flight_number.' ('.$date_departure.' Hrs.)';
	// 	}

 //        $transaction_air = new transaction;
 //        $transaction_air->firstname = strtoupper($result[0]->firstname);
 //        $transaction_air->lastname = strtoupper($result[0]->lastname);
 //        $transaction_air->hotel = $result[0]->hotel;
 //        $transaction_air->arrival = $arrival==null?null:$arrival;
 //        $transaction_air->departure = $departure==null?null:$departure;
 //        $transaction_air->airportType = count($result)<2?"One Way":"Round Trip";
 //        $transaction_air->ticketNumber = \HelperFacade::SetTicketNumberFormat($result[0]->ticketNumber);

	// 	$passenger = new transaction;
	// 	$passenger->transfer = "AIRPORT TRANSFER";
	// 	$passenger->passenger = $transaction_air;
	// 	return $passenger;
	// }
	public function GetAirportTicketByPassenger($transactionId, $passengerId){

		$result = $this->TransactionAirportRepo->GetTransactionAirportByPassengerId($transactionId, $passengerId);
		if($result==null){
			return [];
		}

		if(count($result)<2){
			$flight_date = date('d F Y H:i:s', strtotime($result[0]->flight_date));
			if($result[0]->flight_origin_id=='1'){
				$arrival = $result[0]->flight_number.' ('.$flight_date.' Hrs.)';
				$departure = null;
			}else{
				$arrival = null;
				$departure = $result[0]->flight_number.' ('.$flight_date.' Hrs.)';
			}
		}else{
			$subArr0 = substr($result[0]->flight_date,8,2);

			if($subArr0==19){
				$date_arrival = date('d F Y H:i:s', strtotime($result[0]->flight_date));
				$arrival = $result[0]->flight_number.' ('.$date_arrival.' Hrs.)';
				$date_departure = date('d F Y H:i:s', strtotime($result[1]->flight_date));
				$departure = $result[1]->flight_number.' ('.$date_departure.' Hrs.)';
			}

			if($subArr0==24){
				$date_arrival = date('d F Y H:i:s', strtotime($result[1]->flight_date));
				$arrival = $result[1]->flight_number.' ('.$date_arrival.' Hrs.)';
				$date_departure = date('d F Y H:i:s', strtotime($result[0]->flight_date));
				$departure = $result[0]->flight_number.' ('.$date_departure.' Hrs.)';
			}
		}

        $transaction_air = new transaction;
        $transaction_air->firstname = strtoupper($result[0]->firstname);
        $transaction_air->lastname = strtoupper($result[0]->lastname);
        $transaction_air->hotel = $result[0]->hotel;
        $transaction_air->arrival = $arrival==null?null:$arrival;
        $transaction_air->departure = $departure==null?null:$departure;
        $transaction_air->airportType = count($result)<2?"One Way":"Round Trip";
        $transaction_air->ticketNumber = \HelperFacade::SetTicketNumberFormat($result[0]->ticketNumber);

		$passenger = new transaction;
		$passenger->transfer = "AIRPORT TRANSFER";
		$passenger->passenger = $transaction_air;

		return $passenger;
	}

}