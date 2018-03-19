<?php
namespace App\Http\Controllers\EasyBook\Reservation;

use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;

use App\Http\Controllers\MyBaseController;

use Illuminate\Http\Request;

class ReservationController extends MyBaseController {

	public function GetTransferIcas($activity_id){
		try{
			$result = \ReservationIcasFacade::GetTransferIcas($activity_id);
			if($result==null){
				return $this->Response(ResponseStatus::NoContent,ResponseCode::NoContent,null);
			}
				return $this->Response(ResponseStatus::OK,ResponseCode::OK,$result);	
		}catch(Exception $e) {			
			return $this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'ReservationController.GetTransferIcas error: '.$e);
		}
	}

	public function GetActivityIcas($activity_id){
		try{
			$result = \ReservationIcasFacade::GetActivityIcas($activity_id);
			if($result==null){
				return $this->Response(ResponseStatus::NoContent,ResponseCode::NoContent,null);
			}
				return $this->Response(ResponseStatus::OK,ResponseCode::OK,$result);	
		}catch(Exception $e) {			
			return $this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'ReservationController.GetActivityIcas error: '.$e);
		}
	}
}