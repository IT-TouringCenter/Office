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

    public function GetAffiliateAccountIDByToken($token){
        $GetAccountId = $this->AccountRepo->GetAffiliateAccountIDByToken($token);
        return $GetAccountId;
    }

}