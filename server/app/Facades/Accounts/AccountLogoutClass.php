<?php
namespace App\Facades\Accounts;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\AccountLogoutRepository as AccountLogoutRepo;

use App\account as Account;

class AccountLogoutClass{

	public function __construct(AccountLogoutRepo $AccountLogoutRepo){
		$this->AccountLogoutRepo = $AccountLogoutRepo;
	}

    /*
        Logout logic
            1. Update login history (non active)
    */

    // 1. Update login history (non active)
    public function AccountLogout($data){
        $username = array_get($data,'username');
        $token = array_get($data,'token');
        $dateTimeNow = Carbon::now('Asia/Bangkok');
        $signout = new Account;

        // Get account id
        $account = $this->AccountLogoutRepo->GetAccount($username);
        $accountId = $account[0]->id;

        // Logout
        $result = $this->AccountLogoutRepo->Logout($accountId, $token, $dateTimeNow);
        if($result){
            $signout->status = true;
            $signout->message = 'Sign out successfully.';
            $signout->notify = 'OK';
        }else{
            $signout->status = false;
            $signout->message = 'Sign out failed';
            $signout->notify = 'Error';
        }
        return $signout;
    }

}