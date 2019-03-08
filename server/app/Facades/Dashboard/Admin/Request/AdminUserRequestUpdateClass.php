<?php
namespace App\Facades\Dashboard\Admin\Request;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Request\AdminUserRequestUpdateRepository as AdminUserRequestUpdateRepo;

// import model
use App\account as Account;

class AdminUserRequestUpdateClass{

	public function __construct(AdminUserRequestUpdateRepo $AdminUserRequestUpdateRepo){
        $this->AdminUserRequestUpdateRepo = $AdminUserRequestUpdateRepo;
    }

    // 
    public function UserRequestUpdate($data){
        // set data
        $token = array_get($data,'token');
        $statusId = array_get($data,'status');
        $requestId = array_get($data,'request');
        $requestTypeId = array_get($data,'requestType');
        $request = new Account;

        // check account
        $checkAccount = $this->AdminUserRequestUpdateRepo->GetAccountByToken($token);
        if(empty($checkAccount)){
            $request->status = false;
            $request->message = 'Error';
            $request->data = [];

            return $request;
        }
        $accountId = $checkAccount[0]->id;

        // update status
        $updateStatus = $this->AdminUserRequestUpdateRepo->UpdateUserRequestStatus($accountId,$statusId);
        if(empty($updateStatus)){
            $request->status = false;
            $request->message = 'Error!';
            $request->data = [];

            return $request;
        }

        // check status update
        if($statusId==1){ // waiting
            $request->status = false;
            $request->message = 'waiting';
            $request->data = [];

            return $request;
        }else if($statusId==3){ // not approve
            $request->status = false;
            $request->message = 'not approve';
            $request->data = [];

            return $request;
        }

        // update account type : accounts table
        $accountTypeId = $checkAccount[0]->account_type_id;
        
        $checkAccountType = $this->CheckAccountType($requestTypeId, $accountTypeId);
        $accountTypeId = $checkAccountType; // new set

        $updateAccountType = $this->AdminUserRequestUpdateRepo->UpdateAccountType($accountId, $accountTypeId);
        if(empty($updateStatus)){
            $request->status = false;
            $request->message = 'Error#!';
            $request->data = [];

            return $request;
        }

        // non active request
        $nonActiveRequest = $this->AdminUserRequestUpdateRepo->NonActiveAccountRequest($requestId);
        if(empty($nonActiveRequest)){
            $request->status = false;
            $request->message = 'Error~#!!';
            $request->data = [];
        }

        $request->status = true;
        $request->message = 'OK';
        $request->data = [];

        return $request;
    }

    // check account type
    public function CheckAccountType($accountRequestType, $accountTypeId){
        $accountType = '';
        switch($accountRequestType){
            case '1' : $accountType = 2; break;
            case '2' : $accountType = 3; break;
            case '3' : $accountType = $accountTypeId; break;
            case '4' : $accountType = 3; break;
        }

        return $accountType;
    }

}