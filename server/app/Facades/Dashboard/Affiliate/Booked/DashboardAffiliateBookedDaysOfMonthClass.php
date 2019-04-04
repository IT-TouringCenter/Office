<?php
namespace App\Facades\Dashboard\Affiliate\Booked;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Booked\DashboardAffiliateBookedRepository as DashboardAffiliateBookedRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateBookedDaysOfMonthClass{

	public function __construct(DashboardAffiliateBookedRepo $DashboardAffiliateBookedRepo){
        $this->DashboardAffiliateBookedRepo = $DashboardAffiliateBookedRepo;
    }

    // 1. Set data booked days of month
    public function AffiliateDashboardBookedDaysOfMonth($request){
        $bookedData = [];
        $arrDays = [];
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');

        // get account id by token
        $getAccount = $this->DashboardAffiliateBookedRepo->GetAccountIdByToken($token,$accountType);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // set date
        $indexMonth = \DateFacade::GetIndexByMonth(array_get($request,'month'));
        $numberMonth = str_pad(($indexMonth+1),2,'0',STR_PAD_LEFT);

        $date = new Transaction;
        $date->getMonth = $numberMonth;
        $date->getYear = array_get($request,'year');
        $date->month = \DateFacade::GetMonthByIndex($indexMonth);
        $date->minMonth = \DateFacade::GetMinMonthByIndex($indexMonth);

        // check date
        $dayInMonth = cal_days_in_month(CAL_GREGORIAN,$date->getMonth,$date->getYear);

        for($i=1;$i<=$dayInMonth;$i++){
            array_push($arrDays,$i);
        }

        // check type
        $getAccountType = $getAccount[0]->account_type_id;
        
        // get data
        $this->res = new Transaction;
        if($getAccountType==5){ // manager
            $this->GetAllBookedDataByDays($arrDays,$date);    
        }else{
            $this->GetBookedDataByDays($accountId,$arrDays,$date);
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

    // 2. get booked data by day no.
    public function GetBookedDataByDays($accountId,$arrDay,$date){
        $result = [];
        $count = 10;
        $sum = 0;
        $monthEn = array_get($date,'month');
        $month = array_get($date,'getMonth');
        $year = array_get($date,'getYear');

        // get data from DB
        foreach($arrDay as $value){
            $date = $year.'-'.$month.'-'.str_pad(($value),2,'0',STR_PAD_LEFT);
            $getBookData = $this->DashboardAffiliateBookedRepo->GetBookedByBookDate($accountId,$date);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
        }

        $this->res->data = $result;
        $this->res->label = $monthEn.' '.$year;
        $this->res->total = $sum;
        // return $result;
    }

    // 2. get all booked data by day no. (manager)
    public function GetAllBookedDataByDays($arrDay,$date){
        $result = [];
        $count = 10;
        $sum = 0;
        $monthEn = array_get($date,'month');
        $month = array_get($date,'getMonth');
        $year = array_get($date,'getYear');

        // get data from DB
        foreach($arrDay as $value){
            $date = $year.'-'.$month.'-'.str_pad(($value),2,'0',STR_PAD_LEFT);
            $getBookData = $this->DashboardAffiliateBookedRepo->GetAllBookedByBookDate($date);
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