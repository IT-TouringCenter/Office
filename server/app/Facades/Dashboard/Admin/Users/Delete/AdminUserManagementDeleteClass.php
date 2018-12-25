<?php
namespace App\Facades\Dashboard\Admin\Users\Delete;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\Delete\AdminUserManagementDeleteRepository as AdminUserManagementDeleteRepo;

// import model
use App\account as Account;

class AdminUserManagementDeleteClass{

	public function __construct(AdminUserManagementDeleteRepo $AdminUserManagementDeleteRepo){
        $this->AdminUserManagementDeleteRepo = $AdminUserManagementDeleteRepo;
    }

    /*
        1. 
    */

    public function AdminUserManagementDelete($data){
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

        $getUser = $this->AdminUserManagementDeleteRepo->GetAccountByToken($userToken);
        if($getUser){
            $userData = new Account;
            $userData->username = $getUser[0]->username;
            $userData->token = $getUser[0]->token;
            array_push($dataArr,$userData);

            $result->status = true;
            $result->message = "OK";
            $result->data = $dataArr;
        }else{
            $result->status = true;
            $result->message = "Failed!!";
            $result->data = $dataArr;
        }

        return $result;
    }
}