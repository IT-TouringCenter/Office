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
		// return 'Complete!!';
		// return $request->input();
		// header('Access-Control-Allow-Origin: *');
		// header("Access-Control-Allow-Headers: *");
		// header('Access-Control-Allow-Origin:  http://localhost:4200');
		// header('Access-Control-Allow-Methods: POST');
		// header('Access-Control-Allow-Headers: Content-Type, Authorization');
		$server = $request->server('HTTP_ORIGIN', '');
		if(isset($server)){
			// header('Access-Control-Allow-Origin: *');
			// header('Access-Control-Allow-Credentials: true');
			// header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
		}
		$bookingData  = $request->input();
		
		try{
			$results = \ReservationTransactionFacade::SaveTransactionBookingData($bookingData);

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
}
