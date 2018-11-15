<?php
namespace App\Facades\Dashboard\Affiliate\Home;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Home\DashboardAffiliateRepository as DashboardAffiliateRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateCommissionClass{

	public function __construct(DashboardAffiliateRepo $DashboardAffiliateRepo){
        $this->DashboardAffiliateRepo = $DashboardAffiliateRepo;
    }

    // 1. Set data booked summary
    public function AffiliateDashboardCommission($request){
        // Get account id
        $token = array_get($request,'token');
        $getAccount = $this->DashboardAffiliateRepo->GetAccountByToken($token);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // Get month
        $month = \DateFacade::MinMonthInYear();
        $fullMonth = \DateFacade::MonthInYear();

        // Get commission
        $this->commission = [];
        $this->GetCommission($accountId,$fullMonth);

        // data return
        $data = new Transaction;
        $data->month = $month;
        $data->commission = $this->commission;

        // amount
        $amount = 0;
        foreach($this->commission as $value){
            $amount += $value->total;
        }
        $data->amount = $amount;

        return $data;
    }

    // 2. Get commission
    public function GetCommission($accountId,$month){
        $commissionArr = [];
        $total = 0;

        foreach($month as $value){
            $_month = date('m',strtotime($value));
            $getCommission = $this->DashboardAffiliateRepo->GetCommissionByMonth($accountId,$_month);
            $commission = 0;

            foreach($getCommission as $val){
                $commission += $val->commission_adult;
            }
            
            array_push($commissionArr,$commission);
            $total += $commission;
        }

        $booked = new Transaction;
        $booked->data = $commissionArr;
        $booked->label = "Booked";
        $booked->total = $total;

        array_push($this->commission,$booked);
    }

}