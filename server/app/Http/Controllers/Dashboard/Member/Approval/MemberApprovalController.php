<?php
namespace App\Http\Controllers\Dashboard\Member\Approval;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class MemberApprovalController extends MyBaseController {

	// Approval
	public function MemberApproval(Request $request){
		$data  = $request->input();
		try{
			$results = \MemberApprovalFacade::MemberApproval($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

}