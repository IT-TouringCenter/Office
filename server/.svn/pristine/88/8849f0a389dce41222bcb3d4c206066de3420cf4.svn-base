<?php 
namespace App\Repositories\EasyBook\Reservation\Tour;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class ConfigurationTourProgramRepository extends Repository{
    function model(){return "App\configuration_tour_program";}

    public function GetConfigurationTourProgramByActivityId($activity_id){
    	return $this->model
    				->where('activity_id',$activity_id)
    				->where('is_active',1)
    				->get();
    }

    public function GetTypePriceByConfigTourProgram($activity_id, $tour_program_id){
    	return $this->model
    				->where('activity_id', $activity_id)
    				->where('tour_program_id', $tour_program_id)
    				->where('is_active',1)
    				->get();
    }

    public function GetPricePerPax($activity_id, $tour_program_id, $tour_type_price_id, $pax_id){
    	return $this->model
    				->where('activity_id', $activity_id)
    				->where('tour_program_id', $tour_program_id)
    				->where('pax_id', $pax_id)
    				->where('is_active',1)
    				->get();
    }
}