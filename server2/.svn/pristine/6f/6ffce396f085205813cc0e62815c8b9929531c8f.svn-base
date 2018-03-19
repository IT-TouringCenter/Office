<?php
namespace App\Facades\EasyBook\Invoice;

use App\Repositories\EasyBook\Transaction\TransactionTourProgramRepository as TourRepo;

class InvoiceTour{
    public function __construct (TourRepo $TourRepo){
        $this->TourRepo = $TourRepo;
    }
	
	public function GetTourInvoiceByTransactionId($transactionId){
		
		$this->GetTourByTransactionId($transactionId);		
		$this->GetPassengersTourByTransactionId($transactionId);		
		$this->GetHotelTourByTransactionId($transactionId);
		
	}
	
	
	public function GetTourByTransactionId($transactionId){

		$resp =$this->TourRepo->GetGroupToursByTransactionId($transactionId);		
		if($resp==null){			
			$this->activityId = 0;			
			$this->Invoices->tours =[];			
			return;			
		}
				
		$this->activityId= $resp[0]->activity_id;				
		$tours =[];
		
		foreach ($resp as $value) {			
			$tours[]=[
			'code'=>$value->code,
			'title'=>$value->title,
			'medical'=>$value->medical,
			'unit'=>$value->unit,
			'amount'=>$value->amount
			];			
		}
				
		$identify = \HelperFacade::ReserveIdentify($this->activityId);				
		$this->Invoices->tours =[
		'id'=>$identify,
		'programs'=>$tours
		];				
		return $this->Invoices->tours;	

	}
	
	
	public function GetPassengersTourByTransactionId($transactionId){	

		$passengers= $this->TourRepo->GetContactByTransactionId($transactionId);		
		array_add($this->Invoices->tours,'passengers',$passengers);		

	}
	
	
	public function GetHotelTourByTransactionId($transactionId){	

		$hotel= $this->TourRepo->GetHotelTourByTransactionId($transactionId);		
		array_add($this->Invoices->tours,'hotel',$hotel);		
        
	}	
}
?>