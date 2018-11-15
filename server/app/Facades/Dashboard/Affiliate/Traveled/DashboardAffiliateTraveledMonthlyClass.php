<?php
namespace App\Facades\Dashboard\Affiliate\Traveled;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledRepository as DashboardAffiliateTraveledRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateTraveledMonthlyClass{

	public function __construct(DashboardAffiliateTraveledRepo $DashboardAffiliateTraveledRepo){
        $this->DashboardAffiliateTraveledRepo = $DashboardAffiliateTraveledRepo;
    }

    // 1. Set data traveled monthly
    public function AffiliateDashboardTraveledMonthly($request){
        // get account id
        $token = array_get($request,'token');
        $getAccount = $this->DashboardAffiliateTraveledRepo->GetAccountByToken($token);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // get date
        $year = array_get($request,'year');
        $date = new Transaction;

        // set date
        $date = new Transaction;
        $date->getYear = array_get($request,'year');

        // check date
        $arrMonth = [];
        $monthInYear = 12;

        for($i=1;$i<=$monthInYear;$i++){
            array_push($arrMonth,$i);
        }
        
        // get data
        $bookedData = [];
        $this->res = new Transaction;
        $this->GetTraveledByDays($accountId,$arrMonth,$date);
        array_push($bookedData, $this->res);

        // cal amount
        $amount = 0;
        foreach($bookedData as $val){
            $amount += $val->total;
        }

        $result = new Transaction;
        $result->year = $date->getYear;
        $result->months = $arrMonth;
        $result->booked = $bookedData;
        $result->amount = $amount;

        return $result;
    }

    // 2. get traveled data by day no.
    public function GetTraveledByDays($accountId,$arrMonth,$date){
        $result = [];
        $count = 10;
        $sum = 0;
        $year = array_get($date,'getYear');

        // get data from DB
        $index = 0;
        foreach($arrMonth as $value){
            $getMonth = \DateFacade::GetMonthByIndex($index);

            $dateFormat = $getMonth.' '.$year;
            $getBookData = $this->DashboardAffiliateTraveledRepo->GetTraveledByMonth($accountId,$dateFormat);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
            $index++;
        }

        $this->res->data = $result;
        $this->res->label = $year;
        $this->res->total = $sum;
    }
}