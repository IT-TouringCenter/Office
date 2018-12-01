<?php 
namespace App\Repositories\Dashboard\Affiliate\Booked;

class DashboardAffiliateBookedRepository{

	public function __construct(){

    }

    //--------------- Accounts ----------------------
    // Get account id by token
    public function GetAccountIdByToken($token,$type){
        $result = \DB::table('accounts')
                    // ->select('id')
                    ->where('account_type_id',$type)
                    ->where('token',$token)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    //--------------- Transactions ------------------
	// Get booked data by book_date
	public function GetBookedByBookDate($accountId,$date){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.book_date',$date)
                    ->where('t.is_active',1)
                    // ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
	}

    // Get booked date by book_date (like)
    public function GetBookedByBookDateLike($accountId,$date){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->where('t.account_id',$accountId)
                    ->where('t.book_date','like',$date.'%')
                    ->where('t.is_active',1)
                    // ->where('tt.is_cancel',0)
                    ->where('tt.is_active',1)
                    ->get();
        return $result;
    }

    //--------------- Transaction tour --------------
    // Get booked by tour id
    public function GetBookedByTourId($accountId,$tourId){
        $result = \DB::table('transaction_tours as tt')
                ->join('transactions as t','t.id','=','tt.transaction_id')
                ->where('t.account_id',$accountId)
                ->where('tt.tour_id',$tourId)
                ->where('t.is_active',1)
                ->where('tt.is_active',1)
                ->get();
        return $result;
    }

    // Get booked [this month] by tour id
    public function GetBookedThisMonth($accountId,$tourId,$dateNow){
        $result = \DB::table('transaction_tours as tt')
                ->join('transactions as t','t.id','=','tt.transaction_id')
                ->where('t.account_id',$accountId)
                ->where('tt.tour_id',$tourId)
                ->where('t.book_date','like',$dateNow.'%')
                ->where('t.is_active',1)
                ->where('tt.is_active',1)
                ->get();
        return $result;
    }

    // Get booked [this year] by tour id
    public function GetBookedThisYear($accountId,$tourId,$dateNow){
        $result = \DB::table('transaction_tours as tt')
                ->join('transactions as t','t.id','=','tt.transaction_id')
                ->where('t.account_id',$accountId)
                ->where('tt.tour_id',$tourId)
                ->where('t.book_date','like',$dateNow.'%')
                ->where('t.is_active',1)
                ->where('tt.is_active',1)
                ->get();
        return $result;
    }

    //--------------- Tours -------------------------
    public function GetTour(){
        $result = \DB::table('tours')
                    ->where('is_active',1)
                    ->get();
        return $result;
    }
}