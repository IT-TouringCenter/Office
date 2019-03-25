<?php
namespace App\Facades\Dashboard\Manager\Affiliate;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Dashboard\Manager\Affiliate\ManagerAffiliateManagementRepository as ManagerAffiliateManagementRepo;

use App\account as Account;

class ManagerAffiliateManagementClass{

	public function __construct(ManagerAffiliateManagementRepo $ManagerAffiliateManagementRepo){
    $this->ManagerAffiliateManagementRepo = $ManagerAffiliateManagementRepo;
    $this->accountType = 5; // Manager
    $this->affiliate = "Affiliate";
    $this->affiliateIntern = "Affiliate intern";
	}

  // Affiliate management
  public function AffiliateManagement($data){
    $this->affiliateArr = [];
    $returnData = new Account;
    $token = array_get($data,'token');

    // Check account by token
    $checkAccount = $this->ManagerAffiliateManagementRepo->GetAccountByToken($token, $this->accountType);
    if(empty($checkAccount)){
      $returnData->status = false;
      $returnData->message = 'Get account error!';
      $returnData->data = $this->affiliateArr;
      return $returnData;
    }

    $accountId = $checkAccount[0]->id;

    // Get affiliate data
    $getAffiliateData = $this->ManagerAffiliateManagementRepo->GetAffiliateData($this->affiliate);
    if(empty($getAffiliateData)){
      $returnData->status = false;
      $returnData->message = 'Get affiliate error!';
      $returnData->data = $this->affiliateArr;
    }

    // Get affiliate intern data
    $getAffiliateInternData = $this->ManagerAffiliateManagementRepo->GetAffiliateData($this->affiliateIntern);
    if(empty($getAffiliateInternData)){
      $returnData->status = false;
      $returnData->message = 'Get affiliate intern error!';
      $returnData->data = $this->affiliateArr;
    }

    // Set data return
    $this->SetAffiliateData($getAffiliateData);
    $this->SetAffiliateInternData($getAffiliateInternData);

    $returnData->status = true;
    $returnData->message = 'OK';
    $returnData->data = $this->affiliateArr;

    return $returnData;
  }

  // 2. Set affiliate data
  public function SetAffiliateData($data){
    foreach($data as $value){
      $affiliate = new Account;
      $affiliate->id = $value->id;
      $affiliate->token = $value->token;
      $affiliate->username = $value->username;
      $affiliate->fullname = $value->fullname;
      $affiliate->email = $value->email;
      $affiliate->type = $value->type;

      array_push($this->affiliateArr, $affiliate);
    }
    return $this->affiliateArr;
  }

  // 3. Set affiliate intern data
  public function SetAffiliateInternData($data){
    foreach($data as $value){
      $affiliate = new Account;
      $affiliate->id = $value->id;
      $affiliate->token = $value->token;
      $affiliate->username = $value->username;
      $affiliate->fullname = $value->fullname;
      $affiliate->email = $value->email;
      $affiliate->type = $value->type;

      array_push($this->affiliateArr, $affiliate);
    }
    return $this->affiliateArr;
  }

}