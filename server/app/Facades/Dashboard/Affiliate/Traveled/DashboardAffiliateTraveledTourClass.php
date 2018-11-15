<?php
namespace App\Facades\Dashboard\Affiliate\Traveled;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledRepository as DashboardAffiliateTraveledRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateTraveledTourClass{

	public function __construct(DashboardAffiliateTraveledRepo $DashboardAffiliateTraveledRepo){
        $this->DashboardAffiliateTraveledRepo = $DashboardAffiliateTraveledRepo;
    }

    // 1. Set data traveled tour
    public function AffiliateDashboardTraveledTour($request){
        // get account id
        $token = array_get($request,'token');
        $getAccount = $this->DashboardAffiliateTraveledRepo->GetAccountByToken($token);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // set tour
        $tourId = array_get($request,'tourId');
        $this->tour = new Transaction;
        $this->GetTour($tourId);

        // set year
        $this->yearArr = [];
        $this->SetYear($accountId);
        // return $this->yearArr;
        // set booked
        $this->bookedArr = [];
        $this->SetBooked($accountId,$this->yearArr,$tourId);

        // set amount
        $amount = 0;
        foreach($this->bookedArr as $value){
            $amount = $value->total;
        }

        $result = new Transaction;
        $result->tour = $this->tour;
        $result->years = $this->yearArr;
        $result->booked = $this->bookedArr;
        $result->amount = $amount;

        return $result;
    }

    // 2. Get tour data
    public function GetTour($tourId){
        $getTour = $this->DashboardAffiliateTraveledRepo->GetTourById($tourId);

        $this->tour->code = $getTour[0]->code;
        $this->tour->title = $getTour[0]->title;
    }

    // 3. Set year
    public function SetYear($accountId){
        // Query check from DB
        // $date = Carbon::now('Asia/Bangkok');
        // $yearNow = date('Y',strtotime($date));

        // // check year by traveled
        // $checkYear = $this->DashboardAffiliateTraveledRepo->CheckYearByTravel($accountId);

        // // sub
        // $subArr = [];
        // foreach($checkYear as $value){
        //     $subYear = substr($value->tour_travel_date,-4);
        //     array_push($subArr,$subYear);
        // }

        // // [2017,2018,2019]
        // array_push($this->yearArr,array_unique($subArr));

        $yearStart = 2018;
        $yearNow = date('Y',strtotime(Carbon::now('Asia/Bangkok')));

        $countYear = (intval($yearNow)-$yearStart)+1; // 2019-2018 = 1+1 = 2 year
        for($i=0;$i<$countYear;$i++){
            $setYear = $yearStart+$i;
            array_push($this->yearArr,$setYear);
        }
    }

    // 4. Set booked
    public function SetBooked($accountId,$yearArr,$tourId){
        // set data
        $dataArr = [];
        $total = 0;
        foreach($yearArr as $value){
            $getTour = $this->DashboardAffiliateTraveledRepo->GetTraveledTour($accountId,$value,$tourId);
            $countTour = count($getTour);

            array_push($dataArr,$countTour);
            $total += $countTour;
        }

        $traveled = new Transaction;
        $traveled->data = $dataArr;
        $traveled->label = "Traveled tour";
        $traveled->total = $total;

        array_push($this->bookedArr,$traveled);
    }

}