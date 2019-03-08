<?php
namespace App\Facades\Dashboard\Manager\Affiliate;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Dashboard\Manager\Affiliate\ManagerAffiliateManagementDetailRepository as ManagerAffiliateManagementDetailRepo;

use App\account as Account;

class ManagerAffiliateManagementDetailClass{

	public function __construct(ManagerAffiliateManagementDetailRepo $ManagerAffiliateManagementDetailRepo){
    $this->ManagerAffiliateManagementDetailRepo = $ManagerAffiliateManagementDetailRepo;
    $this->accountType = 5; // Manager
	}

  // Get affiliate detail
  public function GetAffiliateDetail($data){
    $this->affiliateArr = [];
    $returnData = new Account;
    $token = array_get($data,'token');
    $userToken = array_get($data,'userToken');

    // Check account by token
    $checkAccount = $this->ManagerAffiliateManagementDetailRepo->GetAccountByToken($token, $this->accountType);
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