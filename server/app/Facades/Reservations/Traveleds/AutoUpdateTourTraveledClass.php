<?php
namespace App\Facades\Reservations\Traveleds;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Reservations\Traveleds\TourTraveledRepository as TourTraveledRepo;

// import model
use App\transaction as Transaction;

class AutoUpdateTourTraveledClass{

	public function __construct(TourTraveledRepo $TourTraveledRepo){
        $this->TourTraveledRepo = $TourTraveledRepo;
    }

    // 1. Auto update tour traveled
    public function AutoUpdateTourTraveled($data){
        $isTraveled = array_get($data,'isTraveled');
        $updateBy = array_get($data,'updateBy');

        // set date
        $dateNow = Carbon::now('Asia/Bangkok');
        $date = date('Y-m-d',strtotime($dateNow));
        
        // get transaction id
        $getTransactionId = $this->TourTraveledRepo->GetTransactionIdByTravel($date);
        $count = 1;

        foreach($getTransactionId as $value){
            $update = $this->UpdateTourTraveled($value->id,$isTraveled,$updateBy);
            $count++;
        }
        return $count;
    }


    // 2. Update tour traveled
	public function UpdateTourTraveled($transactionTourId,$isTraveled,$updateBy){
        // update tour travel
        $updateTransactionTour = $this->TourTraveledRepo->UpdateTourTravelById($transactionTourId,$isTraveled,$updateBy);

        // set commission
        if(empty($updateTransactionTour) || $updateTransactionTour==''){
            return 'null';
        }

        // get account_id
        $accountId = $this->TourTraveledRepo->GetAccountIdByTransactionTourId($transactionTourId);
        if($accountId!=0){
            // get account type
            $accountType = $this->GetAccountType($accountId);
        }else{
            return 'complete';
        }

        // commission rate
        if($accountType=='Affiliate'){
            return $this->SetAffiliateCommission($transactionTourId,$updateBy);
        }else{
            return 'null';
        }
    }

    // 3. Get account type
    public function GetAccountType($accountId){
        $accountType = $this->TourTraveledRepo->GetAccountTypeById($accountId);
        return $accountType;
    }

    // 4. Set commission
    public function SetAffiliateCommission($transactionTourId,$updateBy){
        $result = \AffiliateCommissionFacade::SetAffiliateCommission($transactionTourId,$updateBy);
        return $result;
    }
}