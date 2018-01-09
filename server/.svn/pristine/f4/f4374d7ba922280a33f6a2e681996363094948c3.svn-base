<?php 
namespace App\Facades\EasyBook\Ticket;

use Carbon\Carbon;
use App\Commons\TicketStatus as TICKET;
use App\Commons\AirportOrigin as Origin;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as TransactionTransferRepository;

use App\transaction as transaction;

class TicketClass{

    public function __construct(TransactionTransferRepository $TransactionTransferRepository){
        $this->TSTransferRep= $TransactionTransferRepository;
    }

    public function GetDataConventionByTransactionId($transactionId){
        return $this->TSTransferRep->GetConventionTicketByTransactionId($transactionId);		
    }

    public function GetHotelByTransactionIdPassengerId($transactionId,$passengerId){
        $hotel = $this->TSTransferRep->GetDataByTransactionIdPassengerId($transactionId,$passengerId);
		if($hotel==null){
			$hotelName='-';
		}
		else if($hotel->hotel_id == 999){
			$hotelName = $hotel->hotel_other;
		} else {
			$hotelName = $hotel->GetHotel->hotel;
		}

        return $hotelName;
    }

    public function GetConventionTicketByPerson($transactionId,$passengerId){
        $convention=$this->TSTransferRep->GetConventionTicketByTransactionIdAndPassengerId($transactionId,$passengerId);
        if($convention==null){
			return null;
		}

        $passenger = $convention->Person;
		$fullname = $passenger->firstname.' '.$passenger->lastname;	
		
        $hotelName = $this->GetHotelByTransactionIdPassengerId($transactionId,$passengerId);

		return [
				"transferMode"=>"Package",
				'fullname'=>$fullname,
				'ticketNumber'=>\HelperFacade::SetTicketNumberFormat($convention->ticket_number),
				'hotelName'=>$hotelName,
				"startDate"=>"2017-07-20",
				"endDate"=>"2017-07-24"
		];

    }

    public function GetConventionTicketByTransactionId($transactionId){
        $conventions = [];

		$transferResults= $this->GetDataConventionByTransactionId($transactionId);
		if($transferResults==null){
			return [];
		}

		foreach ($transferResults as $ticket) {
			$conventions[]=$this->GetConventionTicketByPerson($ticket->transaction_id,$ticket->passenger_id);
		}

		return $conventions;
    }

    public function GetAirportDataByTransactionId($transactionId){
        return $this->TSTransferRep->GetAirportTicketByTransactionId($transactionId);
    }

    public function GetAirportTicketByTransactionId($transactionId){
        $transfers=[];
		$airports = $this->GetAirportDataByTransactionId($transactionId);
	
		if($airports == null){		
			return [];
		};
		
		foreach ($airports as $flights) {
            $isArrival = false;			
			$transferMode="One Way";
			$arrivalDate="";
			$departureDate="";						
			$arrivalFlight="";
			$departureFlight="";	
			$ticketNumber=$flights[0]->ticket_number;
						
			//Get fullname of person.
			$passenger = $flights[0]->Person;			
			$fullname = $passenger->firstname.' '.$passenger->lastname;	

             $hotelName = $this->GetHotelByTransactionIdPassengerId($transactionId,$flights[0]->passenger_id);
									
			if(count($flights)>1){				
				$transferMode="Round Trip";

                $date = Carbon::parse($flights[0]->flight_date);
				$arrivalDate=$date->format('d-m-Y H:i');

                $date = Carbon::parse($flights[1]->flight_date);  
				$departureDate=$date->format('d-m-Y H:i');
								
				$arrivalFlight=$flights[0]->flight_number;				
				$departureFlight=$flights[1]->flight_number;
				$isArrival = false;
			}
			else {
				
				$transferMode="One Way";

				$date = Carbon::parse($flights[0]->flight_date);
                $arrivalDate=$date->format('d-m-Y H:i');	                
				$arrivalFlight=$flights[0]->flight_number;

                if($flights[0]->flight_origin_id==Origin::ARRIVAL){
                    $isArrival = true;
                } else {
                    $isArrival = false;
                }

                $departureDate="";
				$departureFlight="";
				
			}

			$transfers[]=[
				"fullname"=>$fullname,
				"transferMode"=>$transferMode,
				"ticketNumber"=>\HelperFacade::SetTicketNumberFormat($ticketNumber),
				"arrivalDate"=>$arrivalDate,
				"departureDate"=>$departureDate,                    
				"arrivalFlightNumber"=>$arrivalFlight,
				"departureFlightNumber"=>$departureFlight,
                "isArrival"=>$isArrival,
                "hotelName"=>$hotelName
			];			
		}

		return $transfers;
    }

    public function Verify($verifyBy){
        // $tickets = $this->TransactionDetailReposity->GetTickets();
        
        // if(count($tickets)< 1 || $tickets ==null){return "No expire ticket(s) in the system.";}

        // foreach ($tickets as $ticket) {            
        //     if($ticket->expired_date_ticket < Carbon::now('Asia/Bangkok')){
                
        //         $id=$ticket->id;
        //         $ticketNumber=$ticket->ticket_number;
        //         $ticketStatus=TICKET::EXPIRED;

        //         $this->TransactionDetailReposity->UpdateTicketStatusByTransactionIdAndTicketNumber($id,$ticketNumber,$verifyBy,$ticketStatus);
        //     }
        // }
    }

    public function GetTicketByPassenger($transactionId, $passengerId){
    	// $conventions = \TicketFacade::GetConventionTicketByPassenger($transactionId,$passengerId);
		// $airports = \TicketFacade::GetAirportTicketByPassenger($transactionId,$passengerId);

		$conventions = \TicketConventionFacade::GetConventionTicketByPassenger($transactionId, $passengerId);
		$airports = \TicketAirportFacade::GetAirportTicketByPassenger($transactionId, $passengerId);

		$ticket = new transaction;
		if(count($conventions)<1 && count($airports)<1){
			$ticket->transactionId = null;
		}else{
			$ticket->transactionId = \HelperFacade::GenerateTransactionNumber($transactionId);
		}
		$ticket->convention = $conventions;
		$ticket->airport = $airports;

		if($ticket==null){
			$ticket = [];
		}
		return $ticket;
    }

}

?>