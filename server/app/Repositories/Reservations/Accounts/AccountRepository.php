<?php 
namespace App\Repositories\Reservations\Accounts;

class AccountRepository{

	public function __construct(){

    }

	// Get account by token
	public function GetAccountByToken($token){
		$result = \DB::table('accounts')
                    ->where('is_active',1)
                    ->where('token',$token)
					->get();
        return $result;
	}

}