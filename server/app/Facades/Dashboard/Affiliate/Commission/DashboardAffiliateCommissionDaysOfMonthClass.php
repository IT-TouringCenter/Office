<?php
namespace App\Facades\Dashboard\Affiliate\Commission;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionRepository as DashboardAffiliateCommissionRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateCommissionDaysOfMonthClass{

	public function __construct(DashboardAffiliateCommissionRepo $DashboardAffiliateCommissionRepo){
        $this->DashboardAffiliateCommissionRepo = $DashboardAffiliateCommissionRepo;
    }

    // 1. Set data commission days of month
    public function AffiliateDashboardCommissionDaysOfMonth($request){
        // get account id
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');
        $getAccount = $this->DashboardAffiliateCommissionRepo->GetAccountByToken($token,$accountType);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // get date
        $month = array_get($request,'month');
        $year = array_get($request,'year');
        $date = new Transaction;

        // set date
        $indexMonth = \DateFacade::GetIndexByMonth(array_get($request,'month'));
        $numberMonth = str_pad(($indexMonth+1),2,'0',STR_PAD_LEFT);

        $date = new Transaction;
        $date->getMonth = $numberMonth;
        $date->getYear = array_get($request,'year');
        $date->month = \DateFacade::GetMonthByIndex($indexMonth);
        $date->minMonth = \DateFacade::GetMinMonthByIndex($indexMonth);

        // check date
        $arrDays = [];
        $dayInMonth = cal_days_in_month(CAL_GREGORIAN,$date->getMonth,$date->getYear);

        for($i=1;$i<=$dayInMonth;$i++){
            array_push($arrDays,$i);
        }
        
        // get data
        $this->bookedArr = [];
        $this->GetCommissionByDays($accountId,$arrDays,$date);

        // cal amount
        $amount = 0;
        foreach($this->bookedArr as $val){
            $amount += $val->total + $val->bonus;
        }

        $result = new Transaction;
        $result->month = $date->month;
        $result->minMonth = $date->minMonth;
        $result->year = $date->getYear;
        $result->days = $arrDays;
        $result->booked = $this->bookedArr;
        $result->amount = $amount;

        return $result;
    }

    // 2. get commission by day no.
    public function GetCommissionByDays($accountId,$arrDay,$date){
        $monthEn = array_get($date,'month');
        $month = array_get($date,'getMonth');
        $year = array_get($date,'getYear');

        $commissionArr = [];
        $commission = 0;
        $this->total = 0;
        $this->bonus = 0;        
        $amount = 0;

        // get booked
        foreach($arrDay as $value){
            $date = str_pad($value, 2, "0", STR_PAD_LEFT).' '.$monthEn.' '.$year;
            $setDate = date('Y-m-d',strtotime($date));
            $getBooked = $this->DashboardAffiliateCommissionRepo->GetCommissionByDays($accountId,$setDate);
            
            // calculate
            $commission = $this->CalculateCommission($getBooked);

            array_push($commissionArr,$commission);
            $this->total += $commission;
        }

        $booked = new Transaction;
        $booked->data = $commissionArr;
        $booked->label = $monthEn.' '.$year;
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