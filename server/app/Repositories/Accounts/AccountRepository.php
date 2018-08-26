<?php 
namespace App\Repositories\Accounts;

use Carbon\Carbon;

use App\account as Account;

class AccountRepository{    

	public function __construct(Account $Account){
        $this->Account = $Account;
	}

    /*
        1. Get account login by token
        2. Get account by ID
    */

    // 1. Get account login by token
    public function GetAccountLoginByToken($token){
		$result = \DB::table('login_histories')
						->where('token',$token)
						->where('is_active',1)
						->get();
		return $result;
    }
    
    // 2. Get account by ID
    public function GetAccountByID($accountId){
        $result = \DB::table('accounts')
                        ->where('id',$accountId)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 3. Get account by token
    public function GetAccountByToken($token){
		$result = \DB::table('accounts')
						->where('token',$token)
						->where('is_active',1)
						->get();
		return $result;
    }

    // 4. Get account by token (non active)
    public function GetAccountByTokenNonActive($token){
        $result = \DB::table('accounts')
                        ->where('token',$token)
                        ->where('is_active',0)
                        ->get();
        return $result;
    }

    //
    public function GetAffiliateAccountIDByToken($token){
        $result = \DB::table('accounts')
                        ->select('id')
                        ->where('account_type_id',3)
                        ->where('token',$token)
                        ->where('is_active',1)
                        ->get();
        // $result = $this->Account->where('token',$token)->get();
        if($result){
            return $result[0]->id;
        }else{
            return 0;
        }
        
    }

}