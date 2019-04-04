<?php
namespace App\Facades\Accounts;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\AccountRepository as AccountRepo;

use App\account as Account;

class AccountClass{

	public function __construct(AccountRepo $AccountRepo){
		$this->AccountRepo = $AccountRepo;
	}

    /*
        1. Get account by token
        2. Get account by id
    */

    // 1. Get account by token
    public function GetAccountLoginByToken($token){
        $accountData = new Account;

        $result = $this->AccountRepo->GetAccountLoginByToken($token);
        if($result){
            $getAccountData = $this->GetAccountByID($result[0]->account_id);
            // return $getAccountData;
        }else{
            $accountData->status = false;
            $accountData->id = 0;
            $accountData->username = '1';
            return $accountData;
        }

        if($getAccountData->status==true){
            $accountData->status = true;
            $accountData->id = $getAccountData->id;
            $accountData->username = $getAccountData->username;
        }else{
            $accountData->status = false;
            $accountData->id = 0;
            $accountData->username = '2';
        }
        return $accountData;
    }

    // 2. Get account by id
    public function GetAccountByID($accountId){
        $result = $this->AccountRepo->GetAccountByID($accountId);
        $account = new Account;

        if($result){
            $account->status = true;
            $account->id = $result[0]->id;
            $account->username = $result[0]->username;
        }else{
            $account->status = false;
            $account->id = 0;
            $account->username = '3';
        }
        return $account;
    }

    // 3. Get account by token
    public function GetAccountByToken($token){
        $result = $this->AccountRepo->GetAccountByToken($token);
        $account = new Account;

        if($result){
            $account->status = true;
            $account->username = $result[0]->username;
        }else{
            $account->status = false;
            $account->username = '';
        }
        return $account;
    }

    // 4. Get account by token (active=0)
    public function GetAccountByTokenNonActive($token){
        $result = $this->AccountRepo->GetAccountByTokenNonActive($token);
        $account = new Account;

        if($result){
            $account->status = true;
            $account->accountId = $result[0]->id;
            $account->username = $result[0]->username;
        }else{
            $account->status = false;
            $account->accountId = 0;
            $account->username = '';
        }

        return $account;
    }

    // Get affiliate account
    public function GetAffiliateAccountIDByToken($token){
        $GetAccountId = $this->AccountRepo->GetAffiliateAccountIDByToken($token);
        return $GetAccountId;
    }

    // Get affiliate intern account
    public function GetAffiliateInternAccountIDByToken($token){
        $GetAccountId = $this->AccountRepo->GetAffiliateInternAccountIDByToken($token);
        return $GetAccountId;
    }
}