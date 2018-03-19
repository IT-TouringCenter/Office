<?php namespace App\Http\Controllers\EasyBook\Email;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Mail;
//use Illuminate\Support\Facades\Mail;
class EmailController extends Controller {

	//For test data
	public function TestEMail(){		
		$msg = \EmailFacade::SendPendingPaymentEmail();		
		return ['Result'=>$msg];
	}

	//For test email template
	public function PendingNotifyTest(){
		//return ["Status"=>"Succeed"];
		$data = \EmailFacade::GetPendingEmail();
		//return $data;

		return view(array_get($data,'templatePath'),[
			'paypal_id'=>array_get($data,'paypal_id'),
			'fullname'=>array_get($data,'fullname'),
			'email'=>array_get($data,'email'),
			'transactionId'=>array_get($data,'custom'),
			'amount'=>10,//array_get($data,'amount'),
			'item_name'=>array_get($data,'item_name'),
			'complete_url'=>array_get($data,'complete_url'),
			'timeout_url'=>array_get($data,'timeout_url'),
			'cancel_url'=>array_get($data,'cancel_url'),
			'notify_url'=>array_get($data,'notify_url')
			]);
	}

	public function GetPendingEmail(){
		$data= \EmailFacade::GetPendingEmail();
		if($data==null){
			return [];
		}

		return view('easybook.reservation.success',[
			'transfers'=>$data[0]->transfers
		]);
	}	

	public function GetPaidNotifyTemplate(){
		$data = \EmailFacade::GetPendingEmail();
		
		return view('easybook.emails.paidPayment',[
			'paypal_id'=>$data[0]->paypal_id,
			'fullname'=>$data[0]->fullname,
			'email'=>$data[0]->email,
			'transactionId'=>$data[0]->custom,
			'amount'=>$data[0]->amount,
			'mode'=>$data[0]->mode,
			'item_name'=>$data[0]->itemName,
			'ticketNumber'=>$data[0]->ticketNumber,
			'reserveTypeId'=>$data[0]->reserveTypeId,
			'title'=>array_get($data[0]->transfers,'title'),
			'source'=>array_get($data[0]->transfers,'source'),
			'target'=>array_get($data[0]->transfers,'target')
		]);
	}

	public function PendingNofify(){
		$msg = \EmailFacade::SendPendingPaymentEmail();
		return ["status"=>$msg];
	}

	//------------ Send email for booking pending payment after 17 July 2017 -----------------------------//
	public function SendEmailPendingICAS(){
		$email = \EmailFacade::CheckEmailPending();
		return $email;
	}
}
