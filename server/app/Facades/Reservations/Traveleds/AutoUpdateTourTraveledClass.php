<?php
namespace App\Facades\Reservations\Traveleds;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Reservations\Traveleds\TourTraveledRepository as TourTraveledRepo;

// import model
use App\transaction as Transaction;

class AutoUpdateTourTraveledClass{

	public function __construct(TourTraveledRepo $TourTraveledRepo){
        $this->TourTraveledRepo = $TourTraveledRepo;
    }

	// 1. Auto update tour traveled
	public function AutoUpdateTourTraveled($data){
        // set data
        $isTraveled = array_get($data,'isTraveled');
        $updateBy = array_get($data,'updateBy');

        // set date now
        $dateNow = Carbon::now('Asia/Bangkok');

        // update
        $updateTransactionTour = $this->TourTraveledRepo->AllUpdateTourTravel($dateNow,$isTraveled,$updateBy);
        if($updateTransactionTour){
            return $updateTransactionTour;
        }else{
            return "false";
        }
	}
}