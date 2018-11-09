<?php
namespace App\Facades\Dashboard\Affiliate\Home;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Home\DashboardAffiliateRepository as DashboardAffiliateRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateBookedClass{

	public function __construct(DashboardAffiliateRepo $DashboardAffiliateRepo){
        $this->DashboardAffiliateRepo = $DashboardAffiliateRepo;
    }

    // 1. Set data booked summary
    public function AffiliateDashboardBooked($request){
        // Get account id
        $token = array_get($request,'token');
        $getAccount = $this->DashboardAffiliateRepo->GetAccountByToken($token);
        $accountId = $getAccount[0]->id;

        // Get month
        $month = \DateFacade::MinMonthInYear();

        // Get booked statistics
        $this->bookedStatistics = [];
        $this->GetBooked($accountId,$month);
        $this->GetTraveled($accountId,$month);
        $this->GetCanceled($accountId,$month);

        // data return
        $data = new Transaction;
        $data->month = $month;
        $data->bookedStatistics = $this->bookedStatistics;

        // amount
        // $amount = 0;
        // foreach($this->bookedStatistics as $value){
        //     $amount += $value->total;
        // }
        // $data->amount = $amount;

        return $data;
    }

    // 2. Get booked
    public function GetBooked($accountId,$month){
        $bookedArr = [];
        $total = 0;

        foreach($month as $value){
            $_month = date('m',strtotime($value));
            $getBooked = $this->DashboardAffiliateRepo->GetBookedByMonth($accountId,$_month);
            $count = count($getBooked);
            
            array_push($bookedArr,count($getBooked));
            $total += $count;
        }

        $booked = new Transaction;
        $booked->data = $bookedArr;
        $booked->label = "Booked";
        $booked->total = $total;

        array_push($this->bookedStatistics,$booked);
    }

    // 3. Get traveled
    public function GetTraveled($accountId,$month){
        $traveledArr = [];
        $total = 0;

        foreach($month as $value){
            $_month = date('F',strtotime($value));
            $getTraveled = $this->DashboardAffiliateRepo->GetTraveledByMonth($accountId,$_month);
            $count = count($getTraveled);
            
            array_push($traveledArr,$count);
            $total += $count;
        }

        $traveled = new Transaction;
        $traveled->data = $traveledArr;
        $traveled->label = "Traveled";
        $traveled->total = $total;

        array_push($this->bookedStatistics,$traveled);
    }

    // 4. Get canceled
    public function GetCanceled($accountId,$month){
        $canceledArr = [];
        $total = 0;

        foreach($month as $value){
            $_month = date('m',strtotime($value));
            $getCanceled = $this->DashboardAffiliateRepo->GetCanceledByMonth($accountId,$_month);
            $count = count($getCanceled);
            
            array_push($canceledArr,$count);
            $total += $count;
        }

        $canceled = new Transaction;
        $canceled->data = $canceledArr;
        $canceled->label = "Canceled";
        $canceled->total = $total;

        array_push($this->bookedStatistics,$canceled);
    }

}