<?php
namespace App\Facades\EasyBook\Passenger;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\EasyBook\Passenger\PassengerRepository as PassengerRepo;
use App\passenger as passenger;

class PassengerClass{

	public function __construct(PassengerRepo $PassengerRepo){
		$this->PassengerRepo = $PassengerRepo;
	}

	public function Save($data){
		return $this->PassengerRepo->SaveV2($data);		
	}

	public function CheckPassengerToTravelTour($passenger_arr, $reservation, $config_tour_program_id, $tour_traveling_date, $tour_traveling_time_id){
		$reservation_count = count($reservation);
		$passenger_count = count($passenger_arr);

		$person_arr = [];
		$tour_arr = [];
		// for($j=0; $j<$passenger_count; $j++){
		// 	$this->get_passenger = new passenger;
		// 	$this->get_passenger->passenger_get_client_id = array_get($passenger_arr[$j], 'passenger_client_id');
		// 	// $this->get_passenger->passenger_id = array_get($passenger_arr[$j], 'passenger_id');
		// 	array_push($person_arr, $this->get_passenger);
		// }

		for($i=0; $i<$reservation_count; $i++){
			$passenger_client_id = array_get($reservation[$i],'id');
			$tour = array_get($reservation[$i],'tours');
			
			$this->passenger = new passenger;
			// $this->passenger->passenger_client_id = $passenger_client_id;
			// $this->passenger->passenger_id = array_get($passenger_arr[$i], 'passenger_id');
			// $this->passenger->config_tour_program_id = $config_tour_program_id;
			// $this->passenger->tour_traveling_time_id = $tour_traveling_time_id;
			// $this->passenger->tour_traveling_date = $tour_traveling_date;
			// $this->passenger->tour_price = array_get($tour[$i], 'tourPrice');
			// $this->passenger->tour_discount = array_get($tour[$i], 'tourDiscount');
			// $this->passenger->amount = array_get($tour[$i], 'amount');
			// $this->passenger->

			$tour_arr = [
				"passenger_client_id"=>$passenger_client_id,
				"passenger_id"=>array_get($passenger_arr[$i], 'passenger_id'),
				"config_tour_program_id"=>$config_tour_program_id,
				"tour_traveling_time_id"=>$tour_traveling_time_id,
				"tour_traveling_date"=>$tour_traveling_date
			];

			$this->PassengerToTravelTour($tour_arr, $tour, $config_tour_program_id, $tour_traveling_time_id, $tour_traveling_date);
			// $this->passenger->tour = $tour;
			// $this->passenger->tours = $reservation[$i];
			// $this->unique_tour
			array_push($person_arr, $this->passenger);
		}
		// for($j=0; $j<$passenger_count; $j++){
		// 	$this->get_passenger = new passenger;
		// 	$this->get_passenger->passenger_get_client_id = array_get($passenger_arr[$j], 'passenger_client_id');
		// 	// $this->get_passenger->passenger_id = array_get($passenger_arr[$j], 'passenger_id');
		// 	array_push($person_arr, $this->get_passenger);
		// }
		// array_push($person_arr, $this->get_passenger);
		// $this->traveller = new passenger;
		// $this->PassengerToTravelTour($person_arr);
		return $person_arr;
	}

	public function PassengerToTravelTour($tour_arr, $tour, $config_tour_program_id, $tour_traveling_time_id, $tour_traveling_date){
		// $this->passenger->tour = $tour;
		$passenger_arr = [];
		foreach($tour as $value){
			$configTourProgramId = array_get($value, 'configTourProgramId');
			$tourTravelingTimeId = array_get($value, 'tourTravelingTimeId');
			$tourTravelingDate = array_get($value, 'tourTravelingDate');
			// array_push($value, $tour_arr);

			$passenger = new passenger;

			if($configTourProgramId==$config_tour_program_id && $tourTravelingTimeId==$tour_traveling_time_id && $tourTravelingDate==$tour_traveling_date){
				$passenger->config_tour_program_id = $configTourProgramId;
				$passenger->tour_traveling_time_id = $tourTravelingTimeId;
				$passenger->tour_traveling_date = $tourTravelingDate;
				array_push($passenger_arr, $value);
			}else{

			}

			// $passenger = new passenger;
			// $passenger->config_tour_program_id = array_get($value, 'configTourProgramId');
			// $passenger->tour_traveling_time_id = array_get($value, 'tourTravelingTimeId');
			// $passenger->tour_traveling_date = array_get($value, 'tourTravelingDate');

		}
		// $this->passenger->tour = $tour;
		$count_tour = count($passenger_arr);
		if($count_tour<1){

		}else{
			$this->passenger->tours = $passenger_arr;
		}

		// $this->passenger->count_tour = $count_tour;
		// $this->passenger->tours = $passenger_arr;
	}
}