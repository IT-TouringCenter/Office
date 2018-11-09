<?php 
namespace App\Repositories\Dashboard\Affiliate\Traveled;

class DashboardAffiliateTraveledRepository{

	public function __construct(){

    }

    //----------------- Account --------------------------------------
    public function GetAccountByToken($token){
        $result = \DB::table('accounts')
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

    //----------------- Transaction ----------------------------------
    public function GetTourTraveled($accountId,$tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    // ->where('tt.tour_travel_date','like','% '.$month.' %')
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

}