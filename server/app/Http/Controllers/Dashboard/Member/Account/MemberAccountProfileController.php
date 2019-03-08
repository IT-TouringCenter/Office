<?php
namespace App\Http\Controllers\Dashboard\Member\Account;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class MemberAccountProfileController extends MyBaseController {

	// Get account profile
	public function GetAccountProfile(Request $request){
		$data  = $request->input();
		try{
			$results = \MemberAccountProfileFacade::GetAccountProfile($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}


}