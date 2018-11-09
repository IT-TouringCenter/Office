<?php
namespace App\Facades\Dashboard\Affiliate\Booked;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Booked\DashboardAffiliateBookedRepository as DashboardAffiliateBookedRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateBookedMonthlyClass{

	public function __construct(DashboardAffiliateBookedRepo $DashboardAffiliateBookedRepo){
        $this->DashboardAffiliateBookedRepo = $DashboardAffiliateBookedRepo;
    }

    // 1. Set data booked days of month
    public function AffiliateDashboardBookedMonthly($request){
        $bookedData = [];
        $arrMonth = [];
        $token = array_get($request,'token');

        // get account id by token
        $getAccount = $this->DashboardAffiliateBookedRepo->GetAccountIdByToken($token);
        $accountId = $getAccount[0]->id;

        // set date
        $date = new Transaction;
        $date->getYear = date('Y',strtotime(array_get($request,'year')));

        // check date
        $monthInYear = 12;

        for($i=1;$i<=$monthInYear;$i++){
            $_month = str_pad($i, 2, "0", STR_PAD_LEFT);
            array_push($arrMonth,$_month);
        }

        // get data
        $this->res = new Transaction;
        $this->GetBookedDataByMonth($accountId,$arrMonth,$date);
        array_push($bookedData, $this->res);

        // cal amount
        $amount = 0;
        foreach($bookedData as $val){
            $amount += $val->total;
        }

        $result = new Transaction;
        // $result->month = $date->month;
        // $result->minMonth = $date->minMonth;
        $result->year = $date->getYear;
        $result->month = $arrMonth;
        $result->booked = $bookedData;
        $result->amount = $amount;

        return $result;
    }

    // 2. get booked data by month no.
    public function GetBookedDataByMonth($accountId,$arrMonth,$date){
        $result = [];
        $count = 10;
        $sum = 0;
        // $monthEn = array_get($date,'month');
        // $month = array_get($date,'getMonth');
        $year = array_get($date,'getYear');

        // get data from DB
        foreach($arrMonth as $value){
            $date = $year.'-'.$value;
            $getBookData = $this->DashboardAffiliateBookedRepo->GetBookedByBookDateLike($accountId,$date);
            $countBooked = count($getBookData);

            array_push($result,$countBooked);
            $sum += $countBooked;
        }

        $this->res->data = $result;
        $this->res->label = $year;
        $this->res->total = $sum;
    }
}