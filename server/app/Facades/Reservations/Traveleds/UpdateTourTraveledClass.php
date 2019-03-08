<?php
namespace App\Facades\Reservations\Traveleds;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Reservations\Traveleds\TourTraveledRepository as TourTraveledRepo;

// import model
use App\transaction as Transaction;

class UpdateTourTraveledClass{

  public function __construct(TourTraveledRepo $TourTraveledRepo){
    $this->TourTraveledRepo = $TourTraveledRepo;
  }

  // 1. Update tour traveled
  public function UpdateTourTraveled($data){
    // set data
    $transactionTourId = array_get($data,'transactionTourId');
    $isTraveled = array_get($data,'isTraveled');
    $updateBy = array_get($data,'updateBy');

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

  // 2. Get account type
  public function GetAccountType($accountId){
    $accountType = $this->TourTraveledRepo->GetAccountTypeById($accountId);
    return $accountType;
  }

  // 3. Set commission
  public function SetAffiliateCommission($transactionTourId,$updateBy){
    $result = \AffiliateCommissionFacade::SetAffiliateCommission($transactionTourId,$updateBy);
    return $result;
  }
}