<?php
namespace App\Facades\Dashboard\Affiliate\Booked;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Booked\DashboardAffiliateBookedRepository as DashboardAffiliateBookedRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateBookedSummaryClass{

	public function __construct(DashboardAffiliateBookedRepo $DashboardAffiliateBookedRepo){
        $this->DashboardAffiliateBookedRepo = $DashboardAffiliateBookedRepo;
    }

    // 1. Set data booked summary
    public function AffiliateDashboardBookedSummary($request){
        $tourArr = [];
        $bookedArr = [];
        $amount = 0;
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');

        // get account id by token
        $getAccount = $this->DashboardAffiliateBookedRepo->GetAccountIdByToken($token,$accountType);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // get tour
        $tourData = $this->DashboardAffiliateBookedRepo->GetTour();
        foreach($tourData as $valTour){
            array_push($tourArr,$valTour->code);
        }

        // check account type
        $accountType = $getAccount[0]->account_type_id;
        if($accountType==5){ // type 5 = manager
            // get all booked
            $getBooked = $this->GetAllBookedSummary($tourData);
        }else{
            // get booked
            $getBooked = $this->GetBookedSummary($accountId,$tourData);
        }

        array_push($bookedArr,$getBooked);

        foreach($bookedArr as $valSum){
            $amount += $valSum->total;
        }

        // return
        $bookedData = new Transaction;
        $bookedData->tours = $tourArr;
        $bookedData->booked = $bookedArr;
        $bookedData->amount = $amount;

        return $bookedData;
    }

    // 2. Get booked summary
    public function GetBookedSummary($accountId,$tourData){
        $bookedArr = [];
        $total = 0;

        foreach($tourData as $value){
            $getBooked = $this->DashboardAffiliateBookedRepo->GetBookedByTourId($accountId,$value->id);
            $countBooked = count($getBooked);

            array_push($bookedArr,$countBooked);
            $total += $countBooked;
        }

        $booked = new Transaction;
        $booked->data = $bookedArr;
        $booked->label = "Summary";
        $booked->total = $total;

        return $booked;
    }

    // 3. Get all booked summary (manager)
    public function GetAllBookedSummary($tourData){
        $bookedArr = [];
        $total = 0;

        foreach($tourData as $value){
            $getBooked = $this->DashboardAffiliateBookedRepo->GetAllBookedByTourId($value->id);
            $countBooked = count($getBooked);

            array_push($bookedArr,$countBooked);
            $total += $countBooked;
        }

        $booked = new Transaction;
        $booked->data = $bookedArr;
        $booked->label = "Summary";
        $booked->total = $total;

        return $booked;
    }
}