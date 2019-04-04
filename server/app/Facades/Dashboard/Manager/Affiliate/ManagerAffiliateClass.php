<?php
namespace App\Facades\Dashboard\Manager\Affiliate;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Dashboard\Manager\Affiliate\ManagerAffiliateRepository as ManagerAffiliateRepo;

use App\account as Account;

class ManagerAffiliateClass{

	public function __construct(ManagerAffiliateRepo $ManagerAffiliateRepo){
    $this->ManagerAffiliateRepo = $ManagerAffiliateRepo;
    $this->accountType = 5; // Manager
  }
  
  //
  public function GetAffiliateAccount($data){
    // get data
    $token = array_get($data,'token');
    $affiliate = new Account;
    $affiliateArr = [];
    $typeAffiliate = 'Affiliate';
    $typeAffiliateIntern = 'Affiliate intern';

    // get account
    $getAccount = $this->ManagerAffiliateRepo->GetAccountByToken($token, $this->accountType);
    if(empty($getAccount)){
      $affiliate->status = false;
      $affiliate->massage = 'Get account error';
      $affiliate->data = [];

      return $affiliate;
    }

    // get affiliate account : type affiliate
    $getAffiliateAccount = $this->ManagerAffiliateRepo->GetAffiliateAccount($typeAffiliate);
    if($getAffiliateAccount){
      foreach($getAffiliateAccount as $value){
        $affAccount = new Account;
        $affAccount->fullname = $value->fullname;
        $affAccount->type = $value->typeId;
        $affAccount->token = $value->token;

        array_push($affiliateArr, $affAccount);
      }
    }

    // get affiliate account : type affiliate intern
    $getAffiliateIntern = $this->ManagerAffiliateRepo->GetAffiliateAccount($typeAffiliateIntern);
    if($getAffiliateIntern){
      foreach($getAffiliateIntern as $val){
        $affIntern = new Account;
        $affIntern->fullname = $val->fullname;
        $affIntern->type = $val->typeId;
        $affIntern->token = $val->token;

        array_push($affiliateArr, $affIntern);
      }
    }

    // set data return
    if(count($affiliateArr) < 1){
      $affiliate->status = false;
      $affiliate->message = 'Affiliate empty';
      $affiliate->data = [];
    }else{
      $affiliate->status = true;
      $affiliate->message = 'OK';
      $affiliate->data = $affiliateArr;
    }

    return $affiliate;

  }

}