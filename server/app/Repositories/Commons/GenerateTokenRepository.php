<?php 
namespace App\Repositories\Commons;

use Carbon\Carbon;

class GenerateTokenRepository{

	public function __construct(){	}

	/*
        1. Check token repeat
        2. Save token
	*/

	// 1. Check token repeat
	public function CheckTokenRepeat($token){
		$result = \DB::table('tokens')
						->where('token',$token)
						->where('is_active',1)
						->get();
		if($result){
			return true;
		}else{
			return false;
		}
    }
    
    // 2. Save token
    public function SaveToken($token){
        $data = ["token"=>$token, "is_active"=>1];
        $result = \DB::table('tokens')->insertGetId($data);
        return $result;
    }

}