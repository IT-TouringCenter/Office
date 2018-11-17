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

	/* ------------------------------------
	 	Logic update tour traveled
	------------------------------------ */

	// Update tour traveled
	public function AutoUpdateTourTraveled($data){
        // update travel_date
        // $get = $this->TourTraveledRepo->Get();
        // $count = 1;
        // foreach($get as $value){
        //     $id = $value->id;
        //     $date = date('Y-m-d',strtotime($value->tour_travel_date));
        //     $update = $this->TourTraveledRepo->Save($id,$date);
        //     $count++;
        // }
        // return $count;

        // set data
        $isTraveled = array_get($data,'isTraveled');
        $updateBy = array_get($data,'updateBy');

        // set date now
        $dateNow = Carbon::now('Asia/Bangkok');
        $setDate = date('d F Y',strtotime($dateNow));
        return $setDate;
        // update
        $updateTransactionTour = $this->TourTraveledRepo->AllUpdateTourTravel($setDate);
        if($updateTransactionTour){
            return $updateTransactionTour;
        }else{
            return "null";
        }
	}

}