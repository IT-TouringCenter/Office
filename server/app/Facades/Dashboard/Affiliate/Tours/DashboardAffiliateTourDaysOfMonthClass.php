<?php
namespace App\Facades\Dashboard\Affiliate\Tours;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Tours\DashboardAffiliateTourRepository as DashboardAffiliateTourRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateTourDaysOfMonthClass{

	public function __construct(DashboardAffiliateTourRepo $DashboardAffiliateTourRepo){
        $this->DashboardAffiliateTourRepo = $DashboardAffiliateTourRepo;
    }

    // 1. Set data tour days of month
    public function AffiliateDashboardTourDaysOfMonth($request){
        // get account id
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');
        $getAccount = $this->DashboardAffiliateTourRepo->GetAccountByToken($token,$accountType);
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
        
        // get booked
        $tourId = array_get($request,'tourId');
        $this->bookedData = [];
        $this->GetTourBookedByDays($accountId,$arrDays,$date,$tourId);
        $this->GetTourTraveledByDays($accountId,$arrDays,$date,$tourId);

        // cal amount
        $amount = 0;
        foreach($this->bookedData as $val){
            $amount += $val->total;
        }

        $result = new Transaction;
        $result->month = $date->month;
        $result->minMonth = $date->minMonth;
        $result->year = $date->getYear;
        $result->days = $arrDays;
        $result->booked = $this->bookedData;
        $result->amount = $amount;

        return $result;
    }

    // 2. get tour booked
    public function GetTourBookedByDays($accountId,$arrDay,$date,$tourId){
        $result = [];
        $count = 10;
        $sum = 0;
        $monthEn = array_get($date,'month');
        $month = array_get($date,'getMonth');
        $year = array_get($date,'getYear');

        // get data from DB
        foreach($arrDay as $value){
            $_date = $year.'-'.$month.'-'.$value;
            $setDate = date('Y-m-d',strtotime($_date));
            $getBookData = $this->DashboardAffiliateTourRepo->GetTourBookedByDays($accountId,$setDate,$tourId);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
        }

        $res = new Transaction;
        $res->data = $result;
        $res->label = 'Booked';
        $res->total = $sum;

        array_push($this->bookedData,$res);
    }

    // 3. get tour traveled
    public function GetTourTraveledByDays($accountId,$arrDay,$date,$tourId){
        $result = [];
        $count = 10;
        $sum = 0;
        $monthEn = array_get($date,'month');
        $month = array_get($date,'getMonth');
        $year = array_get($date,'getYear');

        // get data from DB
        foreach($arrDay as $value){
            $_date = str_pad($value, 2, "0", STR_PAD_LEFT).' '.$monthEn.' '.$year;
            $getBookData = $this->DashboardAffiliateTourRepo->GetTourTraveledByDays($accountId,$_date,$tourId);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
        }

        $res = new Transaction;
        $res->data = $result;
        $res->label = 'Traveled';
        $res->total = $sum;
        
        array_push($this->bookedData,$res);
    }
}