<?php
namespace App\Http\Controllers\EasyBook\Transaction;

// use Request;
use Validator;
use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\MyBaseController;

use Illuminate\Support\Facades\Redirect;

class TransactionController extends MyBaseController {

	public function SaveBookingReservationIcas($activityId, Request $request){

		try{
			
			$this->SaveBookingReservationIcasValidator($request);
			
			$result = \TransactionIcasFacade::Save($activityId, $request);
			if($result==null){
				return $this->Response(ResponseStatus::NoContent, ResponseCode::NoContent,null);
			}
			
			if(array_get($result,'status')==true){
				\EmailFacade::SendPendingPaymentEmail();
			}

			return $this->Response(ResponseStatus::OK, ResponseCode::OK,$result);
		}catch(Exception $e){
			abort(500);			
		}
	}

	private function SaveBookingReservationIcasValidator($request){
		
		$this->RequestValidator($request);

		$rules = [
			'activityId'=>'required',
			'reservations'=>'required|array',
			'summary.amount'=>'required|integer|min:150'
			//'customers'=>'required|array'
		];

		foreach ($request->get('reservations') as $key => $value) {
			$rules['reservations.'.$key.'.passenger.firstname'] ='required';
			$rules['reservations.'.$key.'.passenger.lastname'] ='required';
			$rules['reservations.'.$key.'.passenger.email'] ='required';
		}

		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()){
			return abort(400);
		}
	}

	private function RequestValidator($request){
		$props= array_keys($request->summary);
		if(in_array('amount',$props) == false){
			return abort(400);
		}
	}

// ================================================================================== //	
	public function VerifyTickets(){
		try{
			return \TicketFacade::Verify('Schedule');
			return 'Verify ticket command run successfully!';
		}catch(\Exception $e){
			return 'Verify ticket command has something went wrong!';
		}
	}

	//----------------- After payment via paypal -------------------------//
	public function GetDataTransactionPaid($activityId, $transactionId){
		try{
			if($transactionId == null){
				abort(400);
			}
			$tid = \HelperFacade::Decode($transactionId);
			$results = \TransactionInvoiceFacade::GetTransactionBooking($tid);
			return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			return abort(400);
			// return $this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'TransactionControlelr.GetDataTransactionPaid error: '.$e);
		}
	}


	//------------- Generate transaction id -----------------------//
	public function GenerateTransactionID($transactionId){
		// return \HelperFacade::Encode($transactionId);
		return \HelperFacade::Decode($transactionId);
	}
}