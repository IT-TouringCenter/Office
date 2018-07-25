<?php
namespace App\Facades\Accounts;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\AccountForceLogoutRepository as AccountForceLogoutRepo;

use App\account as Account;

class AccountForceLogoutClass{

	public function __construct(AccountForceLogoutRepo $AccountForceLogoutRepo){
		$this->AccountForceLogoutRepo = $AccountForceLogoutRepo;
	}

    /*  Force logout logic
            1. Get account
            2. Force logout
    */

    public function AccountForceLogout($data){
        // Set variable
        $username = array_get($data,'username');
        $logoutCode = array_get($data,'logoutCode');
        $logout = new Account;

        // 1. Get account
        $accountData = $this->GetAccount($username);
        $accountId = array_get($accountData,'accountId');

        // 2. Force logout
        $forceLogout = $this->ForceLogout($accountId, $logoutCode);
        if($forceLogout){
            $logout->status = true;
            $logout->message = 'Signed out.';
            $logout->notify = 'OK';
        }else{
            $logout->status = false;
            $logout->message = 'Sign out not found.';
            $logout->notify = 'Error';
        }
        return $logout;
    }

    // 1. Get account
    public function GetAccount($username){
        $result = $this->AccountForceLogoutRepo->GetAccount($username);

        $account = new Account;
        $account->accountId = $result[0]->id;

        return $account;
    }

    // 2. Force logout
    public function ForceLogout($accountId, $logoutCode){
        $dateTimeNow = Carbon::now('Asia/Bangkok');

        $result = $this->AccountForceLogoutRepo->ForceLogout($accountId, $logoutCode, $dateTimeNow);
        return $result;
    }
}