<?php
namespace App\Facades\EasyBook\Reservation\Activity\Tour;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\EasyBook\Reservation\Tour\ConfigurationTourProgramRepository as configuration_tour_program_repo;
use App\Repositories\EasyBook\Reservation\Tour\TourProgramRepository as tour_program_repo;
use App\Repositories\EasyBook\Reservation\Tour\TourCategoryRepository as tour_category_repo;
use App\Repositories\EasyBook\Reservation\Tour\TourTravelingTimeRepository as tour_traveling_time_repo;
use App\Repositories\EasyBook\Reservation\Tour\TourTypePriceRepository as tour_type_price_repo;
use App\Repositories\EasyBook\Reservation\Tour\PaxRepository as pax_repo;
use App\Repositories\EasyBook\Reservation\Discount\ConfigurationTourProgramDiscountRepository as configuration_tour_program_discount_repo;
use App\Repositories\EasyBook\Reservation\Discount\DiscountTypeRepository as discount_type_repo;

use App\configuration_tour_program as configuration_tour_program;
use App\tour_category as tour_category;
use App\tour_traveling_time as tour_traveling_time;
use App\tour_type_price as tour_type_price;
use App\transportation as transportation;
use App\pax as pax;
use App\configuration_tour_program_discount as configuration_tour_program_discount;
use App\discount_type as discount_type;

class TourProgramClass{

	public function __construct(configuration_tour_program_repo $configuration_tour_program_repo, tour_program_repo $tour_program_repo, tour_category_repo $tour_category_repo, tour_traveling_time_repo $tour_traveling_time_repo, tour_type_price_repo $tour_type_price_repo, pax_repo $pax_repo, configuration_tour_program_discount_repo $configuration_tour_program_discount_repo, discount_type_repo $discount_type_repo){
		$this->configuration_tour_program_repo = $configuration_tour_program_repo;
		$this->tour_program_repo = $tour_program_repo;
		$this->tour_category_repo = $tour_category_repo;
		$this->tour_traveling_time_repo = $tour_traveling_time_repo;
		$this->tour_type_price_repo = $tour_type_price_repo;
		$this->pax_repo = $pax_repo;
		$this->configuration_tour_program_discount_repo = $configuration_tour_program_discount_repo;
		$this->discount_type_repo = $discount_type_repo;
	}

	public function GetConfigurationTourPorgram($activity_id){
		$config_tour_program = $this->configuration_tour_program_repo->GetConfigurationTourProgramByActivityId($activity_id);
		$config_tour_program_arr = [];

		foreach($config_tour_program as $value){
			$this->config_tour_program = new configuration_tour_program;
			$this->config_tour_program->configTourId = $value->id;

			// get tour program
			$this->GetTourProgramById($value->tour_program_id);
			// get tour category
			$this->GetTourCategoryById($value->tour_category_id);
			// get time by tour program id
			$this->GetTimeByTourProgramId($value->tour_program_id);
			// get tour type price
			$this->GetTourTypePriceByTourProgramId($activity_id, $value->tour_program_id);

			array_push($config_tour_program_arr, $this->config_tour_program);
		}

		return $config_tour_program_arr;
	}

	public function GetTourProgramById($tour_program_id){
		$tour_program = $this->tour_program_repo->GetTourProgramById($tour_program_id);
		$this->config_tour_program->tourProgramId = $tour_program_id;
		$this->config_tour_program->code = $tour_program[0]->code;
		$this->config_tour_program->title = $tour_program[0]->title;
		$this->config_tour_program->link = $tour_program[0]->link;
	}

	public function GetTourCategoryById($tour_category_id){
		$tour_category = $this->tour_category_repo->GetTourCategoryById($tour_category_id);

		foreach($tour_category as $value){
			$this->tour_category = new tour_category;
			$this->tour_category->id = $value->id;
			$this->tour_category->category = $value->category;
		}
		$this->config_tour_program->category = $this->tour_category;
	}

