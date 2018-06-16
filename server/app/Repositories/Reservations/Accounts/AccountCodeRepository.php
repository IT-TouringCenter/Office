<?php 
namespace App\Repositories\Reservations\Accounts;

class AccountCodeRepository{

	public function __construct(){

    }
	
	// Get account code all
	public function GetAccountCode(){
		$result = \DB::table('customer_codes as cc')
					->select('code','customer_name')
					->where('is_active',1)
					->get();
        return $result;
	}

	// Get account code ID
	public function GetAccountCodeById($codeId){
		$result = \DB::table('customer_codes as cc')
					->where('id',$codeId)
					->where('is_active',1)
					->get();
		return $result;
	}

}