<?php 
namespace App\Repositories\Accounts;

use Carbon\Carbon;

use App\account as Account;

class AccountRepository{    

	public function __construct(Account $Account){
        $this->Account = $Account;
	}

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