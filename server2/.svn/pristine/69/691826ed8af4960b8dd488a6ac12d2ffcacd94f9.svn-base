<?php
namespace App\Facades\EasyBook\Reservation\Transfer;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// Transfer
use App\Repositories\EasyBook\Reservation\Transfer\ConfigurationTransferRepository as configuration_transfer_repo;
use App\Repositories\EasyBook\Reservation\Transfer\TransferRepository as transfer_repo;
use App\Repositories\EasyBook\Reservation\Transfer\TransferModeRepository as transfer_mode_repo;
use App\Repositories\EasyBook\Reservation\Transfer\TransferReserveTypeRepository as transfer_reserve_type_repo;
// Transportation
use App\Repositories\EasyBook\Reservation\Transportation\ConfigurationTransportationRepository as configuration_transportation_repo;
use App\Repositories\EasyBook\Reservation\Transportation\TransportationRepository as transportation_repo;
// Model
use App\configuration_transfer as configuration_transfer;
use App\configuration_transportation as configuration_transportation;
use App\transfer_mode as transfer_mode;
use App\transfer_reserve_type as transfer_reserve_type;
use App\transfer as transfer;

class TransferClass{

	public function __construct(configuration_transfer_repo $configuration_transfer_repo, configuration_transportation_repo $configuration_transportation_repo, transportation_repo $transportation_repo, transfer_repo $transfer_repo, transfer_mode_repo $transfer_mode_repo, transfer_reserve_type_repo $transfer_reserve_type_repo){
		$this->configuration_transfer_repo = $configuration_transfer_repo; // transfer
		$this->configuration_transportation_repo = $configuration_transportation_repo; // config transportation
		$this->transportation_repo = $transportation_repo;
		$this->transfer_repo = $transfer_repo;
		$this->transfer_mode_repo = $transfer_mode_repo;
		$this->transfer_reserve_type_repo = $transfer_reserve_type_repo;
	}

	public function GetTransferIcas($activity_id){
		$get_config_transfer = $this->configuration_transfer_repo->GetConfigurationTransferGroupbyTransport($activity_id);
		$config_transfer_arr = [];

		foreach($get_config_transfer as $value){
			$this->config_transfer = new configuration_transfer;
			$this->config_transfer->activityId = $value->activity_id;
			// $this->config_transfer->configTransferId = $value->id;
			$this->GetTransfer($value->transfer_id); // get transfer
			$this->GetTransferByConfigTransportId($value->configuration_transportation_id, $value->transfer_id); // get transport by config transport id

			array_push($config_transfer_arr,$this->config_transfer);
		}
		return $config_transfer_arr;
	}

	public function GetTransfer($transfer_id){
		$get_transfer = $this->transfer_repo->GetTransferById($transfer_id);
		$this->config_transfer->transferId = $get_transfer[0]->id;
		$this->config_transfer->transfer = $get_transfer[0]->transfer;
	}

	public function GetTransferByConfigTransportId($config_transport_id, $transfer_id){
		$config_transport = \TransportationIcasFacade::GetTransportationByConfigTransportId($config_transport_id);
		$config_transport_arr = [];

		foreach($config_transport as $value){
			$this->config_transport = new configuration_transportation;
			$this->GetTransportation($value->transportation_id); // get car
			$this->GetTransferMode($transfer_id); // get transfer mode

			array_push($config_transport_arr, $this->config_transport);
		}
		$this->config_transfer->transports = $config_transport_arr;
	}

	public function GetTransportation($transport_id){
		$get_car = \TransportationIcasFacade::GetTransportationByTransportId($transport_id);
		$this->config_transport->carId = $transport_id;
		$this->config_transport->car = $get_car[0]->transportation;
	}

	public function GetTransferMode($transfer_id){
		$transfer_mode = $this->configuration_transfer_repo->GetTransferModeByTransferId($transfer_id);
		$transfer_mode_arr = [];

		foreach($transfer_mode as $value){
			$this->transfer_mode = new transfer_mode;
			$this->GetTransferReserveType($transfer_id, $value->transfer_mode_id); // get transfer reserve type

			array_push($transfer_mode_arr, $this->transfer_mode);
		}
		$this->config_transport->transferModes = $transfer_mode_arr;
	}

	public function GetTransferReserveType($transfer_id, $transfer_mode_id){
		$transfer_reserve_type = $this->configuration_transfer_repo->GetTransferReserveTypeByModeId($transfer_id, $transfer_mode_id);
		$transfer_reserve_type_arr = [];

		foreach($transfer_reserve_type as $value){
			$this->transfer_reserve_type = new transfer_reserve_type;
			$this->transfer_reserve_type->id = $value->transfer_reserve_type_id;

			$transfer_type = $this->transfer_reserve_type_repo->GetTransferReserveTypeById($value->transfer_reserve_type_id);
			$this->transfer_reserve_type->type = $transfer_type[0]->reserve_type;

			$this->GetTransferPriceByTransferReserveType($transfer_id, $transfer_mode_id, $value->transfer_reserve_type_id); // get transfer price

			array_push($transfer_reserve_type_arr, $this->transfer_reserve_type);
		}
		$this->transfer_mode->id = $transfer_mode_id;
		$this->GetTransferModeByModeId($transfer_mode_id); // get transfer mode
		$this->transfer_mode->transferTypes = $transfer_reserve_type_arr;
	}

	public function GetTransferPriceByTransferReserveType($transfer_id, $transfer_mode_id, $transfer_reserve_type_id){
		$transfer_price = $this->configuration_transfer_repo->GetPriceByTransferReserveType($transfer_id, $transfer_mode_id, $transfer_reserve_type_id);
		$transfer_price_arr = [];

		foreach($transfer_price as $value){
			$this->transfer_price = new configuration_transfer;
			$this->transfer_price->price = $value->price;
			$this->transfer_price->validityStart = $value->validity_start;
			$this->transfer_price->validityEnd = $value->validity_end;
			array_push($transfer_price_arr, $this->transfer_price);
		}

		$this->transfer_reserve_type->prices = $transfer_price_arr;
	}

	public function GetTransferModeByModeId($transfer_mode_id){
		$transfer_mode = $this->transfer_mode_repo->GetTransferModeById($transfer_mode_id);
		$this->transfer_mode->mode = $transfer_mode[0]->mode;
	}

}