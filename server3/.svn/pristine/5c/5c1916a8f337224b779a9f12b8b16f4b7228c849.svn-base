<?php 
namespace App\Http\Controllers\EasyBook\Payment;

use Validator;
use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\MyBaseController;

// use Redirect;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends MyBaseController {
	
	public function Test(){
		//return redirect()->away('http://www.google.com');
		// $test = env("DB_HOST");
		// return ["status"=>$test];
		return "Successed";
	}

	public function PendingEmailPayer(Request $request){				
		$result = \PaymentFacade::GetTransaction2PayWithPaypal($request->transactionId);
		// return $result;
		if(array_get($result,'status')==false){
			return view('easybook.templates.unvariable');
		} else {

		return view("easybook.payment.paybyemailpayer",
			[
				"status"=>array_get($result,'status')=="true"?true:false,
				"paypalCgi"=>array_get($result,'data.paypalCgi'),
				"paypalId"=>array_get($result,'data.paypalId'),
				"transactionId"=>array_get($result,'data.transactionId'),					
				"email"=>array_get($result,'data.email'),
				"amount"=>array_get($result,'data.amount'),
				"itemName"=>array_get($result,'data.itemName'),
				"completeUrl"=>array_get($result,'data.completeUrl'),
				"timeoutUrl"=>array_get($result,'data.timeoutUrl'),
				"cancelUrl"=>array_get($result,'data.cancelUrl'),
				"notifyUrl"=>array_get($result,'data.notifyUrl')
			]);
		}
	}
	
	public function store(Request $request){
		
		$rules = array('transaction_id'=>'required');
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()){
			return redirect()->away('http://www.google.com');
			//r			eturn ['validator'=>'failure'];
		}
		
		$ticket_number = $request->input('transaction_id');
		$array=['transaction_id'=>$ticket_number];
		return $array;
	}
	
	public function CancelledPayment(Request $request){
		try{
			if($request == null){
				return redirect()->away('http://wwww.easybook.tour-in-chiangmai.com?validate=fail&msg=args');
			}
			
			$this->ValidatePaypalRequest($requset);
			\PaymentFacade::CancelPaymentByTransactionId($request);
		}
		catch(Exception $ex){
			$this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'Fail to cancelled payment: '.$e);
			return redirect()->away('http://wwww.easybook.tour-in-chiangmai.com?validate=fail&msg=args');
			//c			hange to real site.
		}
	}
	
	public function ConfirmPayment(Request $request){	
		try{		
			
			$this->ValidatePaypalRequest($request);
			$result =  \PaymentFacade::ConfirmPaymentByTransactionId($request);
			if($result == false){
				return view('easybook.templates.unvariable');
			}			

			$email = \EmailFacade::SendPendingEmailByTransactionId($request);
			
			if($email == null){
				return [];//Need to implement after that
			}

			// \InvoiceFacade::insertInvoiceNumber($request);
			\InvoiceFacade::InsertInvoiceNumberPerPax($request);
			
			//$transfers= $email[0]->transfers[0];
			$airports = $email[0]->airportTickets;
			$conventions = $email[0]->conventionTickets;//array_get($transfers,'conventionTransfer');

			return view('easybook.reservation.success',[
				'conventions'=>$conventions,
				"airports"=>$airports,
				"transactionId"=>$request->cm
			]);
		}
		catch(Exception $ex){			
			$this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'Fail to cancelled payment: '.$e);
			//return redirect()->away('wwww.easybook.tour-in-chiangmai.com?validate=fail&msg=args');			
		}
	}

	public function VerifyPayments(){
		try{
			\PaymentFacade::Verify('PaymentCron');
			return 'Verified payment command successfully!';
		}catch(\Exception $ex){
			return 'Verified payment has somthing went wrong!';
		}
	}
	
	private function ValidatePaypalRequest($request){
		$rules = array('cm'=>'required');
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()){
			//Replace to easybook site
			//return redirect()->away('http://www.google.com');
		}
	}

	/*********
	Check expired date
	*********/

	public function ExpiredPayment($activityId) {
		// return "Complete !";
		$result = \PaymentFacade::ExpiredPayment();
		return $result;
	} 

	public function ExpirePayment($activityId)
	{
		// return ('expire');
		$gettrip = \PaymentFacade::Gettrip();
		return $gettrip;
	}
}
