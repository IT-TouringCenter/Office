<?php
namespace App\Http\Controllers\Bank;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class BankController extends MyBaseController {

	// Save for insert and run booking number
	public function GetBankData(Request $request){
		$bookingData  = $request->input();
		try{
			$results = \BankFacade::GetBankData($bookingData);
			if($results==null){
				abort(400);
			}
			return $results;
		}catch(Exception $e){
			abort(500);
		}
	}


}
