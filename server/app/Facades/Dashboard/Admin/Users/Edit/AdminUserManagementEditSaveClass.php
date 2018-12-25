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
        $result = new Account;

        // get account id
        $getAccount = $this->AdminUserManagementEditRepo->GetAccountByToken($token);
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

            if($updateAccountProfile){
                $result->status = true;
                $result->message = "OK";
        
                return $result;
            }else{
                $result->status = false;
                $result->message = "Failed!!";
        
                return $result;
            }
        }else{
            $result->status = false;
            $result->message = "Failed!";
    
            return $result;
        }
        
    }
}