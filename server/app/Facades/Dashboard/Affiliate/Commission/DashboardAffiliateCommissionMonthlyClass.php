<?php
namespace App\Facades\Dashboard\Affiliate\Commission;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionRepository as DashboardAffiliateCommissionRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateCommissionMonthlyClass{

	public function __construct(DashboardAffiliateCommissionRepo $DashboardAffiliateCommissionRepo){
        $this->DashboardAffiliateCommissionRepo = $DashboardAffiliateCommissionRepo;
    }

    // 1. Set data commission days of month
    public function AffiliateDashboardCommissionMonthly($request){
        // get account id
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');
        $getAccount = $this->DashboardAffiliateCommissionRepo->GetAccountByToken($token,$accountType);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // set date  
        $year = array_get($request,'year');
        $date = new Transaction;
        $date->getYear = array_get($request,'year');
        $arrMonth = \DateFacade::MonthInYear();
        
        // get data
        $this->bookedArr = [];
        $this->GetCommissionByMonth($accountId,$arrMonth,$date);

        // cal amount
        $amount = 0;
        foreach($this->bookedArr as $val){
            $amount += $val->total + $val->bonus;
        }

        $result = new Transaction;
        $result->year = $date->getYear;
        $result->months = $arrMonth;
        $result->booked = $this->bookedArr;
        $result->amount = $amount;

        return $result;
    }

    // 2. get traveled data by day no.


    public function GetCommissionByMonth($accountId,$arrMonth,$date){
        $year = array_get($date,'getYear');

        $commissionArr = [];
        $commission = 0;
        $this->total = 0;
        $this->bonus = 0;        
        $amount = 0;

        // get booked
        foreach($arrMonth as $value){
            $date = $value.' '.$year;
            $setDate = date('Y-m',strtotime($date));
            $getBooked = $this->DashboardAffiliateCommissionRepo->GetCommissionMonthly($accountId,$setDate);
            
            // calculate
            $commission = $this->CalculateCommission($getBooked);

            array_push($commissionArr,$commission);
            $this->total += $commission;
        }

        $booked = new Transaction;
        $booked->data = $commissionArr;
        $booked->label = $year;
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