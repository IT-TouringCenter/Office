<?php
namespace App\Facades\Dashboard\Admin\Users\Active;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\Active\AdminUserManagementActiveRepository as AdminUserManagementActiveRepo;

// import model
use App\account as Account;

class AdminUserManagementActiveClass{

	public function __construct(AdminUserManagementActiveRepo $AdminUserManagementActiveRepo){
        $this->AdminUserManagementActiveRepo = $AdminUserManagementActiveRepo;
    }

    /*
        1. 
    */

    public function AdminUserManagementActive($data){
        $token = array_get($data,'token');
        $result = new Account;
        $dataArr = [];

        // get account by token
        $getAccount = $this->AdminUserManagementActiveRepo->GetAccountByToken($token);

        if($getAccount){
            $accountType = $getAccount[0]->account_type_id;
        }else{
            $result->status = false;
            $result->message = "Failed!";
            $result->data = $dataArr;
            return $result;
        }

        // check account type [admin]
        if(!$accountType==4){
            $result->status = false;
            $result->message = "Failed!!";
            $result->data = $dataArr;
            return $result;
        }

        // get all account
        $getAllAccount = $this->AdminUserManagementActiveRepo->GetAllAccount();

        if(empty($getAllAccount) || $getAllAccount==null || $getAllAccount==''){
            $result->status = false;
            $result->message = "Failed!!!";
            $result->data = $dataArr;
            return $result;
        }

        // set data return
        foreach($getAllAccount as $value){
            $user = new Account;
            $user->userId = $value->id;
            $user->token = $value->token;
            $user->username = $value->username;
            $user->fullname = $value->fullname;
            $user->noted = $value->noted;
            $user->active = $value->is_active;

            if($value->is_active==1){
                $user->status = "Active";
            }else{
                $user->status = "Non active";
            }

            array_push($dataArr,$user);
        }
        
        $result->status = true;
        $result->message = "OK";
        $result->data = $dataArr;

        return $result;
    }
}