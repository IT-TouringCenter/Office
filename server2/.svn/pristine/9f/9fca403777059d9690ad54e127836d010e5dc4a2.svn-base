<?php
namespace App\Facades\EasyBook\Email;

use Carbon\Carbon;
use App\Commons\PayPalConfig;
use App\Commons\TransactionSource;
use App\Commons\TransactionStatus;
use App\Commons\Email\EmailStatus as EmailStatus;
use App\Commons\Email\EmailHelper as EmailHelper;
use App\payment_transaction as PaymentTransaction;
use App\Repositories\EasyBook\Payment\PaymentTransactionRepository as PaymentRepository;
use App\Repositories\EasyBook\Email\EmailTransactionReposity as EmailTransactionReposity;
use App\Repositories\EasyBook\Transaction\TransactionRepository as TransactionRepository;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as TransactionTransferRepository;

use Mail;

class EmailClass{
	
	public function __construct(
	TransactionRepository $TransactionRepository,
	EmailTransactionReposity $EmailTransactionReposity,
	PaymentTransaction $PaymentTransaction,
	PaymentRepository $PaymentRepository,
	//TransferRepository $TransferRepository,
	TransactionTransferRepository $TransactionTransferRepository)
	{
		
		$this->EmailTransactionReposity = $EmailTransactionReposity;		
		$this->TransactionRepository = $TransactionRepository;		
		$this->PaymentRepository = $PaymentRepository;		
		$this->PaymentModel = $PaymentTransaction;		
		//$this->TransferRepository = $TransferRepository;	
		$this->TransactionTransferRepository = $TransactionTransferRepository;	
	}
	
	public function test(){		
		// 		use for test access this facade.
		return "succeed";		
	}
		
	public function Save($data){		
		$this->EmailTransactionReposity->Save($data);
	}
		
	public function GetPendingEmail(){		
		$emailTransactions = $this->EmailTransactionReposity->GetPendingEmail();
		return $this->MapEmail($emailTransactions);				
	}
		
	public function SendPendingEmailByTransactionId($request){		
		$transactionId=\HelperFacade::Decode($request->cm);

		$emailTransactions= $this->EmailTransactionReposity->GetPendingEmailByTransactionId($transactionId);	
		$emails=  $this->MapEmail($emailTransactions);		
		$this->Send($emails);

		return $emails;
	}
		
	public function SendPendingPaymentEmail(){		
		$emailTransactions = $this->EmailTransactionReposity->GetPendingEmail();
		$emails = $this->MapEmail($emailTransactions);
		$this->Send($emails);
	}
		
	public function SendPaidPaymentEmail($data){		
		//return $this->Send($data,'paid');		
	}
		
	public function SavePaidPaymentEmail($transactionId){		
		$activityId=1;

		$transaction = $this->TransactionRepository->GetDataByTransactionId($transactionId);
		$activityId=$transaction->activity_id;

		$transactionTransfer = $this->TransactionTransferRepository->GetDataByTransactionId($transactionId);
		if(count($transactionTransfer) < 1 || $transactionTransfer==null){			
			return ["status"=>false,"data"=>"Can't get primary contact."];			
		}

		foreach ($transactionTransfer as $transfer) {
			$person = $transfer->GetPassengers;
			if($person->parent_id == 0){
				$primaryFullName =  $person->firstname .' '.$person->lastname;
				$primaryEmail = $person->email;
				break;
			}
		}
		
		$to = EmailHelper::GetToContaction($activityId);
		if($to==""){
			$to= $primaryEmail;
		} else {
			$to = $to.','.primaryEmail;
		}
		
		$paidTemplate = EmailHelper::GetPaidTemplate();

		$mail = new EmailStatus;		
		$mail->transactionSourceId=TransactionSource::TRANSFER;
		$mail->transactionId=$transactionId;
		$mail->emailStatus=EmailStatus::PENDING;
		$mail->fullname=$primaryFullName;		
		$mail->to=$to;		
		$mail->cc=EmailHelper::GetCCContaction($activityId);	
		$mail->bcc=EmailHelper::GetBCCContaction($activityId);			
		$mail->subject=array_get($paidTemplate,'subject');
		$mail->template=array_get($paidTemplate,'template');

		$mail->createdBy="System";		
		$mail->createdAt=Carbon::now("Asia/Bangkok");
				
		\EmailFacade::Save($mail);		
	}
	
	private function MapEmail($emails){		
		$mails=[];				
		foreach ($emails as $item) {

			/*
            1) Update start datetime email.
            2) Amount=GetPaymentAmount().
            3) Get email information
            4) Get paypal config
            5) Get Tickets
                5.1 Get Airport Ticket
                5.2 Get Convention Ticket
            */

			$transactionId = $item->transaction_id;

			$this->Email = new EmailStatus;			
            $this->Email->transactionId= $transactionId;
			$this->Email->templatePath = $item->template_path;

            $this->GetPaymentAmount($transactionId);
            $this->GetEmailByTransactionId($transactionId);
            $this->GetPaypalConfiguration();

			$this->GetTickets($transactionId);
						
			$mails[]=$this->Email;			
		}				
		return $mails;		
	}

