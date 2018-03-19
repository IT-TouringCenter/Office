<?php
namespace App\Http\Controllers\EasyBook\Transaction;

// use Request;
use Validator;
use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\MyBaseController;

use Illuminate\Support\Facades\Redirect;

class GenerateTransactionController extends MyBaseController {

	public function GenTransactionId($activityId, $transactionId){
			$genTransactionId = \HelperFacade::Encode($transactionId);
			return $genTransactionId;
	}
}