<?php 
namespace App\Repositories\Dashboard\Affiliate\Traveled;

class DashboardAffiliateTraveledRepository{

	public function __construct(){

    }

    //----------------- Account --------------------------------------
    public function GetAccountByToken($token,$type){
        $result = \DB::table('accounts')
                    ->where('account_type_id',$type)
                    ->where('token',$token)
                    ->get();
        return $result;
    }

    //----------------- Tour -----------------------------------------
    public function GetTour(){
        $result = \DB::table('tours')
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    public function GetTourById($tourId){
        $result = \DB::table('tours')
                    ->where('id',$tourId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    //----------------- Transaction ----------------------------------
    public function GetTourTraveled($accountId,$tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // all : manager
    public function GetAllTourTraveled($tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.is_active',1)
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // traveled [days of month]
    public function GetTraveledByDays($accountId,$travelDate){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.tour_travel_date',$travelDate)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // all traveled [days of month] : manager
    public function GetAllTraveledByDays($travelDate){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.is_active',1)
                    ->where('tt.tour_travel_date',$travelDate)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // traveled [monthly]
    public function GetTraveledByMonth($accountId,$travelDate){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.tour_travel_date','like','% '.$travelDate)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // all traveled [monthly] : manager
    public function GetAllTraveledByMonth($travelDate){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.is_active',1)
                    ->where('tt.tour_travel_date','like','% '.$travelDate)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // traveled group by year
    public function CheckYearByTravel($accountId){
        $result = \DB::table('transaction_tours as tt')
                    ->select('tt.tour_travel_date')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->groupBy('tt.tour_travel_date')
                    ->get();
        return $result;
    }

    // traveled by tour id
    public function GetTraveledTour($accountId,$year,$tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.tour_travel_date','like','% '.$year)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }
}