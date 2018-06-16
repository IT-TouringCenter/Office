<?php
namespace App\Http\Controllers\Payments;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class PaymentController extends MyBaseController {

	// Update & Save payment affiliate commission history
	public function PaymentAffiliateCommissionPending(Request $request){
		$data  = $request->input();
		try{
			$results = \PaymentAffiliateCommissionFacade::PaymentAffiliateCommissionPending($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

	// 
	public function PaymentAffiliateCommissionPaid(Request $request){
		$data  = $request->input();
		try{
			$results = \PaymentAffiliateCommissionFacade::PaymentAffiliateCommissionPaid($data);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}

}