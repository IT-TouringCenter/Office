<?php
namespace App\Repositories\Reservations\Traveleds;

use Carbon\Carbon;

class TourTraveledRepository{

	public function __construct(){

	}

    // 1. transaction (Update)
	public function EditTransactionBooking($transactionId,$bookingData){
    }

    // 2. all update is_travel in transaction_tours
    public function AllUpdateTourTravel($date){
        $update = ['is_travel'=>1];
        $result = \DB::table('transaction_tours')
                    ->where('tour_travel_date','<','20 December 2018')
                    ->where('is_travel',0)
                    ->where('is_cancel',0)
                    ->where('is_active',1)
                    ->update($update);
        return $result;
    }

    // 3. all 

    public function Get(){
        $result = \DB::table('transaction_tours')
                    ->select('id','tour_travel_date')
                    ->where('travel_date','=','0000-00-00')
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    public function Save($id,$date){
        $update = ["travel_date"=>$date];
        $result = \DB::table('transaction_tours')
                    ->where('id',$id)
                    ->update($update);
        
        $result1 = \DB::table('transaction_tour_histories')
                    ->where('transaction_tour_id',$id)
                    ->update($update);
        return $result1;
    }
}