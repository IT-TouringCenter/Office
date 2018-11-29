<?php
namespace App\Facades\Dashboard\Affiliate\Tours;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Tours\DashboardAffiliateTourRepository as DashboardAffiliateTourRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateTourClass{

	public function __construct(DashboardAffiliateTourRepo $DashboardAffiliateTourRepo){
        $this->DashboardAffiliateTourRepo = $DashboardAffiliateTourRepo;
    }

    // 1. Set data tour
    public function AffiliateDashboardTour($request){
        // get account id
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');
        $getAccount = $this->DashboardAffiliateTourRepo->GetAccountByToken($token,$accountType);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // set tour
        $this->tour = [];
        $this->GetTour();

        // set booked
        $this->bookedArr = [];
        $this->GetBookedByTour($this->tour,$accountId);

        // amount
        $amount = 0;
        foreach($this->bookedArr as $value){
            $amount += $value->total;
        }

        $result = new Transaction;
        $result->tours = $this->tour;
        $result->booked = $this->bookedArr;
        $result->amount = $amount;

        return $result;
    }

    // 2. Set tour
    public function GetTour(){
        $this->getTour = $this->DashboardAffiliateTourRepo->GetTour();
        // array_push($this->tour,$getTour);
        foreach($this->getTour as $value){
            array_push($this->tour,$value->code);
        }
    }

    // 3. Set booked
    public function GetBookedByTour($tour,$accountId){
        $bookedArr = [];
        $total = 0;
        foreach($this->getTour as $value){
            $getBooked = $this->DashboardAffiliateTourRepo->GetBookedByTourId($value->id,$accountId);
            $countBooked = count($getBooked);

            array_push($bookedArr,$countBooked);
            $total += $countBooked;
        }

        $booked = new Transaction;
        $booked->data = $bookedArr;
        $booked->label = "Summary";
        $booked->total = $total;

        array_push($this->bookedArr,$booked);
    }

}