	public function GetTimeByTourProgramId($tour_program_id){
		$tour_traveling_time = $this->tour_traveling_time_repo->GetTourTravelingTimeByTourProgramId($tour_program_id);
		$tour_traveling_time_arr = [];

		foreach($tour_traveling_time as $value){
			$this->tour_traveling_time = new tour_traveling_time;
			$this->tour_traveling_time->id = $value->id;
			$this->tour_traveling_time->time = $value->traveling_time;

			array_push($tour_traveling_time_arr, $this->tour_traveling_time);
		}

		$this->config_tour_program->times = $tour_traveling_time_arr;
	}

	public function GetTourTypePriceByTourProgramId($activity_id, $tour_program_id){
		$tour_type_price = $this->configuration_tour_program_repo->GetTypePriceByConfigTourProgram($activity_id, $tour_program_id);
		$tour_type_price_arr = [];

		foreach($tour_type_price as $value){
			$this->tour_type_price = new tour_type_price;
			$this->tour_type_price->id = $value->tour_type_price_id;

			$tour_type = $this->tour_type_price_repo->GetTourTypePriceById($value->tour_type_price_id);
			$this->tour_type_price->type = $tour_type[0]->type;

			// get transportation
			$this->GetTransportationById($activity_id, $tour_program_id, $value->tour_type_price_id, $value->transportation_id, $value->pax_id);

			array_push($tour_type_price_arr, $this->tour_type_price);
		}
		$this->config_tour_program->informations = $tour_type_price_arr;
		// $this->config_tour_program->infos = $tour_type_price;
	}

	public function GetTransportationById($activity_id, $tour_program_id, $tour_type_price_id, $transportation_id, $pax_id){
		$transportation = \TransportationIcasFacade::GetTransportationByTransportId($transportation_id);
		$transportation_arr = [];

		foreach($transportation as $value){
			$this->transports = new transportation;
			$this->transports->id = $value->id;
			$this->transports->car = $value->transportation;
			$this->GetPaxById($activity_id, $tour_program_id, $tour_type_price_id, $pax_id);

			array_push($transportation_arr, $this->transports);
		}

		$this->tour_type_price->transports = $transportation_arr;
	}

	public function GetPaxById($activity_id, $tour_program_id, $tour_type_price_id, $pax_id){
		$pax = $this->pax_repo->GetPaxById($pax_id);
		$pax_arr = [];

		foreach($pax as $value){
			$this->pax = new pax;
			$this->pax->id = $value->id;
			
			// get pax person
			$this->PaxPerson($value->min, $value->max);

			// get price by activity & tour_program & tour_type_price & pax
			$this->GetPriceByPax($activity_id, $tour_program_id, $tour_type_price_id, $pax_id);

			array_push($pax_arr, $this->pax);
		}

		$this->tour_type_price->paxs = $pax_arr;
	}

	public function PaxPerson($min, $max){
		$person_arr = [];
		for($i=$min; $i<=$max; $i++){
			array_push($person_arr, $i);
		}
		
		$this->pax->person = $person_arr;
	}

	public function GetPriceByPax($activity_id, $tour_program_id, $tour_type_price_id, $pax_id){
		$price_per_pax = $this->configuration_tour_program_repo->GetPricePerPax($activity_id, $tour_program_id, $tour_type_price_id, $pax_id);
		$this->pax->sellAdultPrice = $price_per_pax[0]->sell_price_adult;
		$this->pax->sellChildPrice = $price_per_pax[0]->sell_price_child;
		$this->pax->singleRiding = $price_per_pax[0]->extra_charge;
		$this->pax->configTourProgram = $price_per_pax[0]->id;

		// get tour program discount
		$this->GetTourDiscountByConfigTourProgram($activity_id, $price_per_pax[0]->id);
	}

	public function GetTourDiscountByConfigTourProgram($activity_id, $config_tour_program_id){
		$discount = $this->configuration_tour_program_discount_repo->GetTourProgramDiscountByConfigTourProgramId($activity_id, $config_tour_program_id);
		$discount_type = $this->discount_type_repo->GetTourProgramDiscountType($discount[0]->discount_type_id);
		
		if($discount_type[0]->type == "Baht"){
			$discount_type[0]->type = "฿";
		}else if($discount_type[0]->type == "Percent"){
			$discount_type[0]->type = "%";
		}

		$discount_unit = $discount[0]->discount.$discount_type[0]->type;

		$this->pax->discount = $discount_unit;

	}
}