<?php
namespace App\Http\Controllers\Bookings;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class BookingController extends MyBaseController {

	// Save for insert and run booking number
	public function SaveBookingOnline(Request $request){
		$bookingData  = $request->input();
		try{
			$results = \SaveBookingFacade::SaveBooking($bookingData);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Update payment and confirm booking
	public function UpdateBookingPayment(Request $request){
		$data = $request->input();
		try{
			$results = \UpdateBookingPaymentFacade::UpdateBookingPayment($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

}
