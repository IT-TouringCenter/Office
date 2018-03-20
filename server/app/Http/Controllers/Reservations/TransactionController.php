<?php
namespace App\Http\Controllers\Reservations;

// use Request;
use Validator;
use App\Http\Requests;
// use App\Commons\ResponseCode;
// use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
// use App\Http\Controllers\MyBaseController;

use Illuminate\Support\Facades\Redirect;

class TransactionController extends MyBaseController {

	public function ReservationSaveBookingData(Request $request){
		$bookingData  = $request->input();
		// header('Access-Control-Allow-Origin: *');
		try{
			$results = \ReservationTransactionFacade::SaveTransactionBookingData($bookingData);

			if($results==null){
				abort(400);
			}

			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			// return $this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'TransactionControlelr.GetDataTransactionPaid error: '.$e);
			abort(500);
		}
	}
}
