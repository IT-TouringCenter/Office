<?php
namespace App\Repositories\Reservations\Traveleds;

use Carbon\Carbon;

class UpdateTraveledRepository{

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

  // get id from transaction_tours
  public function GetTransactionTour($data){
    $result = \DB::table('transaction_tours as tt')
                  ->select('tt.id', 'tt.transaction_id', 't.account_id')
                  ->join('transactions as t','t.id','=','tt.transaction_id')
                  ->where('tt.tour_code',array_get($data,'code'))
                  ->where('tt.tour_privacy',array_get($data,'privacy'))
                  ->where('tt.tour_travel_time',array_get($data,'travelTime'))
                  ->where('tt.travel_date',array_get($data,'tourDate'))
                  ->where('tt.is_cancel',0)
                  ->where('tt.is_travel',0)
                  ->where('tt.is_active',1)
                  ->where('t.is_active',1)
                  ->get();
    return $result;
  }
  
  // update tour traveling
  public function UpdateTourTraveling($transactionTourId){
    $update = ['is_travel'=>1];
    $result = \DB::table('transaction_tours')
                  ->where('id',$transactionTourId)
                  ->where('is_active',1)
                  ->update($update);
    return $result;
  }

}