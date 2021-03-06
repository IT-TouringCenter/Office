<?php
namespace App\Facades\Reservations\Traveleds;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Reservations\Traveleds\GetTourTravelingRepository as GetTourTravelingRepo;

// import model
use App\transaction as Transaction;

class GetTourTravelingClass{

  public function __construct(GetTourTravelingRepo $GetTourTravelingRepo){
    $this->GetTourTravelingRepo = $GetTourTravelingRepo;
    $this->accountTypeId = 7; // reservations
    $this->dateNow = Carbon::now('Asia/Bangkok');
  }

  // 
  public function GetTourTraveling($data){
    $accountType = array_get($data,'type'); // 5 = manager
    $token = array_get($data,'token');
    $traveled = new Transaction;

    // check account
    $checkAccount = $this->GetTourTravelingRepo->GetAccountByToken($token, $accountType);
    if(empty($checkAccount)){
      $traveled->status = false;
      $traveled->message = 'Account empty';
      $traveled->data = [];

      return $traveled;
    }

    // get traveled data
    $getBookingTourUnique = $this->GetTourTravelingRepo->GetBookingTourUnique($this->dateNow);

    if(empty($getBookingTourUnique)){
      $traveled->status = false;
      $traveled->message = 'Booking empty';
      $traveled->data = [];

      return $traveled;
    }

    // get for set traveled data
    $traveledArr = [];

    // get unique
    foreach($getBookingTourUnique as $value){
      $travelTour = new Transaction;
      $getBookingTour = $this->GetTourTravelingRepo->GetBookingTour($value->tour_code, $value->travel_date);

      if(empty($getBookingTour)){
        $traveled->status = false;
        $traveled->message = 'Set data error';
        $traveled->data = [];

        return $traveled;
      }

      // count pax & sum book
      $pax = 0;
      $adultPax = 0;
      $childPax = 0;

      $infantPax = 0;

      foreach($getBookingTour as $val){
        $pax += $val->pax;
        $adultPax += $val->adult_pax;
        $childPax += $val->child_pax;
        $infantPax += $val->infant_pax;
      }

      $travelTour->code = $value->tour_code;
      $travelTour->title = $value->tour_title;
      $travelTour->privacy = $value->tour_privacy;
      $travelTour->travelTime = $value->tour_travel_time;
      $travelTour->travelDate = $value->tour_travel_date;
      $travelTour->tourDate = $value->travel_date;
      $travelTour->pax = $pax;
      $travelTour->adultPax = $adultPax;
      $travelTour->childPax = $childPax;
      $travelTour->infantPax = $infantPax;

      array_push($traveledArr, $travelTour);
    }

    $traveled->status = true;
    $traveled->message = 'OK';
    $traveled->data = $traveledArr;

    return $traveled;
  }

}