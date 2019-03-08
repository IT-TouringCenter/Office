<?php
namespace App\Facades\Dashboard\Manager\Affiliate;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Dashboard\Manager\Affiliate\ManagerAffiliateUpdateCommissionRateRepository as ManagerAffiliateUpdateCommissionRateRepo;

use App\account as Account;

class ManagerAffiliateUpdateCommissionRateClass{

	public function __construct(ManagerAffiliateUpdateCommissionRateRepo $ManagerAffiliateUpdateCommissionRateRepo){
    $this->ManagerAffiliateUpdateCommissionRateRepo = $ManagerAffiliateUpdateCommissionRateRepo;
    $this->accountType = 5; // Manager
	}

  // Update affiliate commission rate
  public function UpdateAffiliateCommissionRate($data){
    $this->affiliateArr = [];
    $returnData = new Account;
    $token = array_get($data,'token');
    $userToken = array_get($data,'userToken');
    $commissionRate = array_get($data,'commissionRate');

    // Check account by token
    $checkAccount = $this->ManagerAffiliateUpdateCommissionRateRepo->GetAccountByToken($token, $this->accountType);
    if(empty($checkAccount)){
      $returnData->status = false;
      $returnData->message = 'Get account error!';
      $returnData->data = $this->affiliateArr;
      return $returnData;
    }

    $accountId = $checkAccount[0]->id;

    // Get affiliate data
    
    return $accountId;
  }


}