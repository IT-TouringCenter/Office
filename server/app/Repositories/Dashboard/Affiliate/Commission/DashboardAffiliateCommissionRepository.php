<?php 
namespace App\Repositories\Dashboard\Affiliate\Commission;

class DashboardAffiliateCommissionRepository{

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
    // commission
    public function GetCommissionByTourId($accountId,$tourId){
        $result = \DB::table('affiliate_commission_details as acd')
                    ->join('transaction_tours as tt','tt.id','=','acd.transaction_tour_id')
                    ->where('acd.account_id',$accountId)
                    ->where('acd.is_travel',1)
                    ->where('acd.is_active',1)
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // commission [days of month]
    public function GetCommissionByDays($accountId,$travelDate){
        $result = \DB::table('affiliate_commission_details as acd')
                    ->join('transaction_tours as tt','tt.id','=','acd.transaction_tour_id')
                    ->where('acd.account_id',$accountId)
                    ->where('acd.travel_date',$travelDate)
                    ->where('acd.is_travel',1)
                    ->where('acd.is_active',1)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // commission [monthly]
    public function GetCommissionMonthly($accountId,$travelDate){
        $result = \DB::table('affiliate_commission_details as acd')
                    ->join('transaction_tours as tt','tt.id','=','acd.transaction_tour_id')
                    ->where('acd.account_id',$accountId)
                    ->where('acd.travel_date','like',$travelDate.'-%')
                    ->where('acd.is_travel',1)
                    ->where('acd.is_active',1)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // commission [tour]
    public function GetCommissionByTour($accountId){
        $result = \DB::table('affiliate_commission_details as acd')
                    ->join('transaction_tours as tt','tt.id','=','acd.transaction_tour_id')
                    ->where('acd.account_id',$accountId)
                    ->where('acd.is_travel',1)
                    ->where('acd.is_active',1)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }
}