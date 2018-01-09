<?php 
namespace App\Repositories\EasyBook\Reservation\Transportation;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class ConfigurationTransportationRepository extends Repository{
    function model(){return "App\configuration_transportation";}

    public function GetConfigurationTransportationAll(){
    	return $this->model
    				->where('is_active',1)
    				->get();
    }

    public function GetTransportationByConfigTransportId($config_transport_id){
    	return $this->model
    				->where('id',$config_transport_id)
    				->where('is_active',1)
    				->get();
    }
}