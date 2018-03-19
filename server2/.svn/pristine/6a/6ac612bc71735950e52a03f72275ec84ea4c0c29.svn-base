<?php
namespace App\Repositories\EasyBook\Email;

use Carbon\Carbon;
use App\email_user;
use App\Commons\TransactionStatus;
use App\Commons\Email\EmailStatus;
use App\Commons\Email\EmailContactType;
use App\configuration_email as EmailConfig;
use App\email_contact_type as EmailContact;
use App\email_notify_transaction as EmailTransaction;

use App\Repositories\EasyBook\Transaction\TransactionRepository as TransactionRepository;
//use App\Repositories\EasyBook\Reservation\TransactionDetailReposity as TransactionDetailReposity;

class EmailTransactionReposity{
	public function __construct(EmailConfig $EmailConfig,EmailContact $EmailContact,EmailTransaction $EmailTransaction){
		$this->EmailTransaction = $EmailTransaction;
		$this->EmailContact = $EmailContact;
		$this->EmailConfig = $EmailConfig;
	}
	
	public function Save($data){							
		$tranasction=[
			"transaction_source_id"=>$data->transactionSourceId,
			"transaction_id"=>$data->transactionId,
			"email_notify_status_id"=>$data->emailStatus,
			"fullname"=>$data->fullname,
			"subject"=>$data->subject,
			"to"=>$data->to,
			"cc"=>$data->cc,
			"bcc"=>$data->bcc,
			"template_path"=>$data->template,		
			"limit_retry"=>3,
			"is_active"=>1,			
			"created_by"=>$data->createdBy,
			"created_at"=>$data->createdAt
		];		
		
		return $this->EmailTransaction->insertGetId($tranasction);
	}

	public function GetEmailContactByActivity($activityId){
		//return "You can access";
		$tmpEmail='';
		$emailContacts= $this->EmailConfig
			->where('is_active','=',1)
			->where('activity_id','=',$activityId)				
			->get();

		return $this->ConcateContact($emailContacts);		
	}

	public function GetToEmailContact($activityId){
		$contacts= $this->EmailConfig
			->where('is_active','=',1)
			->where('activity_id','=',$activityId)
			->where('is_to','=',1)
			->get();
					
		return $this->ConcateContact($contacts);
	}

	public function GetCCEmailContact($activityId){
		$contacts= $this->EmailConfig
			->where('is_active','=',1)
			->where('activity_id','=',$activityId)
			->where('is_cc','=',1)
			->get();

		return $this->ConcateContact($contacts);			
	}

	public function GetBCCEmailContact($activityId){
		$contacts= $this->EmailConfig
			->where('is_active','=',1)
			->where('activity_id','=',$activityId)
			->where('is_bcc','=',1)
			->get();
		
		return $this->ConcateContact($contacts);
	}

	public function GetPendingEmail(){
		return $this->EmailTransaction
			->where('is_active','=',1)
			->where('email_notify_status_id','=',0)
			->where('count_retry','>=',0)
			->where('count_retry','<=',3)
			->take(50)
			->get(['id','transaction_id','fullname','subject', 'to','cc','bcc','template_path']);					
	}

	public function GetPendingEmailByTransactionId($transactionId){
		return $this->EmailTransaction
			->where('is_active','=',1)
			->where('email_notify_status_id','=',0)
			->where('count_retry','>=',0)
			->where('count_retry','<=',3)
			->where('transaction_id','=',$transactionId)
			->get(['id','transaction_id','fullname','subject', 'to','cc','bcc','template_path']);
	}

	public function UpdateCompleteDateTimeById($id){
		$model = $this->EmailTransaction
			->where('is_active','=',1)
			->where('id','=',$id)
			->first();

		$model->email_notify_status_id=EmailStatus::SUCCEED;
		$model->is_active = 0;
		$model->completed_datetime=Carbon::now('Asia/Bangkok');
		$model->updated_by = $id;

		return $model->save();
	}

	public function UpdateStartDateTimeById($id){
		$model = $this->EmailTransaction
			->where('is_active','=',1)
			->where('id','=',$id)
			->first();
		$model->start_datetime=Carbon::now('Asia/Bangkok');
		return $model->save();
	}

	public function UpdateStatus($id,$emailStatus){
		$model = $this->EmailTransaction
			->where('is_active','=',1)
			->where('id','=',$id)
			->first();

		$model->completed_datetime=Carbon::now('Asia/Bangkok');
		$model->email_notify_status_id=$emailStatus;
		$model->is_active = 0;
		return $model->save();
	}

	private function ConcateContact($contacts){
		$tmpEmail ='';
		$seq = 0;
		foreach ($contacts as $mail) {
			$tmpEmail.=$mail->emails->email;

			if($seq < count($contacts)-1){
				$tmpEmail.=",";
			}
			$seq .=1;
		}

		return $tmpEmail;
	}