	// 	2) Get payment amount
	private function GetPaymentAmount($transactionId){		
		$payment = $this->PaymentRepository->GetPaymentByTransactionId($transactionId);		
		$this->Email->amount = $payment->amount;
		
	}

	// 	3) Get email information
	private function GetEmailByTransactionId($transactionId){
		
		$email = $this->EmailTransactionReposity->GetPendingEmailByTransactionId($transactionId);

		$this->Email->id = $email[0]->id;
		$this->Email->fullname = $email[0]->fullname;
		$this->Email->to = $email[0]->to;
		$this->Email->cc = $email[0]->cc;
		$this->Email->bcc =$email[0]->bcc;
		$this->Email->subject = $email[0]->subject;
		$this->Email->custom=\HelperFacade::Encode($transactionId);
		$this->templatePath=$email[0]->template_path;
	}

	// 	4) Get paypal config
	private function GetPaypalConfiguration(){
		
		$paypal = \HelperFacade::GetPaypalConfiguration();
				
		$this->Email->paypalCgi=array_get($paypal,"paypalCgi");		
		$this->Email->paypalId=array_get($paypal,"paypalId");		
		$this->Email->completeUrl=array_get($paypal,"completeUrl");		
		$this->Email->timeoutUrl=array_get($paypal,"timeoutUrl");		
		$this->Email->cancelUrl=array_get($paypal,"cancelUrl");		
		$this->Email->notifyUrl=array_get($paypal,"notifyUrl");
				
	}

	/* 
        5) Get Ticket
            5.1 Get Airport ticket.
            5.2 Get Convention ticket.
    */
	
	private function GetTicketByTransactionId($transactionId){		
		$transfers=[];						
		$this->Email->airportTransfer= $this->GetTickets($transactionId);		
	}

	private function GetTickets($transactionId){
		$this->Email->conventionTickets=\TicketFacade::GetConventionTicketByTransactionId($transactionId);
		$this->Email->airportTickets=\TicketFacade::GetAirportTicketByTransactionId($transactionId);
		
		// $this->Email->conventionTickets=$this->GetConventions($transactionId);
		// $this->Email->airportTickets=$this->getAirports($transactionId);
	}

	private function GetConventions($transactionId){
		// $transfers=[];
		// return $conventions= $this->GetConventionTickets($transactionId);
	}

	private function getAirports($transactionId){
		// $transfers=[];
		// $airports = $this->TransactionTransferRepository->GetAirportTicketByTransactionId($transactionId);
		// $airports;

		// if($airports == null){		
		// 	return [];
		// };
		
		// foreach ($airports as $flights) {						
		// 	$transferMode="One Way";
		// 	$arrivalDate="";
		// 	$departureDate="";						
		// 	$arrivalFlight="";
		// 	$departureFlight="";	
		// 	$ticketNumber=$flights[0]->ticket_number;
						
		// 	//Get fullname of person.
		// 	$passenger = $flights[0]->Person;			
		// 	$fullname = $passenger->firstname.' '.$passenger->lastname;	
									
		// 	if(count($flights)>1){				
		// 		$transferMode="Round Trip";
								
		// 		$arrivalDate=$flights[0]->flight_date;				
		// 		$departureDate=$flights[1]->flight_date;
								
		// 		$arrivalFlight=$flights[0]->flight_number;				
		// 		$departureFlight=$flights[1]->flight_number;
				
		// 	}
		// 	else {
				
		// 		$transferMode="One Way";								
		// 		$arrivalDate=$flights[0]->flight_date;				
		// 		$departureDate="";								
		// 		$arrivalFlight=$flights[0]->flight_number;				
		// 		$departureFlight="";
				
		// 	}

		// 	$transfers[]=[
		// 		"fullname"=>$fullname,
		// 		"transferMode"=>$transferMode,
		// 		"ticketNumber"=>$ticketNumber,
		// 		"arrivalDate"=>$arrivalDate,
		// 		"departureDate"=>$departureDate,                    
		// 		"arrivalFlightNumber"=>$arrivalFlight,
		// 		"departureFlightNumber"=>$departureFlight				
		// 	];			
		// }

		// return $transfers;
	}
	
	private function GetConventionTicketByPerson($transactionId,$passengerId){		
		// $convention= $this->TransactionTransferRepository->GetConventionTicketByTransactionIdAndPassengerId($transactionId,$passengerId);
		// if($convention==null){
		// 	return null;
		// }
		// $passenger = $convention->Person;
		// $fullname = $passenger->firstname.' '.$passenger->lastname;	

		// $hotel = $this->TransactionTransferRepository->GetDataByTransactionIdPassengerId($transactionId,$passengerId);
		// if($hotel==null){
		// 	$hotelName='-';
		// }
		// else if($hotel->hotel_id == 999){
		// 	$hotelName= $hotel->hotel_other;
		// } else {
		// 	$hotelName = $hotel->GetHotel->hotel;
		// }

		// return [
		// 		"transferMode"=>"Package",
		// 		'fullname'=>$fullname,
		// 		'ticketNumber'=>$convention->ticket_number,
		// 		'hotelName'=>$hotelName,
		// 		"startDate"=>"2017-07-20",
		// 		"endDate"=>"2017-07-24"
		// ];
	}

