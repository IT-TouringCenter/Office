<?php 
namespace App\Repositories\Reservations\Accounts;

class AccountRepository{

	public function __construct(){

    }

	// Get account by token
	public function GetAccountByToken($token){
		$result = \DB::table('accounts')
						->where('token',$token)
						->where('is_active',1)
						->get();
		return $result;
    }

	// Get account by token & type
	public function GetAccountByTokenAndType($token,$typeId){
		$result = \DB::table('accounts')
                    ->where('is_active',1)
					->where('token',$token)
					->where('account_type_id',$typeId)
					->get();
		if($result){
			return $result;
		}else{
			return '';
		}
	}

}