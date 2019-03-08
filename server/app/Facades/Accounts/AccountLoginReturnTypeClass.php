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
    public function GetAccountByTokenReturnType($token,$tokenLogin,$accountType){
        $this->account = new Account;
        $loginStatus = false;

        // check login
        $getLogin = $this->AccountLoginRepo->GetAccountLoginByToken($token,$tokenLogin);
        if($getLogin){
            // check login expired
            $checkLoginExpired = $this->CheckLoginExpired($token);
            
            if($checkLoginExpired==true){
                $this->GetAccountType($token,$accountType);
            }else{
                $this->account->status = false;
                $this->account->message = "Login expired.";
                $this->account->data = [];
            }
            
        }else{
            $this->account->status = false;
            $this->account->message = "Please login.";
            $this->account->data = [];
        }

        return $this->account;
    }

    // 2. check login expired
    public function CheckLoginExpired($token){
        $dateNow = Carbon::now('Asia/Bangkok');
        $loginExpired = $this->AccountLoginRepo->CheckLoginExpired($token,$dateNow);

        if($loginExpired){
            return true;
        }else{
            return false;
        }
    }

    // 3. 
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