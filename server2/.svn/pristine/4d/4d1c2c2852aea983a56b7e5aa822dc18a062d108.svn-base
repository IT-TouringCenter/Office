<?php
namespace App\Facades\EasyBook\Reservation;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\activity as activity;
use App\tour_program as tour_program;

class ReservationClass{

	public function __construct(){
	}

	//============----  Transfer  ----=============//
	public function GetTransferIcas($activity_id){
		$transfer = \TransferIcasFacade::GetTransferIcas($activity_id);
		return $transfer;
	}

	//============----  Activity  ----===========//
	public function GetActivityIcas($activity_id){
		// $activity_num = 1;
		$activity = \ActivityIcasFacade::GetActivityEvent($activity_id);
		$activity_arr = [];

		foreach($activity as $value){
			$this->activity = new activity;
			$this->activity->activityId = $value->id;
			$this->activity->activity = $value->activity;

			$this->GetTourProgram($value->id);

			array_push($activity_arr, $this->activity);
		}
		return $activity_arr;
	}

	public function GetTourProgram($activity_id){
		$tour_program = \TourProgramIcasFacade::GetConfigurationTourPorgram($activity_id);
		$this->activity->data = $tour_program;
	}
}