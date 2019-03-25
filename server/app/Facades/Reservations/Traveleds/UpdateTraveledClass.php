<?php
namespace App\Facades\Reservations\Traveleds;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Reservations\Traveleds\UpdateTraveledRepository as UpdateTraveledRepo;

// import model
use App\transaction as Transaction;

class UpdateTraveledClass{

  public function __construct(UpdateTraveledRepo $UpdateTraveledRepo){
    $this->UpdateTraveledRepo = $UpdateTraveledRepo;
    $this->accountTypeId = 7; // reservations
    $this->dateNow = Carbon::now('Asia/Bangkok');
  }

  // 
  public function UpdateTraveled($data){
    // get data
    $token = array_get($data,'token');
    $tourData = array_get($data,'tour');
    $traveled = new Transaction;
    $traveledArr = [];

    // check account
    $checkAccount = $this->UpdateTraveledRepo->GetAccountByToken($token, $this->accountTypeId);
    if(empty($checkAccount)){
      $traveled->status = false;
      $traveled->message = 'Account error';
      $traveled->data = $traveledArr;

      return $traveled;
    }

    // get transaction tour id
    $getTransactionTour = $this->UpdateTraveledRepo->GetTransactionTour($tourData);
    if(empty($getTransactionTour)){
      $traveled->status = false;
      $traveled->message = 'Traveling error';
      $traveled->data = $traveledArr;

      return $traveled;
    }

    // update traveling
    $count = 0;
    $updateBy = $checkAccount[0]->fullname;
    foreach($getTransactionTour as $value){
      $updateTourTraveled = $this->UpdateTraveledRepo->UpdateTourTraveling($value->id);
      if(empty($updateTourTraveled)){
        $traveled->status = false;
        $traveled->message = 'Update traveling error';
        $traveled->data = $traveledArr;

        return $traveled;
      }
      $count += 1;
      array_push($traveledArr, $count);

      // set affiliate commission
      $affiliateCommission = \AffiliateCommissionFacade::SetAffiliateCommission($value->id,$updateBy);
    }

    $traveled->status = true;
    $traveled->message = 'OK';
    $traveled->data = $traveledArr;

    return $traveled;
  }

}