<?php 
namespace App\Repositories\Dashboard\Affiliate\Tours;

class DashboardAffiliateTourRepository{

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

    //----------------- Transaction ----------------------------------
    public function GetBookedByTourId($tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('tt.tour_id',$tourId)
                    ->where('t.is_active',1)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // tour [days of month]
    // booked
    public function GetTourBookedByDays($accountId,$date,$tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.book_date',$date)
                    ->where('t.is_active',1)
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // traveled
    public function GetTourTraveledByDays($accountId,$date,$tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.tour_travel_date',$date)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // tour [monthly]
    // booked
    public function GetTourBookedByMonth($accountId,$date,$tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.book_date','like',$date.'-%')
                    ->where('t.is_active',1)
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // traveled
    public function GetTourTraveledByMonth($accountId,$date,$tourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.tour_id',$tourId)
                    ->where('tt.tour_travel_date','like','% '.$date)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }
}