<?php
namespace App\Facades\EasyBook\Transaction;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\passenger as passenger;
use App\Commons\TransactionStatus;
use App\transaction as transaction;
use App\Commons\AirportOrigin as Origin;
use App\Commons\Email\EmailStatus as EmailStatus;
use App\Commons\Email\EmailHelper as EmailHelper;
use App\Commons\TransactionSource as TransactionSource;
use App\Commons\Payment\PaymentChannel as PaymentChannel;
use App\Commons\Payment\PaymentTransactionStatus as PaymentStatus;

use App\Repositories\EasyBook\Transaction\TransactionRepository as TransactionRepo;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as TransactionTransferRepo;
use App\Repositories\EasyBook\Passenger\PassengerRepository as PassengerRepo;

class TransactionClass{
	
	public function __construct(TransactionRepo $TransactionRepo,TransactionTransferRepo $TransactionTransferRepo, PassengerRepo $PassengerRepo){
		$this->TransactionRepo = $TransactionRepo;
		$this->TransactionTransferRepo = $TransactionTransferRepo;
		$this->PassengerRepo = $PassengerRepo;
	}

	public function Save($activityId,$request){
		\DB::beginTransaction();
		try{
			/*
			1) SaveTransaction
			2) SaveTransferInformation
			3) Save invoice
			3) transfer information
				3.1) save passenger
				3.2) save convention
					3.2.1) Save convention transaction
					3.2.2) Save convention_invoice
				3.3) save airport
					3.3.1) save airport transaction
					3.3.2) Save airport invoice
				3.4) save transaction_transfer_detail 					
			4) SaveDayTrips
			5) Save tour program invoice
			6) SavePayment
			7) SaveEmail
			8) Send Pending Email			
			*/

			$this->request = $request;
			$this->activityId =$activityId;
			$this->summary = array_get($request,'summary');

			$reservation= array_get($request,'reservations');

			$this->SaveTransaction();

			// $this->invoiceId = \InvoiceFacade::InsertInvoice($this->activityId,$this->transactionId);

			// if(count(array_get($reservation[0],'convention'))!=null ){
			// 	$this->convInvoiceNumber = \HelperFacade::ReserveIdentify($this->activityId);
			// }

			// if(count(array_get($reservation[0],'airports'))!=null){
			// 	$this->airportInvoiceNumber =\HelperFacade::ReserveIdentify($this->activityId);
			// }

			// if(count(array_get($reservation[0],'tours'))!=null){
			// 	$this->tourInvoiceNumber = \HelperFacade::ReserveIdentify($this->activityId);	
			// }

			$this->SaveTransferInformation();					
			$this->SavePayment();			
			$this->SaveEmail();					

			\DB::commit();
		}catch(\Exception $ex){
			\DB::rollBack();
			throw $ex;
		}
		// return ["status"=>true,"transaction"=>$this->SaveEmail()];
		return ["status"=>true,"transactionId"=>\HelperFacade::Encode($this->transactionId)];
	}

	// save step 1
	function SaveTransaction(){
		$accountId=0;
		$summary = $this->request->summary;			
		$amount = array_get($summary,'amount');
		$status =TransactionStatus::PENDING;
		$discount= 0;

		$this->transactionId = $this->TransactionRepo->Save($this->activityId,$accountId, $amount,$discount);

		//$this->GetParentId();
	}

	function GetParentId(){
		$reservations = array_get($this->request,'reservations');

		if($this->transactionId > 0 && count($reservations) > 1){
			$this->parentId=$this->transactionId;
		} else {
			$this->parentId = 0;
		}
	}

	// save step 2
	function SaveTransferInformation(){		
		$this->isPrimary = false;
		$this->isPassengerParent = false;
		$this->passengerParentId = 0;
	
		foreach($this->request->reservations as $value){
			$this->SavePassenger($value);
			$this->SaveConvention($value);
			
			$this->SaveAirport($value);

			$this->SaveTransferDetail($value);
			$this->SaveTourProgram($value);	
		}
	}

	function SavePassenger($reserve){
		$passenger = array_get($reserve, 'passenger');

		$isPrimary= array_get($passenger,'isPrimary');
		if($isPrimary == true){
			$this->primaryFullName = array_get($passenger,'firstname').' '.array_get($passenger,'lastname');
			$this->primaryEmail = array_get($passenger,'email');			
			$this->isPrimary = true;
		}else {
			if($this->isPrimary ==false){
				$this->primaryFullName =array_get($passenger,'firstname').' '.array_get($passenger,'lastname');
				$this->primaryEmail = array_get($passenger,'email');

				$this->isPrimary = true;
			}
		}

		$passenger = array_add($passenger,'parentId',$this->passengerParentId);		
		$this->passengerId = \PassengerIcasFacade::Save($passenger);

		if($this->isPassengerParent==false){
			$this->passengerParentId = $this->passengerId;
			$this->isPassengerParent =true;
		}
	}

	function SaveConvention($reserve){
		$convention = array_get($reserve,'convention');
		$convPrice = array_get($convention,'price');
		if($convention==null || $convPrice==0){
			$this->conventionId = 0;
			return;
		}

		$configurationTransferId=array_get($convention,'configTransferId');
		$ticketNumber=array_get($convention,'ticketNumber');
		$price =array_get($convention,'price');

		$this->conventionId = $this->TransactionTransferRepo
			->SaveConvention(
				$this->passengerId,
				$this->transactionId,
				$configurationTransferId,
				$ticketNumber,
				$price
			);
		
		$date_arr = array_get($convention,'dates');
		if(count($date_arr)>0){
			foreach($date_arr as $value){
				$this->conventionDateId = $this->TransactionTransferRepo
				->SaveConventionDate(
					$this->conventionId,
					array_get($value,'date')
				);
			}
		}
		

		// if($this->conventionId > 0){
		// 	\InvoiceFacade::InsertConventionInvoice($this->activityId,$this->invoiceId,$this->conventionId,$this->convInvoiceNumber);
		// }
	}

