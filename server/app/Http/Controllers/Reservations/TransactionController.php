<?php
namespace App\Http\Controllers\Reservations;

// use Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class TransactionController extends MyBaseController {

	// Save for insert and run booking number
	public function ReservationSaveBookingData(Request $request){
		$bookingData  = $request->input();
		try{
			$results = \ReservationTransactionFacade::SaveTransactionBookingData($bookingData);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Update booking number
	public function EditReservation(Request $request){
		$bookingData = $request->input();
		try{
			$results = \EditReservationFacade::EditReservation($bookingData);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Update booking traveled
	public function UpdateTourTraveled(Request $request){
		$data = $request->input();
		try{
			$results = \ReservationUpdateTourTraveledFacade::UpdateTourTraveled($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}
}
