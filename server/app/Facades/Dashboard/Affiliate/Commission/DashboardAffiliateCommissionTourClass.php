<?php
namespace App\Facades\Dashboard\Affiliate\Commission;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionRepository as DashboardAffiliateCommissionRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateCommissionTourClass{

	public function __construct(DashboardAffiliateCommissionRepo $DashboardAffiliateCommissionRepo){
        $this->DashboardAffiliateCommissionRepo = $DashboardAffiliateCommissionRepo;
    }

    // 1. Set data commission days of month
    public function AffiliateDashboardCommissionTour($request){
        // get account id
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');
        $getAccount = $this->DashboardAffiliateCommissionRepo->GetAccountByToken($token,$accountType);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // get tour
        $this->tourArr = [];
        $this->GetTour();

        // get data
        $this->bookedArr = [];
        $this->GetCommissionByTour($accountId,$this->getTour);

        // cal amount
        $amount = 0;
        foreach($this->bookedArr as $val){
            $amount += $val->total + $val->bonus;
        }

        $result = new Transaction;
        $result->tours = $this->tourArr;
        $result->booked = $this->bookedArr;
        $result->amount = $amount;

        return $result;
    }

    // 2. get tour
    public function GetTour(){
        $this->getTour = $this->DashboardAffiliateCommissionRepo->GetTour();
        foreach($this->getTour as $value){
            $tour = new Transaction;
            $tour->code = $value->code;
            $tour->title = $value->title;

            array_push($this->tourArr,$tour);
        }
    }

    // 3. get traveled data by day no.
    public function GetCommissionByTour($accountId,$tourArr){
        $commissionArr = [];
        $commission = 0;
        $this->total = 0;
        $this->bonus = 0;        
        $amount = 0;

        // get booked
        foreach($tourArr as $value){
            $getBooked = $this->DashboardAffiliateCommissionRepo->GetCommissionByTourId($accountId,$value->id);

            // calculate
            $commission = $this->CalculateCommission($getBooked);

            array_push($commissionArr,$commission);
            $this->total += $commission;
        }

        $booked = new Transaction;
        $booked->data = $commissionArr;
        $booked->label = "Tour commission";
        $booked->total = $this->total;
        $booked->bonus = $this->bonus;

        array_push($this->bookedArr,$booked);
    }

    // 3.1 Calculate commission
    public function CalculateCommission($getBooked){
        $commission = 0;
        foreach($getBooked as $value){
            $commission += $value->commission_total;
            $this->bonus += $value->commission_bonus;
        }
        return $commission;
    }
}