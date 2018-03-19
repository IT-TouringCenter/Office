<?php 
namespace App\Repositories\EasyBook\Reservation\Discount;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class ConfigurationTourProgramDiscountRepository extends Repository{
    function model(){return "App\configuration_tour_program_discount";}

    public function GetTourProgramDiscountByConfigTourProgramId($activity_id, $config_tour_program_id){
    	return $this->model
    				->where('activity_id', $activity_id)
    				->where('configuration_tour_program_id', $config_tour_program_id)
    				->where('is_active',1)
    				->get();
    }
}