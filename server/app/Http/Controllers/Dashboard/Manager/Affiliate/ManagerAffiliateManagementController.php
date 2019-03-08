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

class ManagerAffiliateManagementController extends Controller {

	// Get affiliate
	public function AffiliateManagement(Request $request){
		$data = $request->input();
		try{
			$results = \ManagerAffiliateManagementFacade::AffiliateManagement($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Get affiliate detail
	public function AffiliateManagementDetail(Request $request){
		$data = $request->input();
		try{
			$results = \ManagerAffiliateManagementDetailFacade::GetAffiliateDetail($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Get affiliate commission rate
	public function AffiliateManagementCommissionRate(Request $request){
		$data = $request->input();
		try{
			$results = \ManagerAffiliateManagementCommissionRateFacade::GetAffiliateCommissionRate($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// Update affiliate commission rate
	public function AffiliateUpdateCommissionRate(Request $request){
		$data = $request->input();
		try{
			$results = \ManagerAffiliateUpdateCommissionRateFacade::UpdateAffiliateCommissionRate($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

}