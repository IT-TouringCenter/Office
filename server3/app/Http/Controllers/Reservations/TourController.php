<?php namespace App\Http\Controllers\Reservations;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TourController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function GetTourData()
	{
		$results = \ReservationTourFacade::GetTourData();
		return $results;
	}

}
