<?php
namespace App\Repositories\Reservations\Traveleds;

use Carbon\Carbon;

class TourTraveledRepository{

	public function __construct(){

	}

    // 1. get transaction tour id by travel date
    public function GetTransactionIdByTravel($dateNow){
        $result = \DB::table('transaction_tours')
                        ->select('id')
                        ->where('travel_date','<',$dateNow)
                        ->where('is_travel','!=',1)
                        ->where('is_cancel',0)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 2. all update is_travel = 1 in transaction_tours
    public function AllUpdateTourTravel($date,$isTravel,$updateBy){
        $update = [
            'is_travel'=>$isTravel,
            'updated_by'=>$updateBy
        ];
        $result = \DB::table('transaction_tours')
                    ->where('travel_date','<',$date)
                    ->where('is_travel',0)
                    ->where('is_cancel',0)
                    ->where('is_active',1)
                    ->update($update);
        return $result;
    }

    // 3. update is_travel = 1 in transaction_tours by id
    public function UpdateTourTravelById($transId,$isTravel,$updateBy){
        $update = [
            'is_travel'=>$isTravel,
            'updated_by'=>$updateBy
        ];
        $result = \DB::table('transaction_tours')
                    ->where('id',$transId)
                    ->where('is_travel',0)
                    ->where('is_cancel',0)
                    ->where('is_active',1)
                    ->update($update);
        return $result;
    }

    // 4. get account_id
    public function GetAccountIdByTransactionTourId($transactionTourId){
        $result = \DB::table('transaction_tours as tt')
                    ->join('transactions as t','t.id','=','tt.transaction_id')
                    ->select('t.account_id')
                    ->where('tt.id',$transactionTourId)
                    ->where('t.is_active',1)
                    ->get();
        return $result[0]->account_id;
    }

    // 5. get account type
    public function GetAccountTypeById($accountId){
        $result = \DB::table('accounts as a')
                    ->join('account_types as at','at.id','=','a.account_type_id')
                    ->select('at.type')
                    ->where('a.id',$accountId)
                    ->where('a.is_active',1)
                    ->get();
        return $result[0]->type;
    }
}