	private function GetConventionTickets($transactionId){
		// $conventions = [];

		// $transferResults= $this->TransactionTransferRepository->GetConventionTicketByTransactionId($transactionId);
		// if($transferResults==null){
		// 	return [];
		// }

		// foreach ($transferResults as $ticket) {
		// 	$conventions[]=$this->GetConventionTicketByPerson($ticket->transaction_id,$ticket->passenger_id);
		// }

		// return $conventions;
	}
		
	private function Send($data){
		foreach ($data as $item) {
			$id = $item->id;
			try{
				
				$template = $item->templatePath;
				
				$mailContent = [
					"email"=>$item->to,
					"fullname"=>$item->fullname,
					"transactionId"=>\HelperFacade::Encode($item->transactionId),
					"amount"=>$item->amount,
					"custom"=>\HelperFacade::Encode($item->transactionId),
					"itemName"=>"ICAS: Booked Transfer",
					'conventions'=>$item->conventionTickets,
					"airports"=>$item->airportTickets,
					
					"callbackAPI"=>\HelperFacade::GetURLAPIEmailPayer().'?transactionId='.\HelperFacade::Encode($item->transactionId),
					
					"paypalId"=>env("paypalId"),
					"completeUrl"=>env("completeUrl"),//s			pecific api url
					"timeoutUrl"=>env("timeoutUrl"),//s				pecific api timeout url
					"cancelUrl"=>env("cancelUrl"),//s				pecific api url
					"notifyUrl"=>env("notifyUrl")//s				pecific api url
				];

				$this->EmailTransactionReposity->UpdateStartDateTimeById($id);

				\Mail::later(5, $template,$mailContent,function($message) use($item){
						$message->to(explode(",",$item->to));
						if(!empty($item->cc)){
							$message->cc(explode(",",$item->cc));
						}

						if(!empty($item->bcc)){
							$message->bcc(explode(",",$item->bcc));
						}
						$message->subject($item->subject);
					}
				);
				$this->EmailTransactionReposity->UpdateCompleteDateTimeById($id);
			}
			catch(\Exception $ex){
				// $this->EmailTransactionReposity->UpdateStatus($id,EmailStatus::ERROR);
				throw $ex;
			}
		}
	}
		
	private function PrepareEmail($data){
		$to = explode(",",$data[0]->to);
		$cc = explode(",",$data[0]->cc);
		$bcc = explode(",",$data[0]->bcc);
		$fullname = $data[0]->fullname;
		$subject = $data[0]->subject;
		$mail_data = [
			"templatePath"=>$data[0]->templatePath,
			"email"=>$to[0],
			"fullname"=>$fullname,
			"custom"=>\HelperFacade::Encode($data[0]->transactionId),
			"amount"=>$data[0]->amount,
			"itemName"=>$data[0]->transferTitle,
			"paypalId"=>env("PAYPAL_ID"),
			"completeUrl"=>env("PAYPAL_COMPLETED_URL"),
			"timeoutUrl"=>env("PAYPAL_TIMEOUT_URL"),
			"cancelUrl"=>env("PAYPAL_CANCEL_URL"),
			"notifyUrl"=>env("PAYPAL_NOTIFYURL"),
		];

		return $mail_data;
	}

	//-------- Check Email Pending  -----------------------------
	public function CheckEmailPending(){
		$resultPending = $this->EmailTransactionReposity->EmailPending();
		// $resultPaid = $this->EmailTransactionReposity->EmailPaid();

		$email_arr = [];
		foreach($resultPending as $value){
			// $this->email = new PaymentTransaction;
			// $this->email->email = $value->to;

			// array_push($email_arr, $this->email);
			$resultPaid = $this->EmailTransactionReposity->EmailPaid($value->to);

			if($resultPaid){
				
			}else{
				$this->email = new PaymentTransaction;
				$this->email->fullname = $value->fullname;
				$this->email->email = $value->to;
				if($value->payment_transaction_status_id==1){
					$this->email->status = 'Pending';
				}else{
					$this->email->status = 'Paid';
				}
				$this->email->bookingDate = $value->created_at;
				$this->email->paymentExpire = $value->expired_date;

				array_push($email_arr, $this->email);
			}
		}

		$count = 1;

		$table = '<table style="border:1px solid;">';
		$table .= '
			<tr>
				<th style="border-bottom:1px solid; border-right:1px solid;">No</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Fullname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Email</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Status</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Booking date</th>
				<th style="border-bottom:1px solid;">Payment expire</th>
			</tr>';
		
		foreach($email_arr as $v){
			$table .= '
				<tr>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$count.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->fullname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->email.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->status.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->bookingDate.'</td>
					<td style="border-bottom:1px solid;">'.$v->paymentExpire.'</td>
				</tr>';
			$count++;
		}

		$table .= '</table>';

		return $table;
	}
}

?>