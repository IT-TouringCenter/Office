<?php
namespace App\Facades\Accounts;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\AccountTypeRepository as AccountTypeRepo;

use App\account as Account;

class AccountTypeClass{

	public function __construct(AccountTypeRepo $AccountTypeRepo){
		$this->AccountTypeRepo = $AccountTypeRepo;
	}

    /*
        1. GetAccountType
    */

    public function GetAccountType(){
        $getAccountType = $this->AccountTypeRepo->GetAccountType();

        $accountTypeArr = [];
        foreach($getAccountType as $value){
            $type = new Account;
            $type->id = $value->id;
            $type->type = $value->type;

            array_push($accountTypeArr,$type);
        }
        return $accountTypeArr;
    }
}