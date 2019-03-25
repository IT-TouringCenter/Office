<?php
namespace App\Repositories\Reservations\Traveleds;

use Carbon\Carbon;

class GetUpdateTraveledRepository{

	public function __construct(){

	}

  // check account
  public function GetAccountByToken($token, $accountTypeId){
    $result = \DB::table('accounts')
                  ->where('account_type_id',$accountTypeId)
                  ->where('token',$token)
                  ->where('is_active',1)
                  ->get();
    return $result;
  }

  // 
  public function GetBookingTourUnique($dateNow){
    $result = \DB::table('transaction_tours')
                  ->select('tour_code','tour_title','tour_privacy','tour_travel_time','tour_travel_date','travel_date')
                  ->where('travel_date','<',$dateNow)
                  ->where('is_travel',0)
                  ->where('is_cancel',0)
                  ->where('is_active',1)
                  ->groupBy('tour_code')
                  ->groupBy('tour_privacy')
                  ->groupBy('tour_travel_date')
                  ->orderBy('travel_date')
                  ->get();
    return $result;
  }

  // 
  public function GetBookingTour($code, $dateNow){
    $result = \DB::table('transaction_tours')
                  ->select('pax','adult_pax','child_pax','infant_pax')
                  ->where('tour_code',$code)
                  ->where('travel_date',$dateNow)
                  ->where('is_cancel',0)
                  ->where('is_travel',0)
                  ->where('is_active',1)
                  ->get();
    return $result;
  }

}