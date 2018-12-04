<?php
namespace App\Facades\Accounts;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\AccountLoginRepository as AccountLoginRepo;

use App\account as Account;

class AccountLoginReturnTypeClass{

	public function __construct(AccountLoginRepo $AccountLoginRepo){
		$this->AccountLoginRepo = $AccountLoginRepo;
	}

    /*
        Logout logic
            1. 
    */

    // 1. 
    public function GetAccountByTokenReturnType($token,$accountType){
        $this->account = new Account;
        $loginStatus = false;

        // check login
        $getLogin = $this->AccountLoginRepo->GetAccountLoginByToken($token);
        if($getLogin){
            $this->GetAccountType($token,$accountType);
        }else{
            $this->account->status = false;
            $this->account->message = "Please login.";
            $this->account->data = [];
        }

        return $this->account;
    }

    // 2. 
    public function GetAccountType($token,$accountType){
        // get account

        // check account active & type
        $getAccount = $this->AccountLoginRepo->GetAccountType($token,$accountType);
        if($getAccount){
            $this->account->status = true;
            $this->account->message = "Success.";
            $this->account->data = $getAccount;
        }else{
            $this->account->status = false;
            $this->account->message = "Can't get data.";
            $this->account->data = [];
        }
    }
}