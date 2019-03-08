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

    $accountId = $checkAccount[0]->id;

    // Get affiliate data
    
    return $accountId;
  }


}