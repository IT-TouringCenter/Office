<?php
namespace App\Http\Controllers\Tours;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class TourController extends MyBaseController {

	// Get tour
	public function GetTour(){
		try{
			$results = \TourFacade::GetTour();
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Update tour travel
	public function UpdateTourTraveled(Request $request){
		$data = $request->input();
		try{
			$results = \TourTraveledFacade::UpdateTourTraveled($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Update tour travel per book
	public function UpdateTourTraveledPerBook(Request $request){
		$data = $request->input();
		try{
			$results = \TourTraveledFacade::UpdateTourTraveledPerBook($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

}
