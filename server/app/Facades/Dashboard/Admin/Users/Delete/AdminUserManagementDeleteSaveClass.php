<?php
namespace App\Facades\Dashboard\Admin\Users\Delete;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\Delete\AdminUserManagementDeleteRepository as AdminUserManagementDeleteRepo;

// import model
use App\account as Account;

class AdminUserManagementDeleteSaveClass{

	public function __construct(AdminUserManagementDeleteRepo $AdminUserManagementDeleteRepo){
        $this->AdminUserManagementDeleteRepo = $AdminUserManagementDeleteRepo;
    }

    /*
        1. 
    */

    public function AdminUserManagementDeleteSave($data){
        $dateNow = Carbon::now('Asia/Bangkok');
        $accountToken = array_get($data,'accountToken');
        $userToken = array_get($data,'userToken');
        $dataArr = [];
        $result = new Account;

         // Get account by token
         $getAccount = $this->AdminUserManagementDeleteRepo->GetAccountByToken($accountToken);
         if($getAccount){
             $accountType = $getAccount[0]->account_type_id;
         }
 
         // Get user by token
         if($accountType!=4){
             $result->status = false;
             $result->message = "Failed!";
             $result->data = $dataArr;
             return $result;
         }

        // get user by token
        $getUser = $this->AdminUserManagementDeleteRepo->GetAccountByToken($userToken);

        if($getUser){
            $userId = $getUser[0]->id;
        }else{
            $result->status = false;
            $result->message = "Failed!!";
            return $result;
        }
        
        // delete account
        $dataUpdate = [
            "is_delete"=>1,
            "is_active"=>0,
            "updated_by"=>array_get($data,'accountName'),
            "updated_at"=>$dateNow
        ];

        $deleteAccount = $this->AdminUserManagementDeleteRepo->DeleteAccountById($userId,$dataUpdate);

        if($deleteAccount){
            $result->status = true;
            $result->message = "OK";
        }else{
            $result->status = false;
            $result->message = "Failed!!";
        }

        return $result;
    }
}