<?php
namespace App\Http\Controllers\Dashboard\Manager\Affiliate;

use Validator;
use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Redirect;

class ManagerAffiliateController extends Controller {

	// Get affiliate
	public function GetAffiliateAccount(Request $request){
		$data = $request->input();
		try{
			$results = \ManagerAffiliateFacade::GetAffiliateAccount($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}


}