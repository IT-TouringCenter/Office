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

    // Get affiliate data
    $checkAffiliate = $this->ManagerAffiliateManagementDetailRepo->GetAffiliateByToken($userToken);
    if(empty($checkAffiliate)){
      $returnData->status = false;
      $returnData->message = 'Get affiliate error!';
      $returnData->data = $this->affiliateArr;
      return $returnData;
    }

    // 
    $accountId = $checkAffiliate[0]->id;
    $affiliate = new Account;
    $affiliateData = new Account;
    $affiliateBank = new Account;

    // Get data
    $getAffiliateData = $this->ManagerAffiliateManagementDetailRepo->GetAffiliateData($accountId);
    if($getAffiliateData){
      $affiliateData->id = $getAffiliateData[0]->id;
      $affiliateData->token = $getAffiliateData[0]->token;
      $affiliateData->fullname = $getAffiliateData[0]->fullname;
      $affiliateData->email = $getAffiliateData[0]->email;
      $affiliateData->tel = $getAffiliateData[0]->tel;
      $affiliateData->birth = \DateFormatFacade::SetFullDate($getAffiliateData[0]->birth);
      $affiliateData->type = $getAffiliateData[0]->type;
      $affiliateData->idNumber = $getAffiliateData[0]->id_number;
      $affiliateData->address = $getAffiliateData[0]->address;
      $affiliateData->nationality = $getAffiliateData[0]->nationality;
      $affiliateData->profilePicture = $getAffiliateData[0]->picture;
      $affiliateData->copyIdCard = $getAffiliateData[0]->copy_id_card;
      $affiliateData->url = $getAffiliateData[0]->url;
    }else{
      $affiliateData->id = '';
      $affiliateData->token = '';
      $affiliateData->fullname = '';
      $affiliateData->email = '';
      $affiliateData->tel = '';
      $affiliateData->birth = '';
      $affiliateData->type = '';
      $affiliateData->idNumber = '';
      $affiliateData->address = '';
      $affiliateData->nationality = '';
      $affiliateData->profilePicture = '';
      $affiliateData->copyIdCard = '';
      $affiliateData->url = '';
    }
    $affiliate->profile = $affiliateData;

    // Get bank
    $getBankData = $this->ManagerAffiliateManagementDetailRepo->GetAffiliateBankData($accountId);
    if($getBankData){
      $affiliateBank->accountName = $getBankData[0]->account_name;
      $affiliateBank->accountNo = $getBankData[0]->account_no;
      $affiliateBank->bank = $getBankData[0]->bank;
      $affiliateBank->branch = $getBankData[0]->branch;
      $affiliateBank->copyBook = $getBankData[0]->copy_book;
    }else{
      $affiliateBank->accountName = '';
      $affiliateBank->accountNo = '';
      $affiliateBank->bank = '';
      $affiliateBank->branch = '';
      $affiliateBank->copyBook = '';
    }
    $affiliate->bank = $affiliateBank;

    array_push($this->affiliateArr,$affiliate);

    // Set data return
    $returnData->status = true;
    $returnData->message = 'OK';
    $returnData->data = $this->affiliateArr[0];

    return $returnData;
  }

}