<?php namespace App\Http\Controllers\Reservations;

// use Request;
use Validator;
use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\MyBaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends MyBaseController {

	// Get booking data for reservation
	public function GetDataBooking(){
		try{
			$results = \ReservationBookingFacade::GetDataBooking();

			if($results==null){
				abort(400);
			}
			// header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
			// header('Access-Control-Allow-Origin: *');
			return $results->tourInfo;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			// return $this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'TransactionControlelr.GetDataTransactionPaid error: '.$e);
			abort(500);
		}
	}

	// Get account code
	public function GetAccountCodeData(){
		try{
			$results = \ReservationBookingFacade::GetAccountCode();

			if($results==null){
				abort(400);
			}
			// header('Access-Control-Allow-Origin: *');
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			// return $this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'TransactionControlelr.GetDataTransactionPaid error: '.$e);
			abort(500);
		}
	}

	// Get booking statistics data
	public function GetBookingStatisticData(){
		try{
			$results = \ReservationBookingStatisticsFacade::GetBookingStatistics();

			if($results==null){
				abort(400);
			}
			// header('Access-Control-Allow-Origin: *');
			// header('Access-Control-Allow-Credentials: true');
			// header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

	// Get booking form data
	public function GetBookingFormData($transactionId){
		try{
			$results = \ReservationBookingFacade::GetBookingFormData($transactionId);

			if($results==null){
				abort(400);
			}
			// header('Access-Control-Allow-Origin: *');
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

	// Get confirmation & invoice data
	public function GetInvoiceData($transactionId){
		try{
			$results = \InvoiceBookingFacade::GetInvoiceData($transactionId);

			if($results==null){
				abort(400);
			}
			// header('Access-Control-Allow-Origin: *');
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

}
