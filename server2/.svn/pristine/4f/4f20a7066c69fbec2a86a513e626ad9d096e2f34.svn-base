<?php
namespace App\Http\Controllers\EasyBook\Invoice;

use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\MyBaseController;

class InvoiceController extends MyBaseController {

	public function GetTourInvoice($activityId, $transactionId, $transactionTourId){
		try{
			if($transactionId ==null){
				abort(400);
			}
			$tid = \HelperFacade::Decode($transactionId);
			$ttid = \HelperFacade::Decode($transactionTourId);

			$results = \TourInvoiceFacade::GetInvoiceTourProgram(intval($tid), intval($ttid));
			return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

	public function GetAirportInvoice($activityId,$transactionId){
		try{
			if($transactionId ==null){
				abort(400);
			}
			$tid = \HelperFacade::Decode($transactionId);
			// $tid= $transactionId;
			$results =\AiportInvoiceFacade::GetInvoiceByTransactionId($tid);
			return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			throw $e;
		}
	}

	public function GetCMECCInvoice($activityId,$transactionId){
		try{
			if($transactionId ==null){
				abort(400);
			}
			$tid = \HelperFacade::Decode($transactionId);
			// $tid= $transactionId;
			$results =\ConventionInvoiceFacade::GetInvoiceByTransactionId($tid);
			return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			throw $e;
		}
	}

	//*---------- New invoice per person -----------*//
	public function GetInvoice($activityId, $transactionId, $passengerId){
		try{
			if($transactionId == null){
				abort(400);
			}
			$transId = \HelperFacade::Decode($transactionId);
			$passId = \HelperFacade::Decode($passengerId);
			$results = \InvoiceFacade::GetInvoice($transId, $passId);
			return $this->Response(ResponseStatus::OK, ResponseCode::OK,$results);
		}catch(Exception $e){
			throw $e;
		}
	}

	
}