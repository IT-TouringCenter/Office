<?php 
namespace App\Repositories\EasyBook\Reservation\Transfer;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class ConfigurationTransferRepository extends Repository{
    function model(){return "App\configuration_transfer";}

    public function GetConfigurationTransferAll(){
        return $this->model
                    ->where('activity_id',1)
                    ->where('is_active',1)
                    ->get();
    }

    public function GetConfigurationTransferGroupbyTransport($activity_id){
    	return $this->model
    				->groupBy('configuration_transportation_id')
    				->where('activity_id',$activity_id)
    				->where('is_active',1)
    				->get();
    }

    public function GetTransferModeByTransferId($transfer_id){
        return $this->model
                    ->groupBy('transfer_mode_id')
                    ->where('transfer_id',$transfer_id)
                    ->where('is_active',1)
                    ->get();
    }

    public function GetTransferReserveTypeByModeId($transfer_id, $transfer_mode_id){
        return $this->model
                    ->groupBy('transfer_reserve_type_id')
                    ->where('transfer_id', $transfer_id)
                    ->where('transfer_mode_id',$transfer_mode_id)
                    ->where('is_active',1)
                    ->get();
    }

    public function GetPriceByTransferReserveType($transfer_id, $transfer_mode_id, $transfer_reserve_type_id){
        return $this->model
                    ->where('transfer_id', $transfer_id)
                    ->where('transfer_mode_id', $transfer_mode_id)
                    ->where('transfer_reserve_type_id', $transfer_reserve_type_id)
                    ->where('is_active',1)
                    ->get();
    }

}