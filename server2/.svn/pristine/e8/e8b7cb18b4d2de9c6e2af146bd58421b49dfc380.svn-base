<?php
namespace App\Facades\EasyBook\Transaction;

/*
use App\transaction_transfer as transaction_transfer;
use App\configuration_transfer as configuration_transfer;
*/
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as transferRepo;

class TransactionTransferClass{
	public function __construct(transferRepo $transferRepo){
		$this->transferRepo = $transferRepo;
	}

	

	/*
	public function Save($transfer){
		$data =[
			'discount_code_id'=>$transfer->discountCodeId,
			'transaction_id'=>$transfer->transactionId,
			'transaction_transfer_parent_id'=>$transfer->parentId,
			'passenger_id'=>$transfer->passengerId,
			'transaction_transfer_convention_id'=>$transfer->conventionId,
			'transaction_transfer_airport_id'=>$transfer->airportId,
			// 'configuration_transfer_id'=>$transfer->configurationTransferId,
			'hotel_id'=>$transfer->hotelId,
			'hotel_other'=>$transfer->hotelOther,
			'room_number'=>$transfer->roomNumber,
			'discount'=>$transfer->discount,
			'amount'=>$transfer->amount			
			
		];
		return $this->transaction_transfer_repo->insertGetId();
	}

	// version 2.0
	// save transfer step 1
	public function SetTransactionTransfer($transaction_id, $passenger_id, $reservation, $summary, $discount_code_id){
		$config_transfer_arr = [];
		$reservation_arr = [];
		array_push($reservation_arr, $reservation);

		// Convention
		foreach($reservation_arr as $value){
			$this->set_transaction_transfer = new transaction_transfer;
			$this->config_convention = new configuration_transfer;
			$this->SetConventionTransfer($value);
			array_push($config_transfer_arr, $this->config_convention);

		// Airport
			$airport = array_get($value, 'airports');
			foreach($airport as $val){
				$this->config_airport = new configuration_transfer;
				$this->SetAirportTransfer($val);
				array_push($config_transfer_arr, $this->config_airport);
			} // foreach airport
		} // foreach convention

		$set_data_transfer = [
			'transaction_id'=>$transaction_id,
			'config_transfer_id'=>$config_transfer_arr,
			'passenger_id'=>array_get($passenger_id, 'id'),
			'hotel_id'=>array_get($passenger_id, 'hotelId'),
			'hotel_other'=>array_get($passenger_id, 'hotelOther'),
			'hotel_room_number'=>array_get($passenger_id, 'hotelRoom'),
			'discount_code_id'=>$discount_code_id
		];

		$this->save_transaction_tranfer = new transaction_transfer;
		$this->SaveTransactionTransferToDB($set_data_transfer);

		return $this->save_transaction_tranfer;
		// return $set_data_transfer;
	}

	// save transfer step 2
	public function SetConventionTransfer($data){
		$convention = array_get($data, 'convention');
		$convention_ticket_number = array_get($convention, 'ticketNumber');
		$convention_origin = array_get($convention, 'origin');
		$convention_flight_number = array_get($convention, 'flightNumber');
		$convention_flight_date_time = array_get($convention, 'flightDateTime');
		$convention_price = array_get($convention, 'price')==null?0:array_get($convention, 'price');
		$convention_discount = array_get($convention, 'discount')==null?0:array_get($convention, 'discount');
		$convention_amount = array_get($convention, 'amount')==null?$convention_price-$convention_discount:array_get($convention, 'amount');

		$this->config_convention->id = array_get($convention, 'configTransferId');
		$this->config_convention->ticket_number = $convention_ticket_number;
		$this->config_convention->origin = $convention_origin;
		$this->config_convention->flight_number = $convention_flight_number;
		$this->config_convention->flight_date_time = $convention_flight_date_time;
		$this->config_convention->price = $convention_price;
		$this->config_convention->discount = $convention_discount;
		$this->config_convention->amount = $convention_amount;
		$this->config_convention->expired_date_ticket = "2017-07-23 23:59:59";
	}

	// save transfer step 3
	public function SetAirportTransfer($data){
		$airport_ticket_number = array_get($data, 'ticketNumber');
		$airport_origin = array_get($data, 'origin');
		$airport_flight_number = array_get($data, 'flightNumber');
		$airport_flight_date_time = array_get($data, 'flightDateTime');
		$airport_price = array_get($data, 'price')==null?0:array_get($data, 'price');
		$airport_discount = array_get($data, 'discount')==null?0:array_get($data, 'discount');
		$airport_amount = array_get($data, 'amount')==null?$airport_price-$airport_discount:array_get($data, 'amount');

		$this->config_airport->id = array_get($data, 'configTransferId');
		$this->config_airport->ticket_number = $airport_ticket_number;
		$this->config_airport->origin = $airport_origin;
		$this->config_airport->flight_number = $airport_flight_number;
		$this->config_airport->flight_date_time = $airport_flight_date_time;
		$this->config_airport->price = $airport_price;
		$this->config_airport->discount = $airport_discount;
		$this->config_airport->amount = $airport_amount;
		$this->config_airport->expired_date_ticket = "2017-07-25 23:59:59";
	}

	// save transfer step 4
	public function SaveTransactionTransferToDB($data_transfer_save){
		$transaction_transfer_arr = [];

		foreach($data_transfer_save['config_transfer_id'] as $value){
			$origin = array_get($value, 'origin'); // for check
			
			$this->transaction_transfer = new transaction_transfer;
			$this->transaction_transfer->transactionId = $data_transfer_save['transaction_id'];
			$this->transaction_transfer->configurationTransferId = array_get($value, 'id');
			$this->transaction_transfer->passengerId = $data_transfer_save['passenger_id'];
			$this->transaction_transfer->discountCodeId = $data_transfer_save['discount_code_id'];
			$this->transaction_transfer->hotelId = $data_transfer_save['hotel_id'];
			
			$this->transaction_transfer->sourceId = array_get($value, 'source_id')==null?null:array_get($value, 'source_id');
			$this->transaction_transfer->targetId = array_get($value, 'target_id')==null?null:array_get($value, 'target_id');
			
			$this->transaction_transfer->hotelOther = $data_transfer_save['hotel_other'];
			$this->transaction_transfer->price = array_get($value, 'price');
			$this->transaction_transfer->discount = array_get($value, 'discount');
			$this->transaction_transfer->amount = array_get($value, 'amount');
			$this->transaction_transfer->ticketNumber = array_get($value, 'ticket_number');
			$this->transaction_transfer->roomNumber = $data_transfer_save['hotel_room_number'];
			if($origin=="arrival"){
				$this->transaction_transfer->flightDepartNumber = null;
				$this->transaction_transfer->flightDepartDateTime = null;
				$this->transaction_transfer->flightArrivalNumber = array_get($value, 'flight_number');
				$this->transaction_transfer->flightArrivalDateTime = array_get($value, 'flight_date_time');
			}else if($origin=="departure"){
				$this->transaction_transfer->flightArrivalNumber = array_get($value, 'flight_number');
				$this->transaction_transfer->flightArrivalDateTime = array_get($value, 'flight_date_time');
				$this->transaction_transfer->flightDepartNumber = null;
				$this->transaction_transfer->flightDepartDateTime = null;
			}else{
				$this->transaction_transfer->flightArrivalNumber = null;
				$this->transaction_transfer->flightArrivalDateTime = null;
				$this->transaction_transfer->flightDepartNumber = null;
				$this->transaction_transfer->flightDepartDateTime = null;
			}
			$this->transaction_transfer->expiredDateTicket = array_get($value, 'expired_date_ticket');
			
			$result = $this->transaction_transfer_repo->SaveTransactionTransfer($this->transaction_transfer);
			array_push($transaction_transfer_arr, $result);
		}

		$this->save_transaction_tranfer = $transaction_transfer_arr;
		// $this->save_transaction_tranfer = $result;
	}	
	*/
}
?>