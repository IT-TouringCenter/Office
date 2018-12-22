<?php 
namespace App\Repositories\Accounts;

use Carbon\Carbon;

class AccountTypeRepository{

	public function __construct(){
	}

    /*
        1. Get account type
    */

    // 1. Get account type
    public function GetAccountType(){
		$result = \DB::table('account_types')
						->where('is_active',1)
						->get();
		return $result;
    }


}