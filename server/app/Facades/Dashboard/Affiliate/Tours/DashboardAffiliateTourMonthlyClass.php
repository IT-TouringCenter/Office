<?php
namespace App\Facades\Dashboard\Affiliate\Tours;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Tours\DashboardAffiliateTourRepository as DashboardAffiliateTourRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateTourMonthlyClass{

	public function __construct(DashboardAffiliateTourRepo $DashboardAffiliateTourRepo){
        $this->DashboardAffiliateTourRepo = $DashboardAffiliateTourRepo;
    }

    // 1. Set data tour days of month
    public function AffiliateDashboardTourMonthly($request){
        // get account id
        $token = array_get($request,'token');
        $getAccount = $this->DashboardAffiliateTourRepo->GetAccountByToken($token);
        $accountId = $getAccount[0]->id;

        // get date
        $year = array_get($request,'year');
        $date = new Transaction;

        // set date
        $date = new Transaction;
        $date->getYear = date('Y',strtotime(array_get($request,'year')));

        // check date
        $month = \DateFacade::MonthInYear();
        $arrMonths = [];
        $monthInYear = 12;

        for($i=1;$i<=$monthInYear;$i++){
            array_push($arrMonths,$i);
        }
        
        // get booked
        $tourId = array_get($request,'tourId');
        $this->bookedData = [];
        $this->GetTourBookedByMonth($accountId,$arrMonths,$date,$tourId);
        $this->GetTourTraveledByMonth($accountId,$arrMonths,$date,$tourId);

        // cal amount
        $amount = 0;
        foreach($this->bookedData as $val){
            $amount += $val->total;
        }

        $result = new Transaction;
        $result->year = $date->getYear;
        $result->months = $month;
        $result->booked = $this->bookedData;
        $result->amount = $amount;

        return $result;
    }

    // 2. get tour booked
    public function GetTourBookedByMonth($accountId,$arrMonth,$date,$tourId){
        $result = [];
        $count = 10;
        $sum = 0;
        $year = array_get($date,'getYear');

        // get data from DB
        foreach($arrMonth as $value){
            $_date = $year.'-'.$value;
            $setDate = date('Y-m',strtotime($_date));
            $getBookData = $this->DashboardAffiliateTourRepo->GetTourBookedByMonth($accountId,$setDate,$tourId);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
        }

        $res = new Transaction;
        $res->data = $result;
        $res->label = 'Booked : '.$year;
        $res->total = $sum;

        array_push($this->bookedData,$res);
    }

    // 3. get tour traveled
    public function GetTourTraveledByMonth($accountId,$arrMonth,$date,$tourId){
        $result = [];
        $count = 10;
        $sum = 0;
        $year = array_get($date,'getYear');

        // get data from DB
        $index = 0;
        foreach($arrMonth as $value){
            $getMonth = \DateFacade::GetMonthByIndex($index);
            $_date = $getMonth.' '.$year;
            $getBookData = $this->DashboardAffiliateTourRepo->GetTourTraveledByMonth($accountId,$_date,$tourId);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
            $index++;
        }

        $res = new Transaction;
        $res->data = $result;
        $res->label = 'Traveled : '.$year;
        $res->total = $sum;
        
        array_push($this->bookedData,$res);
    }
}