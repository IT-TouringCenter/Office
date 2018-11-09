<?php
namespace App\Facades\Dashboard\Affiliate\Traveled;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledRepository as DashboardAffiliateTraveledRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateTraveledClass{

	public function __construct(DashboardAffiliateTraveledRepo $DashboardAffiliateTraveledRepo){
        $this->DashboardAffiliateTraveledRepo = $DashboardAffiliateTraveledRepo;
    }

    // 1. Set data traveled
    public function AffiliateDashboardTraveled($request){
        // get account id
        $token = array_get($request,'token');
        $getAccount = $this->DashboardAffiliateTraveledRepo->GetAccountByToken($token);
        $accountId = $getAccount[0]->id;

        // get tour
        $tourArr = [];
        $getTour = $this->DashboardAffiliateTraveledRepo->GetTour();
        foreach($getTour as $value){
            $tour = new Transaction;
            $tour->id = $value->id;
            $tour->code = $value->code;
            $tour->title = $value->title;
            array_push($tourArr,$tour);
        }

        // get tour traveled
        $bookedArr = [];
        $getTourTraveled = $this->TourTraveled($accountId,$tourArr);
        array_push($bookedArr,$getTourTraveled);

        // amount
        $amount = 0;
        foreach($bookedArr as $val){
            $amount = $val->total;
        }

        $data = new Transaction;
        $data->tours = $tourArr;
        $data->booked = $bookedArr;
        $data->amount = $amount;

        return $data;
    }

    // 2. get tour traveled
    public function TourTraveled($accountId,$tourArr){
        $traveledArr = [];
        $total = 0;

        foreach($tourArr as $value){
            $getTraveled = $this->DashboardAffiliateTraveledRepo->GetTourTraveled($accountId,$value->id);
            array_push($traveledArr,count($getTraveled));
            $total += count($getTraveled);
        }

        $traveled = new Transaction;
        $traveled->data = $traveledArr;
        $traveled->label = "summary";
        $traveled->total = $total;

        return $traveled;
        
    }
}