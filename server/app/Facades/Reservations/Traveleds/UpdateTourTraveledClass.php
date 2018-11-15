<?php
namespace App\Facades\Reservations\Traveleds;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Reservations\Traveleds\TourTraveledRepository as TourTraveledRepo;

// import model
use App\transaction as Transaction;

class UpdateTourTraveledClass{

	public function __construct(TourTraveledRepo $TourTraveledRepo){
        $this->TourTraveledRepo = $TourTraveledRepo;
    }

	/* ------------------------------------
	 	Logic update tour traveled
			
	------------------------------------ */

	// Update tour traveled
	public function UpdateTourTraveled($data){
        // set data
        $transactionTourId = array_get($data,'transactionTourId');
        $isTraveled = array_get($data,'isTraveled');
        $updateBy = array_get($data,'updateBy');
        return $data;
	}

}