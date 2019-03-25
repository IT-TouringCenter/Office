<?php
namespace App\Facades\Dashboard\Admin\Users\Edit;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\Edit\AdminUserManagementEditRepository as AdminUserManagementEditRepo;

// import model
use App\account as Account;

class AdminUserManagementEditSaveClass{

	public function __construct(AdminUserManagementEditRepo $AdminUserManagementEditRepo){
        $this->AdminUserManagementEditRepo = $AdminUserManagementEditRepo;
    }

    /*
        1. 
    */

    public function AdminUserManagementEditSave($data){
        $token = array_get($data,'userToken');
        $dateNow = Carbon::now('Asia/Bangkok');
        $this->result = new Account;

        // get account id
        $getAccount = $this->AdminUserManagementEditRepo->GetAccountByToken($token);
        if(empty($getAccount)){
            return false;
        }
        $accountId = $getAccount[0]->id;

        // update account table
        $setAccountData = [
            "account_type_id"=>array_get($data,'userType'),
            "fullname"=>array_get($data,'fullname'),
            "email"=>array_get($data,'email'),
            "updated_by"=>array_get($data,'accountName'),
            "updated_at"=>$dateNow
        ];
        $updateAccount = $this->AdminUserManagementEditRepo->UpdateAccountById($accountId,$setAccountData);

        // update account profile table
        if($updateAccount){
            $setAccountProfileData = [
                "fullname"=>array_get($data,'fullname'),
                "updated_by"=>array_get($data,'accountName'),
                "updated_at"=>$dateNow
            ];
            $updateAccountProfile = $this->AdminUserManagementEditRepo->UpdateAccountProfileByAccountId($accountId,$setAccountProfileData);

            // affiliate logic
            if($updateAccountProfile){
                $accountTypeId = array_get($data,'userType');
                $this->CreateAffiliateRecord($accountId, $accountTypeId);
        
                return $this->result;
            }else{
                $this->result->status = false;
                $this->result->message = "Failed!!";
        
                return $this->result;
            }
        }else{
            $this->result->status = false;
            $this->result->message = "Failed!";
    
            return $this->result;
        }

    }

    //-------------------------- Affiliate logic -----------------------------
    public function CreateAffiliateRecord($accountId, $accountTypeId){
        $getAccountType = $this->AdminUserManagementEditRepo->GetAccountType($accountTypeId);
        if(empty($getAccountType)){
            $this->result->status = false;
            $this->result->message = "Failed!!*&";
        }

        $accountType = $getAccountType[0]->type;
        $this->result->status = true;
        $this->result->message = $accountType;

        if($accountType=='Affiliate' || $accountType=='Affiliate intern'){
            $addCommissionRate = \AdminUserManagementAddFacade::CreateRecordAffiliate($accountId, $accountTypeId);

            if($addCommissionRate=='Affiliate'){
                $this->result->status = true;
                $this->result->message = "Affiliate OK";
            }else{
                $this->result->status = true;
                $this->result->message = "Affiliate error";
            }
        }else{
            // non active affiliate_commissions
            $this->AdminUserManagementEditRepo->NonActiveAffiliateCommission($accountId);

            // non active affiliate_commission_tour_rate
            $this->AdminUserManagementEditRepo->NonActiveAffiliateCommissionTourRate($accountId);

            $this->result->status = true;
            $this->result->message = 'OK';
        }

        return $this->result;
    }
}