<?php
namespace App\Facades\Dashboard\Admin\Users\Active;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\Active\AdminUserManagementActiveRepository as AdminUserManagementActiveRepo;

// import model
use App\account as Account;

class AdminUserManagementActiveSaveClass{

	public function __construct(AdminUserManagementActiveRepo $AdminUserManagementActiveRepo){
        $this->AdminUserManagementActiveRepo = $AdminUserManagementActiveRepo;
    }

    /*
        1. 
    */

    public function AdminUserManagementActiveSave($data){
        $token = array_get($data,'userToken');
        $active = array_get($data,'active');
        $dateNow = Carbon::now('Asia/Bangkok');
        $result = new Account;

        // get account by token
        $getAccount = $this->AdminUserManagementActiveRepo->GetAccountByToken($token);

        if($getAccount){
            $accountId = $getAccount[0]->id;
        }else{
            $result->status = false;
            $result->message = "Failed!";
            return $result;
        }

        // delete account
        $dataUpdate = [
            "is_active"=>$active,
            "updated_by"=>array_get($data,'accountName'),
            "updated_at"=>$dateNow
        ];

        $activeAccount = $this->AdminUserManagementActiveRepo->ActiveAccountById($accountId,$dataUpdate);

        if($activeAccount){
            $result->status = true;
            $result->message = "OK";
        }else{
            $result->status = false;
            $result->message = "Failed!!";
        }

        return $result;
    }
}