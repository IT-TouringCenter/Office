<?php
namespace App\Http\Controllers\Dashboard\Member\Request;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class MemberRequestController extends MyBaseController {

	// Request join affiliate
	public function RequestJoinAffiliate(Request $request){
		$data  = $request->input();
		try{
			$results = \MemberRequestJoinAffiliateFacade::RequestJoinAffiliate($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Check request join affiliate
	public function CheckRequestJoinAffiliate(Request $request){
		$data  = $request->input();
		try{
			$results = \MemberCheckRequestJoinAffiliateFacade::CheckRequestJoinAffiliate($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Cancel request
	public function CancelRequest(Request $request){
		$data  = $request->input();
		try{
			$results = \MemberCancelRequestFacade::CancelRequest($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}


}