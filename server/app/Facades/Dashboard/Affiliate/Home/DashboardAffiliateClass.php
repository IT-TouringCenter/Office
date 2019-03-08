<?php
namespace App\Facades\Dashboard\Affiliate\Home;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Affiliate\Home\DashboardAffiliateRepository as DashboardAffiliateRepo;

// import model
use App\transaction as Transaction;

class DashboardAffiliateClass{

	public function __construct(DashboardAffiliateRepo $DashboardAffiliateRepo){
        $this->DashboardAffiliateRepo = $DashboardAffiliateRepo;
    }

    // 1. Set data booked summary
    public function AffiliateDashboard($request){
        // Get account id
        $token = array_get($request,'token');
        $accountType = array_get($request,'type');
        $getAccount = $this->DashboardAffiliateRepo->GetAccountByToken($token,$accountType);
        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            return "null";
        }

        // Check affiliate commission table
        $checkAffiliateCommission = $this->DashboardAffiliateRepo->CheckAffiliateCommission($accountId);
        if(empty($checkAffiliateCommission)){
            // create affiliate_commission record
            $createAffiliateCommission = $this->CreateAffiliateCommissionRecord($accountId);
            if($createAffiliateCommission==false){
                return "null";
            }

        }

        $this->data = new Transaction;
        $this->GetBooked($accountId);
        $this->GetTraveled($accountId);
        $this->GetCommission($accountId);

        return $this->data;
    }

    // 2. Get booked
    public function GetBooked($accountId){
        $getBooked = $this->DashboardAffiliateRepo->GetBooked($accountId);
        $booked = new Transaction;

        if($getBooked){
            $booked->id = 0;
            $booked->amount = count($getBooked);
        }else{
            $booked->id = 0;
            $booked->amount = 0;
        }

        $this->data->booked = $booked;
    }

    // 3. Get traveled
    public function GetTraveled($accountId){
        $getTraveled = $this->DashboardAffiliateRepo->GetTraveled($accountId);
        $traveled = new Transaction;

        if($getTraveled){
            $traveled->id = 0;
            $traveled->amount = count($getTraveled);
        }else{
            $traveled->id = 0;
            $traveled->amount = 0;
        }

        $this->data->traveled = $traveled;
    }

    // 4. Get commission
    public function GetCommission($accountId){
        $getCommission = $this->DashboardAffiliateRepo->GetCommission($accountId);
        $commission = new Transaction;

        if($getCommission){
            $commission->id = 0;
            $commission->amount = $getCommission[0]->commission_amount;    
        }else{
            $commission->id = 0;
            $commission->amount = 0;
        }

        $this->data->commission = $commission;
    }

    // 5. Create affiliate commission record
    public function CreateAffiliateCommissionRecord($accountId){
        $defaultData = [
            'account_id'=>$accountId
        ];

        $createRecord = $this->DashboardAffiliateRepo->CreateAffiliateCommissionRecord($defaultData);
        if($createRecord){
            return true;
        }else{
            return false;
        }
    }

}