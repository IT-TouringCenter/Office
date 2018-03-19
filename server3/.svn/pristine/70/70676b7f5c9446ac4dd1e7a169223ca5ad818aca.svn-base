<?php
namespace App\Facades\EasyBook\Reservation\Transportation;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// Transport Repository
use App\Repositories\EasyBook\Reservation\Transportation\ConfigurationTransportationRepository as configuration_transportation_repo;
use App\Repositories\EasyBook\Reservation\Transportation\TransportationRepository as transportation_repo;

// Model
use App\configuration_transportation as configuration_transportation;
use App\transportation as transportation;

class TransportationClass{

	public function __construct(configuration_transportation_repo $configuration_transportation_repo, transportation_repo $transportation_repo){
		$this->configuration_transportation_repo = $configuration_transportation_repo;
		$this->transportation_repo = $transportation_repo;
	}

	public function GetTransportationByConfigTransportId($config_transport_id){
		$get_transportation = new configuration_transportation;
		$get_transportation = $this->configuration_transportation_repo->GetTransportationByConfigTransportId($config_transport_id);
		
		return $get_transportation;
	}

	public function GetTransportationByTransportId($transport_id){
		$get_transport = new configuration_transportation;
		$get_transport = $this->transportation_repo->GetTransportationById($transport_id);

		return $get_transport;
	}

}