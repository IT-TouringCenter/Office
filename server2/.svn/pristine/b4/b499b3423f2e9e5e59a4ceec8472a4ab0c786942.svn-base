<?php 
namespace App\Http\Controllers\EasyBook\Ticket;

use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyBaseController;

use Illuminate\Http\Request;
use App\transaction as transaction;

class TicketController extends MyBaseController {

	public function GetTicketsByTransactionId($activityId,$transactionId,$passengerId){
		// return "Get Ticket by Transacton Id";
		try{
			if($transactionId ===null && $passengerId){
				abort(400);
			}
			$tid = \HelperFacade::Decode($transactionId);
			// $tid = $transactionId;
			$pid = \HelperFacade::Decode($passengerId);
			// $pid = $passengerId;
			$results = \TicketFacade::GetTicketByPassenger($tid,$pid);

			return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			// return $this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'TransactionControlelr.GetDataTransactionPaid error: '.$e);
			abort(500);
		}
	}

}