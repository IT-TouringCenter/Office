<?php
namespace App\Repositories\EasyBook\Transaction;

use Carbon\Carbon;
use App\transaction_transfer_airport as Airport;
use App\transaction_transfer_convention as Convention;
use App\transaction_transfer as transactionTransfer;
use App\transaction_transfer_convention_date as ConventionDate;

class TransactionTransferRepository{

    public function __construct(transactionTransfer $transactionTransfer, Convention $Convention,Airport $Airport,ConventionDate $ConventionDate){
        $this->transactionTransferRepo = $transactionTransfer;
        $this->ConventionModel = $Convention;
        $this->AirportModel = $Airport;
        $this->ConventionDate = $ConventionDate;
    }

    public function SaveTransactionTransfer(		
        $discountCodeId,
        $transactionId,        
        $passengerId,      
        $hotelId,
        $hotelOther,
        $roomNumber
    ){
       $insert =[
			'discount_code_id'=>$discountCodeId,
			'transaction_id'=>$transactionId,			
			'passenger_id'=>$passengerId,
			'hotel_id'=>$hotelId,
			'hotel_other'=>$hotelOther,
			'room_number'=>$roomNumber
			
		];

        return $this->transactionTransferRepo->insertGetId($insert);
    }

    public function SaveConvention($passengerId,$transactionId,$configurationTransferId,$ticketNumber,$price	){
		
		// $defaultProperty=	$this->GetDefaultPropertys();
		$data =[
			'passenger_id'=>$passengerId,
            'transaction_id'=>$transactionId,
			'configuration_transfer_id'=>$configurationTransferId,
			'ticket_number'=>$ticketNumber,
			'price'=>$price,
			'is_active'=>true,
			'created_by'=>'System',
            'created_at'=>Carbon::now('Asia/Bangkok')
		];

		return $this->ConventionModel->insertGetId($data);
	}

	//-- Insert Transaction Convention Date
	public function SaveConventionDate($trans_conv_id, $date){
		$data = [
			'transaction_transfer_convention_id'=>$trans_conv_id,
			'date'=>$date,
			'created_by'=>'System',
			'created_at'=>Carbon::now('Asia/Bangkok')
		];
		return $this->ConventionDate->insertGetId($data);
	}

	public function SaveAirport($passengerId,$transactionId,$configurationTransferId,$originId,$ticketNumber,$flightNumber,$flightDate,$price	){
		$data=[
			'passenger_id'=>$passengerId,
            'transaction_id'=>$transactionId,
			'configuration_transfer_id'=>$configurationTransferId,
            'flight_origin_id'=>$originId,
			'ticket_number'=>$ticketNumber,
			'flight_number'=>$flightNumber,
			'flight_date'=>$flightDate,
			'price'=>$price,
			'is_active'=>true,
			'created_by'=>'System',
            'created_at'=>Carbon::now('Asia/Bangkok')
		];

		return $this->AirportModel->insertGetId($data);
	}

	public function GetDataByTransactionIdPassengerId($transactionId,$passengerId){
		return $this->transactionTransferRepo
					->where('is_active',1)
					->where('transaction_id',$transactionId)
					->where('passenger_id',$passengerId)
					->first();
	}

	public function GetDataByTransactionId($transactionId){
		return $this->transactionTransferRepo
					->where('is_active',1)
					->where('transaction_id',$transactionId)					
					->get();
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

	public function CountAirportTransferByTransactionId($transactionId){
		return \DB::table('transaction_transfer_airports')
					->select(\DB::raw('sum(price) as price'))
					->where('transaction_id',$transactionId)
					->groupby('ticket_number')
					->get(['price']);
	}

	public function GetAirportInvoiceByTransactionId($transactionId){
		return \DB::table('transaction_transfer_airports')
					->select(\DB::raw('count(id) as unit,sum(price) as price, sum(price) * count(id) as amount'))
					->where('transaction_id',$transactionId)					
					->first(['unit','price','amount']);
	}

	public function GetPassengersAirportInvoiceByTransactionId($transactionId){
		return \DB::table('transaction_transfer_airports as tta')
					->select(\DB::raw('firstname,lastname,n.nationality,email'))
					->join('passengers as p','p.id','=','tta.passenger_id')
					->join('nationalities as n','n.id','=','p.nationality_id')
					->where('transaction_id','=',$transactionId)
					->get(['firstname','lastname','nationality','email']);
	}

	public function GetConventionTicketByTransactionId($transactionId){	
		return $this->ConventionModel
					->where('transaction_id',$transactionId)					
					->where('is_active',1)
					->groupBy('passenger_id')
					->get(['passenger_id','transaction_id']);					
	}

	public function GetConventionTicketByTransactionIdAndPassengerId($transactionId,$passengerId){
		return $this->ConventionModel
					->where('transaction_id',$transactionId)
					->where('passenger_id',$passengerId)
					->where('is_active',1)
					->first();
	}
	
	public function GetTransferById($transferId){
    	return $this->TransferModel
    				->where('id', $transferId)
    				->where('is_active',1)
    				->get();
    }

	public function GetPrimaryHotelByTransactionId($transactionId){
		return \DB::table('transaction_transfers')
				->join('passengers as p','p.id','=','passenger_id')
				->where('transaction_id','=',$transactionId)
				->where('parent_id','=',0)
				->first(['hotel_id','hotel_other']);
	}

	public function GetConventionInvoiceByTransactionId($transactionId){
		return \DB::table('transaction_transfer_conventions')
					->select(\DB::raw('count(id) as unit,sum(price) as price, sum(price) * count(id) as amount'))
					->where('transaction_id',$transactionId)					
					->first(['unit','price','amount']);
	}

	public function GetPassengersConventionInvoiceByTransactionId($transactionId){
		return \DB::table('transaction_transfer_conventions as tta')
					->select(\DB::raw('firstname,lastname,n.nationality,email'))
					->join('passengers as p','p.id','=','tta.passenger_id')
					->join('nationalities as n','n.id','=','p.nationality_id')
					->where('transaction_id','=',$transactionId)
					->get(['firstname','lastname','nationality','email']);
	}

	public function GetHotelByTransactonTransfer($transactionId, $passengerId){
		return $this->transactionTransferRepo
					->where('transaction_id','=',$transactionId)
					->where('passenger_id','=',$passengerId)
					->get();
	}
}