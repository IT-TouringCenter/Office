<?php
namespace App\Facades\Dashboard\Manager\Affiliate;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Dashboard\Manager\Affiliate\ManagerAffiliateManagementCommissionRateRepository as ManagerAffiliateManagementCommissionRateRepo;

use App\account as Account;

class ManagerAffiliateManagementCommissionRateClass{

	public function __construct(ManagerAffiliateManagementCommissionRateRepo $ManagerAffiliateManagementCommissionRateRepo){
    $this->ManagerAffiliateManagementCommissionRateRepo = $ManagerAffiliateManagementCommissionRateRepo;
    $this->accountType = 5; // Manager
	}

  // Get affiliate commission rate
  public function GetAffiliateCommissionRate($data){
    $this->affiliateArr = [];
    $returnData = new Account;
    $token = array_get($data,'token');
    $userToken = array_get($data,'userToken');

    // Check account by token
    $checkAccount = $this->ManagerAffiliateManagementCommissionRateRepo->GetAccountByToken($token, $this->accountType);
    if(empty($checkAccount)){
      $returnData->status = false;
      $returnData->message = 'Get account error!';
      $returnData->data = $this->affiliateArr;
      return $returnData;
    }

    // Get affiliate data
    $checkAffiliate = $this->ManagerAffiliateManagementCommissionRateRepo->GetAffiliateByToken($userToken);
    if(empty($checkAffiliate)){
      $returnData->status = false;
      $returnData->message = 'Get affiliate error!';
      $returnData->data = $this->affiliateArr;
      return $returnData;
    }

    $accountId = $checkAffiliate[0]->id;

    // Get commission rate
    $getCommissionRate = $this->ManagerAffiliateManagementCommissionRateRepo->GetCommissionRate($accountId);
    if(empty($getCommissionRate)){
      $returnData->status = false;
      $returnData->message = 'Get affiliate commission rate error!';
      $returnData->data = $this->affiliateArr;
      return $returnData;
    }

    // Set commission rate
    $commissionRate = $this->SetCommissionRate($getCommissionRate);

    $affiliateData = new Account;
    $affiliateData->token = $checkAffiliate[0]->token;
    $affiliateData->commissionRate = $commissionRate;

    $returnData->status = true;
    $returnData->message = 'OK';
    $returnData->data = $affiliateData;

    return $returnData;
  }

  // Set commission rate
  public function SetCommissionRate($data){
    $rateArr = [];

    foreach($data as $value){
      $rate = new Account;
      $rate->tourId = $value->id;
      $rate->tourCode = $value->code;
      $rate->tourTitle = $value->title;
      $rate->commissionRate = $value->price_rate;

      array_push($rateArr, $rate);
    }

    return $rateArr;
  }

}