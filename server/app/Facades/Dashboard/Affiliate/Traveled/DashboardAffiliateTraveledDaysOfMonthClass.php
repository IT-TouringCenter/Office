<?php
namespace App\Facades\Dashboard\Affiliate\Traveled;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledRepository as DashboardAffiliateTraveledRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateTraveledDaysOfMonthClass{

	public function __construct(DashboardAffiliateTraveledRepo $DashboardAffiliateTraveledRepo){
        $this->DashboardAffiliateTraveledRepo = $DashboardAffiliateTraveledRepo;
    }

    // 1. Set data traveled days of month
    public function AffiliateDashboardTraveledDaysOfMonth($request){
        // get account id
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');
        $getAccount = $this->DashboardAffiliateTraveledRepo->GetAccountByToken($token,$accountType);
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
        $bookedData = [];
        $this->res = new Transaction;

        // check type
        $getAccountType = $getAccount[0]->account_type_id;
        if($getAccountType==5){
            $this->GetAllTraveledByDays($arrDays,$date);
        }else{
            $this->GetTraveledByDays($accountId,$arrDays,$date);
        }
        array_push($bookedData, $this->res);

        // cal amount
        $amount = 0;
        foreach($bookedData as $val){
            $amount += $val->total;
        }

        $result = new Transaction;
        $result->month = $date->month;
        $result->minMonth = $date->minMonth;
        $result->year = $date->getYear;
        $result->days = $arrDays;
        $result->booked = $bookedData;
        $result->amount = $amount;

        return $result;
    }

    // 2. get traveled data by day no.
    public function GetTraveledByDays($accountId,$arrDay,$date){
        $result = [];
        $count = 0;
        $sum = 0;
        $monthEn = array_get($date,'month');
        $month = array_get($date,'getMonth');
        $year = array_get($date,'getYear');

        // get data from DB
        foreach($arrDay as $value){
            $date = str_pad($value, 2, "0", STR_PAD_LEFT).' '.$monthEn.' '.$year;
            $getBookData = $this->DashboardAffiliateTraveledRepo->GetTraveledByDays($accountId,$date);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
        }

        $this->res->data = $result;
        $this->res->label = $monthEn.' '.$year;
        $this->res->total = $sum;
        // return $result;
    }

    // 3. get all traveled data by day no. (manager)
    public function GetAllTraveledByDays($arrDay,$date){
        $result = [];
        $count = 0;
        $sum = 0;
        $monthEn = array_get($date,'month');
        $month = array_get($date,'getMonth');
        $year = array_get($date,'getYear');

        // get data from DB
        foreach($arrDay as $value){
            $date = str_pad($value, 2, "0", STR_PAD_LEFT).' '.$monthEn.' '.$year;
            $getBookData = $this->DashboardAffiliateTraveledRepo->GetAllTraveledByDays($date);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
        }

        $this->res->data = $result;
        $this->res->label = $monthEn.' '.$year;
        $this->res->total = $sum;
        // return $result;
    }
}