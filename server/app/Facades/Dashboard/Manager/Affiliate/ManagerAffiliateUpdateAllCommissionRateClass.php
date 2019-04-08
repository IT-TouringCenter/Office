<?php
namespace App\Facades\Dashboard\Manager\Affiliate;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Dashboard\Manager\Affiliate\ManagerAffiliateUpdateAllCommissionRateRepository as ManagerAffiliateUpdateAllCommissionRateRepo;

use App\account as Account;

class ManagerAffiliateUpdateAllCommissionRateClass{

	public function __construct(ManagerAffiliateUpdateAllCommissionRateRepo $ManagerAffiliateUpdateAllCommissionRateRepo){
    $this->ManagerAffiliateUpdateAllCommissionRateRepo = $ManagerAffiliateUpdateAllCommissionRateRepo;
    $this->accountType = 5; // Manager
	}

  // Update affiliate commission rate
  public function AffiliateUpdateAllCommissionRate($data){
    $this->affiliateArr = [];
    $returnData = new Account;
    $token = array_get($data,'token');
    $userType = array_get($data,'userType');
    $commissionRate = array_get($data,'commissionRate');

    // Check account by token
    $checkAccount = $this->ManagerAffiliateUpdateAllCommissionRateRepo->GetAccountByToken($token, $this->accountType);
    if(empty($checkAccount)){
      $returnData->status = false;
      $returnData->message = 'Get account error!';
      $returnData->data = $this->affiliateArr;
      return $returnData;
    }

    // Get affiliate type data
    $getAffiliateData = $this->ManagerAffiliateUpdateAllCommissionRateRepo->GetAffiliateByType($userType);
    if(empty($getAffiliateData)){
      $returnData->status = false;
      $returnData->message = 'Get affiliate error!';
      $returnData->data = $this->affiliateArr;
      return $returnData;
    }

    // update commission rate
    foreach($getAffiliateData as $value){
      $accountId = $value->id;      
      $updateCommissionRate = $this->UpdateCommissionRate($accountId, $commissionRate);
    }

    $returnData->status = true;
    $returnData->message = 'OK';
    $returnData->data = $this->affiliateArr;

    return $returnData;
  }

  // Update commission rate
  public function UpdateCommissionRate($accountId, $data){
    $count = 0;
    foreach($data as $value){
      // set data
      $tourId = array_get($value,'tour');
      $dataUpdate = [
        "price_rate"=>array_get($value,'rate')
      ];   
      $updateCommissionRate = $this->ManagerAffiliateUpdateAllCommissionRateRepo->UpdateCommissionRate($accountId, $tourId, $dataUpdate);
      // if($updateCommissionRate){
      //   $count++;
      // }
    }
    // return $count;

  }

}