	function SaveAirport($reserve){
		$airports= array_get($reserve,'airports');
		if($airports==null){
			$this->airportId=0;
			return;
		}
		
		foreach ($airports as $flight) {
			$flightOriginId = '';
			$origin = array_get($flight,'origin');
			if($origin=="arrival"){
				$flightOriginId = Origin::ARRIVAL;//1
			}

			if($origin=="departure"){
				$flightOriginId = Origin::DEPARTURE;//2
			}
			
			$configurationTransferId=array_get($flight,'configTransferId');
			$flightOriginId = $flightOriginId;
			$ticketNumber=array_get($flight,'ticketNumber');
			$flightNumber=array_get($flight,'flightNumber');
			$flightDate=array_get($flight,'flightDatetime');
			$price=array_get($flight,'price');
			
			$this->airportId= $this->TransactionTransferRepo
				->SaveAirport(
					$this->passengerId,
					$this->transactionId,
					$configurationTransferId,
					$flightOriginId,
					$ticketNumber,
					$flightNumber,
					$flightDate,
					$price
				);

			//Save airport invoice.
			// if($this->airportId > 0){
			// 	\InvoiceFacade::InsertAirportInvoice(					
			// 		$this->invoiceId,
			// 		$this->airportId,
			// 		$this->airportInvoiceNumber
			// 	);
			// s}

				
		}
	}

	function SaveTransferDetail($reserve){
		
		$passenger = array_get($reserve,'passenger');
				
		$this->TransactionTransferRepo->SaveTransactionTransfer(
			0,
			$this->transactionId,			
			$this->passengerId,			
			array_get($passenger,'hotelId'),
			array_get($passenger,'hotelOther'),
			array_get($passenger,'hotelRoom')
		);
	}

	function SaveTourProgram($reserve){
		$daytrips= array_get($reserve,'tours');
		if($daytrips==null){
			return;
		}

		$passenger = array_get($reserve,'passenger');
										
		foreach ($daytrips as $tour) {	
			$data= array_add($tour,'transactionId',$this->transactionId);
			$data= array_add($data,'passengerId',$this->passengerId);
			$data= array_add($data,'activityId',$this->activityId);

			$data= array_add($data,'hotelId',array_get($passenger,'hotelId'));
			$data= array_add($data,'hotelOther',array_get($passenger,'hotelOther'));
			$data= array_add($data,'hotelRoom',array_get($passenger,'hotelRoom'));

			$tourProgramId = \TransactionTourFacade::Save($data);
			// if($tourProgramId > 0){
			// 	\InvoiceFacade::InsertTourInvoice($this->invoiceId,$tourProgramId,$this->tourInvoiceNumber);				
			// }
		}
	}	
	
	function SavePayment(){
		$this->MapPaymentRequestToEntity();
		\PaymentTransactionFacade::Save($this->payment);
	}

	function MapPaymentRequestToEntity(){
		$payment = new transaction;
		$payment->transactionId=$this->transactionId;
		$payment->paymentStatus=PaymentStatus::Pending;
		$payment->paymentChannel=PaymentChannel::PAYPAL;
		$payment->isExpired = 0; // 0 = no expire
		$payment->activityId=$this->activityId;
		$payment->amount=array_get($this->summary,'amount');

		$this->payment=$payment;
	}
	
	function SaveEmail(){
		$this->MapEmailToEntity();
		\EmailFacade::Save($this->email);
	}

	function MapEmailToEntity(){
		$pendingTemplate = EmailHelper::GetPendingTemplate();
		$getPassengerByPrimary = $this->PassengerRepo->GetPassengerByPrimary($this->transactionId);
		if($getPassengerByPrimary){
			$fullname = $getPassengerByPrimary->firstname.' '.$getPassengerByPrimary->lastname;
			$email = $getPassengerByPrimary->email;
		
			$this->email = new transaction();
			$this->email->activityId = $this->activityId;
			$this->email->transactionSourceId=TransactionSource::TRANSFER;
			$this->email->transactionId = $this->transactionId;
			$this->email->emailStatus = EmailStatus::PENDING;
			$this->email->fullname=$fullname;
			
			$this->email->template =array_get($pendingTemplate,'template');

			$to = EmailHelper::GetToContaction($this->activityId);
			if($to==""){
				$to= $email;
				// $to = $this->primaryEmail;
			} else {
				$to = $to.','.$email;
			}

			$this->email->subject= array_get($pendingTemplate,'subject');
			$this->email->to = $to;
			$this->email->cc = EmailHelper::GetCCContaction($this->activityId);
			$this->email->bcc = EmailHelper::GetBCCContaction($this->activityId);

			$this->email->createdBy="System";		
			$this->email->createdAt=Carbon::now("Asia/Bangkok");
		}
	}

	// save step 4 ( tour program )
	public function SaveTransactionTourProgram($passenger_id, $transaction_id, $reservation, $summary, $discount_code_id){
		$result = \TransactionTourProgramIcasFacade::SetTransactionTourProgram($passenger_id, $transaction_id, $reservation, $summary, $discount_code_id);
		$this->save_transaction_transfer->tourprograms = $result;
	}
}