	private function MapEmail_NotUse($results){
		$mails=[];
		foreach ($results as $item) {
			
			$this->UpdateStartDateTimeById($item->id);

			$mail = new EmailConfig;			
			$transactionId = $item->transaction_id;

			/*

			*/
			$transactionResult=$this->TransactionRepository->GetDataByTransactionId($transactionId);			
			if(count($transactionResult->GetPaymentTransaction)<1 || $transactionResult->GetPaymentTransaction==null){
				$amount = $transactionResult->amount;
			} else {
				$amount=$transactionResult->GetPaymentTransaction[0]->amount;
			}

			//activity_id			
			$activityId=$transactionResult->activity_id;

			/*** Get transaction mode ***/
			$trResult= $item->GetTransaction;
			// return $trResult;

			$transferMode = $trResult->GetTransferMode;
			$mode =$transferMode->mode;
									
			/*** Get transfer reserve type ***/
			$transferReserveType = $trResult->GetTransferReserveType;
			//return $transferReserveType;

			$reserveType= $transferReserveType->reserve_type;
			//return $reserveType;

			if($transferReserveType->id == 4){//Hotel and Convention Centre
				$title="Hotel&Convention";
				$source=$trResult->GetHotelBySource->hotel.' Hotel';
				$target="Convention Center";
			}else if($transferReserveType->id == 3){//Airport and Hotel
				$title="Airport & Hotel";
				$source="Airport";
				$target=$trResult->GetHotelByTarget->hotel.' Hotel';
			}else if($transferReserveType->id == 2){//Hotel to Airport
				$title="Hotel to Airport";	
				$source= $trResult->GetHotelBySource->hotel.' Hotel';				
				$target="Airport";							
			}else if($transferReserveType->id == 1){///Hotel and Convention Centre
				$title="Airport to Hotel";
				$source="Airport";
				$target=$trResult->GetHotelBySource->hotel.' Hotel';
			}

			/*** Get payment status ***/			
			if($tr_result->GetPaymentTransaction[0]->transaction_status_id==TransactionStatus::PENDING){
				$paymentStatus = "Pending";
			} elseif($tr_result->GetPaymentTransaction[0]->transaction_status_id==TransactionStatus::APPROVED) {
				$paymentStatus = "Approved";
			}elseif($tr_result->GetPaymentTransaction[0]->transaction_status_id==TransactionStatus::EXPIRED) {
				$paymentStatus = "Expired";
			}elseif($tr_result->GetPaymentTransaction[0]->transaction_status_id==TransactionStatus::CANCELLED) {
				$paymentStatus = "Cancelled";
			}elseif($tr_result->GetPaymentTransaction[0]->transaction_status_id==TransactionStatus::ERROR) {
				$paymentStatus = "Error";
			}else {
				$paymentStatus = "Unvariable";
			}
			
			/*** set ticket number ***/
			//$transactionDetails = $this->TransactionDetailReposity->GetParentTransctionByTransactionId($transaction_id);
			$transactionDetails =$this->TransactionDetailReposity->GetDataByTransactionId($transaction_id);
			if(count($transactionDetails)< 1 || $transactionDetails==null){
				return ["status"=>false,"data"=>"Find not found your transaction detail"];
			}

			$tickets=[];
			foreach ($transactionDetails as $detail) {
				$passenger = $detail->GetPassenger;
				$tickets[]=[
					"fullname"=>$passenger->firstname .' '.$passenger->lastname,
					"ticketNumber"=>\HelperFacade::SetTicketNumberFormat($detail->ticket_number),
					"mode"=>$mode,
					"title"=>$title,
					"source"=>$source,
					"target"=>$target,
					"status"=>$paymentStatus,
					"amount"=>$detail->price
				];
			}

			/*** Set mail ***/
			$mail->id=$item->id;
			$mail->transaction_id=$tr_result->transaction_id;
			$mail->fullname=$item->fullname;
			$mail->subject =$item->subject;

			$mail->to=$item->to;
			$mail->cc=$item->cc;
			$mail->bcc=$item->bcc;
			$mail->template_path=$item->template_path;
			$mail->amount= $amount;
			$mail->transferTitle = $tr_result->reserveType.'('.$tr_result->mode.')';
			$mail->reserveTypeId=$transferReserveType->id;
			$mail->itemName =$mail->transferTitle;
			$mail->duedates=Carbon::now();
			$mail->tickets=$tickets;


			$mails[]=$mail;		
		}

		return $mails;
	}

	public function EmailPending(){
		$result = \DB::table('email_notify_transactions as ent')
                    ->select('ent.transaction_id','ent.fullname','ent.to','pt.payment_transaction_status_id','pt.created_at','pt.expired_date')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','ent.transaction_id')
                    ->where('pt.payment_transaction_status_id','=','1')
                    // ->where('pt.created_at','>=','2017-07-01 00:00:00')
                    ->where('ent.fullname','not like','%test%')
                    // ->where('pt.is_expired',0)
                    ->groupBy('ent.to')
                    ->orderBy('pt.expired_date')
                    ->get();
        return $result;
	}

	public function EmailPaid($email){
		$result = \DB::table('email_notify_transactions as ent')
                    ->select('ent.transaction_id','ent.fullname','ent.to','pt.created_at','pt.expired_date')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','ent.transaction_id')
                    ->where('pt.payment_transaction_status_id','=','2')
                    // ->where('pt.created_at','>=','2017-07-01 00:00:00')
                    ->where('ent.to','=',$email)
                    ->where('ent.fullname','not like','%test%')
                    ->groupBy('ent.to')
                    ->orderBy('pt.expired_date')
                    ->get();
        return $result;
	}

}
?>