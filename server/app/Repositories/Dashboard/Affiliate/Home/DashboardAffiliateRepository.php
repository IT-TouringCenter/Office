<?php 
namespace App\Repositories\Dashboard\Affiliate\Home;

class DashboardAffiliateRepository{

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

    //----------------- Transaction ----------------------------------
    // booked
    public function GetBooked($accountId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','tt.transaction_id','=','t.id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // booked by month
    public function GetBookedByMonth($accountId,$month){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.book_date','like','%-'.$month.'-%')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // traveled
    public function GetTraveled($accountId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // traveled by month
    public function GetTraveledByMonth($accountId,$month){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.tour_travel_date','like','% '.$month.' %')
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // canceled by month
    public function GetCanceledByMonth($accountId,$month){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.is_active',1)
                    ->where('tt.cancel_date','like','%-'.$month.'-%')
                    ->where('tt.is_cancel',1)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // commission by month
    public function GetCommissionByMonth($accountId,$month){
        $result = \DB::table('affiliate_commission_details as acd')
                    ->select('acd.commission_adult','acd.commission_child')
                    ->join('transaction_tours as tt','tt.id','=','acd.transaction_tour_id')
                    ->where('acd.account_id',$accountId)
                    ->where('acd.travel_date','like','%-'.$month.'-%')
                    ->where('acd.is_travel',1)
                    ->where('acd.is_active',1)
                    ->where('tt.is_travel',1)
                    ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    // ---------------- Affiliate ------------------------------------
    // commission
    public function GetCommission($accountId){
        $result = \DB::table('affiliate_commissions')
                    ->where('account_id',$accountId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // check affiliate commission table 
    public function CheckAffiliateCommission($accountId){
        $result = \DB::table('affiliate_commissions')
                    ->where('account_id',$accountId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // create affiliate commission record
    public function CreateAffiliateCommissionRecord($data){
        $result = \DB::table('affiliate_commissions')->insertGetId($data);
        return $result;
    }
}