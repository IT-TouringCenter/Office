<?php
namespace App\Facades\Dashboard\Affiliate\Commission;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionRepository as DashboardAffiliateCommissionRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateCommissionClass{

	public function __construct(DashboardAffiliateCommissionRepo $DashboardAffiliateCommissionRepo){
        $this->DashboardAffiliateCommissionRepo = $DashboardAffiliateCommissionRepo;
    }

    // 1. Set data traveled tour
    public function AffiliateDashboardCommission($request){
        // get account id
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');
        $getAccount = $this->DashboardAffiliateCommissionRepo->GetAccountByToken($token,$accountType);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // set tour
        $this->tour = new Transaction;
        $this->GetTour();

        // set booked
        $this->bookedArr = [];
        $this->SetBooked($accountId,$this->tourIdArr);

        // set amount
        $amount = 0;
        foreach($this->bookedArr as $value){
            $amount = $value->total + $value->bonus;
        }

        $result = new Transaction;
        $result->tours = $this->tour;
        $result->booked = $this->bookedArr;
        $result->amount = $amount;

        return $result;
    }

    // 2. Get tour
    public function GetTour(){
        $tourArr = [];
        $this->tourIdArr = [];
        $getTour = $this->DashboardAffiliateCommissionRepo->GetTour();

        foreach($getTour as $value){
            array_push($this->tourIdArr,$value->id); // set tour id
            array_push($tourArr,$value->code); // set tour code
        }
        $this->tour = $tourArr;
    }

    // 3. Set booked
    public function SetBooked($accountId,$tourIdArr){
        $commissionArr = [];
        $commission = 0;
        $total = 0;
        $this->bonus = 0;
        $amount = 0;

        // get booked
        foreach($tourIdArr as $value){
            $tourId = $value;
            $getBooked = $this->DashboardAffiliateCommissionRepo->GetCommissionByTourId($accountId,$tourId);
            $commission = $this->CalculateCommission($getBooked);

            array_push($commissionArr,$commission);
            $total += $commission;
        }

        $booked = new Transaction;
        $booked->data = $commissionArr;
        $booked->label = "Commission";
        $booked->total = $total;
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